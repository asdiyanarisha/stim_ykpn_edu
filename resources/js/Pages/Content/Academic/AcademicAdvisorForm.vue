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
                <p class="text-slate-500 font-medium animate-pulse">Memuat Informasi...</p>
            </div>
        </div>
      </transition>

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="max-w-4xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
              <span class="hover:text-indigo-600 transition-colors">Akademik</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">Dosen Pembimbing</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Dosen Pembimbing</h1>
            <p class="text-slate-500">Kelola informasi mengenai Dosen Pembimbing di STIM YKPN.</p>
          </div>
        </div>

        <div class="max-w-4xl mx-auto">
          <form @submit.prevent="handleSubmit" class="space-y-6">
            <!-- Image Upload Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </span>
                Gambar Header
              </h2>

              <div class="flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-3xl p-12 hover:border-indigo-400 hover:bg-indigo-50/30 transition-all group relative overflow-hidden cursor-pointer" @click="$refs.fileInput.click()">
                <input type="file" ref="fileInput" class="hidden" accept="image/*" @change="handleImageUpload">
                
                <template v-if="!imagePreview">
                  <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                  </div>
                  <p class="text-slate-600 font-bold">Pilih atau Seret Header ke Sini</p>
                  <p class="text-slate-400 text-sm mt-1">Saran: Gambar terkait Dosen Pembimbing (Maks. 5MB)</p>
                </template>

                <div v-if="imagePreview" class="w-full aspect-[21/9] mx-auto rounded-2xl overflow-hidden shadow-lg border border-slate-200 relative">
                  <img :src="imagePreview" class="w-full h-full object-cover">
                  <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                    <span class="px-5 py-2 bg-white text-slate-900 font-bold rounded-xl text-sm shadow-xl">Ganti Header</span>
                  </div>
                </div>
              </div>
              <p v-if="errors.image" class="text-xs text-rose-500 mt-2 font-medium">{{ errors.image }}</p>
            </div>

            <!-- Content Details Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </span>
                Detail Dosen Pembimbing
              </h2>

              <div class="space-y-6">
                <AppInput v-model="form.title" label="Judul" placeholder="Misal: Tentang Dosen Pembimbing" id="academic-advisor-title" :error="errors.title" />

                <!-- Quill Editor for Content -->
                <div class="space-y-1">
                  <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Konten Utama</label>
                  <div class="quill-editor-wrapper" :class="{ 'quill-error': errors.content }">
                    <QuillEditor 
                      v-model:content="form.content" 
                      contentType="html"
                      :options="editorOptions"
                      style="min-height: 400px;"
                    />
                  </div>
                  <p v-if="errors.content" class="text-xs text-rose-500 mt-1 font-medium ml-1">{{ errors.content }}</p>
                </div>

              </div>
            </div>

            <!-- Bottom Actions -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-end gap-4">
              <AppButton variant="primary" size="md" type="submit" :disabled="isSubmitting">
                <svg v-if="isSubmitting" class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <svg v-if="!isSubmitting" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ isSubmitting ? 'Menyimpan...' : 'Simpan Perubahan' }}
              </AppButton>
            </div>
          </form>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
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

const form = reactive({
  title: '',
  content: '',
  image: null,
});

const editorOptions = {
  placeholder: 'Tuliskan rincian Dosen Pembimbing di sini...',
  theme: 'snow',
  modules: {
    toolbar: [
      [{ header: [1, 2, 3, 4, false] }],
      ['bold', 'italic', 'underline', 'strike'],
      [{ color: [] }, { background: [] }],
      [{ list: 'ordered' }, { list: 'bullet' }],
      [{ align: [] }],
      ['blockquote', 'code-block'],
      ['link', 'image'],
      ['clean']
    ]
  }
};

const imagePreview = ref(null);

const handleImageUpload = (e) => {
  const file = e.target.files[0];
  if (file) {
    if (file.size > 5 * 1024 * 1024) {
      Swal.fire({ icon: 'warning', title: 'File Terlalu Besar', text: 'Ukuran file maksimal 5MB.', confirmButtonColor: '#4f46e5' });
      return;
    }
    form.image = file;
    const reader = new FileReader();
    reader.onload = (event) => {
      imagePreview.value = event.target.result;
    };
    reader.readAsDataURL(file);
    errors.image = '';
  }
};

const fetchData = async () => {
    isLoading.value = true;
    try {
        const token = getCookie(TOKEN_COOKIE_NAME);
        const response = await axios.get('/api/academic-advisor', {
            headers: { Authorization: `Bearer ${token}` }
        });
        
        if (response.data.status === 'success' && response.data.data) {
            const data = response.data.data;
            form.title = data.title || '';
            form.content = data.content || '';
            imagePreview.value = data.header_image;
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    } finally {
        isLoading.value = false;
    }
};

const handleSubmit = async () => {
  // Clear errors
  Object.keys(errors).forEach(key => errors[key] = '');

  isSubmitting.value = true;

  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const formData = new FormData();
    formData.append('title', form.title);
    formData.append('content', form.content);
    
    if (form.image instanceof File) {
      formData.append('image', form.image);
    }

    const response = await axios.post('/api/academic-advisor', formData, {
      headers: {
        Authorization: `Bearer ${token}`,
        'Content-Type': 'multipart/form-data'
      }
    });

    if (response.data.status === 'success') {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: response.data.message,
        confirmButtonColor: '#4f46e5'
      });
      fetchData();
    }
  } catch (error) {
    console.error('Error submitting:', error);
    const message = error.response?.data?.message || 'Terjadi kesalahan saat menyimpan.';
    Swal.fire({ icon: 'error', title: 'Oops...', text: message });
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
    fetchData();
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
  border-top-left-radius: 1.5rem;
  border-top-right-radius: 1.5rem;
  background-color: #f8fafc;
  padding: 12px 16px;
}

.quill-editor-wrapper :deep(.ql-container) {
  border: 1px solid #e2e8f0;
  border-top: none;
  border-bottom-left-radius: 1.5rem;
  border-bottom-right-radius: 1.5rem;
  font-size: 0.938rem;
  font-family: 'Inter', sans-serif;
  color: #334155;
  background-color: white;
}

.quill-editor-wrapper :deep(.ql-editor) {
  min-height: 400px;
  padding: 20px 24px;
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

.quill-error:focus-within :deep(.ql-toolbar) {
  border-color: #f43f5e;
}

.quill-error:focus-within :deep(.ql-container) {
  border-color: #f43f5e;
  box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.1);
}
</style>
