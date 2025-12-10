<template>
    <div class="forgot-password-page min-h-screen h-screen relative overflow-hidden flex items-center justify-center py-3 sm:py-4 px-4 sm:px-6">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 bg-clip-text text-transparent mb-1 sm:mb-2 animate-gradient px-2">
                    {{ brandSettings.brand_name || 'SK Python Classes' }}
                </h1>
                <p class="text-gray-600 text-sm sm:text-base font-medium px-2">Reset your password</p>
            </div>

            <!-- Forgot Password Card -->
            <div class="forgot-password-card bg-white/80 backdrop-blur-xl rounded-xl sm:rounded-2xl shadow-2xl border border-white/20 p-4 sm:p-6 lg:p-8 transform transition-all duration-300 hover:shadow-3xl flex-shrink-0">
                <!-- Step 1: Enter Email -->
                <div v-if="step === 1" class="space-y-4 sm:space-y-5">
                    <div class="text-center mb-4 sm:mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1.5 sm:mb-2">Forgot Password?</h2>
                        <div class="w-14 sm:w-16 h-0.5 sm:h-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mx-auto"></div>
                        <p class="text-sm sm:text-base text-gray-600 mt-3">Enter your email address and we'll send you an OTP to reset your password.</p>
                    </div>

                    <form @submit.prevent="sendOTP" class="space-y-3 sm:space-y-4">
                        <div class="form-group">
                            <label for="email" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1 sm:mb-1.5 flex items-center">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Email Address
                            </label>
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

                        <transition
                            enter-active-class="transition-all duration-300 ease-out"
                            enter-from-class="opacity-0 -translate-y-2"
                            enter-to-class="opacity-100 translate-y-0"
                        >
                            <div v-if="error" class="error-message bg-red-50 border-2 border-red-200 text-red-700 px-3 sm:px-4 py-2.5 sm:py-3.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ error }}
                            </div>
                        </transition>

                        <transition
                            enter-active-class="transition-all duration-300 ease-out"
                            enter-from-class="opacity-0 -translate-y-2"
                            enter-to-class="opacity-100 translate-y-0"
                        >
                            <div v-if="successMessage" class="success-message bg-green-50 border-2 border-green-200 text-green-700 px-3 sm:px-4 py-2.5 sm:py-3.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ successMessage }}
                            </div>
                        </transition>

                        <button
                            type="submit"
                            :disabled="loading"
                            class="w-full bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 text-white py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold text-sm sm:text-base shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-[1.02] active:scale-[0.98] relative overflow-hidden group"
                        >
                            <span v-if="!loading" class="flex items-center justify-center">
                                <span>Send OTP</span>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                            <span v-else class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 sm:h-5 sm:w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Sending...
                            </span>
                        </button>
                    </form>
                </div>

                <!-- Step 2: Enter OTP -->
                <div v-if="step === 2" class="space-y-4 sm:space-y-5">
                    <div class="text-center mb-4 sm:mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1.5 sm:mb-2">Enter OTP</h2>
                        <div class="w-14 sm:w-16 h-0.5 sm:h-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mx-auto"></div>
                        <p class="text-sm sm:text-base text-gray-600 mt-3">We've sent a 6-digit OTP to <strong>{{ form.email }}</strong></p>
                    </div>

                    <form @submit.prevent="verifyOTP" class="space-y-3 sm:space-y-4">
                        <div class="form-group">
                            <label for="otp" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1 sm:mb-1.5 flex items-center">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Enter OTP
                            </label>
                            <input
                                id="otp"
                                v-model="form.otp"
                                type="text"
                                maxlength="6"
                                required
                                class="modern-input w-full px-3 sm:px-4 py-2 sm:py-2.5 text-center text-lg sm:text-xl font-bold tracking-widest border-2 border-gray-200 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all duration-300 bg-white/50 backdrop-blur-sm hover:border-gray-300"
                                placeholder="000000"
                            />
                        </div>

                        <transition
                            enter-active-class="transition-all duration-300 ease-out"
                            enter-from-class="opacity-0 -translate-y-2"
                            enter-to-class="opacity-100 translate-y-0"
                        >
                            <div v-if="error" class="error-message bg-red-50 border-2 border-red-200 text-red-700 px-3 sm:px-4 py-2.5 sm:py-3.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ error }}
                            </div>
                        </transition>

                        <button
                            type="submit"
                            :disabled="loading"
                            class="w-full bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 text-white py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold text-sm sm:text-base shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-[1.02] active:scale-[0.98]"
                        >
                            <span v-if="!loading">Verify OTP</span>
                            <span v-else class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 sm:h-5 sm:w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Verifying...
                            </span>
                        </button>

                        <button
                            type="button"
                            @click="resendOTP"
                            :disabled="resendCooldown > 0"
                            class="w-full text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200"
                        >
                            <span v-if="resendCooldown > 0">Resend OTP in {{ resendCooldown }}s</span>
                            <span v-else>Resend OTP</span>
                        </button>
                    </form>
                </div>

                <!-- Step 3: Reset Password -->
                <div v-if="step === 3" class="space-y-4 sm:space-y-5">
                    <div class="text-center mb-4 sm:mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1.5 sm:mb-2">New Password</h2>
                        <div class="w-14 sm:w-16 h-0.5 sm:h-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mx-auto"></div>
                        <p class="text-sm sm:text-base text-gray-600 mt-3">Create a new password for your account</p>
                    </div>

                    <form @submit.prevent="resetPassword" class="space-y-3 sm:space-y-4">
                        <div class="form-group">
                            <label for="password" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1 sm:mb-1.5 flex items-center">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                New Password
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    v-model="form.password"
                                    :type="showPassword ? 'text' : 'password'"
                                    required
                                    minlength="6"
                                    class="modern-input w-full px-3 sm:px-4 py-2 sm:py-2.5 pl-10 sm:pl-11 pr-10 sm:pr-11 text-sm sm:text-base border-2 border-gray-200 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all duration-300 bg-white/50 backdrop-blur-sm hover:border-gray-300"
                                    placeholder="Enter new password"
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
                            <p class="form-hint-text">Minimum 6 characters required</p>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-1 sm:mb-1.5 flex items-center">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Confirm Password
                            </label>
                            <input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                :type="showPassword ? 'text' : 'password'"
                                required
                                minlength="6"
                                class="modern-input w-full px-3 sm:px-4 py-2 sm:py-2.5 pl-10 sm:pl-11 text-sm sm:text-base border-2 border-gray-200 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all duration-300 bg-white/50 backdrop-blur-sm hover:border-gray-300"
                                placeholder="Confirm new password"
                            />
                            <svg class="absolute left-3 sm:left-3.5 top-1/2 transform -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>

                        <transition
                            enter-active-class="transition-all duration-300 ease-out"
                            enter-from-class="opacity-0 -translate-y-2"
                            enter-to-class="opacity-100 translate-y-0"
                        >
                            <div v-if="error" class="error-message bg-red-50 border-2 border-red-200 text-red-700 px-3 sm:px-4 py-2.5 sm:py-3.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ error }}
                            </div>
                        </transition>

                        <transition
                            enter-active-class="transition-all duration-300 ease-out"
                            enter-from-class="opacity-0 -translate-y-2"
                            enter-to-class="opacity-100 translate-y-0"
                        >
                            <div v-if="successMessage" class="success-message bg-green-50 border-2 border-green-200 text-green-700 px-3 sm:px-4 py-2.5 sm:py-3.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ successMessage }}
                            </div>
                        </transition>

                        <button
                            type="submit"
                            :disabled="loading"
                            class="w-full bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 text-white py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-semibold text-sm sm:text-base shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-[1.02] active:scale-[0.98]"
                        >
                            <span v-if="!loading">Reset Password</span>
                            <span v-else class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 sm:h-5 sm:w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Resetting...
                            </span>
                        </button>
                    </form>
                </div>

                <!-- Back to Login -->
                <div class="mt-4 sm:mt-5 text-center pt-3 sm:pt-4 border-t border-gray-200">
                    <a href="/login" class="inline-flex items-center text-xs sm:text-sm font-semibold text-gray-600 hover:text-gray-800 transition-colors duration-200 group">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'ForgotPassword',
    setup() {
        const step = ref(1); // 1: Email, 2: OTP, 3: New Password
        const loading = ref(false);
        const error = ref('');
        const successMessage = ref('');
        const showPassword = ref(false);
        const resendCooldown = ref(0);
        const brandSettings = ref({
            brand_name: 'SK Python Classes',
            brand_logo_url: null
        });

        const form = reactive({
            email: '',
            otp: '',
            password: '',
            password_confirmation: ''
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
                }
            } catch (error) {
                console.error('Error fetching brand settings:', error);
            }
        };

        const sendOTP = async () => {
            loading.value = true;
            error.value = '';
            successMessage.value = '';

            try {
                const response = await axios.post('/api/forgot-password/send-otp', {
                    email: form.email
                });

                if (response.data.success) {
                    successMessage.value = response.data.message;
                    step.value = 2;
                    resendCooldown.value = 60; // 60 seconds cooldown
                    startResendCooldown();
                }
            } catch (err) {
                error.value = err.response?.data?.message || 'Failed to send OTP. Please try again.';
            } finally {
                loading.value = false;
            }
        };

        const verifyOTP = async () => {
            loading.value = true;
            error.value = '';
            successMessage.value = '';

            try {
                const response = await axios.post('/api/forgot-password/verify-otp', {
                    email: form.email,
                    otp: form.otp
                });

                if (response.data.success) {
                    successMessage.value = response.data.message;
                    step.value = 3;
                }
            } catch (err) {
                error.value = err.response?.data?.message || 'Invalid OTP. Please try again.';
            } finally {
                loading.value = false;
            }
        };

        const resetPassword = async () => {
            loading.value = true;
            error.value = '';
            successMessage.value = '';

            if (form.password !== form.password_confirmation) {
                error.value = 'Passwords do not match.';
                loading.value = false;
                return;
            }

            try {
                const response = await axios.post('/api/forgot-password/reset', {
                    email: form.email,
                    otp: form.otp,
                    password: form.password,
                    password_confirmation: form.password_confirmation
                });

                if (response.data.success) {
                    successMessage.value = response.data.message;
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 2000);
                }
            } catch (err) {
                if (err.response?.data?.errors) {
                    const errors = err.response.data.errors;
                    error.value = Object.values(errors).flat().join(', ');
                } else {
                    error.value = err.response?.data?.message || 'Failed to reset password. Please try again.';
                }
            } finally {
                loading.value = false;
            }
        };

        const resendOTP = async () => {
            if (resendCooldown.value > 0) return;
            await sendOTP();
        };

        const startResendCooldown = () => {
            const interval = setInterval(() => {
                resendCooldown.value--;
                if (resendCooldown.value <= 0) {
                    clearInterval(interval);
                }
            }, 1000);
        };

        onMounted(() => {
            fetchBrandSettings();
        });

        return {
            step,
            loading,
            error,
            successMessage,
            showPassword,
            resendCooldown,
            form,
            brandSettings,
            sendOTP,
            verifyOTP,
            resetPassword,
            resendOTP
        };
    }
};
</script>

<style scoped>
.forgot-password-page {
    font-family: 'Instrument Sans', sans-serif;
}

.forgot-password-card {
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

.modern-input:focus {
    background-color: white;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

.form-group {
    position: relative;
}

.form-hint-text {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 0.375rem;
    padding-left: 0.25rem;
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

.logo-container {
    position: relative;
    overflow: hidden;
    border-radius: 1rem;
}
</style>



