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
            Kembali ke Daftar Jabatan
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
                  <p class="text-slate-500 font-medium animate-pulse">Memuat Detail Jabatan...</p>
              </div>
          </div>
        </transition>

        <div v-if="jobTitle.id" class="max-w-4xl mx-auto space-y-8 pb-12">
          <!-- Job Title Detail Card -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-6 mb-8 text-sm text-slate-400">
                    <div class="flex items-center gap-2 text-indigo-600 font-bold bg-indigo-50 px-3 py-1 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                        {{ jobTitle.slug || 'Tanpa slug' }}
                    </div>
                </div>

                <div class="mb-10">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">{{ jobTitle.title || 'Tanpa Judul' }}</h1>
                </div>

                <!-- Additional Info Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-1">Tanggal Entry</p>
                        <p class="font-bold text-slate-700">{{ formatFullDate(jobTitle.created_at) }}</p>
                    </div>
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-1">Terakhir Diperbarui</p>
                        <p class="font-bold text-slate-700">{{ formatFullDate(jobTitle.updated_at) }}</p>
                    </div>
                </div>
            </div>
          </div>

          <!-- Actions Footer -->
          <div class="flex justify-between items-center bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
            <div class="text-sm text-slate-400 italic">
                Informasi detail jabatan.
            </div>
            <div class="flex gap-3">
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
const jobTitle = ref({});

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

const fetchJobTitleDetail = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const response = await axios.get(`/api/job-titles/${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      jobTitle.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching job title detail:', error);
    if (error.response?.status === 404) {
       window.location.href = '/masterData/job-title';
    }
  } finally {
    isLoading.value = false;
  }
};

const goBack = () => {
    window.location.href = '/masterData/job-title';
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
    fetchJobTitleDetail();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
