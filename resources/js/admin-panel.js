import './bootstrap';
import { createApp, h } from 'vue';
import router from './router/admin';
import { RouterView } from 'vue-router';

// Create a root component that uses router-view
const RootComponent = {
    setup() {
        return () => h(RouterView);
    }
};

const app = createApp(RootComponent);
app.use(router);
app.mount('#app');

