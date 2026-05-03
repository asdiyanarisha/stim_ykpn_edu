<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden">
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Welcome Section -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <h1 class="text-2xl font-bold text-slate-900">Halo, Admin 👋</h1>
            <p class="text-slate-500">Berikut adalah ringkasan data back-office STIM YKPN.</p>
          </div>
          <div class="text-sm text-slate-500 bg-white border border-slate-200 rounded-xl px-4 py-2 shadow-sm">
            <span class="font-semibold text-slate-700">{{ currentDate }}</span>
          </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
          <StatCard 
            label="Total Dosen" 
            value="24" 
            :trend="5.2" 
            color-class="bg-indigo-100 text-indigo-600"
            icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>'
          />
          <StatCard 
            label="Berita Terbit" 
            value="56" 
            :trend="12.1" 
            color-class="bg-emerald-100 text-emerald-600"
            icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>'
          />
          <StatCard 
            label="Program Studi" 
            value="4" 
            color-class="bg-amber-100 text-amber-600"
            icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>'
          />
          <StatCard 
            label="User Terdaftar" 
            value="128" 
            :trend="8.5" 
            color-class="bg-rose-100 text-rose-600"
            icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>'
          />
        </div>

        <!-- Quick Access Menu -->
        <div class="mb-8">
          <h2 class="text-lg font-bold text-slate-900 mb-4">Akses Cepat</h2>
          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            <a v-for="menu in quickMenus" :key="menu.name" :href="menu.link"
              class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex flex-col items-center gap-3 hover:shadow-md hover:border-indigo-200 hover:-translate-y-1 transition-all group cursor-pointer">
              <div :class="`w-12 h-12 ${menu.bgColor} rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform`" v-html="menu.icon"></div>
              <span class="text-xs font-semibold text-slate-700 text-center leading-tight">{{ menu.name }}</span>
            </a>
          </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
          <!-- Konten Terbaru -->
          <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex items-center justify-between">
              <h2 class="font-bold text-slate-900">Konten Terbaru</h2>
              <a href="/content/berita" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Lihat Semua</a>
            </div>
            <div class="divide-y divide-slate-50">
              <div v-for="item in recentContent" :key="item.id" class="px-6 py-4 hover:bg-slate-50/50 transition-colors flex items-center gap-4">
                <div :class="`w-10 h-10 ${item.bgColor} rounded-xl flex items-center justify-center flex-shrink-0`" v-html="item.icon"></div>
                <div class="flex-1 min-w-0">
                  <p class="text-sm font-semibold text-slate-900 truncate">{{ item.title }}</p>
                  <p class="text-xs text-slate-500">{{ item.category }} · {{ item.date }}</p>
                </div>
                <span :class="`inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase ${item.statusClass}`">{{ item.status }}</span>
              </div>
            </div>
          </div>

          <!-- Status Modul -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-bold text-slate-900 mb-6">Kelengkapan Modul</h2>
            <div class="space-y-5">
              <div v-for="module in moduleStatus" :key="module.name">
                <div class="flex items-center justify-between mb-2">
                  <span class="text-sm font-medium text-slate-700">{{ module.name }}</span>
                  <span class="text-sm font-bold text-slate-900">{{ module.progress }}%</span>
                </div>
                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                  <div :class="`h-full ${module.color} rounded-full transition-all`" :style="`width: ${module.progress}%`"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Bottom Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Kemahasiswaan -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
              <h2 class="font-bold text-slate-900">Kemahasiswaan</h2>
              <a href="/student/activity" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Kelola</a>
            </div>
            <div class="grid grid-cols-3 gap-4">
              <div v-for="stat in studentStats" :key="stat.label" class="text-center p-4 bg-slate-50 rounded-xl">
                <p class="text-2xl font-bold text-slate-900">{{ stat.value }}</p>
                <p class="text-xs text-slate-500 mt-1 font-medium">{{ stat.label }}</p>
              </div>
            </div>
          </div>

          <!-- Akademik -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
              <h2 class="font-bold text-slate-900">Akademik & PMB</h2>
              <a href="/pmb/scholarship" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Kelola PMB</a>
            </div>
            <div class="grid grid-cols-3 gap-4">
              <div v-for="stat in academicStats" :key="stat.label" class="text-center p-4 bg-slate-50 rounded-xl">
                <p class="text-2xl font-bold text-slate-900">{{ stat.value }}</p>
                <p class="text-xs text-slate-500 mt-1 font-medium">{{ stat.label }}</p>
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
import AppSidebar from '../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../Components/Organisms/AppNavbar.vue';
import StatCard from '../Components/Molecules/StatCard.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);

