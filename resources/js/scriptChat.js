// Define constants for DOM elements
const chatForm = document.getElementById("chat-form");
const messageInput = document.getElementById("message-input");
const chatMessages = document.getElementById("chat-messages");
const newChatButton = document.getElementById("new-chat");
const chatHistory = document.getElementById("chat-history");
let currentChatId = Date.now();
let chatHistoryArray = [];

// Function to add messages to chat
function addMessage(type, content) {
    const messageDiv = document.createElement("div");
    messageDiv.className = `mb-6 ${
        type === "user" ? "user-message" : "bot-message"
    }`;

    let innerHTML = "";

    if (type === "user") {
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

// Function to format messages with support for Markdown and lists
function formatMessage(content) {
    content = content
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");

    content = content.replace(
        /```(\w*)\n?([\s\S]*?)```/g,
        (match, language, code) => {
            return `<pre class="bg-gray-800 text-white p-4 rounded-lg my-3 overflow-x-auto"><code class="language-${language}">${code.trim()}</code></pre>`;
        }
    );

    content = content.replace(
        /(https?:\/\/[^\s]+)/g,
        '<a href="$1" class="text-blue-500 underline hover:text-blue-600" target="_blank" rel="noopener noreferrer">$1</a>'
    );

    let paragraphs = content.split("\n\n");

    paragraphs = paragraphs.map((paragraph) => {
        if (paragraph.includes("<pre")) return paragraph;

        if (/^\d+\.\s/.test(paragraph)) {
            const items = paragraph
                .split("\n")
                .filter((line) => line.trim())
                .map((item) => {
                    return `<li class="ml-4 mb-2">${item.replace(
                        /^\d+\.\s/,
                        ""
                    )}</li>`;
                });
            return `<ol class="list-decimal list-inside mb-4 space-y-2">${items.join(
                ""
            )}</ol>`;
        }

        if (/^[\*\-•]\s/.test(paragraph)) {
            const items = paragraph
                .split("\n")
                .filter((line) => line.trim())
                .map((item) => {
                    return `<li class="ml-4 mb-2">${item.replace(
                        /^[\*\-•]\s/,
                        ""
                    )}</li>`;
                });
            return `<ul class="list-disc list-inside mb-4 space-y-2">${items.join(
                ""
            )}</ul>`;
        }

        if (/^#{1,6}\s/.test(paragraph)) {
            const level = paragraph.match(/^(#{1,6})\s/)[1].length;
            const text = paragraph.replace(/^#{1,6}\s/, "");
            const sizes = [
                "text-2xl",
                "text-xl",
                "text-lg",
                "text-base",
                "text-sm",
                "text-xs",
            ];
            return `<h${level} class="font-bold ${
                sizes[level - 1]
            } mb-3">${text}</h${level}>`;
        }

        if (/^([A-Za-z]+):\s/.test(paragraph)) {
            return paragraph.replace(
                /^([A-Za-z]+):\s/,
                '<strong class="block text-gray-700 mb-2">$1:</strong> '
            );
        }

        return `<p class="mb-4 leading-relaxed">${paragraph}</p>`;
    });

    content = paragraphs.join("\n");

    content = content
        .replace(/\*\*(.*?)\*\*/g, '<strong class="font-semibold">$1</strong>')
        .replace(/\*(.*?)\*/g, '<em class="italic">$1</em>')
        .replace(
            /`([^`]+)`/g,
            '<code class="bg-gray-100 px-1 rounded">$1</code>'
        );

    return content;
}

// Typing indicator functions
function showTypingIndicator() {
    const typingDiv = document.createElement("div");
    typingDiv.className = "mb-6 bot-message";
    typingDiv.id = "typing-indicator";
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
    const typingDiv = document.getElementById("typing-indicator");
    if (typingDiv) {
        typingDiv.remove();
    }
}

// Event listener for the chat form
chatForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const message = messageInput.value;
    if (!message.trim()) return;

    addMessage("user", message);
    messageInput.value = "";

    showTypingIndicator();

    try {
        const response = await fetch("/chatbot/chat", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: JSON.stringify({
                message,
            }),
        });

        removeTypingIndicator();

        const data = await response.json();

        if (data.success) {
            addMessage("bot", data.message);
        } else {
            addMessage("bot", "Maaf, terjadi kesalahan. Silakan coba lagi.");
        }
    } catch (error) {
        removeTypingIndicator();
        console.error("Error:", error);
        addMessage("bot", "Maaf, terjadi kesalahan. Silakan coba lagi.");
    }
});

// New Chat Function
newChatButton.addEventListener("click", () => {
    if (chatMessages.children.length > 1) {
        const firstUserMessage =
            chatMessages.children[1]?.querySelector(".text-right")
                ?.textContent || "New Chat";
        saveChatToHistory(currentChatId, firstUserMessage);
    }

    while (chatMessages.children.length > 1) {
        chatMessages.removeChild(chatMessages.lastChild);
    }

    currentChatId = Date.now();
    messageInput.value = "";
    messageInput.focus();
});

function saveChatToHistory(id, firstMessage) {
    const historyItem = {
        id: id,
        firstMessage: firstMessage,
        timestamp: new Date().toLocaleString(),
    };

    chatHistoryArray.push(historyItem);
    updateChatHistoryUI();
}

function updateChatHistoryUI() {
    chatHistory.innerHTML = "";
    chatHistoryArray.forEach((chat) => {
        const chatElement = document.createElement("div");
        chatElement.className = "p-2 hover:bg-gray-100 cursor-pointer rounded";
        chatElement.textContent = chat.firstMessage.substring(0, 30) + "...";
        chatElement.title = `${chat.firstMessage} (${chat.timestamp})`;
        chatHistory.appendChild(chatElement);
    });
}
