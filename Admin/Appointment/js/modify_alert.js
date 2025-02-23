// Function to create a new alert with a hidden timer
function modifyCreateAlert(message, modifyAlertType, duration) { // duration in milliseconds
    const alertContainer = document.getElementById('alertContainer');
    let icon = '';
    let bgColor = ''; // Background color for the alert

    // Set icons and colors based on alert type
    switch (modifyAlertType) {
        case 'modify-alert-success':
            icon = '✔️'; 
            bgColor = '#4CAF50'; // Green
            break;
        case 'modify-alert-error':
            icon = '❌';
            bgColor = '#F44336'; // Red
            break;
        case 'modify-alert-info':
            icon = 'ℹ️';
            bgColor = '#2196F3'; // Blue
            break;
        case 'modify-alert-warning':
            icon = '⚠️';
            bgColor = '#FF9800'; // Orange
            break;
        default:
            icon = '⚠️';
            bgColor = '#9E9E9E'; // Gray for unknown types
    }

    // Check if there are already 5 alerts, if so, remove the oldest one
    if (alertContainer.children.length >= 5) {
        alertContainer.removeChild(alertContainer.lastChild);
    }

    // Create the new alert element
    const alert = document.createElement('div');
    alert.className = `modify-alert ${modifyAlertType}`;
    alert.style.backgroundColor = bgColor; // Set background color dynamically
    alert.innerHTML = `
        <span class="modify-alert-icon">${icon}</span>
        <span>${message}</span>
        <span class="modify-closebtn" onclick="modifyCloseAlert(this)">&times;</span>
    `;

    // Append the alert to the top of the container
    const clearAllButton = document.getElementById('modifyClearAllButton');
    if (clearAllButton) {
        alertContainer.insertBefore(alert, clearAllButton.nextSibling);
    } else {
        alertContainer.prepend(alert);
    }

    // Start the countdown timer (hidden)
    modifyStartTimer(alert, duration);

    // Show the Clear All button if there is more than one alert
    modifyToggleClearAllButton();

    // Show a web notification
    modifyShowNotification(message, modifyAlertType);
}

// Function to start the countdown timer for an alert (hidden)
function modifyStartTimer(alert, duration) {
    let timeLeft = duration / 1000; // Convert to seconds

    const countdown = setInterval(() => {
        timeLeft -= 1;

        if (timeLeft <= 0) {
            clearInterval(countdown);
            modifyCloseAlertAutomatically(alert);
        }
    }, 1000); // Update every second
}

// Function to automatically close an alert when the timer runs out
function modifyCloseAlertAutomatically(alert) {
    alert.style.animation = 'slideOut 0.5s forwards'; // Trigger slide-out animation
    setTimeout(() => {
        alert.remove();
        modifyToggleClearAllButton();
    }, 500); // Remove the alert after animation
}

// Function to close an individual alert when the close button is clicked
function modifyCloseAlert(closeButton) {
    const alert = closeButton.parentElement;
    alert.style.animation = 'slideOut 0.5s forwards'; // Trigger slide-out animation
    setTimeout(() => {
        alert.remove();
        modifyToggleClearAllButton();
    }, 500); // Remove the alert after animation
}

// Function to toggle the visibility of the Clear All button and ensure it stays on top
function modifyToggleClearAllButton() {
    const alertContainer = document.getElementById('alertContainer');
    let clearAllButton = document.getElementById('modifyClearAllButton');

    // If more than one alert exists, show the Clear All button
    if (alertContainer.children.length > 1) {
        if (!clearAllButton) {
            clearAllButton = document.createElement('button');
            clearAllButton.id = 'modifyClearAllButton';
            clearAllButton.textContent = 'Clear All';
            clearAllButton.onclick = modifyClearAllAlerts;
            alertContainer.prepend(clearAllButton); // Always add the Clear All button to the top
        }
    } else if (clearAllButton) {
        clearAllButton.remove(); // Remove the Clear All button if no alerts are present
    }
}

// Function to clear all alerts
function modifyClearAllAlerts() {
    const alertContainer = document.getElementById('alertContainer');
    Array.from(alertContainer.children).forEach((alert) => {
        if (alert.id !== 'modifyClearAllButton') {
            alert.style.animation = 'slideOut 0.5s forwards';
            setTimeout(() => alert.remove(), 500);
        }
    });

    // Call modifyToggleClearAllButton to ensure button state is accurate
    modifyToggleClearAllButton();
}

// Function to show a web notification (optional)
function modifyShowNotification(message, modifyAlertType) {
    if (Notification.permission === 'granted') {
        new Notification(message, {
            icon: modifyAlertType === 'modify-alert-success' ? 'success-icon.png' : 'error-icon.png',
        });
    }
}

// Request permission for web notifications (optional)
if (Notification.permission !== 'denied' && Notification.permission !== 'granted') {
    Notification.requestPermission();
}
