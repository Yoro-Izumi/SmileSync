// Wait for the DOM to load
document.addEventListener("DOMContentLoaded", function () {
    // Get all the tabs
    const tabs = document.querySelectorAll('.tab');
    
    // Loop through each tab and add a click event listener
    tabs.forEach(tab => {
      tab.addEventListener('click', function () {
        // Get the target content ID
        const targetContent = this.getAttribute('data-content');
        
        // Remove 'active' class from all tabs and contents
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.content').forEach(content => content.classList.remove('active'));
        
        // Add 'active' class to the clicked tab and corresponding content
        this.classList.add('active');
        document.getElementById(targetContent).classList.add('active');
        
        // Optionally, show the content with a fade-in effect (style)
        document.querySelectorAll('.content').forEach(content => content.style.display = 'none');
        document.getElementById(targetContent).style.display = 'block';
      });
    });
  });