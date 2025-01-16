document.addEventListener('DOMContentLoaded', function () {
  // Multi-step form navigation
const formSections = document.querySelectorAll('.form-section');
const nextButton = document.querySelector('.next-btn');
const prevButton = document.querySelector('.prev-btn');
const steps = document.querySelectorAll('.steps .step');
const submitButton = document.getElementById('submitButton');
let currentStep = 0;

submitButton.style.display = 'none';

nextButton.addEventListener('click', (e) => {
  // Prevent form submission on intermediate steps
  if (currentStep < formSections.length - 1) {
    //e.preventDefault();
    
    formSections[currentStep].classList.remove('active');
    steps[currentStep].classList.remove('active');
    currentStep++;
    formSections[currentStep].classList.add('active');
    steps[currentStep].classList.add('active');
    prevButton.style.display = 'block';
    submitButton.style.display = 'none';

    // Update the button for the final step
    if (currentStep === formSections.length - 1) {
      //nextButton.textContent = 'Submit';
      //nextButton.id = 'Submit';
      //nextButton.name = 'Submit';
      //nextButton.type = 'submit';
      nextButton.style.display = 'none';
      submitButton.style.display = 'block';
      
    }
    else {
      nextButton.textContent = 'Next';
      nextButton.type = 'button'; // Reset type to button for non-final steps
    }
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

    nextButton.textContent = 'Next';
    nextButton.type = 'button'; // Reset type to button for non-final steps
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

  let isLoading = false; // Flag to track the loading state

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
      // Disable clicking while loading
      if (isLoading) {
        cell.style.pointerEvents = 'none'; // Disable clicks
      } else {
        cell.style.pointerEvents = 'auto'; // Enable clicks
      }

      cell.addEventListener('click', () => {
        if (!isLoading && !cell.classList.contains('unavailable') && cell.textContent) {
          document.querySelectorAll('.calendar-table td').forEach((td) =>
            td.classList.remove('selected-date')
          );
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

              // Fetch recommended schedule and available times after selecting the date
              isLoading = true; // Set loading state to true
              fetch('pick_schedule_algo/get_appointment.php')
                .then(response => {
                  if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                  }
                  return response.json();
                })
                .then(data => {
                  if (data.status !== 'success') {
                    throw new Error('Failed to retrieve schedule data: ' + (data.message || 'Unknown error'));
                  }

                  // Update the UI with the fetched data
                  updateRecommendationsAndDropdown(data);
                })
                .catch(error => {
                  console.error('Error fetching schedule:', error);
                })
                .finally(() => {
                  isLoading = false; // Reset loading state after data is loaded
                  // Re-enable date click events
                  document.querySelectorAll('.calendar-table td').forEach((cell) => {
                    cell.style.pointerEvents = 'auto'; // Re-enable clicks
                  });
                });
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

// Function to update the recommended schedule and available times
function updateRecommendationsAndDropdown(response) {
  // Check for success status
  if (response.status !== "success") {
    console.error("Error: " + (response.message || "Unknown error"));
    return;
  }

  // Parse the recommended schedule and available times
  const recommendations = response.recommended_schedule;
  const availableTimes = response.available_times;
  const predictedDurations = response.predicted_durations;

  // Update the recommendation container
  const recommendationContainer = document.querySelector('.recommendation-container');
  let recommendationHTML = `<h3>Recommended Dates & Times (Predicted Duration: ${predictedDurations} minutes)</h3>`;
  recommendations.forEach((dateTime) => {
    const [date, time] = dateTime.split(' ');
    recommendationHTML += `<p>Date: ${formatDate(date)}<br>Time: ${formatTime(time)}</p>`;
  });
  recommendationContainer.innerHTML = recommendationHTML;

  // Update the dropdown options for available times
  const timeDropdown = document.getElementById('time');
  timeDropdown.innerHTML = ''; // Clear existing options
  availableTimes.forEach((dateTime) => {
    const [, time] = dateTime.split(' ');
    timeDropdown.innerHTML += `<option value="${time}">${formatTime(time)}</option>`;
  });
}

// Utility function to format the date
function formatDate(dateStr) {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  const date = new Date(dateStr);
  return date.toLocaleDateString(undefined, options);
}

// Utility function to format the time
function formatTime(timeStr) {
  const [hour, minute] = timeStr.split(':').map(Number);
  const amPm = hour >= 12 ? 'PM' : 'AM';
  const formattedHour = hour % 12 || 12;
  return `${formattedHour}:${minute.toString().padStart(2, '0')} ${amPm}`;
}

$(document).ready(function () {
  // Trigger form submission when the Submit button is clicked
  $("#submitButton").on("click", function (e) {
    e.preventDefault(); // Prevent the default button behavior

    const form = $("#multiStepForm"); // Target the form
    const formData = form.serialize(); // Serialize all form data

    $.ajax({
      url: "register_code.php", // PHP file to handle insertion
      type: "POST",
      data: formData,
      success: function (response) {
        // Handle success response
        //alert("Appointment successfully added: " + response);
        form[0].reset(); // Reset the form
        location.href = "https://smilesync.site/SmileSync/Client/LogIn-Page"; // Redirect to the desired page
      },
      error: function (xhr, status, error) {
        // Handle error response
        //console.error("Error: " + error);
        //alert("An error occurred while adding the appointment.");
      },
    });
  });
});