const currentDate = new Date().toLocaleDateString('id-ID', {
  weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
});

onMounted(async () => {
  const token = getCookie(TOKEN_COOKIE_NAME);
  if (!token) { window.location.href = '/unauthenticated'; return; }
  try {
    await axios.post('/api/auth/validate-token', {}, { headers: { Authorization: `Bearer ${token}` } });
    isAuthenticated.value = true;
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});

const quickMenus = [
  { name: 'Dosen', link: '/masterData/teacher', bgColor: 'bg-indigo-100 text-indigo-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>' },
  { name: 'Berita', link: '/content/berita', bgColor: 'bg-emerald-100 text-emerald-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>' },
  { name: 'Banner', link: '/content/banner', bgColor: 'bg-amber-100 text-amber-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>' },
  { name: 'User', link: '/user', bgColor: 'bg-rose-100 text-rose-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>' },
  { name: 'Voucher', link: '/voucher', bgColor: 'bg-violet-100 text-violet-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>' },
  { name: 'Pembayaran', link: '/payment_settings', bgColor: 'bg-cyan-100 text-cyan-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>' },
];

const recentContent = [
  { id: 1, title: 'Pendaftaran Mahasiswa Baru 2026/2027', category: 'Berita', date: '3 Mei 2026', status: 'Terbit', statusClass: 'bg-emerald-100 text-emerald-700', bgColor: 'bg-emerald-100 text-emerald-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>' },
  { id: 2, title: 'Seminar Nasional Akuntansi', category: 'Kegiatan', date: '2 Mei 2026', status: 'Terbit', statusClass: 'bg-emerald-100 text-emerald-700', bgColor: 'bg-indigo-100 text-indigo-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>' },
  { id: 3, title: 'Lowongan Asisten Dosen', category: 'Lowongan', date: '1 Mei 2026', status: 'Draft', statusClass: 'bg-slate-100 text-slate-600', bgColor: 'bg-amber-100 text-amber-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>' },
  { id: 4, title: 'Banner Wisuda 2026', category: 'Banner', date: '30 Apr 2026', status: 'Aktif', statusClass: 'bg-indigo-100 text-indigo-700', bgColor: 'bg-rose-100 text-rose-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>' },
  { id: 5, title: 'Jurnal Penelitian Manajemen Q1', category: 'Jurnal', date: '28 Apr 2026', status: 'Terbit', statusClass: 'bg-emerald-100 text-emerald-700', bgColor: 'bg-violet-100 text-violet-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>' },
];

const moduleStatus = [
  { name: 'Profil & Sejarah', progress: 100, color: 'bg-indigo-600' },
  { name: 'Program Pendidikan', progress: 85, color: 'bg-emerald-500' },
  { name: 'Ketentuan Perkuliahan', progress: 90, color: 'bg-amber-500' },
  { name: 'PMB', progress: 70, color: 'bg-cyan-500' },
  { name: 'Kemahasiswaan', progress: 60, color: 'bg-violet-500' },
  { name: 'Campus Life', progress: 75, color: 'bg-rose-500' },
];

const studentStats = [
  { label: 'Kegiatan', value: '12' },
  { label: 'UKM', value: '8' },
  { label: 'Testimoni', value: '15' },
];

const academicStats = [
  { label: 'Tahun Ajaran', value: '3' },
  { label: 'Brosur', value: '5' },
  { label: 'File Publik', value: '18' },
];
</script>
