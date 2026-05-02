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
            Kembali ke Daftar Program Studi
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
                  <p class="text-slate-500 font-medium animate-pulse">Memuat Detail Program Studi...</p>
              </div>
          </div>
        </transition>

        <div v-if="item.id" class="max-w-4xl mx-auto space-y-8 pb-12">
          <!-- Content Area -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <!-- Header with Icon -->
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <div>
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase tracking-wider rounded-lg border border-indigo-100 inline-block mb-2">Informasi Program Studi</span>
                        <h1 class="text-3xl font-extrabold text-slate-900 leading-tight">{{ item.name }}</h1>
                    </div>
                </div>
                
                <!-- Divider -->
                <div class="h-px bg-slate-100 w-full mb-8"></div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="space-y-4">
                            <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Detail Program</h2>
                            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 space-y-4">
                                <div class="flex flex-col gap-1">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Grade</span>
                                    <span class="text-slate-700 font-bold text-lg">{{ item.grade }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-4">
                            <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Rincian Biaya SPA</h2>
                            <div class="bg-indigo-50/30 rounded-2xl p-6 border border-indigo-100/50 space-y-4">
                                <div class="flex flex-col gap-1">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-400">SPA Total</span>
                                    <span class="text-indigo-600 font-extrabold text-2xl">Rp {{ formatNumber(item.spa_fee) }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-indigo-100/50">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">SPA Tetap</span>
                                        <span class="text-slate-700 font-bold text-sm">Rp {{ formatNumber(item.spa_fee_fixed) }}</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">SPA Variabel</span>
                                        <span class="text-slate-700 font-bold text-sm">Rp {{ formatNumber(item.spa_fee_variable) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metadata -->
                <div class="mt-12 flex flex-wrap items-center gap-6 text-[10px] font-bold uppercase tracking-widest text-slate-300 border-t border-slate-50 pt-8">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Dibuat: {{ formatDateTime(item.created_at) }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                        Diperbarui: {{ formatDateTime(item.updated_at) }}
                    </div>
                </div>
            </div>
          </div>

          <!-- Quick Actions Footer -->
          <div class="flex justify-between items-center bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
            <div class="text-sm text-slate-400 italic">Data ini digunakan untuk rincian administrasi biaya mahasiswa.</div>
            <div class="flex gap-3">
                <a :href="`/academic/programs/edit/${item.id}`">
                    <AppButton variant="secondary" size="md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Ubah Data
                    </AppButton>
                </a>
                <AppButton variant="primary" size="md" @click="goBack">Selesai</AppButton>
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
import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../Components/Atoms/AppButton.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isLoading = ref(false);
const item = ref({});

const formatNumber = (num) => {
    return new Intl.NumberFormat('id-ID').format(num);
};

const formatDateTime = (dateString) => {
  if (!dateString) return '-';
  const date = new Date(dateString);
  return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
};

const fetchItemData = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.get(`/api/program-studies/${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    if (response.data.status === 'success') { item.value = response.data.data; }
  } catch (error) {
    console.error('Error fetching detail:', error);
    if (error.response?.status === 404) window.location.href = '/academic/programs';
  } finally {
    isLoading.value = false;
  }
};

const goBack = () => { window.location.href = '/academic/programs'; };

onMounted(async () => {
  const token = getCookie(TOKEN_COOKIE_NAME);
  if (!token) { window.location.href = '/unauthenticated'; return; }
  try {
    await axios.post('/api/auth/validate-token', {}, { headers: { Authorization: `Bearer ${token}` } });
    isAuthenticated.value = true;
    fetchItemData();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
