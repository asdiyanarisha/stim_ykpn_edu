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
                <p class="text-slate-500 font-medium animate-pulse">Memuat Informasi...</p>
            </div>
        </div>
      </transition>

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-slate-900">Kalender Akademik</h1>
          <p class="text-slate-500">Kelola daftar kegiatan kalender akademik STIM YKPN.</p>
        </div>

        <!-- Toolbar Section -->
        <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
          <!-- Filters & Search -->
          <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="relative">
              <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
              </span>
              <input 
                type="text" 
                v-model="searchQuery" 
                placeholder="Cari kegiatan..." 
                class="block w-full border border-slate-200 rounded-xl shadow-sm sm:text-sm transition-all duration-200 py-2.5 pl-9 pr-4 focus:border-indigo-500 focus:ring-indigo-500 bg-white"
              />
            </div>

            <div>
              <select 
                v-model="filterSemester"
                class="block w-full border border-slate-200 rounded-xl shadow-sm sm:text-sm transition-all duration-200 py-2.5 px-4 focus:border-indigo-500 focus:ring-indigo-500 bg-white text-slate-700"
              >
                <option value="">Semua Semester</option>
                <option v-for="sem in semesters" :key="sem.id" :value="sem.id">
                  {{ sem.nama }}
                </option>
              </select>
            </div>

            <div>
              <select 
                v-model="filterKategori"
                class="block w-full border border-slate-200 rounded-xl shadow-sm sm:text-sm transition-all duration-200 py-2.5 px-4 focus:border-indigo-500 focus:ring-indigo-500 bg-white text-slate-700"
              >
                <option value="">Semua Kategori</option>
                <option v-for="cat in kategori" :key="cat.id" :value="cat.id">
                  {{ cat.nama }}
                </option>
              </select>
            </div>
          </div>

          <!-- Add Button -->
          <button 
            @click="openCreateModal"
            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow-sm text-sm font-semibold flex items-center justify-center gap-2 active:scale-95 transition-all duration-200 whitespace-nowrap"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Kegiatan
          </button>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[900px]">
              <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Judul & Deskripsi</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Semester</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Pelaksanaan</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Status</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr v-for="item in paginatedActivities" :key="item.id" class="hover:bg-slate-50 transition-colors group">
                  <!-- Judul & Deskripsi -->
                  <td class="px-6 py-4 max-w-xs sm:max-w-sm">
                    <p class="text-sm font-bold text-slate-900 mb-0.5 group-hover:text-indigo-600 transition-colors">{{ item.judul }}</p>
                    <p class="text-xs text-slate-500 truncate" :title="item.deskripsi">{{ item.deskripsi || '-' }}</p>
                  </td>

                  <!-- Kategori -->
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span 
                      v-if="item.kategori"
                      class="px-3 py-1 rounded-full text-xs font-semibold border inline-flex items-center"
                      :style="{ 
                        backgroundColor: item.kategori.warna + '12', 
                        color: item.kategori.warna, 
                        borderColor: item.kategori.warna + '28' 
                      }"
                    >
                      <i :class="['bi', item.kategori.ikon, 'mr-1.5', 'text-sm']"></i>
                      {{ item.kategori.nama }}
                    </span>
                    <span v-else class="text-xs text-slate-400">-</span>
                  </td>

                  <!-- Semester -->
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2.5 py-1 bg-slate-100 text-slate-800 rounded-lg text-xs font-medium">
                      {{ item.semester?.nama || '-' }}
                    </span>
                  </td>

                  <!-- Tanggal -->
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex flex-col text-xs text-slate-700">
                      <span class="font-semibold flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        {{ formatDate(item.tanggal_mulai) }}
                      </span>
                      <span class="text-slate-400 text-[10px] pl-4">s.d. {{ formatDate(item.tanggal_selesai) }}</span>
                    </div>
                  </td>

                  <!-- Status -->
                  <td class="px-6 py-4 whitespace-nowrap text-center">
                    <span 
                      class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider"
                      :class="item.aktif ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-100 text-slate-600 border border-slate-200'"
                    >
                      {{ item.aktif ? 'Aktif' : 'Nonaktif' }}
                    </span>
                  </td>

                  <!-- Aksi -->
                  <td class="px-6 py-4 text-right whitespace-nowrap">
                    <div class="flex items-center justify-end gap-2">
                      <button 
                        @click="openEditModal(item)" 
                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Edit
                      </button>
                      <button 
                        @click="deleteActivity(item.id)" 
                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        Hapus
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Empty State -->
                <tr v-if="filteredActivities.length === 0">
                  <td colspan="6" class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                      <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-350" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                      </div>
                      <h3 class="text-sm font-bold text-slate-855">Tidak ada kegiatan ditemukan</h3>
                      <p class="text-xs text-slate-400 mb-4">Gunakan filter pencarian lain atau tambahkan kegiatan akademik baru.</p>
                      <button 
                        @click="openCreateModal"
                        class="px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-semibold rounded-xl text-xs transition-colors"
                      >
                        Tambah Kegiatan Baru
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div v-if="totalPages > 1" class="px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between bg-slate-50/50 gap-4">
            <div class="text-sm text-slate-500 text-center sm:text-left">
              Menampilkan <span class="font-bold text-slate-900">{{ (currentPage - 1) * limit + 1 }}</span>
              sampai <span class="font-bold text-slate-900">{{ Math.min(currentPage * limit, totalItems) }}</span>
              dari <span class="font-bold text-slate-900">{{ totalItems }}</span> kegiatan
            </div>
            
            <div class="flex items-center gap-3">
              <select v-model="limit" class="text-sm border border-slate-200 rounded-lg text-slate-600 focus:ring-indigo-500 focus:border-indigo-500 py-1.5 pl-3 pr-8 bg-white cursor-pointer" @change="currentPage = 1">
                <option :value="5">5 / hal</option>
                <option :value="10">10 / hal</option>
                <option :value="20">20 / hal</option>
              </select>

              <nav class="flex items-center shadow-sm rounded-lg overflow-hidden border border-slate-200 bg-white">
                <button @click="prevPage" :disabled="currentPage === 1" :class="['px-3 py-1.5 text-sm font-medium transition-colors', currentPage === 1 ? 'text-slate-300 cursor-not-allowed' : 'text-slate-700 hover:bg-slate-50 active:bg-slate-100']">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                </button>
                <div class="px-4 py-1.5 text-sm font-semibold text-slate-700 border-x border-slate-200 bg-slate-50">
                  {{ currentPage }} / {{ totalPages }}
                </div>
                <button @click="nextPage" :disabled="currentPage === totalPages" :class="['px-3 py-1.5 text-sm font-medium transition-colors', currentPage === totalPages ? 'text-slate-300 cursor-not-allowed' : 'text-slate-700 hover:bg-slate-50 active:bg-slate-100']">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                </button>
              </nav>
            </div>
          </div>
        </div>
      </main>
    </div>

    <!-- Create / Update Activity Modal Dialog -->
    <transition
      enter-active-class="transition duration-300 ease-out"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition duration-200 ease-in"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <div v-if="showActivityModal" class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click="showActivityModal = false"></div>

        <!-- Modal Container -->
        <div class="relative bg-white rounded-3xl shadow-2xl max-w-lg w-full overflow-hidden border border-slate-100 z-10 transform transition-all scale-100">
          
          <!-- Modal Header -->
          <div class="px-6 py-5 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-base font-bold text-slate-900">
              {{ isEditingActivity ? 'Ubah Kegiatan Akademik' : 'Tambah Kegiatan Akademik' }}
            </h3>
            <button 
              @click="showActivityModal = false"
              class="p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-all"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
          </div>

          <!-- Modal Body -->
          <form @submit.prevent="handleActivitySubmit">
            <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
              <!-- Judul -->
              <AppInput 
                v-model="activityForm.judul" 
                label="Judul Kegiatan" 
                placeholder="Misal: Kuliah Perdana, Ujian Akhir Semester" 
                id="activity-judul" 
                :error="activityErrors.judul" 
              />

              <!-- Deskripsi -->
              <div class="space-y-1">
                <label for="activity-deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
                <textarea 
                  id="activity-deskripsi"
                  v-model="activityForm.deskripsi"
                  placeholder="Keterangan atau detail tambahan mengenai kegiatan..."
                  rows="3"
                  class="block w-full border border-slate-200 rounded-xl shadow-sm sm:text-sm transition-all duration-200 py-2.5 px-4 focus:border-indigo-500 focus:ring-indigo-500 bg-white"
                ></textarea>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <!-- Semester -->
                <div class="space-y-1">
                  <label class="block text-sm font-medium text-slate-700">Semester</label>
                  <select 
                    v-model="activityForm.semester_id"
                    :class="[
                      'block w-full border rounded-xl shadow-sm sm:text-sm transition-all duration-200 py-2.5 px-4 focus:border-indigo-500 focus:ring-indigo-500 bg-white text-slate-800',
                      activityErrors.semester_id ? 'border-rose-500 bg-rose-50' : 'border-slate-200'
                    ]"
                  >
                    <option v-for="sem in semesters" :key="sem.id" :value="sem.id">
                      {{ sem.nama }}
                    </option>
                  </select>
                  <p v-if="activityErrors.semester_id" class="text-xs text-rose-600 mt-1">{{ activityErrors.semester_id }}</p>
                </div>

                <!-- Kategori -->
                <div class="space-y-1">
                  <label class="block text-sm font-medium text-slate-700">Kategori</label>
                  <select 
                    v-model="activityForm.kategori_id"
                    :class="[
                      'block w-full border rounded-xl shadow-sm sm:text-sm transition-all duration-200 py-2.5 px-4 focus:border-indigo-500 focus:ring-indigo-500 bg-white text-slate-800',
                      activityErrors.kategori_id ? 'border-rose-500 bg-rose-50' : 'border-slate-200'
                    ]"
                  >
                    <option v-for="cat in kategori" :key="cat.id" :value="cat.id">
                      {{ cat.nama }}
                    </option>
                  </select>
                  <p v-if="activityErrors.kategori_id" class="text-xs text-rose-600 mt-1">{{ activityErrors.kategori_id }}</p>
                </div>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <!-- Tanggal Mulai -->
                <div class="space-y-1">
                  <label class="block text-sm font-medium text-slate-700">Tanggal Mulai</label>
                  <input 
                    type="date"
                    v-model="activityForm.tanggal_mulai"
                    :class="[
                      'block w-full border rounded-xl shadow-sm sm:text-sm transition-all duration-200 py-2.5 px-4 focus:border-indigo-500 focus:ring-indigo-500 bg-white text-slate-800',
                      activityErrors.tanggal_mulai ? 'border-rose-500 bg-rose-50' : 'border-slate-200'
                    ]"
                  />
                  <p v-if="activityErrors.tanggal_mulai" class="text-xs text-rose-600 mt-1">{{ activityErrors.tanggal_mulai }}</p>
                </div>

                <!-- Tanggal Selesai -->
                <div class="space-y-1">
                  <label class="block text-sm font-medium text-slate-700">Tanggal Selesai</label>
                  <input 
                    type="date"
                    v-model="activityForm.tanggal_selesai"
                    :class="[
                      'block w-full border rounded-xl shadow-sm sm:text-sm transition-all duration-200 py-2.5 px-4 focus:border-indigo-500 focus:ring-indigo-500 bg-white text-slate-800',
                      activityErrors.tanggal_selesai ? 'border-rose-500 bg-rose-50' : 'border-slate-200'
                    ]"
                  />
                  <p v-if="activityErrors.tanggal_selesai" class="text-xs text-rose-600 mt-1">{{ activityErrors.tanggal_selesai }}</p>
                </div>
              </div>

              <!-- Status Aktif (Switch/Toggle) -->
              <div class="flex items-center justify-between pt-2">
                <div>
                  <label class="block text-sm font-bold text-slate-800">Status Kegiatan</label>
                  <span class="text-xs text-slate-400">Aktifkan kegiatan ini untuk ditampilkan di publik</span>
                </div>
                <button
                  type="button"
                  @click="activityForm.aktif = !activityForm.aktif"
                  :class="[
                    'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none',
                    activityForm.aktif ? 'bg-indigo-600' : 'bg-slate-200'
                  ]"
                >
                  <span
                    :class="[
                      'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                      activityForm.aktif ? 'translate-x-5' : 'translate-x-0'
                    ]"
                  ></span>
                </button>
              </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 flex items-center justify-end gap-3">
              <button 
                type="button"
                @click="showActivityModal = false"
                class="px-4 py-2 border border-slate-200 text-slate-700 bg-white rounded-xl text-sm font-semibold hover:bg-slate-50 active:scale-95 transition-all duration-200"
              >
                Batal
              </button>
              <button 
                type="submit"
                :disabled="isSubmittingActivity"
                class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 shadow-sm shadow-indigo-100 flex items-center justify-center gap-1.5 active:scale-95 transition-all duration-200"
              >
                <svg v-if="isSubmittingActivity" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span>{{ isSubmittingActivity ? 'Menyimpan...' : 'Simpan' }}</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, computed, watch } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppInput from '../../Components/Atoms/AppInput.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

