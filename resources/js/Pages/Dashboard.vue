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
          <div class="relative" ref="datePickerRef">
            <button @click="showCalendar = !showCalendar" class="flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-4 py-2.5 shadow-sm hover:border-indigo-300 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <span class="text-xs font-medium text-slate-500 whitespace-nowrap">Data s/d:</span>
              <span class="text-sm font-semibold text-slate-700">{{ displayDate }}</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </button>
            <!-- Custom Calendar Dropdown — anchored right so it opens leftward -->
            <div v-if="showCalendar" class="absolute right-0 top-full mt-2 bg-white border border-slate-200 rounded-2xl shadow-xl z-[100] p-4 w-[280px]">
              <div class="flex items-center justify-between mb-3">
                <button @click="calPrevMonth" class="p-1.5 rounded-lg hover:bg-slate-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>
                <span class="text-sm font-bold text-slate-800">{{ calMonthYearLabel }}</span>
                <button @click="calNextMonth" class="p-1.5 rounded-lg hover:bg-slate-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>
              </div>
              <div class="grid grid-cols-7 gap-0.5 text-center mb-1">
                <span v-for="d in ['Min','Sen','Sel','Rab','Kam','Jum','Sab']" :key="d" class="text-[10px] font-semibold text-slate-400 py-1">{{ d }}</span>
              </div>
              <div class="grid grid-cols-7 gap-0.5 text-center">
                <button v-for="(day, i) in calDays" :key="i"
                  @click="day.value && selectDate(day.value)"
                  :disabled="!day.value"
                  :class="[
                    'text-xs rounded-lg py-1.5 transition-all',
                    !day.value ? 'invisible' : 'hover:bg-indigo-50 cursor-pointer',
                    day.isSelected ? 'bg-indigo-600 text-white font-bold hover:bg-indigo-700' : '',
                    day.isToday && !day.isSelected ? 'ring-1 ring-indigo-400 font-bold text-indigo-600' : '',
                    !day.isSelected && !day.isToday && day.value ? 'text-slate-700' : ''
                  ]">
                  {{ day.label }}
                </button>
              </div>
              <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100">
                <button @click="selectToday" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">Hari Ini</button>
                <button @click="showCalendar = false" class="text-xs font-semibold text-slate-400 hover:text-slate-600">Tutup</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Loading State -->
        <div v-if="isLoading" class="flex items-center justify-center py-20">
          <div class="flex flex-col items-center gap-3">
            <svg class="animate-spin h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-sm text-slate-500 font-medium">Memuat data dashboard...</p>
          </div>
        </div>

        <template v-else>
          <!-- Stats Grid -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
            <StatCard 
              label="Total Dosen" 
              :value="String(stats.total_dosen)" 
              color-class="bg-indigo-100 text-indigo-600"
              icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>'
            />
            <StatCard 
              label="Berita Terbit" 
              :value="String(stats.berita_terbit)" 
              color-class="bg-emerald-100 text-emerald-600"
              icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>'
            />
            <StatCard 
              label="Program Studi" 
              :value="String(stats.program_studi)" 
              color-class="bg-amber-100 text-amber-600"
              icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>'
            />
            <StatCard 
              label="Pendaftar PMB" 
              :value="String(stats.pendaftar_pmb)" 
              color-class="bg-rose-100 text-rose-600"
              icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>'
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
                <div v-if="recentNews.length === 0" class="px-6 py-8 text-center text-sm text-slate-400">
                  Belum ada konten berita.
                </div>
                <div v-for="item in recentNews" :key="item.id" class="px-6 py-4 hover:bg-slate-50/50 transition-colors flex items-center gap-4">
                  <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-900 truncate">{{ item.title }}</p>
                    <p class="text-xs text-slate-500">Berita · {{ formatDate(item.created_at) }}</p>
                  </div>
                  <span :class="`inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase ${item.status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600'}`">
                    {{ item.status === 'published' ? 'Terbit' : 'Draft' }}
                  </span>
                </div>
              </div>
            </div>

            <!-- Pendaftar PMB Terbaru -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
              <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                <h2 class="font-bold text-slate-900">Pendaftar PMB Terbaru</h2>
                <a href="/pmb" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Lihat Semua</a>
              </div>
              <div class="divide-y divide-slate-50">
                <div v-if="recentPmb.length === 0" class="px-6 py-8 text-center text-sm text-slate-400">
                  Belum ada pendaftar PMB.
                </div>
                <div v-for="item in recentPmb" :key="item.id" class="px-6 py-3.5 hover:bg-slate-50/50 transition-colors flex items-center gap-3">
                  <div class="w-8 h-8 bg-rose-100 text-rose-600 rounded-lg flex items-center justify-center flex-shrink-0 text-xs font-bold">
                    {{ item.nama_lengkap?.charAt(0)?.toUpperCase() }}
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-900 truncate">{{ item.nama_lengkap }}</p>
                    <p class="text-[11px] text-slate-500">{{ item.program_studi }} · {{ formatDate(item.created_at) }}</p>
                  </div>
                  <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-600 whitespace-nowrap">{{ item.jalur_registrasi }}</span>
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
        </template>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import axios from 'axios';
import AppSidebar from '../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../Components/Organisms/AppNavbar.vue';
import StatCard from '../Components/Molecules/StatCard.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isLoading = ref(true);

