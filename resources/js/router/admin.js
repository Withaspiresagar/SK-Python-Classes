import { createRouter, createWebHistory } from 'vue-router';
import AdminPanel from '../components/AdminPanel.vue';
import Dashboard from '../components/admin/Dashboard.vue';
import AdminManagement from '../components/admin/AdminManagement.vue';
import AdminSettings from '../components/AdminSettings.vue';

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
                path: 'admin-management',
                name: 'admin.management',
                component: AdminManagement,
                meta: { title: 'Admin Management', subtitle: 'Manage admin users' }
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

