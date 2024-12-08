<!DOCTYPE html>
<html lang="en">
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
