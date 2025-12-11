<template>
    <div class="w-full overflow-hidden space-y-4 sm:space-y-6">
        <!-- Header -->
        <div class="bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-2xl shadow-2xl p-4 sm:p-6 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-1">My Certificates</h2>
                    <p class="text-xs sm:text-sm text-purple-100">View and download your certificates</p>
                </div>
                <div class="hidden sm:flex items-center space-x-2">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Card -->
        <div class="bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-2xl shadow-xl p-5 sm:p-6 text-white transform hover:scale-105 transition-all duration-300 border border-purple-400/20 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <div class="text-2xl sm:text-3xl font-bold mb-1">{{ certificates.length }}</div>
                    <div class="text-purple-100 text-xs sm:text-sm font-medium">Total Certificates</div>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Certificates List -->
        <div v-if="loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-500"></div>
            <p class="mt-4 text-gray-600">Loading certificates...</p>
        </div>

        <div v-else-if="certificates.length === 0" class="bg-gradient-to-br from-white via-purple-50/30 to-pink-50/30 rounded-2xl shadow-xl p-12 text-center border-2 border-purple-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-purple-100/40 to-pink-100/40 rounded-full -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-rose-100/40 to-pink-100/40 rounded-full -ml-16 -mb-16"></div>
            <div class="relative z-10">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <p class="text-gray-700 text-lg font-bold">No certificates issued yet.</p>
                <p class="text-gray-600 text-sm mt-2">Complete a course to receive your certificate.</p>
            </div>
        </div>

        <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <div 
                v-for="certificate in certificates" 
                :key="certificate.id"
                class="bg-gradient-to-br from-white via-purple-50/30 to-pink-50/30 rounded-2xl shadow-xl p-5 sm:p-6 border-2 border-purple-100 hover:border-purple-300 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden group"
            >
                <!-- Decorative gradient overlays -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-purple-200/40 via-pink-200/40 to-rose-200/40 rounded-full -mr-20 -mt-20 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-indigo-100/30 to-purple-100/30 rounded-full -ml-16 -mb-16 group-hover:scale-150 transition-transform duration-500"></div>
                
                <div class="relative z-10">
                    <!-- Certificate Icon -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-xl flex items-center justify-center shadow-lg mb-3">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <span :class="getStatusClass(certificate.status)" class="px-3 py-1.5 rounded-full text-xs font-bold shadow-sm capitalize flex-shrink-0">
                            {{ certificate.status }}
                        </span>
                    </div>

                    <!-- Course Name -->
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2 line-clamp-2 min-h-[3rem]">{{ certificate.course?.name || 'Course Certificate' }}</h3>
                    
                    <!-- Certificate Number -->
                    <div class="mb-4 p-3 bg-gradient-to-r from-purple-100 via-pink-100 to-rose-100 rounded-lg border-2 border-purple-200 shadow-sm">
                        <p class="text-xs text-purple-700 mb-1 font-bold">Certificate Number</p>
                        <p class="text-sm font-mono font-bold text-purple-900 break-all">{{ certificate.certificate_number }}</p>
                    </div>

                    <!-- Date Information -->
                    <div class="space-y-2.5 mb-5">
                        <div class="flex items-center p-2.5 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg border border-indigo-100">
                            <svg class="w-5 h-5 mr-2.5 text-indigo-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <span class="text-indigo-700 text-xs font-semibold">Issued:</span>
                                <span class="ml-1 font-bold text-indigo-900">{{ formatDate(certificate.issue_date) }}</span>
                            </div>
                        </div>
                        <div v-if="certificate.expiry_date" class="flex items-center p-2.5 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg border border-blue-100">
                            <svg class="w-5 h-5 mr-2.5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <span class="text-blue-700 text-xs font-semibold">Expires:</span>
                                <span class="ml-1 font-bold text-blue-900">{{ formatDate(certificate.expiry_date) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-2.5">
                        <button 
                            @click="downloadCertificate(certificate.id)"
                            :disabled="downloadingId === certificate.id"
                            class="flex-1 px-4 py-2.5 bg-gradient-to-r from-purple-500 via-pink-500 to-rose-500 text-white rounded-xl text-sm font-semibold hover:from-purple-600 hover:via-pink-600 hover:to-rose-600 transition-all shadow-lg shadow-purple-500/30 hover:shadow-xl hover:shadow-purple-500/40 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                        >
                            <svg v-if="downloadingId !== certificate.id" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <svg v-else class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>{{ downloadingId === certificate.id ? 'Downloading...' : 'Download PDF' }}</span>
                        </button>
                        <button 
                            @click="viewCertificate(certificate)"
                            class="px-4 py-2.5 bg-white border-2 border-purple-200 text-purple-700 rounded-xl text-sm font-semibold hover:bg-purple-50 hover:border-purple-400 transition-all flex items-center justify-center"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Certificate Modal -->
        <div v-if="showViewModal" class="fixed inset-0 bg-black/70 backdrop-blur-md z-50 flex items-center justify-center p-4" @click.self="closeViewModal">
            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border-2 border-purple-100">
                <div class="sticky top-0 bg-gradient-to-r from-purple-500 via-pink-500 to-rose-500 px-6 py-4 flex items-center justify-between rounded-t-2xl">
                    <h3 class="text-xl font-bold text-white">Certificate Details</h3>
                    <button @click="closeViewModal" class="text-white hover:text-purple-200 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div v-if="viewingCertificate" class="p-6 bg-gradient-to-br from-white via-purple-50/20 to-pink-50/20">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-2">{{ viewingCertificate.course?.name || 'Course Certificate' }}</h4>
                        <p class="text-gray-600 font-medium">Certificate of Completion</p>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="bg-gradient-to-r from-purple-100 via-pink-100 to-rose-100 rounded-xl p-4 border-2 border-purple-200 shadow-sm">
                            <p class="text-sm text-purple-700 mb-1 font-bold">Certificate Number</p>
                            <p class="text-lg font-mono font-bold text-purple-900">{{ viewingCertificate.certificate_number }}</p>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-4 border-2 border-indigo-200 shadow-sm">
                                <p class="text-sm text-indigo-700 mb-1 font-bold">Issue Date</p>
                                <p class="text-base font-semibold text-indigo-900">{{ formatDate(viewingCertificate.issue_date) }}</p>
                            </div>
                            <div v-if="viewingCertificate.expiry_date" class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-4 border-2 border-blue-200 shadow-sm">
                                <p class="text-sm text-blue-700 mb-1 font-bold">Expiry Date</p>
                                <p class="text-base font-semibold text-blue-900">{{ formatDate(viewingCertificate.expiry_date) }}</p>
                            </div>
                        </div>
                        
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4 border-2 border-green-200 shadow-sm">
                            <p class="text-sm text-green-700 mb-1 font-bold">Status</p>
                            <span :class="getStatusClass(viewingCertificate.status)" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold shadow-sm capitalize">
                                {{ viewingCertificate.status }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex flex-col sm:flex-row gap-3">
                        <button 
                            @click="downloadCertificate(viewingCertificate.id)"
                            :disabled="downloadingId === viewingCertificate.id"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-purple-500 via-pink-500 to-rose-500 text-white rounded-xl text-sm font-semibold hover:from-purple-600 hover:via-pink-600 hover:to-rose-600 transition-all shadow-lg shadow-purple-500/30 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                        >
                            <svg v-if="downloadingId !== viewingCertificate.id" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <svg v-else class="w-5 h-5 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>{{ downloadingId === viewingCertificate.id ? 'Downloading...' : 'Download PDF' }}</span>
                        </button>
                        <button 
                            @click="verifyCertificate(viewingCertificate.certificate_number)"
                            class="px-4 py-3 bg-white border-2 border-purple-500 text-purple-600 rounded-xl text-sm font-semibold hover:bg-purple-50 transition-all flex items-center justify-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Verify Certificate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
    name: 'StudentCertificates',
    setup() {
        const router = useRouter();
        const certificates = ref([]);
        const loading = ref(true);
        const downloadingId = ref(null);
        const showViewModal = ref(false);
        const viewingCertificate = ref(null);

        const fetchCertificates = async () => {
            try {
                loading.value = true;
                const response = await axios.get('/api/student/certificates');
                if (response.data.success) {
                    certificates.value = response.data.certificates || [];
                }
            } catch (error) {
                console.error('Error fetching certificates:', error);
            } finally {
                loading.value = false;
            }
        };

        const formatDate = (dateString) => {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-IN', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
        };

        const getStatusClass = (status) => {
            const classes = {
                'active': 'bg-gradient-to-r from-green-400 to-emerald-400 text-white',
                'revoked': 'bg-gradient-to-r from-red-400 to-pink-400 text-white'
            };
            return classes[status] || 'bg-gray-100 text-gray-800';
        };

        const downloadCertificate = async (certificateId) => {
            try {
                downloadingId.value = certificateId;
                const response = await axios.get(`/api/student/certificates/${certificateId}/download`, {
                    responseType: 'blob'
                });
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                
                // Get certificate number for filename
                const certificate = certificates.value.find(c => c.id === certificateId);
                const filename = certificate ? `certificate-${certificate.certificate_number}.pdf` : `certificate-${certificateId}.pdf`;
                
                link.setAttribute('download', filename);
                document.body.appendChild(link);
                link.click();
                link.remove();
                window.URL.revokeObjectURL(url);
            } catch (error) {
                console.error('Error downloading certificate:', error);
                alert('Failed to download certificate. Please try again.');
            } finally {
                downloadingId.value = null;
            }
        };

        const viewCertificate = (certificate) => {
            viewingCertificate.value = certificate;
            showViewModal.value = true;
        };

        const closeViewModal = () => {
            showViewModal.value = false;
            viewingCertificate.value = null;
        };

        const verifyCertificate = (certificateNumber) => {
            router.push(`/certificateverify/${certificateNumber}`);
            closeViewModal();
        };

        onMounted(() => {
            fetchCertificates();
        });

        return {
            certificates,
            loading,
            downloadingId,
            showViewModal,
            viewingCertificate,
            formatDate,
            getStatusClass,
            downloadCertificate,
            viewCertificate,
            closeViewModal,
            verifyCertificate
        };
    }
};
</script>
