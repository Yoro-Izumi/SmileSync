document.querySelectorAll('.tab').forEach(item => {
    item.addEventListener('click', function() {
        // Remove active class from all items
        document.querySelectorAll('.tab').forEach(i => i.classList.remove('active'));
        // Add active class to the clicked item
        this.classList.add('active');

        // Hide all content areas
        document.querySelectorAll('.content').forEach(content => content.style.display = 'none');

        // Show the related content
        const contentId = this.getAttribute('data-content');
        document.getElementById(contentId).style.display = 'block';
    });
});
