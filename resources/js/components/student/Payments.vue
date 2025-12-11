<template>
    <div class="w-full overflow-hidden space-y-4 sm:space-y-6">
        <!-- Header -->
        <div class="bg-gradient-to-br from-green-500 via-emerald-500 to-teal-500 rounded-2xl shadow-2xl p-4 sm:p-6 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-1">My Payments</h2>
                    <p class="text-xs sm:text-sm text-green-100">View your payment history and receipts</p>
                </div>
                <div class="hidden sm:flex items-center space-x-2">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <div class="bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl shadow-xl p-5 sm:p-6 text-white transform hover:scale-105 transition-all duration-300 border border-green-400/20 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold mb-1">₹{{ formatCurrency(stats.totalPaid) }}</div>
                        <div class="text-green-100 text-xs sm:text-sm font-medium">Total Paid</div>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl shadow-xl p-5 sm:p-6 text-white transform hover:scale-105 transition-all duration-300 border border-yellow-400/20 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold mb-1">₹{{ formatCurrency(stats.pendingAmount) }}</div>
                        <div class="text-yellow-100 text-xs sm:text-sm font-medium">Pending</div>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl shadow-xl p-5 sm:p-6 text-white transform hover:scale-105 transition-all duration-300 border border-blue-400/20 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold mb-1">{{ stats.totalPayments }}</div>
                        <div class="text-blue-100 text-xs sm:text-sm font-medium">Total Payments</div>
                    </div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payments Table -->
        <div class="bg-gradient-to-br from-white via-indigo-50/20 to-purple-50/20 rounded-2xl shadow-xl p-4 sm:p-6 border-2 border-indigo-100">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-1 h-10 bg-gradient-to-b from-indigo-500 to-purple-500 rounded-full"></div>
                    <div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-1">Payment History</h3>
                        <p class="text-xs sm:text-sm text-gray-600 hidden sm:block">All your payment transactions</p>
                    </div>
                </div>
            </div>
            <div v-if="loading" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-500"></div>
                <p class="mt-4 text-gray-600">Loading payments...</p>
            </div>

            <div v-else-if="payments.length === 0" class="text-center py-12">
                <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <p class="text-gray-600 text-lg font-medium">No payment records found.</p>
                <p class="text-gray-500 text-sm mt-2">Your payment history will appear here.</p>
            </div>

            <template v-else>
                <!-- Desktop Table View -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-indigo-200 bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50">
                                <th class="text-left py-4 px-6 text-sm font-bold text-indigo-700">Course</th>
                                <th class="text-left py-4 px-6 text-sm font-bold text-indigo-700">Amount</th>
                                <th class="text-left py-4 px-6 text-sm font-bold text-indigo-700">Payment Method</th>
                                <th class="text-left py-4 px-6 text-sm font-bold text-indigo-700">Status</th>
                                <th class="text-left py-4 px-6 text-sm font-bold text-indigo-700">Date</th>
                                <th class="text-left py-4 px-6 text-sm font-bold text-indigo-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            <tr v-for="payment in payments" :key="payment.id" class="hover:bg-gray-50 transition-colors">
                                <td class="py-5 px-6">
                                    <div class="text-sm font-semibold text-gray-900">{{ payment.course?.name || 'N/A' }}</div>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="text-sm font-bold text-indigo-600">₹{{ payment.amount }}</div>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="text-sm text-gray-700 capitalize">{{ formatPaymentMethod(payment.payment_method) }}</div>
                                </td>
                                <td class="py-5 px-6">
                                    <span :class="getStatusClass(payment.status)" class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm capitalize">
                                        {{ payment.status }}
                                    </span>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="text-sm text-gray-600">{{ formatDate(payment.payment_date) }}</div>
                                </td>
                                <td class="py-5 px-6">
                                    <div v-if="payment.status === 'paid'" class="flex items-center space-x-2">
                                        <button 
                                            @click="viewReceipt(payment.id)"
                                            class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-lg text-xs font-medium hover:from-indigo-600 hover:to-purple-600 transition shadow-sm"
                                            title="View Receipt"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </button>
                                        <button 
                                            @click="downloadReceipt(payment.id)"
                                            :disabled="downloadingId === payment.id"
                                            class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg text-xs font-medium hover:from-green-600 hover:to-emerald-600 transition shadow-sm disabled:opacity-50 disabled:cursor-not-allowed"
                                            title="Download Receipt"
                                        >
                                            <svg v-if="downloadingId !== payment.id" class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <svg v-else class="w-4 h-4 mr-1 animate-spin" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            {{ downloadingId === payment.id ? 'Downloading...' : 'Download' }}
                                        </button>
                                    </div>
                                    <span v-else class="text-gray-400 text-sm">-</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="lg:hidden space-y-4">
                    <div v-for="payment in payments" :key="payment.id" class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-xl shadow-lg p-4 border-2 border-indigo-100 hover:border-indigo-300 hover:shadow-xl transition-all relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-indigo-100/40 to-purple-100/40 rounded-full -mr-12 -mt-12 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 mb-1">{{ payment.course?.name || 'N/A' }}</h3>
                                    <p class="text-xs text-indigo-600 font-medium">{{ formatDate(payment.payment_date) }}</p>
                                </div>
                                <span :class="getStatusClass(payment.status)" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold shadow-sm capitalize">
                                    {{ payment.status }}
                                </span>
                            </div>
                            <div class="space-y-2 mb-3">
                                <div class="flex justify-between items-center p-2 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg border border-indigo-100">
                                    <span class="text-sm text-indigo-700 font-semibold">Amount:</span>
                                    <span class="text-sm font-bold text-indigo-600">₹{{ payment.amount }}</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg border border-blue-100">
                                    <span class="text-sm text-blue-700 font-semibold">Payment Method:</span>
                                    <span class="text-sm text-blue-800 font-medium capitalize">{{ formatPaymentMethod(payment.payment_method) }}</span>
                                </div>
                            </div>
                            <div v-if="payment.status === 'paid'" class="pt-3 border-t border-indigo-200 flex gap-2">
                            <button 
                                @click="viewReceipt(payment.id)"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-lg text-sm font-medium hover:from-indigo-600 hover:to-purple-600 transition shadow-sm"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View Receipt
                            </button>
                            <button 
                                @click="downloadReceipt(payment.id)"
                                :disabled="downloadingId === payment.id"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg text-sm font-medium hover:from-green-600 hover:to-emerald-600 transition shadow-sm disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <svg v-if="downloadingId !== payment.id" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <svg v-else class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ downloadingId === payment.id ? 'Downloading...' : 'Download' }}
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- View Receipt Modal -->
        <div v-if="showReceiptModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" @click.self="closeReceiptModal">
            <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
                <div class="sticky top-0 bg-gradient-to-r from-indigo-500 to-purple-500 px-6 py-4 flex items-center justify-between rounded-t-2xl">
                    <h3 class="text-xl font-bold text-white">Payment Receipt</h3>
                    <button @click="closeReceiptModal" class="text-white hover:text-gray-200 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <div v-if="receiptLoading" class="text-center py-12">
                        <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-500"></div>
                        <p class="mt-4 text-gray-600">Loading receipt...</p>
                    </div>
                    <div v-else-if="receiptHtml" v-html="receiptHtml" class="receipt-content"></div>
                    <div v-if="currentReceiptPayment && !receiptLoading" class="mt-6 flex flex-col sm:flex-row gap-3">
                        <button 
                            @click="printReceipt"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl text-sm font-semibold hover:from-indigo-600 hover:to-purple-600 transition-all shadow-lg flex items-center justify-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Print Receipt
                        </button>
                        <button 
                            @click="downloadReceipt(currentReceiptPayment.id)"
                            :disabled="downloadingId === currentReceiptPayment.id"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl text-sm font-semibold hover:from-green-600 hover:to-emerald-600 transition-all shadow-lg disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                        >
                            <svg v-if="downloadingId !== currentReceiptPayment.id" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <svg v-else class="w-5 h-5 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ downloadingId === currentReceiptPayment.id ? 'Downloading...' : 'Download PDF' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'StudentPayments',
    setup() {
        const payments = ref([]);
        const stats = ref({
            totalPaid: 0,
            pendingAmount: 0,
            totalPayments: 0
        });
        const loading = ref(true);
        const downloadingId = ref(null);
        const showReceiptModal = ref(false);
        const receiptHtml = ref('');
        const receiptLoading = ref(false);
        const currentReceiptPayment = ref(null);

        const fetchPayments = async () => {
            try {
                loading.value = true;
                const response = await axios.get('/api/student/payments');
                if (response.data.success) {
                    payments.value = response.data.payments || [];
                    stats.value = response.data.stats || stats.value;
                }
            } catch (error) {
                console.error('Error fetching payments:', error);
            } finally {
                loading.value = false;
            }
        };

        const formatCurrency = (amount) => {
            return new Intl.NumberFormat('en-IN').format(amount || 0);
        };

        const formatDate = (dateString) => {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-IN', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            });
        };

        const formatPaymentMethod = (method) => {
            if (!method) return 'N/A';
            return method.split('_').map(word => 
                word.charAt(0).toUpperCase() + word.slice(1)
            ).join(' ');
        };

        const getStatusClass = (status) => {
            const classes = {
                'paid': 'bg-gradient-to-r from-green-400 to-emerald-400 text-white',
                'pending': 'bg-gradient-to-r from-yellow-400 to-orange-400 text-white',
                'failed': 'bg-gradient-to-r from-red-400 to-pink-400 text-white',
                'refunded': 'bg-gradient-to-r from-gray-400 to-gray-500 text-white'
            };
            return classes[status] || 'bg-gray-100 text-gray-800';
        };

        const viewReceipt = async (paymentId) => {
            try {
                receiptLoading.value = true;
                showReceiptModal.value = true;
                const response = await axios.get(`/api/student/payments/${paymentId}/receipt`);
                if (response.data.success) {
                    receiptHtml.value = response.data.html;
                    currentReceiptPayment.value = response.data.payment;
                } else {
                    alert(response.data.message || 'Failed to load receipt');
                    showReceiptModal.value = false;
                }
            } catch (error) {
                console.error('Error loading receipt:', error);
                alert('Failed to load receipt. Please try again.');
                showReceiptModal.value = false;
            } finally {
                receiptLoading.value = false;
            }
        };

        const closeReceiptModal = () => {
            showReceiptModal.value = false;
            receiptHtml.value = '';
            currentReceiptPayment.value = null;
        };

        const printReceipt = () => {
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Payment Receipt</title>
                        <style>
                            body { margin: 0; padding: 20px; font-family: Arial, sans-serif; }
                            @media print {
                                body { margin: 0; }
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

        const downloadReceipt = async (paymentId) => {
            try {
                downloadingId.value = paymentId;
                
                // First get the receipt HTML
                const receiptResponse = await axios.get(`/api/student/payments/${paymentId}/receipt`);
                if (!receiptResponse.data.success) {
                    throw new Error('Failed to load receipt');
                }

                // Create a new window with the receipt HTML
                const printWindow = window.open('', '_blank');
                printWindow.document.write(`
                    <html>
                        <head>
                            <title>Payment Receipt</title>
                            <style>
                                body { margin: 0; padding: 20px; font-family: Arial, sans-serif; }
                                @media print {
                                    body { margin: 0; }
                                }
                            </style>
                        </head>
                        <body>
                            ${receiptResponse.data.html}
                        </body>
                    </html>
                `);
                printWindow.document.close();
                
                // Wait a bit then trigger print/save as PDF
                setTimeout(() => {
                    printWindow.focus();
                    printWindow.print();
                    // Close the window after a delay
                    setTimeout(() => {
                        printWindow.close();
                    }, 1000);
                }, 250);
            } catch (error) {
                console.error('Error downloading receipt:', error);
                alert('Failed to download receipt. Please try again.');
            } finally {
                downloadingId.value = null;
            }
        };

        onMounted(() => {
            fetchPayments();
        });

        return {
            payments,
            stats,
            loading,
            downloadingId,
            showReceiptModal,
            receiptHtml,
            receiptLoading,
            currentReceiptPayment,
            formatCurrency,
            formatDate,
            formatPaymentMethod,
            getStatusClass,
            viewReceipt,
            closeReceiptModal,
            printReceipt,
            downloadReceipt
        };
    }
};
</script>

<style scoped>
.receipt-content {
    color: #1f2937;
}

.receipt-content :deep(table) {
    width: 100%;
    border-collapse: collapse;
}

.receipt-content :deep(th),
.receipt-content :deep(td) {
    padding: 0.5rem;
    border: 1px solid #d1d5db;
}

.receipt-content :deep(th) {
    background-color: #f3f4f6;
    font-weight: 600;
}
</style>
