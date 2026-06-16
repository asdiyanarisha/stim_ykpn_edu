import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/frontend.css',
                'resources/js/frontend.js'
            ],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js',
        },
    },
    build: {
        rollupOptions: {
            output: {
                // Split chunks per feature group so the browser only downloads
                // what the current page actually needs. Each chunk is also
                // independently cacheable — unchanged chunks are never re-downloaded.
                manualChunks(id) {
                    // ── Vendor libraries ──────────────────────────────────────
                    // Note: vue is kept inside 'vendor' to avoid circular chunks
                    if (id.includes('node_modules/axios'))      return 'vendor-axios';
                    if (id.includes('node_modules/sweetalert')) return 'vendor-swal';
                    if (id.includes('node_modules'))            return 'vendor';

                    // ── Global shared UI components ───────────────────────────
                    if (id.includes('Components/Organisms') ||
                        id.includes('Components/Molecules') ||
                        id.includes('Components/Atoms'))        return 'chunk-global-components';

                    // ── Feature chunks (loaded only when page is visited) ─────
                    if (id.includes('Pages/Frontend'))          return 'chunk-frontend';
                    if (id.includes('Pages/PmbAdmin') ||
                        id.includes('Pages/Pmb'))               return 'chunk-pmb';
                    if (id.includes('Pages/Content/Academic') ||
                        id.includes('Pages/Content/AcademicCalendar')) return 'chunk-academic';
                    if (id.includes('Pages/Content'))           return 'chunk-content';
                    if (id.includes('Pages/Student'))           return 'chunk-student';
                    if (id.includes('Pages/CampusLife'))        return 'chunk-campus-life';
                    if (id.includes('Pages/Research'))          return 'chunk-research';
                    if (id.includes('Pages/Teacher'))           return 'chunk-teacher';
                    if (id.includes('Pages/User') ||
                        id.includes('Pages/Role') ||
                        id.includes('Pages/Setting'))           return 'chunk-users';
                    if (id.includes('Pages/Brochure') ||
                        id.includes('Pages/PublicFiles') ||
                        id.includes('Pages/Voucher') ||
                        id.includes('Pages/Affiliate'))         return 'chunk-misc';
                    if (id.includes('Pages/AcademicYear') ||
                        id.includes('Pages/ProgramStudy') ||
                        id.includes('Pages/MasterData') ||
                        id.includes('Pages/PaymentSetting') ||
                        id.includes('Pages/WhatsappContact'))   return 'chunk-settings';
                },
            },
        },
    },
});
