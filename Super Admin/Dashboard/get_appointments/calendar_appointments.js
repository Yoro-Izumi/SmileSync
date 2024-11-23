document.addEventListener("DOMContentLoaded", function() {
    const dashboard_daysContainer = document.querySelector(".dashboard_days");
    const dashboard_appointmentsTable = document.getElementById("dashboard_appointments-table");
    const dashboard_monthNameElement = document.querySelector(".dashboard_month-name");
    const dashboard_prevMonthButton = document.querySelector(".dashboard_prev-month");
    const dashboard_nextMonthButton = document.querySelector(".dashboard_next-month");

    let dashboard_currentMonth = 8; // September (0-based index)
    let dashboard_currentYear = 2021;

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
                fetchDashboardAppointments(dashboard_fullDate);
            };

            if (dashboard_fullDate === '2024-09-19') dashboard_dayElement.classList.add("dashboard_selected"); // Mark the 19th by default
            dashboard_daysContainer.appendChild(dashboard_dayElement);
        }
    }

    function fetchDashboardAppointments(dashboard_date) {
        // Use fetch to get appointments from the database via the PHP endpoint
        fetch(`get_appointments.php?date=${dashboard_date}`)
            .then(response => response.json())
            .then(data => displayDashboardAppointments(data))
            .catch(error => console.error('Error fetching appointments:', error));
    }

    function displayDashboardAppointments(appointments) {
        dashboard_appointmentsTable.innerHTML = '';
        appointments.forEach(dashboard_appointment => {
            const dashboard_row = document.createElement("tr");

            // Add a clickable link for each appointment
            dashboard_row.innerHTML = `
                <td>${dashboard_appointment.patient_first_name} ${dashboard_appointment.patient_middle_name} ${dashboard_appointment.patient_last_name} ${dashboard_appointment.patient_suffix}</td>
                <td>${dashboard_appointment.appointment_date_time}</td>
                <td class="dashboard_arrow">
                    <a href="http://localhost/SmileSync/Admin/Appointment/appointment-details.php?id=${dashboard_appointment.id}">
                        &#8250;
                    </a>
                </td>
            `;
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
    fetchDashboardAppointments('2024-09-19'); // Default to 19th of September
});
