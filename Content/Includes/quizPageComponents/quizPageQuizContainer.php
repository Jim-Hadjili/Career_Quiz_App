<div id="quiz-container">
    <!-- Questions will be dynamically inserted here by JavaScript -->
</div>

<!-- Navigation positioned outside quiz container -->
<div class="bg-white rounded-2xl shadow-sm p-6 mt-6">
    <div class="flex justify-between items-center">
        <button
            id="prev-btn"
            type="button"
            class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
            disabled>
            <i class="fas fa-arrow-left mr-2"></i>Previous
        </button>

        <button
            id="next-btn"
            type="button"
            class="px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
            disabled>
            Next<i class="fas fa-arrow-right ml-2"></i>
        </button>

        <button
            id="submit-btn"
            type="button"
            class="px-6 py-3 bg-green-600 text-white font-medium rounded-xl hover:bg-green-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed hidden"
            disabled>
            Complete Quiz<i class="fas fa-check ml-2"></i>
        </button>
    </div>
</div>