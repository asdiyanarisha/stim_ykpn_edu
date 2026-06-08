<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden font-sans">
    <!-- Sidebar -->
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
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
                <p class="text-slate-500 font-medium">Memuat rincian affiliate...</p>
            </div>
        </div>
      </transition>

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="max-w-4xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
              <a href="/affiliate" class="hover:text-indigo-600 transition-colors">Manajemen Affiliate</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">Detail Affiliate</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Rincian Informasi Affiliate</h1>
            <p class="text-slate-500">Lihat profil lengkap dan detail rekening bank mitra.</p>
          </div>
          <div class="flex items-center gap-3">
            <AppButton variant="secondary" size="md" @click="goBack">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
              Kembali
            </AppButton>
            <a :href="`/affiliate/edit/${affiliateId}`" v-if="affiliate">
              <AppButton variant="primary" size="md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                Ubah Data
              </AppButton>
            </a>
          </div>
        </div>

        <div class="max-w-4xl mx-auto" v-if="affiliate">
          <div class="space-y-6">
            <!-- Profile Card -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </span>
                Profil Mitra
              </h2>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                <div>
                  <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Lengkap</label>
                  <p class="text-sm font-semibold text-slate-900">{{ affiliate.name }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Username</label>
                  <p class="text-sm font-semibold text-slate-900">{{ affiliate.username }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Email</label>
                  <p class="text-sm font-semibold text-slate-900">{{ affiliate.email }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">No. HP / Whatsapp</label>
                  <p class="text-sm font-semibold text-slate-900">{{ affiliate.phone_number }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Instansi</label>
                  <p class="text-sm font-semibold text-slate-900">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                      {{ affiliate.institution }}
                    </span>
                  </p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Jabatan</label>
                  <p class="text-sm font-semibold text-slate-900">{{ affiliate.position || '-' }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Kota</label>
                  <p class="text-sm font-semibold text-slate-900">{{ affiliate.city }}</p>
                </div>

                <div class="md:col-span-2">
                  <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Alamat Lengkap</label>
                  <p class="text-sm font-medium text-slate-700 bg-slate-50 p-4 rounded-2xl border border-slate-100 leading-relaxed mb-4">{{ affiliate.address }}</p>
                </div>

                <!-- Referral Link Section -->
                <div class="md:col-span-2 p-5 bg-emerald-50/50 rounded-2xl border border-emerald-100/80 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                  <div class="space-y-1">
                    <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Link Pendaftaran PMB (Referral Affiliate)</span>
                    <p class="text-sm font-semibold text-slate-700 break-all select-all">{{ getReferralLink(affiliate.username) }}</p>
                  </div>
                  <AppButton type="button" variant="primary" size="md" class="bg-emerald-600 hover:bg-emerald-700 shadow-emerald-200 border-emerald-600 shrink-0 text-white" @click="copyReferralLink(affiliate.username)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                    </svg>
                    Salin Link PMB
                  </AppButton>
                </div>
              </div>
            </div>

            <!-- Bank Card -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                </span>
                Informasi Rekening Bank
              </h2>

              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                  <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Bank</label>
                  <p class="text-sm font-semibold text-slate-900">{{ affiliate.bank_name || 'Belum diisi' }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Atas Nama Rekening</label>
                  <p class="text-sm font-semibold text-slate-900">{{ affiliate.account_holder_name || 'Belum diisi' }}</p>
                </div>

                <div>
                  <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">No. Rekening</label>
                  <p class="text-sm font-semibold text-slate-900">{{ affiliate.account_number || 'Belum diisi' }}</p>
                </div>
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
import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../Components/Atoms/AppButton.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isLoading = ref(false);
const affiliate = ref(null);
const affiliateId = ref(null);

const goBack = () => {
  window.location.href = '/affiliate';
};

const getReferralLink = (username) => {
  return `${window.location.origin}/pmb.html?affiliate=${username}`;
};

const copyReferralLink = (username) => {
  const link = getReferralLink(username);
  navigator.clipboard.writeText(link).then(() => {
    Swal.fire({
      icon: 'success',
      title: 'Link Referral Berhasil Disalin!',
      text: link,
      timer: 2000,
      showConfirmButton: false,
      toast: true,
      position: 'top-end'
    });
  }).catch(err => {
    console.error('Failed to copy link: ', err);
    Swal.fire({
      icon: 'error',
      title: 'Gagal Menyalin Link',
      text: 'Silakan salin secara manual: ' + link,
      confirmButtonColor: '#d33'
    });
  });
};

const fetchAffiliateData = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    affiliateId.value = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const response = await axios.get(`/api/affiliates/${affiliateId.value}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      affiliate.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching affiliate data:', error);
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan',
      text: 'Gagal mengambil data affiliate.',
    }).then(() => {
      goBack();
    });
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
    await fetchAffiliateData();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
