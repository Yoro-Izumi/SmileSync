import sys
import pandas as pd
from statsmodels.tsa.arima.model import ARIMA
from statsmodels.tsa.holtwinters import SimpleExpSmoothing

# Ensure arguments are passed
if len(sys.argv) < 3:
    print("Usage: python inventory_forecast2.py <input_file> <output_file>")
    sys.exit(1)

# Step 1: Load the input CSV file
input_file = sys.argv[1]
output_file = sys.argv[2]

try:
    data = pd.read_csv(input_file)
except Exception as e:
    print(f"Error reading input file {input_file}: {e}")
    sys.exit(1)

# Ensure required columns exist
required_columns = ['item_id', 'item_name', 'item_quantity', 'quantity_used', 'date_of_usage']
if not all(col in data.columns for col in required_columns):
    print(f"Input file is missing required columns: {required_columns}")
    sys.exit(1)

# Step 2: Initialize storage for forecasts
forecast_results = []

# Step 3: Group data by item_id
for item_id, group in data.groupby('item_id'):
    try:
        # Calculate stock levels over time
        group['date_of_usage'] = pd.to_datetime(group['date_of_usage'], errors='coerce')
        if group['date_of_usage'].isnull().any():
            raise ValueError("Invalid date in 'date_of_usage' column")

        group['stock_level'] = group['item_quantity'].iloc[0] - group['quantity_used'].cumsum()

        # Choose forecasting method based on data size
        if len(group) >= 10:  # Use ARIMA for sufficient data points
            model = ARIMA(group['stock_level'], order=(5, 1, 0))  # Adjust order as needed
            model_fit = model.fit()
            forecast = model_fit.forecast(steps=6)
        elif len(group) > 1:  # Use Simple Exponential Smoothing for small datasets
            model = SimpleExpSmoothing(group['stock_level']).fit()
            forecast = model.forecast(steps=6)
        else:  # Fallback for very small datasets
            avg_usage_per_day = group['quantity_used'].mean()
            forecast = [group['stock_level'].iloc[-1] - avg_usage_per_day * i for i in range(1, 7)]

        # Forecast dates
        forecast_dates = pd.date_range(start=group['date_of_usage'].iloc[-1] + pd.Timedelta(days=1), periods=6)

        # Fill missing predictions by copying the last known stock level and rounding to int
        last_known_stock = group['stock_level'].iloc[-1]
        forecast = [int(max(value, 0)) if not pd.isna(value) else int(last_known_stock) for value in forecast]

        # Handle cases where forecasts remain constant due to lack of trend
        if all(f == forecast[0] for f in forecast):
            avg_usage_per_day = group['quantity_used'].mean()
            forecast = [int(last_known_stock - avg_usage_per_day * i) for i in range(1, 7)]

        # Store results
        for date, value in zip(forecast_dates, forecast):
            forecast_results.append([
                item_id,
                group['item_name'].iloc[0],
                date.strftime('%Y-%m-%d'),
                value
            ])

    except Exception as e:
        print(f"Error processing item_id {item_id}: {e}")
        continue

# Step 4: Save the forecast to a CSV file
try:
    forecast_df = pd.DataFrame(forecast_results, columns=['item_id', 'item_name', 'date_of_usage', 'forecasted_stock_level'])
    forecast_df = forecast_df.sort_values(by=['item_id'], ignore_index=True)  # Sort by item_id only
    forecast_df.to_csv(output_file, index=False)
    print(f"Forecast saved to {output_file}")
except Exception as e:
    print(f"Error saving output file {output_file}: {e}")
    sys.exit(1)
