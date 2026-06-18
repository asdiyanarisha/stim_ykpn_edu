<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden">
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
        <div v-if="!isAuthenticated || bannersLoading" class="absolute inset-0 z-[60] bg-slate-50/80 backdrop-blur-sm flex items-center justify-center">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin mb-4"></div>
                <p class="text-slate-500 font-medium animate-pulse">Memuat Data Banner...</p>
            </div>
        </div>
      </transition>

      <main v-if="isAuthenticated" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-slate-900">Manajemen Banner</h1>
          <p class="text-slate-500">Kelola banner promosi dan informasi di halaman depan.</p>
        </div>

        <!-- Toolbar Section -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <!-- Search (disabled saat mode reorder) -->
          <div class="w-full sm:max-w-md" :class="{ 'opacity-40 pointer-events-none': isReorderMode }">
            <AppInput v-model="searchQuery" placeholder="Cari judul banner atau deskripsi..." id="search-banner">
              <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
              </template>
            </AppInput>
          </div>
          
          <div class="flex flex-wrap items-center gap-3">
            <!-- Mode Reorder: Tombol Simpan & Batal -->
            <template v-if="isReorderMode">
              <button
                @click="cancelReorder"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl transition-all shadow-sm"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                Batal
              </button>
              <button
                @click="saveReorder"
                :disabled="isSavingReorder"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 disabled:opacity-60 disabled:cursor-not-allowed rounded-xl transition-all shadow-sm shadow-emerald-200 active:scale-95"
              >
                <svg v-if="isSavingReorder" class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ isSavingReorder ? 'Menyimpan...' : 'Simpan Urutan' }}
              </button>
            </template>

            <!-- Mode Normal: tombol Atur Urutan, Hapus, Tambah -->
            <template v-else>
              <transition 
                enter-active-class="transition duration-200 ease-out" 
                enter-from-class="transform opacity-0 translate-x-4" 
                enter-to-class="transform opacity-100 translate-x-0" 
                leave-active-class="transition duration-100 ease-in" 
                leave-from-class="transform opacity-100 translate-x-0" 
                leave-to-class="transform opacity-0 translate-x-4"
              >
                <AppButton v-if="selectedBanners.length > 0" variant="danger" size="md" @click="openBulkDeleteModal" class="whitespace-nowrap z-10">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                  Hapus ({{ selectedBanners.length }})
                </AppButton>
              </transition>

              <button
                v-if="allBanners.length > 1"
                @click="enterReorderMode"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 rounded-xl transition-all shadow-sm"
              >
                <!-- Grip/handle icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M8 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm8-12a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                </svg>
                Atur Urutan
              </button>

              <a href="/content/banner/create">
                <AppButton variant="primary" size="md">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                  Tambah Banner
                </AppButton>
              </a>
            </template>
          </div>
        </div>

        <!-- ===== MODE DRAG & DROP (v-show agar DOM selalu ada, tidak perlu wait transition) ===== -->
        <div v-show="isReorderMode">
          <!-- Info banner -->
          <div class="mb-4 flex items-center gap-3 px-4 py-3 bg-indigo-50 border border-indigo-200 rounded-xl text-sm text-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>Seret baris menggunakan ikon <strong>⠿</strong> di sisi kiri untuk mengubah urutan. Klik <strong>Simpan Urutan</strong> saat selesai.</span>
          </div>

          <!-- Sortable container — ref dilekatkan langsung ke elemen yang jadi parent item-item sortable -->
          <div
            ref="sortableContainer"
            class="bg-white rounded-2xl border border-slate-100 shadow-sm divide-y divide-slate-100 overflow-hidden"
          >
            <div
              v-for="(banner, index) in reorderList"
              :key="banner.id"
              class="sortable-item flex items-center gap-4 px-4 py-3 hover:bg-slate-50 transition-colors group select-none"
            >
              <!-- Drag Handle — area yang bisa di-drag -->
              <div class="drag-handle flex-shrink-0 cursor-grab active:cursor-grabbing p-2 rounded-lg text-slate-400 hover:text-indigo-500 hover:bg-indigo-50 transition-colors" title="Seret untuk mengubah urutan">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M8 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm8-12a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                </svg>
              </div>

              <!-- Nomor Urut -->
              <div class="flex-shrink-0 w-7 h-7 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-bold">
                {{ index + 1 }}
              </div>

              <!-- Thumbnail -->
              <div class="flex-shrink-0 w-24 h-14 rounded-lg border border-slate-200 overflow-hidden bg-slate-100">
                <img :src="banner.url_image" class="w-full h-full object-cover" :alt="banner.title || 'Banner'">
              </div>

              <!-- Info -->
              <div class="flex-1 min-w-0">
                <p class="font-semibold text-slate-900 text-sm truncate">{{ banner.title || '(Tanpa Judul)' }}</p>
                <p class="text-xs text-slate-400 truncate mt-0.5">{{ banner.description || 'Tidak ada deskripsi' }}</p>
              </div>

              <!-- Kanan: arrows hint -->
              <div class="flex-shrink-0 text-slate-300 group-hover:text-indigo-400 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" /></svg>
              </div>
            </div>

            <div v-if="reorderList.length === 0" class="px-6 py-8 text-center text-slate-400 text-sm">
              Tidak ada banner yang dapat diurutkan.
            </div>
          </div>
        </div>

        <!-- ===== MODE NORMAL: Table (v-show, bukan v-if) ===== -->
        <div v-show="!isReorderMode">
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                  <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 w-12">
                      <input type="checkbox" @change="toggleSelectAll" :checked="selectedBanners.length === paginatedBanners.length && paginatedBanners.length > 0" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                    </th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-12 text-center">#</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Visual</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Judul Banner</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Deskripsi Singkat</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  <tr v-for="(banner, index) in paginatedBanners" :key="banner.id" class="hover:bg-slate-50 transition-colors group">
                    <td class="px-6 py-4">
                      <input type="checkbox" :value="banner.id" v-model="selectedBanners" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                    </td>
                    <td class="px-6 py-4 text-center">
                      <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-slate-100 text-slate-500 text-xs font-bold">
                        {{ (currentPage - 1) * limit + index + 1 }}
                      </span>
                    </td>
                    <td class="px-6 py-4">
                      <div class="w-20 h-12 rounded-lg border border-slate-200 overflow-hidden bg-slate-100">
                        <img :src="banner.url_image" class="w-full h-full object-cover">
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <span class="font-semibold text-slate-900 text-sm group-hover:text-indigo-600 transition-colors">{{ banner.title }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 max-w-xs truncate">
                      {{ banner.description || '-' }}
                    </td>
                    <td class="px-6 py-4 text-right">
                      <div class="flex items-center justify-end gap-2">
                          <a :href="`/content/banner/show/${banner.id}`" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                          Detail
                          </a>
                          <a :href="`/content/banner/edit/${banner.id}`" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                          Edit
                          </a>
                      </div>
                    </td>
                  </tr>
                  <tr v-if="paginatedBanners.length === 0">
                    <td colspan="6" class="px-6 py-8 text-center text-slate-500 text-sm">Tidak ada data banner yang tersedia.</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between bg-slate-50/50 gap-4">
              <div class="text-sm text-slate-500 text-center sm:text-left">
                Menampilkan <span class="font-bold text-slate-900">{{ (currentPage - 1) * limit + 1 }}</span>
                sampai <span class="font-bold text-slate-900">{{ Math.min(currentPage * limit, totalItems) }}</span>
                dari <span class="font-bold text-slate-900">{{ totalItems }}</span> banner
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
        </div>

        <!-- Custom Delete Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm transition-opacity">
          <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all translate-y-0 scale-100">
            <div class="p-6">
              <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
              </div>
              <h3 class="text-xl font-bold text-slate-900 mb-2">Hapus {{ isBulkDelete ? selectedBanners.length + ' Data Banner Terpilih' : 'Data Banner' }}?</h3>
              <p class="text-slate-500 text-sm">
                Tindakan ini tidak dapat dibatalkan. Banner yang dihapus tidak akan ditampilkan lagi di halaman depan.
              </p>
            </div>
            <div class="px-6 py-4 bg-slate-50 flex items-center justify-end gap-3 rounded-b-2xl">
              <button @click="closeDeleteModal" :disabled="isDeleting" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:text-slate-800 transition-colors cursor-pointer disabled:opacity-50">
                Batal
              </button>
              <button @click="executeDelete" :disabled="isDeleting" class="px-5 py-2 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 active:scale-95 transition-all rounded-xl shadow-sm shadow-rose-200 disabled:opacity-50 disabled:active:scale-100 flex items-center gap-2">
                <svg v-if="isDeleting" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span v-else>Ya, Hapus</span>
                <span v-if="isDeleting">Menghapus...</span>
              </button>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted, onBeforeUnmount, nextTick } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import Sortable from 'sortablejs';
