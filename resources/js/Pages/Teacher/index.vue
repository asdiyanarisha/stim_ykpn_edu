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
          <p class="text-slate-500">Kelola dan atur urutan tampilan dosen di halaman publik.</p>
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
            <!-- Save Order Button (muncul saat ada perubahan urutan) -->
            <transition
              enter-active-class="transition duration-200 ease-out"
              enter-from-class="transform opacity-0 scale-95"
              enter-to-class="transform opacity-100 scale-100"
              leave-active-class="transition duration-100 ease-in"
              leave-from-class="transform opacity-100 scale-100"
              leave-to-class="transform opacity-0 scale-95"
            >
              <button
                v-if="orderChanged"
                @click="saveOrder"
                :disabled="isSavingOrder"
                id="btn-save-order"
                class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 active:scale-95 transition-all rounded-xl shadow-sm disabled:opacity-60 disabled:active:scale-100 whitespace-nowrap"
              >
                <svg v-if="isSavingOrder" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ isSavingOrder ? 'Menyimpan...' : 'Simpan Urutan' }}
              </button>
            </transition>

            <!-- Delete Selection Button -->
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
          </div>
        </div>

        <!-- Order mode info banner -->
        <div class="mb-4 flex items-center gap-2 px-4 py-2.5 bg-blue-50 border border-blue-100 rounded-xl text-sm text-blue-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          <span>Ketik nomor urutan langsung di kolom <strong>No.</strong>, atau gunakan tombol <strong>↑ ↓</strong>. Klik <strong>Simpan Urutan</strong> untuk menyimpan ke database.</span>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[900px]">
              <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                  <th class="px-4 py-4 w-28 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">No. Urutan</th>
                  <th class="px-6 py-4 w-10">
                    <input type="checkbox" @change="toggleSelectAll" :checked="selectedTeachers.length === paginatedTeachers.length && paginatedTeachers.length > 0" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                  </th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Dosen</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Pendidikan</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Jabatan</th>
                  <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr
                  v-for="(teacher, index) in paginatedTeachers"
                  :key="teacher.id"
                  class="transition-colors group hover:bg-slate-50"
                >
                  <!-- No. Urutan: input + tombol ↑↓ -->
                  <td class="px-4 py-3" colspan="1">
                    <div class="flex flex-col items-center gap-1">
                      <!-- Input number manual -->
                      <input
                        type="number"
                        :value="getTeacherRealOrder(teacher.id)"
                        min="1"
                        :max="allTeachers.length"
                        @change="applyManualOrder(index, $event)"
                        @keydown.enter="$event.target.blur()"
                        class="w-14 text-center text-sm font-bold border border-slate-200 rounded-lg py-1 px-1 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-colors bg-white text-slate-700"
                        title="Ketik nomor urutan lalu tekan Enter atau klik di luar"
                      />
                      <!-- Tombol ↑ ↓ -->
                      <div class="flex gap-1">
                        <button
                          @click="moveUp(index)"
                          :disabled="getTeacherRealOrder(teacher.id) === 1"
                          class="p-0.5 rounded text-slate-300 hover:text-indigo-600 hover:bg-indigo-50 disabled:opacity-20 disabled:cursor-not-allowed transition-colors"
                          title="Pindah ke atas"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" /></svg>
                        </button>
                        <button
                          @click="moveDown(index)"
                          :disabled="getTeacherRealOrder(teacher.id) === allTeachers.length"
                          class="p-0.5 rounded text-slate-300 hover:text-indigo-600 hover:bg-indigo-50 disabled:opacity-20 disabled:cursor-not-allowed transition-colors"
                          title="Pindah ke bawah"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                      </div>
                    </div>
                  </td>

                  <!-- Checkbox -->
                  <td class="px-6 py-4">
                    <input type="checkbox" :value="teacher.id" v-model="selectedTeachers" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                  </td>

                  <!-- Nama Dosen -->
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                      <img :src="teacher.avatar" class="w-9 h-9 rounded-full border border-slate-200 object-cover flex-shrink-0">
                      <span class="font-semibold text-slate-900 text-sm group-hover:text-indigo-600 transition-colors">{{ teacher.name }}</span>
                    </div>
                  </td>

                  <!-- Kategori -->
                  <td class="px-6 py-4 text-sm text-slate-600">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                      {{ teacher.category }}
                    </span>
                  </td>

                  <!-- Pendidikan -->
                  <td class="px-6 py-4 text-sm text-slate-600">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                      {{ teacher.education }}
                    </span>
                  </td>

                  <!-- Jabatan -->
                  <td class="px-6 py-4 text-sm text-slate-600">
                    <span v-if="teacher.job_title" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-100">
                      {{ teacher.job_title }}
                    </span>
                    <span v-else class="text-slate-400">-</span>
                  </td>

                  <!-- Aksi -->
                  <td class="px-6 py-4 text-right">
                    <a :href="`/masterData/teacher/show/${teacher.id}`" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                      Detail
                    </a>
                  </td>
                </tr>
                <tr v-if="paginatedTeachers.length === 0">
                  <td colspan="8" class="px-6 py-8 text-center text-slate-500 text-sm">Tidak ada data dosen yang tersedia.</td>
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

        <!-- Delete Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
          <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
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
import Swal from 'sweetalert2';
import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../Components/Atoms/AppButton.vue';
import AppInput from '../../Components/Atoms/AppInput.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const allTeachers = ref([]);
const originalOrder = ref([]);
const orderChanged = ref(false);
const isSavingOrder = ref(false);

