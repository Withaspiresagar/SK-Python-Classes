<template>
    <div class="w-full overflow-hidden space-y-4 sm:space-y-6">
        <!-- Header -->
        <div class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-2xl p-4 sm:p-6 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-1">Live Classes</h2>
                    <p class="text-xs sm:text-sm text-indigo-100">View and join your scheduled live classes</p>
                </div>
                <div class="hidden sm:flex items-center space-x-2">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <div class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-xl p-5 sm:p-6 text-white transform hover:scale-105 transition-all duration-300 border border-indigo-400/20 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold mb-1">{{ upcomingCount }}</div>
                        <div class="text-indigo-100 text-xs sm:text-sm font-medium">Upcoming Classes</div>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-green-500 via-emerald-500 to-teal-500 rounded-2xl shadow-xl p-5 sm:p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold mb-1">{{ todayCount }}</div>
                        <div class="text-green-100 text-xs sm:text-sm font-medium">Today's Classes</div>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-blue-500 via-cyan-500 to-sky-500 rounded-2xl shadow-xl p-5 sm:p-6 text-white transform hover:scale-105 transition-all duration-300 border border-blue-400/20 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold mb-1">{{ liveClasses.length }}</div>
                        <div class="text-blue-100 text-xs sm:text-sm font-medium">Total Classes</div>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Classes List -->
        <div v-if="loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-500"></div>
            <p class="mt-4 text-gray-600">Loading live classes...</p>
        </div>

        <div v-else-if="liveClasses.length === 0" class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-12 text-center border border-gray-100">
            <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            <p class="text-gray-600 text-lg font-medium">No live classes scheduled yet.</p>
            <p class="text-gray-500 text-sm mt-2">Your upcoming live classes will appear here.</p>
        </div>

        <div v-else class="space-y-4 sm:space-y-6">
            <!-- Group by Status -->
            <div v-for="statusGroup in groupedByStatus" :key="statusGroup.status" class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-2 h-10 rounded-full" :class="getStatusColorClass(statusGroup.status)"></div>
                    <h3 class="ml-3 text-lg sm:text-xl font-bold text-gray-800 capitalize">{{ statusGroup.status }}</h3>
                    <span class="ml-2 px-3 py-1 bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 text-xs font-semibold rounded-full border border-indigo-200">{{ statusGroup.classes.length }}</span>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    <div 
                        v-for="liveClass in statusGroup.classes" 
                        :key="liveClass.id"
                        class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl shadow-xl p-5 sm:p-6 border-2 border-indigo-100 hover:border-indigo-300 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden group"
                    >
                        <!-- Decorative gradient overlay -->
                        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-indigo-200/40 via-purple-200/40 to-pink-200/40 rounded-full -mr-20 -mt-20 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-blue-100/30 to-cyan-100/30 rounded-full -ml-16 -mb-16 group-hover:scale-150 transition-transform duration-500"></div>
                        
                        <div class="relative z-10">
                            <!-- Status Badge -->
                            <div class="flex items-start justify-between mb-4">
                                <span :class="getStatusBadgeClass(liveClass.status)" class="px-3 py-1.5 rounded-full text-xs font-bold shadow-sm capitalize">
                                    {{ liveClass.status }}
                                </span>
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Class Title -->
                            <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 line-clamp-2">{{ liveClass.class_name }}</h3>
                            
                            <!-- Batch and Course Info -->
                            <div class="mb-4 space-y-2">
                                <div v-if="liveClass.batch" class="p-3 bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100 rounded-lg border-2 border-indigo-200 shadow-sm">
                                    <p class="text-xs text-indigo-700 mb-1 font-bold">Batch</p>
                                    <p class="text-sm font-bold text-indigo-900">{{ liveClass.batch.name }}</p>
                                </div>
                                <div v-if="liveClass.batch?.course" class="p-3 bg-gradient-to-r from-blue-50 via-cyan-50 to-teal-50 rounded-lg border-2 border-blue-200 shadow-sm">
                                    <p class="text-xs text-blue-700 mb-1 font-bold">Course</p>
                                    <p class="text-sm font-bold text-blue-900">{{ liveClass.batch.course.name }}</p>
                                </div>
                            </div>

                            <!-- Class Details -->
                            <div class="space-y-2.5 mb-5">
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-5 h-5 mr-2.5 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <span class="text-gray-500 text-xs">Date:</span>
                                        <span class="ml-1 font-semibold text-gray-800">{{ formatDate(liveClass.date) }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-5 h-5 mr-2.5 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <span class="text-gray-500 text-xs">Time:</span>
                                        <span class="ml-1 font-semibold text-gray-800">{{ formatTime(liveClass.time) }} - {{ formatEndTime(liveClass.time, liveClass.duration_minutes) }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-5 h-5 mr-2.5 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <span class="text-gray-500 text-xs">Duration:</span>
                                        <span class="ml-1 font-semibold text-gray-800">{{ liveClass.duration_minutes || 60 }} minutes</span>
                                    </div>
                                </div>
                                <div v-if="liveClass.description" class="pt-2 border-t border-gray-200">
                                    <p class="text-xs text-gray-500 line-clamp-2">{{ liveClass.description }}</p>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div v-if="liveClass.meeting_link && (liveClass.status === 'scheduled' || liveClass.status === 'ongoing')" class="mt-4">
                                <a 
                                    :href="liveClass.meeting_link" 
                                    target="_blank"
                                    class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl text-sm font-semibold hover:from-indigo-600 hover:to-purple-600 transition-all shadow-lg shadow-indigo-500/30 hover:shadow-xl hover:shadow-indigo-500/40"
                                >
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    {{ liveClass.status === 'ongoing' ? 'Join Now' : 'Join Class' }}
                                </a>
                            </div>
                            <div v-else-if="liveClass.status === 'completed'" class="mt-4">
                                <button disabled class="w-full px-4 py-3 bg-gray-200 text-gray-500 rounded-xl text-sm font-semibold cursor-not-allowed">
                                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Class Completed
                                </button>
                            </div>
                            <div v-else class="mt-4">
                                <button disabled class="w-full px-4 py-3 bg-gray-200 text-gray-500 rounded-xl text-sm font-semibold cursor-not-allowed">
                                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                    Link Not Available
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

export default {
    name: 'StudentLiveClasses',
    setup() {
        const liveClasses = ref([]);
        const loading = ref(true);

        const fetchLiveClasses = async () => {
            try {
                loading.value = true;
                const response = await axios.get('/api/student/live-classes');
                if (response.data.success) {
                    liveClasses.value = response.data.liveClasses || [];
                }
            } catch (error) {
                console.error('Error fetching live classes:', error);
            } finally {
                loading.value = false;
            }
        };

        const formatDate = (dateString) => {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const classDate = new Date(date);
            classDate.setHours(0, 0, 0, 0);
            
            if (classDate.getTime() === today.getTime()) {
                return 'Today';
            }
            
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            if (classDate.getTime() === tomorrow.getTime()) {
                return 'Tomorrow';
            }
            
            return date.toLocaleDateString('en-IN', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
        };

        const formatTime = (timeString) => {
            if (!timeString) return 'N/A';
            // Handle both "HH:MM:SS" and "HH:MM" formats
            const time = timeString.split(':');
            const hours = parseInt(time[0]);
            const minutes = time[1];
            const ampm = hours >= 12 ? 'PM' : 'AM';
            const displayHours = hours % 12 || 12;
            return `${displayHours}:${minutes} ${ampm}`;
        };

        const formatEndTime = (timeString, durationMinutes) => {
            if (!timeString || !durationMinutes) return '';
            const time = timeString.split(':');
            const hours = parseInt(time[0]);
            const minutes = parseInt(time[1]);
            
            const startDate = new Date();
            startDate.setHours(hours, minutes, 0, 0);
            const endDate = new Date(startDate.getTime() + (durationMinutes * 60000));
            
            const endHours = endDate.getHours();
            const endMinutes = endDate.getMinutes();
            const ampm = endHours >= 12 ? 'PM' : 'AM';
            const displayHours = endHours % 12 || 12;
            return `${displayHours}:${String(endMinutes).padStart(2, '0')} ${ampm}`;
        };

        const getStatusBadgeClass = (status) => {
            const classes = {
                'scheduled': 'bg-gradient-to-r from-blue-400 to-cyan-400 text-white',
                'ongoing': 'bg-gradient-to-r from-green-400 to-emerald-400 text-white',
                'completed': 'bg-gradient-to-r from-purple-400 to-pink-400 text-white',
                'cancelled': 'bg-gradient-to-r from-gray-400 to-gray-500 text-white'
            };
            return classes[status] || 'bg-gray-100 text-gray-800';
        };

        const getStatusColorClass = (status) => {
            const classes = {
                'scheduled': 'bg-blue-500',
                'ongoing': 'bg-green-500',
                'completed': 'bg-purple-500',
                'cancelled': 'bg-gray-500'
            };
            return classes[status] || 'bg-gray-400';
        };

        const upcomingCount = computed(() => {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return liveClasses.value.filter(lc => {
                if (!lc.date || lc.status === 'completed' || lc.status === 'cancelled') return false;
                const classDate = new Date(lc.date);
                classDate.setHours(0, 0, 0, 0);
                return classDate.getTime() >= today.getTime();
            }).length;
        });

        const todayCount = computed(() => {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return liveClasses.value.filter(lc => {
                if (!lc.date || lc.status === 'completed' || lc.status === 'cancelled') return false;
                const classDate = new Date(lc.date);
                classDate.setHours(0, 0, 0, 0);
                return classDate.getTime() === today.getTime();
            }).length;
        });

        const groupedByStatus = computed(() => {
            const groups = {
                'scheduled': [],
                'ongoing': [],
                'completed': [],
                'cancelled': []
            };

            liveClasses.value.forEach(lc => {
                const status = lc.status || 'scheduled';
                if (groups[status]) {
                    groups[status].push(lc);
                }
            });

            // Return only non-empty groups, ordered by priority
            return [
                { status: 'ongoing', classes: groups.ongoing },
                { status: 'scheduled', classes: groups.scheduled },
                { status: 'completed', classes: groups.completed },
                { status: 'cancelled', classes: groups.cancelled }
            ].filter(group => group.classes.length > 0);
        });

        onMounted(() => {
            fetchLiveClasses();
        });

        return {
            liveClasses,
            loading,
            formatDate,
            formatTime,
            formatEndTime,
            getStatusBadgeClass,
            getStatusColorClass,
            upcomingCount,
            todayCount,
            groupedByStatus
        };
    }
};
</script>
