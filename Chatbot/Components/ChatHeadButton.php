<!-- Chathead Button -->
<button id="chatheadBtn" title="Chat with AI Assistant"
    class="fixed bottom-6 right-6 z-50 bg-lime hover:from-green-400 hover:to-lime text-dark rounded-full shadow-2xl p-4 transition-all duration-300 hover:scale-110 focus:outline-none focus:ring-4 focus:ring-lime/60 no-print group">
    <span class="flex items-center justify-center relative">
        <!-- Chat Icon -->
        <svg id="chatIcon" class="w-6 h-6 transition-all duration-300" fill="currentColor" viewBox="0 0 24 24">
            <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4l4 4 4-4h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
        </svg>
        <!-- Notification dot -->
        <span id="notificationDot" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-3 h-3 flex items-center justify-center opacity-0 transition-opacity duration-300"></span>
    </span>
</button>

<!-- Chat Modal Overlay -->
<div id="chatModal" class="fixed inset-0 z-[60] hidden pointer-events-none">
    <!-- Chat Container with liquid expansion animation -->
    <div id="chatContainer" 
         class="absolute bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden transition-all duration-500 ease-out pointer-events-auto"
         style="bottom: 6rem; right: 1.5rem; width: 0; height: 0; transform-origin: bottom right;">
        
        <!-- Chat Header -->
        <div class="bg-lime text-dark p-4 flex items-center justify-between transition-opacity duration-300 delay-200">
            <div class="flex items-center space-x-3">
                <div
                    class="w-8 h-8 bg-gradient-to-br from-gray-800 to-gray-900 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-compass text-lime text-md"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-lg">AI Career Assistant</h3>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button id="closeChat" class="p-1 hover:bg-dark hover:bg-opacity-20 rounded-full transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Chat Messages Area -->
        <div id="chatMessages" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 opacity-0 transition-opacity duration-300 delay-300">
            <!-- Welcome Message -->
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-lime rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-dark" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div class="bg-white rounded-lg p-3 max-w-[80%] shadow-sm">
                    <p class="text-sm text-dark">Hi! I'm your AI Career Assistant. I can help you with career guidance, or any concerns about your career path. How can I assist you today?</p>
                </div>
            </div>
        </div>

        <!-- Typing Indicator -->
        <div id="typingIndicator" class="px-4 py-2 hidden">
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 bg-lime rounded-full flex items-center justify-center">
                    <div class="flex space-x-1">
                        <div class="w-1 h-1 bg-dark rounded-full animate-bounce"></div>
                        <div class="w-1 h-1 bg-dark rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-1 h-1 bg-dark rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
                <span class="text-xs text-gray-500">AI is typing...</span>
            </div>
        </div>

        <!-- Chat Input Area -->
        <div class="p-4 bg-white border-t border-gray-200 opacity-0 transition-opacity duration-300 delay-400">
            <div class="flex items-center space-x-3">
                <input type="text" id="chatInput" placeholder="Type your message..." 
                    class="flex-1 border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-lime focus:border-transparent">
                <button id="sendMessage" class="bg-lime hover:bg-green-400 text-dark p-2 rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-lime focus:ring-offset-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Liquid expansion tail -->
        <div id="chatTail" class="absolute bottom-0 right-8 w-0 h-0 transition-all duration-300 delay-100"
             style="border-left: 12px solid transparent; border-right: 12px solid transparent; border-top: 12px solid white; transform: translateY(100%) rotate(45deg); opacity: 0;"></div>
    </div>
</div>

<style>
.formatted-content h2, 
.formatted-content h3, 
.formatted-content h4 {
    color: #1f2937;
    line-height: 1.3;
}

.formatted-content ul, 
.formatted-content ol {
    padding-left: 1rem;
}

.formatted-content li {
    margin-bottom: 0.25rem;
    line-height: 1.4;
}

.formatted-content p {
    line-height: 1.5;
}

.formatted-content strong {
    font-weight: 600;
}

.formatted-content .bg-lime {
    background-color: rgba(132, 204, 22, 0.1);
    border-radius: 0.25rem;
}
</style>
