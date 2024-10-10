import sys
import json
import numpy as np
import pandas as pd
from statsmodels.tsa.arima.model import ARIMA

# Read input JSON from command-line argument
input_json = sys.argv[1]
inventory_data = json.loads(input_json)

# Placeholder for forecast results
forecast_results = []
low_stock_threshold = 0.2  # 20% threshold for low stock alerts

# Loop through each item in inventory data
for item in inventory_data:
    item_name = item['item_name']
    stock_level = item['stock_level']
    
    # Generate time series data for forecasting (dummy historical data)
    data = np.random.randint(stock_level - 20, stock_level + 20, size=100)
    df = pd.Series(data)

    # Train ARIMA model
    model = ARIMA(df, order=(5, 1, 0))
    model_fit = model.fit()

    # Forecast next 6 days
    forecast_steps = 6
    forecast = model_fit.forecast(steps=forecast_steps).tolist()

    # Decision tree logic to check if stock is low (20% or less)
    restock_level = max(data)  # Assuming max historical stock is the restock level
    is_low_stock = 1 if stock_level <= restock_level * low_stock_threshold else 0

    # Store the result
    forecast_results.append({
        'item_name': item_name,
        'forecast': forecast,
        'is_low_stock': is_low_stock
    })

# Output the forecast and low stock alerts as JSON
print(json.dumps(forecast_results))
