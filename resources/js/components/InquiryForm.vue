<template>
    <!-- Inquiry Form Modal -->
    <div v-if="show" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50 p-3 sm:p-4 overflow-y-auto" @click.self="closeModal" style="min-height: 100vh;">
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl shadow-2xl w-full max-w-lg border border-indigo-100 transform transition-all my-auto max-w-[calc(100vw-1.5rem)]">
            <!-- Header -->
            <div class="relative bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 rounded-t-2xl p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3 flex-1 min-w-0">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="text-xl sm:text-2xl font-bold text-white truncate">
                                {{ course ? `Enroll in ${course.name}` : 'Inquiry Form' }}
                            </h3>
                            <p class="text-indigo-100 text-xs sm:text-sm mt-0.5 hidden sm:block">
                                {{ course ? 'Fill out the form to enroll' : "We'd love to hear from you!" }}
                            </p>
                        </div>
                    </div>
                    <button @click="closeModal" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-4 sm:p-6">
                <form @submit.prevent="submitInquiry">
                    <div class="space-y-5">
                        <!-- Name Field -->
                        <div class="form-field-group">
                            <label class="form-label">
                                <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                v-model="form.name" 
                                placeholder="Enter your full name"
                                class="form-input-modern"
                                required
                            >
                        </div>

                        <!-- Email Field -->
                        <div class="form-field-group">
                            <label class="form-label">
                                <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                v-model="form.email" 
                                placeholder="your.email@example.com"
                                class="form-input-modern"
                                required
                            >
                        </div>

                        <!-- Phone Field -->
                        <div class="form-field-group">
                            <label class="form-label">
                                <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="tel" 
                                v-model="form.phone" 
                                placeholder="+91 98765 43210"
                                class="form-input-modern"
                                required
                            >
                        </div>

                        <!-- Subject Field -->
                        <div class="form-field-group">
                            <label class="form-label">
                                <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-7 4h7" />
                                </svg>
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                v-model="form.subject" 
                                placeholder="What is your inquiry about?"
                                class="form-input-modern"
                                required
                            >
                        </div>

                        <!-- Message Field -->
                        <div class="form-field-group">
                            <label class="form-label">
                                <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                                </svg>
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                v-model="form.message" 
                                rows="4"
                                placeholder="Please describe your inquiry in detail..."
                                class="form-input-modern resize-vertical"
                                required
                            ></textarea>
                        </div>
                    </div>

                    <!-- Success/Error Message -->
                    <div v-if="message" :class="messageType === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800'" class="border rounded-xl p-4 mt-5">
                        <div class="flex items-center">
                            <svg v-if="messageType === 'success'" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <svg v-else class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm font-medium">{{ message }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-3 sm:space-x-3 mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-200">
                        <button 
                            type="button" 
                            @click="closeModal"
                            class="px-4 sm:px-6 py-2 sm:py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition font-medium shadow-sm w-full sm:w-auto"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            :disabled="loading"
                            class="px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 text-white rounded-xl hover:from-indigo-600 hover:via-purple-600 hover:to-indigo-600 transition font-medium shadow-lg shadow-indigo-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95 w-full sm:w-auto"
                        >
                            <span v-if="!loading" class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                <span>Submit Inquiry</span>
                            </span>
                            <span v-else class="flex items-center space-x-2">
                                <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Submitting...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, watch } from 'vue';
import axios from 'axios';

export default {
    name: 'InquiryForm',
    props: {
        show: {
            type: Boolean,
            default: false
        },
        course: {
            type: Object,
            default: null
        }
    },
    emits: ['close', 'submitted'],
    setup(props, { emit }) {
        const form = ref({
            name: '',
            email: '',
            phone: '',
            subject: '',
            message: ''
        });

        const loading = ref(false);
        const message = ref('');
        const messageType = ref('success');

        const closeModal = () => {
            emit('close');
            // Reset form after closing
            setTimeout(() => {
                form.value = {
                    name: '',
                    email: '',
                    phone: '',
                    subject: '',
                    message: ''
                };
                message.value = '';
            }, 300);
        };

        const submitInquiry = async () => {
            loading.value = true;
            message.value = '';

            try {
                const response = await axios.post('/api/queries', form.value);
                
                if (response.data.success) {
                    message.value = 'Your inquiry has been submitted successfully! We will get back to you soon.';
                    messageType.value = 'success';
                    
                    // Reset form
                    form.value = {
                        name: '',
                        email: '',
                        phone: '',
                        subject: '',
                        message: ''
                    };

                    // Emit submitted event
                    emit('submitted');

                    // Close modal after 2 seconds
                    setTimeout(() => {
                        closeModal();
                    }, 2000);
                }
            } catch (error) {
                console.error('Error submitting inquiry:', error);
                message.value = error.response?.data?.message || 'Failed to submit inquiry. Please try again.';
                messageType.value = 'error';
            } finally {
                loading.value = false;
            }
        };

        // Watch for show prop changes to reset or pre-fill form
        watch(() => props.show, (newVal) => {
            if (newVal && props.course) {
                // Pre-fill subject with course name when modal opens with a course
                form.value.subject = `Enrollment Inquiry for ${props.course.name}`;
                form.value.message = `I am interested in enrolling in the "${props.course.name}" course.\n\nCourse Details:\n- Price: ₹${props.course.price || 'N/A'}\n${props.course.duration_hours ? `- Duration: ${props.course.duration_hours} hours\n` : ''}${props.course.level ? `- Level: ${props.course.level}\n` : ''}\n\nPlease provide me with more information about enrollment.`;
            } else if (!newVal) {
                form.value = {
                    name: '',
                    email: '',
                    phone: '',
                    subject: '',
                    message: ''
                };
                message.value = '';
            }
        });

        // Watch for course prop changes
        watch(() => props.course, (newCourse) => {
            if (newCourse && props.show) {
                form.value.subject = `Enrollment Inquiry for ${newCourse.name}`;
                form.value.message = `I am interested in enrolling in the "${newCourse.name}" course.\n\nCourse Details:\n- Price: ₹${newCourse.price || 'N/A'}\n${newCourse.duration_hours ? `- Duration: ${newCourse.duration_hours} hours\n` : ''}${newCourse.level ? `- Level: ${newCourse.level}\n` : ''}\n\nPlease provide me with more information about enrollment.`;
            }
        }, { immediate: true });

        return {
            form,
            loading,
            message,
            messageType,
            closeModal,
            submitInquiry
        };
    }
};
</script>

<style scoped>
.form-field-group {
    position: relative;
}

.form-label {
    display: flex;
    align-items: center;
    font-size: 0.875rem;
    font-weight: 600;
    color: #4b5563;
    margin-bottom: 0.5rem;
    letter-spacing: -0.01em;
}

.form-input-modern {
    width: 100%;
    padding: 0.875rem 1rem;
    font-size: 0.9375rem;
    color: #1f2937;
    background: #ffffff;
    border: 2px solid #e5e7eb;
    border-radius: 0.75rem;
    transition: all 0.2s ease;
    outline: none;
}

.form-input-modern:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    background: #ffffff;
}

.form-input-modern::placeholder {
    color: #9ca3af;
}

/* Modal Animation */
@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: scale(0.95) translateY(-10px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.fixed.inset-0 {
    animation: modalFadeIn 0.2s ease-out;
}
</style>


