<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden font-sans">
    <!-- Sidebar -->
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Back Button -->
        <div class="max-w-5xl mx-auto mb-6">
          <button @click="goBack" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar Banner
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
                  <p class="text-slate-500 font-medium animate-pulse">Memuat Detail Banner...</p>
              </div>
          </div>
        </transition>

        <div v-if="banner.id" class="max-w-5xl mx-auto space-y-8 pb-12">
          <!-- Banner Header & Actions -->
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-2">
            <div>
              <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-xs text-slate-400">
                  <li>Manajemen Konten</li>
                  <li><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></li>
                  <li class="text-slate-500 font-medium">Detail Banner</li>
                </ol>
              </nav>
              <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ banner.title || 'Detail Banner' }}</h1>
              <div class="flex items-center gap-3 mt-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                  Aktif
                </span>
                <span class="text-slate-400 text-sm">ID: #{{ banner.id }}</span>
              </div>
            </div>
            <div class="flex items-center gap-3">
              <a :href="`/content/banner/edit/${banner.id}`">
                <AppButton variant="secondary" size="md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    Ubah Banner
                </AppButton>
              </a>
            </div>
          </div>

          <!-- Banner Visual Preview -->
          <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden group relative">
            <div class="aspect-video md:aspect-[21/9] bg-slate-100 overflow-hidden relative">
              <img :src="banner.url_image" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Banner Preview">
              
              <!-- Overlay Preview Label -->
              <div class="absolute top-4 left-4">
                <span class="px-3 py-1.5 bg-slate-900/40 backdrop-blur-md text-white text-[10px] uppercase font-bold tracking-widest rounded-lg border border-white/20">
                  Preview Visual
                </span>
              </div>
            </div>
          </div>

          <!-- Details Grid -->
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Content Info -->
            <div class="lg:col-span-2 space-y-8">
              <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-2 h-full bg-indigo-500 group-hover:w-3 transition-all"></div>
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                  <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                  </span>
                  Konten Banner
                </h2>
                
                <div class="space-y-6">
                  <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 block">Judul Banner</label>
                    <p class="text-lg font-bold text-slate-900 leading-tight">{{ banner.title }}</p>
                  </div>
                  
                  <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 block">Deskripsi</label>
                    <p class="text-slate-600 leading-relaxed">{{ banner.description || '-' }}</p>
                  </div>

                  <div class="pt-6 border-t border-slate-100 flex flex-wrap gap-8">
                    <div>
                      <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 block">Label Tombol</label>
                      <div class="flex items-center gap-2">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-sm font-bold rounded-lg border border-indigo-100">
                          {{ banner.button_text }}
                        </span>
                      </div>
                    </div>
                    
                    <div class="flex-1 min-w-[200px]">
                      <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 block">Link Tujuan</label>
                      <a :href="banner.link" target="_blank" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium break-all flex items-center gap-1">
                        {{ banner.link }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Technical Info / Meta -->
              <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                  <span class="p-2 bg-slate-100 rounded-xl text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                  </span>
                  Informasi Tambahan
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 block">Dibuat Oleh</span>
                    <div class="flex items-center gap-2 mt-1">
                      <div class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-[10px] font-bold text-indigo-700">{{ banner.created_by == 1 ? 'A' : 'U' }}</div>
                      <span class="text-sm font-semibold text-slate-700">{{ banner.created_by == 1 ? 'Administrator' : 'User' }}</span>
                    </div>
                  </div>
                  <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1 block">Terakhir Diperbarui</span>
                    <p class="text-sm font-semibold text-slate-700 mt-1">{{ formatDate(banner.updated_at || banner.created_at) }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right Sidebar: Configuration/Settings -->
            <div class="space-y-8">
              <!-- Publishing Status Card -->
              <div class="bg-indigo-600 rounded-3xl p-8 text-white shadow-xl shadow-indigo-200">
                <h3 class="text-indigo-100 font-bold text-[10px] uppercase tracking-widest mb-4">Pengaturan Publikasi</h3>
                <div class="space-y-4">
                  <div class="flex items-center justify-between">
                    <span class="text-sm font-medium">Status Tampil</span>
                    <span class="px-2 py-0.5 bg-white/20 backdrop-blur-sm rounded text-[10px] font-bold uppercase">Online</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-sm font-medium">Urutan</span>
                    <span class="font-bold text-xl">1</span>
                  </div>
                  <div class="pt-4 mt-2 border-t border-white/10">
                    <p class="text-xs text-indigo-100/70 leading-relaxed italic">
                      Banner ini sedang aktif dan ditampilkan di urutan pertama pada slider halaman depan.
                    </p>
                  </div>
                </div>
              </div>

              <!-- Quick Actions -->
              <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                <h3 class="text-slate-900 font-bold text-sm mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                  <button class="w-full py-3 px-4 bg-slate-50 text-slate-700 text-sm font-bold rounded-2xl border border-slate-100 hover:bg-slate-100 transition-colors flex items-center justify-between group">
                    Matikan Banner
                    <div class="w-8 h-4 bg-slate-200 rounded-full relative transition-colors group-hover:bg-slate-300">
                      <div class="absolute top-0.5 right-0.5 w-3 h-3 bg-white rounded-full shadow-sm"></div>
                    </div>
                  </button>
                  <button class="w-full py-3 px-4 text-rose-600 text-sm font-bold rounded-2xl hover:bg-rose-50 transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    Hapus Banner Ini
                  </button>
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
import AppSidebar from '../../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../../Components/Atoms/AppButton.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isLoading = ref(false);
const banner = ref({});

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

const fetchBannerDetail = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const response = await axios.get(`/api/banners/${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      banner.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching banner detail:', error);
    if (error.response?.status === 404) {
       window.location.href = '/content/banner';
    }
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
    fetchBannerDetail();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
