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
            <h3>Upcoming</h3>
            <table id="dashboard_appointments-table">
                <!-- Appointments will be dynamically populated here -->
                 
            </table>
            
        </div>
        <button class="dashboard_view-all" id="viewAllBtn" onclick='redirectToUpcoming()'>View All</button>
    </div>
