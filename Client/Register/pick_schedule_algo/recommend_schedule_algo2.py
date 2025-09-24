import random
from datetime import datetime, timedelta
from deap import base, creator, tools
import json
import sys
from intervaltree import IntervalTree
from multiprocessing import Pool

# Step 1: Parse Input Data
def parse_input_data(input_data):
    try:
        data = json.loads(input_data)
        required_fields = ['reservations', 'start_of_day', 'end_of_day', 'leeway', 'predicted_durations', 'default_value']
        if not all(field in data for field in required_fields):
            raise ValueError("Missing fields in input data")

        DEFAULT_DURATION = int(data['default_value'])
        reservations = [
            {"start_time": datetime.strptime(res, "%Y-%m-%d %H:%M:%S"), "duration": DEFAULT_DURATION}
            for res in data["reservations"]
        ]

        start_of_day = datetime.strptime(data['start_of_day'], '%Y-%m-%d %H:%M:%S')
        end_of_day = datetime.strptime(data['end_of_day'], '%Y-%m-%d %H:%M:%S')
        leeway = int(data['leeway'])
        predicted_durations = int(data['predicted_durations'])

        return reservations, start_of_day, end_of_day, leeway, predicted_durations
    except Exception as e:
        print(json.dumps({"error": f"Error processing input data: {str(e)}"}))
        sys.exit(1)

# Step 2: Create Interval Tree for Reservations
def create_interval_tree(reservations):
    tree = IntervalTree()
    for reservation in reservations:
        start = reservation["start_time"].timestamp()
        end = (reservation["start_time"] + timedelta(minutes=reservation["duration"])).timestamp()
        tree.addi(start, end)
    return tree

# Step 3: Calculate Available Time Slots
def get_available_slots(start_of_day, end_of_day, predicted_durations, tree):
    available_slots = []
    current_time = start_of_day

    while current_time + timedelta(minutes=predicted_durations) <= end_of_day:
        slot_start = current_time.timestamp()
        slot_end = (current_time + timedelta(minutes=predicted_durations)).timestamp()
        if not tree.overlaps(slot_start, slot_end):
            available_slots.append(current_time)
        current_time += timedelta(minutes=30)

    return available_slots

# Step 4: Fitness Evaluation Function (Moved outside of setup_genetic_algorithm)
def eval_schedule(individual, start_of_day, end_of_day, predicted_durations, tree):
    proposed_start = start_of_day + timedelta(minutes=individual[0])
    proposed_end = proposed_start + timedelta(minutes=predicted_durations)

    # Penalize overlaps
    slot_start = proposed_start.timestamp()
    slot_end = proposed_end.timestamp()
    if tree.overlaps(slot_start, slot_end):
        return 1000,  # Overlap penalty

    # Penalize times outside working hours
    if proposed_start < start_of_day or proposed_end > end_of_day:
        return 1000,  # Time outside working hours penalty

    # Prefer earlier times
    return proposed_start.hour * 60 + proposed_start.minute,

# Step 5: Genetic Algorithm Setup
def setup_genetic_algorithm(start_of_day, end_of_day, predicted_durations, tree):
    creator.create("FitnessMin", base.Fitness, weights=(-1.0,))  # Minimize fitness
    creator.create("Individual", list, fitness=creator.FitnessMin)

    toolbox = base.Toolbox()
    toolbox.register("attr_time", random.randint, 0, 1440)  # 1440 minutes per day
    toolbox.register("individual", tools.initRepeat, creator.Individual, toolbox.attr_time, n=1)
    toolbox.register("population", tools.initRepeat, list, toolbox.individual)
    toolbox.register("mutate", tools.mutFlipBit, indpb=0.2)
    toolbox.register("select", tools.selTournament, tournsize=3)

    # Register the evaluation function with additional arguments
    toolbox.register("evaluate", eval_schedule, start_of_day=start_of_day, end_of_day=end_of_day, predicted_durations=predicted_durations, tree=tree)
    return toolbox

# Step 6: Run Genetic Algorithm with Parallel Fitness Evaluation
def run_genetic_algorithm(toolbox):
    population = toolbox.population(n=100)

    # Create a Pool for parallel evaluation
    with Pool() as pool:
        toolbox.register("map", pool.map)  # Use Pool's map function for parallel evaluation

        for gen in range(20):
            offspring = list(map(toolbox.clone, population))
            for ind in offspring:
                if random.random() < 0.2:
                    toolbox.mutate(ind)
                    del ind.fitness.values

            # Evaluate individuals with invalid fitness
            invalid_ind = [ind for ind in offspring if not ind.fitness.valid]
            fitnesses = toolbox.map(toolbox.evaluate, invalid_ind)
            for ind, fit in zip(invalid_ind, fitnesses):
                ind.fitness.values = fit

            # Select the next generation
            population[:] = toolbox.select(offspring, len(population))

    return tools.selBest(population, k=5)

# Step 7: Generate Recommendations
def generate_recommendations(top_individuals, available_slots, leeway, predicted_durations, end_of_day):
    recommended_times = []
    for individual in top_individuals:
        random.shuffle(available_slots)
        for slot in available_slots:
            proposed_start = slot + timedelta(minutes=individual[0])
            proposed_end = proposed_start + timedelta(minutes=predicted_durations)
            leeway_start = proposed_start + timedelta(minutes=random.randint(0, leeway))
            leeway_end = leeway_start + timedelta(minutes=predicted_durations)

            if leeway_end <= end_of_day:
                recommended_times.append(leeway_start)
                break

    # Sort recommended times
    recommended_times.sort()

    # Filter out times that are less than 30 minutes apart
    filtered_recommendations = []
    prev_time = None
    for time in recommended_times:
        if prev_time is None or (time - prev_time) >= timedelta(minutes=30):
            filtered_recommendations.append(time.strftime("%Y-%m-%d %H:%M"))
            prev_time = time

    return filtered_recommendations

# Step 8: Main Function
def main():
    input_data = sys.stdin.read()
    reservations, start_of_day, end_of_day, leeway, predicted_durations = parse_input_data(input_data)
    tree = create_interval_tree(reservations)
    available_slots = get_available_slots(start_of_day, end_of_day, predicted_durations, tree)
    toolbox = setup_genetic_algorithm(start_of_day, end_of_day, predicted_durations, tree)
    top_individuals = run_genetic_algorithm(toolbox)
    recommended_times = generate_recommendations(top_individuals, available_slots, leeway, predicted_durations, end_of_day)

    # Prepare output
    available_slots_with_recommendations = recommended_times + [
        slot.strftime("%Y-%m-%d %H:%M") for slot in available_slots
        if slot.strftime("%Y-%m-%d %H:%M") not in recommended_times
    ]

    result = {
        "recommended_times": recommended_times,
        "available_slots": available_slots_with_recommendations,
        "predicted_durations": predicted_durations
    }

    print(json.dumps(result))

if __name__ == "__main__":
    main()