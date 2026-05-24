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
        <div v-if="!isAuthenticated || vouchersLoading" class="absolute inset-0 z-[60] bg-slate-50/80 backdrop-blur-sm flex items-center justify-center">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin mb-4"></div>
                <p class="text-slate-500 font-medium animate-pulse">Memuat Data Voucher...</p>
            </div>
        </div>
      </transition>

      <main v-if="isAuthenticated" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-slate-900">Manajemen Voucher</h1>
          <p class="text-slate-500">Kelola kupon diskon dan promo STIM YKPN.</p>
        </div>

        <!-- Toolbar Section -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div class="w-full sm:max-w-md">
            <AppInput v-model="searchQuery" placeholder="Cari judul atau kode voucher..." id="search-vouchers">
              <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
              </template>
            </AppInput>
          </div>
          
          <div class="flex flex-wrap items-center gap-3">
            <!-- Delete Selection Button (Visible only if items selected) -->
            <transition 
              enter-active-class="transition duration-200 ease-out" 
              enter-from-class="transform opacity-0 translate-x-4" 
              enter-to-class="transform opacity-100 translate-x-0" 
              leave-active-class="transition duration-100 ease-in" 
              leave-from-class="transform opacity-100 translate-x-0" 
              leave-to-class="transform opacity-0 translate-x-4"
            >
              <div v-if="selectedVouchers.length > 0" class="flex items-center gap-3 z-10">
                <AppButton variant="danger" size="md" @click="openBulkDeleteModal" class="whitespace-nowrap">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                  Hapus ({{ selectedVouchers.length }})
                </AppButton>
              </div>
            </transition>

            <!-- Add Voucher Button -->
            <a href="/voucher/create">
              <AppButton variant="primary" size="md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                Tambah Voucher
              </AppButton>
            </a>
          </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[900px]">
              <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                  <th class="px-6 py-4 w-12">
                    <input type="checkbox" @change="toggleSelectAll" :checked="selectedVouchers.length === paginatedVouchers.length && paginatedVouchers.length > 0" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                  </th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Voucher</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Kode Kupon</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Diskon</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr v-for="item in paginatedVouchers" :key="item.id" class="hover:bg-slate-50 transition-colors group">
                  <td class="px-6 py-4">
                    <input type="checkbox" :value="item.id" v-model="selectedVouchers" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex flex-col">
                        <span class="font-semibold text-slate-900 text-sm group-hover:text-indigo-600 transition-colors">{{ item.title || 'Tanpa Judul' }}</span>
                        <span class="text-xs text-slate-400 mt-0.5 line-clamp-1 max-w-xs">{{ item.description || '-' }}</span>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-bold border border-indigo-100 uppercase tracking-wider">
                        {{ item.code_coupon || '-' }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-sm font-bold text-slate-700">Rp {{ formatNumber(item.discount_amount) }}</span>
                  </td>
                  <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a :href="`/voucher/show/${item.id}`" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            Detail
                        </a>
                        <a :href="`/voucher/edit/${item.id}`" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            Edit
                        </a>
                    </div>
                  </td>
                </tr>
                <tr v-if="paginatedVouchers.length === 0">
                  <td colspan="5" class="px-6 py-12 text-center text-slate-500 text-sm">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>
                        </div>
                        <p class="font-medium text-slate-600">Tidak ada data voucher yang ditemukan.</p>
                        <p class="text-xs text-slate-400 mt-1">Gunakan kata kunci lain atau tambahkan voucher baru.</p>
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
              dari <span class="font-bold text-slate-900">{{ totalItems }}</span> voucher
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

        <!-- Custom Delete Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm transition-opacity">
          <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all translate-y-0 scale-100">
            <div class="p-6">
              <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
              </div>
              <h3 class="text-xl font-bold text-slate-900 mb-2">Hapus {{ isBulkDelete ? selectedVouchers.length + ' Voucher Terpilih' : 'Voucher' }}?</h3>
              <p class="text-slate-500 text-sm">
                Tindakan ini tidak dapat dibatalkan. Voucher yang dihapus akan hilang dari sistem secara permanen.
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
import { ref, computed, watch, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../Components/Atoms/AppButton.vue';
import AppInput from '../../Components/Atoms/AppInput.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);

const allVouchers = ref([]);
const vouchersLoading = ref(false);

const fetchVouchers = async () => {
  vouchersLoading.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.get('/api/vouchers', {
      headers: { Authorization: `Bearer ${token}` }
    });
    if (response.data.status === 'success') {
      allVouchers.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching vouchers:', error);
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan Sistem',
      text: 'Gagal mengambil data voucher.',
      confirmButtonColor: '#4f46e5'
    });
  } finally {
    vouchersLoading.value = false;
  }
};

const formatNumber = (num) => {
    return new Intl.NumberFormat('id-ID').format(num);
};

const selectedVouchers = ref([]);

const openBulkDeleteModal = () => {
    if (selectedVouchers.value.length === 0) return;
    isBulkDelete.value = true;
    showDeleteModal.value = true;
};

const searchQuery = ref('');

const filteredVouchers = computed(() => {
  if (!searchQuery.value) return allVouchers.value;
  const q = searchQuery.value.toLowerCase();
  return allVouchers.value.filter(v => 
    (v.title && v.title.toLowerCase().includes(q)) || 
    (v.code_coupon && v.code_coupon.toLowerCase().includes(q))
  );
});

watch(searchQuery, () => {
  currentPage.value = 1;
});

// Pagination logic
const currentPage = ref(1);
const limit = ref(10);
const totalItems = computed(() => filteredVouchers.value.length);
const totalPages = computed(() => Math.ceil(totalItems.value / limit.value) || 1);

const paginatedVouchers = computed(() => {
  const offset = (currentPage.value - 1) * limit.value;
  return filteredVouchers.value.slice(offset, offset + limit.value);
});

const prevPage = () => { if (currentPage.value > 1) currentPage.value--; };
const nextPage = () => { if (currentPage.value < totalPages.value) currentPage.value++; };

const toggleSelectAll = (e) => {
  if (e.target.checked) selectedVouchers.value = paginatedVouchers.value.map(v => v.id);
  else selectedVouchers.value = [];
};

const showDeleteModal = ref(false);
const itemToDeleteId = ref(null);
const isDeleting = ref(false);
const isBulkDelete = ref(false);

const closeDeleteModal = () => {
  showDeleteModal.value = false;
  itemToDeleteId.value = null;
  isBulkDelete.value = false;
  isDeleting.value = false;
};

const executeDelete = async () => {
  isDeleting.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    if (isBulkDelete.value) {
      await axios.post('/api/vouchers/bulk-delete', { ids: selectedVouchers.value }, {
        headers: { Authorization: `Bearer ${token}` }
      });
      selectedVouchers.value = [];
    } else {
      await axios.delete(`/api/vouchers/${itemToDeleteId.value}`, {
        headers: { Authorization: `Bearer ${token}` }
      });
    }
    fetchVouchers();
    closeDeleteModal();
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: 'Data voucher telah dihapus.',
      timer: 2000,
      showConfirmButton: false
    });
  } catch (error) {
    console.error('Error deleting vouchers:', error);
    Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Gagal menghapus voucher.' });
  } finally {
    isDeleting.value = false;
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
      headers: { Authorization: `Bearer ${token}` },
    });
    isAuthenticated.value = true;
    fetchVouchers();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
