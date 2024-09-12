document.addEventListener('DOMContentLoaded', function () {
    const chatBody = document.getElementById('chatBody');
    const sendButton = document.getElementById('sendButton');
    const messageInput = document.getElementById('messageInput');
    const quickReplies = document.querySelectorAll('.quick-reply');

    // Append message function
    function appendMessage(text, type) {
        const message = document.createElement('div');
        message.classList.add('message', type);

        const messageText = document.createElement('p');
        messageText.textContent = text;
        message.appendChild(messageText);

        const time = document.createElement('span');
        time.classList.add('message-time');
        const now = new Date();
        time.textContent = now.getHours() + ':' + ('0' + now.getMinutes()).slice(-2);
        message.appendChild(time);

        if (type === 'sent') {
            const readIndicator = document.createElement('span');
            readIndicator.classList.add('read-indicator');
            readIndicator.textContent = '✔️'; // Read receipt
            message.appendChild(readIndicator);
        }

        chatBody.appendChild(message);
        chatBody.scrollTop = chatBody.scrollHeight; // Auto-scroll to the bottom
    }

    // Send button click event
    sendButton.addEventListener('click', function () {
        const messageText = messageInput.value.trim();
        if (messageText) {
            appendMessage(messageText, 'sent');
            messageInput.value = ''; // Clear input field

            // Simulate chatbot response
            setTimeout(function () {
                appendMessage('Thank you for your message!', 'received');
            }, 1000);
        }
    });

    // Send message on Enter key press
    messageInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            sendButton.click();
        }
    });

    // Define responses for quick replies
    const quickReplyResponses = {
        'Check account status': 'Your account status is active.',
        'Reset my password': 'Please follow the instructions sent to your email to reset your password.',
        'Contact support': 'Our support team will reach out to you shortly.',
        'Operating hours': 'Our operating hours are from 9 AM to 6 PM, Monday to Friday.'
    };

    // Handle quick replies
    quickReplies.forEach(button => {
        button.addEventListener('click', function (event) {
            const replyText = event.target.getAttribute('data-reply-text');
            appendMessage(replyText, 'sent');

            // Simulate chatbot response for quick replies
            setTimeout(function () {
                const responseText = quickReplyResponses[replyText] || 'I\'m not sure how to respond to that.';
                appendMessage(responseText, 'received');
            }, 1000);
        });
    });

    // Add chatbot intro
    function addChatbotIntro() {
        const introMessage = "Hello! How can I assist you today? Here are some quick replies to get started.";
        appendMessage(introMessage, 'received');
    }

    // Trigger the chatbot intro after the DOM is fully loaded
    setTimeout(function () {
        addChatbotIntro();
    }, 500); // Delayed for smooth appearance

});
