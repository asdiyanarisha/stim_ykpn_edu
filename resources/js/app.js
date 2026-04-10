import './bootstrap';
import { createApp } from 'vue';

// Import Components
import Dashboard from './Pages/Dashboard.vue';

const app = createApp(Dashboard);
app.mount('#app');
