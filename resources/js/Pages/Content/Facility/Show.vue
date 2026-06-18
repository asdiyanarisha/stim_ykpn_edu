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
                <p class="text-slate-500 font-medium animate-pulse">Memuat Detail...</p>
            </div>
        </div>
      </transition>

      <main v-if="facility" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="max-w-4xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-3">
              <a href="/content/profil/facility" class="hover:text-indigo-700 transition-colors">Daftar Fasilitas</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium truncate">{{ facility.title }}</span>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ facility.title }}</h1>
            <div class="flex items-center gap-2 mt-2">
              <span v-if="facility.top_facility" class="px-2.5 py-1 bg-amber-50 text-amber-800 border border-amber-200 rounded-lg text-xs font-bold uppercase tracking-wider">
                {{ facility.top_facility }}
              </span>
              <span class="text-xs text-slate-400">
                Terakhir diperbarui {{ new Date(facility.updated_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) }}
              </span>
            </div>
          </div>
          
          <div class="flex items-center gap-3 self-start sm:self-center">
             <a :href="`/content/profil/facility/edit/${facility.id}`">
               <AppButton variant="secondary" size="md">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                 Edit Fasilitas
               </AppButton>
             </a>
             <a href="/content/profil/facility">
               <AppButton variant="secondary" size="md">
                 Kembali
               </AppButton>
             </a>
          </div>
        </div>

        <div class="max-w-4xl mx-auto space-y-8">
          <!-- Banner Image -->
          <div v-if="facility.header_image" class="relative group">
              <div class="w-full aspect-[21/9] rounded-3xl overflow-hidden shadow-md border border-slate-100 bg-slate-100">
                  <img :src="facility.header_image" :alt="facility.title" class="w-full h-full object-cover">
              </div>
          </div>

          <!-- Main Text Content -->
          <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100">
              <div class="prose prose-indigo max-w-none prose-lg prose-slate prose-headings:font-extrabold prose-headings:tracking-tight prose-p:leading-relaxed prose-img:rounded-3xl" v-html="facility.content"></div>
          </div>

          <!-- Metadata Section -->
          <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 grid grid-cols-2 md:grid-cols-5 gap-6">
              <div>
                  <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Status</span>
                  <span v-if="facility.top_facility" class="text-amber-600 font-bold text-sm">Unggulan ({{ facility.top_facility }})</span>
                  <span v-else class="text-slate-600 font-medium text-sm">Fasilitas Biasa</span>
              </div>
              <div>
                  <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Class Icon</span>
                  <p class="text-slate-900 text-sm flex items-center gap-1.5 mt-1">
                      <i v-if="facility.icon" :class="facility.icon" class="text-indigo-600 text-base"></i>
                      <span class="font-semibold">{{ facility.icon || 'Default (fi fi-rr-building)' }}</span>
                  </p>
              </div>
              <div>
                  <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Urutan Tampil</span>
                  <p class="text-slate-900 font-bold text-lg">Ke-{{ facility.sort_order }}</p>
              </div>
              <div>
                  <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Dibuat Pada</span>
                  <p class="text-slate-700 font-medium text-sm">{{ new Date(facility.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) }}</p>
              </div>
              <div>
                  <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">ID Fasilitas</span>
                  <p class="text-slate-900 font-mono font-bold text-sm">FAC-{{ facility.id.toString().padStart(4, '0') }}</p>
              </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import AppSidebar from '../../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../../Components/Atoms/AppButton.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isLoading = ref(false);
const facility = ref(null);

const fetchFacility = async (id) => {
    isLoading.value = true;
    try {
        const token = getCookie(TOKEN_COOKIE_NAME);
        const response = await axios.get(`/api/facilities/${id}`, {
            headers: { Authorization: `Bearer ${token}` }
        });
        if (response.data.status === 'success') {
            facility.value = response.data.data;
        }
    } catch (error) {
        console.error('Error fetching facility:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan Sistem',
            text: 'Gagal mengambil rincian data fasilitas.',
            confirmButtonColor: '#4f46e5'
        });
        setTimeout(() => {
            window.location.href = '/content/profil/facility';
        }, 1500);
    } finally {
        isLoading.value = false;
    }
};

onMounted(async () => {
    const token = getCookie(TOKEN_COOKIE_NAME);
    if (!token) {
        window.location.href = '/unauthenticated';
        return;
    }
    
    // Parse ID from URL path (e.g. /content/profil/facility/show/12)
    const pathParts = window.location.pathname.split('/');
    const id = pathParts[pathParts.length - 1];

    try {
        await axios.post('/api/auth/validate-token', {}, {
            headers: { Authorization: `Bearer ${token}` },
        });
        isAuthenticated.value = true;
        if (id) {
            fetchFacility(id);
        }
    } catch (error) {
        deleteCookie(TOKEN_COOKIE_NAME);
        window.location.href = '/unauthenticated';
    }
});
</script>

<style scoped>
/* Custom styled prose styles to render user descriptions cleanly */
.prose :deep(p) {
  margin-top: 1.25em;
  margin-bottom: 1.25em;
}
.prose :deep(strong) {
  color: #0f172a;
  font-weight: 700;
}
.prose :deep(ul) {
  list-style-type: disc;
  padding-left: 1.625em;
  margin-top: 1.25em;
  margin-bottom: 1.25em;
}
</style>
