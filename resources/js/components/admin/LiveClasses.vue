<template>
    <div class="w-full overflow-hidden space-y-6">
        <!-- Stats Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="stat-card bg-gradient-to-br from-red-500 to-orange-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-red-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.totalClasses }}</div>
                        <div class="text-red-100 text-sm sm:text-base font-medium">Total Classes</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-blue-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.scheduled }}</div>
                        <div class="text-blue-100 text-sm sm:text-base font-medium">Scheduled</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.ongoing }}</div>
                        <div class="text-green-100 text-sm sm:text-base font-medium">Ongoing</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-purple-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.completed }}</div>
                        <div class="text-purple-100 text-sm sm:text-base font-medium">Completed</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                <div class="flex-1">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Live Classes</h2>
                    <p class="text-gray-600 text-sm">Schedule and manage live online classes</p>
                </div>
                <button 
                    @click="openAddModal"
                    class="bg-gradient-to-r from-red-500 to-orange-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-red-600 hover:to-orange-600 transition font-medium shadow-lg shadow-red-500/30 transform hover:scale-105 text-sm sm:text-base whitespace-nowrap flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Schedule Live Class
                </button>
            </div>
            
            <!-- Search and Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <!-- Search Input -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Classes</label>
                    <div class="relative">
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Search by class name or batch..."
                            class="w-full px-4 py-2.5 pl-11 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/50 focus:border-red-500 outline-none transition-all duration-300 bg-white"
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
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500/50 focus:border-red-500 outline-none transition-all duration-300 bg-white"
                    >
                        <option value="date_desc">Newest First</option>
                        <option value="date_asc">Oldest First</option>
                        <option value="name">Name (A-Z)</option>
                    </select>
                </div>
            </div>

            <!-- Quick Filter Buttons -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button
                    @click="filters.status = ''"
                    :class="filters.status === '' 
                        ? 'bg-gradient-to-r from-red-500 to-orange-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    All Classes
                </button>
                <button
                    @click="filters.status = 'scheduled'"
                    :class="filters.status === 'scheduled' 
                        ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Scheduled
                </button>
                <button
                    @click="filters.status = 'ongoing'"
                    :class="filters.status === 'ongoing' 
                        ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Ongoing
                </button>
                <button
                    @click="filters.status = 'completed'"
                    :class="filters.status === 'completed' 
                        ? 'bg-gradient-to-r from-purple-500 to-pink-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Completed
                </button>
                <button
                    @click="filters.status = 'cancelled'"
                    :class="filters.status === 'cancelled' 
                        ? 'bg-gradient-to-r from-gray-500 to-gray-600 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Cancelled
                </button>
            </div>
        </div>

        <!-- Live Classes Table Section -->
        <div class="bg-gradient-to-br from-white via-red-50/20 to-orange-50/20 rounded-2xl shadow-xl p-4 sm:p-6 border-2 border-red-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-red-100/30 to-orange-100/30 rounded-full -mr-32 -mt-32"></div>
            <div class="relative z-10">
                <!-- Desktop Table View -->
                <div class="hidden lg:block overflow-x-auto -mx-4 sm:mx-0 w-full">
                    <div class="inline-block w-full align-middle">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gradient-to-r from-red-500 via-orange-500 to-red-500">
                                    <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Class Name</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Batch</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Date & Time</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr v-for="liveClass in filteredLiveClasses" :key="liveClass.id" class="hover:bg-gradient-to-r hover:from-red-50/60 hover:via-orange-50/60 hover:to-red-50/60 transition-all duration-300 group border-b border-gray-100">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-gradient-to-br from-red-500 via-orange-500 to-red-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-gray-900 group-hover:text-red-600 transition-colors">{{ liveClass.class_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg flex items-center justify-center flex-shrink-0 border-2 border-indigo-200">
                                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="text-sm font-bold text-gray-900">{{ liveClass.batch?.name || 'No Batch' }}</span>
                                                <span v-if="liveClass.batch?.course" class="text-xs text-indigo-600 font-medium block mt-0.5 bg-indigo-50 px-2 py-0.5 rounded-md inline-block">{{ liveClass.batch.course.name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-lg flex items-center justify-center flex-shrink-0 border-2 border-blue-200">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-gray-900">{{ formatDate(liveClass.date) }}</div>
                                                <div class="text-xs text-blue-600 font-medium flex items-center space-x-1 mt-1 bg-blue-50 px-2 py-1 rounded-md inline-flex">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>{{ formatTime(liveClass.time) }}</span>
                                                    <span class="ml-1 text-gray-500">•</span>
                                                    <span class="text-gray-600 font-semibold">{{ liveClass.duration_minutes || 60 }} min</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold shadow-md capitalize"
                                            :class="getStatusClass(liveClass.status)">
                                            {{ liveClass.status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center space-x-2">
                                            <button 
                                                @click="viewLiveClass(liveClass.id)"
                                                class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:from-blue-600 hover:to-cyan-600 shadow-lg hover:shadow-xl transition-all transform hover:scale-110 active:scale-95 border-2 border-blue-400/30"
                                                title="View"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button 
                                                @click="editLiveClass(liveClass.id)"
                                                class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl hover:from-green-600 hover:to-emerald-600 shadow-lg hover:shadow-xl transition-all transform hover:scale-110 active:scale-95 border-2 border-green-400/30"
                                                title="Edit"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button 
                                                @click="deleteLiveClass(liveClass.id)"
                                                class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-xl hover:from-red-600 hover:to-pink-600 shadow-lg hover:shadow-xl transition-all transform hover:scale-110 active:scale-95 border-2 border-red-400/30"
                                                title="Delete"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <tr v-if="filteredLiveClasses.length === 0">
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <p class="text-gray-500 text-lg font-medium">No live classes found</p>
                                        <p class="text-gray-400 text-sm mt-1">Try adjusting your search or filters</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

            <!-- Mobile/Tablet Card View -->
            <div class="lg:hidden space-y-4">
                <div v-for="liveClass in filteredLiveClasses" :key="liveClass.id" class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
                    <div class="p-4 sm:p-5">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3 flex-1 min-w-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-orange-400 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base font-bold text-gray-900 truncate">{{ liveClass.class_name }}</h3>
                                    <p class="text-sm text-gray-500 mt-0.5 flex items-center space-x-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <span>{{ liveClass.course?.name || 'No Course' }}</span>
                                    </p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold shadow-sm capitalize flex-shrink-0 ml-2"
                                :class="getStatusClass(liveClass.status)">
                                {{ liveClass.status }}
                            </span>
                        </div>

                        <!-- Date & Time -->
                        <div class="flex items-center space-x-4 mb-4 pb-4 border-b border-gray-100">
                            <div class="flex items-center space-x-2 text-sm">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="font-semibold text-gray-700">{{ formatDate(liveClass.date) }}</span>
                            </div>
                            <div class="flex items-center space-x-2 text-sm">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium text-gray-600">{{ formatTime(liveClass.time) }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end space-x-2">
                            <button 
                                @click="viewLiveClass(liveClass.id)"
                                class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg hover:from-blue-600 hover:to-cyan-600 shadow-sm transition transform hover:scale-110 active:scale-95"
                                title="View"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            <button 
                                @click="editLiveClass(liveClass.id)"
                                class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg hover:from-green-600 hover:to-emerald-600 shadow-sm transition transform hover:scale-110 active:scale-95"
                                title="Edit"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button 
                                @click="deleteLiveClass(liveClass.id)"
                                class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-lg hover:from-red-600 hover:to-pink-600 shadow-sm transition transform hover:scale-110 active:scale-95"
                                title="Delete"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Empty State for Mobile -->
                <div v-if="filteredLiveClasses.length === 0" class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <p class="text-gray-500 text-lg font-medium">No live classes found</p>
                        <p class="text-gray-400 text-sm mt-1">Try adjusting your search or filters</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-start justify-center z-[9999] overflow-y-auto pt-16 sm:pt-20 pb-4 sm:pb-8 px-3 sm:px-4" @click.self="closeModal" style="top: 0; left: 0; right: 0; bottom: 0;">
            <div class="bg-gradient-to-br from-white via-red-50/30 to-orange-50/30 rounded-2xl shadow-2xl w-full max-w-lg border border-red-100 transform transition-all my-auto max-w-[calc(100vw-1.5rem)] flex flex-col max-h-[calc(100vh-5rem)]">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-red-500 via-orange-500 to-red-500 rounded-t-2xl p-4 sm:p-6">
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
                                    {{ modalMode === 'add' ? 'Schedule Live Class' : 'Edit Live Class' }}
                                </h3>
                                <p class="text-red-100 text-xs sm:text-sm mt-0.5 hidden sm:block">
                                    {{ modalMode === 'add' ? 'Create a new live class session' : 'Update live class information' }}
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
                <div class="p-4 sm:p-6 overflow-y-auto flex-1">
                    <form @submit.prevent="saveLiveClass">
                        <div class="space-y-5">
                            <!-- Class Name Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-7 4h7" />
                                    </svg>
                                    Class Name
                                </label>
                                <input 
                                    type="text" 
                                    v-model="form.class_name" 
                                    placeholder="Enter class name"
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Batch Selection -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Batch <span class="text-red-500">*</span>
                                </label>
                                <select 
                                    v-model="form.batch_id" 
                                    class="form-input-modern"
                                    required
                                >
                                    <option value="">Select a batch</option>
                                    <option v-for="batch in batches" :key="batch.id" :value="batch.id">
                                        {{ batch.name }} {{ batch.course ? `(${batch.course.name})` : '' }}
                                    </option>
                                </select>
                                <p class="form-hint-text">Select the batch for this live class. All students in this batch will see this class.</p>
                            </div>

                            <!-- Date Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Date
                                </label>
                                <input 
                                    type="date" 
                                    v-model="form.date" 
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Time Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Start Time
                                </label>
                                <input 
                                    type="time" 
                                    v-model="form.time" 
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Duration Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Duration (Minutes) <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    v-model="form.duration_minutes" 
                                    placeholder="e.g., 60 for 1 hour"
                                    class="form-input-modern"
                                    min="1"
                                    max="480"
                                    required
                                >
                                <p class="form-hint-text">Enter duration in minutes (e.g., 60 for 1 hour, 90 for 1.5 hours)</p>
                            </div>

                            <!-- Meeting Link Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    Meeting Link
                                </label>
                                <input 
                                    type="url" 
                                    v-model="form.meeting_link" 
                                    placeholder="https://meet.google.com/xxx-xxxx-xxx"
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <!-- Status Field (Read-only, auto-managed) -->
                            <div class="form-field-group" v-if="modalMode === 'edit'">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Status
                                </label>
                                <select 
                                    v-model="form.status" 
                                    class="form-input-modern"
                                    :disabled="form.status !== 'cancelled'"
                                >
                                    <option value="scheduled">Scheduled</option>
                                    <option value="ongoing">Ongoing</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                <p class="form-hint-text" v-if="form.status !== 'cancelled'">Status is automatically managed based on time. Only cancelled status can be set manually.</p>
                            </div>

                            <!-- Description Field -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                                    </svg>
                                    Description (Optional)
                                </label>
                                <textarea 
                                    v-model="form.description" 
                                    rows="3"
                                    placeholder="Enter class description..."
                                    class="form-input-modern resize-vertical"
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
                                class="px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-red-500 via-orange-500 to-red-500 text-white rounded-xl hover:from-red-600 hover:via-orange-600 hover:to-red-600 transition font-medium shadow-lg shadow-red-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95 w-full sm:w-auto"
                            >
                                <span v-if="!loading" class="flex items-center space-x-2">
                                    <svg v-if="modalMode === 'add'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ modalMode === 'add' ? 'Schedule Class' : 'Update Class' }}</span>
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
        <div v-if="showViewModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-start justify-center z-[9999] overflow-y-auto pt-16 sm:pt-20 pb-4 sm:pb-8 px-3 sm:px-4" @click.self="closeViewModal" style="top: 0; left: 0; right: 0; bottom: 0;">
            <div class="bg-gradient-to-br from-white via-blue-50/30 to-cyan-50/30 rounded-2xl shadow-2xl w-full max-w-lg border border-blue-100 transform transition-all my-auto max-w-[calc(100vw-1.5rem)] flex flex-col max-h-[calc(100vh-5rem)]">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-blue-500 via-cyan-500 to-blue-500 rounded-t-2xl p-4 sm:p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 flex-1 min-w-0">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-xl sm:text-2xl font-bold text-white truncate">Live Class Details</h3>
                                <p class="text-blue-100 text-xs sm:text-sm mt-0.5 hidden sm:block">View live class information</p>
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
                <div class="p-4 sm:p-6 overflow-y-auto flex-1">
                    <div v-if="viewLiveClassData" class="space-y-5">
                        <!-- Class Header -->
                        <div class="flex items-center space-x-4 p-5 bg-gradient-to-r from-blue-50 via-cyan-50 to-blue-50 rounded-xl border border-blue-100">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                                {{ viewLiveClassData.class_name.charAt(0).toUpperCase() }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xl font-bold text-gray-900 truncate">{{ viewLiveClassData.class_name }}</p>
                                <p class="text-sm text-gray-600 truncate">{{ viewLiveClassData.batch?.name || 'No Batch' }}</p>
                                <p v-if="viewLiveClassData.batch?.course" class="text-xs text-gray-500 truncate">{{ viewLiveClassData.batch.course.name }}</p>
                            </div>
                        </div>

                        <!-- Details Grid -->
                        <div class="grid grid-cols-1 gap-4">
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-red-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-7 4h7" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Class Name</span>
                                </div>
                                <span class="text-gray-900 font-bold">{{ viewLiveClassData.class_name }}</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-red-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Batch</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-gray-900 font-semibold block">{{ viewLiveClassData.batch?.name || 'No Batch' }}</span>
                                    <span v-if="viewLiveClassData.batch?.course" class="text-xs text-gray-500">{{ viewLiveClassData.batch.course.name }}</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-red-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Date</span>
                                </div>
                                <span class="text-gray-900 font-semibold text-sm">{{ formatDate(viewLiveClassData.date) }}</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-red-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Start Time</span>
                                </div>
                                <span class="text-gray-900 font-semibold text-sm">{{ formatTime(viewLiveClassData.time) }}</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-red-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Duration</span>
                                </div>
                                <span class="text-gray-900 font-semibold text-sm">{{ viewLiveClassData.duration_minutes || 60 }} minutes</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-red-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Meeting Link</span>
                                </div>
                                <a :href="viewLiveClassData.meeting_link" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold text-sm truncate max-w-xs">
                                    Open Link
                                </a>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-red-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Status</span>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm"
                                    :class="getStatusClass(viewLiveClassData.status)">
                                    {{ viewLiveClassData.status }}
                                </span>
                            </div>

                            <div v-if="viewLiveClassData.description" class="p-4 bg-white rounded-xl border border-gray-200">
                                <div class="flex items-center space-x-3 mb-2">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Description</span>
                                </div>
                                <p class="text-gray-700 text-sm">{{ viewLiveClassData.description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6 pt-6 border-t border-gray-200 flex-shrink-0">
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
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import axios from 'axios';

export default {
    name: 'LiveClasses',
    setup() {
        const liveClasses = ref([]);
        const batches = ref([]);
        const showModal = ref(false);
        const showViewModal = ref(false);
        const modalMode = ref('add'); // 'add' or 'edit'
        const loading = ref(false);
        const error = ref('');
        const currentLiveClassId = ref(null);
        const viewLiveClassData = ref(null);

        const filters = ref({
            search: '',
            status: '',
            sortBy: 'date_desc'
        });

        const form = ref({
            class_name: '',
            date: '',
            time: '',
            duration_minutes: 60,
            meeting_link: '',
            batch_id: '',
            status: 'scheduled',
            description: ''
        });

        // Computed stats
        const stats = computed(() => {
            const totalClasses = liveClasses.value.length;
            const scheduled = liveClasses.value.filter(lc => lc.status === 'scheduled').length;
            const ongoing = liveClasses.value.filter(lc => lc.status === 'ongoing').length;
            const completed = liveClasses.value.filter(lc => lc.status === 'completed').length;

            return {
                totalClasses,
                scheduled,
                ongoing,
                completed
            };
        });

        // Filtered live classes
        const filteredLiveClasses = computed(() => {
            let result = [...liveClasses.value];

            // Search filter
            if (filters.value.search) {
                const searchLower = filters.value.search.toLowerCase();
                result = result.filter(liveClass => 
                    liveClass.class_name.toLowerCase().includes(searchLower) ||
                    (liveClass.batch?.name && liveClass.batch.name.toLowerCase().includes(searchLower)) ||
                    (liveClass.batch?.course?.name && liveClass.batch.course.name.toLowerCase().includes(searchLower))
                );
            }

            // Status filter
            if (filters.value.status) {
                result = result.filter(liveClass => liveClass.status === filters.value.status);
            }

            // Sort
            result.sort((a, b) => {
                if (filters.value.sortBy === 'name') {
                    return a.class_name.localeCompare(b.class_name);
                } else if (filters.value.sortBy === 'date_asc') {
                    const dateA = new Date(a.date + ' ' + a.time);
                    const dateB = new Date(b.date + ' ' + b.time);
                    return dateA - dateB;
                } else {
                    const dateA = new Date(a.date + ' ' + a.time);
                    const dateB = new Date(b.date + ' ' + b.time);
                    return dateB - dateA;
                }
            });

            return result;
        });

        const fetchBatches = async () => {
            try {
                const response = await axios.get('/api/live-classes/active-batches');
                if (response.data.success) {
                    batches.value = response.data.batches;
                }
            } catch (err) {
                console.error('Error fetching batches:', err);
            }
        };

        const fetchLiveClasses = async () => {
            try {
                const response = await axios.get('/api/live-classes');
                if (response.data.success) {
                    liveClasses.value = response.data.live_classes;
                }
            } catch (err) {
                console.error('Error fetching live classes:', err);
                error.value = 'Failed to fetch live classes';
            }
        };

        const openAddModal = () => {
            modalMode.value = 'add';
            form.value = {
                class_name: '',
                date: '',
                time: '',
                duration_minutes: 60,
                meeting_link: '',
                batch_id: '',
                status: 'scheduled',
                description: ''
            };
            error.value = '';
            showModal.value = true;
        };

        const editLiveClass = async (id) => {
            try {
                const response = await axios.get(`/api/live-classes/${id}`);
                if (response.data.success) {
                    const liveClass = response.data.live_class;
                    form.value = {
                        class_name: liveClass.class_name,
                        date: liveClass.date ? liveClass.date.split('T')[0] : '',
                        time: liveClass.time ? liveClass.time.substring(0, 5) : '',
                        duration_minutes: liveClass.duration_minutes || 60,
                        meeting_link: liveClass.meeting_link,
                        batch_id: liveClass.batch_id || '',
                        status: liveClass.status,
                        description: liveClass.description || ''
                    };
                    modalMode.value = 'edit';
                    currentLiveClassId.value = id;
                    error.value = '';
                    showModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching live class:', err);
                error.value = err.response?.data?.message || 'Failed to fetch live class details';
            }
        };

        const viewLiveClass = async (id) => {
            try {
                const response = await axios.get(`/api/live-classes/${id}`);
                if (response.data.success) {
                    viewLiveClassData.value = response.data.live_class;
                    showViewModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching live class:', err);
                error.value = err.response?.data?.message || 'Failed to fetch live class details';
            }
        };

        const saveLiveClass = async () => {
            loading.value = true;
            error.value = '';

            try {
                const formData = {
                    ...form.value,
                    batch_id: form.value.batch_id || null
                };

                if (modalMode.value === 'add') {
                    const response = await axios.post('/api/live-classes', formData);
                    if (response.data.success) {
                        await fetchLiveClasses();
                        closeModal();
                    }
                } else {
                    const response = await axios.put(`/api/live-classes/${currentLiveClassId.value}`, formData);
                    if (response.data.success) {
                        await fetchLiveClasses();
                        closeModal();
                    }
                }
            } catch (err) {
                if (err.response?.data?.errors) {
                    const errors = err.response.data.errors;
                    error.value = Object.values(errors).flat().join(', ');
                } else {
                    error.value = err.response?.data?.message || 'Failed to save live class';
                }
            } finally {
                loading.value = false;
            }
        };

        const deleteLiveClass = async (id) => {
            if (!confirm('Are you sure you want to delete this live class?')) {
                return;
            }

            try {
                const response = await axios.delete(`/api/live-classes/${id}`);
                if (response.data.success) {
                    await fetchLiveClasses();
                } else {
                    alert(response.data.message || 'Failed to delete live class');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to delete live class');
            }
        };

        const closeModal = () => {
            showModal.value = false;
            form.value = {
                class_name: '',
                date: '',
                time: '',
                meeting_link: '',
                course_id: '',
                status: 'scheduled',
                description: ''
            };
            error.value = '';
            currentLiveClassId.value = null;
        };

        const closeViewModal = () => {
            showViewModal.value = false;
            viewLiveClassData.value = null;
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

        const formatTime = (timeString) => {
            if (!timeString) return '';
            // Handle both time format (HH:mm) and datetime format
            const time = timeString.includes('T') ? timeString.split('T')[1] : timeString;
            const [hours, minutes] = time.split(':');
            const hour12 = hours % 12 || 12;
            const ampm = hours >= 12 ? 'PM' : 'AM';
            return `${hour12}:${minutes} ${ampm}`;
        };

        const getStatusClass = (status) => {
            const classes = {
                scheduled: 'bg-gradient-to-r from-blue-400 to-cyan-400 text-white',
                ongoing: 'bg-gradient-to-r from-green-400 to-emerald-400 text-white',
                completed: 'bg-gradient-to-r from-purple-400 to-pink-400 text-white',
                cancelled: 'bg-gradient-to-r from-gray-400 to-gray-500 text-white'
            };
            return classes[status] || classes.scheduled;
        };

        let refreshInterval = null;

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
            fetchLiveClasses();
            fetchBatches();
            
            // Auto-refresh status every 10 seconds to update ongoing/completed status
            refreshInterval = setInterval(() => {
                fetchLiveClasses();
            }, 10000); // 10 seconds for faster status updates
            
            window.addEventListener('keydown', handleEscKey);
        });

        onUnmounted(() => {
            if (refreshInterval) {
                clearInterval(refreshInterval);
            }
            window.removeEventListener('keydown', handleEscKey);
        });

        return {
            liveClasses,
            batches,
            stats,
            filters,
            filteredLiveClasses,
            showModal,
            showViewModal,
            modalMode,
            loading,
            error,
            form,
            viewLiveClassData,
            openAddModal,
            editLiveClass,
            viewLiveClass,
            saveLiveClass,
            deleteLiveClass,
            closeModal,
            closeViewModal,
            formatDate,
            formatTime,
            getStatusClass
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
    border-color: #ef4444;
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    background: #ffffff;
}

.form-input-modern::placeholder {
    color: #9ca3af;
}

select.form-input-modern {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
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
