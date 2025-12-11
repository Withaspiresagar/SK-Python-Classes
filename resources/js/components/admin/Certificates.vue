<template>
    <div class="w-full overflow-hidden space-y-6">
        <!-- Stats Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="stat-card bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-indigo-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.totalCertificates }}</div>
                        <div class="text-indigo-100 text-sm sm:text-base font-medium">Total Certificates</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.activeCertificates }}</div>
                        <div class="text-green-100 text-sm sm:text-base font-medium">Active</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-red-500 to-pink-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-red-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.revokedCertificates }}</div>
                        <div class="text-red-100 text-sm sm:text-base font-medium">Revoked</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-blue-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.thisMonthCertificates }}</div>
                        <div class="text-blue-100 text-sm sm:text-base font-medium">This Month</div>
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
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Certificates Management</h2>
                    <p class="text-gray-600 text-sm">Generate and manage student certificates</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                    <button 
                        @click="openBulkGenerateModal"
                        class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-purple-600 hover:to-pink-600 transition font-medium shadow-lg shadow-purple-500/30 transform hover:scale-105 text-sm sm:text-base whitespace-nowrap flex items-center justify-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Bulk Generate
                    </button>
                    <button 
                        @click="openAddModal"
                        class="bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-teal-600 hover:to-cyan-600 transition font-medium shadow-lg shadow-teal-500/30 transform hover:scale-105 text-sm sm:text-base whitespace-nowrap flex items-center justify-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Generate Certificate
                    </button>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <!-- Search Input -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Certificates</label>
                    <div class="relative">
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Search by student, course, or certificate number..."
                            class="w-full px-4 py-2.5 pl-11 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 outline-none transition-all duration-300 bg-white"
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
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 outline-none transition-all duration-300 bg-white"
                    >
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="revoked">Revoked</option>
                    </select>
                </div>
            </div>

            <!-- Quick Filter Buttons -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button
                    @click="clearFilters"
                    :class="!filters.status && !filters.search 
                        ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    All Certificates
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
                    @click="filters.status = 'revoked'"
                    :class="filters.status === 'revoked' 
                        ? 'bg-gradient-to-r from-red-500 to-pink-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Revoked Only
                </button>
            </div>
        </div>

        <!-- Certificates Table Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm text-gray-600">
                    Showing <span class="font-semibold text-gray-900">{{ filteredCertificates.length }}</span> of <span class="font-semibold text-gray-900">{{ certificates.length }}</span> certificates
                </div>
            </div>
            
            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-50 via-purple-50 to-indigo-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Student</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Certificate Number</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Issue Date</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="certificate in filteredCertificates" :key="certificate.id" class="hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-purple-50/50 transition-all duration-200">
                            <td class="px-6 py-5">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-bold text-sm">{{ certificate.user?.name?.charAt(0).toUpperCase() || 'N' }}</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray-900">{{ certificate.user?.name || 'N/A' }}</div>
                                        <div class="text-xs text-gray-500">{{ certificate.user?.email || 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm font-semibold text-gray-900">{{ certificate.course?.name || 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-xs text-gray-600 font-mono">{{ certificate.certificate_number }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm text-gray-900">{{ formatDate(certificate.issue_date) }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm capitalize"
                                    :class="getStatusClass(certificate.status)">
                                    {{ certificate.status }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center space-x-2">
                                    <select 
                                        :value="certificate.status"
                                        @change="updateStatus(certificate.id, $event.target.value)"
                                        class="px-3 py-1.5 text-xs font-semibold rounded-lg border-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-1 cursor-pointer"
                                        :class="getStatusSelectClass(certificate.status)"
                                    >
                                        <option value="active">Active</option>
                                        <option value="revoked">Revoked</option>
                                    </select>
                                    <a 
                                        :href="`/api/certificates/${certificate.id}/download`"
                                        target="_blank"
                                        class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg hover:from-blue-600 hover:to-cyan-600 shadow-sm transition transform hover:scale-110 active:scale-95"
                                        title="Download PDF"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </a>
                                    <a 
                                        :href="`/certificateverify/${certificate.certificate_number}`"
                                        target="_blank"
                                        class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg hover:from-green-600 hover:to-emerald-600 shadow-sm transition transform hover:scale-110 active:scale-95"
                                        title="Verify"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>
                                    <button 
                                        @click="editCertificate(certificate.id)"
                                        class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg hover:from-yellow-600 hover:to-orange-600 shadow-sm transition transform hover:scale-110 active:scale-95"
                                        title="Edit"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button 
                                        @click="deleteCertificate(certificate.id)"
                                        class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-lg hover:from-red-600 hover:to-pink-600 shadow-sm transition transform hover:scale-110 active:scale-95"
                                        title="Delete"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden space-y-4">
                <div v-for="certificate in filteredCertificates" :key="certificate.id" class="bg-white rounded-xl shadow-lg p-4 border border-gray-200">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold">{{ certificate.user?.name?.charAt(0).toUpperCase() || 'N' }}</span>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900">{{ certificate.user?.name || 'N/A' }}</div>
                                <div class="text-xs text-gray-500">{{ certificate.user?.email || 'N/A' }}</div>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold shadow-sm capitalize"
                            :class="getStatusClass(certificate.status)">
                            {{ certificate.status }}
                        </span>
                    </div>
                    <div class="space-y-2 mb-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Course:</span>
                            <span class="text-sm font-semibold text-gray-900">{{ certificate.course?.name || 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Certificate No:</span>
                            <span class="text-xs text-gray-600 font-mono">{{ certificate.certificate_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Issue Date:</span>
                            <span class="text-sm text-gray-900">{{ formatDate(certificate.issue_date) }}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 pt-3 border-t border-gray-200">
                        <select 
                            :value="certificate.status"
                            @change="updateStatus(certificate.id, $event.target.value)"
                            class="flex-1 px-3 py-2 text-xs font-semibold rounded-lg border-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-1"
                            :class="getStatusSelectClass(certificate.status)"
                        >
                            <option value="active">Active</option>
                            <option value="revoked">Revoked</option>
                        </select>
                        <a 
                            :href="`/api/certificates/${certificate.id}/download`"
                            target="_blank"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg text-xs font-medium shadow-sm transition"
                        >
                            Download
                        </a>
                        <a 
                            :href="`/certificateverify/${certificate.certificate_number}`"
                            target="_blank"
                            class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg text-xs font-medium shadow-sm transition"
                        >
                            Verify
                        </a>
                        <button 
                            @click="editCertificate(certificate.id)"
                            class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg text-xs font-medium shadow-sm transition"
                        >
                            Edit
                        </button>
                        <button 
                            @click="deleteCertificate(certificate.id)"
                            class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-lg text-xs font-medium shadow-sm transition"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-if="filteredCertificates.length === 0" class="text-center py-12">
                <div class="flex flex-col items-center">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    <p class="text-gray-500 font-medium text-lg mb-2">No certificates found</p>
                    <p class="text-gray-400 text-sm mb-4">{{ filters.search || filters.status ? 'Try adjusting your filters' : 'Click "Generate Certificate" to create one' }}</p>
                    <button 
                        v-if="!filters.search && !filters.status"
                        @click="openAddModal"
                        class="bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-6 py-2 rounded-lg hover:from-teal-600 hover:to-cyan-600 transition font-medium"
                    >
                        Generate First Certificate
                    </button>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center z-[9999] p-3 sm:p-4 overflow-y-auto" @click.self="closeModal">
            <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl shadow-2xl w-full max-w-2xl border border-indigo-100 transform transition-all flex flex-col max-h-[calc(100vh-2rem)] lg:max-h-[90vh] mx-auto">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-teal-500 via-cyan-500 to-teal-500 rounded-t-2xl p-4 sm:p-6 flex-shrink-0">
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
                                    {{ modalMode === 'add' ? 'Generate New Certificate' : 'Edit Certificate' }}
                                </h3>
                                <p class="text-teal-100 text-xs sm:text-sm mt-0.5 hidden sm:block">
                                    {{ modalMode === 'add' ? 'Create a certificate for a student' : 'Update certificate information' }}
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
                    <form @submit.prevent="saveCertificate">
                        <div class="space-y-5">
                            <!-- Student Selection -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    Student *
                                </label>
                                <select 
                                    v-model="form.user_id" 
                                    class="form-input-modern"
                                    required
                                >
                                    <option value="">Select Student</option>
                                    <option v-for="student in students" :key="student.id" :value="student.id">
                                        {{ student.name }} ({{ student.email }})
                                    </option>
                                </select>
                            </div>

                            <!-- Course Selection -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Course *
                                </label>
                                <select 
                                    v-model="form.course_id" 
                                    class="form-input-modern"
                                    required
                                >
                                    <option value="">Select Course</option>
                                    <option v-for="course in courses" :key="course.id" :value="course.id">
                                        {{ course.name }}
                                    </option>
                                </select>
                            </div>

                            <!-- Issue Date and Expiry Date -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Issue Date *
                                    </label>
                                    <input 
                                        type="date" 
                                        v-model="form.issue_date" 
                                        class="form-input-modern"
                                        required
                                    >
                                </div>

                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Expiry Date (Optional)
                                    </label>
                                    <input 
                                        type="date" 
                                        v-model="form.expiry_date" 
                                        class="form-input-modern"
                                        :min="form.issue_date"
                                    >
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Status *
                                </label>
                                <select v-model="form.status" class="form-input-modern" required>
                                    <option value="active">Active</option>
                                    <option value="revoked">Revoked</option>
                                </select>
                            </div>

                            <!-- Notes -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>
                                    Notes
                                </label>
                                <textarea 
                                    v-model="form.notes" 
                                    placeholder="Add any additional notes..."
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
                                class="px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-teal-500 via-cyan-500 to-teal-500 text-white rounded-xl hover:from-teal-600 hover:via-cyan-600 hover:to-teal-600 transition font-medium shadow-lg shadow-teal-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95 w-full sm:w-auto"
                            >
                                <span v-if="!loading" class="flex items-center space-x-2">
                                    <svg v-if="modalMode === 'add'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ modalMode === 'add' ? 'Generate Certificate' : 'Update Certificate' }}</span>
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

        <!-- Bulk Generate Modal -->
        <div v-if="showBulkModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center z-[9999] p-3 sm:p-4 overflow-y-auto" @click.self="closeBulkModal">
            <div class="bg-gradient-to-br from-white via-purple-50/30 to-pink-50/30 rounded-2xl shadow-2xl w-full max-w-2xl border-2 border-purple-100 transform transition-all flex flex-col max-h-[calc(100vh-2rem)] lg:max-h-[90vh] mx-auto">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-purple-500 via-pink-500 to-purple-500 rounded-t-2xl p-4 sm:p-6 flex-shrink-0">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2 sm:space-x-3 flex-1 min-w-0">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg sm:text-xl font-bold text-white truncate">Bulk Generate Certificates</h3>
                                <p class="text-purple-100 text-xs sm:text-sm mt-0.5 hidden sm:block">Generate certificates for all students in a batch</p>
                            </div>
                        </div>
                        <button @click="closeBulkModal" class="w-8 h-8 sm:w-10 sm:h-10 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition backdrop-blur-sm ml-2 sm:ml-3 flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex-1 overflow-y-auto p-4 sm:p-6">
                    <div class="space-y-5">
                        <!-- Batch Selection -->
                        <div class="form-field-group">
                            <label class="form-label">
                                <svg class="w-5 h-5 inline mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Batch *
                            </label>
                            <select 
                                v-model="bulkForm.batch_id" 
                                @change="onBatchChange"
                                class="form-input-modern"
                                required
                            >
                                <option value="">Select Batch</option>
                                <option v-for="batch in batches" :key="batch.id" :value="batch.id">
                                    {{ batch.name }} - {{ batch.course?.name || 'No Course' }}
                                </option>
                            </select>
                        </div>

                        <!-- Course (Auto-filled from batch) -->
                        <div class="form-field-group">
                            <label class="form-label">
                                <svg class="w-5 h-5 inline mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Course (from Batch)
                            </label>
                            <input 
                                type="text" 
                                :value="selectedBatchCourse" 
                                class="form-input-modern bg-gray-50"
                                disabled
                                readonly
                            >
                        </div>

                        <!-- Students Count -->
                        <div v-if="selectedBatchStudentsCount > 0" class="p-4 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl border-2 border-indigo-200">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-indigo-700">Students in Batch:</span>
                                <span class="text-lg font-bold text-indigo-900">{{ selectedBatchStudentsCount }}</span>
                            </div>
                        </div>

                        <!-- Issue Date and Expiry Date -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Issue Date *
                                </label>
                                <input 
                                    type="date" 
                                    v-model="bulkForm.issue_date" 
                                    class="form-input-modern"
                                    required
                                >
                            </div>

                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Expiry Date (Optional)
                                </label>
                                <input 
                                    type="date" 
                                    v-model="bulkForm.expiry_date" 
                                    class="form-input-modern"
                                    :min="bulkForm.issue_date"
                                >
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="form-field-group">
                            <label class="form-label">
                                <svg class="w-5 h-5 inline mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                Notes
                            </label>
                            <textarea 
                                v-model="bulkForm.notes" 
                                placeholder="Add any additional notes..."
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-green-700 text-sm font-medium">{{ successMessage }}</p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="p-4 sm:p-6 border-t border-purple-100 bg-gradient-to-r from-purple-50/50 to-pink-50/50 rounded-b-2xl flex-shrink-0">
                    <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                        <button 
                            @click="closeBulkModal"
                            class="px-6 py-2.5 bg-white border-2 border-purple-300 text-purple-700 rounded-xl hover:bg-purple-50 transition font-medium"
                        >
                            Cancel
                        </button>
                        <button 
                            @click="handleBulkGenerate"
                            :disabled="loading || !bulkForm.batch_id || !bulkForm.issue_date"
                            class="px-6 py-2.5 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl hover:from-purple-600 hover:to-pink-600 transition font-medium shadow-lg disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                        >
                            <svg v-if="loading" class="w-5 h-5 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>{{ loading ? 'Generating...' : 'Generate Certificates' }}</span>
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
    name: 'Certificates',
    setup() {
        const certificates = ref([]);
        const students = ref([]);
        const courses = ref([]);
        const batches = ref([]);
        const showModal = ref(false);
        const showBulkModal = ref(false);
        const modalMode = ref('add');
        const loading = ref(false);
        const error = ref('');
        const successMessage = ref('');
        const currentCertificateId = ref(null);

        const stats = ref({
            totalCertificates: 0,
            activeCertificates: 0,
            revokedCertificates: 0,
            thisMonthCertificates: 0
        });

        const filters = ref({
            search: '',
            status: ''
        });

        const form = ref({
            user_id: '',
            course_id: '',
            issue_date: new Date().toISOString().split('T')[0],
            expiry_date: '',
            status: 'active',
            notes: ''
        });

        const bulkForm = ref({
            batch_id: '',
            issue_date: new Date().toISOString().split('T')[0],
            expiry_date: '',
            notes: ''
        });

        const selectedBatch = ref(null);

        // Computed filtered certificates
        const filteredCertificates = computed(() => {
            let filtered = [...certificates.value];

            // Search filter
            if (filters.value.search) {
                const searchTerm = filters.value.search.toLowerCase();
                filtered = filtered.filter(certificate => 
                    certificate.user?.name?.toLowerCase().includes(searchTerm) ||
                    certificate.user?.email?.toLowerCase().includes(searchTerm) ||
                    certificate.course?.name?.toLowerCase().includes(searchTerm) ||
                    certificate.certificate_number?.toLowerCase().includes(searchTerm)
                );
            }

            // Status filter
            if (filters.value.status) {
                filtered = filtered.filter(certificate => certificate.status === filters.value.status);
            }

            return filtered;
        });

        const fetchCertificates = async () => {
            try {
                const response = await axios.get('/api/certificates');
                if (response.data.success) {
                    certificates.value = response.data.certificates;
                }
            } catch (err) {
                console.error('Error fetching certificates:', err);
                error.value = 'Failed to fetch certificates';
            }
        };

        const fetchStats = async () => {
            try {
                const response = await axios.get('/api/certificates/stats');
                if (response.data.success) {
                    stats.value = response.data.stats;
                }
            } catch (err) {
                console.error('Error fetching stats:', err);
            }
        };

        const fetchStudents = async () => {
            try {
                const response = await axios.get('/api/students');
                if (response.data.success) {
                    students.value = response.data.students || [];
                }
            } catch (err) {
                console.error('Error fetching students:', err);
            }
        };

        const fetchCourses = async () => {
            try {
                const response = await axios.get('/api/courses');
                if (response.data.success) {
                    courses.value = response.data.courses || [];
                }
            } catch (err) {
                console.error('Error fetching courses:', err);
            }
        };

        const fetchBatches = async () => {
            try {
                const response = await axios.get('/api/batches');
                if (response.data.success) {
                    batches.value = response.data.batches || [];
                }
            } catch (err) {
                console.error('Error fetching batches:', err);
            }
        };

        const openAddModal = () => {
            modalMode.value = 'add';
            form.value = {
                user_id: '',
                course_id: '',
                issue_date: new Date().toISOString().split('T')[0],
                expiry_date: '',
                status: 'active',
                notes: ''
            };
            error.value = '';
            successMessage.value = '';
            showModal.value = true;
        };

        const openBulkGenerateModal = () => {
            bulkForm.value = {
                batch_id: '',
                issue_date: new Date().toISOString().split('T')[0],
                expiry_date: '',
                notes: ''
            };
            selectedBatch.value = null;
            error.value = '';
            successMessage.value = '';
            showBulkModal.value = true;
        };

        const onBatchChange = () => {
            if (bulkForm.value.batch_id) {
                selectedBatch.value = batches.value.find(b => b.id == bulkForm.value.batch_id);
            } else {
                selectedBatch.value = null;
            }
        };

        const selectedBatchCourse = computed(() => {
            return selectedBatch.value?.course?.name || 'No course assigned';
        });

        const selectedBatchStudentsCount = computed(() => {
            return selectedBatch.value?.students?.length || 0;
        });

        const handleBulkGenerate = async () => {
            loading.value = true;
            error.value = '';
            successMessage.value = '';

            try {
                const response = await axios.post('/api/certificates/bulk-generate', bulkForm.value);
                
                if (response.data.success) {
                    successMessage.value = response.data.message;
                    await fetchCertificates();
                    await fetchStats();
                    
                    setTimeout(() => {
                        closeBulkModal();
                    }, 2000);
                } else {
                    error.value = response.data.message || 'Failed to generate certificates';
                }
            } catch (err) {
                console.error('Error bulk generating certificates:', err);
                error.value = err.response?.data?.message || 'Failed to generate certificates';
            } finally {
                loading.value = false;
            }
        };

        const closeBulkModal = () => {
            showBulkModal.value = false;
            bulkForm.value = {
                batch_id: '',
                issue_date: new Date().toISOString().split('T')[0],
                expiry_date: '',
                notes: ''
            };
            selectedBatch.value = null;
            error.value = '';
            successMessage.value = '';
        };

        const editCertificate = async (id) => {
            try {
                const response = await axios.get(`/api/certificates/${id}`);
                if (response.data.success) {
                    const certificate = response.data.certificate;
                    form.value = {
                        user_id: certificate.user_id,
                        course_id: certificate.course_id,
                        issue_date: certificate.issue_date,
                        expiry_date: certificate.expiry_date || '',
                        status: certificate.status,
                        notes: certificate.notes || ''
                    };
                    modalMode.value = 'edit';
                    currentCertificateId.value = id;
                    error.value = '';
                    successMessage.value = '';
                    showModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching certificate:', err);
                error.value = err.response?.data?.message || 'Failed to fetch certificate details';
            }
        };

        const saveCertificate = async () => {
            loading.value = true;
            error.value = '';
            successMessage.value = '';

            try {
                let response;
                if (modalMode.value === 'add') {
                    response = await axios.post('/api/certificates', form.value);
                } else {
                    response = await axios.put(`/api/certificates/${currentCertificateId.value}`, form.value);
                }

                if (response.data.success) {
                    successMessage.value = response.data.message;
                    await fetchCertificates();
                    await fetchStats();
                    setTimeout(() => {
                        closeModal();
                    }, 1500);
                }
            } catch (err) {
                if (err.response?.data?.errors) {
                    const errors = err.response.data.errors;
                    error.value = Object.values(errors).flat().join(', ');
                } else {
                    error.value = err.response?.data?.message || 'Failed to save certificate';
                }
            } finally {
                loading.value = false;
            }
        };

        const updateStatus = async (id, newStatus) => {
            try {
                const response = await axios.put(`/api/certificates/${id}`, {
                    ...certificates.value.find(c => c.id === id),
                    status: newStatus
                });
                if (response.data.success) {
                    await fetchCertificates();
                    await fetchStats();
                } else {
                    alert(response.data.message || 'Failed to update status');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to update status');
            }
        };

        const deleteCertificate = async (id) => {
            if (!confirm('Are you sure you want to delete this certificate?')) {
                return;
            }

            try {
                const response = await axios.delete(`/api/certificates/${id}`);
                if (response.data.success) {
                    await fetchCertificates();
                    await fetchStats();
                } else {
                    alert(response.data.message || 'Failed to delete certificate');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to delete certificate');
            }
        };

        const closeModal = () => {
            showModal.value = false;
            form.value = {
                user_id: '',
                course_id: '',
                issue_date: new Date().toISOString().split('T')[0],
                expiry_date: '',
                status: 'active',
                notes: ''
            };
            error.value = '';
            successMessage.value = '';
            currentCertificateId.value = null;
        };

        const clearFilters = () => {
            filters.value = {
                search: '',
                status: ''
            };
        };

        const formatDate = (date) => {
            if (!date) return 'N/A';
            return new Date(date).toLocaleDateString('en-IN', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        };

        const getStatusClass = (status) => {
            const classes = {
                'active': 'bg-gradient-to-r from-green-400 to-emerald-400 text-white',
                'revoked': 'bg-gradient-to-r from-red-400 to-pink-400 text-white'
            };
            return classes[status] || 'bg-gray-200 text-gray-700';
        };

        const getStatusSelectClass = (status) => {
            const classes = {
                'active': 'border-green-500 bg-green-50 text-green-700',
                'revoked': 'border-red-500 bg-red-50 text-red-700'
            };
            return classes[status] || 'border-gray-300 bg-white text-gray-700';
        };

        // ESC key handler for closing modals
        const handleEscKey = (event) => {
            if (event.key === 'Escape') {
                if (showModal.value) {
                    closeModal();
                }
                if (showBulkModal.value) {
                    closeBulkModal();
                }
            }
        };

        onMounted(() => {
            fetchCertificates();
            fetchStats();
            fetchStudents();
            fetchCourses();
            fetchBatches();
            window.addEventListener('keydown', handleEscKey);
        });

        onUnmounted(() => {
            window.removeEventListener('keydown', handleEscKey);
        });

        return {
            certificates,
            students,
            courses,
            batches,
            stats,
            filters,
            filteredCertificates,
            showModal,
            showBulkModal,
            modalMode,
            loading,
            error,
            successMessage,
            form,
            bulkForm,
            selectedBatch,
            selectedBatchCourse,
            selectedBatchStudentsCount,
            openAddModal,
            openBulkGenerateModal,
            onBatchChange,
            handleBulkGenerate,
            closeBulkModal,
            editCertificate,
            saveCertificate,
            updateStatus,
            deleteCertificate,
            closeModal,
            clearFilters,
            formatDate,
            getStatusClass,
            getStatusSelectClass
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
    border-color: #14b8a6;
    box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.1);
    background: #ffffff;
}

.form-input-modern::placeholder {
    color: #9ca3af;
}

.stat-card {
    backdrop-filter: blur(10px);
}

@media (min-width: 1024px) {
    .fixed.inset-0 {
        left: 260px;
    }
}

.fixed.inset-0 > div {
    max-width: min(100vw - 2rem, 42rem);
}

@media (min-width: 1024px) {
    .fixed.inset-0 > div {
        max-width: min(calc(100vw - 260px - 2rem), 42rem);
    }
}
</style>
