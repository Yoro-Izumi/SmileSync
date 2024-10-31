document.addEventListener("DOMContentLoaded", function () {
  const monthSelect = document.getElementById("month");
  const calendarCells = document.querySelectorAll(".calendar-table td");
  const timeSelect = document.getElementById("time");
  const availableTimes = {
    '3': ['10:00 AM', '11:00 AM'],
    '11': ['2:00 PM', '3:00 PM'],
    '15': ['10:00 AM', '11:00 AM', '2:00 PM'],
    '29': ['2:00 PM', '3:00 PM']
  };

  // Disable dates that are unavailable
  function disableUnavailableDates() {
    calendarCells.forEach(cell => {
      if (cell.classList.contains('unavailable')) {
        cell.classList.add('disabled');
        cell.style.pointerEvents = 'none'; // Disable clicking
      } else {
        cell.classList.remove('disabled');
        cell.style.pointerEvents = ''; // Enable clicking
      }
    });
  }

  // Highlight selected date and update available times
  calendarCells.forEach(cell => {
    cell.addEventListener("click", function () {
      if (!this.classList.contains('unavailable') && !this.classList.contains('disabled')) {
        calendarCells.forEach(c => c.classList.remove("selected")); // Remove previous selection
        this.classList.add("selected"); // Highlight the selected date

        // Get the selected day
        const selectedDay = this.textContent.trim();
        // Update available times based on selected day
        updateAvailableTimes(selectedDay);
      }
    });
  });

  // Update available times based on the selected day
  function updateAvailableTimes(selectedDay) {
    const times = availableTimes[selectedDay] || [];

    // Clear existing options
    while (timeSelect.firstChild) {
      timeSelect.removeChild(timeSelect.firstChild);
    }

    // Populate available times
    times.forEach(time => {
      const option = document.createElement("option");
      option.value = time;
      option.textContent = time;
      timeSelect.appendChild(option);
    });

    // If no times are available, display a message
    if (times.length === 0) {
      const option = document.createElement("option");
      option.value = '';
      option.textContent = 'No available times';
      timeSelect.appendChild(option);
    }
  }

  // Update calendar when month is changed
  monthSelect.addEventListener("change", function () {
    // Logic for updating the calendar based on selected month can be added here
    // For example, you could load a different month's data
    disableUnavailableDates(); // Call to refresh the display
  });

  // Initial setup
  disableUnavailableDates(); // Initial setup to disable unavailable dates
});
