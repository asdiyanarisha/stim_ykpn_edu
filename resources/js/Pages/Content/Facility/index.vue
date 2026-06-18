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
        <div v-if="!isAuthenticated || isLoading" class="absolute inset-0 z-[60] bg-slate-50/80 backdrop-blur-sm flex items-center justify-center">
            <div class="flex flex-col items-center">
                <div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin mb-4"></div>
                <p class="text-slate-500 font-medium animate-pulse">Memuat Data Fasilitas...</p>
            </div>
        </div>
      </transition>

      <main v-if="isAuthenticated" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8">
          <h1 class="text-2xl font-bold text-slate-900">Manajemen Fasilitas</h1>
          <p class="text-slate-500">Kelola daftar fasilitas kampus pendukung pendidikan STIM YKPN.</p>
        </div>

        <!-- Toolbar Section -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <!-- Search Bar (Disabled in reorder mode) -->
          <div class="w-full sm:max-w-md" :class="{ 'opacity-40 pointer-events-none': isReorderMode }">
            <AppInput v-model="searchQuery" placeholder="Cari nama fasilitas..." id="search-facility">
              <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
              </template>
            </AppInput>
          </div>
          
          <div class="flex flex-wrap items-center gap-3">
            <!-- Reorder Mode Buttons -->
            <template v-if="isReorderMode">
              <button
                @click="cancelReorder"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl transition-all shadow-sm cursor-pointer"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                Batal
              </button>
              <button
                @click="saveReorder"
                :disabled="isSavingReorder"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 disabled:opacity-60 disabled:cursor-not-allowed rounded-xl transition-all shadow-sm shadow-emerald-200 active:scale-95 cursor-pointer"
              >
                <svg v-if="isSavingReorder" class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ isSavingReorder ? 'Menyimpan...' : 'Simpan Urutan' }}
              </button>
            </template>

            <!-- Normal Mode Buttons -->
            <template v-else>
              <transition 
                enter-active-class="transition duration-200 ease-out" 
                enter-from-class="transform opacity-0 translate-x-4" 
                enter-to-class="transform opacity-100 translate-x-0" 
                leave-active-class="transition duration-100 ease-in" 
                leave-from-class="transform opacity-100 translate-x-0" 
                leave-to-class="transform opacity-0 translate-x-4"
              >
                <AppButton v-if="selectedItems.length > 0" variant="danger" size="md" @click="openBulkDeleteModal" class="whitespace-nowrap z-10">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                  Hapus ({{ selectedItems.length }})
                </AppButton>
              </transition>

              <button
                v-if="facilities.length > 1"
                @click="enterReorderMode"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 rounded-xl transition-all shadow-sm cursor-pointer"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M8 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm8-12a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                </svg>
                Atur Urutan
              </button>

              <a href="/content/profil/facility/create">
                <AppButton variant="primary" size="md">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                  Tambah Fasilitas
                </AppButton>
              </a>
            </template>
          </div>
        </div>

        <!-- ===== MODE DRAG & DROP REORDER ===== -->
        <div v-show="isReorderMode">
          <div class="mb-4 flex items-center gap-3 px-4 py-3 bg-indigo-50 border border-indigo-200 rounded-xl text-sm text-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>Seret baris menggunakan ikon <strong>⠿</strong> di sisi kiri untuk mengubah urutan. Klik <strong>Simpan Urutan</strong> saat selesai.</span>
          </div>

          <div
            ref="sortableContainer"
            class="bg-white rounded-2xl border border-slate-100 shadow-sm divide-y divide-slate-100 overflow-hidden"
          >
            <div
              v-for="(facility, index) in reorderList"
              :key="facility.id"
              class="sortable-item flex items-center gap-4 px-4 py-3 hover:bg-slate-50 transition-colors group select-none"
            >
              <div class="drag-handle flex-shrink-0 cursor-grab active:cursor-grabbing p-2 rounded-lg text-slate-400 hover:text-indigo-500 hover:bg-indigo-50 transition-colors" title="Seret untuk mengubah urutan">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M8 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm8-12a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                </svg>
              </div>

              <div class="flex-shrink-0 w-7 h-7 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-bold">
                {{ index + 1 }}
              </div>

              <div class="flex-shrink-0 w-20 h-12 rounded-lg border border-slate-200 overflow-hidden bg-slate-100">
                <img v-if="facility.header_image" :src="facility.header_image" class="w-full h-full object-cover">
                <div v-else class="w-full h-full flex items-center justify-center text-slate-300">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
              </div>

              <div class="flex-1 min-w-0 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 flex-shrink-0">
                  <i :class="facility.icon || 'fi fi-rr-building'"></i>
                </div>
                <div class="min-w-0">
                  <p class="font-semibold text-slate-900 text-sm truncate">{{ facility.title }}</p>
                  <p v-if="facility.top_facility" class="mt-0.5"><span class="px-2 py-0.5 bg-orange-100 text-orange-800 rounded text-[10px] font-bold uppercase tracking-wider">{{ facility.top_facility }}</span></p>
                </div>
              </div>
            </div>

            <div v-if="reorderList.length === 0" class="px-6 py-8 text-center text-slate-400 text-sm">
              Tidak ada fasilitas yang dapat diurutkan.
            </div>
          </div>
        </div>

        <!-- ===== MODE NORMAL: Table ===== -->
        <div v-show="!isReorderMode">
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                  <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 w-12">
                      <input type="checkbox" @change="toggleSelectAll" :checked="selectedItems.length === paginatedItems.length && paginatedItems.length > 0" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                    </th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-12 text-center">#</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Visual</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Fasilitas</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Highlight / Badge</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  <tr v-for="(item, index) in paginatedItems" :key="item.id" class="hover:bg-slate-50 transition-colors group">
                    <td class="px-6 py-4">
                      <input type="checkbox" :value="item.id" v-model="selectedItems" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition-colors">
                    </td>
                    <td class="px-6 py-4 text-center">
                      <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-slate-100 text-slate-500 text-xs font-bold">
                        {{ (currentPage - 1) * limit + index + 1 }}
                      </span>
                    </td>
                    <td class="px-6 py-4">
                      <div class="w-20 h-12 rounded-lg border border-slate-200 overflow-hidden bg-slate-100">
                        <img v-if="item.header_image" :src="item.header_image" class="w-full h-full object-cover">
                        <div v-else class="w-full h-full flex items-center justify-center text-slate-300">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex items-center gap-3">
                          <div class="w-8 h-8 rounded-lg bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 flex-shrink-0">
                              <i :class="item.icon || 'fi fi-rr-building'"></i>
                          </div>
                          <div class="flex flex-col min-w-0">
                              <span class="font-semibold text-slate-900 text-sm group-hover:text-indigo-600 transition-colors truncate">{{ item.title }}</span>
                          </div>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <span v-if="item.top_facility" class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200 uppercase tracking-wider">
                        {{ item.top_facility }}
                      </span>
                      <span v-else class="text-xs text-slate-400 font-medium">Biasa</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                      <div class="flex items-center justify-end gap-2">
                          <a :href="`/content/profil/facility/show/${item.id}`" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                              Detail
                          </a>
                          <a :href="`/content/profil/facility/edit/${item.id}`" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                              Edit
                          </a>
                      </div>
                    </td>
                  </tr>
                  <tr v-if="paginatedItems.length === 0">
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500 text-sm">
                      <div class="flex flex-col items-center">
                          <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                          </div>
                          <p class="font-medium text-slate-600">Tidak ada data fasilitas yang ditemukan.</p>
                          <p class="text-xs text-slate-400 mt-1">Gunakan kata kunci lain atau tambahkan fasilitas baru.</p>
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
                dari <span class="font-bold text-slate-900">{{ totalItems }}</span> fasilitas
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
              <h3 class="text-xl font-bold text-slate-900 mb-2">Hapus {{ isBulkDelete ? selectedItems.length + ' Fasilitas Terpilih' : 'Fasilitas' }}?</h3>
              <p class="text-slate-500 text-sm">
                Tindakan ini tidak dapat dibatalkan. Fasilitas yang dihapus akan hilang dari sistem secara permanen.
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
const isLoading = ref(false);

