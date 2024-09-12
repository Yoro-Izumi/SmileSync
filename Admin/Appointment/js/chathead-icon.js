document.addEventListener('DOMContentLoaded', function () {
    const chatContainer = document.querySelector('.chat-container');
    const closeBtn = document.querySelector('.close-btn');
    const openChatBtn = document.getElementById('chatbotBtn');

    // Close chat
    closeBtn.addEventListener('click', function () {
        closeChat();
    });

    // Open Chat Button functionality
    openChatBtn.addEventListener('click', function () {
        openChat();
    });

    // Function to show chat with animation
    function openChat() {
        chatContainer.style.display = 'flex'; // Show chat container
        setTimeout(() => {
            chatContainer.classList.add('active'); // Add active class for animation
        }, 10); // Smooth transition after display is set to flex
    }

    // Function to close chat
    function closeChat() {
        chatContainer.classList.remove('active'); // Remove active class for closing animation
        setTimeout(() => {
            chatContainer.style.display = 'none'; // Hide the chat container after animation
        }, 500); // Match the duration of the closing transition
    }
});
