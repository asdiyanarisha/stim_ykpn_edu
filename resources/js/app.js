import './bootstrap';
import { createApp, h, defineAsyncComponent } from 'vue';

// ─── Lazy-loaded Page Registry ────────────────────────────────────────────────
// Each component is only downloaded by the browser when the matching
// data-page attribute is found on the #app element.
const pages = {
    // Auth / Core
    dashboard:                    defineAsyncComponent(() => import('./Pages/Dashboard.vue')),
    login:                        defineAsyncComponent(() => import('./Pages/Login.vue')),
    unauthenticated:              defineAsyncComponent(() => import('./Pages/Unauthenticated.vue')),

    // Teacher
    teacher:                      defineAsyncComponent(() => import('./Pages/Teacher/index.vue')),
    teacherForm:                  defineAsyncComponent(() => import('./Pages/Teacher/TeacherForm.vue')),
    teacherShow:                  defineAsyncComponent(() => import('./Pages/Teacher/Show.vue')),
    teacherEdit:                  defineAsyncComponent(() => import('./Pages/Teacher/TeacherEdit.vue')),
    categoryTeacher:              defineAsyncComponent(() => import('./Pages/Teacher/CategoryTeacher/index.vue')),
    categoryTeacherShow:          defineAsyncComponent(() => import('./Pages/Teacher/CategoryTeacher/Show.vue')),

    // Affiliate
    affiliate:                    defineAsyncComponent(() => import('./Pages/Affiliate/index.vue')),
    affiliateForm:                defineAsyncComponent(() => import('./Pages/Affiliate/Form.vue')),
    affiliateShow:                defineAsyncComponent(() => import('./Pages/Affiliate/Show.vue')),
    affiliateEdit:                defineAsyncComponent(() => import('./Pages/Affiliate/Edit.vue')),

    // Content — Banner
    banner:                       defineAsyncComponent(() => import('./Pages/Content/Banner/index.vue')),
    bannerShow:                   defineAsyncComponent(() => import('./Pages/Content/Banner/Show.vue')),
    bannerForm:                   defineAsyncComponent(() => import('./Pages/Content/Banner/BannerForm.vue')),
    bannerEdit:                   defineAsyncComponent(() => import('./Pages/Content/Banner/BannerEdit.vue')),

    // Content — News
    news:                         defineAsyncComponent(() => import('./Pages/Content/News/index.vue')),
    newsForm:                     defineAsyncComponent(() => import('./Pages/Content/News/NewsForm.vue')),
    newsShow:                     defineAsyncComponent(() => import('./Pages/Content/News/Show.vue')),

    // Content — Announcements
    announcement:                 defineAsyncComponent(() => import('./Pages/Content/Announcement/index.vue')),
    announcementForm:             defineAsyncComponent(() => import('./Pages/Content/Announcement/AnnouncementForm.vue')),
    announcementShow:             defineAsyncComponent(() => import('./Pages/Content/Announcement/Show.vue')),

    // Content — Misc
    jobVacancies:                 defineAsyncComponent(() => import('./Pages/Content/JobVacancy/index.vue')),
    jobVacancyForm:               defineAsyncComponent(() => import('./Pages/Content/JobVacancy/JobVacancyForm.vue')),
    certificationLogos:           defineAsyncComponent(() => import('./Pages/Content/CertificationLogo/index.vue')),
    certificationLogoForm:        defineAsyncComponent(() => import('./Pages/Content/CertificationLogo/CertificationLogoForm.vue')),
    greetingChiefForm:            defineAsyncComponent(() => import('./Pages/Content/GreetingChief/GreetingChiefForm.vue')),
    coreValueForm:                defineAsyncComponent(() => import('./Pages/Content/CoreValue/CoreValueForm.vue')),
    historyForm:                  defineAsyncComponent(() => import('./Pages/Content/History/HistoryForm.vue')),
    logoSymbolForm:               defineAsyncComponent(() => import('./Pages/Content/LogoSymbol/LogoSymbolForm.vue')),
    facilityIndex:                defineAsyncComponent(() => import('./Pages/Content/Facility/index.vue')),
    facilityForm:                 defineAsyncComponent(() => import('./Pages/Content/Facility/FacilityForm.vue')),
    facilityEdit:                 defineAsyncComponent(() => import('./Pages/Content/Facility/FacilityEdit.vue')),
    facilityShow:                 defineAsyncComponent(() => import('./Pages/Content/Facility/Show.vue')),
    spmiAkreditasiForm:           defineAsyncComponent(() => import('./Pages/Content/SpmiAkreditasi/SpmiAkreditasiForm.vue')),

    // Content — Academic
    academicGoalForm:             defineAsyncComponent(() => import('./Pages/Content/Academic/AcademicGoalForm.vue')),
    academicGoalAchieveForm:      defineAsyncComponent(() => import('./Pages/Content/Academic/AcademicGoalAchieveForm.vue')),
    studyLoadForm:                defineAsyncComponent(() => import('./Pages/Content/Academic/StudyLoadForm.vue')),
    sksForm:                      defineAsyncComponent(() => import('./Pages/Content/Academic/SksForm.vue')),
    levelPeriodStudyForm:         defineAsyncComponent(() => import('./Pages/Content/Academic/LevelPeriodStudyForm.vue')),
    academicActivitiesForm:       defineAsyncComponent(() => import('./Pages/Content/Academic/AcademicActivityForm.vue')),
    academicAdvisorForm:          defineAsyncComponent(() => import('./Pages/Content/Academic/AcademicAdvisorForm.vue')),
    academicSanctionForm:         defineAsyncComponent(() => import('./Pages/Content/Academic/AcademicSanctionForm.vue')),
    attendanceLectureForm:        defineAsyncComponent(() => import('./Pages/Content/Academic/AttendanceLectureForm.vue')),
    codeConductForm:              defineAsyncComponent(() => import('./Pages/Content/Academic/CodeConductForm.vue')),
    classCapacityForm:            defineAsyncComponent(() => import('./Pages/Content/Academic/ClassCapacityForm.vue')),
    attendanceCountForm:          defineAsyncComponent(() => import('./Pages/Content/Academic/AttendanceCountForm.vue')),
    evaluationSystemForm:         defineAsyncComponent(() => import('./Pages/Content/Academic/EvaluationSystemForm.vue')),
    seminarProposalForm:          defineAsyncComponent(() => import('./Pages/Content/Academic/SeminarProposalForm.vue')),
    academicCalendarForm:         defineAsyncComponent(() => import('./Pages/Content/AcademicCalendarForm.vue')),
    academicCalendarCategory:     defineAsyncComponent(() => import('./Pages/Content/AcademicCalendarCategory/index.vue')),
    academicLibraryForm:          defineAsyncComponent(() => import('./Pages/Content/Academic/LibraryForm.vue')),

    // Content — Academic Graduation
    examForm:                     defineAsyncComponent(() => import('./Pages/Content/Academic/Graduation/ExamForm.vue')),
    examRulesForm:                defineAsyncComponent(() => import('./Pages/Content/Academic/Graduation/ExamRulesForm.vue')),
    graduationForm:               defineAsyncComponent(() => import('./Pages/Content/Academic/Graduation/GraduationForm.vue')),
    yudisiumForm:                 defineAsyncComponent(() => import('./Pages/Content/Academic/Graduation/YudisiumForm.vue')),
    graduationAnnouncementForm:   defineAsyncComponent(() => import('./Pages/Content/Academic/Graduation/GraduationAnnouncementForm.vue')),

    // Content — Achievement
    achievementIndex:             defineAsyncComponent(() => import('./Pages/Content/Achievement/index.vue')),
    achievementForm:              defineAsyncComponent(() => import('./Pages/Content/Achievement/AchievementForm.vue')),
    achievementEdit:              defineAsyncComponent(() => import('./Pages/Content/Achievement/AchievementEdit.vue')),
    achievementShow:              defineAsyncComponent(() => import('./Pages/Content/Achievement/Show.vue')),

    // Research / Journal
    journal:                      defineAsyncComponent(() => import('./Pages/Research/Journal/index.vue')),
    journalForm:                  defineAsyncComponent(() => import('./Pages/Research/Journal/Form.vue')),
    journalShow:                  defineAsyncComponent(() => import('./Pages/Research/Journal/Show.vue')),

    // Student
    studentActivity:              defineAsyncComponent(() => import('./Pages/Student/Activity/index.vue')),
    studentActivityForm:          defineAsyncComponent(() => import('./Pages/Student/Activity/Form.vue')),
    studentActivityShow:          defineAsyncComponent(() => import('./Pages/Student/Activity/Show.vue')),
    studentUkm:                   defineAsyncComponent(() => import('./Pages/Student/Ukm/index.vue')),
    studentUkmForm:               defineAsyncComponent(() => import('./Pages/Student/Ukm/Form.vue')),
    studentUkmShow:               defineAsyncComponent(() => import('./Pages/Student/Ukm/Show.vue')),
    studentTestimony:             defineAsyncComponent(() => import('./Pages/Student/Testimony/index.vue')),
    studentTestimonyForm:         defineAsyncComponent(() => import('./Pages/Student/Testimony/Form.vue')),
    studentTestimonyShow:         defineAsyncComponent(() => import('./Pages/Student/Testimony/Show.vue')),

    // Campus Life
    campusLiveVideo:              defineAsyncComponent(() => import('./Pages/CampusLife/Video/index.vue')),
    campusLiveVideoForm:          defineAsyncComponent(() => import('./Pages/CampusLife/Video/Form.vue')),
    campusLiveVideoShow:          defineAsyncComponent(() => import('./Pages/CampusLife/Video/Show.vue')),
    lodgingInformationForm:       defineAsyncComponent(() => import('./Pages/CampusLife/LodgingInformationForm.vue')),

    // PMB
    pmbScholarshipForm:           defineAsyncComponent(() => import('./Pages/Pmb/ScholarshipForm.vue')),
    pmbProgramExcellenceForm:     defineAsyncComponent(() => import('./Pages/Pmb/ProgramExcellenceForm.vue')),
    pmbProgramRegulerForm:        defineAsyncComponent(() => import('./Pages/Pmb/ProgramRegulerForm.vue')),
    pmbProgramExtensiForm:        defineAsyncComponent(() => import('./Pages/Pmb/ProgramExtensiForm.vue')),

    // Roles & Users
    role:                         defineAsyncComponent(() => import('./Pages/Role/index.vue')),
    roleForm:                     defineAsyncComponent(() => import('./Pages/Role/RoleForm.vue')),
    user:                         defineAsyncComponent(() => import('./Pages/User/index.vue')),
    userForm:                     defineAsyncComponent(() => import('./Pages/User/UserForm.vue')),
    userShow:                     defineAsyncComponent(() => import('./Pages/User/Show.vue')),
    userSetting:                  defineAsyncComponent(() => import('./Pages/Setting/UserSetting.vue')),

    // Brochure & Files
    brochure:                     defineAsyncComponent(() => import('./Pages/Brochure/index.vue')),
    brochureForm:                 defineAsyncComponent(() => import('./Pages/Brochure/BrochureForm.vue')),
    brochureShow:                 defineAsyncComponent(() => import('./Pages/Brochure/Show.vue')),
    publicFiles:                  defineAsyncComponent(() => import('./Pages/PublicFiles/index.vue')),
    publicFilesForm:              defineAsyncComponent(() => import('./Pages/PublicFiles/PublicFilesForm.vue')),
    publicFilesShow:              defineAsyncComponent(() => import('./Pages/PublicFiles/Show.vue')),

    // Voucher
    voucher:                      defineAsyncComponent(() => import('./Pages/Voucher/index.vue')),
    voucherForm:                  defineAsyncComponent(() => import('./Pages/Voucher/VoucherForm.vue')),
    voucherShow:                  defineAsyncComponent(() => import('./Pages/Voucher/Show.vue')),

    // Academic Year
    academicSchoolYear:           defineAsyncComponent(() => import('./Pages/AcademicYear/index.vue')),
    academicSchoolYearForm:       defineAsyncComponent(() => import('./Pages/AcademicYear/SchoolYearForm.vue')),
    academicSchoolYearShow:       defineAsyncComponent(() => import('./Pages/AcademicYear/Show.vue')),

    // Program Study
    programStudy:                 defineAsyncComponent(() => import('./Pages/ProgramStudy/index.vue')),
    programStudyForm:             defineAsyncComponent(() => import('./Pages/ProgramStudy/ProgramStudyForm.vue')),
    programStudyShow:             defineAsyncComponent(() => import('./Pages/ProgramStudy/Show.vue')),

    // Payment & Settings
    paymentSettingForm:           defineAsyncComponent(() => import('./Pages/PaymentSetting/PaymentSettingForm.vue')),

    // Master Data
    jobTitle:                     defineAsyncComponent(() => import('./Pages/MasterData/JobTitle/index.vue')),
    jobTitleShow:                 defineAsyncComponent(() => import('./Pages/MasterData/JobTitle/Show.vue')),

    // PMB Admin
    pmbAdmin:                     defineAsyncComponent(() => import('./Pages/PmbAdmin/index.vue')),
    pmbAdminShow:                 defineAsyncComponent(() => import('./Pages/PmbAdmin/Show.vue')),
    pmbAdminEdit:                 defineAsyncComponent(() => import('./Pages/PmbAdmin/Edit.vue')),

    // Misc
    whatsappContact:              defineAsyncComponent(() => import('./Pages/WhatsappContact/index.vue')),

    // Public Frontend
    pmbFrontendForm:              defineAsyncComponent(() => import('./Pages/Frontend/PmbForm.vue')),
};

// ─── Mount App ────────────────────────────────────────────────────────────────
const appElement = document.getElementById('app');

if (appElement) {
    const pageName = appElement.dataset.page;
    const rootComponent = pages[pageName];

    if (rootComponent) {
        // Import Global Components lazily (only once, shared across all pages)
        Promise.all([
            import('./Components/Organisms/AppSidebar.vue'),
            import('./Components/Organisms/AppNavbar.vue'),
            import('./Components/Molecules/StatCard.vue'),
            import('./Components/Atoms/AppButton.vue'),
            import('./Components/Atoms/AppInput.vue'),
        ]).then(([AppSidebar, AppNavbar, StatCard, AppButton, AppInput]) => {
            const app = createApp({
                render: () => h(rootComponent)
            });

            app.component('AppSidebar', AppSidebar.default);
            app.component('AppNavbar', AppNavbar.default);
            app.component('StatCard', StatCard.default);
            app.component('AppButton', AppButton.default);
            app.component('AppInput', AppInput.default);

            app.mount('#app');
        });
    }
}