// ============================================================
// DRAG & DROP
// ============================================================
const dragIndex = ref(null);
const dragOverIndex = ref(null);

const onDragStart = (index) => {
  dragIndex.value = globalIndex(index);
};

const onDragOver = (index) => {
  dragOverIndex.value = index;
};

const onDragEnd = () => {
  if (dragIndex.value !== null && dragOverIndex.value !== null) {
    const fromGlobal = dragIndex.value;
    const toGlobal = globalIndex(dragOverIndex.value);
    if (fromGlobal !== toGlobal) {
      const arr = [...allTeachers.value];
      const [moved] = arr.splice(fromGlobal, 1);
      arr.splice(toGlobal, 0, moved);
      allTeachers.value = arr;
      checkOrderChanged();
    }
  }
  dragIndex.value = null;
  dragOverIndex.value = null;
};

// ============================================================
// MOVE UP / DOWN
// ============================================================
// Mendapatkan urutan aslinya dari database (1-based index di allTeachers)
const getTeacherRealOrder = (teacherId) => {
  return allTeachers.value.findIndex(t => t.id === teacherId) + 1;
};

const globalIndex = (pageIndex) => {
  return (currentPage.value - 1) * limit.value + pageIndex;
};

const moveUp = (pageIndex) => {
  const teacherId = paginatedTeachers.value[pageIndex].id;
  const gi = allTeachers.value.findIndex(t => t.id === teacherId);
  if (gi === -1 || gi === 0) return;
  const arr = [...allTeachers.value];
  [arr[gi - 1], arr[gi]] = [arr[gi], arr[gi - 1]];
  allTeachers.value = arr;
  checkOrderChanged();
};

const moveDown = (pageIndex) => {
  const teacherId = paginatedTeachers.value[pageIndex].id;
  const gi = allTeachers.value.findIndex(t => t.id === teacherId);
  if (gi === -1 || gi >= allTeachers.value.length - 1) return;
  const arr = [...allTeachers.value];
  [arr[gi], arr[gi + 1]] = [arr[gi + 1], arr[gi]];
  allTeachers.value = arr;
  checkOrderChanged();
};

