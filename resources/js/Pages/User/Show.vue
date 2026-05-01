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
            Kembali ke Daftar User
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
                  <p class="text-slate-500 font-medium animate-pulse">Memuat Detail User...</p>
              </div>
          </div>
        </transition>

        <div v-if="user.id" class="max-w-4xl mx-auto space-y-8 pb-12">
          <!-- User Detail Card -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <!-- Header with Icon -->
                <div class="flex items-center gap-6 mb-8">
                    <div class="w-20 h-20 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-2xl uppercase">
                        {{ getInitials(user.name) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase tracking-wider rounded-lg border border-indigo-100 inline-block">User Information</span>
                            <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border" :class="user.role?.name === 'administrator' ? 'bg-indigo-50 text-indigo-600 border-indigo-100' : 'bg-slate-100 text-slate-600 border-slate-200'">
                                {{ user.role?.name || 'No Role' }}
                            </span>
                        </div>
                        <h1 class="text-3xl font-extrabold text-slate-900 leading-tight">{{ user.name }}</h1>
                        <p class="text-slate-500 font-medium">{{ user.email }}</p>
                    </div>
                </div>
                
                <!-- Divider -->
                <div class="h-px bg-slate-100 w-full mb-8"></div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Detail Kontak</h2>
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 space-y-4">
                            <div class="flex flex-col gap-1">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Nama Lengkap</span>
                                <span class="text-slate-700 font-semibold">{{ user.name }}</span>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Email Utama</span>
                                <span class="text-slate-700 font-semibold">{{ user.email }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Sistem & Keamanan</h2>
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 space-y-4">
                            <div class="flex flex-col gap-1">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Status Akun</span>
                                <div class="flex items-center gap-1.5 text-emerald-600">
                                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                                    <span class="font-bold">Aktif</span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Verifikasi Email</span>
                                <span class="text-slate-600 font-medium">{{ user.email_verified_at ? formatDate(user.email_verified_at) : 'Belum Terverifikasi' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metadata -->
                <div class="mt-12 flex flex-wrap gap-8 text-sm text-slate-400 border-t border-slate-50 pt-8">
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-300">ID User</span>
                        <span class="font-mono text-slate-600 font-medium">#{{ user.id }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-300">Dibuat Pada</span>
                        <span class="text-slate-600 font-medium">{{ formatDate(user.created_at) }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-300">Terakhir Diubah</span>
                        <span class="text-slate-600 font-medium">{{ formatDate(user.updated_at) }}</span>
                    </div>
                </div>
            </div>
          </div>

          <!-- Quick Actions Footer -->
          <div class="flex justify-between items-center bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
            <div class="text-sm text-slate-400 italic">
                Informasi pengguna ini digunakan untuk manajemen akses sistem.
            </div>
            <div class="flex gap-3">
                <a v-if="user.role?.name !== 'administrator'" :href="`/user/edit/${user.id}`">
                    <AppButton variant="secondary" size="md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Ubah User
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
const user = ref({});

const getInitials = (name) => {
    if (!name) return '??';
    return name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
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

const fetchUserDetail = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const response = await axios.get(`/api/users/${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      user.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching user detail:', error);
    if (error.response?.status === 404) {
       window.location.href = '/user';
    }
  } finally {
    isLoading.value = false;
  }
};

const goBack = () => {
    window.location.href = '/user';
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
    fetchUserDetail();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
