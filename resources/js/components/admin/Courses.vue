<template>
    <div class="w-full overflow-hidden space-y-6">
        <!-- Stats Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <div class="stat-card bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-indigo-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.totalCourses }}</div>
                        <div class="text-indigo-100 text-sm sm:text-base font-medium">Total Courses</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.activeCourses }}</div>
                        <div class="text-green-100 text-sm sm:text-base font-medium">Active Courses</div>
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
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.inactiveCourses }}</div>
                        <div class="text-gray-100 text-sm sm:text-base font-medium">Inactive Courses</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                <div class="flex-1">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Courses Management</h2>
                    <p class="text-gray-600 text-sm">Manage and search all courses</p>
                </div>
                <button 
                    @click="openAddModal"
                    class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-indigo-600 hover:to-purple-600 transition font-medium shadow-lg shadow-indigo-500/30 transform hover:scale-105 text-sm sm:text-base whitespace-nowrap flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New Course
                </button>
            </div>

            <!-- Search and Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Search Input -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Courses</label>
                    <div class="relative">
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Search by name or description..."
                            class="w-full px-4 py-2.5 pl-11 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white"
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
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white"
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
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white"
                    >
                        <option value="created_at">Newest First</option>
                        <option value="name">Name (A-Z)</option>
                        <option value="price">Price (Low to High)</option>
                    </select>
                </div>
            </div>

            <!-- Quick Filter Buttons -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button
                    @click="filters.status = ''; filters.search = ''"
                    :class="filters.status === '' && filters.search === '' 
                        ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    All Courses
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

        <!-- Courses Grid Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm text-gray-600">
                    Showing <span class="font-semibold text-gray-900">{{ filteredCourses.length }}</span> of <span class="font-semibold text-gray-900">{{ courses.length }}</span> courses
                </div>
            </div>
            
            <!-- Courses Grid -->
            <div v-if="filteredCourses.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="course in filteredCourses" :key="course.id" class="course-card bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <!-- Thumbnail -->
                    <div class="relative h-48 bg-gradient-to-br from-indigo-400 to-purple-500 overflow-hidden">
                        <img 
                            v-if="course.thumbnail" 
                            :src="`/storage/${course.thumbnail}`" 
                            :alt="course.name"
                            class="w-full h-full object-cover"
                        >
                        <div v-else class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="absolute top-3 right-3">
                            <span 
                                :class="course.status === 'active' 
                                    ? 'bg-gradient-to-r from-green-400 to-emerald-400 text-white' 
                                    : 'bg-gradient-to-r from-gray-400 to-gray-500 text-white'"
                                class="px-3 py-1 rounded-full text-xs font-medium shadow-lg"
                            >
                                {{ course.status === 'active' ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ course.name }}</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ course.description || 'No description available' }}</p>
                        
                        <div class="flex items-center justify-between mb-4 text-sm">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ course.duration_hours || 'N/A' }} hrs</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span>{{ course.level || 'N/A' }}</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mb-4">
                            <div class="text-2xl font-bold text-indigo-600">₹{{ course.price || 0 }}</div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-wrap gap-2">
                            <button 
                                @click="viewCourse(course.id)"
                                class="flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-3 py-2 rounded-lg hover:from-blue-600 hover:to-cyan-600 text-sm font-medium shadow-sm transition"
                            >
                                View
                            </button>
                            <button 
                                @click="editCourse(course.id)"
                                class="flex-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white px-3 py-2 rounded-lg hover:from-green-600 hover:to-emerald-600 text-sm font-medium shadow-sm transition"
                            >
                                Edit
                            </button>
                            <button 
                                @click="toggleCourseStatus(course.id)"
                                :class="course.status === 'active'
                                    ? 'bg-gradient-to-r from-orange-500 to-yellow-500 hover:from-orange-600 hover:to-yellow-600'
                                    : 'bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600'"
                                class="flex-1 text-white px-3 py-2 rounded-lg text-sm font-medium shadow-sm transition"
                            >
                                {{ course.status === 'active' ? 'Deactivate' : 'Activate' }}
                            </button>
                            <button 
                                @click="deleteCourse(course.id)"
                                class="flex-1 bg-gradient-to-r from-red-500 to-pink-500 text-white px-3 py-2 rounded-lg hover:from-red-600 hover:to-pink-600 text-sm font-medium shadow-sm transition"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="text-center py-12">
                <div class="flex flex-col items-center">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <p class="text-gray-500 font-medium text-lg mb-2">No courses found</p>
                    <p class="text-gray-400 text-sm mb-4">{{ filters.search || filters.status ? 'Try adjusting your filters' : 'Click "Create New Course" to add one' }}</p>
                    <button 
                        v-if="!filters.search && !filters.status"
                        @click="openAddModal"
                        class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-6 py-2 rounded-lg hover:from-indigo-600 hover:to-purple-600 transition font-medium"
                    >
                        Create First Course
                    </button>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center z-[9999] p-3 sm:p-4 overflow-y-auto" @click.self="closeModal">
            <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl shadow-2xl w-full max-w-2xl border border-indigo-100 transform transition-all flex flex-col max-h-[calc(100vh-2rem)] lg:max-h-[90vh] mx-auto">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 rounded-t-2xl p-4 sm:p-6 flex-shrink-0">
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
                                    {{ modalMode === 'add' ? 'Create New Course' : 'Edit Course' }}
                                </h3>
                                <p class="text-indigo-100 text-xs sm:text-sm mt-0.5 hidden sm:block">
                                    {{ modalMode === 'add' ? 'Add a new course to the system' : 'Update course information' }}
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
                    <form @submit.prevent="saveCourse" enctype="multipart/form-data">
                        <div class="space-y-5">
                            <!-- Course Name -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Course Name *
                                </label>
                                <input 
                                    type="text" 
                                    v-model="form.name" 
                                    placeholder="Enter course name"
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Description -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>
                                    Description
                                </label>
                                <textarea 
                                    v-model="form.description" 
                                    placeholder="Enter course description..."
                                    rows="4"
                                    class="form-input-modern"
                                ></textarea>
                            </div>

                            <!-- Thumbnail -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Thumbnail Image
                                </label>
                                <input 
                                    type="file" 
                                    @change="handleThumbnailChange"
                                    accept="image/*"
                                    class="form-input-modern"
                                >
                                <p class="form-hint-text">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF, WebP</p>
                                <div v-if="form.thumbnailPreview" class="mt-3">
                                    <img :src="form.thumbnailPreview" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200">
                                </div>
                            </div>

                            <!-- Price and Duration -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Price (₹)
                                    </label>
                                    <input 
                                        type="number" 
                                        v-model="form.price" 
                                        placeholder="0.00"
                                        step="0.01"
                                        min="0"
                                        class="form-input-modern"
                                    >
                                </div>

                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Duration (Hours)
                                    </label>
                                    <input 
                                        type="number" 
                                        v-model="form.duration_hours" 
                                        placeholder="Enter duration in hours"
                                        min="0"
                                        class="form-input-modern"
                                    >
                                </div>
                            </div>

                            <!-- Level and Status -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        Level
                                    </label>
                                    <select v-model="form.level" class="form-input-modern">
                                        <option value="">Select Level</option>
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="advanced">Advanced</option>
                                    </select>
                                </div>

                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Status
                                    </label>
                                    <select v-model="form.status" class="form-input-modern">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <!-- What You Will Learn -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    What You Will Learn
                                </label>
                                <textarea 
                                    v-model="form.what_you_will_learn" 
                                    placeholder="Enter what students will learn (one per line)..."
                                    rows="3"
                                    class="form-input-modern"
                                ></textarea>
                            </div>

                            <!-- Requirements -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Requirements
                                </label>
                                <textarea 
                                    v-model="form.requirements" 
                                    placeholder="Enter course requirements (one per line)..."
                                    rows="3"
                                    class="form-input-modern"
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
                                class="px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 text-white rounded-xl hover:from-indigo-600 hover:via-purple-600 hover:to-indigo-600 transition font-medium shadow-lg shadow-indigo-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95 w-full sm:w-auto"
                            >
                                <span v-if="!loading" class="flex items-center space-x-2">
                                    <svg v-if="modalMode === 'add'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ modalMode === 'add' ? 'Create Course' : 'Update Course' }}</span>
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
        <div v-if="showViewModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center z-[9999] p-3 sm:p-4 overflow-y-auto" @click.self="closeViewModal">
            <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl shadow-2xl w-full max-w-2xl border border-indigo-100 transform transition-all flex flex-col max-h-[calc(100vh-2rem)] lg:max-h-[90vh] mx-auto">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 rounded-t-2xl p-4 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 flex-1 min-w-0">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg sm:text-2xl font-bold text-white truncate">Course Details</h3>
                                <p class="text-indigo-100 text-xs sm:text-sm mt-0.5 hidden sm:block">View complete course information</p>
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
                <div v-if="viewCourseData" class="p-4 sm:p-6 space-y-6 overflow-y-auto flex-1">
                    <!-- Thumbnail -->
                    <div v-if="viewCourseData.thumbnail" class="rounded-xl overflow-hidden">
                        <img :src="`/storage/${viewCourseData.thumbnail}`" :alt="viewCourseData.name" class="w-full h-64 object-cover">
                    </div>

                    <!-- Course Info -->
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-2xl font-bold text-gray-900 mb-2">{{ viewCourseData.name }}</h4>
                            <div class="flex items-center gap-2 mb-3">
                                <span 
                                    :class="viewCourseData.status === 'active' 
                                        ? 'bg-gradient-to-r from-green-400 to-emerald-400 text-white' 
                                        : 'bg-gradient-to-r from-gray-400 to-gray-500 text-white'"
                                    class="px-3 py-1 rounded-full text-xs font-medium shadow-sm"
                                >
                                    {{ viewCourseData.status === 'active' ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="bg-gradient-to-r from-indigo-400 to-purple-400 text-white px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                                    {{ viewCourseData.level || 'N/A' }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white rounded-xl p-4 border border-gray-200">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Price</div>
                                <div class="text-xl font-bold text-indigo-600">₹{{ viewCourseData.price || 0 }}</div>
                            </div>
                            <div class="bg-white rounded-xl p-4 border border-gray-200">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Duration</div>
                                <div class="text-xl font-bold text-gray-900">{{ viewCourseData.duration_hours || 'N/A' }} hrs</div>
                            </div>
                        </div>

                        <div v-if="viewCourseData.description" class="bg-white rounded-xl p-4 border border-gray-200">
                            <div class="text-sm font-semibold text-gray-700 mb-2">Description</div>
                            <p class="text-gray-600">{{ viewCourseData.description }}</p>
                        </div>

                        <div v-if="viewCourseData.what_you_will_learn" class="bg-white rounded-xl p-4 border border-gray-200">
                            <div class="text-sm font-semibold text-gray-700 mb-2">What You Will Learn</div>
                            <p class="text-gray-600 whitespace-pre-line">{{ viewCourseData.what_you_will_learn }}</p>
                        </div>

                        <div v-if="viewCourseData.requirements" class="bg-white rounded-xl p-4 border border-gray-200">
                            <div class="text-sm font-semibold text-gray-700 mb-2">Requirements</div>
                            <p class="text-gray-600 whitespace-pre-line">{{ viewCourseData.requirements }}</p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end space-x-3 p-4 sm:p-6 pt-0 border-t border-gray-200">
                    <button 
                        @click="closeViewModal"
                        class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 text-white rounded-xl hover:from-indigo-600 hover:via-purple-600 hover:to-indigo-600 transition font-medium shadow-lg shadow-indigo-500/30 transform hover:scale-105 active:scale-95 flex items-center space-x-2"
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
    name: 'Courses',
    setup() {
        const courses = ref([]);
        const showModal = ref(false);
        const showViewModal = ref(false);
        const modalMode = ref('add');
        const loading = ref(false);
        const error = ref('');
        const successMessage = ref('');
        const currentCourseId = ref(null);
        const viewCourseData = ref(null);

        const filters = ref({
            search: '',
            status: '',
            sortBy: 'created_at'
        });

        const stats = ref({
            totalCourses: 0,
            activeCourses: 0,
            inactiveCourses: 0
        });

        const form = ref({
            name: '',
            description: '',
            thumbnail: null,
            thumbnailPreview: null,
            price: 0,
            status: 'active',
            duration_hours: null,
            level: '',
            what_you_will_learn: '',
            requirements: ''
        });

        // Computed filtered courses
        const filteredCourses = computed(() => {
            let filtered = [...courses.value];

            // Search filter
            if (filters.value.search) {
                const searchTerm = filters.value.search.toLowerCase();
                filtered = filtered.filter(course => 
                    course.name.toLowerCase().includes(searchTerm) ||
                    (course.description && course.description.toLowerCase().includes(searchTerm))
                );
            }

            // Status filter
            if (filters.value.status) {
                filtered = filtered.filter(course => course.status === filters.value.status);
            }

            // Sort
            filtered.sort((a, b) => {
                if (filters.value.sortBy === 'name') {
                    return a.name.localeCompare(b.name);
                } else if (filters.value.sortBy === 'price') {
                    return (a.price || 0) - (b.price || 0);
                } else {
                    return new Date(b.created_at) - new Date(a.created_at);
                }
            });

            return filtered;
        });

        // Update stats
        const updateStats = () => {
            stats.value = {
                totalCourses: courses.value.length,
                activeCourses: courses.value.filter(c => c.status === 'active').length,
                inactiveCourses: courses.value.filter(c => c.status === 'inactive').length
            };
        };

        const fetchCourses = async () => {
            try {
                const response = await axios.get('/api/courses');
                if (response.data.success) {
                    courses.value = response.data.courses;
                    updateStats();
                }
            } catch (err) {
                console.error('Error fetching courses:', err);
                error.value = 'Failed to fetch courses';
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
                description: '',
                thumbnail: null,
                thumbnailPreview: null,
                price: 0,
                status: 'active',
                duration_hours: null,
                level: '',
                what_you_will_learn: '',
                requirements: ''
            };
            error.value = '';
            successMessage.value = '';
            showModal.value = true;
        };

        const editCourse = async (id) => {
            try {
                const response = await axios.get(`/api/courses/${id}`);
                if (response.data.success) {
                    const course = response.data.course;
                    form.value = {
                        name: course.name,
                        description: course.description || '',
                        thumbnail: null,
                        thumbnailPreview: course.thumbnail ? `/storage/${course.thumbnail}` : null,
                        price: course.price || 0,
                        status: course.status || 'active',
                        duration_hours: course.duration_hours,
                        level: course.level || '',
                        what_you_will_learn: course.what_you_will_learn || '',
                        requirements: course.requirements || ''
                    };
                    modalMode.value = 'edit';
                    currentCourseId.value = id;
                    error.value = '';
                    successMessage.value = '';
                    showModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching course:', err);
                error.value = err.response?.data?.message || 'Failed to fetch course details';
            }
        };

        const viewCourse = async (id) => {
            try {
                const response = await axios.get(`/api/courses/${id}`);
                if (response.data.success) {
                    viewCourseData.value = response.data.course;
                    showViewModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching course:', err);
                error.value = err.response?.data?.message || 'Failed to fetch course details';
            }
        };

        const handleThumbnailChange = (event) => {
            const file = event.target.files[0];
            if (file) {
                form.value.thumbnail = file;
                const reader = new FileReader();
                reader.onload = (e) => {
                    form.value.thumbnailPreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const saveCourse = async () => {
            loading.value = true;
            error.value = '';
            successMessage.value = '';

            try {
                const formData = new FormData();
                formData.append('name', form.value.name);
                formData.append('description', form.value.description || '');
                formData.append('price', form.value.price || 0);
                formData.append('status', form.value.status);
                formData.append('duration_hours', form.value.duration_hours || '');
                formData.append('level', form.value.level || '');
                formData.append('what_you_will_learn', form.value.what_you_will_learn || '');
                formData.append('requirements', form.value.requirements || '');

                if (form.value.thumbnail) {
                    formData.append('thumbnail', form.value.thumbnail);
                }

                let response;
                if (modalMode.value === 'add') {
                    response = await axios.post('/api/courses', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                } else {
                    response = await axios.put(`/api/courses/${currentCourseId.value}`, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                }

                if (response.data.success) {
                    successMessage.value = response.data.message;
                    await fetchCourses();
                    setTimeout(() => {
                        closeModal();
                    }, 1500);
                }
            } catch (err) {
                if (err.response?.data?.errors) {
                    const errors = err.response.data.errors;
                    error.value = Object.values(errors).flat().join(', ');
                } else {
                    error.value = err.response?.data?.message || 'Failed to save course';
                }
            } finally {
                loading.value = false;
            }
        };

        const toggleCourseStatus = async (id) => {
            try {
                const response = await axios.put(`/api/courses/${id}/toggle-status`);
                if (response.data.success) {
                    await fetchCourses();
                } else {
                    alert(response.data.message || 'Failed to update course status');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to update course status');
            }
        };

        const deleteCourse = async (id) => {
            if (!confirm('Are you sure you want to delete this course?')) {
                return;
            }

            try {
                const response = await axios.delete(`/api/courses/${id}`);
                if (response.data.success) {
                    await fetchCourses();
                } else {
                    alert(response.data.message || 'Failed to delete course');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to delete course');
            }
        };

        const closeModal = () => {
            showModal.value = false;
            form.value = {
                name: '',
                description: '',
                thumbnail: null,
                thumbnailPreview: null,
                price: 0,
                status: 'active',
                duration_hours: null,
                level: '',
                what_you_will_learn: '',
                requirements: ''
            };
            error.value = '';
            successMessage.value = '';
            currentCourseId.value = null;
        };

        const closeViewModal = () => {
            showViewModal.value = false;
            viewCourseData.value = null;
        };

        const formatCurrency = (amount) => {
            if (amount >= 1000000) {
                return (amount / 1000000).toFixed(2) + 'M';
            } else if (amount >= 1000) {
                return (amount / 1000).toFixed(1) + 'K';
            }
            return amount.toString();
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
            fetchCourses();
            window.addEventListener('keydown', handleEscKey);
        });

        onUnmounted(() => {
            window.removeEventListener('keydown', handleEscKey);
        });

        return {
            courses,
            filteredCourses,
            stats,
            filters,
            showModal,
            showViewModal,
            modalMode,
            loading,
            error,
            successMessage,
            form,
            viewCourseData,
            openAddModal,
            editCourse,
            viewCourse,
            saveCourse,
            toggleCourseStatus,
            deleteCourse,
            handleThumbnailChange,
            closeModal,
            closeViewModal,
            clearFilters,
            formatCurrency
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

.form-hint-text {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 0.375rem;
    padding-left: 0.25rem;
}

.course-card {
    transition: all 0.3s ease;
}

.course-card:hover {
    transform: translateY(-8px);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Modal positioning fixes - ensure it's centered and doesn't overflow */
.fixed.inset-0 {
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}

@media (min-width: 1024px) {
    .fixed.inset-0 {
        left: 260px; /* Account for sidebar width on desktop */
    }
}

/* Ensure modal content doesn't overflow viewport */
.fixed.inset-0 > div {
    max-width: min(100vw - 2rem, 42rem);
}

@media (min-width: 1024px) {
    .fixed.inset-0 > div {
        max-width: min(calc(100vw - 260px - 2rem), 42rem);
    }
}
</style>
