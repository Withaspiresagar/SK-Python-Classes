<template>
    <div class="login-page h-screen relative overflow-hidden flex items-center justify-center py-3 sm:py-4 px-4 sm:px-6">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
            <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
            <div class="absolute top-0 left-1/4 w-64 h-64 sm:w-96 sm:h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 right-1/4 w-64 h-64 sm:w-96 sm:h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-1/3 w-64 h-64 sm:w-96 sm:h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-md w-full relative z-10 flex flex-col justify-center">
            <!-- Logo/Header -->
            <div class="text-center mb-3 sm:mb-4 transform transition-all duration-500">
                <div class="inline-block mb-2 sm:mb-3">
                    <div 
                        v-if="brandSettings.brand_logo_url"
                        class="logo-container mx-auto rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30 transform hover:scale-110 transition-transform duration-300 overflow-hidden"
                    >
                        <img 
                            :src="brandSettings.brand_logo_url" 
                            :alt="brandSettings.brand_name"
                            class="h-12 w-12 sm:h-14 sm:w-14 object-contain"
                        />
                    </div>
                    <div 
                        v-else
                        class="w-12 h-12 sm:w-14 sm:h-14 mx-auto bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl sm:rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30 transform hover:scale-110 transition-transform duration-300"
                    >
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 bg-clip-text text-transparent mb-1 sm:mb-2 animate-gradient px-2">
                    {{ brandSettings.brand_name || 'SK Python Classes' }}
                </h1>
                <p class="text-gray-600 text-sm sm:text-base font-medium px-2">Welcome back! Please login to your account.</p>
            </div>

            <!-- Login Card -->
            <div class="login-card bg-white/80 backdrop-blur-xl rounded-xl sm:rounded-2xl shadow-2xl border border-white/20 p-4 sm:p-6 lg:p-8 transform transition-all duration-300 hover:shadow-3xl flex-shrink-0">
                <div class="text-center mb-4 sm:mb-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1.5 sm:mb-2">Login</h2>
                    <div class="w-14 sm:w-16 h-0.5 sm:h-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mx-auto"></div>
                </div>
                
                <form @submit.prevent="handleLogin" class="space-y-3 sm:space-y-4">
                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1 sm:mb-1.5 flex items-center">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                            Email Address
                        </label>
                        <div class="relative">
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                class="modern-input w-full px-3 sm:px-4 py-2 sm:py-2.5 pl-10 sm:pl-11 text-sm sm:text-base border-2 border-gray-200 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all duration-300 bg-white/50 backdrop-blur-sm hover:border-gray-300"
                                placeholder="Enter your email"
                            />
                            <svg class="absolute left-3 sm:left-3.5 top-1/2 transform -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1 sm:mb-1.5 flex items-center">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Password
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'"
                                required
                                class="modern-input w-full px-3 sm:px-4 py-2 sm:py-2.5 pl-10 sm:pl-11 pr-10 sm:pr-11 text-sm sm:text-base border-2 border-gray-200 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all duration-300 bg-white/50 backdrop-blur-sm hover:border-gray-300"
                                placeholder="Enter your password"
                            />
                            <svg class="absolute left-3 sm:left-3.5 top-1/2 transform -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-3 sm:right-3.5 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors duration-200 p-1 rounded-lg hover:bg-gray-100"
                            >
                                <svg v-if="!showPassword" class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg v-else class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pt-1 gap-2 sm:gap-0">
                        <div class="flex items-center group cursor-pointer">
                            <div class="relative">
                                <input
                                    id="remember"
                                    v-model="form.remember"
                                    type="checkbox"
                                    class="sr-only"
                                />
                                <label
                                    for="remember"
                                    class="flex items-center cursor-pointer"
                                >
                                    <div class="w-4 h-4 sm:w-5 sm:h-5 border-2 border-gray-300 rounded-md flex items-center justify-center transition-all duration-200 group-hover:border-blue-500"
                                         :class="form.remember ? 'bg-gradient-to-br from-blue-600 to-purple-600 border-blue-600' : 'bg-white'">
                                        <svg v-if="form.remember" class="w-2.5 h-2.5 sm:w-3 sm:h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="ml-2 sm:ml-2.5 text-xs sm:text-sm font-medium text-gray-700 group-hover:text-gray-900">
                                        Remember me
                                    </span>
                                </label>
                            </div>
                        </div>
                        <a href="/forgot-password" class="text-xs sm:text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors duration-200 hover:underline">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Error Message -->
                    <transition
                        enter-active-class="transition-all duration-300 ease-out"
                        enter-from-class="opacity-0 -translate-y-2"
                        enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition-all duration-200 ease-in"
                        leave-from-class="opacity-100 translate-y-0"
                        leave-to-class="opacity-0 -translate-y-2"
                    >
                        <div v-if="error" class="error-message bg-red-50 border-2 border-red-200 text-red-700 px-3 sm:px-4 py-2.5 sm:py-3.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ error }}
                        </div>
                    </transition>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        :disabled="loading"
                        class="login-button w-full bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 text-white py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold text-sm sm:text-base shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-[1.02] active:scale-[0.98] relative overflow-hidden group"
                    >
                        <span class="relative z-10 flex items-center justify-center">
                            <span v-if="!loading" class="flex items-center">
                                <span>Login</span>
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                            <span v-else class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Logging in...
                            </span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-700 via-purple-700 to-blue-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </form>

                <!-- Sign Up Link -->
                <!-- <div class="mt-4 sm:mt-5 text-center pt-3 sm:pt-4 border-t border-gray-200">
                    <p class="text-xs sm:text-sm text-gray-600 font-medium">
                        Don't have an account?
                        <a href="/register" class="text-blue-600 hover:text-blue-700 font-semibold ml-1 transition-colors duration-200 hover:underline">
                            Sign up here
                        </a>
                    </p>
                </div> -->
            </div>

            <!-- Back to Home -->
            <div class="mt-2 sm:mt-3 text-center">
                <a href="/" class="inline-flex items-center text-xs sm:text-sm font-semibold text-gray-600 hover:text-gray-800 transition-colors duration-200 group">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'Login',
    setup() {
        const form = reactive({
            email: '',
            password: '',
            remember: false
        });

        const showPassword = ref(false);
        const loading = ref(false);
        const error = ref('');
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

        const handleLogin = async () => {
            error.value = '';
            loading.value = true;

            try {
                const response = await axios.post('/api/login', {
                    email: form.email,
                    password: form.password,
                    remember: form.remember
                });

                // Handle successful login
                if (response.data.success) {
                    // Redirect based on user role
                    if (response.data.user.role === 'admin') {
                        window.location.href = '/admin-panel';
                    } else {
                        window.location.href = '/dashboard';
                    }
                }
            } catch (err) {
                // Handle login error
                if (err.response && err.response.data) {
                    const errors = err.response.data.errors;
                    if (errors && errors.email) {
                        error.value = errors.email[0];
                    } else {
                        error.value = err.response.data.message || 'Invalid email or password';
                    }
                } else {
                    error.value = 'An error occurred. Please try again.';
                }
            } finally {
                loading.value = false;
            }
        };

        onMounted(() => {
            fetchBrandSettings();
        });

        return {
            form,
            showPassword,
            loading,
            error,
            brandSettings,
            handleLogin
        };
    }
};
</script>

<style scoped>
.login-page {
    font-family: 'Instrument Sans', sans-serif;
}

.logo-container {
    position: relative;
    overflow: hidden;
    border-radius: 1rem;
}

.logo-container::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 1rem;
    padding: 2px;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(147, 51, 234, 0.3));
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.logo-container:hover::before {
    opacity: 1;
}

.login-card {
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

.modern-input:focus {
    background-color: white;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

.modern-input::placeholder {
    color: #9ca3af;
    font-weight: 400;
}

.error-message {
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.login-button {
    background-size: 200% 200%;
    animation: gradient-shift 3s ease infinite;
}

@keyframes gradient-shift {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

@keyframes blob {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

.bg-grid-pattern {
    background-image: 
        linear-gradient(to right, rgba(0, 0, 0, 0.1) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
    background-size: 20px 20px;
}

@keyframes gradient {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

.form-group {
    position: relative;
}

/* Custom checkbox styling */
input[type="checkbox"]:checked + label > div {
    animation: checkmark 0.3s ease;
}

@keyframes checkmark {
    0% {
        transform: scale(0.8);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}

/* Focus states for accessibility */
.modern-input:focus-visible,
.login-button:focus-visible {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* Smooth transitions */
* {
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
</style>

