document.addEventListener('DOMContentLoaded', function () {
  // Multi-step form navigation
    const formSections = document.querySelectorAll('.new-form-section');
    const nextButton = document.getElementById('new-next-btn');
    const prevButton = document.getElementById('new-prev-btn');
    const steps = document.querySelectorAll('.steps .step');
    const submitButton = document.getElementById('newSubmitButton');
    let currentStep = 0;
  
    submitButton.style.display = 'none';
  
    // Show the first section
    formSections[currentStep].classList.add('active');
    steps[currentStep].classList.add('active');
  
    // Event listener for next button
    nextButton.addEventListener('click', (e) => {
      // Prevent form submission on intermediate steps
      if (currentStep < formSections.length - 1) {
        formSections[currentStep].classList.remove('active');
        steps[currentStep].classList.remove('active');
        currentStep++;
        formSections[currentStep].classList.add('active');
        steps[currentStep].classList.add('active');
        prevButton.style.display = 'block';
        submitButton.style.display = 'none';
  
        // Update the button for the final step
        if (currentStep === formSections.length - 1) {
          nextButton.style.display = 'none';
          submitButton.style.display = 'block';
        } else {
          nextButton.textContent = 'Next';
          nextButton.type = 'button'; // Reset type to button for non-final steps
        }
      }
    });
  
    // Event listener for previous button
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
  
    // Hide previous button on first step
    if (currentStep === 0) {
      prevButton.style.display = 'none';
    }
  
  

  // Generalized function to toggle address fields based on user selection
  function toggleAddressField(fieldId, conditionId) {
    const addressField = document.getElementById(fieldId);
    const isYesSelected = document.getElementById(conditionId).checked;
    addressField.style.display = isYesSelected ? "block" : "none";
  }

  // Calendar logic
  const recommendedDates = {
    '2024-8-3': true,
    '2024-8-14': true,
  };

  const unavailableDates = {
    '2024-8-7': true,
    '2024-8-20': true,
  };

  const currentDate = new Date();
  let currentMonth = currentDate.getMonth();
  let currentYear = currentDate.getFullYear();

  const monthSelect = document.getElementById('month');
  const calendarTableBody = document.querySelector('.newCalendar-table tbody');
  const calDayInput = document.getElementById('cal-day');
  let isLoading = false;

  function generateCalendar(month, year) {
    calendarTableBody.innerHTML = '';
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const firstDayOfMonth = new Date(year, month, 1).getDay();
    let dayCounter = 1;
    let week = [];

    for (let i = 0; i < firstDayOfMonth; i++) {
      week.push('');
    }

    while (dayCounter <= daysInMonth) {
      const dateKey = `${year}-${month + 1}-${dayCounter}`;
      const cellData = {
        day: dayCounter,
        class: recommendedDates[dateKey] ? 'recommended' : unavailableDates[dateKey] ? 'unavailable' : '',
      };
      week.push(cellData);

      if (week.length === 7 || dayCounter === daysInMonth) {
        while (week.length < 7) {
          week.push('');
        }

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

    document.querySelectorAll('.newCalendar-table td').forEach((cell) => {
      if (isLoading) {
        cell.style.pointerEvents = 'none';
      } else {
        cell.style.pointerEvents = 'auto';
      }

      cell.addEventListener('click', () => {
        if (!isLoading && !cell.classList.contains('unavailable') && cell.textContent) {
          document.querySelectorAll('.newCalendar-table td').forEach((td) =>
            td.classList.remove('selected-date')
          );
          cell.classList.add('selected-date');
          const selected_date = `${year}-${(month + 1).toString().padStart(2, '0')}-${cell.textContent.padStart(2, '0')}`;
          calDayInput.value = selected_date;

          $.ajax({
            url: 'save_session_date.php',
            type: 'POST',
            data: { selected_date: selected_date },
            success: function (response) {
              console.log('Session updated:', response);
              isLoading = true;
              fetch('pick_schedule_algo/get_appointment.php')
                .then(response => response.json())
                .then(data => {
                  if (data.status === 'success') {
                    updateRecommendationsAndDropdown(data);
                  }
                })
                .catch(error => console.error('Error fetching schedule:', error))
                .finally(() => {
                  isLoading = false;
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

  monthSelect.addEventListener('change', function () {
    currentMonth = parseInt(this.value, 10) - 1;
    generateCalendar(currentMonth, currentYear);
  });

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
  $("#newSubmitButton").on("click", function (e) {
    e.preventDefault(); // Prevent the default button behavior

    const form = $("#newMultiStepForm"); // Target the form
    const formData = form.serialize(); // Serialize all form data

    $.ajax({
      url: "appointment_crud/appointment_add_new.php", // PHP file to handle insertion
      type: "POST",
      data: formData,
      success: function (response) {
        // Handle success response
        //alert("Appointment successfully added: " + response);
        form[0].reset(); // Reset the form
      },
      error: function (xhr, status, error) {
        // Handle error response
        //console.error("Error: " + error);
        //alert("An error occurred while adding the appointment.");
      },
    });
  });
});
