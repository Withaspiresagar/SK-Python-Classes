<template>
    <aside 
        class="admin-sidebar h-screen fixed left-0 top-0 overflow-y-auto z-50 transition-transform duration-300 ease-in-out flex flex-col"
        :class="isOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        style="width: 260px;"
    >
        <!-- Logo Section -->
        <div class="p-4 sm:p-5 border-b border-white/10 backdrop-blur-sm bg-gradient-to-r from-indigo-900/50 via-purple-900/50 to-indigo-900/50 flex-shrink-0">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 flex-1">
                    <div v-if="brandSettings.brand_logo_url" class="flex-shrink-0">
                        <img 
                            :src="brandSettings.brand_logo_url" 
                            alt="Brand Logo" 
                            class="h-10 w-10 rounded-xl object-cover shadow-lg ring-2 ring-white/20"
                        >
                    </div>
                    <div class="flex-1 min-w-0">
                        <h1 class="text-lg sm:text-xl font-bold bg-gradient-to-r from-blue-300 via-purple-300 to-pink-300 bg-clip-text text-transparent leading-tight">
                            {{ brandSettings.brand_name }}
                        </h1>
                        <p class="text-xs text-gray-300/80 font-medium mt-0.5">Admin Panel</p>
                    </div>
                </div>
                <!-- Close Button for Mobile -->
                <button 
                    @click="emit('close')"
                    class="lg:hidden p-1.5 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-200"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-3 flex-1 overflow-y-auto min-h-0">
            <ul class="space-y-2 pb-4">
                <!-- Dashboard -->
                <li>
                    <router-link
                        :to="{ name: 'admin.dashboard' }"
                        class="nav-item group"
                        :class="route.name === 'admin.dashboard' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span class="font-semibold">Dashboard</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>

                <!-- Students Management -->
                <li>
                    <router-link
                        :to="{ name: 'admin.students' }"
                        class="nav-item group"
                        :class="route.name === 'admin.students' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span class="font-semibold">Students</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>

                <!-- Courses Management -->
                <li>
                    <router-link
                        :to="{ name: 'admin.courses' }"
                        class="nav-item group"
                        :class="route.name === 'admin.courses' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="font-semibold">Courses</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>

                <!-- Batches Management -->
                <li>
                    <router-link
                        :to="{ name: 'admin.batches' }"
                        class="nav-item group"
                        :class="route.name === 'admin.batches' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <span class="font-semibold">Batches</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>

                <!-- Live Classes -->
                <li>
                    <router-link
                        :to="{ name: 'admin.live-classes' }"
                        class="nav-item group"
                        :class="route.name === 'admin.live-classes' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-semibold">Live Classes</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>

                <!-- Certificates -->
                <li>
                    <router-link
                        :to="{ name: 'admin.certificates' }"
                        class="nav-item group"
                        :class="route.name === 'admin.certificates' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <span class="font-semibold">Certificates</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>

                <!-- Payments -->
                <li>
                    <router-link
                        :to="{ name: 'admin.payments' }"
                        class="nav-item group"
                        :class="route.name === 'admin.payments' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="font-semibold">Payments</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>

                <!-- Reports -->
                <li>
                    <router-link
                        :to="{ name: 'admin.reports' }"
                        class="nav-item group"
                        :class="route.name === 'admin.reports' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <span class="font-semibold">Reports</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>

                <!-- Query/Inquiry -->
                <li>
                    <router-link
                        :to="{ name: 'admin.queries' }"
                        class="nav-item group"
                        :class="route.name === 'admin.queries' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-semibold">Query/Inquiry</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>

                <!-- Admin Management -->
                <li>
                    <router-link
                        :to="{ name: 'admin.management' }"
                        class="nav-item group"
                        :class="route.name === 'admin.management' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span class="font-semibold">Admin Management</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>

                <!-- UI Settings -->
                <li>
                    <router-link
                        :to="{ name: 'admin.ui-settings' }"
                        class="nav-item group"
                        :class="route.name === 'admin.ui-settings' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <span class="font-semibold">UI Settings</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>

                <!-- Settings -->
                <li>
                    <router-link
                        :to="{ name: 'admin.settings' }"
                        class="nav-item group"
                        :class="route.name === 'admin.settings' ? 'nav-item-active' : 'nav-item-inactive'"
                    >
                        <div class="nav-icon-wrapper">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="font-semibold">Settings</span>
                        <div class="nav-indicator"></div>
                    </router-link>
                </li>
            </ul>
        </nav>

        <!-- User Section -->
        <div class="p-4 border-t border-white/10 backdrop-blur-sm bg-gradient-to-r from-indigo-900/50 via-purple-900/50 to-indigo-900/50 flex-shrink-0">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 via-purple-400 to-pink-400 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-white/20 flex-shrink-0">
                    <span class="text-white font-bold text-sm">{{ userInitials }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ userName }}</p>
                    <p class="text-xs text-gray-300/80 truncate">Administrator</p>
                </div>
            </div>
            <button
                @click="handleLogout"
                class="w-full bg-gradient-to-r from-red-500 via-pink-500 to-red-500 text-white px-4 py-2.5 rounded-xl hover:from-red-600 hover:via-pink-600 hover:to-red-600 transition-all duration-300 text-sm font-semibold shadow-lg shadow-red-500/30 hover:shadow-red-500/50 transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center space-x-2"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
            </button>
        </div>
    </aside>
