<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/20 to-purple-50/20">
        <Header />
        
        <!-- About Us Section -->
        <section class="py-8 sm:py-12 lg:py-16">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
                <!-- Page Header -->
                <div class="text-center mb-8 sm:mb-12 fade-in-up">
                    <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl sm:rounded-2xl shadow-xl mb-4 sm:mb-6">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-3 sm:mb-4 px-2">
                        About Us
                    </h1>
                </div>

                <!-- About Content -->
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-6 sm:p-8 lg:p-10">
                        <!-- Owner Section -->
                        <div class="mb-10 fade-in-up">
                            <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-2xl p-6 sm:p-8 border-2 border-indigo-100 shadow-lg">
                                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                                    <div class="flex-shrink-0">
                                        <div class="relative inline-block">
                                            <div class="w-48 sm:w-64 rounded-2xl overflow-hidden shadow-xl border-4 border-white bg-gray-100">
                                                <img 
                                                    src="/owner-photo.jpeg" 
                                                    alt="SK Python Classes Owner" 
                                                    class="w-full h-auto object-contain transform hover:scale-105 transition-transform duration-300"
                                                />
                                            </div>
                                            <div class="absolute -bottom-2 -right-2 w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg border-4 border-white z-10">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow text-center md:text-left">
                                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                            Meet Our Founder
                                        </h2>
                                        <p class="text-gray-700 leading-relaxed text-lg mb-4">
                                            Welcome to <strong class="text-indigo-600 font-bold">SK Python Classes</strong>, a premier training institute dedicated to shaping future-ready professionals in the world of programming and technology. We believe in delivering high-quality, practical, and industry-focused education that empowers learners to excel in real-world scenarios.
                                        </p>
                                        <p class="text-gray-700 leading-relaxed text-lg">
                                            At the core of our training ecosystem is our expertise in <strong class="text-indigo-600">Core Python</strong> and <strong class="text-indigo-600">Advanced Python</strong>, where we build strong programming foundations through hands-on learning, problem-solving, and project-based practice.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Main Description -->
                        <div class="prose prose-sm sm:prose-base lg:prose-lg max-w-none mb-8">
                            <p class="text-gray-700 leading-relaxed mb-8 text-lg">
                                Over the years, we have expanded into multiple cutting-edge domains to meet the evolving demands of the tech industry. Our training modules include:
                            </p>
                        </div>

                        <!-- Training Modules -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                            <!-- Web Development -->
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border-2 border-blue-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mb-4">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Web Development</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    Master front-end and back-end technologies to become a full-stack developer.
                                </p>
                            </div>

                            <!-- Database & Software Development -->
                            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border-2 border-purple-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mb-4">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Database & Software Development</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    Learn to design efficient systems, optimize queries, and build robust applications.
                                </p>
                            </div>

                            <!-- DevOps Training -->
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border-2 border-green-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mb-4">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">DevOps Training</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    Gain skills in automation, cloud, CI/CD, and container-based software operations.
                                </p>
                            </div>
                        </div>

                        <!-- Placement Assistance -->
                        <div class="bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 rounded-xl p-6 sm:p-8 mb-8 border-2 border-indigo-100">
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Placement Assistance Program
                            </h2>
                            <p class="text-gray-700 leading-relaxed text-lg mb-4">
                                We don't stop at training. We're committed to helping learners achieve their career goals through our <strong class="text-indigo-600">Placement Assistance Program</strong>, which includes:
                            </p>
                            <ul class="space-y-3 ml-4">
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-gray-700 text-lg">Interview preparation</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-gray-700 text-lg">Resume building</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-gray-700 text-lg">Job support</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Research & Project Assistance -->
                        <div class="bg-gradient-to-r from-cyan-50 via-blue-50 to-indigo-50 rounded-xl p-6 sm:p-8 mb-8 border-2 border-cyan-100">
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-8 h-8 text-cyan-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Research & Project Assistance
                            </h2>
                            <p class="text-gray-700 leading-relaxed text-lg mb-4">
                                SK Python Classes also extends strong guidance to researchers and students by offering professional assistance in:
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-cyan-500 flex-shrink-0 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-gray-700 text-lg">Research paper writing</span>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-cyan-500 flex-shrink-0 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-gray-700 text-lg">Thesis and dissertation development</span>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-cyan-500 flex-shrink-0 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-gray-700 text-lg">Major and minor project creation (academic and industry-oriented)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Mission & Vision -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <!-- Mission -->
                            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl p-6 sm:p-8 text-white shadow-lg">
                                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mb-4">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <h2 class="text-2xl sm:text-3xl font-bold mb-4">Our Mission</h2>
                                <p class="text-white leading-relaxed text-lg opacity-95">
                                    To provide high-quality, practical, and affordable technology education that bridges the gap between learning and industry.
                                </p>
                            </div>

                            <!-- Vision -->
                            <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl p-6 sm:p-8 text-white shadow-lg">
                                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mb-4">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                                <h2 class="text-2xl sm:text-3xl font-bold mb-4">Our Vision</h2>
                                <p class="text-white leading-relaxed text-lg opacity-95">
                                    To be a trusted learning hub where students, researchers, and professionals gain the skills and confidence needed to succeed in the global tech landscape.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <Footer />
    </div>
</template>

<script>
import { onMounted } from 'vue';
import Header from './Header.vue';
import Footer from './Footer.vue';

export default {
    name: 'AboutUsPage',
    components: {
        Header,
        Footer
    },
    setup() {
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

            const animatedElements = document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right');
            animatedElements.forEach(el => observer.observe(el));
        };

        onMounted(() => {
            setTimeout(() => {
                setupScrollAnimations();
            }, 100);
        });
    }
};
</script>

<style scoped>
.container {
    max-width: 1280px;
    margin: 0 auto;
}

/* Scroll Animations */
.fade-in-up,
.fade-in-left,
.fade-in-right {
    opacity: 0;
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.fade-in-up {
    transform: translateY(30px);
}

.fade-in-left {
    transform: translateX(-30px);
}

.fade-in-right {
    transform: translateX(30px);
}

.fade-in-up.animate,
.fade-in-left.animate,
.fade-in-right.animate {
    opacity: 1;
    transform: translate(0, 0);
}
</style>