// Filter date — default to today
const filterDate = ref(new Date().toISOString().split('T')[0]);

// Dashboard data from API
const dashboardData = ref(null);

// ── Custom Calendar State ──
const showCalendar = ref(false);
const datePickerRef = ref(null);
const calViewDate = ref(new Date()); // month/year being viewed

const MONTH_NAMES_ID = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

const displayDate = computed(() => {
  const [y, m, d] = filterDate.value.split('-');
  return `${parseInt(d)} ${MONTH_NAMES_ID[parseInt(m)-1]} ${y}`;
});

const calMonthYearLabel = computed(() => {
  const d = calViewDate.value;
  return `${MONTH_NAMES_ID[d.getMonth()]} ${d.getFullYear()}`;
});

const calDays = computed(() => {
  const d = calViewDate.value;
  const year = d.getFullYear();
  const month = d.getMonth();
  const firstDay = new Date(year, month, 1).getDay(); // 0=Sun
  const daysInMonth = new Date(year, month + 1, 0).getDate();
  const today = new Date();
  const [selY, selM, selD] = filterDate.value.split('-').map(Number);

  const cells = [];
  for (let i = 0; i < firstDay; i++) cells.push({ value: null, label: '' });
  for (let day = 1; day <= daysInMonth; day++) {
    cells.push({
      value: `${year}-${String(month+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`,
      label: day,
      isToday: day === today.getDate() && month === today.getMonth() && year === today.getFullYear(),
      isSelected: day === selD && month === selM - 1 && year === selY,
    });
  }
  return cells;
});

function calPrevMonth() {
  const d = new Date(calViewDate.value);
  d.setMonth(d.getMonth() - 1);
  calViewDate.value = d;
}
function calNextMonth() {
  const d = new Date(calViewDate.value);
  d.setMonth(d.getMonth() + 1);
  calViewDate.value = d;
}
function selectDate(val) {
  filterDate.value = val;
  showCalendar.value = false;
  fetchDashboardData();
}
function selectToday() {
  const t = new Date();
  selectDate(t.toISOString().split('T')[0]);
  calViewDate.value = new Date();
}

// Close calendar on outside click
function handleClickOutside(e) {
  if (datePickerRef.value && !datePickerRef.value.contains(e.target)) {
    showCalendar.value = false;
  }
}
onMounted(() => document.addEventListener('click', handleClickOutside));
onBeforeUnmount(() => document.removeEventListener('click', handleClickOutside));

// ── Dashboard Data ──
const stats = computed(() => dashboardData.value?.stat_cards ?? {
  total_dosen: 0, berita_terbit: 0, program_studi: 0, pendaftar_pmb: 0,
});
const recentNews = computed(() => dashboardData.value?.recent_news ?? []);
const recentPmb = computed(() => dashboardData.value?.recent_pmb ?? []);
const studentStats = computed(() => {
  const k = dashboardData.value?.kemahasiswaan ?? {};
  return [
    { label: 'Kegiatan', value: String(k.kegiatan ?? 0) },
    { label: 'UKM', value: String(k.ukm ?? 0) },
    { label: 'Testimoni', value: String(k.testimoni ?? 0) },
  ];
});
const academicStats = computed(() => {
  const a = dashboardData.value?.akademik ?? {};
  return [
    { label: 'Tahun Ajaran', value: String(a.tahun_ajaran ?? 0) },
    { label: 'Brosur', value: String(a.brosur ?? 0) },
    { label: 'File Publik', value: String(a.file_publik ?? 0) },
  ];
});

function formatDate(dateStr) {
  if (!dateStr) return '';
  const d = new Date(dateStr);
  return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
}

async function fetchDashboardData() {
  const token = getCookie(TOKEN_COOKIE_NAME);
  if (!token) return;
  try {
    isLoading.value = true;
    const res = await axios.get('/api/dashboard/stats', {
      params: { end_date: filterDate.value },
      headers: { Authorization: `Bearer ${token}` },
    });
    if (res.data.status === 'success') {
      dashboardData.value = res.data.data;
    }
  } catch (error) {
    console.error('Failed to load dashboard stats:', error);
  } finally {
    isLoading.value = false;
  }
}

onMounted(async () => {
  const token = getCookie(TOKEN_COOKIE_NAME);
  if (!token) { window.location.href = '/unauthenticated'; return; }
  try {
    await axios.post('/api/auth/validate-token', {}, { headers: { Authorization: `Bearer ${token}` } });
    isAuthenticated.value = true;
    calViewDate.value = new Date(filterDate.value);
    await fetchDashboardData();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});

const quickMenus = [
  { name: 'Dosen', link: '/masterData/teacher', bgColor: 'bg-indigo-100 text-indigo-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>' },
  { name: 'Berita', link: '/content/berita', bgColor: 'bg-emerald-100 text-emerald-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>' },
  { name: 'Banner', link: '/content/banner', bgColor: 'bg-amber-100 text-amber-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>' },
  { name: 'PMB', link: '/pmb', bgColor: 'bg-rose-100 text-rose-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>' },
  { name: 'Voucher', link: '/voucher', bgColor: 'bg-violet-100 text-violet-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>' },
  { name: 'Pembayaran', link: '/payment_settings', bgColor: 'bg-cyan-100 text-cyan-600', icon: '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>' },
];

</script>

