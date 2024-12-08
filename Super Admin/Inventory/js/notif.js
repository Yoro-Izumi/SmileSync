// Selecting necessary elements
const notificationBtn = document.getElementById('notificationBtn'); // The button in the sidebar
const rightPanel = document.getElementById('rightPanel'); // Notification panel
const closeRightPanel = document.getElementById('closeRightPanel');
const minimizePanel = document.getElementById('minimizePanel');
const maximizePanel = document.getElementById('maximizePanel');
const shrinkPanel = document.getElementById('shrinkPanel');

// Open/Close Notification Panel when sidebar button is clicked
notificationBtn.addEventListener('click', function(event) {
  event.preventDefault(); // Prevent default anchor behavior
  rightPanel.classList.toggle('show'); // Toggle visibility of the panel
});

// Close Panel
closeRightPanel.addEventListener('click', function() {
  rightPanel.classList.remove('show'); // Hide the panel
  rightPanel.classList.remove('maximized', 'minimized', 'shrunk'); // Reset panel states
  minimizePanel.style.display = 'none'; // Hide the minimize icon
  maximizePanel.style.display = 'block'; // Show the maximize icon
  shrinkPanel.style.display = 'none'; // Hide the shrink icon
});

// Maximize Panel
maximizePanel.addEventListener('click', function() {
  rightPanel.classList.add('maximized'); // Add the maximized class
  rightPanel.classList.remove('minimized', 'shrunk'); // Remove minimized and shrunk states
  minimizePanel.style.display = 'block'; // Show the minimize icon
  maximizePanel.style.display = 'none'; // Hide the maximize icon
  shrinkPanel.style.display = 'block'; // Show the shrink icon
});

// Minimize Panel
minimizePanel.addEventListener('click', function() {
  rightPanel.classList.add('minimized'); // Add the minimized class
  rightPanel.classList.remove('maximized', 'shrunk'); // Remove maximized and shrunk states
  minimizePanel.style.display = 'none'; // Hide the minimize icon
  maximizePanel.style.display = 'block'; // Show the maximize icon
  shrinkPanel.style.display = 'none'; // Hide the shrink icon
});

// Shrink Panel
shrinkPanel.addEventListener('click', function() {
  rightPanel.classList.add('shrunk'); // Add the shrunk class
  rightPanel.classList.remove('maximized', 'minimized'); // Remove maximized and minimized states
  minimizePanel.style.display = 'none'; // Hide the minimize icon
  maximizePanel.style.display = 'block'; // Show the maximize icon
  shrinkPanel.style.display = 'none'; // Hide the shrink icon
});
