<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LawBuddy - Asisten Hukum Pribadi Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .message-content {
            white-space: pre-line;
            line-height: 1.6;
        }

        .message-content p {
            margin-bottom: 1rem;
        }

        .message-content ul,
        .message-content ol {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .message-content li {
            margin-bottom: 0.5rem;
        }

        .message-content strong {
            font-weight: 600;
        }

        .message-content pre {
            margin: 1rem 0;
            border-radius: 0.5rem;
        }

        .bot-message {
            max-width: 80%;
            text-align: left;
        }

        .user-message {
            max-width: 80%;
            margin-left: auto;
        }

        .typing-indicator {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            background: #f3f4f6;
            border-radius: 8px;
        }

        .typing-dot {
            width: 8px;
            height: 8px;
            margin: 0 2px;
            background: #9ca3af;
            border-radius: 50%;
            animation: typing 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(1) {
            animation-delay: 200ms;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 300ms;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 400ms;
        }

        @keyframes typing {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="flex">
            <!-- Sidebar -->
            <div class="w-1/4 bg-white rounded-lg shadow-lg p-4 mr-4">
                <div class="flex items-center mb-6">
                    <a href="{{ route('home') }}" class="font-bold text-green-500">
                        LAW<span class="text-blue-500">BUDDY</span>
                    </a>
                </div>

                <button id="new-chat" class="bg-green-500 text-white rounded-lg p-2 w-full flex items-center mb-4">
                    <span class="mr-2">+</span> New chat
                </button>

                <div id="chat-history" class="space-y-2">
                    <!-- Chat history will appear here -->
                </div>
            </div>

            <!-- Main Chat Area -->
            <div class="flex-1 bg-white rounded-lg shadow-lg p-4">
                <div id="chat-messages" class="h-[calc(100vh-200px)] overflow-y-auto mb-4 p-4">
                    <!-- Welcome message -->
                    <div class="mb-6">
                        <div class="bot-message">
                            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                                <div class="flex items-center mb-2">
                                    <div
                                        class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white font-bold mr-2">
                                        L
                                    </div>
                                    <span class="font-semibold">LawBuddy</span>
                                </div>
                                <div class="message-content text-gray-800">
                                    {{ $welcomeMessage }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="chat-form" class="flex items-center">
                    <input type="text" id="message-input" class="flex-1 p-2 border rounded-lg mr-2"
                        placeholder="Ketik pesan Anda...">
                    <button type="submit" class="bg-green-500 text-white p-2 rounded-lg">
                        Kirim
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // [Previous JavaScript remains the same until addMessage function]

        function addMessage(type, content) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `mb-6 ${type === 'user' ? 'user-message' : 'bot-message'}`;

            let innerHTML = '';

            if (type === 'user') {
                innerHTML = `
                    <div class="bg-green-500 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center justify-end mb-2">
                            <span class="font-semibold text-white">Anda</span>
                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-green-500 font-bold ml-2">
                                U
                            </div>
                        </div>
                        <div class="message-content text-white">
                            ${formatMessage(content)}
                        </div>
                    </div>
                `;
            } else {
                innerHTML = `
                    <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white font-bold mr-2">
                                L
                            </div>
                            <span class="font-semibold">LawBuddy</span>
                        </div>
                        <div class="message-content text-gray-800">
                            ${formatMessage(content)}
                        </div>
                    </div>
                `;
            }

            messageDiv.innerHTML = innerHTML;
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function formatMessage(content) {
            // First, handle code blocks if they exist
            content = content.replace(/```([\s\S]*?)```/g, (match, code) =>
                `<pre class="bg-gray-800 text-white p-4 rounded-lg my-3 overflow-x-auto"><code>${code.trim()}</code></pre>`
            );

            // Convert URLs to clickable links
            content = content.replace(/(https?:\/\/[^\s]+)/g,
                '<a href="$1" class="text-blue-500 underline hover:text-blue-600" target="_blank">$1</a>'
            );

            // Split content into paragraphs
            let paragraphs = content.split('\n\n');

            // Process each paragraph
            paragraphs = paragraphs.map(paragraph => {
                // Handle numbered lists
                if (/^\d+\.\s/.test(paragraph)) {
                    const items = paragraph.split('\n').map(item => {
                        if (/^\d+\.\s/.test(item)) {
                            return `<li class="ml-4 mb-2">${item.replace(/^\d+\.\s/, '')}</li>`;
                        }
                        return item;
                    });
                    return `<ol class="list-decimal list-inside mb-4">${items.join('')}</ol>`;
                }

                // Handle bullet points
                if (/^[\*\-•]\s/.test(paragraph)) {
                    const items = paragraph.split('\n').map(item => {
                        if (/^[\*\-•]\s/.test(item)) {
                            return `<li class="ml-4 mb-2">${item.replace(/^[\*\-•]\s/, '')}</li>`;
                        }
                        return item;
                    });
                    return `<ul class="list-disc list-inside mb-4">${items.join('')}</ul>`;
                }

                // Handle section headers (e.g., "Label:", "Note:")
                if (/^([A-Za-z]+):\s/.test(paragraph)) {
                    return paragraph.replace(
                        /^([A-Za-z]+):\s/,
                        '<strong class="block text-gray-700 mb-1">$1:</strong> '
                    );
                }

                // Regular paragraphs
                return `<p class="mb-4">${paragraph}</p>`;
            });

            // Join all processed paragraphs
            content = paragraph
            s.join('\n');

            // Handle inline formatting
            content = content
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>') // Bold
                .replace(/\*(.*?)\*/g, '<em>$1</em>'); // Italic

            return content;
        }

        function showTypingIndicator() {
            const typingDiv = document.createElement('div');
            typingDiv.className = 'mb-6 bot-message';
            typingDiv.id = 'typing-indicator';
            typingDiv.innerHTML = `
                <div class="typing-indicator">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            `;
            chatMessages.appendChild(typingDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function removeTypingIndicator() {
            const typingDiv = document.getElementById('typing-indicator');
            if (typingDiv) {
                typingDiv.remove();
            }
        }

        // Update the chat form event listener to include typing indicator
        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const message = messageInput.value;
            if (!message.trim()) return;

            addMessage('user', message);
            messageInput.value = '';

            // Show typing indicator
            showTypingIndicator();

            try {
                const response = await fetch('/chatbot/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        message
                    })
                });

                // Remove typing indicator
                removeTypingIndicator();

                const data = await response.json();

                if (data.success) {
                    addMessage('bot', data.message);
                } else {
                    addMessage('bot', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
                }
            } catch (error) {
                // Remove typing indicator
                removeTypingIndicator();

                console.error('Error:', error);
                addMessage('bot', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
            }
        });
    </script>

    <script>
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');
        const chatMessages = document.getElementById('chat-messages');
        const newChatButton = document.getElementById('new-chat');
        const chatHistory = document.getElementById('chat-history');
        let currentChatId = Date.now();
        let chatHistoryArray = [];

        // New Chat Function
        newChatButton.addEventListener('click', () => {
            // Save current chat to history
            if (chatMessages.children.length > 1) { // More than just welcome message
                const firstUserMessage = chatMessages.children[1]?.querySelector('.text-right')?.textContent || 'New Chat';
                saveChatToHistory(currentChatId, firstUserMessage);
            }

            // Clear chat messages except welcome message
            while (chatMessages.children.length > 1) {
                chatMessages.removeChild(chatMessages.lastChild);
            }

            // Generate new chat ID
            currentChatId = Date.now();

            // Clear input
            messageInput.value = '';
            messageInput.focus();
        });

        function saveChatToHistory(id, firstMessage) {
            const historyItem = {
                id: id,
                firstMessage: firstMessage,
                timestamp: new Date().toLocaleString()
            };

            chatHistoryArray.push(historyItem);
            updateChatHistoryUI();
        }

        function updateChatHistoryUI() {
            chatHistory.innerHTML = '';
            chatHistoryArray.forEach(chat => {
                const chatElement = document.createElement('div');
                chatElement.className = 'p-2 hover:bg-gray-100 cursor-pointer rounded';
                chatElement.textContent = chat.firstMessage.substring(0, 30) + '...';
                chatElement.title = `${chat.firstMessage} (${chat.timestamp})`;
                chatHistory.appendChild(chatElement);
            });
        }

        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const message = messageInput.value;
            if (!message.trim()) return;

            // Add user message to chat
            addMessage('user', message);
            messageInput.value = '';

            try {
                const response = await fetch('/chatbot/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        message
                    })
                });

                const data = await response.json();

                if (data.success) {
                    addMessage('bot', data.message);
                } else {
                    addMessage('bot', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
                }
            } catch (error) {
                console.error('Error:', error);
                addMessage('bot', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
            }
        });

        function addMessage(type, content) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `mb-4 ${type === 'user' ? 'text-right' : 'text-left'}`;

            const messageBubble = document.createElement('div');
            messageBubble.className = `inline-block p-3 rounded-lg ${type === 'user'
                ? 'bg-green-500 text-white'
                : 'bg-gray-100 text-gray-800'
                }`;
            messageBubble.textContent = content;

            messageDiv.appendChild(messageBubble);
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>
</body>

</html>