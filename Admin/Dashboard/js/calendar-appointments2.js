document.addEventListener('DOMContentLoaded', function () {
    const $dashboardDaysContainer = $(".dashboard_days");
    const $dashboardAppointmentsTable = $("#dashboard_appointments-table");
    const $dashboardMonthNameElement = $(".dashboard_month-name");
    const $dashboardPrevMonthButton = $(".dashboard_prev-month");
    const $dashboardNextMonthButton = $(".dashboard_next-month");

    const today = new Date();
    let dashboardCurrentMonth = today.getMonth(); // Current month (0-11)
    let dashboardCurrentYear = today.getFullYear(); // Current year

    // Fetch appointments for a specific month, year, and optional day
    function fetchAppointments(month, year, day = null) {
        const url = `get_appointments/get_appointments.php?month=${month + 1}&year=${year}${day ? `&day=${day}` : ""}`;
        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            success: function (appointments) {
                console.log(`Appointments fetched for ${year}-${String(month + 1).padStart(2, '0')}-${day || ''}`, appointments);
                displayDashboardAppointments(appointments);
            },
            error: function (xhr, status, error) {
                console.error("Failed to fetch appointments:", error);
            },
        });
    }

    // Update the calendar for the current month and year
    function updateDashboardCalendar() {
        $dashboardDaysContainer.empty();
        const daysInMonth = new Date(dashboardCurrentYear, dashboardCurrentMonth + 1, 0).getDate();
        const firstDayIndex = new Date(dashboardCurrentYear, dashboardCurrentMonth, 1).getDay();

        // Update month and year display
        $dashboardMonthNameElement.text(
            new Date(dashboardCurrentYear, dashboardCurrentMonth).toLocaleString("default", { month: "long", year: "numeric" })
        );

        // Add blank spans for alignment
        for (let i = 0; i < firstDayIndex; i++) {
            $dashboardDaysContainer.append("<span></span>");
        }

        // Populate the days
        for (let day = 1; day <= daysInMonth; day++) {
            const $dayElement = $("<span>").text(day);
            const isToday =
                today.getFullYear() === dashboardCurrentYear &&
                today.getMonth() === dashboardCurrentMonth &&
                today.getDate() === day;

            if (isToday) $dayElement.addClass("dashboard_current-day");

            // Add click event for fetching appointments
            $dayElement.on("click", function () {
                $(".dashboard_days span").removeClass("dashboard_selected");
                $dayElement.addClass("dashboard_selected");
                fetchAppointments(dashboardCurrentMonth, dashboardCurrentYear, day);
            });

            $dashboardDaysContainer.append($dayElement);
        }
    }

    // Display appointments in the table
    function displayDashboardAppointments(appointments) {
        $dashboardAppointmentsTable.empty();

        if (appointments.length === 0) {
            $dashboardAppointmentsTable.append("<tr><td colspan='3'>No appointments found</td></tr>");
            return;
        }

        appointments.forEach((appointment) => {
            const $row = $("<tr>");
            $row.append($("<td>").text(appointment.name));
            $row.append($("<td>").text(appointment.time));
            $row.append(
                $("<td>")
                    .addClass("dashboard_arrow")
                    .append(
                        $("<a>")
                            .addClass("appointment-detail")
                            .attr("href", "#")
                            .attr("data-appointment-id", appointment.id)
                            .html("&#8250;")
                            .on("click", function (event) {
                                event.preventDefault();
                                selectAppointment($(this).data("appointment-id"));
                            })
                    )
            );
            $dashboardAppointmentsTable.append($row);
        });
    }

    // Select a specific appointment
    function selectAppointment(appointmentId) {
        $.ajax({
            url: "get_appointments/get_appointments.php",
            method: "POST",
            data: { appointment_id: appointmentId },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    window.location.href = "http://localhost/SmileSync/Admin/Appointment/appointment-details.php?tab=upcoming-appointments";
                }
            },
            error: function (xhr, status, error) {
                console.error("Failed to select appointment:", error);
            },
        });
    }

    // Event listeners for navigation buttons
    $dashboardPrevMonthButton.on("click", function () {
        dashboardCurrentMonth--;
        if (dashboardCurrentMonth < 0) {
            dashboardCurrentMonth = 11;
            dashboardCurrentYear--;
        }
        updateDashboardCalendar();
        fetchAppointments(dashboardCurrentMonth, dashboardCurrentYear);
    });

    $dashboardNextMonthButton.on("click", function () {
        dashboardCurrentMonth++;
        if (dashboardCurrentMonth > 11) {
            dashboardCurrentMonth = 0;
            dashboardCurrentYear++;
        }
        updateDashboardCalendar();
        fetchAppointments(dashboardCurrentMonth, dashboardCurrentYear);
    });

    // Initialize the dashboard
    updateDashboardCalendar();
    fetchAppointments(dashboardCurrentMonth, dashboardCurrentYear);
});
