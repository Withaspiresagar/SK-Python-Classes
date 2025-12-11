<template>
    <div class="w-full overflow-hidden space-y-6">
        <!-- Stats Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="stat-card bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-indigo-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.totalPayments }}</div>
                        <div class="text-indigo-100 text-sm sm:text-base font-medium">Total Payments</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">₹{{ formatCurrency(stats.totalAmount) }}</div>
                        <div class="text-green-100 text-sm sm:text-base font-medium">Total Revenue</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-300 border border-blue-400/20">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.paidPayments }}</div>
                        <div class="text-blue-100 text-sm sm:text-base font-medium">Paid</div>
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
                        <div class="text-3xl sm:text-4xl font-bold mb-1">{{ stats.pendingPayments }}</div>
                        <div class="text-orange-100 text-sm sm:text-base font-medium">Pending</div>
                    </div>
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search Section -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-4 sm:p-6 border border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                <div class="flex-1">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Payments Management</h2>
                    <p class="text-gray-600 text-sm">Manage all student payments and course registrations</p>
                </div>
                <button 
                    @click="openAddModal"
                    class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-indigo-600 hover:to-purple-600 transition font-medium shadow-lg shadow-indigo-500/30 transform hover:scale-105 text-sm sm:text-base whitespace-nowrap flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Payment
                </button>
            </div>

            <!-- Search and Filters -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Search Input -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Payments</label>
                    <div class="relative">
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Search by student, course, transaction ID..."
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
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="failed">Failed</option>
                        <option value="refunded">Refunded</option>
                    </select>
                </div>

                <!-- Payment Method Filter -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Method</label>
                    <select
                        v-model="filters.payment_method"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 outline-none transition-all duration-300 bg-white"
                    >
                        <option value="">All Methods</option>
                        <option value="cash">Cash</option>
                        <option value="online">Online</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="upi">UPI</option>
                        <option value="card">Card</option>
                    </select>
                </div>
            </div>

            <!-- Quick Filter Buttons -->
            <div class="flex flex-wrap gap-2 mb-6">
                <button
                    @click="clearFilters"
                    :class="!filters.status && !filters.payment_method && !filters.search 
                        ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    All Payments
                </button>
                <button
                    @click="filters.status = 'paid'"
                    :class="filters.status === 'paid' 
                        ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Paid
                </button>
                <button
                    @click="filters.status = 'pending'"
                    :class="filters.status === 'pending' 
                        ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Pending
                </button>
                <button
                    @click="filters.status = 'failed'"
                    :class="filters.status === 'failed' 
                        ? 'bg-gradient-to-r from-red-500 to-pink-500 text-white' 
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition"
                >
                    Failed
                </button>
            </div>
        </div>

        <!-- Payments Table Section -->
        <div class="bg-gradient-to-br from-white via-indigo-50/20 to-purple-50/20 rounded-2xl shadow-xl p-4 sm:p-6 border-2 border-indigo-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-indigo-100/30 to-purple-100/30 rounded-full -mr-32 -mt-32"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-sm text-gray-700 font-medium">
                        Showing <span class="font-bold text-indigo-600">{{ filteredPayments.length }}</span> of <span class="font-bold text-indigo-600">{{ payments.length }}</span> payments
                    </div>
                </div>
                
                <!-- Desktop Table View -->
                <div class="hidden lg:block w-full overflow-hidden">
                    <div class="w-full overflow-x-auto" style="max-width: 100%;">
                        <table class="w-full table-auto min-w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500">
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Student</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Course</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Amount</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Date</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Method</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Status</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Txn ID</th>
                                    <th class="px-4 py-4 text-left text-sm font-bold text-white uppercase tracking-wider whitespace-nowrap">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                <tr v-for="payment in filteredPayments" :key="payment.id" class="hover:bg-gradient-to-r hover:from-indigo-50/60 hover:via-purple-50/60 hover:to-indigo-50/60 transition-all duration-300 group border-b border-gray-100">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-2 min-w-[180px]">
                                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform duration-300">
                                                <span class="text-white font-bold text-sm">{{ payment.user?.name?.charAt(0).toUpperCase() || 'N' }}</span>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-sm font-bold text-gray-900 truncate group-hover:text-indigo-600 transition-colors">{{ payment.user?.name || 'N/A' }}</div>
                                                <div class="text-xs text-gray-500 truncate">{{ payment.user?.email || 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm font-semibold text-gray-900 truncate max-w-[150px]" :title="payment.course?.name || 'N/A'">{{ payment.course?.name || 'N/A' }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm font-bold text-indigo-600 whitespace-nowrap">₹{{ payment.amount || 0 }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900 whitespace-nowrap">{{ formatDate(payment.payment_date) }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-xs text-gray-700 capitalize whitespace-nowrap bg-gray-50 px-2 py-1 rounded-md inline-block">{{ payment.payment_method || 'N/A' }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-md capitalize whitespace-nowrap"
                                            :class="getStatusClass(payment.status)">
                                            {{ payment.status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-xs text-gray-600 font-mono truncate max-w-[120px]" :title="payment.transaction_id || 'N/A'">{{ payment.transaction_id || 'N/A' }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-1.5">
                                            <select 
                                                :value="payment.status"
                                                @change="updateStatus(payment.id, $event.target.value)"
                                                class="px-2 py-1.5 text-xs font-semibold rounded-lg border-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-1 cursor-pointer whitespace-nowrap"
                                                :class="getStatusSelectClass(payment.status)"
                                            >
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="failed">Failed</option>
                                                <option value="refunded">Refunded</option>
                                            </select>
                                            <button 
                                                @click="generateReceipt(payment.id)"
                                                class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl hover:from-purple-600 hover:to-pink-600 shadow-lg hover:shadow-xl transition-all transform hover:scale-110 active:scale-95 border-2 border-purple-400/30"
                                                title="Generate Receipt"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </button>
                                            <button 
                                                @click="editPayment(payment.id)"
                                                class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl hover:from-green-600 hover:to-emerald-600 shadow-lg hover:shadow-xl transition-all transform hover:scale-110 active:scale-95 border-2 border-green-400/30"
                                                title="Edit"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button 
                                                @click="deletePayment(payment.id)"
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
                                <tr v-if="filteredPayments.length === 0">
                                    <td colspan="8" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <p class="text-gray-500 text-lg font-medium">No payments found</p>
                                            <p class="text-gray-400 text-sm mt-1">Try adjusting your search or filters</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden space-y-4">
                <div v-for="payment in filteredPayments" :key="payment.id" class="bg-white rounded-xl shadow-lg p-4 border border-gray-200">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold">{{ payment.user?.name?.charAt(0).toUpperCase() || 'N' }}</span>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900">{{ payment.user?.name || 'N/A' }}</div>
                                <div class="text-xs text-gray-500">{{ payment.user?.email || 'N/A' }}</div>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold shadow-sm capitalize"
                            :class="getStatusClass(payment.status)">
                            {{ payment.status }}
                        </span>
                    </div>
                    <div class="space-y-2 mb-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Course:</span>
                            <span class="text-sm font-semibold text-gray-900">{{ payment.course?.name || 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Amount:</span>
                            <span class="text-sm font-bold text-indigo-600">₹{{ payment.amount || 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Date:</span>
                            <span class="text-sm text-gray-900">{{ formatDate(payment.payment_date) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Method:</span>
                            <span class="text-sm text-gray-700 capitalize">{{ payment.payment_method || 'N/A' }}</span>
                        </div>
                        <div v-if="payment.transaction_id" class="flex justify-between">
                            <span class="text-sm text-gray-600">Transaction ID:</span>
                            <span class="text-xs text-gray-600 font-mono">{{ payment.transaction_id }}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 pt-3 border-t border-gray-200">
                        <select 
                            :value="payment.status"
                            @change="updateStatus(payment.id, $event.target.value)"
                            class="flex-1 px-3 py-2 text-xs font-semibold rounded-lg border-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-1"
                            :class="getStatusSelectClass(payment.status)"
                        >
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                            <option value="failed">Failed</option>
                            <option value="refunded">Refunded</option>
                        </select>
                        <button 
                            @click="generateReceipt(payment.id)"
                            class="px-3 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg text-xs font-medium shadow-sm transition"
                            title="Receipt"
                        >
                            Receipt
                        </button>
                        <button 
                            @click="editPayment(payment.id)"
                            class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg text-xs font-medium shadow-sm transition"
                        >
                            Edit
                        </button>
                        <button 
                            @click="deletePayment(payment.id)"
                            class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-lg text-xs font-medium shadow-sm transition"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-if="filteredPayments.length === 0" class="text-center py-12">
                <div class="flex flex-col items-center">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="text-gray-500 font-medium text-lg mb-2">No payments found</p>
                    <p class="text-gray-400 text-sm mb-4">{{ filters.search || filters.status ? 'Try adjusting your filters' : 'Click "Add Payment" to add one' }}</p>
                    <button 
                        v-if="!filters.search && !filters.status"
                        @click="openAddModal"
                        class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-6 py-2 rounded-lg hover:from-indigo-600 hover:to-purple-600 transition font-medium"
                    >
                        Add First Payment
                    </button>
                </div>
            </div>
        </div>

        <!-- Receipt Modal -->
        <div v-if="showReceiptModal" class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center z-[9999] p-3 sm:p-4 overflow-y-auto" @click.self="closeReceiptModal">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl border border-gray-100 transform transition-all flex flex-col max-h-[calc(100vh-2rem)] lg:max-h-[90vh] mx-auto">
                <!-- Header -->
                <div class="relative bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 rounded-t-2xl p-4 sm:p-6 flex-shrink-0">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl sm:text-2xl font-bold text-white">Payment Receipt</h3>
                                <p class="text-indigo-100 text-sm mt-0.5">Receipt #{{ currentReceiptPayment?.id ? String(currentReceiptPayment.id).padStart(6, '0') : '' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button 
                                @click="sendReceiptEmail"
                                :disabled="receiptSending"
                                class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg text-sm font-medium transition backdrop-blur-sm disabled:opacity-50"
                            >
                                <span v-if="!receiptSending" class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>Send Email</span>
                                </span>
                                <span v-else class="flex items-center space-x-2">
                                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>Sending...</span>
                                </span>
                            </button>
                            <button 
                                @click="printReceipt"
                                class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg text-sm font-medium transition backdrop-blur-sm"
                            >
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Print
                            </button>
                            <button @click="closeReceiptModal" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition backdrop-blur-sm">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Receipt Content -->
                <div class="p-4 sm:p-6 overflow-y-auto flex-1" v-html="receiptHtml"></div>
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
                                    {{ modalMode === 'add' ? 'Add New Payment' : 'Edit Payment' }}
                                </h3>
                                <p class="text-indigo-100 text-xs sm:text-sm mt-0.5 hidden sm:block">
                                    {{ modalMode === 'add' ? 'Record a new payment' : 'Update payment information' }}
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
                    <form @submit.prevent="savePayment">
                        <div class="space-y-5">
                            <!-- Student Selection -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Course
                                </label>
                                <select 
                                    v-model="form.course_id" 
                                    class="form-input-modern"
                                >
                                    <option value="">Select Course (Optional)</option>
                                    <option v-for="course in courses" :key="course.id" :value="course.id">
                                        {{ course.name }} - ₹{{ course.price }}
                                    </option>
                                </select>
                            </div>

                            <!-- Amount and Status -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Amount (₹) *
                                    </label>
                                    <input 
                                        type="number" 
                                        v-model="form.amount" 
                                        placeholder="0.00"
                                        step="0.01"
                                        min="0"
                                        class="form-input-modern"
                                        required
                                    >
                                </div>

                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Status *
                                    </label>
                                    <select v-model="form.status" class="form-input-modern" required>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                        <option value="failed">Failed</option>
                                        <option value="refunded">Refunded</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Payment Method and Date -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        Payment Method
                                    </label>
                                    <select v-model="form.payment_method" class="form-input-modern">
                                        <option value="">Select Method</option>
                                        <option value="cash">Cash</option>
                                        <option value="online">Online</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="upi">UPI</option>
                                        <option value="card">Card</option>
                                    </select>
                                </div>

                                <div class="form-field-group">
                                    <label class="form-label">
                                        <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Payment Date *
                                    </label>
                                    <input 
                                        type="date" 
                                        v-model="form.payment_date" 
                                        class="form-input-modern"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Transaction ID -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                    </svg>
                                    Transaction ID
                                </label>
                                <input 
                                    type="text" 
                                    v-model="form.transaction_id" 
                                    placeholder="Enter transaction ID (optional)"
                                    class="form-input-modern"
                                >
                            </div>

                            <!-- Notes -->
                            <div class="form-field-group">
                                <label class="form-label">
                                    <svg class="w-5 h-5 inline mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                class="px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 text-white rounded-xl hover:from-indigo-600 hover:via-purple-600 hover:to-indigo-600 transition font-medium shadow-lg shadow-indigo-500/30 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95 w-full sm:w-auto"
                            >
                                <span v-if="!loading" class="flex items-center space-x-2">
                                    <svg v-if="modalMode === 'add'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ modalMode === 'add' ? 'Add Payment' : 'Update Payment' }}</span>
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
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import axios from 'axios';

export default {
    name: 'Payments',
    setup() {
        const payments = ref([]);
        const students = ref([]);
        const courses = ref([]);
        const showModal = ref(false);
        const showReceiptModal = ref(false);
        const modalMode = ref('add');
        const loading = ref(false);
        const error = ref('');
        const successMessage = ref('');
        const currentPaymentId = ref(null);
        const receiptHtml = ref('');
        const currentReceiptPayment = ref(null);
        const receiptSending = ref(false);

        const stats = ref({
            totalPayments: 0,
            totalAmount: 0,
            pendingPayments: 0,
            paidPayments: 0,
            failedPayments: 0,
            refundedPayments: 0
        });

        const filters = ref({
            search: '',
            status: '',
            payment_method: ''
        });

        const form = ref({
            user_id: '',
            course_id: '',
            amount: 0,
            status: 'pending',
            payment_method: '',
            transaction_id: '',
            payment_date: new Date().toISOString().split('T')[0],
            notes: ''
        });

        // Computed filtered payments
        const filteredPayments = computed(() => {
            let filtered = [...payments.value];

            // Search filter
            if (filters.value.search) {
                const searchTerm = filters.value.search.toLowerCase();
                filtered = filtered.filter(payment => 
                    payment.user?.name?.toLowerCase().includes(searchTerm) ||
                    payment.user?.email?.toLowerCase().includes(searchTerm) ||
                    payment.course?.name?.toLowerCase().includes(searchTerm) ||
                    payment.transaction_id?.toLowerCase().includes(searchTerm)
                );
            }

            // Status filter
            if (filters.value.status) {
                filtered = filtered.filter(payment => payment.status === filters.value.status);
            }

            // Payment method filter
            if (filters.value.payment_method) {
                filtered = filtered.filter(payment => payment.payment_method === filters.value.payment_method);
            }

            return filtered;
        });

        const fetchPayments = async () => {
            try {
                const response = await axios.get('/api/payments');
                if (response.data.success) {
                    payments.value = response.data.payments;
                }
            } catch (err) {
                console.error('Error fetching payments:', err);
                error.value = 'Failed to fetch payments';
            }
        };

        const fetchStats = async () => {
            try {
                const response = await axios.get('/api/payments/stats');
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

        const openAddModal = () => {
            modalMode.value = 'add';
            form.value = {
                user_id: '',
                course_id: '',
                amount: 0,
                status: 'pending',
                payment_method: '',
                transaction_id: '',
                payment_date: new Date().toISOString().split('T')[0],
                notes: ''
            };
            error.value = '';
            successMessage.value = '';
            showModal.value = true;
        };

        const editPayment = async (id) => {
            try {
                const response = await axios.get(`/api/payments/${id}`);
                if (response.data.success) {
                    const payment = response.data.payment;
                    form.value = {
                        user_id: payment.user_id,
                        course_id: payment.course_id || '',
                        amount: payment.amount,
                        status: payment.status,
                        payment_method: payment.payment_method || '',
                        transaction_id: payment.transaction_id || '',
                        payment_date: payment.payment_date,
                        notes: payment.notes || ''
                    };
                    modalMode.value = 'edit';
                    currentPaymentId.value = id;
                    error.value = '';
                    successMessage.value = '';
                    showModal.value = true;
                }
            } catch (err) {
                console.error('Error fetching payment:', err);
                error.value = err.response?.data?.message || 'Failed to fetch payment details';
            }
        };

        const savePayment = async () => {
            loading.value = true;
            error.value = '';
            successMessage.value = '';

            try {
                let response;
                if (modalMode.value === 'add') {
                    response = await axios.post('/api/payments', form.value);
                } else {
                    response = await axios.put(`/api/payments/${currentPaymentId.value}`, form.value);
                }

                if (response.data.success) {
                    successMessage.value = response.data.message;
                    await fetchPayments();
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
                    error.value = err.response?.data?.message || 'Failed to save payment';
                }
            } finally {
                loading.value = false;
            }
        };

        const updateStatus = async (id, newStatus) => {
            try {
                const response = await axios.put(`/api/payments/${id}/status`, {
                    status: newStatus
                });
                if (response.data.success) {
                    await fetchPayments();
                    await fetchStats();
                } else {
                    alert(response.data.message || 'Failed to update status');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to update status');
            }
        };

        const generateReceipt = async (id) => {
            try {
                const response = await axios.get(`/api/payments/${id}/receipt`);
                if (response.data.success) {
                    receiptHtml.value = response.data.html;
                    currentReceiptPayment.value = response.data.payment;
                    showReceiptModal.value = true;
                } else {
                    alert(response.data.message || 'Failed to generate receipt');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to generate receipt');
            }
        };

        const sendReceiptEmail = async () => {
            if (!currentReceiptPayment.value) return;

            receiptSending.value = true;
            try {
                const response = await axios.post(`/api/payments/${currentReceiptPayment.value.id}/send-receipt`);
                if (response.data.success) {
                    alert(response.data.message || 'Receipt sent successfully');
                } else {
                    alert(response.data.message || 'Failed to send receipt');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to send receipt');
            } finally {
                receiptSending.value = false;
            }
        };

        const printReceipt = () => {
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Payment Receipt</title>
                        <style>
                            body { margin: 0; padding: 20px; }
                            @media print {
                                body { padding: 0; }
                            }
                        </style>
                    </head>
                    <body>
                        ${receiptHtml.value}
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => {
                printWindow.print();
            }, 250);
        };

        const closeReceiptModal = () => {
            showReceiptModal.value = false;
            receiptHtml.value = '';
            currentReceiptPayment.value = null;
        };

        const deletePayment = async (id) => {
            if (!confirm('Are you sure you want to delete this payment?')) {
                return;
            }

            try {
                const response = await axios.delete(`/api/payments/${id}`);
                if (response.data.success) {
                    await fetchPayments();
                    await fetchStats();
                } else {
                    alert(response.data.message || 'Failed to delete payment');
                }
            } catch (err) {
                alert(err.response?.data?.message || 'Failed to delete payment');
            }
        };

        const closeModal = () => {
            showModal.value = false;
            form.value = {
                user_id: '',
                course_id: '',
                amount: 0,
                status: 'pending',
                payment_method: '',
                transaction_id: '',
                payment_date: new Date().toISOString().split('T')[0],
                notes: ''
            };
            error.value = '';
            successMessage.value = '';
            currentPaymentId.value = null;
        };

        const clearFilters = () => {
            filters.value = {
                search: '',
                status: '',
                payment_method: ''
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

        const formatCurrency = (amount) => {
            if (amount >= 1000000) {
                return (amount / 1000000).toFixed(2) + 'M';
            } else if (amount >= 1000) {
                return (amount / 1000).toFixed(1) + 'K';
            }
            return amount.toString();
        };

        const getStatusClass = (status) => {
            const classes = {
                'paid': 'bg-gradient-to-r from-green-400 to-emerald-400 text-white',
                'pending': 'bg-gradient-to-r from-orange-400 to-red-400 text-white',
                'failed': 'bg-gradient-to-r from-red-400 to-pink-400 text-white',
                'refunded': 'bg-gradient-to-r from-gray-400 to-gray-500 text-white'
            };
            return classes[status] || 'bg-gray-200 text-gray-700';
        };

        const getStatusSelectClass = (status) => {
            const classes = {
                'paid': 'border-green-500 bg-green-50 text-green-700',
                'pending': 'border-orange-500 bg-orange-50 text-orange-700',
                'failed': 'border-red-500 bg-red-50 text-red-700',
                'refunded': 'border-gray-500 bg-gray-50 text-gray-700'
            };
            return classes[status] || 'border-gray-300 bg-white text-gray-700';
        };

        // ESC key handler for closing modals
        const handleEscKey = (event) => {
            if (event.key === 'Escape') {
                if (showReceiptModal.value) {
                    closeReceiptModal();
                } else if (showModal.value) {
                    closeModal();
                }
            }
        };

        onMounted(() => {
            fetchPayments();
            fetchStats();
            fetchStudents();
            fetchCourses();
            window.addEventListener('keydown', handleEscKey);
        });

        onUnmounted(() => {
            window.removeEventListener('keydown', handleEscKey);
        });

        return {
            payments,
            students,
            courses,
            stats,
            filters,
            filteredPayments,
            showModal,
            modalMode,
            loading,
            error,
            successMessage,
            form,
            openAddModal,
            editPayment,
            savePayment,
            updateStatus,
            deletePayment,
            closeModal,
            clearFilters,
            formatDate,
            formatCurrency,
            getStatusClass,
            getStatusSelectClass,
            generateReceipt,
            sendReceiptEmail,
            printReceipt,
            closeReceiptModal,
            showReceiptModal,
            receiptHtml,
            currentReceiptPayment,
            receiptSending
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
