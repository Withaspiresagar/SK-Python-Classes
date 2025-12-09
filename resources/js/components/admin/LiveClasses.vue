<template>
    <div class="w-full overflow-hidden">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg p-4 sm:p-6 border border-gray-100 overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3">
                <div class="flex-1"></div>
                <button 
                    class="bg-gradient-to-r from-red-500 to-orange-500 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-xl hover:from-red-600 hover:to-orange-600 transition font-medium shadow-lg shadow-red-500/30 transform hover:scale-105 text-sm sm:text-base w-full sm:w-auto whitespace-nowrap"
                >
                    Schedule Live Class
                </button>
            </div>
            
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Live Classes</h3>
                <p class="text-gray-600">Schedule and manage live online classes</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'LiveClasses'
};
</script>



