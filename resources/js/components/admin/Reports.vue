<template>
    <div class="w-full overflow-hidden space-y-6">
        <!-- Header Section -->
        <div class="bg-gradient-to-br from-white via-violet-50/30 to-purple-50/30 rounded-2xl shadow-xl p-4 sm:p-6 border border-violet-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-violet-500 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg shadow-violet-500/30">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Reports & Analytics</h2>
                        <p class="text-gray-600 text-sm sm:text-base mt-1">Comprehensive insights and statistics</p>
                    </div>
                </div>
                
                <!-- Export Options -->
                <div class="flex flex-wrap gap-2">
                    <button 
                        @click="exportReport('pdf')"
                        class="flex items-center space-x-2 bg-gradient-to-r from-red-500 to-pink-500 text-white px-4 py-2.5 rounded-xl hover:from-red-600 hover:to-pink-600 transition font-medium shadow-lg shadow-red-500/30 transform hover:scale-105 text-sm"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>PDF</span>
                    </button>
                    <button 
                        @click="exportReport('excel')"
                        class="flex items-center space-x-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2.5 rounded-xl hover:from-green-600 hover:to-emerald-600 transition font-medium shadow-lg shadow-green-500/30 transform hover:scale-105 text-sm"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span>Excel</span>
                    </button>
                    <button 
                        @click="exportReport('csv')"
                        class="flex items-center space-x-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 py-2.5 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition font-medium shadow-lg shadow-blue-500/30 transform hover:scale-105 text-sm"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>CSV</span>
                    </button>
                </div>
            </div>

            <!-- Time Period Filter -->
            <div class="mt-6 flex flex-wrap gap-2">
                <button
                    v-for="period in timePeriods"
                    :key="period.value"
                    @click="selectedPeriod = period.value"
                    :class="selectedPeriod === period.value 
                        ? 'bg-gradient-to-r from-violet-500 to-purple-500 text-white shadow-lg shadow-violet-500/30' 
                        : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition transform hover:scale-105"
                >
                    {{ period.label }}
                </button>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="flex justify-center items-center py-20">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-violet-600"></div>
        </div>

        <!-- Overview Stats Cards -->
        <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Total Students -->
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
                <div class="flex items-center text-sm">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>+{{ stats.newStudentsThisMonth }} this month</span>
                </div>
            </div>

            <!-- Total Courses -->
            <div class="stat-card bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-purple-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.totalCourses }}</div>
                        <div class="text-purple-100 text-sm sm:text-base font-medium">Total Courses</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <span>{{ stats.activeCourses }} active courses</span>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="stat-card bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">₹{{ formatCurrency(stats.totalRevenue) }}</div>
                        <div class="text-green-100 text-sm sm:text-base font-medium">Total Revenue</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>+₹{{ formatCurrency(stats.revenueThisMonth) }} this month</span>
                </div>
            </div>

            <!-- Total Enrollments -->
            <div class="stat-card bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-orange-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.totalEnrollments }}</div>
                        <div class="text-orange-100 text-sm sm:text-base font-medium">Total Enrollments</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <span>{{ stats.enrollmentsThisMonth }} this month</span>
                </div>
            </div>
        </div>

        <!-- Quick Stats Grid -->
        <div v-if="!loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Completion Rate -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-6 border border-gray-100 hover:shadow-2xl transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Completion Rate</h3>
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-4xl font-bold text-indigo-600 mb-2">{{ stats.completionRate }}%</div>
                <div class="w-full bg-gray-200 rounded-full h-3 mb-3">
                    <div 
                        class="bg-gradient-to-r from-indigo-500 to-purple-500 h-3 rounded-full transition-all duration-500"
                        :style="{ width: stats.completionRate + '%' }"
                    ></div>
                </div>
                <p class="text-sm text-gray-600">Average course completion rate</p>
            </div>

            <!-- Average Rating -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-6 border border-gray-100 hover:shadow-2xl transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Average Rating</h3>
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center space-x-2 mb-2">
                    <div class="text-4xl font-bold text-yellow-600">{{ stats.averageRating }}</div>
                    <div class="flex space-x-1">
                        <svg v-for="i in 5" :key="i" 
                            class="w-6 h-6"
                            :class="i <= Math.round(stats.averageRating) ? 'text-yellow-500' : 'text-gray-300'"
                            fill="currentColor" 
                            viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-gray-600">Based on {{ stats.totalReviews }} reviews</p>
            </div>

            <!-- Active Users -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-6 border border-gray-100 hover:shadow-2xl transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Active Users</h3>
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-4xl font-bold text-green-600 mb-2">{{ stats.activeUsers }}</div>
                <div class="flex items-center text-sm text-gray-600 mb-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                    <span>Currently online</span>
                </div>
                <p class="text-sm text-gray-600">{{ stats.activeUsersToday }} active today</p>
            </div>
        </div>

        <!-- Top Performing Courses -->
        <div v-if="!loading" class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-violet-500 to-purple-500 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Top Performing Courses</h3>
                        <p class="text-sm text-gray-600">Based on enrollments and ratings</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div v-for="(course, index) in topCourses" :key="course.id" 
                    class="flex items-center space-x-4 p-4 bg-white rounded-xl border border-gray-200 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center text-white font-bold text-xl flex-shrink-0">
                        #{{ index + 1 }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-gray-800 mb-1 truncate">{{ course.name }}</h4>
                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span>{{ course.enrollments }} enrolled</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span>{{ course.rating }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <div class="text-lg font-bold text-green-600">₹{{ formatCurrency(course.revenue) }}</div>
                        <div class="text-xs text-gray-500">Revenue</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Analytics -->
        <div v-if="!loading" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Monthly Revenue Trend -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Monthly Revenue Trend</h3>
                            <p class="text-sm text-gray-600">Last 6 months</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <div v-for="month in revenueByMonth" :key="month.month" class="space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="font-medium text-gray-700">{{ month.month }}</span>
                            <span class="font-bold text-green-600">₹{{ formatCurrency(month.amount) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div 
                                class="bg-gradient-to-r from-green-500 to-emerald-500 h-2.5 rounded-full transition-all duration-500"
                                :style="{ width: (month.amount / Math.max(...revenueByMonth.map(m => m.amount)) * 100) + '%' }"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Growth Trend -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-6 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Student Growth</h3>
                            <p class="text-sm text-gray-600">Last 6 months</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <div v-for="month in studentsByMonth" :key="month.month" class="space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="font-medium text-gray-700">{{ month.month }}</span>
                            <span class="font-bold text-blue-600">{{ month.count }} students</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div 
                                class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2.5 rounded-full transition-all duration-500"
                                :style="{ width: (month.count / Math.max(...studentsByMonth.map(m => m.count)) * 100) + '%' }"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div v-if="!loading" class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Recent Activities</h3>
                        <p class="text-sm text-gray-600">Latest system activities</p>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <div v-for="activity in recentActivities" :key="activity.id" 
                    class="flex items-start space-x-4 p-4 bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all">
                    <div 
                        :class="getActivityIconBg(activity.type)"
                        class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0"
                    >
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path v-if="activity.type === 'enrollment'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            <path v-else-if="activity.type === 'course'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            <path v-else-if="activity.type === 'payment'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-800 font-medium">{{ activity.title }}</p>
                        <p class="text-xs text-gray-600 mt-1">{{ activity.description }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ activity.time }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

export default {
    name: 'Reports',
    setup() {
        const selectedPeriod = ref('month');
        
        const timePeriods = [
            { label: 'Today', value: 'today' },
            { label: 'This Week', value: 'week' },
            { label: 'This Month', value: 'month' },
            { label: 'This Year', value: 'year' },
            { label: 'All Time', value: 'all' }
        ];

        const stats = ref({
            totalStudents: 0,
            newStudentsThisMonth: 0,
            totalCourses: 0,
            activeCourses: 0,
            totalRevenue: 0,
            revenueThisMonth: 0,
            totalEnrollments: 0,
            enrollmentsThisMonth: 0,
            completionRate: 0,
            averageRating: 0,
            totalReviews: 0,
            activeUsers: 0,
            activeUsersToday: 0
        });

        const topCourses = ref([]);
        const revenueByMonth = ref([]);
        const studentsByMonth = ref([]);
        const recentActivities = ref([]);
        const loading = ref(true);

        const formatCurrency = (amount) => {
            if (amount >= 1000000) {
                return (amount / 1000000).toFixed(2) + 'M';
            } else if (amount >= 100000) {
                return (amount / 100000).toFixed(1) + 'L';
            } else if (amount >= 1000) {
                return (amount / 1000).toFixed(1) + 'K';
            }
            return amount.toString();
        };

        const getActivityIconBg = (type) => {
            const types = {
                'enrollment': 'bg-gradient-to-br from-blue-500 to-cyan-500',
                'course': 'bg-gradient-to-br from-purple-500 to-pink-500',
                'payment': 'bg-gradient-to-br from-green-500 to-emerald-500',
                'notification': 'bg-gradient-to-br from-orange-500 to-red-500'
            };
            return types[type] || 'bg-gradient-to-br from-gray-500 to-gray-600';
        };

        const exportReport = (format) => {
            // TODO: Implement export functionality
            alert(`Exporting report as ${format.toUpperCase()}...`);
            // In real implementation, you would make an API call to generate and download the report
            // Example: axios.get(`/api/reports/export?format=${format}&period=${selectedPeriod.value}`)
        };

        const fetchReportsData = async () => {
            try {
                loading.value = true;
                const response = await axios.get(`/api/reports?period=${selectedPeriod.value}`);
                if (response.data.success) {
                    // Update stats
                    stats.value = response.data.stats;
                    
                    // Update top courses
                    topCourses.value = response.data.topCourses || [];
                    
                    // Update revenue by month
                    revenueByMonth.value = response.data.revenueByMonth || [];
                    
                    // Update students by month
                    studentsByMonth.value = response.data.studentsByMonth || [];
                    
                    // Update recent activities
                    recentActivities.value = response.data.recentActivities || [];
                }
            } catch (err) {
                console.error('Error fetching reports data:', err);
            } finally {
                loading.value = false;
            }
        };

        // Watch for period changes
        watch(selectedPeriod, () => {
            fetchReportsData();
        });

        onMounted(() => {
            fetchReportsData();
        });

        return {
            selectedPeriod,
            timePeriods,
            stats,
            topCourses,
            revenueByMonth,
            studentsByMonth,
            recentActivities,
            loading,
            formatCurrency,
            getActivityIconBg,
            exportReport
        };
    }
};
</script>

<style scoped>
.stat-card {
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px) scale(1.02);
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
