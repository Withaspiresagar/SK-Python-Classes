<template>
    <div class="w-full overflow-hidden space-y-6">
        <!-- Main Header -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex-1">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Settings</h2>
                    <p class="text-gray-600 text-sm">Configure all settings</p>
                </div>
                <button
                    @click="isEditing = !isEditing"
                    :disabled="brandSettingsLoading"
                    class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-indigo-600 hover:to-purple-600 transition font-medium shadow-lg shadow-indigo-500/30 transform hover:scale-105 text-sm sm:text-base whitespace-nowrap flex items-center justify-center disabled:opacity-50"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>{{ isEditing ? 'Cancel Editing' : 'Edit Settings' }}</span>
                </button>
            </div>
        </div>

        <!-- Success/Error Messages -->
        <div v-if="brandSettingsMessage" :class="brandSettingsMessageType === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800'" class="border rounded-xl p-4">
            {{ brandSettingsMessage }}
        </div>

        <!-- Brand Identity Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 p-5">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Brand Identity</h2>
                        <p class="text-white/90 text-sm">Brand name, logo, and tagline</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form @submit.prevent="saveBrandSettings" class="space-y-6">
                    <!-- Brand Name -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Brand Name</label>
                        <input 
                            type="text" 
                            v-model="brandSettings.brand_name" 
                            :disabled="!isEditing"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                            placeholder="Enter brand name"
                            required
                        />
                        <p class="text-xs text-gray-500 mt-2">This will be displayed in the header and throughout the site</p>
                    </div>

                    <!-- Tagline -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Tagline</label>
                        <input 
                            type="text" 
                            v-model="brandSettings.tagline" 
                            :disabled="!isEditing"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                            placeholder="Enter tagline"
                        />
                        <p class="text-xs text-gray-500 mt-2">A short description or tagline for your brand</p>
                    </div>

                    <!-- Brand Logo -->
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">Brand Logo</label>
                        <div class="flex flex-col lg:flex-row gap-4 items-start">
                            <div class="flex-1 w-full">
                                <input 
                                    type="file" 
                                    @change="handleLogoUpload"
                                    accept="image/*"
                                    :disabled="!isEditing"
                                    class="hidden"
                                    id="logo-upload"
                                />
                                <label 
                                    for="logo-upload" 
                                    :class="['block w-full px-4 py-8 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer transition-all duration-300 text-center bg-gray-50', isEditing ? 'hover:border-indigo-500 hover:bg-indigo-50/30' : 'opacity-50 cursor-not-allowed']"
                                >
                                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <div class="text-sm font-medium text-gray-700 mb-1">Click to upload logo</div>
                                    <p class="text-xs text-gray-500">Recommended: 200x50px, Max: 2MB</p>
                                </label>
                            </div>
                            <div v-if="brandSettings.brand_logo_preview || brandSettings.brand_logo_url" class="flex-shrink-0 lg:mt-0 mt-2">
                                <div class="bg-white p-3 rounded-xl border-2 border-gray-200 shadow-sm">
                                    <p class="text-xs font-semibold text-gray-600 mb-2">Current Logo:</p>
                                    <img 
                                        :src="brandSettings.brand_logo_preview || brandSettings.brand_logo_url" 
                                        alt="Brand Logo Preview" 
                                        class="h-16 w-auto max-w-xs rounded-lg object-contain"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Favicon -->
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">Favicon</label>
                        <div class="flex flex-col lg:flex-row gap-4 items-start">
                            <div class="flex-1 w-full">
                                <input 
                                    type="file" 
                                    @change="handleFaviconUpload"
                                    accept="image/*,.ico"
                                    :disabled="!isEditing"
                                    class="hidden"
                                    id="favicon-upload"
                                />
                                <label 
                                    for="favicon-upload" 
                                    :class="['block w-full px-4 py-8 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer transition-all duration-300 text-center bg-gray-50', isEditing ? 'hover:border-indigo-500 hover:bg-indigo-50/30' : 'opacity-50 cursor-not-allowed']"
                                >
                                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <div class="text-sm font-medium text-gray-700 mb-1">Click to upload favicon</div>
                                    <p class="text-xs text-gray-500">Recommended: 32x32px, Max: 512KB</p>
                                </label>
                            </div>
                            <div v-if="brandSettings.favicon_preview || brandSettings.favicon_url" class="flex-shrink-0 lg:mt-0 mt-2">
                                <div class="bg-white p-3 rounded-xl border-2 border-gray-200 shadow-sm">
                                    <p class="text-xs font-semibold text-gray-600 mb-2">Current Favicon:</p>
                                    <img 
                                        :src="brandSettings.favicon_preview || brandSettings.favicon_url" 
                                        alt="Favicon Preview" 
                                        class="h-12 w-12 rounded-lg object-contain"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 p-5">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Contact Information</h2>
                        <p class="text-white/90 text-sm">Address, email, and phone details</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form @submit.prevent="saveBrandSettings" class="space-y-6">
                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Address</label>
                        <textarea 
                            v-model="brandSettings.address" 
                            rows="3" 
                            :disabled="!isEditing"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100 resize-vertical"
                            placeholder="Enter institute address"
                        ></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Email Address</label>
                            <input 
                                type="email" 
                                v-model="brandSettings.email" 
                                :disabled="!isEditing"
                                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                                placeholder="info@skpythonclasses.com"
                            />
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Phone Number</label>
                            <input 
                                type="tel" 
                                v-model="brandSettings.phone" 
                                :disabled="!isEditing"
                                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                                placeholder="+91 98765 43210"
                            />
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">WhatsApp Number</label>
                        <input 
                            type="tel" 
                            v-model="brandSettings.whatsapp" 
                            :disabled="!isEditing"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                            placeholder="+91 98765 43210"
                        />
                    </div>
                </form>
            </div>
        </div>

        <!-- Social Media Links Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 p-5">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Social Media Links</h2>
                        <p class="text-white/90 text-sm">Connect your social media profiles</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form @submit.prevent="saveBrandSettings" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Instagram -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center space-x-2">
                                <svg class="w-5 h-5 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                                <span>Instagram</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="url" 
                                    v-model="brandSettings.instagram" 
                                    :disabled="!isEditing"
                                    class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                                    placeholder="https://instagram.com/yourpage"
                                />
                            </div>
                        </div>

                        <!-- Facebook -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center space-x-2">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                <span>Facebook</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="url" 
                                    v-model="brandSettings.facebook" 
                                    :disabled="!isEditing"
                                    class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                                    placeholder="https://facebook.com/yourpage"
                                />
                            </div>
                        </div>

                        <!-- YouTube -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center space-x-2">
                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                                <span>YouTube</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="url" 
                                    v-model="brandSettings.youtube" 
                                    :disabled="!isEditing"
                                    class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                                    placeholder="https://youtube.com/@yourchannel"
                                />
                            </div>
                        </div>

                        <!-- Twitter -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center space-x-2">
                                <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                                <span>Twitter</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="url" 
                                    v-model="brandSettings.twitter" 
                                    :disabled="!isEditing"
                                    class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white disabled:bg-gray-100"
                                    placeholder="https://twitter.com/yourhandle"
                                />
                            </div>
                        </div>
                    </div>
                </form>
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
                    @click="saveBrandSettings"
                    :disabled="brandSettingsLoading || !isEditing"
                    class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white px-6 py-2.5 rounded-xl font-medium transition flex items-center space-x-2 disabled:opacity-50 shadow-lg shadow-indigo-500/30"
                >
                    <svg v-if="!brandSettingsLoading" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span v-if="brandSettingsLoading">Saving...</span>
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
        const originalSettings = ref({});

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
                    originalSettings.value = { ...brandSettings.value };
                }
            } catch (error) {
                console.error('Error fetching brand settings:', error);
            }
        };

        const cancelEditing = () => {
            isEditing.value = false;
            brandSettings.value = { ...originalSettings.value };
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
            if (!isEditing.value) return;
            
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
                    
                    originalSettings.value = { ...brandSettings.value };
                    isEditing.value = false;
                    updateFavicon();
                    
                    setTimeout(() => {
                        brandSettingsMessage.value = '';
                    }, 3000);
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
            cancelEditing
        };
    }
};
</script>

<style scoped>
/* Additional styles if needed */
</style>