</template>

<script>
import { computed, ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

export default {
    name: 'AdminSidebar',
    props: {
        user: {
            type: Object,
            default: null
        },
        isOpen: {
            type: Boolean,
            default: false
        }
    },
    emits: ['close'],
    setup(props, { emit }) {
        const route = useRoute();
        const brandSettings = ref({
            brand_name: 'SK Python Classes',
            brand_logo_url: null
        });
        
        const userName = computed(() => {
            return props.user?.name || 'Admin';
        });

        const userInitials = computed(() => {
            const name = userName.value;
            return name
                .split(' ')
                .map(n => n[0])
                .join('')
                .toUpperCase()
                .substring(0, 2);
        });

        const fetchBrandSettings = async () => {
            try {
                const response = await axios.get('/api/brand-settings');
                if (response.data.success && response.data.settings) {
                    const settings = response.data.settings;
                    brandSettings.value.brand_name = settings.brand_name || 'SK Python Classes';
                    brandSettings.value.brand_logo_url = settings.brand_logo ? `/storage/${settings.brand_logo}` : null;
                }
            } catch (error) {
                console.error('Error fetching brand settings:', error);
            }
        };

        const handleLogout = async () => {
            try {
                await axios.post('/api/logout');
                window.location.href = '/login';
            } catch (error) {
                console.error('Logout error:', error);
                window.location.href = '/login';
            }
        };

        onMounted(() => {
            fetchBrandSettings();
        });

        return {
            userName,
            userInitials,
            brandSettings,
            handleLogout,
            emit,
            route
        };
    }
};
</script>

<style scoped>
.admin-sidebar {
    z-index: 1000;
    background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 25%, #312e81 50%, #1e1b4b 75%, #0f172a 100%);
    box-shadow: 4px 0 30px rgba(0, 0, 0, 0.3);
    overflow-x: hidden;
    max-width: 260px;
}

/* Ensure nav section scrolls */
.admin-sidebar nav {
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.2) rgba(255, 255, 255, 0.05);
}

.admin-sidebar nav::-webkit-scrollbar {
    width: 6px;
}

.admin-sidebar nav::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
}

.admin-sidebar nav::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
}

.admin-sidebar nav::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Custom Scrollbar */
.admin-sidebar::-webkit-scrollbar {
    width: 6px;
}

.admin-sidebar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
}

.admin-sidebar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
}

.admin-sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Navigation Items */
.nav-item {
    position: relative;
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border-radius: 0.75rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    overflow: hidden;
}

.nav-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #3b82f6, #8b5cf6, #ec4899);
    transform: scaleY(0);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-item:hover::before,
.nav-item-active::before {
    transform: scaleY(1);
}

.nav-icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.625rem;
    margin-right: 0.75rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    flex-shrink: 0;
}

.nav-item-inactive {
    color: #cbd5e1;
}

.nav-item-inactive .nav-icon-wrapper {
    background: rgba(255, 255, 255, 0.05);
}

.nav-item-inactive:hover {
    color: #ffffff;
    background: rgba(255, 255, 255, 0.08);
    transform: translateX(4px);
}

.nav-item-inactive:hover .nav-icon-wrapper {
    background: rgba(255, 255, 255, 0.12);
    transform: scale(1.1);
}

.nav-item-active {
    color: #ffffff;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(139, 92, 246, 0.2));
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
    transform: translateX(4px);
}

.nav-item-active .nav-icon-wrapper {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

.nav-indicator {
    position: absolute;
    right: 0.75rem;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    opacity: 0;
    transform: scale(0);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-item-active .nav-indicator {
    opacity: 1;
    transform: scale(1);
}

/* Animation for nav items */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.nav-item {
    animation: slideIn 0.3s ease-out;
    animation-fill-mode: both;
}

.nav-item:nth-child(1) { animation-delay: 0.05s; }
.nav-item:nth-child(2) { animation-delay: 0.1s; }
.nav-item:nth-child(3) { animation-delay: 0.15s; }
.nav-item:nth-child(4) { animation-delay: 0.2s; }
.nav-item:nth-child(5) { animation-delay: 0.25s; }
.nav-item:nth-child(6) { animation-delay: 0.3s; }
.nav-item:nth-child(7) { animation-delay: 0.35s; }
.nav-item:nth-child(8) { animation-delay: 0.4s; }
.nav-item:nth-child(9) { animation-delay: 0.45s; }
.nav-item:nth-child(10) { animation-delay: 0.5s; }
.nav-item:nth-child(11) { animation-delay: 0.55s; }
</style>
