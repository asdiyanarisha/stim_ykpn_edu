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
import StudyLoadForm from './Pages/Content/Academic/StudyLoadForm.vue';
import SksForm from './Pages/Content/Academic/SksForm.vue';
import LevelPeriodStudyForm from './Pages/Content/Academic/LevelPeriodStudyForm.vue';
import AcademicActivityForm from './Pages/Content/Academic/AcademicActivityForm.vue';
import AcademicAdvisorForm from './Pages/Content/Academic/AcademicAdvisorForm.vue';
import AcademicSanctionForm from './Pages/Content/Academic/AcademicSanctionForm.vue';
import AttendanceLectureForm from './Pages/Content/Academic/AttendanceLectureForm.vue';
import CodeConductForm from './Pages/Content/Academic/CodeConductForm.vue';
import ClassCapacityForm from './Pages/Content/Academic/ClassCapacityForm.vue';
import AttendanceCountForm from './Pages/Content/Academic/AttendanceCountForm.vue';
import EvaluationSystemForm from './Pages/Content/Academic/EvaluationSystemForm.vue';
import SeminarProposalForm from './Pages/Content/Academic/SeminarProposalForm.vue';
import AcademicCalendarForm from './Pages/Content/AcademicCalendarForm.vue';
import ExamForm from './Pages/Content/Academic/Graduation/ExamForm.vue';
import ExamRulesForm from './Pages/Content/Academic/Graduation/ExamRulesForm.vue';
import GraduationForm from './Pages/Content/Academic/Graduation/GraduationForm.vue';
import YudisiumForm from './Pages/Content/Academic/Graduation/YudisiumForm.vue';
import GraduationAnnouncementForm from './Pages/Content/Academic/Graduation/GraduationAnnouncementForm.vue';
import LibraryForm from './Pages/Content/Academic/LibraryForm.vue';
import AchievementIndex from './Pages/Content/Achievement/index.vue';
import AchievementForm from './Pages/Content/Achievement/AchievementForm.vue';
import AchievementEdit from './Pages/Content/Achievement/AchievementEdit.vue';
import AchievementShow from './Pages/Content/Achievement/Show.vue';
import JournalIndex from './Pages/Research/Journal/index.vue';
import JournalForm from './Pages/Research/Journal/Form.vue';
import JournalShow from './Pages/Research/Journal/Show.vue';
import StudentActivity from './Pages/Student/Activity/index.vue';
import StudentActivityForm from './Pages/Student/Activity/Form.vue';
import StudentActivityShow from './Pages/Student/Activity/Show.vue';
import StudentUkm from './Pages/Student/Ukm/index.vue';
import StudentUkmForm from './Pages/Student/Ukm/Form.vue';
import StudentUkmShow from './Pages/Student/Ukm/Show.vue';
import StudentTestimony from './Pages/Student/Testimony/index.vue';
import StudentTestimonyForm from './Pages/Student/Testimony/Form.vue';
import StudentTestimonyShow from './Pages/Student/Testimony/Show.vue';
import CampusLiveVideoIndex from './Pages/CampusLife/Video/index.vue';
import CampusLiveVideoForm from './Pages/CampusLife/Video/Form.vue';
import CampusLiveVideoShow from './Pages/CampusLife/Video/Show.vue';
import LodgingInformationForm from './Pages/CampusLife/LodgingInformationForm.vue';
import PmbScholarshipForm from './Pages/Pmb/ScholarshipForm.vue';
import PmbProgramExcellenceForm from './Pages/Pmb/ProgramExcellenceForm.vue';
import PmbProgramRegulerForm from './Pages/Pmb/ProgramRegulerForm.vue';
import PmbProgramExtensiForm from './Pages/Pmb/ProgramExtensiForm.vue';
import Role from './Pages/Role/index.vue';
import RoleForm from './Pages/Role/RoleForm.vue';
import User from './Pages/User/index.vue';
import UserForm from './Pages/User/UserForm.vue';
import UserShow from './Pages/User/Show.vue';
import Brochure from './Pages/Brochure/index.vue';
import BrochureForm from './Pages/Brochure/BrochureForm.vue';
import BrochureShow from './Pages/Brochure/Show.vue';
import PublicFiles from './Pages/PublicFiles/index.vue';
import PublicFilesForm from './Pages/PublicFiles/PublicFilesForm.vue';
import PublicFilesShow from './Pages/PublicFiles/Show.vue';
import Voucher from './Pages/Voucher/index.vue';
import VoucherForm from './Pages/Voucher/VoucherForm.vue';
import VoucherShow from './Pages/Voucher/Show.vue';
import AcademicSchoolYear from './Pages/AcademicYear/index.vue';
import AcademicSchoolYearForm from './Pages/AcademicYear/SchoolYearForm.vue';
import AcademicSchoolYearShow from './Pages/AcademicYear/Show.vue';
import ProgramStudy from './Pages/ProgramStudy/index.vue';
import ProgramStudyForm from './Pages/ProgramStudy/ProgramStudyForm.vue';
import ProgramStudyShow from './Pages/ProgramStudy/Show.vue';
import PaymentSettingForm from './Pages/PaymentSetting/PaymentSettingForm.vue';
import UserSetting from './Pages/Setting/UserSetting.vue';
import CategoryTeacher from './Pages/Teacher/CategoryTeacher/index.vue';
import CategoryTeacherShow from './Pages/Teacher/CategoryTeacher/Show.vue';
import JobTitle from './Pages/MasterData/JobTitle/index.vue';
import JobTitleShow from './Pages/MasterData/JobTitle/Show.vue';

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
    studyLoadForm: StudyLoadForm,
    sksForm: SksForm,
    levelPeriodStudyForm: LevelPeriodStudyForm,
    academicActivitiesForm: AcademicActivityForm,
    academicAdvisorForm: AcademicAdvisorForm,
    academicSanctionForm: AcademicSanctionForm,
    attendanceLectureForm: AttendanceLectureForm,
    codeConductForm: CodeConductForm,
    classCapacityForm: ClassCapacityForm,
    attendanceCountForm: AttendanceCountForm,
    evaluationSystemForm: EvaluationSystemForm,
    seminarProposalForm: SeminarProposalForm,
    academicCalendarForm: AcademicCalendarForm,
    examForm: ExamForm,
    examRulesForm: ExamRulesForm,
    graduationForm: GraduationForm,
    yudisiumForm: YudisiumForm,
    graduationAnnouncementForm: GraduationAnnouncementForm,
    academicLibraryForm: LibraryForm,
    achievementIndex: AchievementIndex,
    achievementForm: AchievementForm,
    achievementEdit: AchievementEdit,
    achievementShow: AchievementShow,
    journal: JournalIndex,
    journalForm: JournalForm,
    journalShow: JournalShow,
    studentActivity: StudentActivity,
    studentActivityForm: StudentActivityForm,
    studentActivityShow: StudentActivityShow,
    studentUkm: StudentUkm,
    studentUkmForm: StudentUkmForm,
    studentUkmShow: StudentUkmShow,
    studentTestimony: StudentTestimony,
    studentTestimonyForm: StudentTestimonyForm,
    studentTestimonyShow: StudentTestimonyShow,
    campusLiveVideo: CampusLiveVideoIndex,
    campusLiveVideoForm: CampusLiveVideoForm,
    campusLiveVideoShow: CampusLiveVideoShow,
    lodgingInformationForm: LodgingInformationForm,
    pmbScholarshipForm: PmbScholarshipForm,
    pmbProgramExcellenceForm: PmbProgramExcellenceForm,
    pmbProgramRegulerForm: PmbProgramRegulerForm,
    pmbProgramExtensiForm: PmbProgramExtensiForm,
    role: Role,
    roleForm: RoleForm,
    user: User,
    userForm: UserForm,
    userShow: UserShow,
    brochure: Brochure,
    brochureForm: BrochureForm,
    brochureShow: BrochureShow,
    publicFiles: PublicFiles,
    publicFilesForm: PublicFilesForm,
    publicFilesShow: PublicFilesShow,
    voucher: Voucher,
    voucherForm: VoucherForm,
    voucherShow: VoucherShow,
    academicSchoolYear: AcademicSchoolYear,
    academicSchoolYearForm: AcademicSchoolYearForm,
    academicSchoolYearShow: AcademicSchoolYearShow,
    programStudy: ProgramStudy,
    programStudyForm: ProgramStudyForm,
    programStudyShow: ProgramStudyShow,
    paymentSettingForm: PaymentSettingForm,
    userSetting: UserSetting,
    categoryTeacher: CategoryTeacher,
    categoryTeacherShow: CategoryTeacherShow,
    jobTitle: JobTitle,
    jobTitleShow: JobTitleShow,
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
