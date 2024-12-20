document.addEventListener('DOMContentLoaded', function () {
  // Multi-step form navigation
  const formSections = document.querySelectorAll('.form-section');
  const nextButton = document.querySelector('.next-btn');
  const prevButton = document.querySelector('.prev-btn');
  const steps = document.querySelectorAll('.steps .step');
  let currentStep = 0;

  nextButton.addEventListener('click', () => {
    if (currentStep < formSections.length - 1) {
      formSections[currentStep].classList.remove('active');
      steps[currentStep].classList.remove('active');
      currentStep++;
      formSections[currentStep].classList.add('active');
      steps[currentStep].classList.add('active');
      prevButton.style.display = 'block';
    }
    if (currentStep === formSections.length - 1) {
      nextButton.textContent = 'Submit';
      nextButton.id = 'Submit';
      nextButton.name = 'Submit';
      nextButton.type = 'submit';
    }
  });

  prevButton.addEventListener('click', () => {
    if (currentStep > 0) {
      formSections[currentStep].classList.remove('active');
      steps[currentStep].classList.remove('active');
      currentStep--;
      formSections[currentStep].classList.add('active');
      steps[currentStep].classList.add('active');
      if (currentStep === 0) {
        prevButton.style.display = 'none';
      }
    }
    nextButton.textContent = 'Next';
  });

  // Calendar logic
  const recommendedDates = {
    '2024-8-3': true,
    '2024-8-14': true,
    // Add more dates here as needed
  };

  const unavailableDates = {
    '2024-8-7': true,
    '2024-8-20': true,
    // Add more dates here as needed
  };

  const currentDate = new Date();
  let currentMonth = currentDate.getMonth(); // 0-11
  let currentYear = currentDate.getFullYear();

  const monthSelect = document.getElementById('month');
  const calendarTableBody = document.querySelector('.calendar-table tbody');
  const calDayInput = document.getElementById('cal-day'); // Input field to update

  // Function to generate the calendar
  function generateCalendar(month, year) {
    // Clear the calendar table
    calendarTableBody.innerHTML = '';

    // Days in the selected month
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    // First day of the month (0-6, Sunday-Saturday)
    const firstDayOfMonth = new Date(year, month, 1).getDay();

    let dayCounter = 1;
    let week = [];

    // Fill empty cells for the first week
    for (let i = 0; i < firstDayOfMonth; i++) {
      week.push('');
    }

    // Fill the calendar with days
    while (dayCounter <= daysInMonth) {
      const dateKey = `${year}-${month + 1}-${dayCounter}`;

      const cellData = {
        day: dayCounter,
        class:
          recommendedDates[dateKey] ? 'recommended' : 
          unavailableDates[dateKey] ? 'unavailable' : 
          '',
      };

      week.push(cellData);

      if (week.length === 7 || dayCounter === daysInMonth) {
        // Fill the remaining cells for the last week
        while (week.length < 7) {
          week.push('');
        }

        // Add the week to the table
        const row = document.createElement('tr');
        week.forEach((cell) => {
          const cellElement = document.createElement('td');
          if (cell) {
            cellElement.textContent = cell.day;
            if (cell.class) {
              cellElement.classList.add(cell.class);
            }
          }
          row.appendChild(cellElement);
        });

        calendarTableBody.appendChild(row);
        week = [];
      }

      dayCounter++;
    }

    // Attach click event for date selection after table is generated
    document.querySelectorAll('.calendar-table td').forEach((cell) => {
      cell.addEventListener('click', () => {
        document.querySelectorAll('.calendar-table td').forEach((td) =>
          td.classList.remove('selected-date')
        );
        if (!cell.classList.contains('unavailable') && cell.textContent) {
          cell.classList.add('selected-date');
          // Update the input field with the selected date
          const selected_date = `${year}-${(month + 1).toString().padStart(2, '0')}-${cell.textContent.padStart(2, '0')}`;
          calDayInput.value = selected_date;

          // Set the date as a PHP session value via AJAX
          $.ajax({
            url: 'save_session_date.php', // PHP file to handle the session
            type: 'POST',
            data: { selected_date: selected_date },
            success: function (response) {
              console.log('Session updated:', response);
              
            },
            error: function (xhr, status, error) {
              console.error('Error setting session:', error);
            },
          });
        }
      });
    });
  }

  // Event listener for the month selector
  monthSelect.addEventListener('change', function () {
    currentMonth = parseInt(this.value, 10) - 1;
    generateCalendar(currentMonth, currentYear);
  });

  // Initial calendar generation
  generateCalendar(currentMonth, currentYear);
});


// Initialize Session Value when item in dropdown (list of services) is clicked
$(document).ready(function(){
  // Event listener for dropdown change
  $('#services').change(function(){
      // Get selected value
      var service_id = $(this).val();
      
      if (service_id) {
          // Make AJAX call to send value to PHP session
          $.ajax({
              url: 'set_session.php',  // PHP file that will handle the session
              type: 'POST',
              data: { service_id: service_id },
              success: function(response) {
                  // Show response (optional)
                  $('#selectedValue').html(response);
              },
              error: function(xhr, status, error) {
                  console.log("AJAX error: " + error);
              }
          });
      }
  });
});

