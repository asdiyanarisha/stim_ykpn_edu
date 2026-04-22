import './bootstrap';
import { createApp, h } from 'vue';

// Import Pages
import Dashboard from './Pages/Dashboard.vue';
import Login from './Pages/Login.vue';
import Unauthenticated from './Pages/Unauthenticated.vue';
import Teacher from './Pages/Teacher/index.vue';
import TeacherForm from './Pages/Teacher/TeacherForm.vue';
import TeacherShow from './Pages/Teacher/Show.vue';
import TeacherEdit from './Pages/Teacher/TeacherEdit.vue';
import Banner from './Pages/Content/Banner/index.vue';
import BannerShow from './Pages/Content/Banner/Show.vue';
import BannerForm from './Pages/Content/Banner/BannerForm.vue';
import BannerEdit from './Pages/Content/Banner/BannerEdit.vue';
import News from './Pages/Content/News/index.vue';
import NewsForm from './Pages/Content/News/NewsForm.vue';
import NewsShow from './Pages/Content/News/Show.vue';
import JobVacancy from './Pages/Content/JobVacancy/index.vue';
import JobVacancyForm from './Pages/Content/JobVacancy/JobVacancyForm.vue';
import CertificationLogo from './Pages/Content/CertificationLogo/index.vue';
import CertificationLogoForm from './Pages/Content/CertificationLogo/CertificationLogoForm.vue';
import GreetingChiefForm from './Pages/Content/GreetingChief/GreetingChiefForm.vue';
import CoreValueForm from './Pages/Content/CoreValue/CoreValueForm.vue';
import HistoryForm from './Pages/Content/History/HistoryForm.vue';
import LogoSymbolForm from './Pages/Content/LogoSymbol/LogoSymbolForm.vue';
import FacilityForm from './Pages/Content/Facility/FacilityForm.vue';
import SpmiAkreditasiForm from './Pages/Content/SpmiAkreditasi/SpmiAkreditasiForm.vue';
import AcademicGoalForm from './Pages/Content/Academic/AcademicGoalForm.vue';
import AcademicGoalAchieveForm from './Pages/Content/Academic/AcademicGoalAchieveForm.vue';
import AchievementIndex from './Pages/Content/Achievement/index.vue';
import AchievementForm from './Pages/Content/Achievement/AchievementForm.vue';
import AchievementEdit from './Pages/Content/Achievement/AchievementEdit.vue';
import AchievementShow from './Pages/Content/Achievement/Show.vue';

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
    teacherShow: TeacherShow,
    teacherEdit: TeacherEdit,
    banner: Banner,
    bannerShow: BannerShow,
    bannerForm: BannerForm,
    bannerEdit: BannerEdit,
    news: News,
    newsForm: NewsForm,
    newsShow: NewsShow,
    jobVacancies: JobVacancy,
    jobVacancyForm: JobVacancyForm,
    certificationLogos: CertificationLogo,
    certificationLogoForm: CertificationLogoForm,
    greetingChiefForm: GreetingChiefForm,
    coreValueForm: CoreValueForm,
    historyForm: HistoryForm,
    logoSymbolForm: LogoSymbolForm,
    facilityForm: FacilityForm,
    spmiAkreditasiForm: SpmiAkreditasiForm,
    academicGoalForm: AcademicGoalForm,
    academicGoalAchieveForm: AcademicGoalAchieveForm,
    achievementIndex: AchievementIndex,
    achievementForm: AchievementForm,
    achievementEdit: AchievementEdit,
    achievementShow: AchievementShow,
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