import AppSidebar from '../../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../../Components/Atoms/AppButton.vue';
import AppInput from '../../../Components/Atoms/AppInput.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);

const allBanners = ref([]);
const bannersLoading = ref(false);

const fetchBanners = async () => {
  bannersLoading.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.get('/api/banners', {
      headers: { Authorization: `Bearer ${token}` }
    });
    if (response.data.status === 'success') {
      allBanners.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching banners:', error);
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan Sistem',
      text: 'Gagal mengambil data banner. Silakan coba beberapa saat lagi.',
      confirmButtonColor: '#4f46e5'
    });
  } finally {
    bannersLoading.value = false;
  }
};

const selectedBanners = ref([]);

const openBulkDeleteModal = () => {
    if (selectedBanners.value.length === 0) return;
    isBulkDelete.value = true;
    showDeleteModal.value = true;
};

const searchQuery = ref('');

const filteredBanners = computed(() => {
  if (!searchQuery.value) return allBanners.value;
  const q = searchQuery.value.toLowerCase();
  return allBanners.value.filter(b =>
    (b.title || '').toLowerCase().includes(q) ||
    (b.description || '').toLowerCase().includes(q)
  );
});

watch(searchQuery, () => {
  currentPage.value = 1;
});

// Pagination logic
const currentPage = ref(1);
const limit = ref(10);
const totalItems = computed(() => filteredBanners.value.length);
const totalPages = computed(() => Math.ceil(totalItems.value / limit.value) || 1);

