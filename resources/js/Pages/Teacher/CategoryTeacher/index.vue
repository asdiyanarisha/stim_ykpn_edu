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
        <div v-if="!isAuthenticated || itemsLoading" class="absolute inset-0 z-[60] bg-slate-50/80 backdrop-blur-sm flex items-center justify-center">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin mb-4"></div>
                <p class="text-slate-500 font-medium animate-pulse">Memuat Data Kategori Dosen...</p>
            </div>
        </div>
      </transition>

      <main v-if="isAuthenticated" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-slate-900">Kategori Dosen</h1>
          <p class="text-slate-500">Kelola kategori dosen STIM YKPN.</p>
        </div>

        <!-- Toolbar Section -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div class="w-full sm:max-w-md">
            <AppInput v-model="searchQuery" placeholder="Cari kategori dosen..." id="search-category-teachers">
              <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
              </template>
            </AppInput>
          </div>
          
          <div class="flex flex-wrap items-center gap-3">
            <transition 
              enter-active-class="transition duration-200 ease-out" 
              enter-from-class="transform opacity-0 translate-x-4" 
              enter-to-class="transform opacity-100 translate-x-0" 
              leave-active-class="transition duration-100 ease-in" 
              leave-from-class="transform opacity-100 translate-x-0" 
              leave-to-class="transform opacity-0 translate-x-4"
            >
              <div v-if="selectedItems.length > 0" class="flex items-center gap-3 z-10">
                <AppButton variant="danger" size="md" @click="openBulkDeleteModal" class="whitespace-nowrap">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                  Hapus
                </AppButton>
              </div>
            </transition>

            <AppButton variant="primary" size="md" @click="openFormModal()">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
              Tambah Kategori
            </AppButton>
          </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[900px]">
              <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                  <th class="px-6 py-4 w-12">
                    <input type="checkbox" @change="toggleSelectAll" :checked="selectedItems.length === paginatedItems.length && paginatedItems.length > 0" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                  </th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-2/5">Judul Kategori</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Slug</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr v-for="item in paginatedItems" :key="item.id" class="hover:bg-slate-50 transition-colors group">
                  <td class="px-6 py-4">
                    <input type="checkbox" :value="item.id" v-model="selectedItems" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex flex-col">
                        <span class="font-semibold text-slate-900 text-sm group-hover:text-indigo-600 transition-colors">{{ item.title || 'Tanpa Judul' }}</span>
                        <span class="text-xs text-slate-400 mt-0.5">Dibuat: {{ formatDate(item.created_at) }}</span>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="text-sm text-slate-600">{{ item.slug || '-' }}</span>
                  </td>
                  <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a :href="`/masterData/teacher/category/show/${item.id}`" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            Detail
                        </a>
                        <button @click="openFormModal(item)" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            Edit
                        </button>
                    </div>
                  </td>
                </tr>
                <tr v-if="paginatedItems.length === 0">
                  <td colspan="4" class="px-6 py-12 text-center text-slate-500 text-sm">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="font-medium text-slate-600">Tidak ada data kategori dosen yang ditemukan.</p>
                        <p class="text-xs text-slate-400 mt-1">Gunakan kata kunci lain atau tambahkan kategori baru.</p>
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
              dari <span class="font-bold text-slate-900">{{ totalItems }}</span> kategori
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

        <!-- Form Modal (Create/Edit) -->
        <div v-if="showFormModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm transition-opacity">
          <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all translate-y-0 scale-100">
            <div class="p-6">
              <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </div>
              <h3 class="text-xl font-bold text-slate-900 mb-2">{{ editingItem ? 'Ubah Kategori' : 'Tambah Kategori Baru' }}</h3>
              <p class="text-slate-500 text-sm mb-6">{{ editingItem ? 'Perbarui judul kategori dosen.' : 'Masukkan judul untuk kategori dosen baru.' }}</p>
              
              <form @submit.prevent="handleFormSubmit">
                <AppInput v-model="formTitle" label="Judul Kategori" placeholder="Masukkan judul kategori..." id="modal-category-title" :error="formError" />
              </form>
            </div>
            <div class="px-6 py-4 bg-slate-50 flex items-center justify-end gap-3 rounded-b-2xl">
              <button @click="closeFormModal" :disabled="isSubmitting" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:text-slate-800 transition-colors cursor-pointer disabled:opacity-50">
                Batal
              </button>
              <button @click="handleFormSubmit" :disabled="isSubmitting" class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 active:scale-95 transition-all rounded-xl shadow-sm shadow-indigo-200 disabled:opacity-50 disabled:active:scale-100 flex items-center gap-2 cursor-pointer">
                <svg v-if="isSubmitting" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span v-if="!isSubmitting">{{ editingItem ? 'Simpan Perubahan' : 'Simpan Kategori' }}</span>
                <span v-if="isSubmitting">Menyimpan...</span>
              </button>
            </div>
          </div>
        </div>

        <!-- Delete Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm transition-opacity">
          <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all translate-y-0 scale-100">
            <div class="p-6">
              <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
              </div>
              <h3 class="text-xl font-bold text-slate-900 mb-2">Hapus {{ isBulkDelete ? selectedItems.length + ' Kategori Terpilih' : 'Kategori' }}?</h3>
              <p class="text-slate-500 text-sm">
                Tindakan ini tidak dapat dibatalkan. Data kategori yang dihapus akan hilang dari sistem secara permanen.
              </p>
            </div>
            <div class="px-6 py-4 bg-slate-50 flex items-center justify-end gap-3 rounded-b-2xl">
              <button @click="closeDeleteModal" :disabled="isDeleting" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:text-slate-800 transition-colors cursor-pointer disabled:opacity-50">
                Batal
              </button>
              <button @click="executeDelete" :disabled="isDeleting" class="px-5 py-2 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 active:scale-95 transition-all rounded-xl shadow-sm shadow-rose-200 disabled:opacity-50 disabled:active:scale-100 flex items-center gap-2 cursor-pointer">
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
import AppSidebar from '../../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../../Components/Atoms/AppButton.vue';
import AppInput from '../../../Components/Atoms/AppInput.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const allItems = ref([]);
const itemsLoading = ref(false);

