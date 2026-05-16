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
            Kembali ke Daftar PMB
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
                  <p class="text-slate-500 font-medium animate-pulse">Memuat Detail Pendaftar...</p>
              </div>
          </div>
        </transition>

        <div v-if="pmb.id" class="max-w-4xl mx-auto space-y-6 pb-12">
          
          <!-- Header Card -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 flex flex-col md:flex-row items-center gap-8">
            <div class="w-24 h-24 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-4xl font-black uppercase shrink-0 shadow-inner">
                {{ pmb.nama_lengkap.charAt(0) }}
            </div>
            <div class="flex-1 text-center md:text-left">
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-2 mb-2">
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-full text-xs font-bold uppercase tracking-wider">
                        {{ pmb.program_studi }}
                    </span>
                    <span class="px-3 py-1 bg-slate-100 text-slate-600 border border-slate-200 rounded-full text-xs font-bold uppercase tracking-wider">
                        Jalur: {{ pmb.jalur_registrasi }}
                    </span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-1">{{ pmb.nama_lengkap }}</h1>
                <p class="text-slate-500 font-medium">{{ pmb.email }} • {{ pmb.nomor_hp_wa }}</p>
            </div>
          </div>

          <!-- Detail Information Grid -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-8 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                    </svg>
                    Informasi Pribadi & Pendaftaran
                </h2>
            </div>
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Data Fields -->
                <div class="space-y-1">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tempat, Tanggal Lahir</p>
                    <p class="text-slate-900 font-medium">{{ pmb.tempat_lahir }}, {{ formatDateOnly(pmb.tanggal_lahir) }}</p>
                </div>
                
                <div class="space-y-1">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jenis Kelamin</p>
                    <p class="text-slate-900 font-medium">{{ pmb.jenis_kelamin }}</p>
                </div>

                <div class="space-y-1 md:col-span-2">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Alamat Asal</p>
                    <p class="text-slate-900 font-medium leading-relaxed">{{ pmb.alamat_asal }}</p>
                </div>

                <div class="space-y-1">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Asal Sekolah</p>
                    <p class="text-slate-900 font-medium">{{ pmb.asal_sekolah }}</p>
                </div>

                <div class="space-y-1">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Sumber Informasi</p>
                    <p class="text-slate-900 font-medium">{{ pmb.sumber_informasi }}</p>
                </div>

                <div class="space-y-1">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kode Voucher</p>
                    <p class="text-slate-900 font-medium">
                        <span v-if="pmb.kode_voucher" class="px-2 py-1 bg-amber-50 text-amber-700 font-mono text-sm rounded border border-amber-200">{{ pmb.kode_voucher }}</span>
                        <span v-else class="text-slate-400 italic">Tidak ada</span>
                    </p>
                </div>

                <div class="space-y-1">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Pendaftaran</p>
                    <p class="text-slate-900 font-medium">{{ formatDateFull(pmb.created_at) }}</p>
                </div>
            </div>
          </div>

          <!-- Quick Actions Footer -->
          <div class="flex justify-between items-center bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
            <div class="text-sm text-slate-400">
                Terakhir diperbarui: {{ formatDateFull(pmb.updated_at || pmb.created_at) }}
            </div>
            <div class="flex gap-3">
                <a :href="`/pmb/edit/${pmb.id}`">
                    <AppButton variant="secondary" size="md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Edit Data
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
import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../Components/Atoms/AppButton.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isLoading = ref(false);
const pmb = ref({});

const formatDateOnly = (dateString) => {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });
};

const formatDateFull = (dateString) => {
  if (!dateString) return '-';
  const date = new Date(dateString);
  return date.toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
};

const fetchPmbDetail = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const response = await axios.get(`/api/pmbs/${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      pmb.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching PMB detail:', error);
    if (error.response?.status === 404) {
       window.location.href = '/pmb';
    }
  } finally {
    isLoading.value = false;
  }
};

const goBack = () => {
    window.location.href = '/pmb';
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
    fetchPmbDetail();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
