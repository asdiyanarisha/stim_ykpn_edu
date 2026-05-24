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
                <p class="text-slate-500 font-medium animate-pulse">{{ isEditMode ? 'Menyiapkan Formulir...' : 'Memuat halaman...' }}</p>
            </div>
        </div>
      </transition>

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="max-w-4xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
              <a href="/campus-life/video" class="hover:text-indigo-600 transition-colors">Manajemen Video</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">{{ isEditMode ? 'Ubah Video' : 'Tambah Video' }}</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">{{ isEditMode ? 'Ubah Informasi Video' : 'Formulir Video Baru' }}</h1>
            <p class="text-slate-500">{{ isEditMode ? 'Perbarui konten video Anda untuk memberikan informasi terkini.' : 'Tambahkan video terbaru untuk Campus Life STIM YKPN.' }}</p>
          </div>
          <div class="flex items-center gap-3">
            <AppButton variant="secondary" size="md" @click="goBack">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
              Kembali
            </AppButton>
          </div>
        </div>

        <div class="max-w-4xl mx-auto">
          <form @submit.prevent="handleSubmit" class="space-y-6">
            <!-- Video Preview Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                </span>
                Pratinjau Video
              </h2>

              <div class="flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-3xl p-8 bg-slate-50/50 min-h-[300px]">
                <template v-if="!getYoutubeId(form.link)">
                  <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                  </div>
                  <p class="text-slate-600 font-bold">Belum Ada Link Video</p>
                  <p class="text-slate-400 text-sm mt-1 text-center">Masukkan link YouTube yang valid pada field di bawah untuk melihat pratinjau.</p>
                </template>

                <div v-else class="w-full aspect-video rounded-2xl overflow-hidden shadow-lg border border-slate-200">
                  <iframe 
                    :src="`https://www.youtube.com/embed/${getYoutubeId(form.link)}`" 
                    class="w-full h-full" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen
                  ></iframe>
                </div>
              </div>
            </div>

            <!-- Content Details Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </span>
                Informasi Video
              </h2>

              <div class="space-y-6">
                <AppInput v-model="form.title" label="Judul Video" placeholder="Masukkan judul video..." id="video-title" :error="errors.title" />

                <AppInput v-model="form.link" label="Link Video (YouTube)" placeholder="Contoh: https://www.youtube.com/watch?v=... atau https://youtu.be/..." id="video-link" :error="errors.link" />

                <!-- WYSIWYG Editor for Description -->
                <div class="space-y-1">
                  <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Deskripsi</label>
                  <div class="quill-editor-wrapper" :class="{ 'quill-error': errors.description }">
                    <QuillEditor 
                      v-model:content="form.description" 
                      contentType="html"
                      :options="editorOptions"
                      style="min-height: 200px;"
                    />
                  </div>
                  <p v-if="errors.description" class="text-xs text-rose-500 mt-1 font-medium ml-1">{{ errors.description }}</p>
                </div>
              </div>
            </div>

            <!-- Bottom Actions -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-end gap-4">
              <AppButton variant="secondary" size="md" @click="goBack">Batal</AppButton>
              <AppButton variant="primary" size="md" type="submit" :disabled="isSubmitting">
                <svg v-if="isSubmitting" class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <svg v-if="!isSubmitting" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ isSubmitting ? (isEditMode ? 'Menyimpan...' : 'Menambahkan...') : (isEditMode ? 'Simpan Perubahan' : 'Simpan Video') }}
              </AppButton>
            </div>
          </form>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, computed } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import AppSidebar from '../../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../../Components/Atoms/AppButton.vue';
import AppInput from '../../../Components/Atoms/AppInput.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isSubmitting = ref(false);
const isLoading = ref(false);
const errors = reactive({});

const isEditMode = computed(() => window.location.pathname.includes('/edit/'));
const videoId = ref(null);

const form = reactive({
  title: '',
  description: '',
  link: ''
});

const editorOptions = {
  placeholder: 'Tulis deskripsi video di sini...',
  theme: 'snow',
  modules: {
    toolbar: [
      [{ header: [1, 2, 3, false] }],
      ['bold', 'italic', 'underline'],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['link'],
      ['clean']
    ]
  }
};

