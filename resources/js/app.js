import './bootstrap';
import { createApp, h } from 'vue';

// Import Pages
import Dashboard from './Pages/Dashboard.vue';
import Login from './Pages/Login.vue';
import Unauthenticated from './Pages/Unauthenticated.vue';
import Teacher from './Pages/Teacher.vue';
import TeacherForm from './Pages/TeacherForm.vue';

// Import Global Components
import AppSidebar from './Components/Organisms/AppSidebar.vue';
import AppNavbar from './Components/Organisms/AppNavbar.vue';
import StatCard from './Components/Molecules/StatCard.vue';
import AppButton from './Components/Atoms/AppButton.vue';
import AppInput from './Components/Atoms/AppInput.vue';

// Page registry — mapping data-page attribute to Vue component
const pages = {
    dashboard: Dashboard,
    login: Login,
    unauthenticated: Unauthenticated,
    teacher: Teacher,
    teacherForm: TeacherForm,
};

const appElement = document.getElementById('app');

if (appElement) {
    const pageName = appElement.dataset.page;
    const rootComponent = pages[pageName];

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
