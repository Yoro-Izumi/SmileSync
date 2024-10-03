<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar UI</title>

</head>
<body>
    <div class="dashboard_calendar-container">
        <div class="dashboard_calendar">
            <div class="dashboard_month">
                <span class="dashboard_prev-month">&#8249;</span>
                <span class="dashboard_month-name">September 2021</span>
                <span class="dashboard_next-month">&#8250;</span>
            </div>
            <div class="dashboard_weekdays">
                <span>SUN</span>
                <span>MON</span>
                <span>TUE</span>
                <span>WED</span>
                <span>THU</span>
                <span>FRI</span>
                <span>SAT</span>
            </div>
            <div class="dashboard_days">
                <!-- Days will be populated here -->
            </div>
        </div>
        <div class="dashboard_appointments">
            <h3>Upcoming Appointments</h3>
            <table id="dashboard_appointments-table">
                <!-- Appointments will be dynamically populated here -->
                 
            </table>
            
        </div>
        <button class="dashboard_view-all" id="viewAllBtn" onclick='redirectToUpcoming()'>View All</button>
    </div>

   

<script>
    function redirectToUpcoming() {
        // Redirect to page2.html with a query parameter to show only "Upcoming" rows
        window.location.href = 'http://localhost/SmileSync/Admin/Appointment/Appointment-page.php?status=upcoming';
    }
</script>

    <script src="js/calendar-appointments.js"></script>
</body>
</html>
