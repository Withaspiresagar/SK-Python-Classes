<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/20 to-purple-50/20">
        <Header />
        
        <!-- Courses Section -->
        <section class="py-8 sm:py-12 lg:py-16">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="text-center mb-8 sm:mb-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl sm:rounded-2xl shadow-xl mb-4 sm:mb-6">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-600 bg-clip-text text-transparent mb-3 sm:mb-4 px-2">
                        Our Courses
                    </h1>
                    <p class="text-sm sm:text-base lg:text-lg text-gray-600 max-w-2xl mx-auto px-2">
                        Explore our comprehensive range of Python programming courses designed to take you from beginner to expert.
                    </p>
                </div>

                <!-- Loading State -->
                <div v-if="loading" class="flex justify-center items-center py-20">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                </div>

                <!-- Courses Grid -->
                <div v-else-if="courses.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <div 
                        v-for="course in courses" 
                        :key="course.id"
                        class="bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
                    >
                        <!-- Course Image/Thumbnail -->
                        <div class="relative h-48 sm:h-56 bg-gradient-to-br from-blue-500 to-indigo-600 overflow-hidden">
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
                            <div class="absolute top-4 right-4">
                                <span class="bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg">
                                    Active
                                </span>
                            </div>
                        </div>

                        <!-- Course Content -->
                        <div class="p-5 sm:p-6">
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">{{ course.name }}</h3>
                            <p class="text-gray-600 text-sm sm:text-base mb-4 course-description">{{ course.description || 'No description available' }}</p>
                            
                            <!-- Course Details -->
                            <div class="space-y-2 mb-4">
                                <div v-if="course.duration_hours" class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ course.duration_hours }} Hours
                                </div>
                                <div v-if="course.level" class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ course.level }}
                                </div>
                            </div>

                            <!-- Price and Enroll Button -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div>
                                    <span class="text-2xl sm:text-3xl font-bold text-blue-600">₹{{ course.price || 0 }}</span>
                                </div>
                                <button 
                                    @click="enrollCourse(course.id)"
                                    class="px-4 sm:px-6 py-2 sm:py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg sm:rounded-xl hover:from-blue-700 hover:to-indigo-700 transition font-semibold text-sm sm:text-base shadow-lg shadow-blue-500/30 hover:shadow-xl transform hover:scale-105 active:scale-95"
                                >
                                    Enroll Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">No Courses Available</h3>
                    <p class="text-gray-600">Check back soon for new courses!</p>
                </div>
            </div>
        </section>

        <Footer />
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import Header from './Header.vue';
import Footer from './Footer.vue';

export default {
    name: 'CoursesPage',
    components: {
        Header,
        Footer
    },
    setup() {
        const router = useRouter();
        const courses = ref([]);
        const loading = ref(true);

        const fetchCourses = async () => {
            try {
                loading.value = true;
                const response = await axios.get('/api/courses');
                if (response.data.success) {
                    // Filter only active courses
                    courses.value = response.data.courses.filter(course => course.status === 'active');
                }
            } catch (error) {
                console.error('Error fetching courses:', error);
            } finally {
                loading.value = false;
            }
        };

        const enrollCourse = (courseId) => {
            // Navigate to inquiry page with course ID as query parameter
            router.push({
                path: '/inquiry',
                query: { course: courseId }
            });
        };

        onMounted(() => {
            fetchCourses();
        });

        return {
            courses,
            loading,
            enrollCourse
        };
    }
};
</script>

<style scoped>
.container {
    max-width: 1280px;
    margin: 0 auto;
}

.course-description {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

