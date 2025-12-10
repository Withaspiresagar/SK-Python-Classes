<template>
    <div class="w-full overflow-hidden">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg p-4 sm:p-6 border border-gray-100 overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3">
                <div class="flex-1"></div>
                <button 
                    class="bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-xl hover:from-teal-600 hover:to-cyan-600 transition font-medium shadow-lg shadow-teal-500/30 transform hover:scale-105 text-sm sm:text-base w-full sm:w-auto whitespace-nowrap"
                >
                    Generate Certificate
                </button>
            </div>
            
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Certificates</h3>
                <p class="text-gray-600">Generate and manage student certificates</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Certificates'
};
</script>




