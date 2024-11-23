import mysql.connector
import pandas as pd

# Connect to the database
conn = mysql.connector.connect(
    host='your_host',
    user='your_username',
    password='your_password',
    database='your_database'
)
cursor = conn.cursor()

# Prepare the SQL query
query = "SELECT * FROM your_table WHERE column_name = %s"
params = ('value',)

# Execute the prepared statement
cursor.execute(query, params)

# Fetch all rows
rows = cursor.fetchall()

# Close the connection
conn.close()

# Convert data to an associative array
data = []
for row in rows:
    data.append({
        'id': row,
        'name': row,
        'date_column': row
    })

# Convert the datetime column to Python datetime
for item in data:
    item['date_column'] = pd.to_datetime(item['date_column'])

# Display the associative array
print(data)