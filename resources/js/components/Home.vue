<template>
    <div class="home-page">
        <Header />
        
        <!-- Hero Section -->
        <section id="home" class="hero-section relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800"></div>
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                <div class="absolute top-40 right-10 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-8 left-1/2 w-72 h-72 bg-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
            </div>
            <div class="container mx-auto px-4 py-32 md:py-40 relative z-10">
                <div class="text-center fade-in-up">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white leading-tight">
                        Master <span class="bg-gradient-to-r from-yellow-300 to-pink-300 bg-clip-text text-transparent">Programming</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-2xl mx-auto">
                        Learn Python, Web Development, Data Science, and more from industry experts
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <router-link 
                            to="/courses"
                            class="px-8 py-4 bg-white text-blue-600 rounded-lg font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-xl animate-pulse-once"
                        >
                            Explore Courses
                        </router-link>
                        <router-link 
                            to="/contact"
                            class="px-8 py-4 border-2 border-white text-white rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-600 transform hover:scale-105 transition-all duration-300"
                        >
                            Get In Touch
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0">
                <svg class="w-full h-16 text-white" fill="currentColor" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0 C300,100 600,50 900,70 C1050,80 1150,60 1200,50 L1200,120 L0,120 Z"></path>
                </svg>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                    <div 
                        v-for="(stat, index) in stats" 
                        :key="index"
                        class="stat-card"
                        :class="index % 2 === 0 ? 'fade-in-left' : 'fade-in-right'"
                    >
                        <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 hover:rotate-1">
                            <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2 counter-animate">{{ stat.value }}</div>
                            <div class="text-sm md:text-base text-gray-600 font-semibold">{{ stat.label }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Programming Languages Section -->
        <section class="languages-section py-20 bg-gradient-to-b from-white to-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Learn <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Programming Languages</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Master the most in-demand programming languages and technologies used in the industry today
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div 
                        v-for="(lang, index) in programmingLanguages" 
                        :key="index"
                        class="lang-card"
                        :class="getAnimationClass(index)"
                    >
                        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:rotate-1 border-2 border-transparent hover:border-blue-500 group">
                            <div class="text-6xl mb-4 text-center transform group-hover:scale-110 transition-transform duration-300">{{ lang.icon }}</div>
                            <h3 class="text-xl font-bold mb-2 text-center text-gray-800 group-hover:text-blue-600 transition-colors">{{ lang.name }}</h3>
                            <p class="text-gray-600 text-sm text-center mb-4">{{ lang.description }}</p>
                            <div class="flex items-center justify-center">
                                <span class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-600 font-semibold">{{ lang.level }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Technologies Section -->
        <section class="technologies-section py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Modern <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Technologies</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Stay ahead with cutting-edge technologies and frameworks
                    </p>
                </div>
                <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <div 
                        v-for="(tech, index) in technologies" 
                        :key="index"
                        class="tech-card"
                        :class="getAnimationClass(index)"
                    >
                        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-indigo-100 group">
                            <div class="text-4xl mb-3 text-center">{{ tech.icon }}</div>
                            <h3 class="text-lg font-bold text-center text-gray-800 group-hover:text-indigo-600 transition-colors">{{ tech.name }}</h3>
                            <p class="text-xs text-gray-600 text-center mt-2">{{ tech.category }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about-section py-20 bg-gradient-to-b from-gray-50 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        About <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">SK Python Classes</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        We are a premier coaching institute dedicated to teaching programming 
                        from basics to advanced levels. Our expert instructors provide hands-on training 
                        and real-world project experience.
                    </p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div 
                        v-for="(feature, index) in aboutFeatures" 
                        :key="index"
                        class="feature-card"
                        :class="index % 3 === 0 ? 'fade-in-left' : index % 3 === 1 ? 'fade-in-up' : 'fade-in-right'"
                    >
                        <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 mx-auto transform group-hover:rotate-12 transition-transform">
                                <div class="text-3xl">{{ feature.icon }}</div>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-center text-gray-800 group-hover:text-blue-600 transition-colors">{{ feature.title }}</h3>
                            <p class="text-gray-600 text-center">{{ feature.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Learning Path Section -->
        <section class="learning-path-section py-20 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Your <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Learning Path</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Follow a structured path from beginner to expert
                    </p>
                </div>
                <div class="max-w-4xl mx-auto">
                    <div 
                        v-for="(step, index) in learningPath" 
                        :key="index"
                        class="path-step mb-8"
                        :class="index % 2 === 0 ? 'fade-in-left' : 'fade-in-right'"
                    >
                        <div class="flex flex-col md:flex-row items-center gap-6 bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                            <div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                {{ step.number }}
                            </div>
                            <div class="flex-grow text-center md:text-left">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ step.title }}</h3>
                                <p class="text-gray-600">{{ step.description }}</p>
                            </div>
                            <div class="text-4xl">{{ step.icon }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Courses Section -->
        <section id="courses" class="courses-section py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Our <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Courses</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Choose from our comprehensive range of courses designed for all skill levels
                    </p>
                </div>
                <div v-if="loading" class="text-center py-12">
                    <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                </div>
                <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div 
                        v-for="(course, index) in courses" 
                        :key="course.id"
                        class="course-card"
                        :class="index % 3 === 0 ? 'fade-in-left' : index % 3 === 1 ? 'fade-in-up' : 'fade-in-right'"
                    >
                        <div class="bg-white border-2 border-gray-100 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                            <div class="h-48 bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity"></div>
                                <div class="text-6xl text-white opacity-80 transform group-hover:scale-110 transition-transform">🐍</div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-bold mb-3 text-gray-800 group-hover:text-blue-600 transition-colors">{{ course.name }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ course.description }}</p>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-2xl font-bold text-blue-600">₹{{ course.price }}</span>
                                    <span v-if="course.duration_hours" class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                                        {{ course.duration_hours }}h
                                    </span>
                                </div>
                                <router-link 
                                    to="/courses"
                                    class="block w-full text-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105"
                                >
                                    View Details
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="!loading && courses.length === 0" class="text-center py-12">
                    <p class="text-gray-600 text-lg">No courses available at the moment.</p>
                </div>
                <div v-if="!loading && courses.length > 0" class="text-center mt-12 fade-in-up">
                    <router-link 
                        to="/courses"
                        class="inline-block px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg font-semibold text-lg hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg"
                    >
                        View All Courses
                    </router-link>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section id="features" class="why-choose-section py-20 bg-gradient-to-b from-gray-50 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Why Choose <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Us?</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        We provide the best learning experience with industry-leading features
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div 
                        v-for="(feature, index) in features" 
                        :key="index"
                        class="feature-card"
                        :class="index % 3 === 0 ? 'fade-in-left' : index % 3 === 1 ? 'fade-in-up' : 'fade-in-right'"
                    >
                        <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-blue-600 group">
                            <div class="flex items-start">
                                <div class="text-4xl mr-4 flex-shrink-0 transform group-hover:scale-110 transition-transform">{{ feature.icon }}</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-3 text-gray-800 group-hover:text-blue-600 transition-colors">{{ feature.title }}</h3>
                                    <p class="text-gray-600 leading-relaxed">{{ feature.description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials-section py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        What Our <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Students Say</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Hear from our successful students who transformed their careers
                    </p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div 
                        v-for="(testimonial, index) in testimonials" 
                        :key="index"
                        class="testimonial-card"
                        :class="index % 3 === 0 ? 'fade-in-left' : index % 3 === 1 ? 'fade-in-up' : 'fade-in-right'"
                    >
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-blue-100">
                            <div class="flex items-center mb-4">
                                <div class="text-4xl mr-3">{{ testimonial.icon }}</div>
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ testimonial.name }}</h4>
                                    <p class="text-sm text-gray-600">{{ testimonial.role }}</p>
                                </div>
                            </div>
                            <p class="text-gray-700 italic mb-4">"{{ testimonial.quote }}"</p>
                            <div class="flex text-yellow-400">
                                <span v-for="i in 5" :key="i">⭐</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section py-20 bg-gradient-to-r from-blue-600 via-indigo-700 to-purple-800 text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-multiply filter blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-multiply filter blur-3xl"></div>
            </div>
            <div class="container mx-auto px-4 text-center relative z-10 fade-in-up">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Start Your Journey?</h2>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                    Join thousands of students who have transformed their careers with our programming courses
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <router-link 
                        to="/courses"
                        class="px-8 py-4 bg-white text-blue-600 rounded-lg font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-xl"
                    >
                        Browse Courses
                    </router-link>
                    <router-link 
                        to="/contact"
                        class="px-8 py-4 border-2 border-white text-white rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-600 transform hover:scale-105 transition-all duration-300"
                    >
                        Contact Us
                    </router-link>
                </div>
            </div>
        </section>
        
        <Footer />
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Header from './Header.vue';
import Footer from './Footer.vue';

export default {
    name: 'Home',
    components: {
        Header,
        Footer
    },
    setup() {
        const courses = ref([]);
        const loading = ref(true);

        const stats = ref([
            { value: '1000+', label: 'Students Enrolled' },
            { value: '50+', label: 'Expert Instructors' },
            { value: '100+', label: 'Courses Available' },
            { value: '95%', label: 'Success Rate' }
        ]);

        const programmingLanguages = ref([
            { icon: '🐍', name: 'Python', description: 'Versatile and powerful', level: 'Beginner to Advanced' },
            { icon: '☕', name: 'Java', description: 'Enterprise applications', level: 'Intermediate' },
            { icon: '💎', name: 'Ruby', description: 'Elegant and productive', level: 'Intermediate' },
            { icon: '🟢', name: 'Node.js', description: 'Server-side JavaScript', level: 'Intermediate' },
            { icon: '⚡', name: 'C++', description: 'High performance', level: 'Advanced' },
            { icon: '🔷', name: 'C#', description: 'Microsoft ecosystem', level: 'Intermediate' },
            { icon: '📘', name: 'PHP', description: 'Web development', level: 'Beginner' },
            { icon: '🟡', name: 'JavaScript', description: 'Frontend & Backend', level: 'Beginner to Advanced' }
        ]);

        const technologies = ref([
            { icon: '⚛️', name: 'React', category: 'Frontend' },
            { icon: '🎨', name: 'Vue.js', category: 'Frontend' },
            { icon: '🅰️', name: 'Angular', category: 'Frontend' },
            { icon: '🚀', name: 'Django', category: 'Backend' },
            { icon: '🌐', name: 'Flask', category: 'Backend' },
            { icon: '🗄️', name: 'PostgreSQL', category: 'Database' },
            { icon: '🍃', name: 'MongoDB', category: 'Database' },
            { icon: '🐳', name: 'Docker', category: 'DevOps' },
            { icon: '☸️', name: 'Kubernetes', category: 'DevOps' },
            { icon: '📊', name: 'TensorFlow', category: 'AI/ML' },
            { icon: '🧠', name: 'PyTorch', category: 'AI/ML' },
            { icon: '📈', name: 'Pandas', category: 'Data Science' }
        ]);

        const aboutFeatures = ref([
            {
                icon: '📚',
                title: 'Expert Instructors',
                description: 'Learn from industry professionals with years of experience'
            },
            {
                icon: '💻',
                title: 'Hands-on Projects',
                description: 'Build real-world applications and enhance your portfolio'
            },
            {
                icon: '🎯',
                title: 'Career Support',
                description: 'Get placement assistance and career guidance'
            }
        ]);

        const learningPath = ref([
            { number: '1', icon: '🎓', title: 'Start with Basics', description: 'Learn fundamental programming concepts and syntax' },
            { number: '2', icon: '📖', title: 'Build Projects', description: 'Apply your knowledge by building real-world projects' },
            { number: '3', icon: '🚀', title: 'Advanced Topics', description: 'Master advanced concepts and frameworks' },
            { number: '4', icon: '💼', title: 'Get Hired', description: 'Land your dream job with our placement assistance' }
        ]);

        const features = ref([
            {
                icon: '✅',
                title: 'Expert Faculty',
                description: 'Learn from industry experts with years of real-world experience in programming.'
            },
            {
                icon: '📖',
                title: 'Comprehensive Curriculum',
                description: 'Well-structured courses covering everything from basics to advanced topics.'
            },
            {
                icon: '🖥️',
                title: 'Live Projects',
                description: 'Work on real-world projects to build a strong portfolio and gain practical experience.'
            },
            {
                icon: '👥',
                title: 'Small Batch Size',
                description: 'Personalized attention with small class sizes for better learning experience.'
            },
            {
                icon: '📜',
                title: 'Certification',
                description: 'Get industry-recognized certificates upon course completion.'
            },
            {
                icon: '💼',
                title: 'Placement Assistance',
                description: 'We help you land your dream job with resume building and interview preparation.'
            }
        ]);

        const testimonials = ref([
            {
                icon: '👨‍💼',
                name: 'Rajesh Kumar',
                role: 'Software Developer',
                quote: 'The Python course transformed my career. I got placed in a top tech company!'
            },
            {
                icon: '👩‍💻',
                name: 'Priya Sharma',
                role: 'Data Scientist',
                quote: 'Best learning experience! The instructors are amazing and the projects are real-world.'
            },
            {
                icon: '👨‍🎓',
                name: 'Amit Patel',
                role: 'Full Stack Developer',
                quote: 'From zero to hero! The comprehensive curriculum helped me master web development.'
            }
        ]);

        const getAnimationClass = (index) => {
            const mod = index % 4;
            if (mod === 0) return 'fade-in-left';
            if (mod === 1) return 'fade-in-up';
            if (mod === 2) return 'fade-in-right';
            return 'fade-in-up';
        };

        const fetchCourses = async () => {
            try {
                loading.value = true;
                const response = await axios.get('/api/courses');
                if (response.data.success) {
                    courses.value = response.data.courses
                        .filter(course => course.status === 'active')
                        .slice(0, 6);
                }
            } catch (error) {
                console.error('Error fetching courses:', error);
            } finally {
                loading.value = false;
            }
        };

        const setupScrollAnimations = () => {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                    }
                });
            }, observerOptions);

            const animatedElements = document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right, .stat-card, .feature-card, .course-card, .lang-card, .tech-card, .path-step, .testimonial-card');
            animatedElements.forEach(el => observer.observe(el));
        };

        onMounted(() => {
            fetchCourses();
            setTimeout(() => {
                setupScrollAnimations();
            }, 100);
        });

        return {
            courses,
            loading,
            stats,
            programmingLanguages,
            technologies,
            aboutFeatures,
            learningPath,
            features,
            testimonials,
            getAnimationClass
        };
    }
};
</script>

