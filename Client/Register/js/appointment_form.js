// Declare isLoading as a global variable
let isLoading = false;

document.addEventListener('DOMContentLoaded', function () {
  // Multi-step form navigation
  const formSections = document.querySelectorAll('.form-section');
  const nextButton = document.querySelector('.next-btn');
  const prevButton = document.querySelector('.prev-btn');
  const steps = document.querySelectorAll('.steps .step');
  const submitButton = document.getElementById('submitButton');
  let currentStep = 0;

  submitButton.style.display = 'none';
  prevButton.style.display = 'none'; // Initially hide the previous button

  // Function to check if all required inputs in the current section are filled
  const isCurrentSectionValid = () => {
    const inputs = formSections[currentStep].querySelectorAll('input[required]');
    return Array.from(inputs).every(input => input.value.trim() !== '');
  };

  // Update the state of the "Next" button based on input validation
  const updateNextButtonState = () => {
    nextButton.disabled = !isCurrentSectionValid();
  };

  // Attach input event listeners to validate on the fly
  formSections.forEach((section, index) => {
    const inputs = section.querySelectorAll('input[required]');
    inputs.forEach(input => {
      input.addEventListener('input', () => {
        if (index === currentStep) updateNextButtonState();
      });
    });
  });

  nextButton.addEventListener('click', () => {
    if (currentStep < formSections.length - 1 && isCurrentSectionValid()) {
      formSections[currentStep].classList.remove('active');
      steps[currentStep].classList.remove('active');
      currentStep++;
      formSections[currentStep].classList.add('active');
      steps[currentStep].classList.add('active');

      prevButton.style.display = 'block';
      submitButton.style.display = 'none';

      if (currentStep === formSections.length - 1) {
        nextButton.style.display = 'none';
        submitButton.style.display = 'block';
      } else {
        nextButton.textContent = 'Next';
        nextButton.type = 'button';
      }
      updateNextButtonState();
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

      nextButton.style.display = 'block';
      submitButton.style.display = 'none';
      nextButton.textContent = 'Next';
      nextButton.type = 'button';

      updateNextButtonState();
    }
  });

  updateNextButtonState();

  // Calendar logic
  const currentDate = new Date();
  currentDate.setHours(0, 0, 0, 0);
  const minSelectableDate = new Date();
  minSelectableDate.setDate(currentDate.getDate() + 15); // 15 days from now

  let currentMonth = currentDate.getMonth();
  let currentYear = currentDate.getFullYear();

  const monthSelect = document.getElementById('month');
  const calendarTableBody = document.querySelector('.calendar-table tbody');
  const calDayInput = document.getElementById('cal-day');

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
      const dateKey = new Date(year, month, dayCounter);
      dateKey.setHours(0, 0, 0, 0);

      const isSelectable = dateKey >= minSelectableDate;

      const cellData = {
        day: dayCounter,
        class: isSelectable ? 'selectable' : 'unavailable',
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
            cellElement.classList.add(cell.class);
          }
          row.appendChild(cellElement);
        });

        calendarTableBody.appendChild(row);
        week = [];
      }

      dayCounter++;
    }

    document.querySelectorAll('.calendar-table td').forEach((cell) => {
      cell.addEventListener('click', () => {
        if (!isLoading && !cell.classList.contains('unavailable') && cell.textContent) {
          document.querySelectorAll('.calendar-table td').forEach((td) =>
            td.classList.remove('selected-date')
          );
          cell.classList.add('selected-date');
          const selected_date = `${year}-${(month + 1).toString().padStart(2, '0')}-${cell.textContent.padStart(2, '0')}`;
          calDayInput.value = selected_date;

          isLoading = true; // Set isLoading to true while the request is in progress
          $.ajax({
            url: 'save_session_date.php',
            type: 'POST',
            data: { selected_date: selected_date },
            success: function (response) {
              console.log('Session updated:', response);
              fetch('pick_schedule_algo/get_appointment2.php')
                .then(response => response.json())
                .then(data => {
                  if (data.status === 'success') {
                    updateRecommendationsAndDropdown(data);
                  }
                })
                .catch(error => console.error('Error fetching schedule:', error))
                .finally(() => {
                  isLoading = false; // Reset isLoading after the request is complete
                });
            },
            error: function (error) {
              console.error('Error setting session:', error);
              isLoading = false; // Reset isLoading if there's an error
            },
          });
        }
      });
    });
  }

  monthSelect.addEventListener('change', function () {
    currentMonth = parseInt(this.value, 10) - 1;
    generateCalendar(currentMonth, currentYear);

    // Clear recommendations and selected date when month changes
    clearRecommendations();
    clearSelectedDate();
  });

  generateCalendar(currentMonth, currentYear);

  // Service Checkbox Logic
  const serviceDropdownToggle = document.querySelector('.dropdown-toggle');
  const serviceDropdownCheckbox = document.querySelector('.dropdown-checkbox');

  serviceDropdownToggle.addEventListener('click', function (event) {
    serviceDropdownCheckbox.classList.toggle('active');
  });

  // Close the dropdown if the user clicks outside of it
  document.addEventListener('click', function (event) {
    if (!serviceDropdownCheckbox.contains(event.target)) {
      serviceDropdownCheckbox.classList.remove('active');
    }
  });

  // jQuery to handle checkbox clicks and send data to PHP
  $(document).ready(function () {
    $('input[name="service[]"]').on('click', function () {
      const selectedServices = [];
      $('input[name="service[]"]:checked').each(function () {
        selectedServices.push($(this).val());
      });

      // Clear recommendations and selected date when services change
      clearRecommendations();
      clearSelectedDate();

      // Send selected services to PHP using AJAX
      $.ajax({
        url: 'set_session.php', // PHP script to handle saving
        type: 'POST',
        data: { services: selectedServices },
        success: function (response) {
          console.log('Services saved:', response);
        },
        error: function (error) {
          console.error('Error saving services:', error);
        }
      });
    });
  });

  // Function to clear recommendations
  function clearRecommendations() {
    const recommendationContainer = document.querySelector('.recommendation-container');
    recommendationContainer.innerHTML = ''; // Clear recommendations
    const timeDropdown = document.getElementById('time');
    timeDropdown.innerHTML = ''; // Clear available times dropdown
  }

  // Function to clear selected date
  function clearSelectedDate() {
    document.querySelectorAll('.calendar-table td').forEach((td) =>
      td.classList.remove('selected-date')
    );
    calDayInput.value = ''; // Clear the selected date input
  }

  // Confirmation Section Logic
  const form = document.getElementById('multiStepForm');
  const confirmationSection = document.querySelector('.form-section:last-child');

  form.addEventListener('input', function (event) {
    updateConfirmationSection();
  });

  function updateConfirmationSection() {
    const formData = new FormData(form);

    // Personal Information
    const firstName = formData.get('firstName');
    const lastName = formData.get('lastName');
    const middleName = formData.get('middleName');
    const suffix = formData.get('suffix');
    const birthday = formData.get('birthday');
    const sex = formData.get('sex');
    const province = formData.get('province');
    const city = formData.get('city');
    const barangay = formData.get('barangay');
    const streetAddress = formData.get('street_address');
    const phoneNumber = formData.get('phoneNumber');

    // Emergency Contact
    const emergencyContact = formData.get('emergencyContact');
    const emergencyContactNumber = formData.get('emergencyContactNumber');
    const emergencyContactRelationship = formData.get('emergencyContactRelationship');

    // Appointment Details
    const appointmentDate = formData.get('cal-day');
    const services = Array.from(formData.getAll('service[]')).join(', ');

    // Update Personal Information in Confirmation Section
    confirmationSection.querySelector('.validation-section:nth-child(1)').innerHTML = `
      <h3>Personal Information</h3>
      <div><span>Patient Name:</span> ${lastName}, ${firstName} ${middleName} ${suffix}</div>
      <div><span>Age:</span> ${calculateAge(birthday)}</div>
      <div><span>Sex:</span> ${sex}</div>
      <div><span>Address:</span> ${streetAddress}, ${barangay}, ${city}, ${province}</div>
      <div><span>Phone Number:</span> ${phoneNumber}</div>
      <div><span>Birth Date:</span> ${formatDate(birthday)}</div>
    `;

    // Update Emergency Contact in Confirmation Section
    confirmationSection.querySelector('.validation-section:nth-child(2)').innerHTML = `
      <h3>Emergency Contact</h3>
      <div><span>In case of emergency, please contact:</span> ${emergencyContact}</div>
      <div><span>Phone Number:</span> ${emergencyContactNumber}</div>
      <div><span>Relationship:</span> ${emergencyContactRelationship}</div>
    `;

    // Update Appointment Details in Confirmation Section
    confirmationSection.querySelector('.validation-section:nth-child(3)').innerHTML = `
      <h3>Appointment Details</h3>
      <div><span>Appointment Date:</span> ${formatDate(appointmentDate)}</div>
      <div><span>Procedure/s:</span> ${services}</div>
      <div><span>Dentist:</span>  </div>
      <div><span>Amount Charge:</span> </div>
    `;
  }

  function calculateAge(birthday) {
    const birthDate = new Date(birthday);
    const difference = Date.now() - birthDate.getTime();
    const ageDate = new Date(difference);
    return Math.abs(ageDate.getUTCFullYear() - 1970);
  }

  function formatDate(date) {
    const d = new Date(date);
    const month = '' + (d.getMonth() + 1);
    const day = '' + d.getDate();
    const year = d.getFullYear();

    return [month, day, year].join('/');
  }
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