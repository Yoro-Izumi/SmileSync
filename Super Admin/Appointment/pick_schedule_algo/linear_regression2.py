import json
import sys
import numpy as np
from sklearn.linear_model import LinearRegression

def predict_durations(data):
    try:
        # Extract and validate service_durations
        service_durations = data.get('service_durations')
        if not isinstance(service_durations, list) or not service_durations:
            raise ValueError("Invalid or empty service_durations")

        # Check if we have enough data for linear regression
        if len(service_durations) < 2:
            # Use the last duration if there's not enough data for a trend
            predicted_duration = service_durations[-1]
        else:
            # Prepare data for linear regression
            X = np.array(range(len(service_durations))).reshape(-1, 1)  # Indices as feature
            y = np.array(service_durations)  # Durations as target

            # Create and fit the model
            model = LinearRegression()
            model.fit(X, y)

            # Generate prediction
            prediction = model.predict([[len(service_durations)]])  # Predict the next value
            predicted_duration = int(round(prediction[0]))  # Convert to scalar and round

        # Output predictions as structured JSON
        result = {"predicted_duration": predicted_duration}
        print(json.dumps(result))

    except Exception as e:
        # Handle errors and print error message
        result = {"error": f"An error occurred: {str(e)}"}
        print(json.dumps(result))

if __name__ == "__main__":
    # Read JSON data from stdin
    input_data = sys.stdin.read()

    try:
        # Parse the JSON data
        data = json.loads(input_data)
        predict_durations(data)
    except Exception as e:
        print(json.dumps({"error": f"Invalid input or failed to parse JSON: {str(e)}"}))
