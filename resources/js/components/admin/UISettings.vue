<template>
    <div class="w-full overflow-hidden space-y-6">
        <!-- Main Header -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex-1">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">UI Settings</h2>
                    <p class="text-gray-600 text-sm">Customize your website's appearance and design</p>
                </div>
                <button
                    @click="isEditing = !isEditing"
                    :disabled="loading"
                    class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-indigo-600 hover:to-purple-600 transition font-medium shadow-lg shadow-indigo-500/30 transform hover:scale-105 text-sm sm:text-base whitespace-nowrap flex items-center justify-center disabled:opacity-50"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>{{ isEditing ? 'Cancel Editing' : 'Edit UI Settings' }}</span>
                </button>
            </div>
        </div>

        <!-- Success/Error Messages -->
        <div v-if="message" :class="messageType === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800'" class="border rounded-xl p-4">
            {{ message }}
        </div>

        <!-- Color Scheme Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 p-5">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Color Scheme</h2>
                        <p class="text-white/90 text-sm">Primary and secondary colors</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Primary Color</label>
                        <div class="flex items-center space-x-3">
                            <input 
                                type="color" 
                                v-model="uiSettings.primary_color" 
                                :disabled="!isEditing"
                                class="w-16 h-16 rounded-lg border-2 border-gray-200 cursor-pointer disabled:cursor-not-allowed"
                            />
                            <input 
                                type="text" 
                                v-model="uiSettings.primary_color" 
                                :disabled="!isEditing"
                                class="flex-1 px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                                placeholder="#3B82F6"
                            />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Secondary Color</label>
                        <div class="flex items-center space-x-3">
                            <input 
                                type="color" 
                                v-model="uiSettings.secondary_color" 
                                :disabled="!isEditing"
                                class="w-16 h-16 rounded-lg border-2 border-gray-200 cursor-pointer disabled:cursor-not-allowed"
                            />
                            <input 
                                type="text" 
                                v-model="uiSettings.secondary_color" 
                                :disabled="!isEditing"
                                class="flex-1 px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                                placeholder="#8B5CF6"
                            />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Accent Color</label>
                        <div class="flex items-center space-x-3">
                            <input 
                                type="color" 
                                v-model="uiSettings.accent_color" 
                                :disabled="!isEditing"
                                class="w-16 h-16 rounded-lg border-2 border-gray-200 cursor-pointer disabled:cursor-not-allowed"
                            />
                            <input 
                                type="text" 
                                v-model="uiSettings.accent_color" 
                                :disabled="!isEditing"
                                class="flex-1 px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                                placeholder="#EC4899"
                            />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Background Color</label>
                        <div class="flex items-center space-x-3">
                            <input 
                                type="color" 
                                v-model="uiSettings.background_color" 
                                :disabled="!isEditing"
                                class="w-16 h-16 rounded-lg border-2 border-gray-200 cursor-pointer disabled:cursor-not-allowed"
                            />
                            <input 
                                type="text" 
                                v-model="uiSettings.background_color" 
                                :disabled="!isEditing"
                                class="flex-1 px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                                placeholder="#F9FAFB"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Typography Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 p-5">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Typography</h2>
                        <p class="text-white/90 text-sm">Font family and text styles</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Font Family</label>
                        <select 
                            v-model="uiSettings.font_family" 
                            :disabled="!isEditing"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100 appearance-none"
                        >
                            <option value="Inter">Inter</option>
                            <option value="Roboto">Roboto</option>
                            <option value="Open Sans">Open Sans</option>
                            <option value="Poppins">Poppins</option>
                            <option value="Montserrat">Montserrat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Heading Font Family</label>
                        <select 
                            v-model="uiSettings.heading_font_family" 
                            :disabled="!isEditing"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100 appearance-none"
                        >
                            <option value="Inter">Inter</option>
                            <option value="Roboto">Roboto</option>
                            <option value="Open Sans">Open Sans</option>
                            <option value="Poppins">Poppins</option>
                            <option value="Montserrat">Montserrat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Base Font Size (px)</label>
                        <input 
                            type="number" 
                            v-model.number="uiSettings.base_font_size" 
                            :disabled="!isEditing"
                            min="10"
                            max="24"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Heading Font Size Multiplier</label>
                        <input 
                            type="number" 
                            v-model.number="uiSettings.heading_font_size_multiplier" 
                            :disabled="!isEditing"
                            min="1"
                            max="3"
                            step="0.1"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Line Height</label>
                        <input 
                            type="number" 
                            v-model.number="uiSettings.line_height" 
                            :disabled="!isEditing"
                            min="1"
                            max="3"
                            step="0.1"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- Button Styles Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 p-5">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Button Styles</h2>
                        <p class="text-white/90 text-sm">Customize button appearance</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Button Border Radius (px)</label>
                        <input 
                            type="number" 
                            v-model.number="uiSettings.button_border_radius" 
                            :disabled="!isEditing"
                            min="0"
                            max="50"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Button Padding (px)</label>
                        <input 
                            type="number" 
                            v-model.number="uiSettings.button_padding" 
                            :disabled="!isEditing"
                            min="4"
                            max="32"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Button Style</label>
                        <select 
                            v-model="uiSettings.button_style" 
                            :disabled="!isEditing"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100 appearance-none"
                        >
                            <option value="solid">Solid</option>
                            <option value="outline">Outline</option>
                            <option value="ghost">Ghost</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Layout Settings Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 p-5">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Layout Settings</h2>
                        <p class="text-white/90 text-sm">Container and spacing settings</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Container Max Width (px)</label>
                        <input 
                            type="number" 
                            v-model.number="uiSettings.container_max_width" 
                            :disabled="!isEditing"
                            min="320"
                            max="1920"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Section Padding (px)</label>
                        <input 
                            type="number" 
                            v-model.number="uiSettings.section_padding" 
                            :disabled="!isEditing"
                            min="0"
                            max="200"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                        />
                    </div>
                    <div class="md:col-span-2">
                        <div class="space-y-4">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    v-model="uiSettings.enable_shadows" 
                                    :disabled="!isEditing"
                                    class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 disabled:opacity-50"
                                />
                                <span class="text-sm font-semibold text-gray-700">Enable Box Shadows</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    v-model="uiSettings.enable_animations" 
                                    :disabled="!isEditing"
                                    class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 disabled:opacity-50"
                                />
                                <span class="text-sm font-semibold text-gray-700">Enable Animations</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 pb-6 flex justify-end space-x-3">
                <button
                    @click="cancelEditing"
                    v-if="isEditing"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2.5 rounded-xl font-medium transition flex items-center space-x-2"
                >
                    <span>Cancel</span>
                </button>
                <button
                    @click="saveSettings"
                    :disabled="loading || !isEditing"
                    class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white px-6 py-2.5 rounded-xl font-medium transition flex items-center space-x-2 disabled:opacity-50 shadow-lg shadow-indigo-500/30"
                >
                    <svg v-if="!loading" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span v-if="loading">Saving...</span>
                    <span v-else>Save Changes</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'UISettings',
    setup() {
        const uiSettings = ref({
            id: null,
            primary_color: '#f96262',
            secondary_color: '#8B5CF6',
            accent_color: '#EC4899',
            background_color: '#F9FAFB',
            font_family: 'Inter',
            heading_font_family: 'Inter',
            base_font_size: 16,
            heading_font_size_multiplier: 1.5,
            line_height: 1.6,
            button_border_radius: 8,
            button_padding: 12,
            button_style: 'solid',
            container_max_width: 1280,
            section_padding: 80,
            enable_shadows: true,
            enable_animations: true,
        });

        const isEditing = ref(false);
        const loading = ref(false);
        const message = ref('');
        const messageType = ref('success');

        const fetchUISettings = async () => {
            try {
                const response = await axios.get('/api/ui-settings');
                if (response.data.success && response.data.settings) {
                    const settings = response.data.settings;
                    Object.keys(uiSettings.value).forEach(key => {
                        if (settings[key] !== null && settings[key] !== undefined) {
                            uiSettings.value[key] = settings[key];
                        }
                    });
                    uiSettings.value.id = settings.id;
                }
            } catch (error) {
                console.error('Error fetching UI settings:', error);
            }
        };

        const saveSettings = async () => {
            if (!isEditing.value) return;
            
            loading.value = true;
            message.value = '';

            try {
                const response = await axios.post('/api/ui-settings', uiSettings.value);
                
                if (response.data.success) {
                    message.value = 'UI settings saved successfully!';
                    messageType.value = 'success';
                    isEditing.value = false;
                    await fetchUISettings();
                    setTimeout(() => {
                        message.value = '';
                    }, 3000);
                }
            } catch (error) {
                console.error('Error saving UI settings:', error);
                message.value = error.response?.data?.message || 'Error saving UI settings';
                messageType.value = 'error';
            } finally {
                loading.value = false;
            }
        };

        const cancelEditing = () => {
            isEditing.value = false;
            fetchUISettings();
            message.value = '';
        };

        const resetToDefault = async () => {
            if (!confirm('Are you sure you want to reset all settings to default values?')) {
                return;
            }

            uiSettings.value = {
                ...uiSettings.value,
                primary_color: '#f96262',
                secondary_color: '#8B5CF6',
                accent_color: '#EC4899',
                background_color: '#F9FAFB',
                font_family: 'Inter',
                heading_font_family: 'Inter',
                base_font_size: 16,
                heading_font_size_multiplier: 1.5,
                line_height: 1.6,
                button_border_radius: 8,
                button_padding: 12,
                button_style: 'solid',
                container_max_width: 1280,
                section_padding: 80,
                enable_shadows: true,
                enable_animations: true,
            };

            if (isEditing.value) {
                await saveSettings();
            }
        };

        onMounted(() => {
            fetchUISettings();
        });

        return {
            uiSettings,
            isEditing,
            loading,
            message,
            messageType,
            saveSettings,
            resetToDefault,
            cancelEditing
        };
    }
};
</script>

<style scoped>
select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}
</style>
