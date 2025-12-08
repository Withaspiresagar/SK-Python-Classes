<template>
    <div class="login-page min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-blue-600 mb-2">SK Python Classes</h1>
                <p class="text-gray-600">Welcome back! Please login to your account.</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-lg shadow-xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h2>
                
                <form @submit.prevent="handleLogin" class="space-y-6">
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address
                        </label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="Enter your email"
                        />
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                placeholder="Enter your password"
                            />
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            >
                                <svg v-if="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                id="remember"
                                v-model="form.remember"
                                type="checkbox"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            />
                            <label for="remember" class="ml-2 block text-sm text-gray-700">
                                Remember me
                            </label>
                        </div>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Error Message -->
                    <div v-if="error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                        {{ error }}
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        :disabled="loading"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span v-if="!loading">Login</span>
                        <span v-else class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Logging in...
                        </span>
                    </button>
                </form>

                <!-- Sign Up Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="/register" class="text-blue-600 hover:text-blue-800 font-medium">
                            Sign up here
                        </a>
                    </p>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="/" class="text-sm text-gray-600 hover:text-gray-800">
                    ← Back to Home
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from 'vue';
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

        return {
            form,
            showPassword,
            loading,
            error,
            handleLogin
        };
    }
};
</script>

<style scoped>
.login-page {
    font-family: 'Instrument Sans', sans-serif;
}
</style>

