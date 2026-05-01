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
              <a href="/brochure" class="hover:text-indigo-600 transition-colors">Manajemen Brosur</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">{{ isEditMode ? 'Ubah Brosur' : 'Tambah Brosur' }}</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">{{ isEditMode ? 'Ubah Informasi Brosur' : 'Formulir Brosur Baru' }}</h1>
            <p class="text-slate-500">{{ isEditMode ? 'Perbarui informasi brosur yang sudah ada.' : 'Unggah dan beri informasi brosur baru untuk STIM YKPN.' }}</p>
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
            <!-- File Upload Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                </span>
                File Brosur
              </h2>

              <div class="flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-3xl p-12 hover:border-indigo-400 hover:bg-indigo-50/30 transition-all group relative overflow-hidden cursor-pointer" @click="$refs.fileInput.click()">
                <input type="file" ref="fileInput" class="hidden" accept=".pdf,.doc,.docx,.ppt,.pptx,image/*" @change="handleFileUpload">
                
                <template v-if="!fileSelectedName">
                  <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                  </div>
                  <p class="text-slate-600 font-bold">Pilih atau Seret File ke Sini</p>
                  <p class="text-slate-400 text-sm mt-1">Format: PDF, DOC, PPT, Gambar (Maks. 10MB)</p>
                </template>

                <div v-else class="w-full p-6 bg-slate-50 rounded-2xl border border-slate-200 flex items-center gap-4">
                  <div class="w-12 h-12 bg-indigo-600 text-white rounded-xl flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-900 truncate">{{ fileSelectedName }}</p>
                    <p class="text-xs text-slate-500">{{ fileSelectedSize }}</p>
                  </div>
                  <div class="px-4 py-2 bg-white text-slate-900 font-bold rounded-xl text-sm shadow-sm border border-slate-100 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    Ganti File
                  </div>
                </div>
              </div>
              <p v-if="errors.file" class="text-xs text-rose-500 mt-2 font-medium">{{ errors.file }}</p>
              
              <!-- Existing File Info -->
              <div v-if="isEditMode && form.file_path && !fileSelectedName" class="mt-4 p-4 bg-emerald-50 rounded-2xl border border-emerald-100 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                <span class="text-sm text-emerald-700 font-medium">File saat ini: <a :href="form.file_path" target="_blank" class="underline hover:text-emerald-900 transition-colors">Lihat Dokumen</a> ({{ form.file_size }})</span>
              </div>
            </div>

            <!-- Content Details Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </span>
                Informasi Brosur
              </h2>

              <div class="space-y-6">
                <AppInput v-model="form.title" label="Judul Brosur" placeholder="Masukkan judul brosur..." id="brochure-title" :error="errors.title" />

                <div class="space-y-1">
                    <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Deskripsi Brosur</label>
                    <textarea 
                        v-model="form.description" 
                        rows="4" 
                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all text-sm font-medium placeholder:text-slate-400"
                        placeholder="Berikan deskripsi singkat mengenai brosur ini..."
                    ></textarea>
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
                {{ isSubmitting ? (isEditMode ? 'Menyimpan...' : 'Menambahkan...') : (isEditMode ? 'Simpan Perubahan' : 'Simpan Brosur') }}
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
import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../Components/Atoms/AppButton.vue';
import AppInput from '../../Components/Atoms/AppInput.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isSubmitting = ref(false);
const isLoading = ref(false);
const errors = reactive({});

const isEditMode = computed(() => window.location.pathname.includes('/edit/'));
const brochureId = ref(null);

const form = reactive({
  title: '',
  description: '',
  file: null,
  file_path: null,
  file_size: null
});

const fileSelectedName = ref('');
const fileSelectedSize = ref('');

const formatBytes = (bytes, precision = 2) => {
  if (bytes === 0) return '0 B';
  const units = ['B', 'KB', 'MB', 'GB', 'TB'];
  const pow = Math.floor(Math.log(bytes) / Math.log(1024));
  return (bytes / Math.pow(1024, pow)).toFixed(precision) + ' ' + units[pow];
};

const handleFileUpload = (e) => {
  const file = e.target.files[0];
  if (file) {
    if (file.size > 10 * 1024 * 1024) {
      Swal.fire({ icon: 'warning', title: 'File Terlalu Besar', text: 'Ukuran file maksimal 10MB.', confirmButtonColor: '#4f46e5' });
      return;
    }
    form.file = file;
    fileSelectedName.value = file.name;
    fileSelectedSize.value = formatBytes(file.size);
    errors.file = '';
  }
};

const goBack = () => {
  window.location.href = '/brochure';
};

const fetchBrochureData = async () => {
    isLoading.value = true;
    try {
        const parts = window.location.pathname.split('/');
        brochureId.value = parts[parts.length - 1];
        const token = getCookie(TOKEN_COOKIE_NAME);
        
        const response = await axios.get(`/api/brochures/${brochureId.value}`, {
            headers: { Authorization: `Bearer ${token}` }
        });
        
        if (response.data.status === 'success') {
            const data = response.data.data;
            form.title = data.title;
            form.description = data.description;
            form.file_path = data.file_path;
            form.file_size = data.file_size;
        }
    } catch (error) {
        console.error('Error fetching brochure data:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Gagal mengambil data brosur.',
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
  // User says title is not required in migration but let's keep it optional here too.
  // if (!form.title) { errors.title = 'Judul brosur wajib diisi'; hasError = true; }
  if (!isEditMode.value && !form.file) { errors.file = 'File brosur wajib diunggah'; hasError = true; }

  if (hasError) return;

  isSubmitting.value = true;

  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const formData = new FormData();
    formData.append('title', form.title || '');
    formData.append('description', form.description || '');
    
    if (form.file) {
      formData.append('file', form.file);
    }

    const endpoint = isEditMode.value ? `/api/brochures/${brochureId.value}` : '/api/brochures';
    
    const response = await axios.post(endpoint, formData, {
      headers: {
        Authorization: `Bearer ${token}`,
        'Content-Type': 'multipart/form-data'
      }
    });

    if (response.data.status === 'success') {
      await Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: isEditMode.value ? 'Brosur berhasil diperbarui.' : 'Brosur baru berhasil ditambahkan.',
        confirmButtonText: 'Kembali ke Daftar',
        confirmButtonColor: '#4f46e5'
      });
      window.location.href = '/brochure';
    }
  } catch (error) {
    console.error('Error submitting brochure:', error);
    const message = error.response?.data?.message || 'Terjadi kesalahan saat menyimpan brosur.';
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
        fetchBrochureData();
    }
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
