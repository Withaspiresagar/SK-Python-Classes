<template>
    <div class="home-page">
        <Header />
        
        <!-- Hero Section with Slider -->
        <section id="home" class="hero-section relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800"></div>
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                <div class="absolute top-40 right-10 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-8 left-1/2 w-72 h-72 bg-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
            </div>
            
            <!-- Slider Container -->
            <div class="hero-slider relative flex items-center">
                <div 
                    v-for="(slide, index) in heroSlides" 
                    :key="index"
                    class="hero-slide absolute inset-0 flex items-center justify-center transition-opacity duration-1000"
                    :class="{ 'opacity-100 z-10': currentSlide === index, 'opacity-0 z-0': currentSlide !== index }"
                >
                    <div class="container mx-auto px-4 py-16 md:py-20 relative z-10">
                        <div class="text-center">
                            <!-- Animated Title -->
                            <h1 
                                class="text-5xl md:text-7xl font-bold mb-6 text-white leading-tight hero-title"
                                :class="{ 'slide-in-up': currentSlide === index }"
                            >
                                <span v-for="(word, wordIndex) in slide.title.split(' ')" :key="wordIndex" class="inline-block" :style="{ animationDelay: `${wordIndex * 0.2}s` }">
                                    <span v-if="word.includes('Programming') || word.includes('Python') || word.includes('Development') || word.includes('Science') || word.includes('Intelligence') || word.includes('DevOps')" class="bg-gradient-to-r from-yellow-300 to-pink-300 bg-clip-text text-transparent">
                                        {{ word }}
                                    </span>
                                    <span v-else>{{ word }}</span>
                                </span>
                            </h1>
                            
                            <!-- Animated Description -->
                            <p 
                                class="text-xl md:text-2xl text-gray-200 mb-8 max-w-2xl mx-auto hero-description"
                                :class="{ 'slide-in-up': currentSlide === index }"
                                :style="{ animationDelay: '0.8s' }"
                            >
                                {{ slide.description }}
                            </p>
                            
                            <!-- Animated Buttons -->
                            <div 
                                class="flex flex-col sm:flex-row gap-4 justify-center items-center hero-buttons"
                                :class="{ 'slide-in-up': currentSlide === index }"
                                :style="{ animationDelay: '1.2s' }"
                            >
                                <router-link 
                                    to="/courses"
                                    class="px-8 py-4 bg-white text-blue-600 rounded-lg font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-xl"
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
                </div>
            </div>

            <!-- Slider Indicators -->
            <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 z-20 flex gap-3">
                <button
                    v-for="(slide, index) in heroSlides"
                    :key="index"
                    @click="goToSlide(index)"
                    class="w-3 h-3 rounded-full transition-all duration-300"
                    :class="currentSlide === index ? 'bg-white w-8' : 'bg-white bg-opacity-50 hover:bg-opacity-75'"
                ></button>
            </div>

            <div class="absolute bottom-0 left-0 right-0 z-10">
                <svg class="w-full h-16 text-white" fill="currentColor" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0 C300,100 600,50 900,70 C1050,80 1150,60 1200,50 L1200,120 L0,120 Z"></path>
                </svg>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section py-16 bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                    <div 
                        v-for="(stat, index) in stats" 
                        :key="index"
                        class="stat-card"
                        :class="index % 2 === 0 ? 'fade-in-left' : 'fade-in-right'"
                    >
                        <div :class="getStatGradient(index)" class="text-center p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:rotate-1 border-2 border-white">
                            <div :class="getStatTextColor(index)" class="text-4xl md:text-5xl font-bold mb-2 counter-animate">{{ stat.value }}</div>
                            <div class="text-sm md:text-base text-white font-semibold">{{ stat.label }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Programming Languages Section -->
        <section class="languages-section py-20 bg-gradient-to-br from-cyan-50 via-blue-50 to-indigo-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Learn <span class="bg-gradient-to-r from-cyan-500 via-blue-500 to-purple-500 bg-clip-text text-transparent">Programming Languages</span>
                    </h2>
                    <p class="text-lg text-gray-700 max-w-3xl mx-auto">
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
                        <div :class="getLangGradient(index)" class="p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:rotate-1 border-2 border-white group">
                            <div class="text-6xl mb-4 text-center transform group-hover:scale-110 transition-transform duration-300">{{ lang.icon }}</div>
                            <h3 class="text-xl font-bold mb-2 text-center text-white group-hover:text-yellow-200 transition-colors">{{ lang.name }}</h3>
                            <p class="text-white text-sm text-center mb-4 opacity-90">{{ lang.description }}</p>
                            <div class="flex items-center justify-center">
                                <span class="text-xs px-3 py-1 rounded-full bg-white bg-opacity-30 text-white font-semibold backdrop-blur-sm">{{ lang.level }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Technologies Section -->
        <section class="technologies-section py-20 bg-gradient-to-br from-pink-50 via-rose-50 to-orange-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Modern <span class="bg-gradient-to-r from-pink-500 via-rose-500 to-orange-500 bg-clip-text text-transparent">Technologies</span>
                    </h2>
                    <p class="text-lg text-gray-700 max-w-3xl mx-auto">
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
                        <div :class="getTechGradient(index)" class="p-6 rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:scale-110 hover:rotate-2 border-2 border-white group">
                            <div class="text-4xl mb-3 text-center transform group-hover:scale-125 transition-transform">{{ tech.icon }}</div>
                            <h3 class="text-lg font-bold text-center text-white group-hover:text-yellow-200 transition-colors">{{ tech.name }}</h3>
                            <p class="text-xs text-white text-center mt-2 opacity-90 bg-white bg-opacity-20 px-2 py-1 rounded-full inline-block">{{ tech.category }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DevOps Section -->
        <section class="devops-section py-20 bg-gradient-to-br from-slate-50 via-gray-50 to-zinc-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Master <span class="bg-gradient-to-r from-slate-600 via-gray-600 to-zinc-600 bg-clip-text text-transparent">DevOps</span>
                    </h2>
                    <p class="text-lg text-gray-700 max-w-3xl mx-auto">
                        Learn modern DevOps practices, containerization, CI/CD, and cloud infrastructure
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div 
                        v-for="(tool, index) in devopsTools" 
                        :key="index"
                        class="devops-card"
                        :class="getAnimationClass(index)"
                    >
                        <div :class="getDevOpsGradient(index)" class="p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:rotate-1 border-2 border-white group">
                            <div class="text-6xl mb-4 text-center transform group-hover:scale-110 group-hover:rotate-12 transition-transform duration-300">{{ tool.icon }}</div>
                            <h3 class="text-xl font-bold mb-2 text-center text-white group-hover:text-yellow-200 transition-colors">{{ tool.name }}</h3>
                            <p class="text-white text-sm text-center mb-4 opacity-90">{{ tool.description }}</p>
                            <div class="flex items-center justify-center">
                                <span class="text-xs px-3 py-1 rounded-full bg-white bg-opacity-30 text-white font-semibold backdrop-blur-sm">{{ tool.category }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- AI/ML Section -->
        <section class="aiml-section py-20 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Artificial Intelligence & <span class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 bg-clip-text text-transparent">Machine Learning</span>
                    </h2>
                    <p class="text-lg text-gray-700 max-w-3xl mx-auto">
                        Dive deep into AI/ML with hands-on projects, neural networks, and real-world applications
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div 
                        v-for="(topic, index) in aimlTopics" 
                        :key="index"
                        class="aiml-card"
                        :class="getAnimationClass(index)"
                    >
                        <div :class="getAIMLGradient(index)" class="p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:rotate-1 border-2 border-white group">
                            <div class="text-6xl mb-4 text-center transform group-hover:scale-110 group-hover:rotate-12 transition-transform duration-300">{{ topic.icon }}</div>
                            <h3 class="text-2xl font-bold mb-3 text-center text-white group-hover:text-yellow-200 transition-colors">{{ topic.title }}</h3>
                            <p class="text-white text-sm text-center mb-4 opacity-90 leading-relaxed">{{ topic.description }}</p>
                            <div class="flex flex-wrap items-center justify-center gap-2">
                                <span v-for="(tag, tagIndex) in topic.tags" :key="tagIndex" class="text-xs px-3 py-1 rounded-full bg-white bg-opacity-30 text-white font-semibold backdrop-blur-sm">
                                    {{ tag }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about-section py-20 bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        About <span class="bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 bg-clip-text text-transparent">SK Python Classes</span>
                    </h2>
                    <p class="text-lg text-gray-700 max-w-3xl mx-auto">
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
                        <div :class="getAboutGradient(index)" class="p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-2 border-white group">
                            <div :class="getAboutIconBg(index)" class="w-16 h-16 rounded-xl flex items-center justify-center mb-6 mx-auto transform group-hover:rotate-12 group-hover:scale-110 transition-transform shadow-lg">
                                <div class="text-3xl">{{ feature.icon }}</div>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-center text-white group-hover:text-yellow-200 transition-colors">{{ feature.title }}</h3>
                            <p class="text-white text-center opacity-90">{{ feature.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Learning Path Section -->
        <section class="learning-path-section py-20 bg-gradient-to-br from-violet-50 via-purple-50 to-fuchsia-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Your <span class="bg-gradient-to-r from-violet-500 via-purple-500 to-fuchsia-500 bg-clip-text text-transparent">Learning Path</span>
                    </h2>
                    <p class="text-lg text-gray-700 max-w-3xl mx-auto">
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
                        <div :class="getPathGradient(index)" class="flex flex-col md:flex-row items-center gap-6 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border-2 border-white">
                            <div :class="getPathNumberBg(index)" class="flex-shrink-0 w-20 h-20 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-xl transform hover:scale-110 transition-transform">
                                {{ step.number }}
                            </div>
                            <div class="flex-grow text-center md:text-left">
                                <h3 class="text-2xl font-bold text-white mb-2">{{ step.title }}</h3>
                                <p class="text-white opacity-90">{{ step.description }}</p>
                            </div>
                            <div class="text-5xl transform hover:scale-125 transition-transform">{{ step.icon }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Courses Section -->
        <section id="courses" class="courses-section py-20 bg-gradient-to-br from-slate-50 via-gray-50 to-zinc-50">
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
                            <div :class="getCourseGradient(index)" class="h-48 flex items-center justify-center relative overflow-hidden">
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
        <section id="features" class="why-choose-section py-20 bg-gradient-to-br from-amber-50 via-yellow-50 to-orange-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Why Choose <span class="bg-gradient-to-r from-amber-500 via-yellow-500 to-orange-500 bg-clip-text text-transparent">Us?</span>
                    </h2>
                    <p class="text-lg text-gray-700 max-w-2xl mx-auto">
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
                        <div :class="getFeatureGradient(index)" class="p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-white group">
                            <div class="flex items-start">
                                <div class="text-4xl mr-4 flex-shrink-0 transform group-hover:scale-125 group-hover:rotate-12 transition-transform">{{ feature.icon }}</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-3 text-white group-hover:text-yellow-200 transition-colors">{{ feature.title }}</h3>
                                    <p class="text-white leading-relaxed opacity-90">{{ feature.description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials-section py-20 bg-gradient-to-br from-sky-50 via-blue-50 to-indigo-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 fade-in-up">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        What Our <span class="bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-500 bg-clip-text text-transparent">Students Say</span>
                    </h2>
                    <p class="text-lg text-gray-700 max-w-2xl mx-auto">
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
                        <div :class="getTestimonialGradient(index)" class="p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-2 border-white">
                            <div class="flex items-center mb-4">
                                <div class="text-4xl mr-3 transform hover:scale-110 transition-transform">{{ testimonial.icon }}</div>
                                <div>
                                    <h4 class="font-bold text-white">{{ testimonial.name }}</h4>
                                    <p class="text-sm text-white opacity-80">{{ testimonial.role }}</p>
                                </div>
                            </div>
                            <p class="text-white italic mb-4 opacity-95">"{{ testimonial.quote }}"</p>
                            <div class="flex text-yellow-300">
                                <span v-for="i in 5" :key="i" class="transform hover:scale-125 transition-transform">⭐</span>
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
import { ref, onMounted, onUnmounted } from 'vue';
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
        const currentSlide = ref(0);
        let slideInterval = null;

        const heroSlides = ref([
            {
                title: 'Master Programming',
                description: 'Learn Python, Web Development, Data Science, and more from industry experts'
            },
            {
                title: 'Learn Python',
                description: 'From basics to advanced, master the most versatile programming language'
            },
            {
                title: 'Web Development',
                description: 'Build modern web applications with React, Vue, Django, and Flask'
            },
            {
                title: 'Data Science',
                description: 'Analyze data, create visualizations, and build machine learning models'
            },
            {
                title: 'Artificial Intelligence',
                description: 'Dive into AI/ML with neural networks, deep learning, and NLP'
            },
            {
                title: 'DevOps & Cloud',
                description: 'Master Docker, Kubernetes, CI/CD, and cloud infrastructure'
            },
            {
                title: 'Full Stack Development',
                description: 'Become a full-stack developer with frontend and backend technologies'
            },
            {
                title: 'Machine Learning',
                description: 'Build intelligent systems with supervised and unsupervised learning algorithms'
            },
            {
                title: 'Deep Learning',
                description: 'Master neural networks, CNNs, RNNs, and transformers for advanced AI'
            },
            {
                title: 'Backend Development',
                description: 'Learn server-side programming with Node.js, Django, Flask, and Express'
            },
            {
                title: 'Frontend Development',
                description: 'Create stunning user interfaces with React, Vue, Angular, and modern CSS'
            },
            {
                title: 'Database Management',
                description: 'Master SQL, NoSQL, PostgreSQL, MongoDB, and database design'
            },
            {
                title: 'API Development',
                description: 'Build RESTful APIs and GraphQL endpoints for modern applications'
            },
            {
                title: 'Mobile Development',
                description: 'Create mobile apps with React Native, Flutter, and native development'
            },
            {
                title: 'Cloud Computing',
                description: 'Deploy and scale applications on AWS, Azure, and Google Cloud Platform'
            },
            {
                title: 'Cybersecurity',
                description: 'Learn security best practices, ethical hacking, and secure coding'
            },
            {
                title: 'Blockchain Development',
                description: 'Build decentralized applications with Ethereum, Solidity, and Web3'
            },
            {
                title: 'Game Development',
                description: 'Create games with Python, Unity, and game development frameworks'
            },
            {
                title: 'Automation & Scripting',
                description: 'Automate tasks and workflows with Python, Bash, and automation tools'
            },
            {
                title: 'Career Ready',
                description: 'Get placement assistance, interview preparation, and career guidance'
            }
        ]);

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

        const devopsTools = ref([
            { icon: '🐳', name: 'Docker', description: 'Containerization platform', category: 'Containers' },
            { icon: '☸️', name: 'Kubernetes', description: 'Container orchestration', category: 'Orchestration' },
            { icon: '☁️', name: 'AWS', description: 'Cloud infrastructure', category: 'Cloud' },
            { icon: '🔷', name: 'Azure', description: 'Microsoft cloud platform', category: 'Cloud' },
            { icon: '🔵', name: 'GCP', description: 'Google cloud platform', category: 'Cloud' },
            { icon: '🔄', name: 'Jenkins', description: 'CI/CD automation', category: 'CI/CD' },
            { icon: '🎯', name: 'GitLab CI', description: 'DevOps lifecycle', category: 'CI/CD' },
            { icon: '⚡', name: 'GitHub Actions', description: 'Workflow automation', category: 'CI/CD' },
            { icon: '📦', name: 'Terraform', description: 'Infrastructure as code', category: 'IaC' },
            { icon: '🎪', name: 'Ansible', description: 'Configuration management', category: 'Automation' },
            { icon: '🐍', name: 'Python Scripts', description: 'Automation scripting', category: 'Scripting' },
            { icon: '📊', name: 'Prometheus', description: 'Monitoring & alerting', category: 'Monitoring' }
        ]);

        const aimlTopics = ref([
            {
                icon: '🧠',
                title: 'Machine Learning',
                description: 'Learn supervised, unsupervised, and reinforcement learning algorithms with hands-on projects',
                tags: ['Scikit-learn', 'Regression', 'Classification', 'Clustering']
            },
            {
                icon: '🕸️',
                title: 'Deep Learning',
                description: 'Master neural networks, CNNs, RNNs, and transformers for advanced AI applications',
                tags: ['TensorFlow', 'PyTorch', 'Keras', 'Neural Networks']
            },
            {
                icon: '👁️',
                title: 'Computer Vision',
                description: 'Build image recognition, object detection, and image processing applications',
                tags: ['OpenCV', 'YOLO', 'Image Processing', 'Object Detection']
            },
            {
                icon: '💬',
                title: 'NLP',
                description: 'Natural Language Processing for chatbots, sentiment analysis, and text generation',
                tags: ['NLTK', 'spaCy', 'Transformers', 'BERT']
            },
            {
                icon: '📊',
                title: 'Data Science',
                description: 'Data analysis, visualization, and statistical modeling for business insights',
                tags: ['Pandas', 'NumPy', 'Matplotlib', 'Data Analysis']
            },
            {
                icon: '🤖',
                title: 'AI Applications',
                description: 'Build real-world AI applications including chatbots, recommendation systems, and more',
                tags: ['Chatbots', 'Recommendation', 'Predictive', 'Automation']
            }
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

        const getStatGradient = (index) => {
            const gradients = [
                'bg-gradient-to-br from-blue-500 to-cyan-500',
                'bg-gradient-to-br from-purple-500 to-pink-500',
                'bg-gradient-to-br from-orange-500 to-red-500',
                'bg-gradient-to-br from-green-500 to-emerald-500'
            ];
            return gradients[index % 4];
        };

        const getStatTextColor = (index) => {
            return 'text-white';
        };

        const getLangGradient = (index) => {
            const gradients = [
                'bg-gradient-to-br from-blue-500 to-indigo-600',
                'bg-gradient-to-br from-purple-500 to-pink-500',
                'bg-gradient-to-br from-cyan-500 to-teal-500',
                'bg-gradient-to-br from-orange-500 to-red-500',
                'bg-gradient-to-br from-green-500 to-emerald-500',
                'bg-gradient-to-br from-yellow-500 to-orange-500',
                'bg-gradient-to-br from-pink-500 to-rose-500',
                'bg-gradient-to-br from-indigo-500 to-purple-500'
            ];
            return gradients[index % 8];
        };

        const getTechGradient = (index) => {
            const gradients = [
                'bg-gradient-to-br from-pink-500 to-rose-500',
                'bg-gradient-to-br from-orange-500 to-amber-500',
                'bg-gradient-to-br from-purple-500 to-indigo-500',
                'bg-gradient-to-br from-cyan-500 to-blue-500',
                'bg-gradient-to-br from-emerald-500 to-teal-500',
                'bg-gradient-to-br from-yellow-500 to-orange-500',
                'bg-gradient-to-br from-red-500 to-pink-500',
                'bg-gradient-to-br from-blue-500 to-cyan-500',
                'bg-gradient-to-br from-indigo-500 to-purple-500',
                'bg-gradient-to-br from-teal-500 to-green-500',
                'bg-gradient-to-br from-rose-500 to-pink-500',
                'bg-gradient-to-br from-amber-500 to-yellow-500'
            ];
            return gradients[index % 12];
        };

        const getAboutGradient = (index) => {
            const gradients = [
                'bg-gradient-to-br from-emerald-500 to-teal-500',
                'bg-gradient-to-br from-cyan-500 to-blue-500',
                'bg-gradient-to-br from-teal-500 to-green-500'
            ];
            return gradients[index % 3];
        };

        const getAboutIconBg = (index) => {
            const backgrounds = [
                'bg-gradient-to-br from-yellow-400 to-orange-400',
                'bg-gradient-to-br from-pink-400 to-rose-400',
                'bg-gradient-to-br from-blue-400 to-indigo-400'
            ];
            return backgrounds[index % 3];
        };

        const getPathGradient = (index) => {
            const gradients = [
                'bg-gradient-to-br from-violet-500 to-purple-500',
                'bg-gradient-to-br from-fuchsia-500 to-pink-500',
                'bg-gradient-to-br from-purple-500 to-indigo-500',
                'bg-gradient-to-br from-indigo-500 to-blue-500'
            ];
            return gradients[index % 4];
        };

        const getPathNumberBg = (index) => {
            const backgrounds = [
                'bg-gradient-to-br from-yellow-400 to-orange-400',
                'bg-gradient-to-br from-pink-400 to-rose-400',
                'bg-gradient-to-br from-cyan-400 to-blue-400',
                'bg-gradient-to-br from-green-400 to-emerald-400'
            ];
            return backgrounds[index % 4];
        };

        const getFeatureGradient = (index) => {
            const gradients = [
                'bg-gradient-to-br from-amber-500 to-orange-500',
                'bg-gradient-to-br from-yellow-500 to-amber-500',
                'bg-gradient-to-br from-orange-500 to-red-500',
                'bg-gradient-to-br from-yellow-400 to-orange-400',
                'bg-gradient-to-br from-amber-400 to-yellow-400',
                'bg-gradient-to-br from-orange-400 to-red-400'
            ];
            return gradients[index % 6];
        };

        const getTestimonialGradient = (index) => {
            const gradients = [
                'bg-gradient-to-br from-sky-500 to-blue-500',
                'bg-gradient-to-br from-blue-500 to-indigo-500',
                'bg-gradient-to-br from-indigo-500 to-purple-500'
            ];
            return gradients[index % 3];
        };

        const getCourseGradient = (index) => {
            const gradients = [
                'bg-gradient-to-br from-blue-500 to-indigo-600',
                'bg-gradient-to-br from-purple-500 to-pink-500',
                'bg-gradient-to-br from-cyan-500 to-teal-500',
                'bg-gradient-to-br from-orange-500 to-red-500',
                'bg-gradient-to-br from-green-500 to-emerald-500',
                'bg-gradient-to-br from-yellow-500 to-orange-500'
            ];
            return gradients[index % 6];
        };

        const getDevOpsGradient = (index) => {
            const gradients = [
                'bg-gradient-to-br from-slate-600 to-gray-700',
                'bg-gradient-to-br from-gray-600 to-zinc-700',
                'bg-gradient-to-br from-blue-600 to-indigo-700',
                'bg-gradient-to-br from-cyan-600 to-teal-700',
                'bg-gradient-to-br from-purple-600 to-indigo-700',
                'bg-gradient-to-br from-orange-600 to-red-700',
                'bg-gradient-to-br from-green-600 to-emerald-700',
                'bg-gradient-to-br from-yellow-600 to-orange-700',
                'bg-gradient-to-br from-pink-600 to-rose-700',
                'bg-gradient-to-br from-violet-600 to-purple-700',
                'bg-gradient-to-br from-teal-600 to-cyan-700',
                'bg-gradient-to-br from-amber-600 to-yellow-700'
            ];
            return gradients[index % 12];
        };

        const getAIMLGradient = (index) => {
            const gradients = [
                'bg-gradient-to-br from-indigo-500 to-purple-600',
                'bg-gradient-to-br from-purple-500 to-pink-600',
                'bg-gradient-to-br from-pink-500 to-rose-600',
                'bg-gradient-to-br from-violet-500 to-indigo-600',
                'bg-gradient-to-br from-fuchsia-500 to-purple-600',
                'bg-gradient-to-br from-indigo-600 to-blue-600'
            ];
            return gradients[index % 6];
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

        const nextSlide = () => {
            currentSlide.value = (currentSlide.value + 1) % heroSlides.value.length;
        };

        const previousSlide = () => {
            currentSlide.value = (currentSlide.value - 1 + heroSlides.value.length) % heroSlides.value.length;
        };

        const goToSlide = (index) => {
            currentSlide.value = index;
        };

        const startSlider = () => {
            slideInterval = setInterval(() => {
                nextSlide();
            }, 5000); // Change slide every 5 seconds
        };

        const stopSlider = () => {
            if (slideInterval) {
                clearInterval(slideInterval);
                slideInterval = null;
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

            const animatedElements = document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right, .stat-card, .feature-card, .course-card, .lang-card, .tech-card, .path-step, .testimonial-card, .devops-card, .aiml-card');
            animatedElements.forEach(el => observer.observe(el));
        };

        onMounted(() => {
            fetchCourses();
            startSlider();
            setTimeout(() => {
                setupScrollAnimations();
            }, 100);
        });

        onUnmounted(() => {
            stopSlider();
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
            getAnimationClass,
            getStatGradient,
            getStatTextColor,
            getLangGradient,
            getTechGradient,
            getAboutGradient,
            getAboutIconBg,
            getPathGradient,
            getPathNumberBg,
            getFeatureGradient,
            getTestimonialGradient,
            getCourseGradient,
            getDevOpsGradient,
            getAIMLGradient,
            devopsTools,
            aimlTopics,
            currentSlide,
            heroSlides,
            nextSlide,
            previousSlide,
            goToSlide
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
.testimonial-card,
.devops-card,
.aiml-card {
    opacity: 0;
    transition: opacity 1s ease-out, transform 1s ease-out;
}

.stat-card.animate,
.feature-card.animate,
.course-card.animate,
.lang-card.animate,
.tech-card.animate,
.path-step.animate,
.testimonial-card.animate,
.devops-card.animate,
.aiml-card.animate {
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

/* Hero Slider Styles */
.hero-slider {
    min-height: 70vh;
    padding: 80px 0;
}

.hero-slide {
    transition: opacity 1s ease-in-out;
}

.hero-title {
    opacity: 0;
    transform: translateY(30px);
}

.hero-title.slide-in-up {
    animation: slideInUp 0.8s ease-out forwards;
}

.hero-description {
    opacity: 0;
    transform: translateY(30px);
}

.hero-description.slide-in-up {
    animation: slideInUp 0.8s ease-out forwards;
}

.hero-buttons {
    opacity: 0;
    transform: translateY(30px);
}

.hero-buttons.slide-in-up {
    animation: slideInUp 0.8s ease-out forwards;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Word by word animation */
.hero-title span {
    animation: fadeInWord 0.6s ease-out forwards;
    opacity: 0;
}

.hero-title.slide-in-up span {
    animation: fadeInWord 0.6s ease-out forwards;
}

@keyframes fadeInWord {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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

.devops-card:nth-child(1) { transition-delay: 0.1s; }
.devops-card:nth-child(2) { transition-delay: 0.15s; }
.devops-card:nth-child(3) { transition-delay: 0.2s; }
.devops-card:nth-child(4) { transition-delay: 0.25s; }
.devops-card:nth-child(5) { transition-delay: 0.3s; }
.devops-card:nth-child(6) { transition-delay: 0.35s; }
.devops-card:nth-child(7) { transition-delay: 0.4s; }
.devops-card:nth-child(8) { transition-delay: 0.45s; }
.devops-card:nth-child(9) { transition-delay: 0.5s; }
.devops-card:nth-child(10) { transition-delay: 0.55s; }
.devops-card:nth-child(11) { transition-delay: 0.6s; }
.devops-card:nth-child(12) { transition-delay: 0.65s; }

.aiml-card:nth-child(1) { transition-delay: 0.1s; }
.aiml-card:nth-child(2) { transition-delay: 0.2s; }
.aiml-card:nth-child(3) { transition-delay: 0.3s; }
.aiml-card:nth-child(4) { transition-delay: 0.4s; }
.aiml-card:nth-child(5) { transition-delay: 0.5s; }
.aiml-card:nth-child(6) { transition-delay: 0.6s; }

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
    .testimonial-card,
    .devops-card,
    .aiml-card {
        transform: translateY(20px);
    }
    
    .fade-in-left,
    .fade-in-right {
        transform: translateY(20px);
    }
}
</style>
