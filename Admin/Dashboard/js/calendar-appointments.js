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

        // Initialize calendar
        updateDashboardCalendar();
        displayDashboardAppointments('2021-09-19'); // Default to 19th of September
    });