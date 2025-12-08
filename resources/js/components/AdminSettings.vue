<template>
    <div class="admin-settings w-full overflow-hidden">
        <!-- Brand Settings Section -->
        <div class="settings-section mb-6">
            <div class="settings-card">
                <form @submit.prevent="saveBrandSettings" class="space-y-6">
                    <!-- Brand Name -->
                    <div class="form-group">
                        <label class="form-label">Brand Name</label>
                        <input 
                            type="text" 
                            v-model="brandSettings.brand_name" 
                            class="form-input" 
                            placeholder="Enter brand name"
                            :disabled="!isEditing"
                            required
                        >
                        <p class="form-hint">This will be displayed in the header and throughout the site</p>
                    </div>

                    <!-- Tagline -->
                    <div class="form-group">
                        <label class="form-label">Tagline</label>
                        <input 
                            type="text" 
                            v-model="brandSettings.tagline" 
                            class="form-input" 
                            placeholder="Enter tagline"
                            :disabled="!isEditing"
                        >
                        <p class="form-hint">A short description or tagline for your brand</p>
                    </div>

                    <!-- Brand Logo -->
                    <div class="form-group">
                        <label class="form-label">Brand Logo</label>
                        <div class="file-upload-container">
                            <div class="file-upload-area">
                                <input 
                                    type="file" 
                                    @change="handleLogoUpload"
                                    accept="image/*"
                                    class="file-input"
                                    id="logo-upload"
                                    :disabled="!isEditing"
                                >
                                <label 
                                    for="logo-upload" 
                                    class="file-upload-label"
                                    :class="{ 'disabled': !isEditing }"
                                >
                                    <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <span class="upload-text">Choose Logo</span>
                                </label>
                                <p class="file-hint">Recommended: 200x50px, Max: 2MB</p>
                            </div>
                            <div v-if="brandSettings.brand_logo_preview || brandSettings.brand_logo_url" class="preview-container">
                                <img 
                                    :src="brandSettings.brand_logo_preview || brandSettings.brand_logo_url" 
                                    alt="Brand Logo" 
                                    class="preview-image"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Favicon -->
                    <div class="form-group">
                        <label class="form-label">Favicon</label>
                        <div class="file-upload-container">
                            <div class="file-upload-area">
                                <input 
                                    type="file" 
                                    @change="handleFaviconUpload"
                                    accept="image/*,.ico"
                                    class="file-input"
                                    id="favicon-upload"
                                    :disabled="!isEditing"
                                >
                                <label 
                                    for="favicon-upload" 
                                    class="file-upload-label"
                                    :class="{ 'disabled': !isEditing }"
                                >
                                    <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <span class="upload-text">Choose Favicon</span>
                                </label>
                                <p class="file-hint">Recommended: 32x32px, Max: 512KB</p>
                            </div>
                            <div v-if="brandSettings.favicon_preview || brandSettings.favicon_url" class="preview-container">
                                <img 
                                    :src="brandSettings.favicon_preview || brandSettings.favicon_url" 
                                    alt="Favicon" 
                                    class="preview-image-small"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <textarea 
                            v-model="brandSettings.address" 
                            rows="3" 
                            class="form-textarea" 
                            placeholder="Enter institute address"
                            :disabled="!isEditing"
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input 
                            type="email" 
                            v-model="brandSettings.email" 
                            class="form-input" 
                            placeholder="info@skpythonclasses.com"
                            :disabled="!isEditing"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input 
                            type="tel" 
                            v-model="brandSettings.phone" 
                            class="form-input" 
                            placeholder="+91 98765 43210"
                            :disabled="!isEditing"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">WhatsApp Number</label>
                        <input 
                            type="tel" 
                            v-model="brandSettings.whatsapp" 
                            class="form-input" 
                            placeholder="+91 98765 43210"
                            :disabled="!isEditing"
                        >
                    </div>

                    <!-- Social Media Links -->
                    <div class="form-group">
                        <label class="form-label">Social Media Links</label>
                        <div class="social-grid">
                            <div class="social-field">
                                <label class="social-label">Instagram</label>
                                <input 
                                    type="url" 
                                    v-model="brandSettings.instagram" 
                                    class="form-input" 
                                    placeholder="https://instagram.com/yourpage"
                                    :disabled="!isEditing"
                                >
                            </div>
                            <div class="social-field">
                                <label class="social-label">Facebook</label>
                                <input 
                                    type="url" 
                                    v-model="brandSettings.facebook" 
                                    class="form-input" 
                                    placeholder="https://facebook.com/yourpage"
                                    :disabled="!isEditing"
                                >
                            </div>
                            <div class="social-field">
                                <label class="social-label">YouTube</label>
                                <input 
                                    type="url" 
                                    v-model="brandSettings.youtube" 
                                    class="form-input" 
                                    placeholder="https://youtube.com/@yourchannel"
                                    :disabled="!isEditing"
                                >
                            </div>
                            <div class="social-field">
                                <label class="social-label">Twitter</label>
                                <input 
                                    type="url" 
                                    v-model="brandSettings.twitter" 
                                    class="form-input" 
                                    placeholder="https://twitter.com/yourhandle"
                                    :disabled="!isEditing"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Success/Error Messages -->
                    <div v-if="brandSettingsMessage" :class="brandSettingsMessageType === 'success' ? 'alert-success' : 'alert-error'" class="alert">
                        {{ brandSettingsMessage }}
                    </div>

                    <!-- Edit/Save Button -->
                    <div class="form-actions">
                        <button 
                            v-if="!isEditing"
                            type="button"
                            @click="enableEditing"
                            class="btn-primary"
                        >
                            Edit Settings
                        </button>
                        <div v-else class="flex gap-3">
                            <button 
                                type="button"
                                @click="cancelEditing"
                                class="btn-secondary"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit" 
                                :disabled="brandSettingsLoading"
                                class="btn-primary"
                            >
                                <span v-if="!brandSettingsLoading">Save Changes</span>
                                <span v-else class="loading-state">
                                    <svg class="spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Saving...
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'AdminSettings',
    setup() {
        const brandSettings = ref({
            brand_name: 'SK Python Classes',
            tagline: 'Master Python Programming with Expert Guidance',
            brand_logo: null,
            brand_logo_url: null,
            brand_logo_preview: null,
            favicon: null,
            favicon_url: null,
            favicon_preview: null,
            address: '',
            email: '',
            phone: '',
            whatsapp: '',
            instagram: '',
            facebook: '',
            youtube: '',
            twitter: ''
        });

        const brandSettingsLoading = ref(false);
        const brandSettingsMessage = ref('');
        const brandSettingsMessageType = ref('success');
        const isEditing = ref(false);
        const originalSettings = ref({
            brand_name: '',
            tagline: '',
            brand_logo_url: null,
            favicon_url: null,
            address: '',
            email: '',
            phone: '',
            whatsapp: '',
            instagram: '',
            facebook: '',
            youtube: '',
            twitter: ''
        });

        const fetchBrandSettings = async () => {
            try {
                const response = await axios.get('/api/brand-settings');
                if (response.data.success && response.data.settings) {
                    const settings = response.data.settings;
                    brandSettings.value = {
                        brand_name: settings.brand_name || 'SK Python Classes',
                        tagline: settings.tagline || '',
                        brand_logo: null,
                        brand_logo_url: settings.brand_logo ? `/storage/${settings.brand_logo}` : null,
                        brand_logo_preview: null,
                        favicon: null,
                        favicon_url: settings.favicon ? `/storage/${settings.favicon}` : null,
                        favicon_preview: null,
                        address: settings.address || '',
                        email: settings.email || '',
                        phone: settings.phone || '',
                        whatsapp: settings.whatsapp || '',
                        instagram: settings.instagram || '',
                        facebook: settings.facebook || '',
                        youtube: settings.youtube || '',
                        twitter: settings.twitter || ''
                    };
                    // Save original values
                    originalSettings.value = {
                        brand_name: brandSettings.value.brand_name,
                        tagline: brandSettings.value.tagline,
                        brand_logo_url: brandSettings.value.brand_logo_url,
                        favicon_url: brandSettings.value.favicon_url,
                        address: brandSettings.value.address,
                        email: brandSettings.value.email,
                        phone: brandSettings.value.phone,
                        whatsapp: brandSettings.value.whatsapp,
                        instagram: brandSettings.value.instagram,
                        facebook: brandSettings.value.facebook,
                        youtube: brandSettings.value.youtube,
                        twitter: brandSettings.value.twitter
                    };
                }
            } catch (error) {
                console.error('Error fetching brand settings:', error);
            }
        };

        const enableEditing = () => {
            isEditing.value = true;
            brandSettingsMessage.value = '';
        };

        const cancelEditing = () => {
            isEditing.value = false;
            // Restore original values
            brandSettings.value.brand_name = originalSettings.value.brand_name;
            brandSettings.value.tagline = originalSettings.value.tagline;
            brandSettings.value.brand_logo_url = originalSettings.value.brand_logo_url;
            brandSettings.value.favicon_url = originalSettings.value.favicon_url;
            brandSettings.value.address = originalSettings.value.address;
            brandSettings.value.email = originalSettings.value.email;
            brandSettings.value.phone = originalSettings.value.phone;
            brandSettings.value.whatsapp = originalSettings.value.whatsapp;
            brandSettings.value.instagram = originalSettings.value.instagram;
            brandSettings.value.facebook = originalSettings.value.facebook;
            brandSettings.value.youtube = originalSettings.value.youtube;
            brandSettings.value.twitter = originalSettings.value.twitter;
            brandSettings.value.brand_logo_preview = null;
            brandSettings.value.favicon_preview = null;
            brandSettings.value.brand_logo = null;
            brandSettings.value.favicon = null;
            brandSettingsMessage.value = '';
        };

        const handleLogoUpload = (event) => {
            const file = event.target.files[0];
            if (file) {
                brandSettings.value.brand_logo = file;
                const reader = new FileReader();
                reader.onload = (e) => {
                    brandSettings.value.brand_logo_preview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const handleFaviconUpload = (event) => {
            const file = event.target.files[0];
            if (file) {
                brandSettings.value.favicon = file;
                const reader = new FileReader();
                reader.onload = (e) => {
                    brandSettings.value.favicon_preview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const saveBrandSettings = async () => {
            brandSettingsLoading.value = true;
            brandSettingsMessage.value = '';

            try {
                const formData = new FormData();
                formData.append('brand_name', brandSettings.value.brand_name);
                formData.append('tagline', brandSettings.value.tagline || '');
                formData.append('address', brandSettings.value.address || '');
                formData.append('email', brandSettings.value.email || '');
                formData.append('phone', brandSettings.value.phone || '');
                formData.append('whatsapp', brandSettings.value.whatsapp || '');
                formData.append('instagram', brandSettings.value.instagram || '');
                formData.append('facebook', brandSettings.value.facebook || '');
                formData.append('youtube', brandSettings.value.youtube || '');
                formData.append('twitter', brandSettings.value.twitter || '');
                
                if (brandSettings.value.brand_logo) {
                    formData.append('brand_logo', brandSettings.value.brand_logo);
                }
                
                if (brandSettings.value.favicon) {
                    formData.append('favicon', brandSettings.value.favicon);
                }

                const response = await axios.post('/api/brand-settings', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if (response.data.success) {
                    brandSettingsMessage.value = 'Brand settings saved successfully!';
                    brandSettingsMessageType.value = 'success';
                    
                    if (response.data.settings.brand_logo) {
                        brandSettings.value.brand_logo_url = `/storage/${response.data.settings.brand_logo}`;
                        brandSettings.value.brand_logo_preview = null;
                    }
                    if (response.data.settings.favicon) {
                        brandSettings.value.favicon_url = `/storage/${response.data.settings.favicon}`;
                        brandSettings.value.favicon_preview = null;
                    }
                    
                    // Update original settings
                    originalSettings.value = {
                        brand_name: brandSettings.value.brand_name,
                        tagline: brandSettings.value.tagline,
                        brand_logo_url: brandSettings.value.brand_logo_url,
                        favicon_url: brandSettings.value.favicon_url,
                        address: brandSettings.value.address,
                        email: brandSettings.value.email,
                        phone: brandSettings.value.phone,
                        whatsapp: brandSettings.value.whatsapp,
                        instagram: brandSettings.value.instagram,
                        facebook: brandSettings.value.facebook,
                        youtube: brandSettings.value.youtube,
                        twitter: brandSettings.value.twitter
                    };
                    
                    // Disable editing mode
                    isEditing.value = false;
                    
                    updateFavicon();
                }
            } catch (error) {
                brandSettingsMessage.value = error.response?.data?.message || 'Error saving brand settings';
                brandSettingsMessageType.value = 'error';
            } finally {
                brandSettingsLoading.value = false;
            }
        };

        const updateFavicon = () => {
            if (brandSettings.value.favicon_url) {
                let link = document.querySelector("link[rel*='icon']") || document.createElement('link');
                link.type = 'image/x-icon';
                link.rel = 'shortcut icon';
                link.href = brandSettings.value.favicon_url;
                document.getElementsByTagName('head')[0].appendChild(link);
            }
        };

        onMounted(() => {
            fetchBrandSettings();
        });

        return {
            brandSettings,
            brandSettingsLoading,
            brandSettingsMessage,
            brandSettingsMessageType,
            isEditing,
            handleLogoUpload,
            handleFaviconUpload,
            saveBrandSettings,
            enableEditing,
            cancelEditing
        };
    }
};
</script>

<style scoped>
.admin-settings {
    max-width: 100%;
    width: 100%;
    overflow-x: hidden;
    box-sizing: border-box;
}

.settings-section {
    margin-bottom: 1.5rem;
}

.section-header {
    margin-bottom: 1rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1d1d1f;
    margin-bottom: 0.25rem;
    letter-spacing: -0.02em;
}

.section-description {
    font-size: 0.875rem;
    color: #86868b;
    line-height: 1.5;
    margin-top: 0.25rem;
}

@media (min-width: 640px) {
    .section-title {
        font-size: 1.75rem;
    }
    
    .section-description {
        font-size: 0.9375rem;
    }
}

.settings-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 18px;
    padding: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(255, 107, 0, 0.1);
    border: 1px solid rgba(255, 107, 0, 0.1);
    transition: all 0.3s ease;
}

@media (min-width: 640px) {
    .settings-section {
        margin-bottom: 2rem;
    }
    
    .section-header {
        margin-bottom: 1.5rem;
    }
    
    .section-title {
        font-size: 1.5rem;
    }
    
    .section-description {
        font-size: 0.9375rem;
    }
    
    .settings-card {
        padding: 2rem;
    }
}

.settings-card:hover {
    box-shadow: 0 8px 30px rgba(255, 107, 0, 0.15), 0 0 0 1px rgba(255, 107, 0, 0.2);
    transform: translateY(-2px);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #1d1d1f;
    margin-bottom: 0.5rem;
    letter-spacing: -0.01em;
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 0.875rem 1rem;
    font-size: 1rem;
    color: #1d1d1f;
    background: #f5f5f7;
    border: 1px solid transparent;
    border-radius: 12px;
    transition: all 0.2s ease;
    outline: none;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.form-input:focus,
.form-textarea:focus {
    background: #ffffff;
    border-color: #ff6b00;
    box-shadow: 0 0 0 4px rgba(255, 107, 0, 0.15);
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

.form-hint {
    font-size: 0.8125rem;
    color: #86868b;
    margin-top: 0.5rem;
    line-height: 1.4;
}

.file-upload-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: flex-start;
}

@media (min-width: 640px) {
    .file-upload-container {
        flex-direction: row;
        gap: 1.5rem;
    }
}

.file-upload-area {
    flex: 1;
}

.file-input {
    display: none;
}

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: #f5f5f7;
    border: 2px dashed #d2d2d7;
    border-radius: 12px;
    cursor: pointer;
    color: #ff6b00;
    transition: all 0.2s ease;
    min-height: 120px;
}

.file-upload-label:hover {
    background: linear-gradient(135deg, #fff5f0 0%, #ffe8e0 100%);
    border-color: #ff6b00;
}

.upload-icon {
    width: 2rem;
    height: 2rem;
    color: #ff6b00;
    margin-bottom: 0.5rem;
}

.upload-text {
    font-size: 0.9375rem;
    font-weight: 500;
    color: #ff6b00;
    margin-bottom: 0.25rem;
}

.file-hint {
    font-size: 0.75rem;
    color: #86868b;
    text-align: center;
}

.preview-container {
    flex-shrink: 0;
}

.preview-image {
    height: 80px;
    width: auto;
    border-radius: 10px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.preview-image-small {
    height: 48px;
    width: 48px;
    border-radius: 10px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.alert {
    padding: 1rem 1.25rem;
    border-radius: 12px;
    font-size: 0.9375rem;
    line-height: 1.5;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    border: 1px solid #28a745;
    box-shadow: 0 2px 10px rgba(40, 167, 69, 0.2);
}

.alert-error {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
    border: 1px solid #dc3545;
    box-shadow: 0 2px 10px rgba(220, 53, 69, 0.2);
}

.form-actions {
    display: flex;
    flex-direction: column-reverse;
    gap: 0.75rem;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

@media (min-width: 640px) {
    .form-actions {
        flex-direction: row;
        justify-content: flex-end;
        gap: 0;
        margin-top: 2rem;
    }
}

.btn-primary {
    padding: 0.75rem 1.5rem;
    font-size: 0.9375rem;
    font-weight: 500;
    color: #ffffff;
    background: linear-gradient(135deg, #ff6b00 0%, #ff4757 50%, #ff6348 100%);
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    letter-spacing: -0.01em;
    box-shadow: 0 4px 15px rgba(255, 107, 0, 0.3);
    width: 100%;
}

@media (min-width: 640px) {
    .btn-primary {
        padding: 0.75rem 2rem;
        font-size: 1rem;
        width: auto;
    }
}

.btn-primary:hover:not(:disabled) {
    background: linear-gradient(135deg, #ff5722 0%, #e63946 50%, #ff4757 100%);
    box-shadow: 0 6px 20px rgba(255, 107, 0, 0.4);
    transform: translateY(-2px);
}

.btn-primary:active:not(:disabled) {
    transform: translateY(0);
}

.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn-secondary {
    padding: 0.75rem 1.5rem;
    font-size: 0.9375rem;
    font-weight: 500;
    color: #1d1d1f;
    background: #f5f5f7;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    letter-spacing: -0.01em;
    width: 100%;
}

@media (min-width: 640px) {
    .btn-secondary {
        padding: 0.75rem 2rem;
        font-size: 1rem;
        width: auto;
    }
}

.btn-secondary:hover {
    background: #e8e8ed;
    transform: translateY(-1px);
}

.btn-secondary:active {
    transform: translateY(0);
}

.form-input:disabled,
.form-textarea:disabled {
    background: #f5f5f7;
    color: #86868b;
    cursor: not-allowed;
    opacity: 0.7;
}

.file-upload-label.disabled {
    opacity: 0.6;
    cursor: not-allowed;
    pointer-events: none;
}

.loading-state {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.spinner {
    width: 1rem;
    height: 1rem;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.toggle-group {
    margin-top: 1rem;
}

.toggle-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 0;
}

.toggle-content {
    flex: 1;
    margin-right: 1rem;
}

.toggle-title {
    font-size: 1rem;
    font-weight: 500;
    color: #1d1d1f;
    margin-bottom: 0.25rem;
    letter-spacing: -0.01em;
}

.toggle-description {
    font-size: 0.875rem;
    color: #86868b;
    line-height: 1.4;
}

.toggle-switch {
    position: relative;
    display: inline-block;
    width: 51px;
    height: 31px;
    flex-shrink: 0;
}

.toggle-input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #d2d2d7;
    transition: 0.3s;
    border-radius: 31px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 27px;
    width: 27px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.toggle-input:checked + .toggle-slider {
    background-color: #007aff;
}

.toggle-input:checked + .toggle-slider:before {
    transform: translateX(20px);
}

.toggle-input:focus + .toggle-slider {
    box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.1);
}

.divider {
    height: 1px;
    background: rgba(0, 0, 0, 0.05);
    margin: 0.5rem 0;
}

.social-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

@media (min-width: 640px) {
    .social-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.social-field {
    display: flex;
    flex-direction: column;
}

.social-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #1d1d1f;
    margin-bottom: 0.5rem;
    letter-spacing: -0.01em;
}

@media (max-width: 768px) {
    .social-grid {
        grid-template-columns: 1fr;
    }
}
</style>
