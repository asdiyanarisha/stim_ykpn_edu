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
            Kembali ke Daftar Voucher
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
                  <p class="text-slate-500 font-medium animate-pulse">Memuat Detail Voucher...</p>
              </div>
          </div>
        </transition>

        <div v-if="voucher.id" class="max-w-4xl mx-auto space-y-8 pb-12">
          <!-- Voucher Content Area -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <!-- Header with Icon -->
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>
                    </div>
                    <div>
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase tracking-wider rounded-lg border border-indigo-100 inline-block mb-2">Manajemen Voucher</span>
                        <h1 class="text-3xl font-extrabold text-slate-900 leading-tight">{{ voucher.title || 'Tanpa Judul' }}</h1>
                    </div>
                </div>
                
                <!-- Divider -->
                <div class="h-px bg-slate-100 w-full mb-8"></div>

                <!-- Main Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 space-y-6">
                        <div class="space-y-3">
                            <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Deskripsi Voucher</h2>
                            <p class="text-slate-600 leading-relaxed whitespace-pre-wrap">{{ voucher.description || 'Tidak ada deskripsi tersedia.' }}</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-4">
                            <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Informasi Kupon</h2>
                            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 space-y-4">
                                <div class="flex flex-col gap-1">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Kode Kupon</span>
                                    <span class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-indigo-700 font-extrabold text-center tracking-widest uppercase shadow-sm">
                                        {{ voucher.code_coupon || '-' }}
                                    </span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Nominal Diskon</span>
                                    <span class="text-indigo-600 font-extrabold text-xl">Rp {{ formatNumber(voucher.discount_amount) }}</span>
                                </div>
                                <div class="flex flex-col gap-1 pt-2 border-t border-slate-200/60">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Dibuat Pada</span>
                                    <span class="text-slate-700 font-semibold text-xs">{{ formatDate(voucher.created_at) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metadata -->
                <div class="mt-12 flex items-center gap-6 text-sm text-slate-400 border-t border-slate-50 pt-8">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Terakhir diubah: {{ formatDate(voucher.updated_at || voucher.created_at) }}
                    </div>
                </div>
            </div>
          </div>

          <!-- Quick Actions Footer -->
          <div class="flex justify-between items-center bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
            <div class="text-sm text-slate-400 italic">
                Informasi voucher ini digunakan untuk potongan biaya pendaftaran.
            </div>
            <div class="flex gap-3">
                <a :href="`/voucher/edit/${voucher.id}`">
                    <AppButton variant="secondary" size="md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Ubah Voucher
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
const voucher = ref({});

const formatNumber = (num) => {
    return new Intl.NumberFormat('id-ID').format(num);
};

const formatDate = (dateString) => {
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

const fetchVoucherData = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const response = await axios.get(`/api/vouchers/${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      voucher.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching voucher detail:', error);
    if (error.response?.status === 404) {
       window.location.href = '/voucher';
    }
  } finally {
    isLoading.value = false;
  }
};

const goBack = () => {
    window.location.href = '/voucher';
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
    fetchVoucherData();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