const paginatedBanners = computed(() => {
  const offset = (currentPage.value - 1) * limit.value;
  return filteredBanners.value.slice(offset, offset + limit.value);
});

const prevPage = () => { if (currentPage.value > 1) currentPage.value--; };
const nextPage = () => { if (currentPage.value < totalPages.value) currentPage.value++; };

const toggleSelectAll = (e) => {
  if (e.target.checked) selectedBanners.value = paginatedBanners.value.map(b => b.id);
  else selectedBanners.value = [];
};

const showDeleteModal = ref(false);
const bannerToDeleteId = ref(null);
const isDeleting = ref(false);
const isBulkDelete = ref(false);

const closeDeleteModal = () => {
  showDeleteModal.value = false;
  bannerToDeleteId.value = null;
  isBulkDelete.value = false;
  isDeleting.value = false;
};

const executeDelete = async () => {
  isDeleting.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    if (isBulkDelete.value) {
      await axios.post('/api/banners/bulk-delete', { ids: selectedBanners.value }, {
        headers: { Authorization: `Bearer ${token}` }
      });
    } else {
      await axios.delete(`/api/banners/${bannerToDeleteId.value}`, {
        headers: { Authorization: `Bearer ${token}` }
      });
    }
    fetchBanners();
    closeDeleteModal();
  } catch (error) {
    console.error('Error deleting banner:', error);
  } finally {
    isDeleting.value = false;
  }
};

// ==============================
// Drag & Drop Reorder Logic
// ==============================
const isReorderMode = ref(false);
const reorderList = ref([]);
const sortableContainer = ref(null);
const isSavingReorder = ref(false);
let sortableInstance = null;

/**
 * Watch isReorderMode dengan flush:'post' agar DOM sudah diperbarui
 * sebelum kita mencoba menginisialisasi SortableJS.
 * Menggunakan v-show (bukan v-if) sehingga elemen selalu ada di DOM,
 * hanya perlu tunggu reorderList terisi dan nextTick selesai.
 */
