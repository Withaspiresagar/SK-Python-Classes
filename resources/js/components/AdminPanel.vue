<template>
    <div class="admin-panel min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/20 to-purple-50/20 overflow-x-hidden">
        <!-- Mobile Menu Overlay -->
        <div 
            v-if="sidebarOpen" 
            class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
            @click="toggleSidebar"
        ></div>

        <!-- Sidebar -->
        <AdminSidebar :user="user" :is-open="sidebarOpen" @close="toggleSidebar" />

        <!-- Main Content -->
        <div class="main-content-wrapper lg:ml-[220px] transition-all duration-300">
            <!-- Admin Header - Fixed at top, outside content area -->
            <AdminHeader 
                :page-title="currentPageTitle"
                :page-subtitle="currentPageSubtitle"
                :user-name="user?.name || 'Admin'"
                @toggle-sidebar="toggleSidebar"
            />

            <!-- Content Area - Below header with proper spacing -->
            <div class="main-content-area">
                <router-view :key="$route.fullPath" />
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import AdminSidebar from './AdminSidebar.vue';
import AdminHeader from './AdminHeader.vue';

export default {
    name: 'AdminPanel',
    components: {
        AdminSidebar,
        AdminHeader
    },
    setup() {
        const route = useRoute();
        const user = ref(null);
        const sidebarOpen = ref(false);

        console.log('🔵 AdminPanel setup() called');
        console.log('🔵 Route:', route);
        console.log('🔵 Route name:', route.name);
        console.log('🔵 Route meta:', route.meta);

        const currentPageTitle = computed(() => {
            const title = route.meta?.title || 'Dashboard';
            console.log('🔵 currentPageTitle computed:', title);
            return title;
        });

        const currentPageSubtitle = computed(() => {
            const subtitle = route.meta?.subtitle || 'SK Python Classes Management';
            console.log('🔵 currentPageSubtitle computed:', subtitle);
            return subtitle;
        });

        const toggleSidebar = () => {
            sidebarOpen.value = !sidebarOpen.value;
        };

        onMounted(() => {
            console.log('🔵 AdminPanel onMounted() called');
            console.log('🔵 Header elements in DOM:', document.querySelectorAll('header').length);
            console.log('🔵 Admin header elements:', document.querySelectorAll('.admin-header, #admin-main-header').length);
            fetchUser();
        });

        const fetchUser = async () => {
            try {
                const response = await axios.get('/api/user');
                if (response.data.user) {
                    user.value = response.data.user;
                }
            } catch (error) {
                console.error('Error fetching user:', error);
                if (error.response && error.response.status === 401) {
                    window.location.href = '/login';
                }
            }
        };

        const routeName = computed(() => route.name);

        return {
            user,
            sidebarOpen,
            toggleSidebar,
            currentPageTitle,
            currentPageSubtitle,
            routeName
        };
    }
};
</script>

<style scoped>
.admin-panel {
    width: 100%;
    overflow-x: hidden;
}

.main-content-wrapper {
    width: 100%;
    min-height: 100vh;
    max-width: 100%;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
}

@media (min-width: 1024px) {
    .main-content-wrapper {
        margin-left: 220px;
        width: calc(100% - 220px);
    }
}

.main-content-area {
    flex: 1;
    width: 100%;
    overflow-x: hidden;
    padding: 1rem;
    position: relative;
}

@media (min-width: 640px) {
    .main-content-area {
        padding: 1.5rem;
    }
}

@media (min-width: 768px) {
    .main-content-area {
        padding: 2rem;
    }
}
</style>

