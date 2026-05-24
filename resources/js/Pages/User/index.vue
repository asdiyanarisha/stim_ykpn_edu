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
        <div v-if="!isAuthenticated || usersLoading" class="absolute inset-0 z-[60] bg-slate-50/80 backdrop-blur-sm flex items-center justify-center">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin mb-4"></div>
                <p class="text-slate-500 font-medium animate-pulse">Memuat Data User...</p>
            </div>
        </div>
      </transition>

      <main v-if="isAuthenticated" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-slate-900">Manajemen User</h1>
          <p class="text-slate-500">Kelola pengguna sistem STIM YKPN.</p>
        </div>

        <!-- Toolbar Section -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div class="w-full sm:max-w-md">
            <AppInput v-model="searchQuery" placeholder="Cari nama atau email..." id="search-user">
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
              <div v-if="selectedUsers.length > 0" class="flex items-center gap-3 z-10">
                <AppButton variant="danger" size="md" @click="openBulkDeleteModal" class="whitespace-nowrap">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                  Hapus ({{ selectedUsers.length }})
                </AppButton>
              </div>
            </transition>

            <!-- Add User Button -->
            <a href="/user/create">
              <AppButton variant="primary" size="md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                Tambah User
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
                    <input type="checkbox" @change="toggleSelectAll" :checked="selectedUsers.length === selectableUsers.length && selectableUsers.length > 0" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                  </th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama User</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Email</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Role</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Dibuat Pada</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr v-for="item in paginatedUsers" :key="item.id" class="hover:bg-slate-50 transition-colors group">
                  <td class="px-6 py-4">
                    <input v-if="!isAdminUser(item)" type="checkbox" :value="item.id" v-model="selectedUsers" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                    <div v-else class="w-4 h-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="font-semibold text-slate-900 text-sm group-hover:text-indigo-600 transition-colors">{{ item.name }}</span>
                  </td>
                  <td class="px-6 py-4 text-sm text-slate-600">
                    {{ item.email }}
                  </td>
                  <td class="px-6 py-4">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border" :class="item.role?.name === 'administrator' ? 'bg-indigo-50 text-indigo-600 border-indigo-100' : 'bg-slate-100 text-slate-600 border-slate-200'">
                        {{ item.role?.name || 'No Role' }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-sm text-slate-500">
                    {{ new Date(item.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) }}
                  </td>
                  <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a :href="`/user/show/${item.id}`" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            Detail
                        </a>
                        <a v-if="!isAdminUser(item)" :href="`/user/edit/${item.id}`" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            Edit
                        </a>
                    </div>
                  </td>
                </tr>
                <tr v-if="paginatedUsers.length === 0">
                  <td colspan="6" class="px-6 py-12 text-center text-slate-500 text-sm">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <p class="font-medium text-slate-600">Tidak ada data user yang ditemukan.</p>
                        <p class="text-xs text-slate-400 mt-1">Gunakan kata kunci lain atau tambahkan user baru.</p>
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
              dari <span class="font-bold text-slate-900">{{ totalItems }}</span> user
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
              <h3 class="text-xl font-bold text-slate-900 mb-2">Hapus {{ isBulkDelete ? selectedUsers.length + ' User Terpilih' : 'User' }}?</h3>
              <p class="text-slate-500 text-sm">
                Tindakan ini tidak dapat dibatalkan. User yang dihapus akan hilang dari sistem secara permanen.
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

const allUsers = ref([]);
const usersLoading = ref(false);

const fetchUsers = async () => {
  usersLoading.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.get('/api/users', {
      headers: { Authorization: `Bearer ${token}` }
    });
    if (response.data.status === 'success') {
      allUsers.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching users:', error);
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan Sistem',
      text: 'Gagal mengambil data user.',
      confirmButtonColor: '#4f46e5'
    });
  } finally {
    usersLoading.value = false;
  }
};

const isAdminUser = (user) => {
    return user.role?.name === 'administrator';
};

const selectedUsers = ref([]);

const selectableUsers = computed(() => {
    return paginatedUsers.value.filter(u => !isAdminUser(u));
});

const openBulkDeleteModal = () => {
    if (selectedUsers.value.length === 0) return;
    isBulkDelete.value = true;
    showDeleteModal.value = true;
};

const searchQuery = ref('');

const filteredUsers = computed(() => {
  if (!searchQuery.value) return allUsers.value;
  const q = searchQuery.value.toLowerCase();
  return allUsers.value.filter(u => 
    u.name.toLowerCase().includes(q) || 
    u.email.toLowerCase().includes(q)
  );
});

watch(searchQuery, () => {
  currentPage.value = 1;
});

// Pagination logic
const currentPage = ref(1);
const limit = ref(10);
const totalItems = computed(() => filteredUsers.value.length);
const totalPages = computed(() => Math.ceil(totalItems.value / limit.value) || 1);

const paginatedUsers = computed(() => {
  const offset = (currentPage.value - 1) * limit.value;
  return filteredUsers.value.slice(offset, offset + limit.value);
});

const prevPage = () => { if (currentPage.value > 1) currentPage.value--; };
const nextPage = () => { if (currentPage.value < totalPages.value) currentPage.value++; };

const toggleSelectAll = (e) => {
  if (e.target.checked) selectedUsers.value = selectableUsers.value.map(u => u.id);
  else selectedUsers.value = [];
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
      await axios.post('/api/users/bulk-delete', { ids: selectedUsers.value }, {
        headers: { Authorization: `Bearer ${token}` }
      });
      selectedUsers.value = [];
    } else {
      await axios.delete(`/api/users/${itemToDeleteId.value}`, {
        headers: { Authorization: `Bearer ${token}` }
      });
    }
    fetchUsers();
    closeDeleteModal();
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: 'Data user telah dihapus.',
      timer: 2000,
      showConfirmButton: false
    });
  } catch (error) {
    console.error('Error deleting user:', error);
    Swal.fire({ icon: 'error', title: 'Gagal!', text: error.response?.data?.message || 'Gagal menghapus user.' });
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
    fetchUsers();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
