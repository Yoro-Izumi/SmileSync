<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar UI</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f4f8;
        }

        .dashboard_calendar-container {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            width: 320px;
        }

        .dashboard_calendar {
            text-align: center;
            margin-bottom: 20px;
        }

        .dashboard_month {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 15px;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard_month span {
            cursor: pointer;
        }

        .dashboard_weekdays, .dashboard_days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            justify-items: center;
            margin-bottom: 10px;
        }

        .dashboard_weekdays span {
            font-size: 12px;
            font-weight: bold;
            color: #888;
        }

        .dashboard_days span {
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            font-size: 14px;
            margin: 2px 0;
            cursor: pointer;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        .dashboard_days span:hover {
            background-color: #eaeaea;
        }

        .dashboard_days .dashboard_selected {
            background-color: #FF6B6B;
            color: white;
        }

        .dashboard_days .dashboard_current-day {
            background-color: #007bff;
            color: white;
        }

        .dashboard_appointments {
            text-align: left;
            margin-top: 50px; /* Added margin to create space between calendar and appointments */
        }

        .dashboard_appointments h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .dashboard_appointments table {
            width: 100%;
            border-collapse: collapse;
        }

        .dashboard_appointments td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .dashboard_appointments .dashboard_arrow {
            text-align: right;
            color: #888;
            font-size: 18px;
        }

        .dashboard_view-all {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border: 1px solid #007bff;
            background-color: white;
            color: #007bff;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            transition: background-color 0.3s, color 0.3s;
        }

        .dashboard_view-all:hover {
            background-color: #007bff;
            color: white;
        }

        a {
            text-decoration: none;
        }

    </style>
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
            <button class="dashboard_view-all">View All</button>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dashboard_daysContainer = document.querySelector(".dashboard_days");
            const dashboard_appointmentsTable = document.getElementById("dashboard_appointments-table");
            const dashboard_monthNameElement = document.querySelector(".dashboard_month-name");
            const dashboard_prevMonthButton = document.querySelector(".dashboard_prev-month");
            const dashboard_nextMonthButton = document.querySelector(".dashboard_next-month");

            let dashboard_currentMonth = 8; // September (0-based index)
            let dashboard_currentYear = 2021;

            const dashboard_appointments = {
                '2021-09-19': [
                    { name: 'Iruma Izuku', time: '08:30 AM - 02:00 PM' },
                    { name: 'Jonas Oli', time: '03:00 PM - 05:00 PM' }
                ],
                '2021-09-20': [
                    { name: 'John Doe', time: '09:00 AM - 11:00 AM' }
                ]
                // Add more appointments as needed
            };

            function updateDashboardCalendar() {
                dashboard_daysContainer.innerHTML = '';
                const dashboard_daysInMonth = new Date(dashboard_currentYear, dashboard_currentMonth + 1, 0).getDate();
                const dashboard_firstDayIndex = new Date(dashboard_currentYear, dashboard_currentMonth, 1).getDay();
                const dashboard_today = new Date();

                dashboard_monthNameElement.textContent = new Date(dashboard_currentYear, dashboard_currentMonth).toLocaleString('default', { month: 'long', year: 'numeric' });

                // Create blank days for the previous month
                for (let i = 0; i < dashboard_firstDayIndex; i++) {
                    const dashboard_blankDay = document.createElement("span");
                    dashboard_daysContainer.appendChild(dashboard_blankDay);
                }

                // Populate days in the calendar
                for (let dashboard_day = 1; dashboard_day <= dashboard_daysInMonth; dashboard_day++) {
                    const dashboard_dayElement = document.createElement("span");
                    dashboard_dayElement.textContent = dashboard_day;
                    const dashboard_fullDate = `${dashboard_currentYear}-${String(dashboard_currentMonth + 1).padStart(2, '0')}-${String(dashboard_day).padStart(2, '0')}`;

                    // Highlight the current day
                    if (dashboard_today.getFullYear() === dashboard_currentYear &&
                        dashboard_today.getMonth() === dashboard_currentMonth &&
                        dashboard_today.getDate() === dashboard_day) {
                        dashboard_dayElement.classList.add("dashboard_current-day");
                    }

                    dashboard_dayElement.onclick = () => {
                        document.querySelectorAll(".dashboard_days span").forEach(el => el.classList.remove("dashboard_selected"));
                        dashboard_dayElement.classList.add("dashboard_selected");
                        displayDashboardAppointments(dashboard_fullDate);
                    };

                    if (dashboard_fullDate === '2021-09-19') dashboard_dayElement.classList.add("dashboard_selected"); // Mark the 19th by default
                    dashboard_daysContainer.appendChild(dashboard_dayElement);
                }
            }

            function displayDashboardAppointments(dashboard_date) {
                dashboard_appointmentsTable.innerHTML = '';
                const dashboard_dayAppointments = dashboard_appointments[dashboard_date] || [];
                dashboard_dayAppointments.forEach(dashboard_appointment => {
                    const dashboard_row = document.createElement("tr");
                    dashboard_row.innerHTML = `<td>${dashboard_appointment.name}</td><td>${dashboard_appointment.time}</td><td class="dashboard_arrow"><a href="#">&#8250;</a></td>`;
                    dashboard_appointmentsTable.appendChild(dashboard_row);
                });
            }

            dashboard_prevMonthButton.onclick = () => {
                dashboard_currentMonth--;
                if (dashboard_currentMonth < 0) {
                    dashboard_currentMonth = 11;
                    dashboard_currentYear--;
                }
                updateDashboardCalendar();
            };

            dashboard_nextMonthButton.onclick = () => {
                dashboard_currentMonth++;
                if (dashboard_currentMonth > 11) {
                    dashboard_currentMonth = 0;
                    dashboard_currentYear++;
                }
                updateDashboardCalendar();
            };

            // Initialize calendar and display appointments for the default selected day
            updateDashboardCalendar();
            displayDashboardAppointments('2021-09-19');
        });
    </script>
</body>
</html>