<style scoped>
.home-page {
    min-height: 100vh;
    overflow-x: hidden;
}

.container {
    max-width: 1280px;
    margin: 0 auto;
}

/* Hero Animations */
@keyframes blob {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

@keyframes pulse-once {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.animate-pulse-once {
    animation: pulse-once 2s ease-in-out infinite;
}

/* Scroll Animations */
.fade-in-up,
.fade-in-left,
.fade-in-right {
    opacity: 0;
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.fade-in-up {
    transform: translateY(40px);
}

.fade-in-left {
    transform: translateX(-60px);
}

.fade-in-right {
    transform: translateX(60px);
}

.fade-in-up.animate,
.fade-in-left.animate,
.fade-in-right.animate {
    opacity: 1;
    transform: translate(0, 0);
}

.stat-card,
.feature-card,
.course-card,
.lang-card,
.tech-card,
.path-step,
.testimonial-card {
    opacity: 0;
    transition: opacity 1s ease-out, transform 1s ease-out;
}

.stat-card.animate,
.feature-card.animate,
.course-card.animate,
.lang-card.animate,
.tech-card.animate,
.path-step.animate,
.testimonial-card.animate {
    opacity: 1;
    transform: translate(0, 0);
}

/* Counter Animation */
@keyframes countUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.counter-animate {
    animation: countUp 1s ease-out;
}

/* Line clamp utility */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Hero section initial animation */
.hero-section .fade-in-up {
    animation: fadeInUp 1s ease-out forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Staggered animation delays */
.lang-card:nth-child(1) { transition-delay: 0.1s; }
.lang-card:nth-child(2) { transition-delay: 0.2s; }
.lang-card:nth-child(3) { transition-delay: 0.3s; }
.lang-card:nth-child(4) { transition-delay: 0.4s; }
.lang-card:nth-child(5) { transition-delay: 0.5s; }
.lang-card:nth-child(6) { transition-delay: 0.6s; }
.lang-card:nth-child(7) { transition-delay: 0.7s; }
.lang-card:nth-child(8) { transition-delay: 0.8s; }

.tech-card:nth-child(1) { transition-delay: 0.1s; }
.tech-card:nth-child(2) { transition-delay: 0.15s; }
.tech-card:nth-child(3) { transition-delay: 0.2s; }
.tech-card:nth-child(4) { transition-delay: 0.25s; }
.tech-card:nth-child(5) { transition-delay: 0.3s; }
.tech-card:nth-child(6) { transition-delay: 0.35s; }
.tech-card:nth-child(7) { transition-delay: 0.4s; }
.tech-card:nth-child(8) { transition-delay: 0.45s; }
.tech-card:nth-child(9) { transition-delay: 0.5s; }
.tech-card:nth-child(10) { transition-delay: 0.55s; }
.tech-card:nth-child(11) { transition-delay: 0.6s; }
.tech-card:nth-child(12) { transition-delay: 0.65s; }

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-section {
        padding-top: 120px;
        padding-bottom: 80px;
    }
    
    .stat-card,
    .feature-card,
    .course-card,
    .lang-card,
    .tech-card,
    .path-step,
    .testimonial-card {
        transform: translateY(20px);
    }
    
    .fade-in-left,
    .fade-in-right {
        transform: translateY(20px);
    }
}
</style>
