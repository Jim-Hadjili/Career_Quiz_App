document.addEventListener("DOMContentLoaded", function () {
  // Elements
  const chatheadBtn = document.getElementById("chatheadBtn");
  const chatModal = document.getElementById("chatModal");
  const chatContainer = document.getElementById("chatContainer");
  const closeChat = document.getElementById("closeChat");
  const chatInput = document.getElementById("chatInput");
  const sendMessage = document.getElementById("sendMessage");
  const chatMessages = document.getElementById("chatMessages");
  const typingIndicator = document.getElementById("typingIndicator");
  const chatTail = document.getElementById("chatTail");

  let isOpen = false;
  let chatHistory = [];

  // Position chat container relative to button
  function positionChatContainer() {
    const buttonRect = chatheadBtn.getBoundingClientRect();
    const viewportWidth = window.innerWidth;
    const viewportHeight = window.innerHeight;

    if (viewportWidth < 640) {
      // Mobile: Full screen with margin
      chatContainer.style.position = "fixed";
      chatContainer.style.top = "1rem";
      chatContainer.style.left = "1rem";
      chatContainer.style.right = "1rem";
      chatContainer.style.bottom = "1rem";
      chatContainer.style.width = "auto";
      chatContainer.style.height = "auto";
      chatContainer.style.transformOrigin = "center";
    } else {
      // Desktop: Position relative to button
      const chatWidth = 384; // 24rem = 384px
      const chatHeight = 512; // 32rem = 512px

      let right = viewportWidth - buttonRect.right + 24; // 1.5rem margin
      let bottom = viewportHeight - buttonRect.bottom + 80; // 5rem above button

      // Adjust if chat would go off-screen
      if (buttonRect.right + chatWidth > viewportWidth - 24) {
        right = 24; // Align to right edge with margin
      }

      if (buttonRect.top - chatHeight < 24) {
        bottom = 96; // Position below button instead
      }

      chatContainer.style.position = "fixed";
      chatContainer.style.right = right + "px";
      chatContainer.style.bottom = bottom + "px";
      chatContainer.style.width = chatWidth + "px";
      chatContainer.style.height = chatHeight + "px";
      chatContainer.style.transformOrigin = "bottom right";
    }
  }

  // Chat functionality
  chatheadBtn.addEventListener("click", function () {
    if (!isOpen) {
      openChat();
    } else {
      closeModal();
    }
  });

  closeChat.addEventListener("click", function () {
    closeModal();
  });

  // Close modal when clicking on overlay (not the container)
  chatModal.addEventListener("click", function (e) {
    if (e.target === chatModal) {
      closeModal();
    }
  });

  // Send message functionality
  sendMessage.addEventListener("click", function () {
    sendUserMessage();
  });

  chatInput.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      sendUserMessage();
    }
  });

  function openChat() {
    positionChatContainer();

    // Show modal overlay
    chatModal.classList.remove("hidden");
    chatModal.style.pointerEvents = "auto";

    // Liquid expansion animation
    setTimeout(() => {
      // Start expanding from button size
      chatContainer.style.width = window.innerWidth < 640 ? "auto" : "384px";
      chatContainer.style.height = window.innerWidth < 640 ? "auto" : "512px";
      chatContainer.style.borderRadius = "1rem";

      // Show tail connector
      if (window.innerWidth >= 640) {
        chatTail.style.opacity = "1";
        chatTail.style.width = "24px";
        chatTail.style.height = "24px";
      }

      // Fade in content with staggered delays
      setTimeout(() => {
        const header = chatContainer.querySelector(".bg-gradient-to-r");
        const messages = chatContainer.querySelector("#chatMessages");
        const input = chatContainer.querySelector(".border-t");

        if (header) header.style.opacity = "1";
        if (messages) messages.style.opacity = "1";
        if (input) input.style.opacity = "1";
      }, 200);
    }, 50);

    // Focus input after animation
    setTimeout(() => {
      if (chatInput) chatInput.focus();
    }, 600);

    isOpen = true;

    // Add pulse effect to button
    chatheadBtn.classList.add("animate-pulse");
    setTimeout(() => {
      chatheadBtn.classList.remove("animate-pulse");
    }, 500);
  }

  function closeModal() {
    // Reverse animation
    const header = chatContainer.querySelector(".bg-gradient-to-r");
    const messages = chatContainer.querySelector("#chatMessages");
    const input = chatContainer.querySelector(".border-t");

    if (header) header.style.opacity = "0";
    if (messages) messages.style.opacity = "0";
    if (input) input.style.opacity = "0";

    // Hide tail
    chatTail.style.opacity = "0";
    chatTail.style.width = "0";
    chatTail.style.height = "0";

    // Collapse container
    setTimeout(() => {
      chatContainer.style.width = "0";
      chatContainer.style.height = "0";
      chatContainer.style.borderRadius = "50%";
    }, 100);

    // Hide modal
    setTimeout(() => {
      chatModal.classList.add("hidden");
      chatModal.style.pointerEvents = "none";
    }, 500);

    isOpen = false;
  }

  function minimizeModal() {
    closeModal();
    // Add notification dot to indicate minimized state
    const notificationDot = document.getElementById("notificationDot");
    if (notificationDot) {
      notificationDot.style.opacity = "1";
      setTimeout(() => {
        notificationDot.style.opacity = "0";
      }, 3000);
    }
  }

  function sendUserMessage() {
    const message = chatInput.value.trim();
    if (!message) return;

    // Add user message to chat
    addMessage(message, "user");
    chatInput.value = "";

    // Show typing indicator
    showTypingIndicator();

    // Get AI response
    setTimeout(() => {
      hideTypingIndicator();
      getAIResponse(message);
    }, 1000 + Math.random() * 2000);
  }

  function addMessage(message, sender) {
    const messageDiv = document.createElement("div");
    const currentTime = new Date().toLocaleTimeString([], {
      hour: "2-digit",
      minute: "2-digit",
    });

    if (sender === "user") {
      messageDiv.innerHTML = `
                <div class="flex items-start space-x-3 flex-row-reverse w-full ">
                    <div class="w-8 h-8 ml-2 bg-dark rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-lime" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <div class="bg-lime text-dark rounded-lg p-3 max-w-[80%] shadow-sm ml-auto">
                        <p class="text-sm">${message}</p>
                        <span class="text-xs opacity-70 mt-1 block">${currentTime}</span>
                    </div>
                </div>
            `;
    } else {
      // Format AI messages with better structure
      const formattedMessage = formatAIMessage(message);
      messageDiv.innerHTML = `
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-lime rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-dark" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div class="bg-white rounded-lg p-3 max-w-[80%] shadow-sm">
                        <div class="text-sm text-dark formatted-content">${formattedMessage}</div>
                        <span class="text-xs text-gray-500 mt-1 block">${currentTime}</span>
                    </div>
                </div>
            `;
    }

    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;

    // Store in chat history
    chatHistory.push({ message, sender, timestamp: currentTime });
  }

  // New function to format AI messages with better structure
  function formatAIMessage(message) {
    // Convert markdown-like formatting to HTML
    let formatted = message;

    // Handle headers (lines starting with # or ##)
    formatted = formatted.replace(
      /^### (.*$)/gm,
      '<h4 class="font-semibold text-base text-dark mb-2 mt-3 first:mt-0">🎯 $1</h4>'
    );
    formatted = formatted.replace(
      /^## (.*$)/gm,
      '<h3 class="font-semibold text-lg text-dark mb-2 mt-3 first:mt-0">📚 $1</h3>'
    );
    formatted = formatted.replace(
      /^# (.*$)/gm,
      '<h2 class="font-bold text-xl text-dark mb-3 mt-4 first:mt-0">🎓 $1</h2>'
    );

    // Handle emoji headers (lines starting with emoji and text)
    formatted = formatted.replace(
      /^(🎓|📚|🎯|🧭|💼|📋|⭐|🌟|💡|🔍|📊|🎪|🏢|📖) (.*$)/gm,
      '<h4 class="font-semibold text-base text-dark mb-2 mt-3 first:mt-0 flex items-center gap-2"><span>$1</span><span>$2</span></h4>'
    );

    // Handle bold text
    formatted = formatted.replace(
      /\*\*(.*?)\*\*/g,
      '<strong class="font-semibold text-dark">$1</strong>'
    );

    // Handle bullet points (lines starting with - or *)
    formatted = formatted.replace(
      /^[\-\*] (.*$)/gm,
      '<li class="ml-4 mb-1">• $1</li>'
    );

    // Handle numbered lists
    formatted = formatted.replace(
      /^\d+\. (.*$)/gm,
      '<li class="ml-4 mb-1 list-decimal">$1</li>'
    );

    // Wrap consecutive list items in ul tags
    formatted = formatted.replace(/(<li.*?<\/li>\s*)+/g, function (match) {
      if (match.includes("list-decimal")) {
        return '<ol class="mb-2 ml-2">' + match + "</ol>";
      }
      return '<ul class="mb-2 ml-2">' + match + "</ul>";
    });

    // Handle course/program details with special formatting
    formatted = formatted.replace(
      /Course: (.*$)/gm,
      '<div class="bg-lime bg-opacity-20 px-2 py-1 rounded text-sm mb-1"><strong>Course:</strong> $1</div>'
    );
    formatted = formatted.replace(
      /Details: (.*$)/gm,
      '<div class="text-sm text-gray-600 mb-2 pl-2"><strong>Details:</strong> $1</div>'
    );

    // Handle line breaks and paragraphs
    formatted = formatted.replace(/\n\n/g, '</p><p class="mb-2">');
    formatted = '<p class="mb-2">' + formatted + "</p>";

    // Clean up empty paragraphs
    formatted = formatted.replace(/<p class="mb-2"><\/p>/g, "");

    // Handle steps or numbered instructions with better styling
    formatted = formatted.replace(
      /^Step \d+: (.*$)/gm,
      '<div class="bg-gray-50 border-l-4 border-lime pl-3 py-2 mb-2 rounded-r"><strong>$&</strong></div>'
    );

    return formatted;
  }

  function showTypingIndicator() {
    typingIndicator.classList.remove("hidden");
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function hideTypingIndicator() {
    typingIndicator.classList.add("hidden");
  }

  async function getAIResponse(userMessage) {
    try {
      // More robust path detection
      const currentPath = window.location.pathname;
      const hostname = window.location.hostname;

      let apiUrl;
      if (hostname === "localhost" || hostname === "127.0.0.1") {
        // Local development
        apiUrl = "Chatbot/API/chat_api.php";
      } else {
        // Production - try multiple possible paths
        const possiblePaths = [
          "/Chatbot/API/chat_api.php",
          "Chatbot/API/chat_api.php",
          "./Chatbot/API/chat_api.php",
        ];

        // Use the first path as default, but we'll add fallback logic
        apiUrl = possiblePaths[0];
      }

      console.log("Attempting to call API at:", apiUrl);

      const response = await fetch(apiUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          message: userMessage,
          chat_history: chatHistory,
        }),
      });

      console.log("Response status:", response.status);
      console.log("Response headers:", response.headers);

      if (!response.ok) {
        // If we get a 403/404, try alternative paths
        if (response.status === 403 || response.status === 404) {
          console.log("Primary path failed, trying fallback...");

          // Try fallback with GET request first to test connectivity
          const testResponse = await fetch(
            apiUrl.replace("chat_api.php", "chat_api.php?test=1"),
            {
              method: "GET",
            }
          );

          if (!testResponse.ok) {
            throw new Error(
              `API endpoint not accessible. Status: ${response.status}`
            );
          }
        } else {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
      }

      const contentType = response.headers.get("content-type");
      if (!contentType || !contentType.includes("application/json")) {
        const text = await response.text();
        console.error("Non-JSON response:", text);
        throw new Error("Server returned non-JSON response");
      }

      const data = await response.json();

      if (data.success) {
        addMessage(data.response, "ai");
      } else {
        addMessage(
          data.response ||
            "Sorry, I'm having trouble connecting right now. Please try again later.",
          "ai"
        );
      }
    } catch (error) {
      console.error("Error details:", error);

      // Provide more helpful error messages based on the error type
      let errorMessage =
        "I apologize, but I'm experiencing technical difficulties.";

      if (error.message.includes("403")) {
        errorMessage =
          "I'm having permission issues accessing my systems. Please try again in a moment.";
      } else if (error.message.includes("404")) {
        errorMessage =
          "I can't seem to find my API endpoint. The technical team has been notified.";
      } else if (error.message.includes("fetch")) {
        errorMessage =
          "I'm having network connectivity issues. Please check your connection and try again.";
      }

      addMessage(
        errorMessage + " In the meantime, I can provide general career advice!",
        "ai"
      );
    }
  }

  // Handle window resize
  window.addEventListener("resize", function () {
    if (isOpen) {
      positionChatContainer();
    }
  });

  // Handle scroll to reposition if needed
  window.addEventListener("scroll", function () {
    if (isOpen && window.innerWidth >= 640) {
      positionChatContainer();
    }
  });
});