// General State
const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isLoading = ref(false);

// Activities Management State
const activities = ref([]);
const semesters = ref([]);
const kategori = ref([]);

const showActivityModal = ref(false);
const isEditingActivity = ref(false);
const isSubmittingActivity = ref(false);

const searchQuery = ref('');
const filterSemester = ref('');
const filterKategori = ref('');

// Pagination state
const currentPage = ref(1);
const limit = ref(10);

const activityForm = reactive({
  id: null,
  semester_id: '',
  kategori_id: '',
  judul: '',
  deskripsi: '',
  tanggal_mulai: '',
  tanggal_selesai: '',
  aktif: true
});

const activityErrors = reactive({
  semester_id: '',
  kategori_id: '',
  judul: '',
  tanggal_mulai: '',
  tanggal_selesai: '',
});

// Reset pagination page on search or filter change
watch([searchQuery, filterSemester, filterKategori], () => {
  currentPage.value = 1;
});

// Fetch Activities dropdown options (Semesters, Categories)
const fetchOptions = async () => {
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.get('/api/kegiatan-akademik/options', {
      headers: { Authorization: `Bearer ${token}` }
    });
    if (response.data.status === 'success') {
      semesters.value = response.data.data.semesters;
      kategori.value = response.data.data.kategori;
    }
  } catch (error) {
    console.error('Error fetching options:', error);
  }
};

