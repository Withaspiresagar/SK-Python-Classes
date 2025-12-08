<template>
    <div class="w-full overflow-hidden">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg p-4 sm:p-6 border border-gray-100 overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3">
                <div class="flex-1"></div>
                <button 
                    @click="openAddModal"
                    class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-xl hover:from-purple-600 hover:to-pink-600 transition font-medium shadow-lg shadow-purple-500/30 transform hover:scale-105 text-sm sm:text-base w-full sm:w-auto whitespace-nowrap"
                >
                    Add New Admin
                </button>
            </div>
            
            <div class="overflow-x-auto -mx-4 sm:mx-0 lg:mx-0 w-full">
                <div class="inline-block w-full align-middle">
                    <table class="w-full divide-y divide-gray-200 table-auto">
                        <thead class="bg-gradient-to-r from-purple-50 to-pink-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Role</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Created At</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="admin in admins" :key="admin.id" class="hover:bg-gradient-to-r hover:from-purple-50/50 hover:to-pink-50/50 transition">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ admin.id }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ admin.name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ admin.email }}</td>
                                <td class="px-4 py-3">
                                    <span class="bg-gradient-to-r from-purple-400 to-pink-400 text-white px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                                        {{ admin.role }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ formatDate(admin.created_at) }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex space-x-2">
                                        <button 
                                            @click="viewAdmin(admin.id)"
                                            class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-3 py-1 rounded-lg hover:from-blue-600 hover:to-cyan-600 text-sm font-medium shadow-sm transition"
                                        >
                                            View
                                        </button>
                                        <button 
                                            @click="editAdmin(admin.id)"
                                            class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-3 py-1 rounded-lg hover:from-green-600 hover:to-emerald-600 text-sm font-medium shadow-sm transition"
                                        >
                                            Edit
                                        </button>
                                        <button 
                                            @click="deleteAdmin(admin.id)"
                                            class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-3 py-1 rounded-lg hover:from-red-600 hover:to-pink-600 text-sm font-medium shadow-sm transition"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50 p-3 sm:p-4 overflow-y-auto overflow-x-hidden" @click.self="closeModal">
            <div class="bg-gradient-to-br from-white via-purple-50/30 to-pink-50/30 rounded-2xl shadow-2xl w-full max-w-lg border border-purple-100 transform transition-all my-4 max-w-[calc(100vw-1.5rem)]">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-purple-500 via-pink-500 to-purple-500 rounded-t-2xl p-4 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2 sm:space-x-3 flex-1 min-w-0">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg v-if="modalMode === 'add'" class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <svg v-else class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg sm:text-2xl font-bold text-white truncate">
                                    {{ modalMode === 'add' ? 'Add New Admin' : 'Edit Admin' }}
                                </h3>
                                <p class="text-purple-100 text-xs sm:text-sm mt-0.5 hidden sm:block">
                                    {{ modalMode === 'add' ? 'Create a new administrator account' : 'Update admin information' }}
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
                    <form @submit.prevent="saveAdmin">
                        <div class="space-y-5">
                            <!-- Name Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Full Name
                                </label>
                                <input 
                                    type="text" 
                                    v-model="form.name" 
                                    placeholder="Enter admin full name"
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Email Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Email Address
                                </label>
                                <input 
                                    type="email" 
                                    v-model="form.email" 
                                    placeholder="admin@example.com"
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Password Fields (Only for Add) -->
                            <template v-if="modalMode === 'add'">
                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Password
                                    </label>
                                    <input 
                                        type="password" 
                                        v-model="form.password" 
                                        placeholder="Enter secure password (min 6 characters)"
                                        class="form-input-modern"
                                        required
                                        minlength="6"
                                    >
                                    <p class="form-hint-text">Minimum 6 characters required</p>
                                </div>

                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Confirm Password
                                    </label>
                                    <input 
                                        type="password" 
                                        v-model="form.password_confirmation" 
                                        placeholder="Re-enter password to confirm"
                                        class="form-input-modern"
                                        required
                                        minlength="6"
                                    >
                                </div>
                            </template>

                            <!-- Change Password Link (Only for Edit) -->
                            <div v-if="modalMode === 'edit'" class="pt-2">
                                <button 
                                    type="button"
                                    @click="openPasswordModalForEdit"
                                    class="flex items-center space-x-2 text-sm font-medium text-orange-600 hover:text-orange-700 transition group"
                                >
                                    <svg class="w-4 h-4 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                    <span>Change Password</span>
                                </button>
                            </div>
                        </div>

                        <!-- Error Message -->
                        <div v-if="error" class="mt-5 p-4 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-red-700 text-sm font-medium">{{ error }}</p>
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
                                class="px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-purple-500 via-pink-500 to-purple-500 text-white rounded-xl hover:from-purple-600 hover:via-pink-600 hover:to-purple-600 transition font-medium shadow-lg shadow-purple-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95 w-full sm:w-auto"
                            >
                                <span v-if="!loading" class="flex items-center space-x-2">
                                    <svg v-if="modalMode === 'add'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ modalMode === 'add' ? 'Create Admin' : 'Update Admin' }}</span>
                                </span>
                                <span v-else class="flex items-center space-x-2">
                                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>Saving...</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- View Modal -->
        <div v-if="showViewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-3 sm:p-4 overflow-y-auto overflow-x-hidden" @click.self="closeViewModal">
            <div class="bg-white rounded-xl shadow-2xl p-4 sm:p-6 w-full max-w-md my-4 max-w-[calc(100vw-1.5rem)]">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">Admin Details</h3>
                    <button @click="closeViewModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div v-if="viewAdminData" class="space-y-4">
                    <div class="flex items-center space-x-3 p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ viewAdminData.name.charAt(0).toUpperCase() }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ viewAdminData.name }}</p>
                            <p class="text-sm text-gray-600">{{ viewAdminData.email }}</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">ID:</span>
                            <span class="text-gray-900 font-semibold">{{ viewAdminData.id }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Name:</span>
                            <span class="text-gray-900 font-semibold">{{ viewAdminData.name }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Email:</span>
                            <span class="text-gray-900 font-semibold">{{ viewAdminData.email }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Role:</span>
                            <span class="bg-gradient-to-r from-purple-400 to-pink-400 text-white px-3 py-1 rounded-full text-xs font-medium">
                                {{ viewAdminData.role }}
                            </span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Created At:</span>
                            <span class="text-gray-900 font-semibold">{{ formatDate(viewAdminData.created_at) }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600 font-medium">Last Updated:</span>
                            <span class="text-gray-900 font-semibold">{{ formatDate(viewAdminData.updated_at) }}</span>
                        </div>
                    </div>
                </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button 
                            @click="openPasswordModal(viewAdminData.id); closeViewModal();"
                            class="px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg hover:from-orange-600 hover:to-red-600 transition shadow-lg"
                        >
                            Change Password
                        </button>
                        <button 
                            @click="closeViewModal"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg hover:from-blue-600 hover:to-cyan-600 transition shadow-lg"
                        >
                            Close
                        </button>
                    </div>
            </div>
        </div>

        <!-- Password Change Modal -->
        <div v-if="showPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-3 sm:p-4 overflow-y-auto overflow-x-hidden" @click.self="closePasswordModal">
            <div class="bg-white rounded-xl shadow-2xl p-4 sm:p-6 w-full max-w-md my-4 max-w-[calc(100vw-1.5rem)]">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">Change Password</h3>
                    <button @click="closePasswordModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="updatePassword">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input 
                                type="password" 
                                v-model="passwordForm.password" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                required
                                minlength="6"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <input 
                                type="password" 
                                v-model="passwordForm.password_confirmation" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                required
                                minlength="6"
                            >
                        </div>
                    </div>

                    <div v-if="error" class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                        {{ error }}
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-3 sm:space-x-3 mt-6">
                        <button 
                            type="button" 
                            @click="closePasswordModal"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition w-full sm:w-auto"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            :disabled="loading"
                            class="px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-lg hover:from-orange-600 hover:to-red-600 transition shadow-lg disabled:opacity-50 w-full sm:w-auto"
                        >
                            <span v-if="!loading">Update Password</span>
                            <span v-else>Updating...</span>
                        </button>
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
    name: 'AdminManagement',
    setup() {
        const admins = ref([]);
        const showModal = ref(false);
        const showViewModal = ref(false);
        const showPasswordModal = ref(false);
        const modalMode = ref('add'); // 'add' or 'edit'
        const loading = ref(false);
        const error = ref('');
        const currentAdminId = ref(null);
        const viewAdminData = ref(null);

        const form = ref({
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        });

        const passwordForm = ref({
            password: '',
            password_confirmation: ''
        });

        const fetchAdmins = async () => {
            try {
                const response = await axios.get('/api/admins');
                if (response.data.success) {
                    admins.value = response.data.admins;
                }
            } catch (err) {
                console.error('Error fetching admins:', err);
                error.value = 'Failed to fetch admins';
            }
        };

        const openAddModal = () => {
            modalMode.value = 'add';
            form.value = {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            };
            error.value = '';
            showModal.value = true;
        };

        const editAdmin = async (id) => {
            try {
                const response = await axios.get(`/api/admins/${id}`);
                if (response.data.success) {
                    const admin = response.data.admin;
                    form.value = {
                        name: admin.name,
                        email: admin.email,
                        password: '',
                        password_confirmation: ''
                    };
                    modalMode.value = 'edit';
                    currentAdminId.value = id;
                    error.value = '';
                    showModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching admin:', err);
                error.value = err.response?.data?.message || 'Failed to fetch admin details';
            }
        };

        const viewAdmin = async (id) => {
            try {
                const response = await axios.get(`/api/admins/${id}`);
                if (response.data.success) {
                    viewAdminData.value = response.data.admin;
                    showViewModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching admin:', err);
                error.value = err.response?.data?.message || 'Failed to fetch admin details';
            }
        };

        const saveAdmin = async () => {
            loading.value = true;
            error.value = '';

            try {
                if (modalMode.value === 'add') {
                    const response = await axios.post('/api/admins', form.value);
                    if (response.data.success) {
                        await fetchAdmins();
                        closeModal();
                    }
                } else {
                    const response = await axios.put(`/api/admins/${currentAdminId.value}`, {
                        name: form.value.name,
                        email: form.value.email
                    });
                    if (response.data.success) {
                        await fetchAdmins();
                        closeModal();
                    }
                }
            } catch (err) {
                if (err.response?.data?.errors) {
                    const errors = err.response.data.errors;
                    error.value = Object.values(errors).flat().join(', ');
                } else {
                    error.value = err.response?.data?.message || 'Failed to save admin';
                }
            } finally {
                loading.value = false;
            }
        };

        const updatePassword = async () => {
            loading.value = true;
            error.value = '';

            try {
                const response = await axios.put(`/api/admins/${currentAdminId.value}/password`, passwordForm.value);
                if (response.data.success) {
                    closePasswordModal();
                    alert('Password updated successfully!');
                }
            } catch (err) {
                if (err.response?.data?.errors) {
                    const errors = err.response.data.errors;
                    error.value = Object.values(errors).flat().join(', ');
                } else {
                    error.value = err.response?.data?.message || 'Failed to update password';
                }
            } finally {
                loading.value = false;
            }
        };

        const deleteAdmin = async (id) => {
            if (!confirm('Are you sure you want to delete this admin?')) {
                return;
            }

            try {
                const response = await axios.delete(`/api/admins/${id}`);
                if (response.data.success) {
                    await fetchAdmins();
                } else {
                    alert(response.data.message || 'Failed to delete admin');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to delete admin');
            }
        };

        const closeModal = () => {
            showModal.value = false;
            form.value = {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            };
            error.value = '';
            currentAdminId.value = null;
        };

        const closeViewModal = () => {
            showViewModal.value = false;
            viewAdminData.value = null;
        };

        const openPasswordModal = (id) => {
            currentAdminId.value = id;
            passwordForm.value = {
                password: '',
                password_confirmation: ''
            };
            error.value = '';
            showPasswordModal.value = true;
        };

        const openPasswordModalForEdit = () => {
            if (currentAdminId.value) {
                closeModal();
                openPasswordModal(currentAdminId.value);
            }
        };

        const closePasswordModal = () => {
            showPasswordModal.value = false;
            passwordForm.value = {
                password: '',
                password_confirmation: ''
            };
            error.value = '';
            currentAdminId.value = null;
        };

        const formatDate = (dateString) => {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        };

        // Expose openPasswordModal for edit modal
        const handleEditWithPassword = (id) => {
            editAdmin(id);
            // After edit modal closes, we can add password change option
        };

        onMounted(() => {
            fetchAdmins();
        });

        return {
            admins,
            showModal,
            showViewModal,
            showPasswordModal,
            modalMode,
            loading,
            error,
            form,
            passwordForm,
            viewAdminData,
            openAddModal,
            editAdmin,
            viewAdmin,
            saveAdmin,
            deleteAdmin,
            updatePassword,
            closeModal,
            closeViewModal,
            openPasswordModal,
            openPasswordModalForEdit,
            closePasswordModal,
            formatDate
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
    border-color: #a855f7;
    box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.1);
    background: #ffffff;
}

.form-input-modern::placeholder {
    color: #9ca3af;
}

.form-hint-text {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 0.375rem;
    padding-left: 0.25rem;
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
