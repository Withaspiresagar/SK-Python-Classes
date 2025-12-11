<template>
    <div class="w-full overflow-hidden space-y-6">
        <!-- Stats Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="stat-card bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-indigo-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.totalQueries }}</div>
                        <div class="text-indigo-100 text-sm sm:text-base font-medium">Total Queries</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-blue-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.pending }}</div>
                        <div class="text-blue-100 text-sm sm:text-base font-medium">Pending</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.resolved }}</div>
                        <div class="text-green-100 text-sm sm:text-base font-medium">Resolved</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-orange-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.newToday }}</div>
                        <div class="text-orange-100 text-sm sm:text-base font-medium">New Today</div>
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
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Query/Inquiry Management</h2>
                    <p class="text-gray-600 text-sm">Manage all queries and inquiries from students</p>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <!-- Search Input -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Queries</label>
                    <div class="relative">
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Search by name, email, or subject..."
                            class="w-full px-4 py-2.5 pl-11 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white"
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
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white"
                    >
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="name">Name (A-Z)</option>
                    </select>
                </div>
            </div>

            <!-- Quick Filter Buttons -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button
                    @click="filters.status = ''"
                    :class="filters.status === '' 
                        ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    All Queries
                </button>
                <button
                    @click="filters.status = 'pending'"
                    :class="filters.status === 'pending' 
                        ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Pending
                </button>
                <button
                    @click="filters.status = 'resolved'"
                    :class="filters.status === 'resolved' 
                        ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Resolved
                </button>
            </div>
        </div>

        <!-- Queries Table Section -->
        <div class="bg-gradient-to-br from-white via-indigo-50/20 to-purple-50/20 rounded-2xl shadow-xl p-4 sm:p-6 border-2 border-indigo-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-indigo-100/30 to-purple-100/30 rounded-full -mr-32 -mt-32"></div>
            <div class="relative z-10">
                <!-- Desktop Table View -->
                <div class="hidden lg:block w-full overflow-hidden">
                    <div class="w-full overflow-x-auto" style="max-width: 100%;">
                        <table class="w-full table-auto min-w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500">
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Name</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Contact</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Subject</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Date</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Status</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr v-for="query in filteredQueries" :key="query.id" class="hover:bg-gradient-to-r hover:from-indigo-50/60 hover:via-purple-50/60 hover:to-indigo-50/60 transition-all duration-300 group border-b border-gray-100">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-2 min-w-[180px]">
                                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                                <span class="text-white font-bold text-sm">{{ query.name.charAt(0).toUpperCase() }}</span>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-sm font-bold text-gray-900 truncate group-hover:text-indigo-600 transition-colors">{{ query.name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="min-w-0">
                                            <div class="text-sm text-gray-900 font-medium truncate">{{ query.email }}</div>
                                            <div class="text-xs text-gray-500 truncate">{{ query.phone }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="min-w-0 max-w-[250px]">
                                            <div class="text-sm font-semibold text-gray-900 truncate" :title="query.subject">{{ query.subject }}</div>
                                            <div class="text-xs text-gray-500 truncate" :title="query.message">{{ query.message.substring(0, 50) }}...</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900 whitespace-nowrap">{{ formatDate(query.created_at) }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-md capitalize whitespace-nowrap"
                                            :class="getStatusClass(query.status)">
                                            {{ query.status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-1.5">
                                            <select 
                                                :value="query.status"
                                                @change="updateStatus(query.id, $event.target.value)"
                                                :disabled="query.status === 'resolved'"
                                                class="px-2 py-1.5 text-xs font-semibold rounded-lg border-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-1 whitespace-nowrap"
                                                :class="[
                                                    getStatusSelectClass(query.status),
                                                    query.status === 'resolved' ? 'cursor-not-allowed opacity-75' : 'cursor-pointer'
                                                ]"
                                            >
                                                <option value="pending">Pending</option>
                                                <option value="resolved">Resolved</option>
                                            </select>
                                            <button 
                                                @click="viewQuery(query.id)"
                                                class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:from-blue-600 hover:to-cyan-600 shadow-lg hover:shadow-xl transition-all transform hover:scale-110 active:scale-95 border-2 border-blue-400/30"
                                                title="View"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button 
                                                @click="deleteQuery(query.id)"
                                                class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-xl hover:from-red-600 hover:to-pink-600 shadow-lg hover:shadow-xl transition-all transform hover:scale-110 active:scale-95 border-2 border-red-400/30"
                                                title="Delete"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="filteredQueries.length === 0">
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-gray-500 text-lg font-medium">No queries found</p>
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
                <div v-for="query in filteredQueries" :key="query.id" class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
                    <div class="p-4 sm:p-5">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3 flex-1 min-w-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-lg">{{ query.name.charAt(0).toUpperCase() }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base font-bold text-gray-900 truncate">{{ query.name }}</h3>
                                    <p class="text-sm text-gray-500 mt-0.5">{{ query.email }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold shadow-sm capitalize flex-shrink-0 ml-2"
                                :class="getStatusClass(query.status)">
                                {{ query.status }}
                            </span>
                        </div>
                        <div class="mb-4 pb-4 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-700 mb-1">{{ query.subject }}</p>
                            <p class="text-xs text-gray-600 line-clamp-2">{{ query.message }}</p>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-xs text-gray-500">{{ formatDate(query.created_at) }}</div>
                            <div class="text-xs text-gray-500">{{ query.phone }}</div>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <select 
                                :value="query.status"
                                @change="updateStatus(query.id, $event.target.value)"
                                :disabled="query.status === 'resolved'"
                                class="px-3 py-2 text-xs font-semibold rounded-lg border-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-1"
                                :class="[
                                    getStatusSelectClass(query.status),
                                    query.status === 'resolved' ? 'cursor-not-allowed opacity-75' : 'cursor-pointer'
                                ]"
                            >
                                <option value="pending">Pending</option>
                                <option value="resolved">Resolved</option>
                            </select>
                            <div class="flex items-center space-x-2">
                                <button 
                                    @click="viewQuery(query.id)"
                                    class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg hover:from-blue-600 hover:to-cyan-600 shadow-sm transition transform hover:scale-110 active:scale-95"
                                    title="View"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button 
                                    @click="deleteQuery(query.id)"
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
                </div>
                <div v-if="filteredQueries.length === 0" class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-500 text-lg font-medium">No queries found</p>
                        <p class="text-gray-400 text-sm mt-1">Try adjusting your search or filters</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Query Modal -->
        <div v-if="showViewModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50 p-3 sm:p-4 overflow-y-auto" @click.self="closeViewModal" style="min-height: 100vh;">
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
                                <h3 class="text-xl sm:text-2xl font-bold text-white truncate">Query Details</h3>
                                <p class="text-indigo-100 text-xs sm:text-sm mt-0.5 hidden sm:block">View inquiry information</p>
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
                    <div v-if="viewQueryData" class="space-y-5">
                        <!-- Query Header -->
                        <div class="flex items-center space-x-4 p-5 bg-gradient-to-r from-indigo-50 via-purple-50 to-indigo-50 rounded-xl border border-indigo-100">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                                {{ viewQueryData.name.charAt(0).toUpperCase() }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xl font-bold text-gray-900 truncate">{{ viewQueryData.name }}</p>
                                <p class="text-sm text-gray-600 truncate">{{ viewQueryData.email }}</p>
                            </div>
                        </div>

                        <!-- Details Grid -->
                        <div class="grid grid-cols-1 gap-4">
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-indigo-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Phone</span>
                                </div>
                                <span class="text-gray-900 font-semibold">{{ viewQueryData.phone }}</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-indigo-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-7 4h7" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Subject</span>
                                </div>
                                <span class="text-gray-900 font-semibold">{{ viewQueryData.subject }}</span>
                            </div>

                            <div class="p-4 bg-white rounded-xl border border-gray-200">
                                <div class="flex items-center space-x-3 mb-2">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Message</span>
                                </div>
                                <p class="text-gray-700 text-sm">{{ viewQueryData.message }}</p>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-indigo-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Date</span>
                                </div>
                                <span class="text-gray-900 font-semibold text-sm">{{ formatDate(viewQueryData.created_at) }}</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:border-indigo-300 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-gray-600 font-medium">Status</span>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm capitalize"
                                    :class="getStatusClass(viewQueryData.status)">
                                    {{ viewQueryData.status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6 pt-6 border-t border-gray-200">
                        <button 
                            @click="closeViewModal"
                            class="px-4 sm:px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl hover:from-indigo-600 hover:to-purple-600 transition font-medium shadow-lg shadow-indigo-500/30 transform hover:scale-105 w-full sm:w-auto"
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
    name: 'Queries',
    setup() {
        const queries = ref([]);
        const showViewModal = ref(false);
        const viewQueryData = ref(null);

        const filters = ref({
            search: '',
            status: '',
            sortBy: 'newest'
        });

        // Computed stats
        const stats = computed(() => {
            const totalQueries = queries.value.length;
            const pending = queries.value.filter(q => q.status === 'pending').length;
            const resolved = queries.value.filter(q => q.status === 'resolved').length;
            
            // Calculate new queries today
            const today = new Date().toDateString();
            const newToday = queries.value.filter(query => {
                const queryDate = new Date(query.created_at).toDateString();
                return queryDate === today;
            }).length;

            return {
                totalQueries,
                pending,
                resolved,
                newToday
            };
        });

        // Filtered queries
        const filteredQueries = computed(() => {
            let result = [...queries.value];

            // Search filter
            if (filters.value.search) {
                const searchLower = filters.value.search.toLowerCase();
                result = result.filter(query => 
                    query.name?.toLowerCase().includes(searchLower) ||
                    query.email?.toLowerCase().includes(searchLower) ||
                    query.subject?.toLowerCase().includes(searchLower)
                );
            }

            // Status filter
            if (filters.value.status) {
                result = result.filter(query => query.status === filters.value.status);
            }

            // Sort
            result.sort((a, b) => {
                if (filters.value.sortBy === 'name') {
                    return (a.name || '').localeCompare(b.name || '');
                } else if (filters.value.sortBy === 'oldest') {
                    return new Date(a.created_at) - new Date(b.created_at);
                } else {
                    return new Date(b.created_at) - new Date(a.created_at);
                }
            });

            return result;
        });

        const fetchQueries = async () => {
            try {
                const response = await axios.get('/api/queries');
                if (response.data.success) {
                    queries.value = response.data.queries;
                }
            } catch (err) {
                console.error('Error fetching queries:', err);
            }
        };

        const viewQuery = async (id) => {
            try {
                const response = await axios.get(`/api/queries/${id}`);
                if (response.data.success) {
                    viewQueryData.value = response.data.query;
                    showViewModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching query:', err);
            }
        };

        const updateStatus = async (id, newStatus) => {
            try {
                const response = await axios.put(`/api/queries/${id}/status`, {
                    status: newStatus
                });
                if (response.data.success) {
                    // Update the query in the local array
                    const index = queries.value.findIndex(q => q.id === id);
                    if (index !== -1) {
                        queries.value[index].status = newStatus;
                    }
                } else {
                    alert(response.data.message || 'Failed to update status');
                    // Refresh queries to get correct status
                    await fetchQueries();
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to update status');
                // Refresh queries to get correct status
                await fetchQueries();
            }
        };

        const deleteQuery = async (id) => {
            if (!confirm('Are you sure you want to delete this query?')) {
                return;
            }

            try {
                const response = await axios.delete(`/api/queries/${id}`);
                if (response.data.success) {
                    await fetchQueries();
                } else {
                    alert(response.data.message || 'Failed to delete query');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to delete query');
            }
        };

        const closeViewModal = () => {
            showViewModal.value = false;
            viewQueryData.value = null;
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

        const getStatusClass = (status) => {
            const classes = {
                pending: 'bg-gradient-to-r from-blue-400 to-cyan-400 text-white',
                resolved: 'bg-gradient-to-r from-green-400 to-emerald-400 text-white'
            };
            return classes[status] || classes.pending;
        };

        const getStatusSelectClass = (status) => {
            const classes = {
                pending: 'bg-blue-50 border-blue-300 text-blue-700 hover:bg-blue-100 focus:ring-blue-500',
                resolved: 'bg-green-50 border-green-300 text-green-700 hover:bg-green-100 focus:ring-green-500'
            };
            return classes[status] || classes.pending;
        };

        // ESC key handler for closing modals
        const handleEscKey = (event) => {
            if (event.key === 'Escape') {
                if (showViewModal.value) {
                    closeViewModal();
                }
            }
        };

        onMounted(() => {
            fetchQueries();
            window.addEventListener('keydown', handleEscKey);
        });

        onUnmounted(() => {
            window.removeEventListener('keydown', handleEscKey);
        });

        return {
            queries,
            stats,
            filters,
            filteredQueries,
            showViewModal,
            viewQueryData,
            viewQuery,
            updateStatus,
            deleteQuery,
            closeViewModal,
            formatDate,
            getStatusClass,
            getStatusSelectClass
        };
    }
};
</script>

<style scoped>
/* Additional styles if needed */
</style>

