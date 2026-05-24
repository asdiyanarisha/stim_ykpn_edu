<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden font-sans">
    <!-- Sidebar -->
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Back Button -->
        <div class="max-w-4xl mx-auto mb-6">
          <button @click="goBack" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors cursor-pointer group">
            <div class="p-1.5 rounded-lg bg-white border border-slate-200 group-hover:border-indigo-100 group-hover:bg-indigo-50 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </div>
            Kembali ke Daftar UKM
          </button>
        </div>

        <!-- Global Loading Overlay -->
        <transition 
          enter-active-class="transition duration-300 ease-out" 
          enter-from-class="opacity-0" 
          enter-to-class="opacity-100" 
          leave-active-class="transition duration-200 ease-in" 
          leave-from-class="opacity-100" 
          leave-to-class="opacity-0"
        >
          <div v-if="!isAuthenticated || isLoading" class="absolute inset-0 z-[60] bg-slate-50/80 backdrop-blur-sm flex items-center justify-center">
              <div class="flex flex-col items-center">
                  <div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin mb-4"></div>
                  <p class="text-slate-500 font-medium animate-pulse">Memuat Detail UKM...</p>
              </div>
          </div>
        </transition>

        <div v-if="ukm.id" class="max-w-4xl mx-auto space-y-8 pb-12">
          <!-- Activity Detail Card -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <!-- Logo -->
            <div v-if="ukm.header_image" class="flex justify-center pt-10 pb-2">
                <div class="w-40 h-40 md:w-48 md:h-48 rounded-3xl overflow-hidden shadow-sm border border-slate-100 bg-white flex items-center justify-center p-4">
                    <img :src="ukm.header_image" class="max-w-full max-h-full object-contain">
                </div>
            </div>

            <div class="p-8 md:p-12">
                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-6 mb-8 text-sm text-slate-400">
                    <div class="flex items-center gap-2 text-indigo-600 font-bold bg-indigo-50 px-3 py-1 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        {{ ukm.location || 'Lokasi tidak disebutkan' }}
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-slate-400 text-[10px] uppercase tracking-wider font-bold">Waktu UKM</span>
                            <span class="font-bold text-slate-800 text-sm">
                                {{ ukm.day || '-' }}, {{ ukm.time || '-' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">{{ ukm.title || 'Tanpa Judul' }}</h1>
                </div>

                <!-- Content Section -->
                <div class="prose prose-slate max-w-none mb-10">
                    <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                        Deskripsi UKM
                    </h3>
                    <div v-if="ukm.content" v-html="ukm.content" class="text-slate-600 leading-relaxed quill-content"></div>
                    <div v-else class="text-slate-400 italic">Tidak ada deskripsi untuk UKM ini.</div>
                </div>

                <!-- Additional Info Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-1">Tanggal Entry</p>
                        <p class="font-bold text-slate-700">{{ formatFullDate(ukm.created_at) }}</p>
                    </div>
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-1">Terakhir Diperbarui</p>
                        <p class="font-bold text-slate-700">{{ formatFullDate(ukm.updated_at) }}</p>
                    </div>
                </div>
            </div>
          </div>

          <!-- Actions Footer -->
          <div class="flex justify-between items-center bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
            <div class="text-sm text-slate-400 italic">
                Informasi detail UKM.
            </div>
            <div class="flex gap-3">
                <a :href="`/student/ukm/edit/${ukm.id}`">
                    <AppButton variant="secondary" size="md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Ubah UKM
                    </AppButton>
                </a>
                <AppButton variant="primary" size="md" @click="goBack">
                    Selesai
                </AppButton>
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
import AppSidebar from '../../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../../Components/Atoms/AppButton.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isLoading = ref(false);
const ukm = ref({});

const formatDate = (dateString) => {
  if (!dateString) return '-';
  const date = new Date(dateString);
  return date.toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  });
};

const formatFullDate = (dateString) => {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const fetchActivityDetail = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const response = await axios.get(`/api/student-ukms/${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      ukm.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching UKM detail:', error);
    if (error.response?.status === 404) {
       window.location.href = '/student/ukm';
    }
  } finally {
    isLoading.value = false;
  }
};

const goBack = () => {
    window.location.href = '/student/ukm';
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
    fetchActivityDetail();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>

<style scoped>
.quill-content :deep(p) {
    margin-bottom: 1rem;
}
.quill-content :deep(img) {
    max-width: 100%;
    border-radius: 1rem;
    margin: 1rem 0;
}
</style>
