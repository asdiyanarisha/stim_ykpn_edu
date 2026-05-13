<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden">
    <!-- Sidebar -->
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-slate-900">Data Dosen</h1>
          <p class="text-slate-500">Kelola dan lihat informasi tenaga pengajar di sini.</p>
        </div>

        <!-- Toolbar Section -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div class="w-full sm:max-w-md">
            <AppInput v-model="searchQuery" placeholder="Cari nama dosen, pendidikan, alamat email..." id="search-dosen">
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
              <AppButton v-if="selectedTeachers.length > 0" variant="danger" size="md" @click="openBulkDeleteModal" class="whitespace-nowrap z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                Hapus ({{ selectedTeachers.length }})
              </AppButton>
            </transition>

            <!-- Add Teacher Button -->
            <a href="/masterData/teacher/create">
              <AppButton variant="primary" size="md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                Tambah Dosen
              </AppButton>
            </a>

            <!-- Options Dropdown wrapper -->
            <div class="relative z-20">
              <AppButton variant="secondary" size="md" @click="isOptionsOpen = !isOptionsOpen" class="!px-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
              </AppButton>

              <!-- Dropdown Menu -->
              <transition 
                enter-active-class="transition ease-out duration-100" 
                enter-from-class="transform opacity-0 scale-95" 
                enter-to-class="transform opacity-100 scale-100" 
                leave-active-class="transition ease-in duration-75" 
                leave-from-class="transform opacity-100 scale-100" 
                leave-to-class="transform opacity-0 scale-95"
              >
                <div v-show="isOptionsOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-100 z-50 overflow-hidden">
                  <div class="py-1">
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                      Export Data Dosen
                    </a>
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v-6m0 0l-3 3m3-3l3 3" /></svg>
                      Import Data Dosen
                    </a>
                  </div>
                </div>
              </transition>
            </div>

            <!-- Click outside overlay -->
            <div v-if="isOptionsOpen" @click="isOptionsOpen = false" class="fixed inset-0 z-10 hidden sm:block cursor-default"></div>
          </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
              <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                  <th class="px-6 py-4 w-12">
                    <input type="checkbox" @change="toggleSelectAll" :checked="selectedTeachers.length === paginatedTeachers.length && paginatedTeachers.length > 0" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                  </th>
                   <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Dosen</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Pendidikan</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Jabatan</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Alamat Email</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr v-for="teacher in paginatedTeachers" :key="teacher.id" class="hover:bg-slate-50 transition-colors group">
                  <td class="px-6 py-4">
                    <input type="checkbox" :value="teacher.id" v-model="selectedTeachers" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                      <img :src="teacher.avatar" class="w-9 h-9 rounded-full border border-slate-200">
                      <span class="font-semibold text-slate-900 text-sm group-hover:text-indigo-600 transition-colors">{{ teacher.name }}</span>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-sm text-slate-600">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                      {{ teacher.category }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-sm text-slate-600">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                      {{ teacher.education }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-sm text-slate-600">
                    <span v-if="teacher.job_title" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-100">
                      {{ teacher.job_title }}
                    </span>
                    <span v-else class="text-slate-400">-</span>
                  </td>
                  <td class="px-6 py-4 text-sm text-slate-500">{{ teacher.email }}</td>
                  <td class="px-6 py-4 text-right">
                    <a :href="`/masterData/teacher/show/${teacher.id}`" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                      Detail
                    </a>
                  </td>
                </tr>
                <tr v-if="paginatedTeachers.length === 0">
                  <td colspan="6" class="px-6 py-8 text-center text-slate-500 text-sm">Tidak ada data dosen yang tersedia.</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between bg-slate-50/50 gap-4">
            <div class="text-sm text-slate-500 text-center sm:text-left">
              Menampilkan <span class="font-bold text-slate-900">{{ (currentPage - 1) * limit + 1 }}</span>
              sampai <span class="font-bold text-slate-900">{{ Math.min(currentPage * limit, totalItems) }}</span>
              dari <span class="font-bold text-slate-900">{{ totalItems }}</span> dosen
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
              <h3 class="text-xl font-bold text-slate-900 mb-2">Hapus {{ isBulkDelete ? selectedTeachers.length + ' Data Dosen Terpilih' : 'Data Dosen' }}?</h3>
              <p class="text-slate-500 text-sm">
                Tindakan ini tidak dapat dibatalkan. Seluruh data riwayat pendidikan, publikasi, jabatan, dan profil terkait akan ikut terhapus secara permanen.
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
import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../Components/Atoms/AppButton.vue';
import AppInput from '../../Components/Atoms/AppInput.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);

const allTeachers = ref([]);

const selectedTeachers = ref([]);
const isOptionsOpen = ref(false);

const openBulkDeleteModal = () => {
    if (selectedTeachers.value.length === 0) return;
    isBulkDelete.value = true;
    showDeleteModal.value = true;
};

const searchQuery = ref('');

const filteredTeachers = computed(() => {
  if (!searchQuery.value) return allTeachers.value;
  const q = searchQuery.value.toLowerCase();
  return allTeachers.value.filter(t => 
    t.name.toLowerCase().includes(q) || 
    t.email.toLowerCase().includes(q) || 
    t.category.toLowerCase().includes(q) || 
    t.education.toLowerCase().includes(q)
  );
});

watch(searchQuery, () => {
  currentPage.value = 1;
});

// Pagination logic
const currentPage = ref(1);
const limit = ref(10);
const totalItems = computed(() => filteredTeachers.value.length);
const totalPages = computed(() => Math.ceil(totalItems.value / limit.value) || 1);

const paginatedTeachers = computed(() => {
  const offset = (currentPage.value - 1) * limit.value;
  return filteredTeachers.value.slice(offset, offset + limit.value);
});

const prevPage = () => { if (currentPage.value > 1) currentPage.value--; };
const nextPage = () => { if (currentPage.value < totalPages.value) currentPage.value++; };

const toggleSelectAll = (e) => {
  if (e.target.checked) selectedTeachers.value = paginatedTeachers.value.map(t => t.id);
  else selectedTeachers.value = [];
};

const buildAvatarUrl = (imageUrl, displayName) => {
  if (!imageUrl || !String(imageUrl).trim()) {
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(displayName)}&background=random`;
  }

  if (imageUrl.startsWith('http://') || imageUrl.startsWith('https://')) {
    return imageUrl;
  }

  if (imageUrl.startsWith('/storage/')) {
    return imageUrl;
  }

  if (imageUrl.startsWith('storage/')) {
    return `/${imageUrl}`;
  }

  return `/storage/${imageUrl.replace(/^\/+/, '')}`;
};

const buildTeacherDisplayName = (frontTitle, fullName, backTitle) => {
  const prefix = (frontTitle || '').trim();
  const name = (fullName || '').trim();
  const suffix = (backTitle || '').trim();

  const main = [prefix, name].filter(Boolean).join(' ').trim();
  if (!main && suffix) return suffix;
  if (main && suffix) return `${main}, ${suffix}`;
  return main || '-';
};

const fetchTeachers = async (token) => {
  const response = await axios.get('/api/teachers', {
    headers: { Authorization: `Bearer ${token}` },
  });

  const teachers = response?.data?.data ?? [];
  allTeachers.value = teachers.map((teacher) => {
    const displayName = buildTeacherDisplayName(
      teacher.front_title,
      teacher.full_name,
      teacher.back_title
    );

    return {
      id: teacher.id,
      name: displayName,
      category: teacher.category_title || 'Tidak Ada Kategori',
      job_title: teacher.job_title || null,
      email: teacher.email || '-',
      education: teacher.education || '-',
      avatar: buildAvatarUrl(teacher.image_url, displayName),
    };
  });
};

const showDeleteModal = ref(false);
const teacherToDeleteId = ref(null);
const isDeleting = ref(false);
const isBulkDelete = ref(false);

const openDeleteModal = (id) => {
  teacherToDeleteId.value = id;
  isBulkDelete.value = false;
  showDeleteModal.value = true;
};

const closeDeleteModal = () => {
  showDeleteModal.value = false;
  teacherToDeleteId.value = null;
  isBulkDelete.value = false;
  isDeleting.value = false;
};

const executeDelete = async () => {
  isDeleting.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    if (isBulkDelete.value) {
       const deletePromises = selectedTeachers.value.map(id => 
         axios.delete(`/api/teachers/${id}`, { headers: { Authorization: `Bearer ${token}` } })
       );
       await Promise.all(deletePromises);
       
       selectedTeachers.value = [];
       if (paginatedTeachers.value && paginatedTeachers.value.length === 0 && currentPage.value > 1) {
           currentPage.value--;
       }
    } else {
       if (!teacherToDeleteId.value) return;
       await axios.delete(`/api/teachers/${teacherToDeleteId.value}`, {
         headers: { Authorization: `Bearer ${token}` }
       });
    }
    
    closeDeleteModal();
    await fetchTeachers(token);
  } catch (error) {
    console.error('Error deleting teacher:', error);
    alert(error.response?.data?.message || 'Terjadi kesalahan saat menghapus data dosen.');
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
    try {
      await fetchTeachers(token);
    } catch (fetchError) {
      console.error('Failed to fetch teachers:', fetchError);
      // Optional: show a toast or error message on page instead of redirecting
    }
  } catch (error) {
    if (error.response?.status === 401) {
      deleteCookie(TOKEN_COOKIE_NAME);
      window.location.href = '/unauthenticated';
    } else {
      console.error('Token validation error:', error);
      isAuthenticated.value = true; // Still allow view if it's not a 401 (e.g. server error on validation)
    }
  }
});
</script>