watch(isReorderMode, async (active) => {
  if (active) {
    // Pastikan reorderList sudah terisi sebelum init
    await nextTick();
    initSortable();
  } else {
    destroySortable();
  }
}, { flush: 'post' });

const initSortable = () => {
  // Hancurkan instance lama kalau ada
  destroySortable();

  if (!sortableContainer.value) {
    console.warn('[Sortable] container ref tidak ditemukan');
    return;
  }

  sortableInstance = Sortable.create(sortableContainer.value, {
    handle: '.drag-handle',    // Hanya dari elemen dengan class ini
    animation: 200,
    ghostClass: 'sortable-ghost',
    chosenClass: 'sortable-chosen',
    dragClass: 'sortable-drag',
    // Tanpa forceFallback agar native HTML5 drag digunakan
    onEnd(evt) {
      // Sync reorderList dengan posisi DOM baru setelah drag selesai
      if (evt.oldIndex === evt.newIndex) return;
      const items = [...reorderList.value];
      const moved = items.splice(evt.oldIndex, 1)[0];
      items.splice(evt.newIndex, 0, moved);
      reorderList.value = items;
    },
  });
};

const destroySortable = () => {
  if (sortableInstance) {
    sortableInstance.destroy();
    sortableInstance = null;
  }
};

const enterReorderMode = () => {
  // Salin semua banner (bukan hanya paginated) ke reorderList
  reorderList.value = [...allBanners.value];
  selectedBanners.value = [];
  isReorderMode.value = true;
};

const cancelReorder = () => {
  isReorderMode.value = false;
  reorderList.value = [];
};

const saveReorder = async () => {
  isSavingReorder.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);

    const orders = reorderList.value.map((banner, index) => ({
      id: banner.id,
      sort_order: index,
    }));

    await axios.post('/api/banners/reorder', { orders }, {
      headers: { Authorization: `Bearer ${token}` }
    });

    isReorderMode.value = false;
    reorderList.value = [];

    await fetchBanners();

    Swal.fire({
      icon: 'success',
      title: 'Urutan Tersimpan!',
      text: 'Urutan banner berhasil diperbarui.',
      confirmButtonColor: '#4f46e5',
      timer: 3000,
      timerProgressBar: true,
      showConfirmButton: false,
      toast: true,
      position: 'top-end',
    });
  } catch (error) {
    console.error('Error saving reorder:', error);
    Swal.fire({
      icon: 'error',
      title: 'Gagal Menyimpan',
      text: 'Terjadi kesalahan saat menyimpan urutan. Silakan coba lagi.',
      confirmButtonColor: '#4f46e5',
    });
  } finally {
    isSavingReorder.value = false;
  }
};

// Cleanup saat component di-unmount
onBeforeUnmount(() => {
  destroySortable();
});

onMounted(async () => {
  const token = getCookie(TOKEN_COOKIE_NAME);

  if (!token) {
    window.location.href = '/unauthenticated';
    return;
  }

  try {
    await axios.post('/api/auth/validate-token', {}, {
      headers: { Authorization: `Bearer ${token}` },
    });
    isAuthenticated.value = true;
    fetchBanners();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>

<style scoped>
/* Item sedang di-drag: warna samar */
.sortable-ghost {
  opacity: 0.35;
  background-color: #e0e7ff !important; /* indigo-100 */
}

/* Item yang sedang "diangkat" / floating */
.sortable-drag {
  opacity: 1 !important;
  background: #fff;
  box-shadow: 0 12px 32px -4px rgba(79, 70, 229, 0.3), 0 4px 8px -2px rgba(0, 0, 0, 0.1);
  border-radius: 0.75rem;
}

/* Item yang dipilih (sebelum mulai gerak) */
.sortable-chosen {
  background-color: #f5f3ff !important; /* violet-50 */
}

/* Pastikan user tidak bisa select teks saat drag */
.sortable-item {
  user-select: none;
  -webkit-user-select: none;
}
</style>
