#!C:/Users/YORO/AppData/Local/Programs/Python/Python312/python.exe
print ("Content-type: text/html\n\n")
import random
from datetime import datetime, timedelta
from deap import base, creator, tools, algorithms
import json

# Set random seed for reproducibility
random.seed(42)

# Example existing reservations
reservations = [
    {'start_time': datetime(2024, 8, 14, 9, 0), 'duration': 30},
    {'start_time': datetime(2024, 8, 14, 10, 0), 'duration': 45},
    {'start_time': datetime(2024, 8, 14, 11, 30), 'duration': 60},
]

# Procedure duration
predicted_duration = 40  # in minutes
leeway = 60  # 60-minute buffer

# Working hours
start_of_day = datetime(2024, 8, 14, 8, 0)
end_of_day = datetime(2024, 8, 14, 17, 0)

# Define fitness and individual
creator.create("FitnessMin", base.Fitness, weights=(-1.0,))
creator.create("Individual", list, fitness=creator.FitnessMin)

toolbox = base.Toolbox()
toolbox.register("attr_time", random.randint, 0, int((end_of_day - start_of_day).total_seconds() / 60 - predicted_duration))
toolbox.register("individual", tools.initRepeat, creator.Individual, toolbox.attr_time, n=1)
toolbox.register("population", tools.initRepeat, list, toolbox.individual)

toolbox.register("mutate", tools.mutFlipBit, indpb=0.2)  # Higher mutation probability
toolbox.register("select", tools.selTournament, tournsize=3)

# Fitness function
def eval_schedule(individual):
    proposed_start = start_of_day + timedelta(minutes=individual[0])
    proposed_end = proposed_start + timedelta(minutes=predicted_duration)

    # Penalize overlaps
    for reservation in reservations:
        reserved_start = reservation['start_time']
        reserved_end = reserved_start + timedelta(minutes=reservation['duration'])
        if (proposed_start < reserved_end and proposed_start >= reserved_start) or \
           (proposed_end > reserved_start and proposed_end <= reserved_end):
            return 1000,  # Overlap penalty

    # Penalize times outside working hours
    if proposed_start < start_of_day or proposed_end > end_of_day:
        return 1000,

    # Prefer earlier times
    return proposed_start.hour * 60 + proposed_start.minute,

toolbox.register("evaluate", eval_schedule)

# Genetic algorithm without crossover
population = toolbox.population(n=100)
for gen in range(20):  # Run for 20 generations
    offspring = list(map(toolbox.clone, population))
    for ind in offspring:
        if random.random() < 0.2:  # Mutation probability
            toolbox.mutate(ind)
            del ind.fitness.values
    # Evaluate fitness of invalid individuals
    invalid_ind = [ind for ind in offspring if not ind.fitness.valid]
    fitnesses = map(toolbox.evaluate, invalid_ind)
    for ind, fit in zip(invalid_ind, fitnesses):
        ind.fitness.values = fit
    # Select the next generation population
    population[:] = toolbox.select(offspring, len(population))

# Get the top 5 individuals
top_individuals = tools.selBest(population, k=5)

# Find all available time slots
available_slots = []
current_time = start_of_day

while current_time + timedelta(minutes=predicted_duration) <= end_of_day:
    is_available = True
    for reservation in reservations:
        reserved_start = reservation['start_time']
        reserved_end = reserved_start + timedelta(minutes=reservation['duration'])

        if (current_time < reserved_end and current_time >= reserved_start) or \
           (current_time + timedelta(minutes=predicted_duration) > reserved_start and 
            current_time + timedelta(minutes=predicted_duration) <= reserved_end):
            is_available = False
            break

    if is_available:
        available_slots.append(current_time)
    
    current_time += timedelta(minutes=1)  # Increment by 1 minute

# Generate 5 recommended times considering leeway
recommended_times = []
for individual in top_individuals:
    # Generate a random recommended time based on available slots and leeway
    random.shuffle(available_slots)  # Shuffle to add randomness
    for slot in available_slots:
        proposed_start = slot + timedelta(minutes=individual[0])
        proposed_end = proposed_start + timedelta(minutes=predicted_duration)
        # Add 60-minute leeway to the recommended time
        leeway_start = proposed_start + timedelta(minutes=random.randint(0, leeway))
        leeway_end = leeway_start + timedelta(minutes=predicted_duration)

        if leeway_end <= end_of_day:
            recommended_times.append(leeway_start.strftime("%Y-%m-%d %H:%M"))
            break

# Output available slots and the top 5 recommended times as JSON
result = {
    "available_slots": [slot.strftime("%Y-%m-%d %H:%M") for slot in available_slots],
    "recommended_times": recommended_times  # Top 5 recommended times with leeway
}

print(json.dumps(result))
