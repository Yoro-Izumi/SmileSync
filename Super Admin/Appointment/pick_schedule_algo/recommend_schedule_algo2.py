import random
from datetime import datetime, timedelta
from deap import base, creator, tools
import json
import sys

# Step 1: Read Data from stdin
input_data = sys.stdin.read()

try:
    data = json.loads(input_data)

    # Validate input data
    required_fields = ['reservations', 'start_of_day', 'end_of_day', 'leeway', 'predicted_durations', 'default_value']
    if not all(field in data for field in required_fields):
        raise ValueError("Missing fields in input data")

    # Parse data
    DEFAULT_DURATION = int(data['default_value'])  # Use provided default duration
    reservations = [
        {"start_time": datetime.strptime(res, "%Y-%m-%d %H:%M:%S"), "duration": DEFAULT_DURATION}
        for res in data["reservations"]
    ]

    start_of_day = datetime.strptime(data['start_of_day'], '%Y-%m-%d %H:%M:%S')
    end_of_day = datetime.strptime(data['end_of_day'], '%Y-%m-%d %H:%M:%S')
    leeway = int(data['leeway'])
    predicted_durations = int(data['predicted_durations'])
except Exception as e:
    print(json.dumps({"error": f"Error processing input data: {str(e)}"}))
    exit()

# Step 2: Genetic Algorithm Setup
creator.create("FitnessMin", base.Fitness, weights=(-1.0,))  # Minimize fitness
creator.create("Individual", list, fitness=creator.FitnessMin)

toolbox = base.Toolbox()

# Step 3: Calculate available time slots (in 30-minute intervals)
def get_available_slots():
    available_slots = []
    current_time = start_of_day

    while current_time + timedelta(minutes=predicted_durations) <= end_of_day:
        is_available = True
        for reservation in reservations:
            reserved_start = reservation["start_time"]
            reserved_end = reserved_start + timedelta(minutes=reservation["duration"])

            # Check if proposed time overlaps any reservation
            if (current_time < reserved_end and current_time + timedelta(minutes=predicted_durations) > reserved_start):
                is_available = False
                break

        if is_available:
            available_slots.append(current_time)

        current_time += timedelta(minutes=30)  # Step in 30-minute intervals

    return available_slots

# Step 4: Genetic Algorithm Setup for slot selection
toolbox.register("attr_time", random.randint, 0, 1440)  # 1440 minutes per day
toolbox.register("individual", tools.initRepeat, creator.Individual, toolbox.attr_time, n=1)
toolbox.register("population", tools.initRepeat, list, toolbox.individual)
toolbox.register("mutate", tools.mutFlipBit, indpb=0.2)
toolbox.register("select", tools.selTournament, tournsize=3)

# Fitness function
def eval_schedule(individual):
    proposed_start = start_of_day + timedelta(minutes=individual[0])
    proposed_end = proposed_start + timedelta(minutes=predicted_durations)

    # Penalize overlaps
    for reservation in reservations:
        reserved_start = reservation["start_time"]
        reserved_end = reserved_start + timedelta(minutes=reservation["duration"])
        if (proposed_start < reserved_end and proposed_start >= reserved_start) or \
           (proposed_end > reserved_start and proposed_end <= reserved_end):
            return 1000,  # Overlap penalty

    # Penalize times outside working hours
    if proposed_start < start_of_day or proposed_end > end_of_day:
        return 1000,  # Time outside working hours penalty

    # Prefer earlier times
    return proposed_start.hour * 60 + proposed_start.minute,

toolbox.register("evaluate", eval_schedule)

# Step 5: Run Genetic Algorithm to find optimal time slot
population = toolbox.population(n=100)
for gen in range(20):
    offspring = list(map(toolbox.clone, population))
    for ind in offspring:
        if random.random() < 0.2:
            toolbox.mutate(ind)
            del ind.fitness.values
    invalid_ind = [ind for ind in offspring if not ind.fitness.valid]
    fitnesses = map(toolbox.evaluate, invalid_ind)
    for ind, fit in zip(invalid_ind, fitnesses):
        ind.fitness.values = fit
    population[:] = toolbox.select(offspring, len(population))

# Get the top 5 individuals
top_individuals = tools.selBest(population, k=5)

# Step 6: Get available slots
available_slots = get_available_slots()

# Step 7: Generate Recommendations if Slots Are Available
recommended_times = []
if available_slots:
    for individual in top_individuals:
        random.shuffle(available_slots)
        for slot in available_slots:
            proposed_start = slot + timedelta(minutes=individual[0])
            proposed_end = proposed_start + timedelta(minutes=predicted_durations)
            leeway_start = proposed_start + timedelta(minutes=random.randint(0, leeway))
            leeway_end = leeway_start + timedelta(minutes=predicted_durations)

            if leeway_end <= end_of_day:
                recommended_times.append(leeway_start.strftime("%Y-%m-%d %H:%M"))
                break
else:
    recommended_times = []

# Step 8: Output Result as JSON
# Ensure recommended times appear at the start of available slots
available_slots_with_recommendations = recommended_times + [slot.strftime("%Y-%m-%d %H:%M") for slot in available_slots if slot.strftime("%Y-%m-%d %H:%M") not in recommended_times]

result = {
    "recommended_times": recommended_times,
    "available_slots": available_slots_with_recommendations,
    "predicted_durations": predicted_durations
}

print(json.dumps(result))
