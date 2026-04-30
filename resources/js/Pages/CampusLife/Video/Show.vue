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
            Kembali ke Daftar Video
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
                  <p class="text-slate-500 font-medium animate-pulse">Memuat Detail Video...</p>
              </div>
          </div>
        </transition>

        <div v-if="video.id" class="max-w-4xl mx-auto space-y-8 pb-12">
          <!-- Video Header Area -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <!-- Video Player Section -->
            <div class="relative group">
                <div class="aspect-video w-full bg-black overflow-hidden">
                    <iframe 
                        v-if="getYoutubeId(video.link)"
                        :src="`https://www.youtube.com/embed/${getYoutubeId(video.link)}`" 
                        class="w-full h-full" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen
                    ></iframe>
                    <div v-else class="w-full h-full flex flex-col items-center justify-center text-slate-500 bg-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                        <p class="font-bold">Link video tidak valid atau tidak ditemukan</p>
                    </div>
                </div>
                <!-- Status Badge Overlay -->
                <div class="absolute top-6 left-6 flex gap-2">
                    <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md rounded-xl text-[11px] font-bold text-slate-900 border border-white uppercase tracking-widest shadow-sm">
                        Campus Life Video
                    </span>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-6 mb-6 text-sm text-slate-400">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        {{ formatDate(video.created_at) }}
                    </div>
                    <div v-if="video.link" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                        <a :href="video.link" target="_blank" class="text-indigo-600 hover:underline">Buka di YouTube</a>
                    </div>
                </div>

                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight mb-8">{{ video.title || 'Tanpa Judul' }}</h1>
                
                <!-- Main Content Area -->
                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed video-content" v-html="video.description || '<p class=\'text-slate-400 italic\'>Tidak ada deskripsi.</p>'"></div>
            </div>
          </div>

          <!-- Quick Actions Footer -->
          <div class="flex justify-between items-center bg-white p-6 rounded-[1.5rem] shadow-sm border border-slate-100">
            <div class="text-sm text-slate-400">
                Terakhir diperbarui: {{ formatDate(video.updated_at || video.created_at) }}
            </div>
            <div class="flex gap-3">
                <a :href="`/campus-life/video/edit/${video.id}`">
                    <AppButton variant="secondary" size="md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Ubah Video
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
const video = ref({});

const formatDate = (dateString) => {
  if (!dateString) return '-';
  const date = new Date(dateString);
  return date.toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
};

const getYoutubeId = (url) => {
    if (!url) return null;
    const match = url.match(/(?:https?:\/\/(?:www\.)?youtube\.com\/watch\?v=|https?:\/\/youtu\.be\/|https?:\/\/(?:www\.)?youtube\.com\/embed\/)([^&?]+)/);
    return match ? match[1] : null;
};

const fetchVideoDetail = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const response = await axios.get(`/api/campus-live-videos/${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      video.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching video detail:', error);
    if (error.response?.status === 404) {
       window.location.href = '/campus-life/video';
    }
  } finally {
    isLoading.value = false;
  }
};

const goBack = () => {
    window.location.href = '/campus-life/video';
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
    fetchVideoDetail();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>

<style scoped>
.video-content :deep(p) {
    margin-bottom: 1.5rem;
    line-height: 1.8;
}
.video-content :deep(h2) {
    font-size: 1.5rem;
    font-weight: 700;
    margin-top: 2.5rem;
    margin-bottom: 1rem;
    color: #1e293b;
}
.video-content :deep(a) {
    color: #4f46e5;
    text-decoration: underline;
}
</style>
