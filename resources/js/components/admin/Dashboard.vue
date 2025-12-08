<template>
    <div class="w-full overflow-hidden">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8 w-full">
            <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl shadow-lg p-4 sm:p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-2xl sm:text-3xl font-bold">{{ stats.totalStudents }}</div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-blue-100 mt-2 font-medium text-sm sm:text-base">Total Students</div>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-3xl font-bold">{{ stats.totalCourses }}</div>
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                <div class="text-green-100 mt-2 font-medium">Total Courses</div>
            </div>
            <div class="bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-3xl font-bold">{{ stats.activeClasses }}</div>
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-yellow-100 mt-2 font-medium">Active Classes</div>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-3xl font-bold">₹{{ (stats.totalRevenue / 100000).toFixed(1) }}L</div>
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-purple-100 mt-2 font-medium">Total Revenue</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg p-4 sm:p-6 mb-6 sm:mb-8 border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                <button class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition font-medium shadow-lg shadow-blue-500/30 transform hover:scale-105 text-sm sm:text-base">
                    Add New Student
                </button>
                <button class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-green-600 hover:to-emerald-600 transition font-medium shadow-lg shadow-green-500/30 transform hover:scale-105 text-sm sm:text-base">
                    Create Course
                </button>
                <button class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:from-purple-600 hover:to-pink-600 transition font-medium shadow-lg shadow-purple-500/30 transform hover:scale-105 text-sm sm:text-base">
                    View Reports
                </button>
            </div>
        </div>

        <!-- Recent Students -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg p-4 sm:p-6 border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto -mx-4 sm:mx-0 lg:mx-0 w-full">
                <div class="inline-block w-full align-middle">
                    <table class="w-full divide-y divide-gray-200 table-auto">
                        <thead class="bg-gradient-to-r from-blue-50 to-cyan-50">
                            <tr>
                                <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-gray-700">Name</th>
                                <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-gray-700 hidden sm:table-cell">Email</th>
                                <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-gray-700">Course</th>
                                <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-3 sm:px-4 py-2 sm:py-3 text-left text-xs sm:text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="student in recentStudents" :key="student.id" class="hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-cyan-50/50 transition">
                                <td class="px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm font-medium text-gray-900">{{ student.name }}</td>
                                <td class="px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm text-gray-600 hidden sm:table-cell">{{ student.email }}</td>
                                <td class="px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm text-gray-600">{{ student.course }}</td>
                                <td class="px-3 sm:px-4 py-2 sm:py-3">
                                    <span :class="student.status === 'Active' ? 'bg-gradient-to-r from-green-400 to-emerald-400 text-white' : 'bg-gradient-to-r from-gray-300 to-gray-400 text-white'" class="px-2 sm:px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                                        {{ student.status }}
                                    </span>
                                </td>
                                <td class="px-3 sm:px-4 py-2 sm:py-3">
                                    <button class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-2 sm:px-3 py-1 rounded-lg hover:from-blue-600 hover:to-cyan-600 text-xs sm:text-sm font-medium shadow-sm transition">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
    name: 'Dashboard',
    setup() {
        const stats = ref({
            totalStudents: 0,
            totalCourses: 0,
            activeClasses: 0,
            totalRevenue: 0
        });

        const recentStudents = ref([
            { id: 1, name: 'John Doe', email: 'john@example.com', course: 'Python Basics', status: 'Active' },
            { id: 2, name: 'Jane Smith', email: 'jane@example.com', course: 'Django Web Dev', status: 'Active' },
            { id: 3, name: 'Bob Johnson', email: 'bob@example.com', course: 'Data Science', status: 'Inactive' },
        ]);

        onMounted(() => {
            fetchStats();
        });

        const fetchStats = async () => {
            try {
                stats.value = {
                    totalStudents: 150,
                    totalCourses: 6,
                    activeClasses: 12,
                    totalRevenue: 1250000
                };
            } catch (error) {
                console.error('Error fetching stats:', error);
            }
        };

        return {
            stats,
            recentStudents
        };
    }
};
</script>

