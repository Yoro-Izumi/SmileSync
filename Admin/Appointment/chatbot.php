
    <!-- Chat Box Container -->
    <div class="chat-container">
        <div class="chat-header">
            <img src="img/login.png" alt="Profile Picture">
            <div class="chat-user-info">
                <h4>Help Bot</h4>
                <span>We are online.</span>
            </div>
            <div class="chat-options">
                <button class="close-btn" title="Close">×</button>
            </div>
        </div>
        
        
        <!-- Chat Body -->
        <div class="chat-body" id="chatBody">
            <!-- Messages will be appended here -->
        </div>

        <div class="quick-replies">
            <button class="quick-reply" data-reply-text="Check account status">Check account status</button>
            <button class="quick-reply" data-reply-text="Reset my password">Reset my password</button>
            <button class="quick-reply" data-reply-text="Contact support">Contact support</button>
            <button class="quick-reply" data-reply-text="Operating hours">Operating Hours</button>
        </div>

        <!-- Chat Input Area -->
        <div class="chat-input-area">
            <input type="text" id="messageInput" placeholder="Type a message...">
            <button id="sendButton">➤</button>
        </div>


    </div>
