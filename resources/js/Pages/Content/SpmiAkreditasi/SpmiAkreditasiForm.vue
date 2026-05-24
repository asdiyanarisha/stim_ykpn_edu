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
              <span class="hover:text-indigo-600 transition-colors">Manajemen Profil</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">SPMI & Akreditasi</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">SPMI & Akreditasi STIM YKPN</h1>
            <p class="text-slate-500">Kelola informasi penjaminan mutu internal dan status akreditasi institusi.</p>
          </div>
        </div>

        <div class="max-w-4xl mx-auto">
          <form @submit.prevent="handleSubmit" class="space-y-6">
            
            <!-- Dasar Hukum Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </span>
                Dasar Hukum
              </h2>

              <div class="space-y-1">
                <div class="quill-editor-wrapper" :class="{ 'quill-error': errors.dasar_hukum }">
                  <QuillEditor 
                    v-model:content="form.dasar_hukum" 
                    contentType="html"
                    :options="editorOptions"
                    placeholder="Tulis dasar hukum di sini..."
                    style="min-height: 250px;"
                  />
                </div>
                <p v-if="errors.dasar_hukum" class="text-xs text-rose-500 mt-1 font-medium ml-1">{{ errors.dasar_hukum }}</p>
              </div>
            </div>

            <!-- Dokumen SPMI Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </span>
                Dokumen SPMI
              </h2>

              <div class="space-y-1">
                <div class="quill-editor-wrapper" :class="{ 'quill-error': errors.dokumen_spmi }">
                  <QuillEditor 
                    v-model:content="form.dokumen_spmi" 
                    contentType="html"
                    :options="editorOptions"
                    placeholder="Tulis informasi dokumen SPMI di sini..."
                    style="min-height: 250px;"
                  />
                </div>
                <p v-if="errors.dokumen_spmi" class="text-xs text-rose-500 mt-1 font-medium ml-1">{{ errors.dokumen_spmi }}</p>
              </div>
            </div>

            <!-- Dokumen Akreditasi Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                </span>
                Dokumen Akreditasi
              </h2>

              <div class="space-y-1">
                <div class="quill-editor-wrapper" :class="{ 'quill-error': errors.dokumen_akreditasi }">
                  <QuillEditor 
                    v-model:content="form.dokumen_akreditasi" 
                    contentType="html"
                    :options="editorOptions"
                    placeholder="Tulis informasi dokumen akreditasi di sini..."
                    style="min-height: 250px;"
                  />
                </div>
                <p v-if="errors.dokumen_akreditasi" class="text-xs text-rose-500 mt-1 font-medium ml-1">{{ errors.dokumen_akreditasi }}</p>
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
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isSubmitting = ref(false);
const isLoading = ref(false);
const errors = reactive({});

const form = reactive({
  dasar_hukum: '',
  dokumen_spmi: '',
  dokumen_akreditasi: '',
});

const editorOptions = {
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

const fetchData = async () => {
    isLoading.value = true;
    try {
        const token = getCookie(TOKEN_COOKIE_NAME);
        const response = await axios.get('/api/spmi-akreditasi', {
            headers: { Authorization: `Bearer ${token}` }
        });
        
        if (response.data.status === 'success' && response.data.data) {
            const data = response.data.data;
            form.dasar_hukum = data.dasar_hukum || '';
            form.dokumen_spmi = data.dokumen_spmi || '';
            form.dokumen_akreditasi = data.dokumen_akreditasi || '';
        }
    } catch (error) {
        console.error('Error fetching data:', error);
        Swal.fire({ icon: 'error', title: 'Kesalahan', text: 'Gagal memuat data SPMI & Akreditasi.' });
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
    
    const response = await axios.post('/api/spmi-akreditasi', form, {
      headers: {
        Authorization: `Bearer ${token}`,
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
  min-height: 250px;
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
