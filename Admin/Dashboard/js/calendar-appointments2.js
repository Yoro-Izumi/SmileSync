document.addEventListener("DOMContentLoaded", function() {
    const dashboard_daysContainer = document.querySelector(".dashboard_days");
    const dashboard_appointmentsTable = document.getElementById("dashboard_appointments-table");
    const dashboard_monthNameElement = document.querySelector(".dashboard_month-name");
    const dashboard_prevMonthButton = document.querySelector(".dashboard_prev-month");
    const dashboard_nextMonthButton = document.querySelector(".dashboard_next-month");

    // Set the current date
    const today = new Date();
    let dashboard_currentMonth = today.getMonth(); // Current month (0-11)
    let dashboard_currentYear = today.getFullYear(); // Current year (e.g., 2024)

    // Function to fetch appointments from the server based on the current month and year
    function fetchAppointments(month, year) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `get_appointments.php?month=${month + 1}&year=${year}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const appointments = JSON.parse(xhr.responseText);
                displayDashboardAppointments(appointments);
            }
        };
        xhr.send();
    }

    // Update the calendar to display the correct days for the selected month
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
                fetchAppointments(dashboard_currentMonth, dashboard_currentYear); // Fetch appointments for selected day
            };

            dashboard_daysContainer.appendChild(dashboard_dayElement);
        }
    }

    // Display the appointments in the table
    function displayDashboardAppointments(appointments) {
        dashboard_appointmentsTable.innerHTML = '';
        const appointmentsByDate = {};

        appointments.forEach(appointment => {
            const appointmentDate = appointment.appointment_date;
            if (!appointmentsByDate[appointmentDate]) {
                appointmentsByDate[appointmentDate] = [];
            }
            appointmentsByDate[appointmentDate].push(appointment);
        });

        for (const date in appointmentsByDate) {
            const appointmentsForDate = appointmentsByDate[date];
            appointmentsForDate.forEach(appointment => {
                const dashboard_row = document.createElement("tr");
                dashboard_row.innerHTML = `
                    <td>${appointment.name}</td>
                    <td>${appointment.time}</td>
                    <td class="dashboard_arrow">
                        <a href="#" class="appointment-detail" data-appointment-id="${appointment.id}">
                            &#8250;
                        </a>
                    </td>
                `;
                dashboard_appointmentsTable.appendChild(dashboard_row);
            });
        }

        // Add event listeners to the appointment links
        const appointmentLinks = document.querySelectorAll('.appointment-detail');
        appointmentLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const appointmentId = link.getAttribute('data-appointment-id');
                selectAppointment(appointmentId);
            });
        });
    }

    // Select the appointment and send AJAX to set session variable
    function selectAppointment(appointmentId) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "get_appointments.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    window.location.href = "http://localhost/SmileSync/Admin/Appointment/appointment-details.php?tab=upcoming-appointments";
                }
            }
        };
        xhr.send("appointment_id=" + appointmentId);
    }

    // Event listeners for navigating the calendar
    dashboard_prevMonthButton.onclick = () => {
        dashboard_currentMonth--;
        if (dashboard_currentMonth < 0) {
            dashboard_currentMonth = 11;
            dashboard_currentYear--;
        }
        updateDashboardCalendar();
        fetchAppointments(dashboard_currentMonth, dashboard_currentYear); // Fetch appointments for the new month
    };

    dashboard_nextMonthButton.onclick = () => {
        dashboard_currentMonth++;
        if (dashboard_currentMonth > 11) {
            dashboard_currentMonth = 0;
            dashboard_currentYear++;
        }
        updateDashboardCalendar();
        fetchAppointments(dashboard_currentMonth, dashboard_currentYear); // Fetch appointments for the new month
    };

    // Initialize calendar and fetch current month's appointments
    updateDashboardCalendar();
    fetchAppointments(dashboard_currentMonth, dashboard_currentYear); // Fetch appointments for the current month
});
