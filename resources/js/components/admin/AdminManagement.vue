<template>
    <div class="w-full overflow-hidden space-y-6">
        <!-- Stats Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <div class="stat-card bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-purple-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.totalAdmins }}</div>
                        <div class="text-purple-100 text-sm sm:text-base font-medium">Total Admins</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-indigo-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.activeAdmins }}</div>
                        <div class="text-indigo-100 text-sm sm:text-base font-medium">Active Admins</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.newThisMonth }}</div>
                        <div class="text-green-100 text-sm sm:text-base font-medium">New This Month</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                <div class="flex-1">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Admin Management</h2>
                    <p class="text-gray-600 text-sm">Manage and search all administrator accounts</p>
                </div>
                <button 
                    @click="openAddModal"
                    class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-purple-600 hover:to-pink-600 transition font-medium shadow-lg shadow-purple-500/30 transform hover:scale-105 text-sm sm:text-base whitespace-nowrap flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Admin
                </button>
            </div>

            <!-- Search and Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <!-- Search Input -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Admins</label>
                    <div class="relative">
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Search by name or email..."
                            class="w-full px-4 py-2.5 pl-11 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 outline-none transition-all duration-300 bg-white"
                        />
                        <svg class="absolute left-3.5 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Sort By -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sort By</label>
                    <select
                        v-model="filters.sortBy"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 outline-none transition-all duration-300 bg-white"
                    >
                        <option value="created_at">Newest First</option>
                        <option value="name">Name (A-Z)</option>
                        <option value="email">Email</option>
                    </select>
                </div>
            </div>

            <!-- Quick Filter Buttons -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button
                    @click="filters.role = ''"
                    :class="filters.role === '' 
                        ? 'bg-gradient-to-r from-purple-500 to-pink-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    All Admins
                </button>
                <button
                    @click="filters.role = 'admin'"
                    :class="filters.role === 'admin' 
                        ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Admins
                </button>
            </div>
        </div>

        <!-- Admins Table Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto -mx-4 sm:mx-0 lg:mx-0 w-full">
                <div class="inline-block w-full align-middle">
                    <table class="w-full divide-y divide-gray-200 table-auto">
                        <thead class="bg-gradient-to-r from-purple-50 via-pink-50 to-purple-50">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-bold text-gray-700 uppercase tracking-wider">ID</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-bold text-gray-700 uppercase tracking-wider">Name</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-bold text-gray-700 uppercase tracking-wider">Email</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-bold text-gray-700 uppercase tracking-wider">Role</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-bold text-gray-700 uppercase tracking-wider">Created At</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="admin in filteredAdmins" :key="admin.id" class="hover:bg-gradient-to-r hover:from-purple-50/50 hover:to-pink-50/50 transition-all duration-200">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ admin.id }}</td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                            {{ admin.name.charAt(0).toUpperCase() }}
                                        </div>
                                        <div class="text-sm font-medium text-gray-900">{{ admin.name }}</div>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ admin.email }}</td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm"
                                        :class="admin.role === 'super_admin' 
                                            ? 'bg-gradient-to-r from-indigo-400 to-purple-400 text-white' 
                                            : 'bg-gradient-to-r from-purple-400 to-pink-400 text-white'">
                                        {{ admin.role }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ formatDate(admin.created_at) }}</td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex flex-wrap gap-2">
                                        <button 
                                            @click="viewAdmin(admin.id)"
                                            class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg hover:from-blue-600 hover:to-cyan-600 text-xs sm:text-sm font-medium shadow-sm transition transform hover:scale-105"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </button>
                                        <button 
                                            @click="editAdmin(admin.id)"
                                            class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg hover:from-green-600 hover:to-emerald-600 text-xs sm:text-sm font-medium shadow-sm transition transform hover:scale-105"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button 
                                            @click="deleteAdmin(admin.id)"
                                            class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-lg hover:from-red-600 hover:to-pink-600 text-xs sm:text-sm font-medium shadow-sm transition transform hover:scale-105"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="filteredAdmins.length === 0">
                                <td colspan="6" class="px-4 sm:px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="text-gray-500 text-lg font-medium">No admins found</p>
                                        <p class="text-gray-400 text-sm mt-1">Try adjusting your search or filters</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50 p-3 sm:p-4 overflow-y-auto" @click.self="closeModal" style="min-height: 100vh;">
            <div class="bg-gradient-to-br from-white via-purple-50/30 to-pink-50/30 rounded-2xl shadow-2xl w-full max-w-lg border border-purple-100 transform transition-all my-auto max-w-[calc(100vw-1.5rem)]">
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
        <div v-if="showViewModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50 p-3 sm:p-4 overflow-y-auto" @click.self="closeViewModal" style="min-height: 100vh;">
            <div class="bg-gradient-to-br from-white via-purple-50/30 to-pink-50/30 rounded-2xl shadow-2xl w-full max-w-lg border border-purple-100 transform transition-all my-auto max-w-[calc(100vw-1.5rem)]">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-blue-500 via-cyan-500 to-blue-500 rounded-t-2xl p-4 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 flex-1 min-w-0">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-xl sm:text-2xl font-bold text-white truncate">Admin Details</h3>
                                <p class="text-blue-100 text-xs sm:text-sm mt-0.5 hidden sm:block">View administrator information</p>
                            </div>
                        </div>
                        <button @click="closeViewModal" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition backdrop-blur-sm ml-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4 sm:p-6">
                    <div v-if="viewAdminData" class="space-y-5">
                        <!-- Profile Header -->
                        <div class="flex items-center space-x-4 p-5 bg-gradient-to-r from-blue-50 via-cyan-50 to-blue-50 rounded-xl border border-blue-100">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                                {{ viewAdminData.name.charAt(0).toUpperCase() }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xl font-bold text-gray-900 truncate">{{ viewAdminData.name }}</p>
                                <p class="text-sm text-gray-600 truncate">{{ viewAdminData.email }}</p>
                            </div>
                        </div>

                        <!-- Details Grid -->
                        <div class="grid grid-cols-1 gap-4">
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-purple-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">ID</span>
                                </div>
                                <span class="text-gray-900 font-bold">{{ viewAdminData.id }}</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-purple-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Name</span>
                                </div>
                                <span class="text-gray-900 font-semibold">{{ viewAdminData.name }}</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-purple-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Email</span>
                                </div>
                                <span class="text-gray-900 font-semibold text-sm">{{ viewAdminData.email }}</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-purple-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Role</span>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm"
                                    :class="viewAdminData.role === 'super_admin' 
                                        ? 'bg-gradient-to-r from-indigo-400 to-purple-400 text-white' 
                                        : 'bg-gradient-to-r from-purple-400 to-pink-400 text-white'">
                                    {{ viewAdminData.role }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-purple-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Created At</span>
                                </div>
                                <span class="text-gray-900 font-semibold text-sm">{{ formatDate(viewAdminData.created_at) }}</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-purple-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Last Updated</span>
                                </div>
                                <span class="text-gray-900 font-semibold text-sm">{{ formatDate(viewAdminData.updated_at) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6 pt-6 border-t border-gray-200">
                        <button 
                            @click="openPasswordModal(viewAdminData.id); closeViewModal();"
                            class="px-4 sm:px-6 py-2.5 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl hover:from-orange-600 hover:to-red-600 transition font-medium shadow-lg shadow-orange-500/30 transform hover:scale-105 w-full sm:w-auto flex items-center justify-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            Change Password
                        </button>
                        <button 
                            @click="closeViewModal"
                            class="px-4 sm:px-6 py-2.5 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:from-blue-600 hover:to-cyan-600 transition font-medium shadow-lg shadow-blue-500/30 transform hover:scale-105 w-full sm:w-auto"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Change Modal -->
        <div v-if="showPasswordModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50 p-3 sm:p-4 overflow-y-auto" @click.self="closePasswordModal" style="min-height: 100vh;">
            <div class="bg-gradient-to-br from-white via-orange-50/30 to-red-50/30 rounded-2xl shadow-2xl w-full max-w-lg border border-orange-100 transform transition-all my-auto max-w-[calc(100vw-1.5rem)]">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-orange-500 via-red-500 to-orange-500 rounded-t-2xl p-4 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 flex-1 min-w-0">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-xl sm:text-2xl font-bold text-white truncate">Change Password</h3>
                                <p class="text-orange-100 text-xs sm:text-sm mt-0.5 hidden sm:block">Update administrator password</p>
                            </div>
                        </div>
                        <button @click="closePasswordModal" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition backdrop-blur-sm ml-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-4 sm:p-6">
                    <form @submit.prevent="updatePassword">
                        <div class="space-y-5">
                            <!-- New Password Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    New Password
                                </label>
                                <input 
                                    type="password" 
                                    v-model="passwordForm.password" 
                                    placeholder="Enter new password (min 6 characters)"
                                    class="form-input-modern"
                                    required
                                    minlength="6"
                                >
                                <p class="form-hint-text">Minimum 6 characters required</p>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    Confirm Password
                                </label>
                                <input 
                                    type="password" 
                                    v-model="passwordForm.password_confirmation" 
                                    placeholder="Re-enter password to confirm"
                                    class="form-input-modern"
                                    required
                                    minlength="6"
                                >
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
                        <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6 pt-6 border-t border-gray-200">
                            <button 
                                type="button" 
                                @click="closePasswordModal"
                                class="px-4 sm:px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition font-medium shadow-sm w-full sm:w-auto"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit" 
                                :disabled="loading"
                                class="px-4 sm:px-6 py-2.5 bg-gradient-to-r from-orange-500 via-red-500 to-orange-500 text-white rounded-xl hover:from-orange-600 hover:via-red-600 hover:to-orange-600 transition font-medium shadow-lg shadow-orange-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95 w-full sm:w-auto"
                            >
                                <span v-if="!loading" class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Update Password</span>
                                </span>
                                <span v-else class="flex items-center space-x-2">
                                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>Updating...</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted, computed } from 'vue';
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

        const filters = ref({
            search: '',
            role: '',
            sortBy: 'created_at'
        });

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

        // Computed stats
        const stats = computed(() => {
            const totalAdmins = admins.value.length;
            const activeAdmins = admins.value.filter(a => a.status === 'active' || !a.status).length;
            
            // Calculate new admins this month
            const currentMonth = new Date().getMonth();
            const currentYear = new Date().getFullYear();
            const newThisMonth = admins.value.filter(admin => {
                const adminDate = new Date(admin.created_at);
                return adminDate.getMonth() === currentMonth && adminDate.getFullYear() === currentYear;
            }).length;

            return {
                totalAdmins,
                activeAdmins,
                newThisMonth
            };
        });

        // Filtered admins
        const filteredAdmins = computed(() => {
            let result = [...admins.value];

            // Search filter
            if (filters.value.search) {
                const searchLower = filters.value.search.toLowerCase();
                result = result.filter(admin => 
                    admin.name.toLowerCase().includes(searchLower) ||
                    admin.email.toLowerCase().includes(searchLower)
                );
            }

            // Role filter
            if (filters.value.role) {
                result = result.filter(admin => admin.role === filters.value.role);
            }

            // Sort
            result.sort((a, b) => {
                if (filters.value.sortBy === 'name') {
                    return a.name.localeCompare(b.name);
                } else if (filters.value.sortBy === 'email') {
                    return a.email.localeCompare(b.email);
                } else {
                    return new Date(b.created_at) - new Date(a.created_at);
                }
            });

            return result;
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

        // ESC key handler for closing modals
        const handleEscKey = (event) => {
            if (event.key === 'Escape') {
                if (showPasswordModal.value) {
                    closePasswordModal();
                } else if (showViewModal.value) {
                    closeViewModal();
                } else if (showModal.value) {
                    closeModal();
                }
            }
        };

        onMounted(() => {
            fetchAdmins();
            window.addEventListener('keydown', handleEscKey);
        });

        onUnmounted(() => {
            window.removeEventListener('keydown', handleEscKey);
        });

        return {
            admins,
            stats,
            filters,
            filteredAdmins,
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

/* Password modal specific input styling */
#password-modal .form-input-modern:focus {
    border-color: #f97316;
    box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
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
