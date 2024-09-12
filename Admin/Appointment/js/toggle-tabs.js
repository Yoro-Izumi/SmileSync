document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        // Add active class to the clicked tab
        this.classList.add('active');

        // Hide all content areas
        document.querySelectorAll('.content').forEach(content => content.style.display = 'none');

        // Show the related content
        const contentId = this.getAttribute('data-content');
        document.getElementById(contentId).style.display = 'block';
    });
});
A