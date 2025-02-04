document.addEventListener("DOMContentLoaded", function() {
    const formSections = document.querySelectorAll('.resched-form-section');
    const steps = document.querySelectorAll('.resched-steps .resched-step');
    const nextButton = document.querySelector('.resched-next-btn');
    const prevButton = document.querySelector('.resched-prev-btn');
    const submitButton = document.getElementById('resched-submitButton');
    let currentStep = 0;

    function showStep(step) {
        if (formSections[step]) {
            formSections.forEach(section => section.classList.remove('active'));
            formSections[step].classList.add('active');
        }

        if (steps[step]) {
            steps.forEach(s => s.classList.remove('active'));
            steps[step].classList.add('active');
        }

        if (prevButton) prevButton.style.display = step === 0 ? 'none' : 'inline-block';
        if (nextButton) nextButton.style.display = step === formSections.length - 1 ? 'none' : 'inline-block';
        if (submitButton) submitButton.style.display = step === formSections.length - 1 ? 'inline-block' : 'none';
    }

    if (nextButton) {
        nextButton.addEventListener("click", function() {
            console.log("Next button clicked");
            console.log("Current Step:", currentStep);
            if (currentStep < formSections.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        });
    }

    if (prevButton) {
        prevButton.addEventListener("click", function() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    }

    showStep(currentStep);




  // Calendar Logic
  const newRecommendedDates = {
    '2024-8-3': true,
    '2024-8-14': true,
  };

  const newUnavailableDates = {
    '2024-8-7': true,
    '2024-8-20': true,
  };

  const newCurrentDate = new Date();
  let newCurrentMonth = newCurrentDate.getMonth();
  let newCurrentYear = newCurrentDate.getFullYear();

  const newMonthSelect = document.getElementById('resched-month');
  const newCalendarTableBody = document.querySelector('.resched-calendar-table tbody');
  const newCalDayInput = document.getElementById('resched-cal-day');
  let newIsLoading = false;

  function newGenerateCalendar(newMonth, newYear) {
    newCalendarTableBody.innerHTML = '';

    const newDaysInMonth = new Date(newYear, newMonth + 1, 0).getDate();
    const newFirstDayOfMonth = new Date(newYear, newMonth, 1).getDay();
    let newDayCounter = 1;
    let newWeek = [];

    for (let i = 0; i < newFirstDayOfMonth; i++) {
      newWeek.push('');
    }

    while (newDayCounter <= newDaysInMonth) {
      const newDateKey = `${newYear}-${newMonth + 1}-${newDayCounter}`;

      const newCellData = {
        day: newDayCounter,
        class:
          newRecommendedDates[newDateKey] ? 'resched-recommended' :
          newUnavailableDates[newDateKey] ? 'resched-unavailable' : 'resched-choice',
      };

      newWeek.push(newCellData);

      if (newWeek.length === 7 || newDayCounter === newDaysInMonth) {
        while (newWeek.length < 7) {
          newWeek.push('');
        }

        const newRow = document.createElement('tr');
        newWeek.forEach((newCell) => {
          const newCellElement = document.createElement('td');
          if (newCell) {
            newCellElement.textContent = newCell.day;
            if (newCell.class) {
              newCellElement.classList.add(newCell.class);
            }
          }
          newRow.appendChild(newCellElement);
        });

        newCalendarTableBody.appendChild(newRow);
        newWeek = [];
      }

      newDayCounter++;
    }

    document.querySelectorAll('.resched-calendar-table td').forEach((newCell) => {
      newCell.style.pointerEvents = newIsLoading ? 'none' : 'auto';

      newCell.addEventListener('click', () => {
        if (!newIsLoading && !newCell.classList.contains('resched-unavailable') && newCell.textContent) {
          document.querySelectorAll('.resched-calendar-table td').forEach((newTd) =>
            newTd.classList.remove('resched-selected-date')
          );
          newCell.classList.add('resched-selected-date');
          const newSelectedDate = `${newYear}-${(newMonth + 1).toString().padStart(2, '0')}-${newCell.textContent.padStart(2, '0')}`;
          newCalDayInput.value = newSelectedDate;

          $.ajax({
            url: 'save_session_date.php',
            type: 'POST',
            data: { selected_date: newSelectedDate },
            success: function (newResponse) {
              console.log('Session updated:', newResponse);

              newIsLoading = true;
              fetch('pick_schedule_algo/get_appointment.php')
                .then(newResponse => {
                  if (!newResponse.ok) {
                    throw new Error('Network response was not ok: ' + newResponse.statusText);
                  }
                  return newResponse.json();
                })
                .then(newData => {
                  if (newData.status !== 'success') {
                    throw new Error('Failed to retrieve schedule data: ' + (newData.message || 'Unknown error'));
                  }
                  newUpdateRecommendationsAndDropdown(newData);
                })
                .catch(newError => {
                  console.error('Error fetching schedule:', newError);
                })
                .finally(() => {
                  newIsLoading = false;
                  document.querySelectorAll('.resched-calendar-table td').forEach((newCell) => {
                    newCell.style.pointerEvents = 'auto';
                  });
                });
            },
            error: function (newXhr, newStatus, newError) {
              console.error('Error setting session:', newError);
            },
          });
        }
      });
    });
  }

  if (newMonthSelect) {
    newMonthSelect.value = newCurrentMonth + 1;
    newMonthSelect.addEventListener('change', function () {
      newCurrentMonth = parseInt(this.value, 10) - 1;
      newGenerateCalendar(newCurrentMonth, newCurrentYear);
    });
  }

  newGenerateCalendar(newCurrentMonth, newCurrentYear);

  function newUpdateRecommendationsAndDropdown(response) {
    if (response.status !== "success") {
      console.error("Error: " + (response.message || "Unknown error"));
      return;
    }

    const newRecommendations = response.recommended_schedule;
    const newAvailableTimes = response.available_times;
    const newPredictedDurations = response.predicted_durations;

    const newRecommendationContainer = document.querySelector('.resched-recommendation-container');
    let newRecommendationHTML = `<h3>Recommended Dates & Times (Predicted Duration: ${newPredictedDurations} minutes)</h3>`;
    newRecommendations.forEach((dateTime) => {
      const [date, time] = dateTime.split(' ');
      newRecommendationHTML += `<p>Date: ${formatDate(date)}<br>Time: ${formatTime(time)}</p>`;
    });
    newRecommendationContainer.innerHTML = newRecommendationHTML;

    const newTimeDropdown = document.getElementById('resched-time');
    newTimeDropdown.innerHTML = '';
    newAvailableTimes.forEach((dateTime) => {
      const [, time] = dateTime.split(' ');
      newTimeDropdown.innerHTML += `<option value="${time}">${formatTime(time)}</option>`;
    });
  }

  function formatDate(dateStr) {
    const newOptions = { year: 'numeric', month: 'long', day: 'numeric' };
    const newDate = new Date(dateStr);
    return newDate.toLocaleDateString(undefined, newOptions);
  }

  function formatTime(timeStr) {
    const [hour, minute] = timeStr.split(':').map(Number);
    const newAmPm = hour >= 12 ? 'PM' : 'AM';
    const newFormattedHour = hour % 12 || 12;
    return `${newFormattedHour}:${minute.toString().padStart(2, '0')} ${newAmPm}`;
  }





});
