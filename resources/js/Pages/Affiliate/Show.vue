<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden font-sans">
    <!-- App Sidebar -->
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
            <p class="text-slate-500 font-medium animate-pulse">Memuat rincian affiliate...</p>
          </div>
        </div>
      </transition>

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Breadcrumb -->
        <div class="mb-6">
          <div class="flex items-center gap-2 text-sm text-slate-500">
            <a href="/affiliate" class="hover:text-indigo-600 transition-colors">Manajemen Affiliate</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            <span class="text-slate-900 font-medium truncate">{{ affiliate?.name || 'Detail Affiliate' }}</span>
          </div>
        </div>

        <div v-if="affiliate" class="flex gap-6 items-start">

          <!-- ======================= -->
          <!-- LEFT PROFILE SIDEBAR    -->
          <!-- ======================= -->
          <aside class="w-64 flex-shrink-0 space-y-3 sticky top-0">
            <!-- Profile Card -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col items-center text-center">
              <!-- Avatar -->
              <div class="w-20 h-20 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-700 flex items-center justify-center text-3xl font-black text-white uppercase shadow-lg shadow-indigo-200 mb-4 flex-shrink-0">
                {{ affiliate.name.charAt(0) }}
              </div>
              <!-- Name & Username -->
              <h2 class="text-base font-bold text-slate-900 leading-tight mb-1">{{ affiliate.name }}</h2>
              <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                @{{ affiliate.username }}
              </span>
              <!-- Instansi -->
              <p class="text-xs text-slate-500 mt-2">{{ affiliate.institution }}</p>
              <p class="text-xs text-slate-400">{{ affiliate.city }}</p>
            </div>

            <!-- Stats Card -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4">
              <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3">Statistik Referral</p>
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </div>
                <div>
                  <p class="text-xl font-extrabold text-slate-900 leading-none">{{ pmbList.length }}</p>
                  <p class="text-xs text-slate-500 mt-0.5">Mahasiswa PMB Dirujuk</p>
                </div>
              </div>
            </div>

            <!-- Navigation Menu -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-2 space-y-0.5">
              <button
                @click="activeTab = 'profile'"
                :class="[
                  'w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all text-left',
                  activeTab === 'profile'
                    ? 'bg-indigo-50 text-indigo-700'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'
                ]"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                Profil Detail
              </button>
              <button
                @click="activeTab = 'pmb'"
                :class="[
                  'w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all text-left',
                  activeTab === 'pmb'
                    ? 'bg-indigo-50 text-indigo-700'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'
                ]"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                Daftar Mahasiswa PMB
                <span v-if="pmbList.length > 0" class="ml-auto inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold rounded-full" :class="activeTab === 'pmb' ? 'bg-indigo-600 text-white' : 'bg-slate-200 text-slate-600'">
                  {{ pmbList.length }}
                </span>
              </button>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-3 space-y-2">
              <button
                @click="copyReferralLink(affiliate.username)"
                class="w-full flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition-colors"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                </svg>
                Salin Link PMB
              </button>
              <a :href="`/affiliate/edit/${affiliateId}`" class="w-full flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Edit Data Affiliate
              </a>
              <button
                @click="goBack"
                class="w-full flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar
              </button>
            </div>
          </aside>

          <!-- ======================= -->
          <!-- RIGHT MAIN CONTENT      -->
          <!-- ======================= -->
          <div class="flex-1 min-w-0">

            <!-- === TAB: PROFIL DETAIL === -->
            <div v-if="activeTab === 'profile'" class="space-y-5">
              <!-- Profile Card -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-7">
                <h3 class="text-base font-bold text-slate-800 mb-5 flex items-center gap-2.5">
                  <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                  </span>
                  Profil Mitra
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-8">
                  <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Lengkap</label>
                    <p class="text-sm font-semibold text-slate-900">{{ affiliate.name }}</p>
                  </div>
                  <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Username</label>
                    <p class="text-sm font-semibold text-slate-900">{{ affiliate.username }}</p>
                  </div>
                  <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Email</label>
                    <p class="text-sm font-semibold text-slate-900">{{ affiliate.email }}</p>
                  </div>
                  <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">No. HP / Whatsapp</label>
                    <p class="text-sm font-semibold text-slate-900">{{ affiliate.phone_number }}</p>
                  </div>
                  <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Instansi</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                      {{ affiliate.institution }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Jabatan</label>
                    <p class="text-sm font-semibold text-slate-900">{{ affiliate.position || '-' }}</p>
                  </div>
                  <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Kota</label>
                    <p class="text-sm font-semibold text-slate-900">{{ affiliate.city }}</p>
                  </div>
                  <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Alamat Lengkap</label>
                    <p class="text-sm font-medium text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-100 leading-relaxed">{{ affiliate.address }}</p>
                  </div>

                  <!-- Referral Link -->
                  <div class="md:col-span-2 p-4 bg-emerald-50/60 rounded-xl border border-emerald-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <div class="space-y-1 min-w-0">
                      <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider">Link Referral PMB</span>
                      <p class="text-sm font-semibold text-slate-700 break-all select-all">{{ getReferralLink(affiliate.username) }}</p>
                    </div>
                    <button
                      @click="copyReferralLink(affiliate.username)"
                      class="flex-shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 transition-colors shadow-sm shadow-emerald-200"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                      </svg>
                      Salin Link
                    </button>
                  </div>
                </div>
              </div>

              <!-- Bank Card -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-7">
                <h3 class="text-base font-bold text-slate-800 mb-5 flex items-center gap-2.5">
                  <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                  </span>
                  Informasi Rekening Bank
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                  <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Bank</label>
                    <p class="text-sm font-semibold" :class="affiliate.bank_name ? 'text-slate-900' : 'text-slate-400 italic'">{{ affiliate.bank_name || 'Belum diisi' }}</p>
                  </div>
                  <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Atas Nama Rekening</label>
                    <p class="text-sm font-semibold" :class="affiliate.account_holder_name ? 'text-slate-900' : 'text-slate-400 italic'">{{ affiliate.account_holder_name || 'Belum diisi' }}</p>
                  </div>
                  <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">No. Rekening</label>
                    <p class="text-sm font-mono font-bold" :class="affiliate.account_number ? 'text-slate-900' : 'text-slate-400 italic'">{{ affiliate.account_number || 'Belum diisi' }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- === TAB: DAFTAR MAHASISWA PMB === -->
            <div v-else-if="activeTab === 'pmb'">
              <!-- Header + Search -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                  <h3 class="text-base font-bold text-slate-900">Daftar Mahasiswa PMB Referral</h3>
                  <p class="text-sm text-slate-500 mt-0.5">
                    <span class="font-semibold text-indigo-600">{{ filteredPmb.length }}</span>
                    mahasiswa mendaftar melalui link referral <span class="font-semibold">@{{ affiliate.username }}</span>
                  </p>
                </div>
                <!-- Search -->
                <div class="relative w-full sm:w-64">
                  <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                  <input
                    v-model="pmbSearch"
                    type="text"
                    placeholder="Cari nama atau email..."
                    class="w-full pl-9 pr-4 py-2 text-sm border border-slate-200 rounded-xl bg-slate-50 focus:bg-white focus:border-indigo-300 focus:ring-2 focus:ring-indigo-100 outline-none transition-all"
                  />
                </div>
              </div>

              <!-- PMB Table -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <!-- Loading state -->
                <div v-if="pmbLoading" class="flex items-center justify-center py-16">
                  <div class="flex flex-col items-center">
                    <div class="w-10 h-10 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin mb-3"></div>
                    <p class="text-sm text-slate-500">Memuat data PMB...</p>
                  </div>
                </div>

                <!-- Empty state -->
                <div v-else-if="filteredPmb.length === 0" class="flex flex-col items-center justify-center py-16 text-center px-4">
                  <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                  </div>
                  <h4 class="text-slate-700 font-semibold text-base mb-1">
                    {{ pmbSearch ? 'Tidak ada hasil pencarian' : 'Belum Ada Mahasiswa PMB' }}
                  </h4>
                  <p class="text-sm text-slate-400 max-w-sm">
                    {{ pmbSearch
                      ? `Tidak ada mahasiswa yang cocok dengan pencarian "${pmbSearch}".`
                      : `Belum ada mahasiswa yang mendaftar melalui link referral @${affiliate.username}.`
                    }}
                  </p>
                </div>

                <!-- Table -->
                <div v-else class="overflow-x-auto">
                  <table class="w-full text-left border-collapse min-w-[700px]">
                    <thead>
                      <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-5 py-3.5 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pendaftar</th>
                        <th class="px-5 py-3.5 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Program Studi</th>
                        <th class="px-5 py-3.5 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Jalur</th>
                        <th class="px-5 py-3.5 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3.5 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tgl Daftar</th>
                        <th class="px-5 py-3.5 text-[10px] font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                      <tr
                        v-for="pmb in filteredPmb"
                        :key="pmb.id"
                        class="hover:bg-slate-50/80 transition-colors group"
                      >
                        <!-- Pendaftar -->
                        <td class="px-5 py-3.5">
                          <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm uppercase flex-shrink-0">
                              {{ pmb.nama_lengkap.charAt(0) }}
                            </div>
                            <div>
                              <p class="text-sm font-semibold text-slate-900 group-hover:text-indigo-700 transition-colors leading-tight">{{ pmb.nama_lengkap }}</p>
                              <p class="text-xs text-slate-400 mt-0.5">{{ pmb.email }}</p>
                            </div>
                          </div>
                        </td>
                        <!-- Program Studi -->
                        <td class="px-5 py-3.5">
                          <span class="text-xs font-medium text-slate-700">{{ pmb.program_studi }}</span>
                        </td>
                        <!-- Jalur -->
                        <td class="px-5 py-3.5">
                          <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide bg-slate-100 text-slate-600 border border-slate-200">
                            {{ pmb.jalur_registrasi }}
                          </span>
                        </td>
                        <!-- Status -->
                        <td class="px-5 py-3.5">
                          <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide border" :class="getStatusBadgeClass(pmb.status?.slug || 'registrasi-awal')">
                            {{ pmb.status?.status || 'Registrasi Awal' }}
                          </span>
                        </td>
                        <!-- Tgl Daftar -->
                        <td class="px-5 py-3.5">
                          <span class="text-xs text-slate-500">{{ formatDate(pmb.created_at) }}</span>
                        </td>
                        <!-- Aksi -->
                        <td class="px-5 py-3.5 text-right">
                          <a
                            :href="`/pmb/show/${pmb.id}`"
                            target="_blank"
                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors"
                          >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                            Detail
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- END TAB PMB -->

          </div>
          <!-- END RIGHT CONTENT -->

        </div>
        <!-- END two-column layout -->

      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isLoading = ref(false);
const pmbLoading = ref(false);
const affiliate = ref(null);
const affiliateId = ref(null);
const activeTab = ref('profile');
const pmbList = ref([]);
const pmbSearch = ref('');

// ── Computed ──────────────────────────────────────────────────────────────────
const filteredPmb = computed(() => {
  if (!pmbSearch.value) return pmbList.value;
  const q = pmbSearch.value.toLowerCase();
  return pmbList.value.filter(p =>
    p.nama_lengkap.toLowerCase().includes(q) ||
    p.email.toLowerCase().includes(q)
  );
});

// ── Helpers ───────────────────────────────────────────────────────────────────
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
  }).catch(() => {
    Swal.fire({
      icon: 'error',
      title: 'Gagal Menyalin Link',
      text: 'Silakan salin secara manual: ' + link,
      confirmButtonColor: '#d33'
    });
  });
};

