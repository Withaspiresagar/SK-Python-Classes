<template>
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <img 
                        v-if="brandSettings.brand_logo_url" 
                        :src="brandSettings.brand_logo_url" 
                        :alt="brandSettings.brand_name"
                        class="h-10 w-auto"
                    >
                    <h1 class="text-2xl font-bold text-blue-600">{{ brandSettings.brand_name || 'SK Python Classes' }}</h1>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 transition font-medium">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-blue-600 transition font-medium">About</a>
                    <a href="#courses" class="text-gray-700 hover:text-blue-600 transition font-medium">Courses</a>
                    <a href="#features" class="text-gray-700 hover:text-blue-600 transition font-medium">Features</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-600 transition font-medium">Contact</a>
                </div>

                <!-- CTA Button -->
                <div class="flex items-center space-x-4">
                    <button 
                        @click="scrollToContact"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium"
                    >
                        Enroll Now
                    </button>
                    
                    <!-- Mobile Menu Button -->
                    <button 
                        @click="toggleMobileMenu"
                        class="md:hidden text-gray-700 focus:outline-none"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div v-if="mobileMenuOpen" class="md:hidden mt-4 pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="#home" @click="closeMobileMenu" class="text-gray-700 hover:text-blue-600 transition font-medium py-2">Home</a>
                    <a href="#about" @click="closeMobileMenu" class="text-gray-700 hover:text-blue-600 transition font-medium py-2">About</a>
                    <a href="#courses" @click="closeMobileMenu" class="text-gray-700 hover:text-blue-600 transition font-medium py-2">Courses</a>
                    <a href="#features" @click="closeMobileMenu" class="text-gray-700 hover:text-blue-600 transition font-medium py-2">Features</a>
                    <a href="#contact" @click="closeMobileMenu" class="text-gray-700 hover:text-blue-600 transition font-medium py-2">Contact</a>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'Header',
    setup() {
        const mobileMenuOpen = ref(false);
        const brandSettings = ref({
            brand_name: 'SK Python Classes',
            brand_logo_url: null
        });

        const fetchBrandSettings = async () => {
            try {
                const response = await axios.get('/api/brand-settings');
                if (response.data.success && response.data.settings) {
                    const settings = response.data.settings;
                    brandSettings.value = {
                        brand_name: settings.brand_name || 'SK Python Classes',
                        brand_logo_url: settings.brand_logo ? `/storage/${settings.brand_logo}` : null
                    };
                    
                    // Update favicon if available
                    if (settings.favicon) {
                        updateFavicon(`/storage/${settings.favicon}`);
                    }
                }
            } catch (error) {
                console.error('Error fetching brand settings:', error);
            }
        };

        const updateFavicon = (faviconUrl) => {
            let link = document.querySelector("link[rel*='icon']") || document.createElement('link');
            link.type = 'image/x-icon';
            link.rel = 'shortcut icon';
            link.href = faviconUrl;
            document.getElementsByTagName('head')[0].appendChild(link);
        };

        const toggleMobileMenu = () => {
            mobileMenuOpen.value = !mobileMenuOpen.value;
        };

        const closeMobileMenu = () => {
            mobileMenuOpen.value = false;
        };

        const scrollToContact = () => {
            const contactSection = document.getElementById('contact');
            if (contactSection) {
                contactSection.scrollIntoView({ behavior: 'smooth' });
            }
            closeMobileMenu();
        };

        onMounted(() => {
            fetchBrandSettings();
        });

        return {
            mobileMenuOpen,
            brandSettings,
            toggleMobileMenu,
            closeMobileMenu,
            scrollToContact
        };
    }
};
</script>

<style scoped>
.container {
    max-width: 1200px;
    margin: 0 auto;
}
</style>