// Fetch Activities list
const fetchActivities = async () => {
  isLoading.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.get('/api/kegiatan-akademik', {
      headers: { Authorization: `Bearer ${token}` }
    });
    if (response.data.status === 'success') {
      activities.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching activities:', error);
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan Sistem',
      text: 'Gagal mengambil data kegiatan akademik.',
      confirmButtonColor: '#4f46e5'
    });
  } finally {
    isLoading.value = false;
  }
};

// Date Formatter Helper
const formatDate = (dateString) => {
  if (!dateString) return '-';
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return new Date(dateString).toLocaleDateString('id-ID', options);
};

// Filtered Activities
const filteredActivities = computed(() => {
  return activities.value.filter(item => {
    const matchSearch = !searchQuery.value || 
      item.judul.toLowerCase().includes(searchQuery.value.toLowerCase()) || 
      (item.deskripsi && item.deskripsi.toLowerCase().includes(searchQuery.value.toLowerCase()));
      
    const matchSemester = !filterSemester.value || item.semester_id === parseInt(filterSemester.value);
    const matchKategori = !filterKategori.value || item.kategori_id === parseInt(filterKategori.value);
    
    return matchSearch && matchSemester && matchKategori;
  });
});

// Pagination Calculations
const totalItems = computed(() => filteredActivities.value.length);
const totalPages = computed(() => Math.ceil(totalItems.value / limit.value) || 1);