// Input manual: pindahkan dosen ke posisi yang diketik user (1-based)
const applyManualOrder = (pageIndex, event) => {
  const inputVal = parseInt(event.target.value);
  const total = allTeachers.value.length;
  const targetPos = Math.max(1, Math.min(total, inputVal || 1)) - 1; // 0-based
  
  const teacherId = paginatedTeachers.value[pageIndex].id;
  const fromPos = allTeachers.value.findIndex(t => t.id === teacherId);

  if (fromPos === -1 || fromPos === targetPos) return;

  const arr = [...allTeachers.value];
  const [moved] = arr.splice(fromPos, 1);
  arr.splice(targetPos, 0, moved);
  allTeachers.value = arr;
  checkOrderChanged();

  // Reset input ke nilai yang benar (kalau user ketik di luar range)
  event.target.value = targetPos + 1;
};

const checkOrderChanged = () => {
  const currentIds = allTeachers.value.map(t => t.id);
  const origIds = originalOrder.value;
  orderChanged.value = JSON.stringify(currentIds) !== JSON.stringify(origIds);
};

// ============================================================
// SAVE ORDER
// ============================================================
const saveOrder = async () => {
  isSavingOrder.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const ids = allTeachers.value.map(t => t.id);
    await axios.post('/api/teachers/reorder', { ids }, {
      headers: { Authorization: `Bearer ${token}` },
    });
    originalOrder.value = [...ids];
    orderChanged.value = false;
    Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Urutan dosen berhasil disimpan.', timer: 2000, showConfirmButton: false });
  } catch (error) {
    Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Gagal menyimpan urutan dosen.' });
  } finally {
    isSavingOrder.value = false;
  }
};

// ============================================================
// SEARCH & PAGINATION
// ============================================================
const selectedTeachers = ref([]);
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

watch(searchQuery, () => { currentPage.value = 1; });

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

// ============================================================
// FETCH TEACHERS
// ============================================================
const buildAvatarUrl = (imageUrl, displayName) => {
  if (!imageUrl || !String(imageUrl).trim()) {
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(displayName)}&background=random`;
  }
  if (imageUrl.startsWith('http://') || imageUrl.startsWith('https://')) return imageUrl;
  if (imageUrl.startsWith('/storage/')) return imageUrl;
  if (imageUrl.startsWith('storage/')) return `/${imageUrl}`;
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
    const displayName = buildTeacherDisplayName(teacher.front_title, teacher.full_name, teacher.back_title);
    return {
      id: teacher.id,
      sort_order: teacher.sort_order,
      name: displayName,
      category: teacher.category_title || 'Tidak Ada Kategori',
      job_title: teacher.job_title || null,
      email: teacher.email || '-',
      education: teacher.education || '-',
      avatar: buildAvatarUrl(teacher.image_url, displayName),
    };
  });
  originalOrder.value = allTeachers.value.map(t => t.id);
  orderChanged.value = false;
};

// ============================================================
// DELETE
// ============================================================
const showDeleteModal = ref(false);
const teacherToDeleteId = ref(null);
const isDeleting = ref(false);
const isBulkDelete = ref(false);

const openBulkDeleteModal = () => {
  if (selectedTeachers.value.length === 0) return;
  isBulkDelete.value = true;
  showDeleteModal.value = true;
};

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
      await Promise.all(
        selectedTeachers.value.map(id =>
          axios.delete(`/api/teachers/${id}`, { headers: { Authorization: `Bearer ${token}` } })
        )
      );
      selectedTeachers.value = [];
      if (paginatedTeachers.value.length === 0 && currentPage.value > 1) currentPage.value--;
    } else {
      if (!teacherToDeleteId.value) return;
      await axios.delete(`/api/teachers/${teacherToDeleteId.value}`, {
        headers: { Authorization: `Bearer ${token}` },
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

// ============================================================
// ON MOUNTED
// ============================================================
onMounted(async () => {
  const token = getCookie(TOKEN_COOKIE_NAME);
  if (!token) { window.location.href = '/unauthenticated'; return; }
  try {
    await axios.post('/api/auth/validate-token', {}, { headers: { Authorization: `Bearer ${token}` } });
    isAuthenticated.value = true;
    await fetchTeachers(token);
  } catch (error) {
    if (error.response?.status === 401) {
      deleteCookie(TOKEN_COOKIE_NAME);
      window.location.href = '/unauthenticated';
    } else {
      isAuthenticated.value = true;
    }
  }
});
</script>