const formatDate = (dateString) => {
  if (!dateString) return '-';
  const date = new Date(dateString);
  return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
};

const fetchCategories = async () => {
  itemsLoading.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.get('/api/category-teachers', {
      headers: { Authorization: `Bearer ${token}` }
    });
    if (response.data.status === 'success') {
      allItems.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching categories:', error);
    Swal.fire({ icon: 'error', title: 'Kesalahan Sistem', text: 'Gagal mengambil data kategori dosen.', confirmButtonColor: '#4f46e5' });
  } finally {
    itemsLoading.value = false;
  }
};

// Search & Pagination
const selectedItems = ref([]);
const searchQuery = ref('');

const filteredItems = computed(() => {
  if (!searchQuery.value) return allItems.value;
  const q = searchQuery.value.toLowerCase();
  return allItems.value.filter(n => (n.title && n.title.toLowerCase().includes(q)) || (n.slug && n.slug.toLowerCase().includes(q)));
});

watch(searchQuery, () => { currentPage.value = 1; });

const currentPage = ref(1);
const limit = ref(10);
const totalItems = computed(() => filteredItems.value.length);
const totalPages = computed(() => Math.ceil(totalItems.value / limit.value) || 1);
const paginatedItems = computed(() => {
  const offset = (currentPage.value - 1) * limit.value;
  return filteredItems.value.slice(offset, offset + limit.value);
});
const prevPage = () => { if (currentPage.value > 1) currentPage.value--; };
const nextPage = () => { if (currentPage.value < totalPages.value) currentPage.value++; };
const toggleSelectAll = (e) => {
  if (e.target.checked) selectedItems.value = paginatedItems.value.map(n => n.id);
  else selectedItems.value = [];
};

// Form Modal
const showFormModal = ref(false);
const formTitle = ref('');
const formError = ref('');
const isSubmitting = ref(false);
const editingItem = ref(null);

const openFormModal = (item = null) => {
  editingItem.value = item;
  formTitle.value = item ? (item.title || '') : '';
  formError.value = '';
  showFormModal.value = true;
};

const closeFormModal = () => {
  showFormModal.value = false;
  editingItem.value = null;
  formTitle.value = '';
  formError.value = '';
};

const handleFormSubmit = async () => {
  if (!formTitle.value.trim()) {
    formError.value = 'Judul kategori wajib diisi';
    return;
  }
  isSubmitting.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const payload = { title: formTitle.value };
    const endpoint = editingItem.value ? `/api/category-teachers/${editingItem.value.id}` : '/api/category-teachers';
    const response = await axios.post(endpoint, payload, { headers: { Authorization: `Bearer ${token}` } });
    if (response.data.status === 'success') {
      fetchCategories();
      closeFormModal();
      Swal.fire({ icon: 'success', title: 'Berhasil!', text: editingItem.value ? 'Kategori berhasil diperbarui.' : 'Kategori baru berhasil ditambahkan.', timer: 2000, showConfirmButton: false });
    }
  } catch (error) {
    const message = error.response?.data?.message || 'Terjadi kesalahan saat menyimpan kategori.';
    Swal.fire({ icon: 'error', title: 'Oops...', text: message });
  } finally {
    isSubmitting.value = false;
  }
};

// Delete Modal
const showDeleteModal = ref(false);
const itemToDeleteId = ref(null);
const isDeleting = ref(false);
const isBulkDelete = ref(false);

const openBulkDeleteModal = () => {
  if (selectedItems.value.length === 0) return;
  isBulkDelete.value = true;
  showDeleteModal.value = true;
};

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
      await axios.post('/api/category-teachers/bulk-delete', { ids: selectedItems.value }, { headers: { Authorization: `Bearer ${token}` } });
      selectedItems.value = [];
    } else {
      await axios.delete(`/api/category-teachers/${itemToDeleteId.value}`, { headers: { Authorization: `Bearer ${token}` } });
    }
    fetchCategories();
    closeDeleteModal();
    Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data kategori dosen telah dihapus.', timer: 2000, showConfirmButton: false });
  } catch (error) {
    Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Gagal menghapus kategori dosen.' });
  } finally {
    isDeleting.value = false;
  }
};

onMounted(async () => {
  const token = getCookie(TOKEN_COOKIE_NAME);
  if (!token) { window.location.href = '/unauthenticated'; return; }
  try {
    await axios.post('/api/auth/validate-token', {}, { headers: { Authorization: `Bearer ${token}` } });
    isAuthenticated.value = true;
    fetchCategories();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