const facilities = ref([]);
const selectedItems = ref([]);
const searchQuery = ref('');

const fetchFacilities = async () => {
    isLoading.value = true;
    try {
        const token = getCookie(TOKEN_COOKIE_NAME);
        const response = await axios.get('/api/facilities', {
            headers: { Authorization: `Bearer ${token}` }
        });
        if (response.data.status === 'success') {
            facilities.value = response.data.data;
        }
    } catch (error) {
        console.error('Error fetching facilities:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan Sistem',
            text: 'Gagal mengambil data fasilitas.',
            confirmButtonColor: '#4f46e5'
        });
    } finally {
        isLoading.value = false;
    }
};

const filteredItems = computed(() => {
    if (!searchQuery.value) return facilities.value;
    const q = searchQuery.value.toLowerCase();
    return facilities.value.filter(item => 
        (item.title || '').toLowerCase().includes(q) ||
        (item.content || '').toLowerCase().includes(q)
    );
});

watch(searchQuery, () => {
    currentPage.value = 1;
});

// Pagination
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
    if (e.target.checked) selectedItems.value = paginatedItems.value.map(item => item.id);
    else selectedItems.value = [];
};

// Modal & Delete Logic
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
            await axios.post('/api/facilities/bulk-delete', { ids: selectedItems.value }, {
                headers: { Authorization: `Bearer ${token}` }
            });
            selectedItems.value = [];
        } else {
            await axios.delete(`/api/facilities/${itemToDeleteId.value}`, {
                headers: { Authorization: `Bearer ${token}` }
            });
        }
        
        await fetchFacilities();
        closeDeleteModal();
        
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data fasilitas telah dihapus.',
            timer: 2000,
            showConfirmButton: false
        });
    } catch (error) {
        console.error('Error deleting facilities:', error);
        Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Gagal menghapus data fasilitas.' });
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

watch(isReorderMode, async (active) => {
  if (active) {
    await nextTick();
    initSortable();
  } else {
    destroySortable();
  }
}, { flush: 'post' });

const initSortable = () => {
  destroySortable();

  if (!sortableContainer.value) {
    console.warn('[Sortable] container ref tidak ditemukan');
    return;
  }

  sortableInstance = Sortable.create(sortableContainer.value, {
    handle: '.drag-handle',
    animation: 200,
    ghostClass: 'sortable-ghost',
    chosenClass: 'sortable-chosen',
    dragClass: 'sortable-drag',
    onEnd(evt) {
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
  reorderList.value = [...facilities.value];
  selectedItems.value = [];
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

    const orders = reorderList.value.map((facility, index) => ({
      id: facility.id,
      sort_order: index,
    }));

    await axios.post('/api/facilities/reorder', { orders }, {
      headers: { Authorization: `Bearer ${token}` }
    });

    isReorderMode.value = false;
    reorderList.value = [];

    await fetchFacilities();

    Swal.fire({
      icon: 'success',
      title: 'Urutan Tersimpan!',
      text: 'Urutan fasilitas berhasil diperbarui.',
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
        fetchFacilities();
    } catch (error) {
        deleteCookie(TOKEN_COOKIE_NAME);
        window.location.href = '/unauthenticated';
    }
});
</script>

<style scoped>
/* Drag item styling */
.sortable-ghost {
  opacity: 0.35;
  background-color: #e0e7ff !important;
}

.sortable-drag {
  opacity: 1 !important;
  background: #fff;
  box-shadow: 0 12px 32px -4px rgba(79, 70, 229, 0.3), 0 4px 8px -2px rgba(0, 0, 0, 0.1);
  border-radius: 0.75rem;
}

.sortable-chosen {
  background-color: #f5f3ff !important;
}

.sortable-item {
  user-select: none;
  -webkit-user-select: none;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}
::-webkit-scrollbar-track {
  background: transparent;
}
::-webkit-scrollbar-thumb {
  background: #e2e8f0;
  border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
  background: #cbd5e1;
}
</style>
