<template>
    <aside 
        class="admin-sidebar min-h-screen fixed left-0 top-0 overflow-y-auto z-50 transition-transform duration-300"
        :class="isOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        style="width: 220px;"
    >
        <!-- Logo Section -->
        <div class="p-3 border-b border-gray-700/30">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2 mb-1 flex-1">
                    <img 
                        v-if="brandSettings.brand_logo_url" 
                        :src="brandSettings.brand_logo_url" 
                        alt="Brand Logo" 
                        class="h-8 w-auto object-contain"
                    >
                    <div>
                        <h1 class="text-lg font-bold bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                            {{ brandSettings.brand_name }}
                        </h1>
                        <p class="text-xs text-gray-300">Admin Panel</p>
                    </div>
                </div>
                <!-- Close Button for Mobile -->
                <button 
                    @click="emit('close')"
                    class="lg:hidden p-1 text-gray-300 hover:text-white"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-2">
            <ul class="space-y-1">
                <!-- Dashboard -->
                <li>
                    <router-link
                        :to="{ name: 'admin.dashboard' }"
                        class="flex items-center px-3 py-2 rounded-lg transition text-sm"
                        active-class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30"
                        inactive-class="text-gray-300 hover:bg-gradient-to-r hover:from-blue-500/20 hover:to-cyan-500/20 hover:text-white"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </router-link>
                </li>

                <!-- Students Management -->
                <li>
                    <router-link
                        :to="{ name: 'admin.students' }"
                        class="flex items-center px-3 py-2 rounded-lg transition text-sm"
                        active-class="bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-lg shadow-green-500/30"
                        inactive-class="text-gray-300 hover:bg-gradient-to-r hover:from-green-500/20 hover:to-emerald-500/20 hover:text-white"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="font-medium">Students</span>
                    </router-link>
                </li>

                <!-- Courses Management -->
                <li>
                    <router-link
                        :to="{ name: 'admin.courses' }"
                        class="flex items-center px-3 py-2 rounded-lg transition text-sm"
                        active-class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/30"
                        inactive-class="text-gray-300 hover:bg-gradient-to-r hover:from-indigo-500/20 hover:to-purple-500/20 hover:text-white"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span class="font-medium">Courses</span>
                    </router-link>
                </li>

                <!-- Live Classes -->
                <li>
                    <router-link
                        :to="{ name: 'admin.live-classes' }"
                        class="flex items-center px-3 py-2 rounded-lg transition text-sm"
                        active-class="bg-gradient-to-r from-red-500 to-orange-500 text-white shadow-lg shadow-red-500/30"
                        inactive-class="text-gray-300 hover:bg-gradient-to-r hover:from-red-500/20 hover:to-orange-500/20 hover:text-white"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">Live Classes</span>
                    </router-link>
                </li>

                <!-- Enrollments -->
                <li>
                    <router-link
                        :to="{ name: 'admin.enrollments' }"
                        class="flex items-center px-3 py-2 rounded-lg transition text-sm"
                        active-class="bg-gradient-to-r from-yellow-500 to-amber-500 text-white shadow-lg shadow-yellow-500/30"
                        inactive-class="text-gray-300 hover:bg-gradient-to-r hover:from-yellow-500/20 hover:to-amber-500/20 hover:text-white"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="font-medium">Enrollments</span>
                    </router-link>
                </li>

                <!-- Certificates -->
                <li>
                    <router-link
                        :to="{ name: 'admin.certificates' }"
                        class="flex items-center px-3 py-2 rounded-lg transition text-sm"
                        active-class="bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg shadow-teal-500/30"
                        inactive-class="text-gray-300 hover:bg-gradient-to-r hover:from-teal-500/20 hover:to-cyan-500/20 hover:text-white"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        <span class="font-medium">Certificates</span>
                    </router-link>
                </li>

                <!-- Payments -->
                <li>
                    <router-link
                        :to="{ name: 'admin.payments' }"
                        class="flex items-center px-3 py-2 rounded-lg transition text-sm"
                        active-class="bg-gradient-to-r from-emerald-500 to-green-500 text-white shadow-lg shadow-emerald-500/30"
                        inactive-class="text-gray-300 hover:bg-gradient-to-r hover:from-emerald-500/20 hover:to-green-500/20 hover:text-white"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="font-medium">Payments</span>
                    </router-link>
                </li>

                <!-- Reports -->
                <li>
                    <router-link
                        :to="{ name: 'admin.reports' }"
                        class="flex items-center px-3 py-2 rounded-lg transition text-sm"
                        active-class="bg-gradient-to-r from-violet-500 to-purple-500 text-white shadow-lg shadow-violet-500/30"
                        inactive-class="text-gray-300 hover:bg-gradient-to-r hover:from-violet-500/20 hover:to-purple-500/20 hover:text-white"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="font-medium">Reports</span>
                    </router-link>
                </li>

                <!-- Admin Management -->
                <li>
                    <router-link
                        :to="{ name: 'admin.management' }"
                        class="flex items-center px-3 py-2 rounded-lg transition text-sm"
                        active-class="bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-lg shadow-purple-500/30"
                        inactive-class="text-gray-300 hover:bg-gradient-to-r hover:from-purple-500/20 hover:to-pink-500/20 hover:text-white"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="font-medium">Admin Management</span>
                    </router-link>
                </li>

                <!-- UI Settings -->
                <li>
                    <router-link
                        :to="{ name: 'admin.ui-settings' }"
                        class="flex items-center px-3 py-2 rounded-lg transition text-sm"
                        active-class="bg-gradient-to-r from-pink-500 to-rose-500 text-white shadow-lg shadow-pink-500/30"
                        inactive-class="text-gray-300 hover:bg-gradient-to-r hover:from-pink-500/20 hover:to-rose-500/20 hover:text-white"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                        <span class="font-medium">UI Settings</span>
                    </router-link>
                </li>

                <!-- Settings -->
                <li>
                    <router-link
                        :to="{ name: 'admin.settings' }"
                        class="flex items-center px-3 py-2 rounded-lg transition text-sm"
                        active-class="bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-lg shadow-orange-500/30"
                        inactive-class="text-gray-300 hover:bg-gradient-to-r hover:from-orange-500/20 hover:to-red-500/20 hover:text-white"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="font-medium">Settings</span>
                    </router-link>
                </li>
            </ul>
        </nav>

        <!-- User Section -->
        <div class="absolute bottom-0 left-0 right-0 p-2 border-t border-gray-700/30">
            <div class="flex items-center mb-2">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-2 shadow-lg">
                    <span class="text-white font-semibold text-xs">{{ userInitials }}</span>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-medium text-white">{{ userName }}</p>
                    <p class="text-xs text-gray-300">Administrator</p>
                </div>
            </div>
            <button
                @click="handleLogout"
                class="w-full bg-gradient-to-r from-red-500 to-pink-500 text-white px-3 py-1.5 rounded-lg hover:from-red-600 hover:to-pink-600 transition text-xs font-medium shadow-lg shadow-red-500/30"
            >
                Logout
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
            emit
        };
    }
};
</script>

<style scoped>
.admin-sidebar {
    z-index: 1000;
    background: linear-gradient(180deg, #1e1b4b 0%, #312e81 50%, #1e1b4b 100%);
    box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
    overflow-x: hidden;
    overflow-y: auto;
    max-width: 220px;
}
</style>