const paginatedActivities = computed(() => {
  const offset = (currentPage.value - 1) * limit.value;
  return filteredActivities.value.slice(offset, offset + limit.value);
});

const prevPage = () => { if (currentPage.value > 1) currentPage.value--; };
const nextPage = () => { if (currentPage.value < totalPages.value) currentPage.value++; };

// Open Modal to Create Activity
const openCreateModal = () => {
  isEditingActivity.value = false;
  activityForm.id = null;
  activityForm.semester_id = semesters.value[0]?.id || '';
  activityForm.kategori_id = kategori.value[0]?.id || '';
  activityForm.judul = '';
  activityForm.deskripsi = '';
  activityForm.tanggal_mulai = '';
  activityForm.tanggal_selesai = '';
  activityForm.aktif = true;
  
  // Clear validation errors
  Object.keys(activityErrors).forEach(key => activityErrors[key] = '');
  
  showActivityModal.value = true;
};

// Open Modal to Edit Activity
const openEditModal = (item) => {
  isEditingActivity.value = true;
  activityForm.id = item.id;
  activityForm.semester_id = item.semester_id;
  activityForm.kategori_id = item.kategori_id;
  activityForm.judul = item.judul;
  activityForm.deskripsi = item.deskripsi || '';
  activityForm.tanggal_mulai = item.tanggal_mulai ? item.tanggal_mulai.substring(0, 10) : '';
  activityForm.tanggal_selesai = item.tanggal_selesai ? item.tanggal_selesai.substring(0, 10) : '';
  activityForm.aktif = !!item.aktif;
  
  // Clear validation errors
  Object.keys(activityErrors).forEach(key => activityErrors[key] = '');
  
  showActivityModal.value = true;
};

