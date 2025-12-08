import { createRouter, createWebHistory } from 'vue-router';
import AdminPanel from '../components/AdminPanel.vue';
import Dashboard from '../components/admin/Dashboard.vue';
import AdminManagement from '../components/admin/AdminManagement.vue';
import AdminSettings from '../components/AdminSettings.vue';
import UISettings from '../components/admin/UISettings.vue';
import Students from '../components/admin/Students.vue';
import Courses from '../components/admin/Courses.vue';
import LiveClasses from '../components/admin/LiveClasses.vue';
import Enrollments from '../components/admin/Enrollments.vue';
import Certificates from '../components/admin/Certificates.vue';
import Payments from '../components/admin/Payments.vue';
import Reports from '../components/admin/Reports.vue';

const routes = [
    {
        path: '/admin-panel',
        component: AdminPanel,
        redirect: '/admin-panel/dashboard',
        children: [
            {
                path: 'dashboard',
                name: 'admin.dashboard',
                component: Dashboard,
                meta: { title: 'Dashboard', subtitle: 'Overview of your institute' }
            },
            {
                path: 'students',
                name: 'admin.students',
                component: Students,
                meta: { title: 'Students', subtitle: 'Manage all students' }
            },
            {
                path: 'courses',
                name: 'admin.courses',
                component: Courses,
                meta: { title: 'Courses', subtitle: 'Manage all courses' }
            },
            {
                path: 'live-classes',
                name: 'admin.live-classes',
                component: LiveClasses,
                meta: { title: 'Live Classes', subtitle: 'Schedule and manage live classes' }
            },
            {
                path: 'enrollments',
                name: 'admin.enrollments',
                component: Enrollments,
                meta: { title: 'Enrollments', subtitle: 'View and manage enrollments' }
            },
            {
                path: 'certificates',
                name: 'admin.certificates',
                component: Certificates,
                meta: { title: 'Certificates', subtitle: 'Generate and manage certificates' }
            },
            {
                path: 'payments',
                name: 'admin.payments',
                component: Payments,
                meta: { title: 'Payments', subtitle: 'Track payments and fees' }
            },
            {
                path: 'reports',
                name: 'admin.reports',
                component: Reports,
                meta: { title: 'Reports', subtitle: 'View reports and analytics' }
            },
            {
                path: 'admin-management',
                name: 'admin.management',
                component: AdminManagement,
                meta: { title: 'Admin Management', subtitle: 'Manage admin users' }
            },
            {
                path: 'ui-settings',
                name: 'admin.ui-settings',
                component: UISettings,
                meta: { title: 'UI Settings', subtitle: 'Customize appearance and theme' }
            },
            {
                path: 'settings',
                name: 'admin.settings',
                component: AdminSettings,
                meta: { title: 'Settings', subtitle: 'Configure all settings' }
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;

