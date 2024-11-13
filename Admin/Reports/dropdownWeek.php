<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Button with Selection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f7f7f7;
        }
        
        .calendar-btn {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border: 1px solid #dcdcdc;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: box-shadow 0.3s ease;
        }

        .calendar-btn:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }

        .calendar-btn img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .calendar-btn span {
            font-size: 16px;
            color: #4d4d4d;
        }

        /* Dropdown styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            min-width: 100px;
            z-index: 1;
        }

        .dropdown-content a {
            padding: 10px;
            display: block;
            text-align: center;
            color: #4d4d4d;
            text-decoration: none;
            border-bottom: 1px solid #dcdcdc;
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background-color: #f0f0f0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>

    <div class="dropdown">
        <button class="calendar-btn">
            <img src="https://img.icons8.com/ios/50/000000/calendar--v1.png" alt="Calendar Icon">
            <span id="current-selection">Week</span>
        </button>
        <div class="dropdown-content">
            <a href="#" onclick="changeSelection('Week')">Week</a>
            <a href="#" onclick="changeSelection('Month')">Month</a>
            <a href="#" onclick="changeSelection('Year')">Year</a>
        </div>
    </div>

    <script>
        function changeSelection(period) {
            document.getElementById('current-selection').textContent = period;
        }
    </script>
    
</body>
</html>
