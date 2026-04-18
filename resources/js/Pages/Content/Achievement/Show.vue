<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden font-sans">
    <!-- Sidebar -->
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden border-l border-slate-100">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <!-- Global Loading Overlay -->
      <transition 
        enter-active-class="transition duration-300 ease-out" 
        enter-from-class="opacity-0" 
        enter-to-class="opacity-100" 
        leave-active-class="transition duration-200 ease-in" 
        leave-from-class="opacity-100" 
        leave-to-class="opacity-0"
      >
        <div v-if="isLoading" class="absolute inset-0 z-[60] bg-slate-50/80 backdrop-blur-sm flex items-center justify-center">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin mb-4"></div>
                <p class="text-slate-500 font-medium animate-pulse">Memuat Detail Prestasi...</p>
            </div>
        </div>
      </transition>

      <main v-if="achievement" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="max-w-5xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 text-xs text-indigo-500 font-bold uppercase tracking-widest mb-2">
              <a href="/content/profil/achievement" class="hover:text-indigo-700 transition-colors">Daftar Prestasi</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-400">Detail Prestasi</span>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ achievement.title }}</h1>
            <p class="text-slate-500 mt-1 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
              Diterbitkan pada {{ new Date(achievement.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) }}
            </p>
          </div>
          
          <div class="flex items-center gap-3">
             <a :href="`/content/profil/achievement/edit/${achievement.id}`">
                <AppButton variant="secondary" size="md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    Edit
                </AppButton>
             </a>
             <a href="/content/profil/achievement">
                <AppButton variant="outline" size="md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali
                </AppButton>
             </a>
          </div>
        </div>

        <div class="max-w-5xl mx-auto space-y-8 pb-20">
            <!-- Visual Header -->
            <div v-if="achievement.header_image" class="relative group">
                <div class="w-full aspect-video rounded-[2.5rem] overflow-hidden shadow-2xl shadow-indigo-100 border border-slate-100 bg-slate-200">
                    <img :src="achievement.header_image" :alt="achievement.title" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Content Area -->
            <div class="bg-white rounded-[2.5rem] p-10 sm:p-14 shadow-sm border border-slate-100">
                <div class="prose prose-indigo max-w-none prose-lg prose-slate prose-headings:font-extrabold prose-headings:tracking-tight prose-p:leading-relaxed prose-img:rounded-3xl" v-html="achievement.content">
                </div>
            </div>
            
            <!-- Metadata Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                 <div class="bg-indigo-50/50 rounded-3xl p-8 border border-indigo-100/50 flex items-center gap-5">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-indigo-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-indigo-400 uppercase tracking-widest mb-1">Terakhir Diperbarui</p>
                        <p class="text-slate-900 font-bold text-lg">{{ new Date(achievement.updated_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' }) }}</p>
                    </div>
                 </div>
                 
                 <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 flex items-center gap-5">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-slate-400 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">ID Pencatatan</p>
                        <p class="text-slate-900 font-bold text-lg">PRES-{{ achievement.id.toString().padStart(4, '0') }}</p>
                    </div>
                 </div>
            </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import AppSidebar from '../../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../../Components/Atoms/AppButton.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isLoading = ref(false);
const achievement = ref(null);

const fetchAchievement = async (id) => {
    isLoading.value = true;
    try {
        const token = getCookie(TOKEN_COOKIE_NAME);
        const response = await axios.get(`/api/achievements/${id}`, {
            headers: { Authorization: `Bearer ${token}` }
        });
        
        if (response.data.status === 'success') {
            achievement.value = response.data.data;
        }
    } catch (error) {
        console.error('Error fetching achievement:', error);
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal mengambil detail prestasi.' });
    } finally {
        isLoading.value = false;
    }
};

onMounted(async () => {
    const token = getCookie(TOKEN_COOKIE_NAME);
    if (!token) {
        window.location.href = '/unauthenticated';
        return;
    }
    try {
        await axios.post('/api/auth/validate-token', {}, {
            headers: { Authorization: `Bearer ${token}` }
        });
        isAuthenticated.value = true;
        
        const id = window.location.pathname.split('/').pop();
        if (id) fetchAchievement(id);
    } catch (error) {
        deleteCookie(TOKEN_COOKIE_NAME);
        window.location.href = '/unauthenticated';
    }
});
</script>

<style scoped>
/* Typography & Prose Styling */
:deep(.prose) {
  color: #334155;
}
:deep(.prose h1), :deep(.prose h2), :deep(.prose h3) {
  color: #0f172a;
}
:deep(.prose p) {
  margin-top: 1.5em;
  margin-bottom: 1.5em;
}
:deep(.prose img) {
  margin-top: 2em;
  margin-bottom: 2em;
  box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.05), 0 8px 10px -6px rgb(0 0 0 / 0.05);
}
</style>