// Submit Activity Create / Edit Form
const handleActivitySubmit = async () => {
  Object.keys(activityErrors).forEach(key => activityErrors[key] = '');
  
  let hasError = false;
  if (!activityForm.judul) {
    activityErrors.judul = 'Judul wajib diisi';
    hasError = true;
  }
  if (!activityForm.semester_id) {
    activityErrors.semester_id = 'Semester wajib dipilih';
    hasError = true;
  }
  if (!activityForm.kategori_id) {
    activityErrors.kategori_id = 'Kategori wajib dipilih';
    hasError = true;
  }
  if (!activityForm.tanggal_mulai) {
    activityErrors.tanggal_mulai = 'Tanggal mulai wajib diisi';
    hasError = true;
  }
  if (!activityForm.tanggal_selesai) {
    activityErrors.tanggal_selesai = 'Tanggal selesai wajib diisi';
    hasError = true;
  } else if (activityForm.tanggal_mulai && activityForm.tanggal_selesai < activityForm.tanggal_mulai) {
    activityErrors.tanggal_selesai = 'Tanggal selesai tidak boleh mendahului tanggal mulai';
    hasError = true;
  }
  
  if (hasError) return;
  
  isSubmittingActivity.value = true;
  
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const url = activityForm.id 
      ? `/api/kegiatan-akademik/${activityForm.id}` 
      : '/api/kegiatan-akademik';
    
    const response = await axios.post(url, activityForm, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: response.data.message,
        confirmButtonColor: '#4f46e5'
      });
      showActivityModal.value = false;
      fetchActivities();
    }
  } catch (error) {
    console.error('Error saving activity:', error);
    const message = error.response?.data?.message || 'Terjadi kesalahan saat menyimpan kegiatan.';
    Swal.fire({ icon: 'error', title: 'Oops...', text: message });
  } finally {
    isSubmittingActivity.value = false;
  }
};

// Delete Activity
const deleteActivity = async (id) => {
  const result = await Swal.fire({
    title: 'Apakah Anda yakin?',
    text: 'Kegiatan akademik ini akan dihapus permanen!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus!',
    cancelButtonText: 'Batal'
  });
  
  if (result.isConfirmed) {
    try {
      const token = getCookie(TOKEN_COOKIE_NAME);
      const response = await axios.delete(`/api/kegiatan-akademik/${id}`, {
        headers: { Authorization: `Bearer ${token}` }
      });
      if (response.data.status === 'success') {
        Swal.fire({
          icon: 'success',
          title: 'Terhapus!',
          text: response.data.message,
          confirmButtonColor: '#4f46e5'
        });
        fetchActivities();
      }
    } catch (error) {
      console.error('Error deleting activity:', error);
      Swal.fire({ icon: 'error', title: 'Oops...', text: 'Gagal menghapus kegiatan akademik.' });
    }
  }
};

// Auth & Setup Lifecycle Hook
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
    fetchOptions();
    fetchActivities();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>

<style scoped>
/* Scoped custom animations */
.animate-fade-in {
  animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(4px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
