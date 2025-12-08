<template>
    <header class="admin-header bg-white/80 backdrop-blur-md shadow-xl sticky top-0 z-50 border-b border-gray-200/60 w-full" id="admin-main-header">
        <div class="px-4 py-3 sm:px-6 sm:py-4">
            <div class="flex items-center justify-between">
                <!-- Left Section: Mobile Menu + Page Info -->
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <!-- Mobile Menu Button -->
                    <button 
                        @click="$emit('toggle-sidebar')"
                        class="lg:hidden p-2.5 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all duration-200 active:scale-95"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    
                    <!-- Page Icon & Title -->
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <!-- Dynamic Icon with enhanced styling -->
                        <div class="hidden sm:flex w-12 h-12 sm:w-14 sm:h-14 rounded-2xl items-center justify-center shadow-xl transform hover:scale-105 transition-all duration-300" :class="getHeaderIconClass()">
                            <!-- Dashboard Icon -->
                            <svg v-if="currentRoute === 'admin.dashboard'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <!-- Students Icon -->
                            <svg v-else-if="currentRoute === 'admin.students'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <!-- Courses Icon -->
                            <svg v-else-if="currentRoute === 'admin.courses'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <!-- Live Classes Icon -->
                            <svg v-else-if="currentRoute === 'admin.live-classes'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <!-- Enrollments Icon -->
                            <svg v-else-if="currentRoute === 'admin.enrollments'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <!-- Certificates Icon -->
                            <svg v-else-if="currentRoute === 'admin.certificates'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <!-- Payments Icon -->
                            <svg v-else-if="currentRoute === 'admin.payments'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <!-- Reports Icon -->
                            <svg v-else-if="currentRoute === 'admin.reports'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <!-- Admin Management Icon -->
                            <svg v-else-if="currentRoute === 'admin.management'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <!-- UI Settings Icon -->
                            <svg v-else-if="currentRoute === 'admin.ui-settings'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                            <!-- Settings Icon -->
                            <svg v-else-if="currentRoute === 'admin.settings'" class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <!-- Default Icon -->
                            <svg v-else class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        
                        <!-- Page Title & Subtitle -->
                        <div class="flex flex-col">
                            <h1 class="text-xl sm:text-2xl md:text-3xl font-extrabold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent leading-tight">
                                {{ pageTitle }}
                            </h1>
                            <p class="text-xs sm:text-sm text-gray-500 hidden sm:block mt-0.5 font-medium">
                                {{ pageSubtitle }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Section: User Info + Logout -->
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <!-- User Info -->
                    <div class="hidden sm:flex items-center space-x-3 bg-gradient-to-r from-blue-50 to-purple-50 px-4 py-2 rounded-xl border border-blue-100/50">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-lg ring-2 ring-white">
                            <span class="text-white font-bold text-sm">{{ userInitials }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 font-medium">Welcome back</span>
                            <span class="text-sm font-semibold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                {{ userName }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Mobile User Avatar -->
                    <div class="sm:hidden w-9 h-9 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-xs">{{ userInitials }}</span>
                    </div>

                    <!-- Logout Button -->
                    <button
                        @click="handleLogout"
                        :disabled="loggingOut"
                        class="group relative bg-gradient-to-r from-red-500 via-pink-500 to-red-500 text-white px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl hover:from-red-600 hover:via-pink-600 hover:to-red-600 transition-all duration-300 font-semibold text-sm sm:text-base shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 transform hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed flex items-center space-x-2"
                    >
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import { computed, ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

export default {
    name: 'AdminHeader',
    props: {
        pageTitle: {
            type: String,
            required: true
        },
        pageSubtitle: {
            type: String,
            default: 'SK Python Classes Management'
        },
        userName: {
            type: String,
            default: 'Admin'
        }
    },
    emits: ['toggle-sidebar'],
    setup(props) {
        const route = useRoute();
        const loggingOut = ref(false);

        console.log('🟢 AdminHeader setup() called');
        console.log('🟢 Props:', props);
        console.log('🟢 Route name:', route.name);
        console.log('🟢 Header elements before mount:', document.querySelectorAll('header').length);

        const currentRoute = computed(() => {
            const routeName = route.name;
            console.log('🟢 currentRoute computed:', routeName);
            return routeName;
        });

        const userInitials = computed(() => {
            const name = props.userName || 'Admin';
            return name
                .split(' ')
                .map(n => n[0])
                .join('')
                .toUpperCase()
                .substring(0, 2);
        });

        const getHeaderIconClass = () => {
            const routeName = route.name;
            if (routeName === 'admin.dashboard') {
                return 'bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500';
            } else if (routeName === 'admin.students') {
                return 'bg-gradient-to-br from-green-500 to-emerald-500';
            } else if (routeName === 'admin.courses') {
                return 'bg-gradient-to-br from-indigo-500 to-purple-500';
            } else if (routeName === 'admin.live-classes') {
                return 'bg-gradient-to-br from-red-500 to-orange-500';
            } else if (routeName === 'admin.enrollments') {
                return 'bg-gradient-to-br from-yellow-500 to-amber-500';
            } else if (routeName === 'admin.certificates') {
                return 'bg-gradient-to-br from-teal-500 to-cyan-500';
            } else if (routeName === 'admin.payments') {
                return 'bg-gradient-to-br from-emerald-500 to-green-500';
            } else if (routeName === 'admin.reports') {
                return 'bg-gradient-to-br from-violet-500 to-purple-500';
            } else if (routeName === 'admin.management') {
                return 'bg-gradient-to-br from-purple-500 to-pink-500';
            } else if (routeName === 'admin.ui-settings') {
                return 'bg-gradient-to-br from-pink-500 to-rose-500';
            } else if (routeName === 'admin.settings') {
                return 'bg-gradient-to-br from-orange-500 via-red-500 to-pink-500';
            }
            return 'bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500';
        };

        const handleLogout = async () => {
            if (loggingOut.value) return;
            
            if (!confirm('Are you sure you want to logout?')) {
                return;
            }

            loggingOut.value = true;
            try {
                await axios.post('/api/logout');
                window.location.href = '/login';
            } catch (error) {
                console.error('Logout error:', error);
                // Still redirect even if API call fails
                window.location.href = '/login';
            } finally {
                loggingOut.value = false;
            }
        };

        onMounted(() => {
            console.log('🟢 AdminHeader onMounted() called');
            console.log('🟢 Total header elements in DOM:', document.querySelectorAll('header').length);
            console.log('🟢 Admin header elements:', document.querySelectorAll('.admin-header, #admin-main-header').length);
            console.log('🟢 All header elements:', Array.from(document.querySelectorAll('header')).map(h => ({
                id: h.id,
                class: h.className,
                text: h.textContent?.substring(0, 50)
            })));
        });

        return {
            currentRoute,
            userInitials,
            loggingOut,
            getHeaderIconClass,
            handleLogout
        };
    }
};
</script>

<style scoped>
/* Enhanced header animations - ensure single render */
#admin-main-header {
    transition: all 0.3s ease;
    position: sticky;
    top: 0;
    z-index: 50;
    width: 100%;
    display: block;
}

/* Prevent duplicate rendering */
.admin-header {
    display: block !important;
}

/* Smooth backdrop blur effect */
.backdrop-blur-md {
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}

/* Hover effects for interactive elements */
button:not(:disabled):hover {
    transition: all 0.2s ease;
}

/* Gradient text animation */
@keyframes gradient-shift {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

.bg-gradient-to-r {
    background-size: 200% 200%;
    animation: gradient-shift 3s ease infinite;
}
</style>

