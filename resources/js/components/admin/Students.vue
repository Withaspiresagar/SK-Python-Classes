<template>
    <div class="w-full overflow-hidden space-y-6">
        <!-- Stats Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="stat-card bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.totalStudents }}</div>
                        <div class="text-green-100 text-sm sm:text-base font-medium">Total Students</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-blue-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.activeStudents }}</div>
                        <div class="text-blue-100 text-sm sm:text-base font-medium">Active Students</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-gray-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.inactiveStudents }}</div>
                        <div class="text-gray-100 text-sm sm:text-base font-medium">Inactive Students</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-purple-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.newThisMonth }}</div>
                        <div class="text-purple-100 text-sm sm:text-base font-medium">New This Month</div>
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
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Students Management</h2>
                    <p class="text-gray-600 text-sm">Manage and search all student records</p>
                </div>
                <button 
                    @click="openAddModal"
                    class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-green-600 hover:to-emerald-600 transition font-medium shadow-lg shadow-green-500/30 transform hover:scale-105 text-sm sm:text-base whitespace-nowrap flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Student
                </button>
            </div>

            <!-- Search and Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Search Input -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Students</label>
                    <div class="relative">
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Search by name, email, or phone..."
                            class="w-full px-4 py-2.5 pl-11 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/50 focus:border-green-500 outline-none transition-all duration-300 bg-white"
                        />
                        <svg class="absolute left-3.5 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select
                        v-model="filters.status"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/50 focus:border-green-500 outline-none transition-all duration-300 bg-white"
                    >
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Sort By -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sort By</label>
                    <select
                        v-model="filters.sortBy"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/50 focus:border-green-500 outline-none transition-all duration-300 bg-white"
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
                    @click="filters.status = ''; filters.search = ''"
                    :class="filters.status === '' && filters.search === '' 
                        ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    All Students
                </button>
                <button
                    @click="filters.status = 'active'"
                    :class="filters.status === 'active' 
                        ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Active Only
                </button>
                <button
                    @click="filters.status = 'inactive'"
                    :class="filters.status === 'inactive' 
                        ? 'bg-gradient-to-r from-gray-500 to-gray-600 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Inactive Only
                </button>
                <button
                    @click="clearFilters"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition bg-gray-100 text-gray-700 hover:bg-gray-200"
                >
                    Clear Filters
                </button>
            </div>
        </div>

        <!-- Students Table Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm text-gray-600">
                    Showing <span class="font-semibold text-gray-900">{{ filteredStudents.length }}</span> of <span class="font-semibold text-gray-900">{{ students.length }}</span> students
                </div>
                <div class="flex items-center space-x-2">
                    <button
                        @click="exportStudents"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition"
                    >
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export
                    </button>
                </div>
            </div>
            
            <div class="overflow-x-auto -mx-4 sm:mx-0 lg:mx-0 w-full">
                <div class="inline-block w-full align-middle">
                    <table class="w-full divide-y divide-gray-200 table-auto">
                        <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Phone</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date of Birth</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Created At</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="(student, index) in filteredStudents" :key="student.id" class="hover:bg-gradient-to-r hover:from-green-50/50 hover:to-emerald-50/50 transition">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ getStudentNumber(index) }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ student.name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ student.email }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ student.phone || 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ formatDate(student.date_of_birth) || 'N/A' }}</td>
                                <td class="px-4 py-3">
                                    <span 
                                        :class="student.status === 'active' 
                                            ? 'bg-gradient-to-r from-green-400 to-emerald-400 text-white' 
                                            : 'bg-gradient-to-r from-gray-400 to-gray-500 text-white'"
                                        class="px-3 py-1 rounded-full text-xs font-medium shadow-sm"
                                    >
                                        {{ student.status === 'active' ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ formatDate(student.created_at) }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-2">
                                        <button 
                                            @click="viewStudent(student.id)"
                                            class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-3 py-1 rounded-lg hover:from-blue-600 hover:to-cyan-600 text-sm font-medium shadow-sm transition"
                                        >
                                            View
                                        </button>
                                        <button 
                                            @click="editStudent(student.id)"
                                            class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-3 py-1 rounded-lg hover:from-green-600 hover:to-emerald-600 text-sm font-medium shadow-sm transition"
                                        >
                                            Edit
                                        </button>
                                        <button 
                                            @click="toggleStudentStatus(student.id)"
                                            :class="student.status === 'active'
                                                ? 'bg-gradient-to-r from-orange-500 to-yellow-500 hover:from-orange-600 hover:to-yellow-600'
                                                : 'bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600'"
                                            class="text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition"
                                        >
                                            {{ student.status === 'active' ? 'Deactivate' : 'Activate' }}
                                        </button>
                                        <button 
                                            @click="deleteStudent(student.id)"
                                            class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-3 py-1 rounded-lg hover:from-red-600 hover:to-pink-600 text-sm font-medium shadow-sm transition"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="filteredStudents.length === 0">
                                <td colspan="8" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <p class="text-gray-500 font-medium text-lg mb-2">No students found</p>
                                        <p class="text-gray-400 text-sm mb-4">{{ filters.search || filters.status ? 'Try adjusting your filters' : 'Click "Add New Student" to create one' }}</p>
                                        <button 
                                            v-if="!filters.search && !filters.status"
                                            @click="openAddModal"
                                            class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-2 rounded-lg hover:from-green-600 hover:to-emerald-600 transition font-medium"
                                        >
                                            Add First Student
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
        <div v-if="showModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-start justify-center z-50 p-3 sm:p-4 overflow-y-auto" @click.self="closeModal" style="min-height: 100vh;">
            <div class="bg-gradient-to-br from-white via-green-50/30 to-emerald-50/30 rounded-2xl shadow-2xl w-full max-w-lg border border-green-100 transform transition-all my-4 sm:my-8 max-w-[calc(100vw-1.5rem)] flex flex-col max-h-[calc(100vh-2rem)]">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-green-500 via-emerald-500 to-green-500 rounded-t-2xl p-4 sm:p-6 flex-shrink-0">
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
                                    {{ modalMode === 'add' ? 'Add New Student' : 'Edit Student' }}
                                </h3>
                                <p class="text-green-100 text-xs sm:text-sm mt-0.5 hidden sm:block">
                                    {{ modalMode === 'add' ? 'Create a new student account' : 'Update student information' }}
                                </p>
                            </div>
                        </div>
                        <button @click="closeModal" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition backdrop-blur-sm flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-4 sm:p-6 overflow-y-auto flex-1">
                    <form @submit.prevent="saveStudent">
                        <div class="space-y-5">
                            <!-- Name Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Full Name
                                </label>
                                <input 
                                    type="text" 
                                    v-model="form.name" 
                                    placeholder="Enter student full name"
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Email Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Email Address
                                </label>
                                <input 
                                    type="email" 
                                    v-model="form.email" 
                                    placeholder="student@example.com"
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Phone Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    Phone Number
                                </label>
                                <input 
                                    type="tel" 
                                    v-model="form.phone" 
                                    placeholder="Enter phone number"
                                    class="form-input-modern"
                                >
                            </div>

                            <!-- Date of Birth Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Date of Birth
                                </label>
                                <input 
                                    type="date" 
                                    v-model="form.date_of_birth" 
                                    class="form-input-modern"
                                >
                            </div>

                            <!-- Password Type (Only for Add) -->
                            <template v-if="modalMode === 'add'">
                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Password Type
                                    </label>
                                    <select 
                                        v-model="form.password_type" 
                                        @change="onPasswordTypeChange"
                                        class="form-input-modern"
                                        required
                                    >
                                        <option value="local">Local (Enter Password)</option>
                                        <option value="email">Email (Auto-generate & Send)</option>
                                    </select>
                                    <p class="form-hint-text">
                                        {{ form.password_type === 'local' 
                                            ? 'Enter password manually' 
                                            : 'Password will be auto-generated and sent to student\'s email' }}
                                    </p>
                                </div>

                                <!-- Password Field (Only if Local is selected) -->
                                <div v-if="form.password_type === 'local'" class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Password
                                    </label>
                                    <input 
                                        type="password" 
                                        v-model="form.password" 
                                        placeholder="Enter secure password (min 6 characters)"
                                        class="form-input-modern"
                                        :required="form.password_type === 'local'"
                                        minlength="6"
                                    >
                                    <p class="form-hint-text">Minimum 6 characters required</p>
                                </div>
                            </template>
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

                        <!-- Success Message -->
                        <div v-if="successMessage" class="mt-5 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-green-700 text-sm font-medium">{{ successMessage }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-3 sm:space-x-3 mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-200 flex-shrink-0">
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
                                class="px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-green-500 via-emerald-500 to-green-500 text-white rounded-xl hover:from-green-600 hover:via-emerald-600 hover:to-green-600 transition font-medium shadow-lg shadow-green-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95 w-full sm:w-auto"
                            >
                                <span v-if="!loading" class="flex items-center space-x-2">
                                    <svg v-if="modalMode === 'add'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ modalMode === 'add' ? 'Create Student' : 'Update Student' }}</span>
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
        <div v-if="showViewModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center z-50 p-3 sm:p-4 overflow-y-auto" @click.self="closeViewModal">
            <div class="bg-gradient-to-br from-white via-green-50/30 to-emerald-50/30 rounded-2xl shadow-2xl w-full max-w-lg border border-green-100 transform transition-all my-4 sm:my-8 max-w-[calc(100vw-1.5rem)]">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-green-500 via-emerald-500 to-green-500 rounded-t-2xl p-4 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 flex-1 min-w-0">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg sm:text-2xl font-bold text-white truncate">Student Details</h3>
                                <p class="text-green-100 text-xs sm:text-sm mt-0.5 hidden sm:block">View complete student information</p>
                            </div>
                        </div>
                        <button @click="closeViewModal" class="w-8 h-8 sm:w-10 sm:h-10 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition backdrop-blur-sm flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div v-if="viewStudentData" class="p-4 sm:p-6 space-y-6">
                    <!-- Profile Section -->
                    <div class="flex items-center space-x-4 p-5 bg-gradient-to-r from-green-50 via-emerald-50 to-green-50 rounded-xl border border-green-100 shadow-sm">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center text-white font-bold text-2xl sm:text-3xl shadow-lg">
                            {{ viewStudentData.name.charAt(0).toUpperCase() }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-lg sm:text-xl font-bold text-gray-900 truncate">{{ viewStudentData.name }}</h4>
                            <p class="text-sm sm:text-base text-gray-600 truncate mt-1">{{ viewStudentData.email }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span 
                                    :class="viewStudentData.status === 'active' 
                                        ? 'bg-gradient-to-r from-green-400 to-emerald-400 text-white' 
                                        : 'bg-gradient-to-r from-gray-400 to-gray-500 text-white'"
                                    class="px-3 py-1 rounded-full text-xs font-medium shadow-sm"
                                >
                                    {{ viewStudentData.status === 'active' ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="bg-gradient-to-r from-blue-400 to-cyan-400 text-white px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                                    {{ viewStudentData.role }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">ID</span>
                            </div>
                            <p class="text-lg font-bold text-gray-900">{{ viewStudentData.id }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Phone</span>
                            </div>
                            <p class="text-lg font-bold text-gray-900">{{ viewStudentData.phone || 'N/A' }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Date of Birth</span>
                            </div>
                            <p class="text-lg font-bold text-gray-900">{{ formatDate(viewStudentData.date_of_birth) || 'N/A' }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Created</span>
                            </div>
                            <p class="text-lg font-bold text-gray-900">{{ formatDate(viewStudentData.created_at) }}</p>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                        <div class="flex items-center space-x-2 mb-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-semibold text-gray-700">Last Updated</span>
                        </div>
                        <p class="text-base text-gray-900">{{ formatDate(viewStudentData.updated_at) }}</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end space-x-3 p-4 sm:p-6 pt-0 border-t border-gray-200">
                    <button 
                        @click="closeViewModal"
                        class="px-6 py-2.5 bg-gradient-to-r from-green-500 via-emerald-500 to-green-500 text-white rounded-xl hover:from-green-600 hover:via-emerald-600 hover:to-green-600 transition font-medium shadow-lg shadow-green-500/30 transform hover:scale-105 active:scale-95 flex items-center space-x-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import axios from 'axios';

export default {
    name: 'Students',
    setup() {
        const students = ref([]);
        const showModal = ref(false);
        const showViewModal = ref(false);
        const modalMode = ref('add');
        const loading = ref(false);
        const error = ref('');
        const successMessage = ref('');
        const currentStudentId = ref(null);
        const viewStudentData = ref(null);

        const filters = ref({
            search: '',
            status: '',
            sortBy: 'created_at'
        });

        const stats = ref({
            totalStudents: 0,
            activeStudents: 0,
            inactiveStudents: 0,
            newThisMonth: 0
        });

        const form = ref({
            name: '',
            email: '',
            phone: '',
            date_of_birth: '',
            password_type: 'local',
            password: ''
        });

        // Computed filtered students
        const filteredStudents = computed(() => {
            let filtered = [...students.value];

            // Search filter
            if (filters.value.search) {
                const searchTerm = filters.value.search.toLowerCase();
                filtered = filtered.filter(student => 
                    student.name.toLowerCase().includes(searchTerm) ||
                    student.email.toLowerCase().includes(searchTerm) ||
                    (student.phone && student.phone.includes(searchTerm))
                );
            }

            // Status filter
            if (filters.value.status) {
                filtered = filtered.filter(student => student.status === filters.value.status);
            }

            // Sort
            filtered.sort((a, b) => {
                if (filters.value.sortBy === 'name') {
                    return a.name.localeCompare(b.name);
                } else if (filters.value.sortBy === 'email') {
                    return a.email.localeCompare(b.email);
                } else {
                    return new Date(b.created_at) - new Date(a.created_at);
                }
            });

            return filtered;
        });

        // Update stats
        const updateStats = () => {
            stats.value = {
                totalStudents: students.value.length,
                activeStudents: students.value.filter(s => s.status === 'active').length,
                inactiveStudents: students.value.filter(s => s.status === 'inactive').length,
                newThisMonth: students.value.filter(s => {
                    const created = new Date(s.created_at);
                    const now = new Date();
                    return created.getMonth() === now.getMonth() && created.getFullYear() === now.getFullYear();
                }).length
            };
        };

        const fetchStudents = async () => {
            try {
                const response = await axios.get('/api/students');
                if (response.data.success) {
                    students.value = response.data.students;
                    updateStats();
                }
            } catch (err) {
                console.error('Error fetching students:', err);
                error.value = 'Failed to fetch students';
            }
        };

        const clearFilters = () => {
            filters.value = {
                search: '',
                status: '',
                sortBy: 'created_at'
            };
        };

        const exportStudents = () => {
            // Simple CSV export
            const csvContent = [
                ['ID', 'Name', 'Email', 'Phone', 'Date of Birth', 'Status', 'Created At'],
                ...filteredStudents.value.map(s => [
                    s.id,
                    s.name,
                    s.email,
                    s.phone || 'N/A',
                    s.date_of_birth || 'N/A',
                    s.status,
                    s.created_at
                ])
            ].map(row => row.join(',')).join('\n');

            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `students_${new Date().toISOString().split('T')[0]}.csv`;
            a.click();
            window.URL.revokeObjectURL(url);
        };

        const openAddModal = () => {
            modalMode.value = 'add';
            form.value = {
                name: '',
                email: '',
                phone: '',
                date_of_birth: '',
                password_type: 'local',
                password: ''
            };
            error.value = '';
            successMessage.value = '';
            showModal.value = true;
        };

        const editStudent = async (id) => {
            try {
                const response = await axios.get(`/api/students/${id}`);
                if (response.data.success) {
                    const student = response.data.student;
                    form.value = {
                        name: student.name,
                        email: student.email,
                        phone: student.phone || '',
                        date_of_birth: student.date_of_birth || '',
                        password_type: 'local',
                        password: ''
                    };
                    modalMode.value = 'edit';
                    currentStudentId.value = id;
                    error.value = '';
                    successMessage.value = '';
                    showModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching student:', err);
                error.value = err.response?.data?.message || 'Failed to fetch student details';
            }
        };

        const viewStudent = async (id) => {
            try {
                const response = await axios.get(`/api/students/${id}`);
                if (response.data.success) {
                    viewStudentData.value = response.data.student;
                    showViewModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching student:', err);
                error.value = err.response?.data?.message || 'Failed to fetch student details';
            }
        };

        const saveStudent = async () => {
            loading.value = true;
            error.value = '';
            successMessage.value = '';

            try {
                if (modalMode.value === 'add') {
                    const payload = {
                        name: form.value.name,
                        email: form.value.email,
                        phone: form.value.phone,
                        date_of_birth: form.value.date_of_birth,
                        password_type: form.value.password_type
                    };

                    // Only include password if password_type is local
                    if (form.value.password_type === 'local') {
                        payload.password = form.value.password;
                    }

                    const response = await axios.post('/api/students', payload);
                    if (response.data.success) {
                        successMessage.value = response.data.message;
                        await fetchStudents();
                        setTimeout(() => {
                            closeModal();
                        }, 1500);
                    }
                } else {
                    const payload = {
                        name: form.value.name,
                        email: form.value.email,
                        phone: form.value.phone,
                        date_of_birth: form.value.date_of_birth
                    };

                    const response = await axios.put(`/api/students/${currentStudentId.value}`, payload);
                    if (response.data.success) {
                        successMessage.value = response.data.message;
                        await fetchStudents();
                        setTimeout(() => {
                            closeModal();
                        }, 1500);
                    }
                }
            } catch (err) {
                if (err.response?.data?.errors) {
                    const errors = err.response.data.errors;
                    error.value = Object.values(errors).flat().join(', ');
                } else {
                    error.value = err.response?.data?.message || 'Failed to save student';
                }
            } finally {
                loading.value = false;
            }
        };

        const toggleStudentStatus = async (id) => {
            try {
                const response = await axios.put(`/api/students/${id}/toggle-status`);
                if (response.data.success) {
                    await fetchStudents();
                } else {
                    alert(response.data.message || 'Failed to update student status');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to update student status');
            }
        };

        const deleteStudent = async (id) => {
            if (!confirm('Are you sure you want to delete this student? This action cannot be undone.')) {
                return;
            }

            try {
                const response = await axios.delete(`/api/students/${id}`);
                if (response.data.success) {
                    // Show success message
                    alert('Student deleted successfully');
                    // Refresh the list
                    await fetchStudents();
                } else {
                    alert(response.data.message || 'Failed to delete student');
                }
            } catch (err) {
                console.error('Delete error:', err);
                const errorMessage = err.response?.data?.message || err.message || 'Failed to delete student';
                alert(errorMessage);
            }
        };

        const onPasswordTypeChange = () => {
            if (form.value.password_type === 'email') {
                form.value.password = '';
            }
        };

        const closeModal = () => {
            showModal.value = false;
            form.value = {
                name: '',
                email: '',
                phone: '',
                date_of_birth: '',
                password_type: 'local',
                password: ''
            };
            error.value = '';
            successMessage.value = '';
            currentStudentId.value = null;
        };

        const closeViewModal = () => {
            showViewModal.value = false;
            viewStudentData.value = null;
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

        const getStudentNumber = (index) => {
            // Return sequential number starting from 1
            return index + 1;
        };

        // ESC key handler for closing modals
        const handleEscKey = (event) => {
            if (event.key === 'Escape') {
                if (showViewModal.value) {
                    closeViewModal();
                } else if (showModal.value) {
                    closeModal();
                }
            }
        };

        onMounted(() => {
            fetchStudents();
            window.addEventListener('keydown', handleEscKey);
        });

        onUnmounted(() => {
            window.removeEventListener('keydown', handleEscKey);
        });

        return {
            students,
            filteredStudents,
            stats,
            filters,
            showModal,
            showViewModal,
            modalMode,
            loading,
            error,
            successMessage,
            form,
            viewStudentData,
            openAddModal,
            editStudent,
            viewStudent,
            saveStudent,
            toggleStudentStatus,
            deleteStudent,
            onPasswordTypeChange,
            closeModal,
            closeViewModal,
            formatDate,
            clearFilters,
            exportStudents,
            getStudentNumber
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
    border-color: #10b981;
    box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
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
