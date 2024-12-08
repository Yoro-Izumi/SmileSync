// Add event listeners to the buttons based on their IDs
document.getElementById('addServiceBtn').addEventListener('click', () => {
    createAlert('Success! The Service has been successfully added.', 'alert-success');
});

document.getElementById('removeServiceBtn').addEventListener('click', () => {
    createAlert('Deleted! Service/s has been successfully removed.', 'alert-error');
});

document.getElementById('confirmEditBtn').addEventListener('click', () => {
    createAlert('Item has been successfully edited! Changes have been saved.', 'alert-info');
});

// Function to create a new alert with a hidden timer
function createAlert(message, alertType = 'alert-info', duration = 5000) { // duration in milliseconds
    const alertContainer = document.getElementById('alertContainer');
    let icon = '';

    // Set icons based on alert type
    switch (alertType) {
        case 'alert-success':
            icon = '✔️'; // Check mark icon for success
            break;
        case 'alert-error':
            icon = '❌'; // Cross mark icon for error
            break;
        case 'alert-info':
            icon = 'ℹ️'; // Information icon for info
            break;
        default:
            icon = '⚠️'; // Warning icon for others
    }

    // Check if there are already 5 alerts, if so, remove the oldest one
    if (alertContainer.children.length >= 5) {
        alertContainer.removeChild(alertContainer.lastChild);
    }

    // Create the new alert element
    const alert = document.createElement('div');
    alert.className = `alert ${alertType}`;
    alert.innerHTML = `
        <span class="alert-icon">${icon}</span>
        <span>${message}</span>
        <span class="closebtn" onclick="closeAlert(this)">&times;</span>
    `;

    // Append the alert to the top of the container (below the Clear All button if it exists)
    const clearAllButton = document.getElementById('clearAllButton');
    if (clearAllButton) {
        alertContainer.insertBefore(alert, clearAllButton.nextSibling);
    } else {
        alertContainer.prepend(alert);
    }

    // Start the countdown timer (hidden)
    startTimer(alert, duration);

    // Show the Clear All button if there is more than one alert
    toggleClearAllButton();

    // Show a web notification
    showNotification(message, alertType);
}

// Function to start the countdown timer for an alert (hidden)
function startTimer(alert, duration) {
    let timeLeft = duration / 1000; // Convert to seconds

    const countdown = setInterval(() => {
        timeLeft -= 1;

        if (timeLeft <= 0) {
            clearInterval(countdown);
            closeAlertAutomatically(alert);
        }
    }, 1000); // Update every second
}

// Function to automatically close an alert when the timer runs out
function closeAlertAutomatically(alert) {
    alert.style.animation = 'slideOut 0.5s forwards'; // Trigger slide-out animation
    setTimeout(() => {
        alert.remove();
        toggleClearAllButton();
    }, 500); // Remove the alert after animation
}

// Function to close an individual alert when the close button is clicked
function closeAlert(closeButton) {
    const alert = closeButton.parentElement;
    alert.style.animation = 'slideOut 0.5s forwards'; // Trigger slide-out animation
    setTimeout(() => {
        alert.remove();
        toggleClearAllButton();
    }, 500); // Remove the alert after animation
}

// Function to toggle the visibility of the Clear All button and ensure it stays on top
function toggleClearAllButton() {
    const alertContainer = document.getElementById('alertContainer');
    let clearAllButton = document.getElementById('clearAllButton');

    // If more than one alert exists, show the Clear All button
    if (alertContainer.children.length > 1) {
        if (!clearAllButton) {
            clearAllButton = document.createElement('button');
            clearAllButton.id = 'clearAllButton';
            clearAllButton.textContent = 'Clear All';
            clearAllButton.onclick = clearAllAlerts;
            alertContainer.prepend(clearAllButton); // Always add the Clear All button to the top
        }
    } else if (clearAllButton) {
        clearAllButton.remove(); // Remove the Clear All button if no alerts are present
    }
}

// Function to clear all alerts
function clearAllAlerts() {
    const alertContainer = document.getElementById('alertContainer');
    Array.from(alertContainer.children).forEach((alert) => {
        if (alert.id !== 'clearAllButton') {
            alert.style.animation = 'slideOut 0.5s forwards';
            setTimeout(() => alert.remove(), 500);
        }
    });

    // Call toggleClearAllButton to ensure button state is accurate
    toggleClearAllButton();
}

// Function to show a web notification (optional)
function showNotification(message, alertType) {
    if (Notification.permission === 'granted') {
        new Notification(message, {
            icon: alertType === 'alert-success' ? 'success-icon.png' : 'error-icon.png',
        });
    }
}

// Request permission for web notifications (optional)
if (Notification.permission !== 'denied' && Notification.permission !== 'granted') {
    Notification.requestPermission();
}
