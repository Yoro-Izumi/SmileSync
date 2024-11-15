#!C:/Users/YORO/AppData/Local/Programs/Python/Python312/python.exe
print ("Content-type: text/html\n\n")
import random
from datetime import datetime, timedelta
from deap import base, creator, tools, algorithms

# Example existing reservations (could also be passed in from PHP if dynamic)
reservations = [
    {'start_time': datetime(2024, 8, 14, 9, 0), 'duration': 30},
    {'start_time': datetime(2024, 8, 14, 10, 0), 'duration': 45},
    {'start_time': datetime(2024, 8, 14, 11, 30), 'duration': 60},
]

# Procedure duration from PHP (could also be passed as an argument)
predicted_duration = 40  # in minutes

# Define the working hours
start_of_day = datetime(2024, 8, 14, 8, 0)
end_of_day = datetime(2024, 8, 14, 17, 0)

# Fitness function
def eval_schedule(individual):
    proposed_start = start_of_day + timedelta(minutes=individual[0])
    proposed_end = proposed_start + timedelta(minutes=predicted_duration)
    
    for reservation in reservations:
        reserved_start = reservation['start_time']
        reserved_end = reserved_start + timedelta(minutes=reservation['duration'])
        
        if (proposed_start < reserved_end and proposed_start >= reserved_start) or \
           (proposed_end > reserved_start and proposed_end <= reserved_end):
            return 1000,  # Penalize overlaps

    return proposed_start.hour * 60 + proposed_start.minute,  # Prefer earlier times

# Genetic Algorithm setup
creator.create("FitnessMin", base.Fitness, weights=(-1.0,))
creator.create("Individual", list, fitness=creator.FitnessMin)

toolbox = base.Toolbox()
toolbox.register("attr_time", random.randint, 0, int((end_of_day - start_of_day).total_seconds() / 60 - predicted_duration))
toolbox.register("individual", tools.initRepeat, creator.Individual, toolbox.attr_time, n=1)
toolbox.register("population", tools.initRepeat, list, toolbox.individual)

toolbox.register("mate", tools.cxTwoPoint)
toolbox.register("mutate", tools.mutFlipBit, indpb=0.05)
toolbox.register("select", tools.selTournamirent, tournsize=3)
toolbox.register("evaluate", eval_schedule)

# Execute the Genetic Algorithm
population = toolbox.population(n=50)
algorithms.eaSimple(population, toolbox, cxpb=0.5, mutpb=0.2, ngen=10, verbose=False)

# Get the best individual
best_individual = tools.selBest(population, k=1)[0]
recommended_minutes = best_individual[0]
recommended_time = start_of_day + timedelta(minutes=recommended_minutes)

# Output the recommended time as a string (to be captured by PHP)
print(recommended_time.strftime("%Y-%m-%d %H:%M"))
