import './bootstrap';
import { createApp } from 'vue';

// Import Components
import Dashboard from './Pages/Dashboard.vue';
import AppSidebar from './Components/Organisms/AppSidebar.vue';
import AppNavbar from './Components/Organisms/AppNavbar.vue';
import StatCard from './Components/Molecules/StatCard.vue';
import AppButton from './Components/Atoms/AppButton.vue';

const app = createApp(Dashboard);

// Register Global Components
app.component('AppSidebar', AppSidebar);
app.component('AppNavbar', AppNavbar);
app.component('StatCard', StatCard);
app.component('AppButton', AppButton);

app.mount('#app');
