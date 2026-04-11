import './bootstrap';
import { createApp, h } from 'vue';

// Import Pages
import Dashboard from './Pages/Dashboard.vue';
import Login from './Pages/Login.vue';

// Import Global Components
import AppSidebar from './Components/Organisms/AppSidebar.vue';
import AppNavbar from './Components/Organisms/AppNavbar.vue';
import StatCard from './Components/Molecules/StatCard.vue';
import AppButton from './Components/Atoms/AppButton.vue';
import AppInput from './Components/Atoms/AppInput.vue';

const appElement = document.getElementById('app');

if (appElement) {
    const pageName = appElement.dataset.page;
    let rootComponent;

    if (pageName === 'dashboard') {
        rootComponent = Dashboard;
    } else if (pageName === 'login') {
        rootComponent = Login;
    }

    if (rootComponent) {
        const app = createApp({
            render: () => h(rootComponent)
        });

        // Register Global Components
        app.component('AppSidebar', AppSidebar);
        app.component('AppNavbar', AppNavbar);
        app.component('StatCard', StatCard);
        app.component('AppButton', AppButton);
        app.component('AppInput', AppInput);

        app.mount('#app');
    }
}
