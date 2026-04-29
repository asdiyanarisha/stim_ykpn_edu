<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden font-sans">
    <!-- Sidebar -->
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Back Button -->
        <div class="max-w-4xl mx-auto mb-6">
          <button @click="goBack" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors cursor-pointer group">
            <div class="p-1.5 rounded-lg bg-white border border-slate-200 group-hover:border-indigo-100 group-hover:bg-indigo-50 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </div>
            Kembali ke Daftar Testimoni
          </button>
        </div>

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
                  <p class="text-slate-500 font-medium animate-pulse">Memuat Detail Testimoni...</p>
              </div>
          </div>
        </transition>

        <div v-if="testimony.id" class="max-w-4xl mx-auto space-y-8 pb-12">
          <!-- Detail Card -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <!-- Logo / Profile -->
            <div v-if="testimony.image" class="flex justify-center pt-10 pb-2">
                <div class="w-40 h-40 md:w-48 md:h-48 rounded-full overflow-hidden shadow-sm border border-slate-100 bg-white flex items-center justify-center p-1">
                    <img :src="testimony.image" class="w-full h-full object-cover rounded-full">
                </div>
            </div>

            <div class="p-8 md:p-12 text-center md:text-left">
                <div class="mb-10 text-center">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">{{ testimony.name || 'Tanpa Nama' }}</h1>
                </div>

                <!-- Content Section -->
                <div class="prose prose-slate max-w-none mb-10 text-center md:text-left mx-auto">
                    <div class="flex justify-center md:justify-start mb-6">
                        <svg class="w-10 h-10 text-indigo-200" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true"><path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/></svg>
                    </div>
                    <div v-if="testimony.testimony" v-html="testimony.testimony" class="text-slate-600 leading-relaxed quill-content md:px-8 text-lg italic"></div>
                    <div v-else class="text-slate-400 italic">Tidak ada deskripsi testimoni.</div>
                </div>

                <!-- Additional Info Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8 pt-8 border-t border-slate-100">
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-left">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-1">Tanggal Entry</p>
                        <p class="font-bold text-slate-700">{{ formatFullDate(testimony.created_at) }}</p>
                    </div>
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-left">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-slate-400 mb-1">Terakhir Diperbarui</p>
                        <p class="font-bold text-slate-700">{{ formatFullDate(testimony.updated_at) }}</p>
                    </div>
                </div>
            </div>
          </div>

          <!-- Actions Footer -->
          <div class="flex justify-between items-center bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
            <div class="text-sm text-slate-400 italic">
                Informasi detail testimoni.
            </div>
            <div class="flex gap-3">
                <a :href="`/student/testimony/edit/${testimony.id}`">
                    <AppButton variant="secondary" size="md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Ubah Testimoni
                    </AppButton>
                </a>
                <AppButton variant="primary" size="md" @click="goBack">
                    Selesai
                </AppButton>
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
import AppSidebar from '../../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../../Components/Atoms/AppButton.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isLoading = ref(false);
const testimony = ref({});

const formatFullDate = (dateString) => {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const fetchItemDetail = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const response = await axios.get(`/api/testimony-alumnis/${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      testimony.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching testimony detail:', error);
    if (error.response?.status === 404) {
       window.location.href = '/student/testimony';
    }
  } finally {
    isLoading.value = false;
  }
};

const goBack = () => {
    window.location.href = '/student/testimony';
};

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
    fetchItemDetail();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>

<style scoped>
.quill-content :deep(p) {
    margin-bottom: 1rem;
}
.quill-content :deep(img) {
    max-width: 100%;
    border-radius: 1rem;
    margin: 1rem 0;
}
</style>
