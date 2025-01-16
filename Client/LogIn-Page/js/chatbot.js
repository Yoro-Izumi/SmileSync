document.addEventListener('DOMContentLoaded', function () {
  const quickReplies = document.querySelectorAll('.quick-reply');
  const chatBody = document.querySelector(".chat-body");
  const messageInput = document.querySelector(".message-input");
  const sendMessage = document.querySelector("#send-message");
  const fileInput = document.querySelector("#file-input");
  const fileUploadWrapper = document.querySelector(".file-upload-wrapper");
  const fileCancelButton = fileUploadWrapper.querySelector("#file-cancel");
  const chatbotToggler = document.querySelector("#chatbot-toggler");
  const closeChatbot = document.querySelector("#close-chatbot");

// API setup
const API_KEY = "AIzaSyAApsgnlU1snrNoppwLHU3OxTEaLKp4q58";
const API_URL = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=${API_KEY}`;

// Initialize user message and file data
const userData = {
message: null,
file: {
  data: null,
  mime_type: null,
},
};

const chatHistory = [
  {
    role: "model",
    parts: [
      { text: `Greetings as SmileSync when greeted` },
      { text: `Just answer the questions with specific answers` },
      { text: `Question: Who are you?` },
      { text: `The answer: I am SmileSync! An appointment system.` },
      { text: `Question: Where to register?` },
      { text: `Answer: Just click the "Go to Appointment link above."` },
      { text: `Question: Are you part of iMee Toga Dental Clinic` },
      { text: `Answer: Yes we are from Imee Toga Dental` },
      { text: `Question: Do I need to go to the register page to get appointment when I already have an account?` },
      { text: `Answer: No, you do not have to go to the register page, you can simply book an appointment inside your SmileSync account.` },
      { text: `Question: Can I directly talk to a person here in this chatbot?` },
      { text: `Answer: Unfortunately, you can only interact with the chatbot. ` },
      //{ text: `Question:` }
      //{ text: `Answer:` }
      // { text: `` }//never leave an empty parameter 
      ],
  },
  ];

const initialInputHeight = messageInput.scrollHeight;

// Create message element with dynamic classes and return it
const createMessageElement = (content, ...classes) => {
const div = document.createElement("div");
div.classList.add("message", ...classes);
div.innerHTML = content;
return div;
};

// Generate bot response using API
const generateBotResponse = async (incomingMessageDiv) => {
const messageElement = incomingMessageDiv.querySelector(".message-text");

// Line 40
chatHistory.push({
role: "user",
parts: [{ text: `Using the details provided above, please address this query: ${userData.message}` }, ...(userData.file.data ? [{ inline_data: userData.file }] : [])],
});


// API request options
const requestOptions = {
  method: "POST",
  headers: { "Content-Type": "application/json" },
  body: JSON.stringify({
    contents: chatHistory,
  }),
};

try {
  // Fetch bot response from API
  const response = await fetch(API_URL, requestOptions);
  const data = await response.json();
  if (!response.ok) throw new Error(data.error.message);

  // Extract and display bot's response text
  const apiResponseText = data.candidates[0].content.parts[0].text.replace(/\*\*(.*?)\*\*/g, "$1").trim();
  messageElement.innerText = apiResponseText;

  // Add bot response to chat history
  chatHistory.push({
    role: "model",
    parts: [{ text: apiResponseText }],
  });
} catch (error) {
  // Handle error in API response
  console.log(error);
  messageElement.innerText = error.message;
  messageElement.style.color = "#ff0000";
} finally {
  // Reset user's file data, removing thinking indicator and scroll chat to bottom
  userData.file = {};
  incomingMessageDiv.classList.remove("thinking");
  chatBody.scrollTo({ top: chatBody.scrollHeight, behavior: "smooth" });
}
};

// Handle outgoing user messages
const handleOutgoingMessage = (e) => {
e.preventDefault();
userData.message = messageInput.value.trim();
messageInput.value = "";
messageInput.dispatchEvent(new Event("input"));
fileUploadWrapper.classList.remove("file-uploaded");

// Create and display user message
const messageContent = `<div class="message-text"></div>
                        ${userData.file.data ? `<img src="data:${userData.file.mime_type};base64,${userData.file.data}" class="attachment" />` : ""}`;

const outgoingMessageDiv = createMessageElement(messageContent, "user-message");
outgoingMessageDiv.querySelector(".message-text").innerText = userData.message;
chatBody.appendChild(outgoingMessageDiv);
chatBody.scrollTo({ top: chatBody.scrollHeight, behavior: "smooth" });

// Simulate bot response with thinking indicator after a delay
setTimeout(() => {
  const messageContent = `<svg class="bot-avatar" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 1024 1024">
          <path
            d="M738.3 287.6H285.7c-59 0-106.8 47.8-106.8 106.8v303.1c0 59 47.8 106.8 106.8 106.8h81.5v111.1c0 .7.8 1.1 1.4.7l166.9-110.6 41.8-.8h117.4l43.6-.4c59 0 106.8-47.8 106.8-106.8V394.5c0-59-47.8-106.9-106.8-106.9zM351.7 448.2c0-29.5 23.9-53.5 53.5-53.5s53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5-53.5-23.9-53.5-53.5zm157.9 267.1c-67.8 0-123.8-47.5-132.3-109h264.6c-8.6 61.5-64.5 109-132.3 109zm110-213.7c-29.5 0-53.5-23.9-53.5-53.5s23.9-53.5 53.5-53.5 53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5zM867.2 644.5V453.1h26.5c19.4 0 35.1 15.7 35.1 35.1v121.1c0 19.4-15.7 35.1-35.1 35.1h-26.5zM95.2 609.4V488.2c0-19.4 15.7-35.1 35.1-35.1h26.5v191.3h-26.5c-19.4 0-35.1-15.7-35.1-35.1zM561.5 149.6c0 23.4-15.6 43.3-36.9 49.7v44.9h-30v-44.9c-21.4-6.5-36.9-26.3-36.9-49.7 0-28.6 23.3-51.9 51.9-51.9s51.9 23.3 51.9 51.9z"/></svg>
        <div class="message-text">
          <div class="thinking-indicator">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
          </div>
        </div>`;

  const incomingMessageDiv = createMessageElement(messageContent, "bot-message", "thinking");
  chatBody.appendChild(incomingMessageDiv);
  chatBody.scrollTo({ top: chatBody.scrollHeight, behavior: "smooth" });
  generateBotResponse(incomingMessageDiv);
}, 600);
};

// Adjust input field height dynamically
messageInput.addEventListener("input", () => {
messageInput.style.height = `${initialInputHeight}px`;
messageInput.style.height = `${messageInput.scrollHeight}px`;
document.querySelector(".chat-form").style.borderRadius = messageInput.scrollHeight > initialInputHeight ? "15px" : "32px";
});

// Handle Enter key press for sending messages
messageInput.addEventListener("keydown", (e) => {
const userMessage = e.target.value.trim();
if (e.key === "Enter" && !e.shiftKey && userMessage && window.innerWidth > 768) {
  handleOutgoingMessage(e);
}
});

// Handle file input change and preview the selected file
fileInput.addEventListener("change", () => {
const file = fileInput.files[0];
if (!file) return;

const reader = new FileReader();
reader.onload = (e) => {
  fileInput.value = "";
  fileUploadWrapper.querySelector("img").src = e.target.result;
  fileUploadWrapper.classList.add("file-uploaded");
  const base64String = e.target.result.split(",")[1];

  // Store file data in userData
  userData.file = {
    data: base64String,
    mime_type: file.type,
  };
};

reader.readAsDataURL(file);
});

// Cancel file upload
fileCancelButton.addEventListener("click", () => {
userData.file = {};
fileUploadWrapper.classList.remove("file-uploaded");
});

// Initialize emoji picker and handle emoji selection
const picker = new EmojiMart.Picker({
theme: "light",
skinTonePosition: "none",
previewPosition: "none",
onEmojiSelect: (emoji) => {
  const { selectionStart: start, selectionEnd: end } = messageInput;
  messageInput.setRangeText(emoji.native, start, end, "end");
  messageInput.focus();
},
onClickOutside: (e) => {
  if (e.target.id === "emoji-picker") {
    document.body.classList.toggle("show-emoji-picker");
  } else {
    document.body.classList.remove("show-emoji-picker");
  }
},
});

document.querySelector(".chat-form").appendChild(picker);

sendMessage.addEventListener("click", (e) => handleOutgoingMessage(e));
document.querySelector("#file-upload").addEventListener("click", () => fileInput.click());
closeChatbot.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));

// Define responses for quick replies
const quickReplyResponses = {
  'Check account status': 'Your account status is active.',
  'Reset my password': 'Please follow the instructions sent to your email to reset your password.',
  'Contact support': 'Our support team will reach out to you shortly.',
  'Operating hours': 'Our operating hours are from 9 AM to 6 PM, Monday to Friday.'
};

// Function to append a message to the chat
function appendMessage(content, type) {
  const chatBody = document.querySelector('.chat-body');

  // Create a message container
  const messageContainer = document.createElement('div');
  messageContainer.classList.add('message', type === 'user' ? 'user-message' : 'bot-message');

  // Add the message content
  const messageText = document.createElement('div');
  messageText.classList.add('message-text');
  messageText.innerText = content;

  messageContainer.appendChild(messageText);

  // Append the message container to the chat body
  chatBody.appendChild(messageContainer);

  // Scroll to the latest message
  chatBody.scrollTo({ top: chatBody.scrollHeight, behavior: 'smooth' });
}

// Handle quick replies
quickReplies.forEach(button => {
  button.addEventListener('click', function (event) {
      const replyText = event.target.getAttribute('data-reply-text');

      // Append user quick reply as 'user-message'
      appendMessage(replyText, 'user');

      // Simulate chatbot auto-response after a delay
      setTimeout(() => {
          const responseText = quickReplyResponses[replyText] || 'I\'m not sure how to respond to that.';
          // Append bot response as 'bot-message'
          appendMessage(responseText, 'bot');
      }, 1000);
  });
});


});
