<template>
    <div class="w-full overflow-hidden space-y-6">
        <!-- Stats Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="stat-card bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-orange-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.totalBatches }}</div>
                        <div class="text-orange-100 text-sm sm:text-base font-medium">Total Batches</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.activeBatches }}</div>
                        <div class="text-green-100 text-sm sm:text-base font-medium">Active Batches</div>
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
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.inactiveBatches }}</div>
                        <div class="text-gray-100 text-sm sm:text-base font-medium">Inactive Batches</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-blue-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.totalStudents }}</div>
                        <div class="text-blue-100 text-sm sm:text-base font-medium">Total Students</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                <div class="flex-1">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Batches Management</h2>
                    <p class="text-gray-600 text-sm">Manage and search all batches</p>
                </div>
                <button 
                    @click="openAddModal"
                    class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-orange-600 hover:to-red-600 transition font-medium shadow-lg shadow-orange-500/30 transform hover:scale-105 text-sm sm:text-base whitespace-nowrap flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Batch
                </button>
            </div>

            <!-- Search and Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Search Input -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Batches</label>
                    <div class="relative">
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Search by name or course..."
                            class="w-full px-4 py-2.5 pl-11 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 outline-none transition-all duration-300 bg-white"
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
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 outline-none transition-all duration-300 bg-white"
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
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 outline-none transition-all duration-300 bg-white"
                    >
                        <option value="created_at">Newest First</option>
                        <option value="name">Name (A-Z)</option>
                        <option value="start_date">Start Date</option>
                    </select>
                </div>
            </div>

            <!-- Quick Filter Buttons -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button
                    @click="filters.status = ''; filters.search = ''"
                    :class="filters.status === '' && filters.search === '' 
                        ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    All Batches
                </button>
                <button
                    @click="filters.status = 'active'"
                    :class="filters.status === 'active' 
                        ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white' 
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

        <!-- Batches Table Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm text-gray-600">
                    Showing <span class="font-semibold text-gray-900">{{ filteredBatches.length }}</span> of <span class="font-semibold text-gray-900">{{ batches.length }}</span> batches
                </div>
            </div>
            
            <div class="overflow-x-auto -mx-4 sm:mx-0 lg:mx-0 w-full">
                <div class="inline-block w-full align-middle">
                    <table class="w-full divide-y divide-gray-200 table-auto">
                        <thead class="bg-gradient-to-r from-orange-50 to-red-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Batch Name</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Course</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Start Date</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">End Date</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Students</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="(batch, index) in filteredBatches" :key="batch.id" class="hover:bg-gradient-to-r hover:from-orange-50/50 hover:to-red-50/50 transition">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ index + 1 }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ batch.name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ batch.course ? batch.course.name : 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ formatDate(batch.start_date) || 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ formatDate(batch.end_date) || 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                        {{ batch.students ? batch.students.length : 0 }} students
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span 
                                        :class="batch.status === 'active' 
                                            ? 'bg-gradient-to-r from-green-400 to-emerald-400 text-white' 
                                            : 'bg-gradient-to-r from-gray-400 to-gray-500 text-white'"
                                        class="px-3 py-1 rounded-full text-xs font-medium shadow-sm"
                                    >
                                        {{ batch.status === 'active' ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        <button 
                                            @click="viewBatch(batch.id)"
                                            class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-2.5 py-1.5 rounded-lg hover:from-blue-600 hover:to-cyan-600 text-xs font-medium shadow-sm transition transform hover:scale-105 active:scale-95 flex items-center gap-1"
                                            title="View Details"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </button>
                                        <button 
                                            @click="editBatch(batch.id)"
                                            class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-2.5 py-1.5 rounded-lg hover:from-green-600 hover:to-emerald-600 text-xs font-medium shadow-sm transition transform hover:scale-105 active:scale-95 flex items-center gap-1"
                                            title="Edit Batch"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button 
                                            @click="assignStudents(batch.id)"
                                            class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-2.5 py-1.5 rounded-lg hover:from-purple-600 hover:to-pink-600 text-xs font-medium shadow-sm transition transform hover:scale-105 active:scale-95 flex items-center gap-1"
                                            title="Assign Students"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            Students
                                        </button>
                                        <button 
                                            @click="toggleBatchStatus(batch.id)"
                                            :class="batch.status === 'active'
                                                ? 'bg-gradient-to-r from-orange-500 to-yellow-500 hover:from-orange-600 hover:to-yellow-600'
                                                : 'bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600'"
                                            class="text-white px-2.5 py-1.5 rounded-lg text-xs font-medium shadow-sm transition transform hover:scale-105 active:scale-95 flex items-center gap-1"
                                            :title="batch.status === 'active' ? 'Deactivate Batch' : 'Activate Batch'"
                                        >
                                            <svg v-if="batch.status === 'active'" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                            <svg v-else class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ batch.status === 'active' ? 'Deactivate' : 'Activate' }}
                                        </button>
                                        <button 
                                            @click="deleteBatch(batch.id)"
                                            class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-2.5 py-1.5 rounded-lg hover:from-red-600 hover:to-pink-600 text-xs font-medium shadow-sm transition transform hover:scale-105 active:scale-95 flex items-center gap-1"
                                            title="Delete Batch"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="filteredBatches.length === 0">
                                <td colspan="8" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        <p class="text-gray-500 font-medium text-lg mb-2">No batches found</p>
                                        <p class="text-gray-400 text-sm mb-4">{{ filters.search || filters.status ? 'Try adjusting your filters' : 'Click "Add New Batch" to create one' }}</p>
                                        <button 
                                            v-if="!filters.search && !filters.status"
                                            @click="openAddModal"
                                            class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-2 rounded-lg hover:from-orange-600 hover:to-red-600 transition font-medium"
                                        >
                                            Add First Batch
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
        <div v-if="showModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-start justify-center z-[9999] overflow-y-auto pt-16 sm:pt-20 pb-4 sm:pb-8 px-3 sm:px-4" @click.self="closeModal" style="top: 0; left: 0; right: 0; bottom: 0;">
            <div class="bg-gradient-to-br from-white via-orange-50/30 to-red-50/30 rounded-2xl shadow-2xl w-full max-w-lg border border-orange-100 transform transition-all my-auto max-w-[calc(100vw-1.5rem)] flex flex-col max-h-[calc(100vh-5rem)]">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-orange-500 via-red-500 to-orange-500 rounded-t-2xl p-4 sm:p-6 flex-shrink-0">
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
                                    {{ modalMode === 'add' ? 'Add New Batch' : 'Edit Batch' }}
                                </h3>
                                <p class="text-orange-100 text-xs sm:text-sm mt-0.5 hidden sm:block">
                                    {{ modalMode === 'add' ? 'Create a new batch' : 'Update batch information' }}
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
                    <form @submit.prevent="saveBatch">
                        <div class="space-y-5">
                            <!-- Batch Name Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Batch Name
                                </label>
                                <input 
                                    type="text" 
                                    v-model="form.name" 
                                    placeholder="Enter batch name"
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Course Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Course
                                </label>
                                <select 
                                    v-model="form.course_id" 
                                    class="form-input-modern"
                                >
                                    <option value="">Select Course</option>
                                    <option v-for="course in activeCourses" :key="course.id" :value="course.id">
                                        {{ course.name }}
                                    </option>
                                </select>
                                <p class="form-hint-text">Select an active course for this batch</p>
                            </div>

                            <!-- Start Date Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Start Date
                                </label>
                                <input 
                                    type="date" 
                                    v-model="form.start_date" 
                                    class="form-input-modern"
                                >
                            </div>

                            <!-- End Date Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    End Date
                                </label>
                                <input 
                                    type="date" 
                                    v-model="form.end_date" 
                                    class="form-input-modern"
                                    :min="form.start_date"
                                >
                            </div>

                            <!-- Description Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>
                                    Description
                                </label>
                                <textarea 
                                    v-model="form.description" 
                                    placeholder="Enter batch description (optional)"
                                    class="form-input-modern"
                                    rows="3"
                                ></textarea>
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
                                class="px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-orange-500 via-red-500 to-orange-500 text-white rounded-xl hover:from-orange-600 hover:via-red-600 hover:to-orange-600 transition font-medium shadow-lg shadow-orange-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95 w-full sm:w-auto"
                            >
                                <span v-if="!loading" class="flex items-center space-x-2">
                                    <svg v-if="modalMode === 'add'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ modalMode === 'add' ? 'Create Batch' : 'Update Batch' }}</span>
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

        <!-- View Batch Modal -->
        <div v-if="showViewModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-start justify-center z-[9999] overflow-y-auto pt-16 sm:pt-20 pb-4 sm:pb-8 px-3 sm:px-4" @click.self="closeViewModal" style="top: 0; left: 0; right: 0; bottom: 0;">
            <div class="bg-gradient-to-br from-white via-blue-50/30 to-cyan-50/30 rounded-2xl shadow-2xl w-full max-w-3xl border border-blue-100 transform transition-all my-auto max-w-[calc(100vw-1.5rem)] flex flex-col max-h-[calc(100vh-5rem)]">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-blue-500 via-cyan-500 to-blue-500 rounded-t-2xl p-4 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 flex-1 min-w-0">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg sm:text-2xl font-bold text-white truncate">Batch Details</h3>
                                <p class="text-blue-100 text-xs sm:text-sm mt-0.5 hidden sm:block">View complete batch information</p>
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
                <div v-if="viewBatchData" class="p-4 sm:p-6 space-y-6 overflow-y-auto flex-1 custom-scrollbar">
                    <!-- Batch Header -->
                    <div class="flex items-center space-x-4 p-5 bg-gradient-to-r from-blue-50 via-cyan-50 to-blue-50 rounded-xl border border-blue-100 shadow-sm">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-2xl sm:text-3xl shadow-lg">
                            {{ viewBatchData.name.charAt(0).toUpperCase() }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-lg sm:text-xl font-bold text-gray-900 truncate">{{ viewBatchData.name }}</h4>
                            <p class="text-sm sm:text-base text-gray-600 truncate mt-1" v-if="viewBatchData.course">{{ viewBatchData.course.name }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span 
                                    :class="viewBatchData.status === 'active' 
                                        ? 'bg-gradient-to-r from-green-400 to-emerald-400 text-white' 
                                        : 'bg-gradient-to-r from-gray-400 to-gray-500 text-white'"
                                    class="px-3 py-1 rounded-full text-xs font-medium shadow-sm"
                                >
                                    {{ viewBatchData.status === 'active' ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="bg-gradient-to-r from-blue-400 to-cyan-400 text-white px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                                    {{ viewBatchData.students ? viewBatchData.students.length : 0 }} Students
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Batch ID</span>
                            </div>
                            <p class="text-lg font-bold text-gray-900">{{ viewBatchData.id }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Course</span>
                            </div>
                            <p class="text-lg font-bold text-gray-900">{{ viewBatchData.course ? viewBatchData.course.name : 'Not Assigned' }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Start Date</span>
                            </div>
                            <p class="text-lg font-bold text-gray-900">{{ formatDate(viewBatchData.start_date) || 'Not Set' }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">End Date</span>
                            </div>
                            <p class="text-lg font-bold text-gray-900">{{ formatDate(viewBatchData.end_date) || 'Not Set' }}</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div v-if="viewBatchData.description" class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                        <div class="flex items-center space-x-2 mb-3">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            <span class="text-sm font-semibold text-gray-700">Description</span>
                        </div>
                        <p class="text-base text-gray-900 whitespace-pre-wrap">{{ viewBatchData.description }}</p>
                    </div>

                    <!-- Students List -->
                    <div v-if="viewBatchData.students && viewBatchData.students.length > 0" class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span class="text-sm font-semibold text-gray-700">Students ({{ viewBatchData.students.length }})</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-64 overflow-y-auto custom-scrollbar">
                            <div v-for="student in viewBatchData.students" :key="student.id" class="flex items-center space-x-3 p-3 bg-gradient-to-r from-gray-50 to-blue-50 rounded-lg border border-gray-200 hover:border-blue-300 transition">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-cyan-400 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                    {{ student.name.charAt(0).toUpperCase() }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate">{{ student.name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ student.email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="bg-white rounded-xl p-8 border border-gray-200 shadow-sm text-center">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <p class="text-gray-500 font-medium">No students assigned to this batch</p>
                    </div>

                    <!-- Additional Info -->
                    <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                        <div class="flex items-center space-x-2 mb-3">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-semibold text-gray-700">Created</span>
                        </div>
                        <p class="text-base text-gray-900">{{ formatDate(viewBatchData.created_at) }}</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end space-x-3 p-4 sm:p-6 pt-0 border-t border-gray-200 flex-shrink-0">
                    <button 
                        @click="closeViewModal"
                        class="px-6 py-2.5 bg-gradient-to-r from-blue-500 via-cyan-500 to-blue-500 text-white rounded-xl hover:from-blue-600 hover:via-cyan-600 hover:to-blue-600 transition font-medium shadow-lg shadow-blue-500/30 transform hover:scale-105 active:scale-95 flex items-center space-x-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>Close</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Assign Students Modal -->
        <div v-if="showAssignModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-start justify-center z-[9999] overflow-y-auto pt-16 sm:pt-20 pb-4 sm:pb-8 px-3 sm:px-4" @click.self="closeAssignModal" style="top: 0; left: 0; right: 0; bottom: 0;">
            <div class="bg-gradient-to-br from-white via-purple-50/30 to-pink-50/30 rounded-2xl shadow-2xl w-full max-w-2xl border border-purple-100 transform transition-all my-auto max-w-[calc(100vw-1.5rem)] flex flex-col max-h-[calc(100vh-5rem)]">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-purple-500 via-pink-500 to-purple-500 rounded-t-2xl p-4 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 flex-1 min-w-0">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg sm:text-2xl font-bold text-white truncate">Assign Students to Batch</h3>
                                <p class="text-purple-100 text-xs sm:text-sm mt-0.5 hidden sm:block">{{ currentBatchName }}</p>
                            </div>
                        </div>
                        <button @click="closeAssignModal" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition backdrop-blur-sm flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4 sm:p-6 overflow-y-auto flex-1">
                    <div class="mb-4">
                        <div class="relative">
                            <input
                                v-model="studentSearch"
                                type="text"
                                placeholder="Search students by name or email..."
                                class="w-full px-4 py-2.5 pl-11 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 outline-none transition-all duration-300 bg-white"
                            />
                            <svg class="absolute left-3.5 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            {{ selectedStudents.length }} student(s) selected
                        </p>
                    </div>
                    <div class="max-h-96 overflow-y-auto space-y-2 custom-scrollbar">
                        <label v-for="student in filteredStudents" :key="student.id" class="flex items-center space-x-3 p-3 bg-white rounded-lg border-2 transition cursor-pointer hover:shadow-md"
                            :class="selectedStudents.includes(student.id) 
                                ? 'border-purple-400 bg-purple-50 shadow-sm' 
                                : 'border-gray-200 hover:border-purple-300 hover:bg-purple-50'">
                            <input
                                type="checkbox"
                                :value="student.id"
                                v-model="selectedStudents"
                                class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500 cursor-pointer"
                            />
                            <div class="flex items-center space-x-3 flex-1 min-w-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm flex-shrink-0">
                                    {{ student.name.charAt(0).toUpperCase() }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate">{{ student.name }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ student.email }}</p>
                                </div>
                            </div>
                        </label>
                        <p v-if="filteredStudents.length === 0" class="text-center text-gray-500 py-12">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            No students found
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end space-x-3 p-4 sm:p-6 pt-0 border-t border-gray-200 flex-shrink-0">
                    <button 
                        @click="closeAssignModal"
                        class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition font-medium shadow-sm transform hover:scale-105 active:scale-95"
                    >
                        Cancel
                    </button>
                    <button 
                        @click="saveStudentAssignment"
                        :disabled="loading || selectedStudents.length === 0"
                        class="px-6 py-2.5 bg-gradient-to-r from-purple-500 via-pink-500 to-purple-500 text-white rounded-xl hover:from-purple-600 hover:via-pink-600 hover:to-purple-600 transition font-medium shadow-lg shadow-purple-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95 flex items-center space-x-2"
                    >
                        <svg v-if="!loading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <svg v-else class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>{{ loading ? 'Saving...' : `Assign ${selectedStudents.length} Student(s)` }}</span>
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
    name: 'Batches',
    setup() {
        const batches = ref([]);
        const students = ref([]);
        const activeCourses = ref([]);
        const showModal = ref(false);
        const showAssignModal = ref(false);
        const showViewModal = ref(false);
        const modalMode = ref('add');
        const loading = ref(false);
        const error = ref('');
        const successMessage = ref('');
        const currentBatchId = ref(null);
        const currentBatchName = ref('');
        const selectedStudents = ref([]);
        const studentSearch = ref('');
        const viewBatchData = ref(null);

        const filters = ref({
            search: '',
            status: '',
            sortBy: 'created_at'
        });

        const stats = ref({
            totalBatches: 0,
            activeBatches: 0,
            inactiveBatches: 0,
            totalStudents: 0
        });

        const form = ref({
            name: '',
            course_id: '',
            description: '',
            start_date: '',
            end_date: '',
            status: 'active'
        });

        // Computed filtered batches
        const filteredBatches = computed(() => {
            let filtered = [...batches.value];

            // Search filter
            if (filters.value.search) {
                const searchTerm = filters.value.search.toLowerCase();
                filtered = filtered.filter(batch => 
                    batch.name.toLowerCase().includes(searchTerm) ||
                    (batch.course && batch.course.name.toLowerCase().includes(searchTerm))
                );
            }

            // Status filter
            if (filters.value.status) {
                filtered = filtered.filter(batch => batch.status === filters.value.status);
            }

            // Sort
            filtered.sort((a, b) => {
                if (filters.value.sortBy === 'name') {
                    return a.name.localeCompare(b.name);
                } else if (filters.value.sortBy === 'start_date') {
                    return new Date(a.start_date || 0) - new Date(b.start_date || 0);
                } else {
                    return new Date(b.created_at) - new Date(a.created_at);
                }
            });

            return filtered;
        });

        // Filtered students for assignment
        const filteredStudents = computed(() => {
            if (!studentSearch.value) return students.value;
            const searchTerm = studentSearch.value.toLowerCase();
            return students.value.filter(student =>
                student.name.toLowerCase().includes(searchTerm) ||
                student.email.toLowerCase().includes(searchTerm)
            );
        });

        // Update stats
        const updateStats = () => {
            const totalStudents = batches.value.reduce((sum, batch) => sum + (batch.students ? batch.students.length : 0), 0);
            stats.value = {
                totalBatches: batches.value.length,
                activeBatches: batches.value.filter(b => b.status === 'active').length,
                inactiveBatches: batches.value.filter(b => b.status === 'inactive').length,
                totalStudents: totalStudents
            };
        };

        const fetchBatches = async () => {
            try {
                const response = await axios.get('/api/batches');
                if (response.data.success) {
                    batches.value = response.data.batches;
                    updateStats();
                }
            } catch (err) {
                console.error('Error fetching batches:', err);
                error.value = 'Failed to fetch batches';
            }
        };

        const fetchStudents = async () => {
            try {
                const response = await axios.get('/api/students');
                if (response.data.success) {
                    students.value = response.data.students.filter(s => s.role === 'student');
                }
            } catch (err) {
                console.error('Error fetching students:', err);
            }
        };

        const fetchActiveCourses = async () => {
            try {
                const response = await axios.get('/api/batches/active-courses');
                if (response.data.success) {
                    activeCourses.value = response.data.courses;
                }
            } catch (err) {
                console.error('Error fetching active courses:', err);
            }
        };

        const clearFilters = () => {
            filters.value = {
                search: '',
                status: '',
                sortBy: 'created_at'
            };
        };

        const openAddModal = () => {
            modalMode.value = 'add';
            form.value = {
                name: '',
                course_id: '',
                description: '',
                start_date: '',
                end_date: '',
                status: 'active'
            };
            error.value = '';
            successMessage.value = '';
            showModal.value = true;
        };

        const editBatch = async (id) => {
            try {
                const response = await axios.get(`/api/batches/${id}`);
                if (response.data.success) {
                    const batch = response.data.batch;
                    form.value = {
                        name: batch.name,
                        course_id: batch.course_id || '',
                        description: batch.description || '',
                        start_date: batch.start_date ? batch.start_date.split('T')[0] : '',
                        end_date: batch.end_date ? batch.end_date.split('T')[0] : '',
                        status: batch.status
                    };
                    modalMode.value = 'edit';
                    currentBatchId.value = id;
                    error.value = '';
                    successMessage.value = '';
                    showModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching batch:', err);
                error.value = err.response?.data?.message || 'Failed to fetch batch details';
            }
        };

        const viewBatch = async (id) => {
            try {
                const response = await axios.get(`/api/batches/${id}`);
                if (response.data.success) {
                    viewBatchData.value = response.data.batch;
                    showViewModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching batch:', err);
                alert('Failed to fetch batch details');
            }
        };

        const saveBatch = async () => {
            loading.value = true;
            error.value = '';
            successMessage.value = '';

            try {
                const payload = {
                    name: form.value.name,
                    course_id: form.value.course_id || null,
                    description: form.value.description,
                    start_date: form.value.start_date || null,
                    end_date: form.value.end_date || null,
                    status: form.value.status
                };

                if (modalMode.value === 'add') {
                    const response = await axios.post('/api/batches', payload);
                    if (response.data.success) {
                        successMessage.value = response.data.message;
                        await fetchBatches();
                        setTimeout(() => {
                            closeModal();
                        }, 1500);
                    }
                } else {
                    const response = await axios.put(`/api/batches/${currentBatchId.value}`, payload);
                    if (response.data.success) {
                        successMessage.value = response.data.message;
                        await fetchBatches();
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
                    error.value = err.response?.data?.message || 'Failed to save batch';
                }
            } finally {
                loading.value = false;
            }
        };

        const toggleBatchStatus = async (id) => {
            try {
                const response = await axios.put(`/api/batches/${id}/toggle-status`);
                if (response.data.success) {
                    await fetchBatches();
                } else {
                    alert(response.data.message || 'Failed to update batch status');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to update batch status');
            }
        };

        const deleteBatch = async (id) => {
            if (!confirm('Are you sure you want to delete this batch?')) {
                return;
            }

            try {
                const response = await axios.delete(`/api/batches/${id}`);
                if (response.data.success) {
                    await fetchBatches();
                } else {
                    alert(response.data.message || 'Failed to delete batch');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to delete batch');
            }
        };

        const assignStudents = async (id) => {
            try {
                const response = await axios.get(`/api/batches/${id}`);
                if (response.data.success) {
                    const batch = response.data.batch;
                    currentBatchId.value = id;
                    currentBatchName.value = batch.name;
                    selectedStudents.value = batch.students ? batch.students.map(s => s.id) : [];
                    studentSearch.value = '';
                    showAssignModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching batch:', err);
                alert('Failed to fetch batch details');
            }
        };

        const saveStudentAssignment = async () => {
            loading.value = true;
            try {
                const response = await axios.post(`/api/batches/${currentBatchId.value}/assign-students`, {
                    student_ids: selectedStudents.value
                });
                if (response.data.success) {
                    await fetchBatches();
                    closeAssignModal();
                    alert('Students assigned successfully');
                } else {
                    alert(response.data.message || 'Failed to assign students');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to assign students');
            } finally {
                loading.value = false;
            }
        };

        const closeModal = () => {
            showModal.value = false;
            form.value = {
                name: '',
                course_id: '',
                description: '',
                start_date: '',
                end_date: '',
                status: 'active'
            };
            error.value = '';
            successMessage.value = '';
            currentBatchId.value = null;
        };

        const closeAssignModal = () => {
            showAssignModal.value = false;
            currentBatchId.value = null;
            currentBatchName.value = '';
            selectedStudents.value = [];
            studentSearch.value = '';
        };

        const closeViewModal = () => {
            showViewModal.value = false;
            viewBatchData.value = null;
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

        // ESC key handler for closing modals
        const handleEscKey = (event) => {
            if (event.key === 'Escape') {
                if (showAssignModal.value) {
                    closeAssignModal();
                } else if (showViewModal.value) {
                    closeViewModal();
                } else if (showModal.value) {
                    closeModal();
                }
            }
        };

        onMounted(() => {
            fetchBatches();
            fetchStudents();
            fetchActiveCourses();
            window.addEventListener('keydown', handleEscKey);
        });

        onUnmounted(() => {
            window.removeEventListener('keydown', handleEscKey);
        });

        return {
            batches,
            filteredBatches,
            students,
            filteredStudents,
            activeCourses,
            stats,
            filters,
            showModal,
            showAssignModal,
            modalMode,
            loading,
            error,
            successMessage,
            form,
            currentBatchName,
            selectedStudents,
            studentSearch,
            openAddModal,
            editBatch,
            viewBatch,
            saveBatch,
            toggleBatchStatus,
            deleteBatch,
            assignStudents,
            saveStudentAssignment,
            closeModal,
            closeAssignModal,
            closeViewModal,
            viewBatchData,
            showViewModal,
            clearFilters,
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
    border-color: #f97316;
    box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
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

/* Custom Scrollbar */
.custom-scrollbar {
    scrollbar-width: thin;
    scrollbar-color: rgba(147, 51, 234, 0.3) rgba(147, 51, 234, 0.1);
}

.custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(147, 51, 234, 0.1);
    border-radius: 4px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(147, 51, 234, 0.3);
    border-radius: 4px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(147, 51, 234, 0.5);
}
</style>