const getYoutubeId = (url) => {
    if (!url) return null;
    const match = url.match(/(?:https?:\/\/(?:www\.)?youtube\.com\/watch\?v=|https?:\/\/youtu\.be\/|https?:\/\/(?:www\.)?youtube\.com\/embed\/)([^&?]+)/);
    return match ? match[1] : null;
};

const goBack = () => {
  window.location.href = '/campus-life/video';
};

const fetchVideoData = async () => {
    isLoading.value = true;
    try {
        const parts = window.location.pathname.split('/');
        videoId.value = parts[parts.length - 1];
        const token = getCookie(TOKEN_COOKIE_NAME);
        
        const response = await axios.get(`/api/campus-live-videos/${videoId.value}`, {
            headers: { Authorization: `Bearer ${token}` }
        });
        
        if (response.data.status === 'success') {
            const data = response.data.data;
            form.title = data.title || '';
            form.description = data.description || '';
            form.link = data.link || '';
        }
    } catch (error) {
        console.error('Error fetching video data:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Gagal mengambil data video.',
        }).then(() => {
            goBack();
        });
    } finally {
        isLoading.value = false;
    }
};

const handleSubmit = async () => {
  // Clear errors
  Object.keys(errors).forEach(key => errors[key] = '');

  // Validation
  let hasError = false;
  // Based on user request fields are not strictly required, but for UX we might want title/link if they are adding something
  // User said "not required" for all, so I'll let it be.
  
  if (hasError) return;

  isSubmitting.value = true;

  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const payload = {
        title: form.title,
        description: form.description,
        link: form.link
    };

    const endpoint = isEditMode.value ? `/api/campus-live-videos/${videoId.value}` : '/api/campus-live-videos';
    
    // For updates, we can use POST if the backend supports it (like in NewsController) or PUT/PATCH.
    // I defined the route as POST for update to handle multipart/form-data pattern if needed, but here it's just JSON.
    // I'll use POST for consistency with the project's other update routes.
    const response = await axios.post(endpoint, payload, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });

    if (response.data.status === 'success') {
      await Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: isEditMode.value ? 'Video berhasil diperbarui.' : 'Video baru berhasil ditambahkan.',
        confirmButtonText: 'Kembali ke Daftar',
        confirmButtonColor: '#4f46e5'
      });
      window.location.href = '/campus-life/video';
    }
  } catch (error) {
    console.error('Error submitting video:', error);
    const message = error.response?.data?.message || 'Terjadi kesalahan saat menyimpan video.';
    await Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: message,
    });
  } finally {
    isSubmitting.value = false;
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
      headers: { Authorization: `Bearer ${token}` }
    });
    isAuthenticated.value = true;
    
    if (isEditMode.value) {
        fetchVideoData();
    }
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>

<style scoped>
/* Quill Editor Custom Styling */
.quill-editor-wrapper :deep(.ql-toolbar) {
  border: 1px solid #e2e8f0;
  border-top-left-radius: 1rem;
  border-top-right-radius: 1rem;
  background-color: #f8fafc;
  padding: 10px 12px;
}

.quill-editor-wrapper :deep(.ql-container) {
  border: 1px solid #e2e8f0;
  border-top: none;
  border-bottom-left-radius: 1rem;
  border-bottom-right-radius: 1rem;
  font-size: 0.938rem;
  font-family: 'Inter', sans-serif;
  color: #334155;
}

.quill-editor-wrapper :deep(.ql-editor) {
  min-height: 200px;
  padding: 16px 20px;
  line-height: 1.7;
}

.quill-editor-wrapper :deep(.ql-editor.ql-blank::before) {
  color: #94a3b8;
  font-style: normal;
}

.quill-editor-wrapper :deep(.ql-editor:focus) {
  outline: none;
}

.quill-editor-wrapper:focus-within :deep(.ql-toolbar) {
  border-color: #6366f1;
}

.quill-editor-wrapper:focus-within :deep(.ql-container) {
  border-color: #6366f1;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

/* Error state */
.quill-error :deep(.ql-toolbar) {
  border-color: #f43f5e;
}

.quill-error :deep(.ql-container) {
  border-color: #f43f5e;
  background-color: #fff1f2;
}
</style>