const formatDate = (dateStr) => {
  if (!dateStr) return '-';
  return new Date(dateStr).toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'short',
    year: 'numeric'
  });
};

const getStatusBadgeClass = (slug) => {
  const map = {
    'registrasi-awal':     'bg-slate-100 text-slate-600 border-slate-200',
    'sedang-mengirim-email': 'bg-sky-50 text-sky-600 border-sky-100',
    'email-terkirim':      'bg-blue-50 text-blue-600 border-blue-100',
    'diterima':            'bg-emerald-50 text-emerald-600 border-emerald-100',
    'wawancara':           'bg-violet-50 text-violet-600 border-violet-100',
    'lulus':               'bg-green-50 text-green-700 border-green-100',
    'tidak-lulus':         'bg-rose-50 text-rose-600 border-rose-100',
    'ditolak':             'bg-red-50 text-red-700 border-red-100',
  };
  return map[slug] ?? 'bg-slate-100 text-slate-600 border-slate-200';
};

// ── API Calls ─────────────────────────────────────────────────────────────────
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
    }).then(() => goBack());
  } finally {
    isLoading.value = false;
  }
};

const fetchPmbByAffiliate = async () => {
  pmbLoading.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.get(`/api/pmbs`, {
      params: { affiliate_id: affiliateId.value },
      headers: { Authorization: `Bearer ${token}` }
    });
    if (response.data.status === 'success') {
      pmbList.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching PMB list for affiliate:', error);
  } finally {
    pmbLoading.value = false;
  }
};

// ── Lifecycle ─────────────────────────────────────────────────────────────────
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
    // Fetch PMB data after affiliate data is available (parallel-safe)
    fetchPmbByAffiliate();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
