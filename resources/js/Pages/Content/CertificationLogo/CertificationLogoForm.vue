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
              <a href="/content/logo-sertifikasi" class="hover:text-indigo-600 transition-colors">Manajemen Logo Sertifikasi</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">{{ isEditMode ? 'Ubah Logo' : 'Tambah Logo' }}</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">{{ isEditMode ? 'Ubah Informasi Logo' : 'Formulir Logo Baru' }}</h1>
            <p class="text-slate-500">{{ isEditMode ? 'Perbarui detail logo pekerjaan Anda.' : 'Tulis dan publikasikan logo sertifikasi baru untuk STIM YKPN.' }}</p>
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
            <!-- Image Upload Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </span>
                Gambar Profil/Banner Logo
              </h2>

              <div class="flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-3xl p-12 hover:border-indigo-400 hover:bg-indigo-50/30 transition-all group relative overflow-hidden cursor-pointer" @click="$refs.fileInput.click()">
                <input type="file" ref="fileInput" class="hidden" accept="image/*" @change="handleImageUpload">
                
                <template v-if="!imagePreview">
                  <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                  </div>
                  <p class="text-slate-600 font-bold">Pilih atau Seret Gambar ke Sini</p>
                  <p class="text-slate-400 text-sm mt-1">Saran resolusi: 1200x630 px (Maks. 5MB)</p>
                </template>

                <div v-if="imagePreview" class="w-full aspect-[16/9] rounded-2xl overflow-hidden shadow-lg border border-slate-200 relative">
                  <img :src="imagePreview" class="w-full h-full object-cover">
                  <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                    <span class="px-5 py-2 bg-white text-slate-900 font-bold rounded-xl text-sm shadow-xl">Ganti Gambar</span>
                  </div>
                </div>
              </div>
              <p v-if="errors.url_image" class="text-xs text-rose-500 mt-2 font-medium">{{ errors.url_image }}</p>
            </div>

            <!-- Content Details Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </span>
                Informasi Logo
              </h2>

              <div class="space-y-6">
                <AppInput v-model="form.title" label="Judul Logo" placeholder="Misal: Dosen Pemasaran, Staf Akademik..." id="logo-title" :error="errors.title" />

                <!-- Textarea for Content -->
                <div class="space-y-1">
                  <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Detail Logo</label>
                  <textarea 
                    v-model="form.description" 
                    id="logo-description"
                    rows="6"
                    class="w-full px-4 py-3 rounded-xl border text-sm focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"
                    :class="errors.content ? 'border-rose-300 focus:border-rose-500' : 'border-slate-200 focus:border-indigo-500 bg-white hover:border-slate-300'"
                    placeholder="Jelaskan kualifikasi, tanggung jawab, dan cara melamar..."
                  ></textarea>
                  <p v-if="errors.content" class="text-xs text-rose-500 mt-1 font-medium ml-1">{{ errors.content }}</p>
                </div>

              </div>
            </div>

            <!-- Bottom Actions -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-end gap-4">
              <AppButton variant="secondary" size="md" @click="goBack">Batal</AppButton>
              <AppButton variant="primary" size="md" type="submit" :disabled="isSubmitting">
                <svg v-if="isSubmitting" class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <svg v-if="!isSubmitting" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ isSubmitting ? (isEditMode ? 'Menyimpan...' : 'Menambahkan...') : (isEditMode ? 'Simpan Perubahan' : 'Simpan Logo') }}
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
const logoId = ref(null);

const form = reactive({
  title: '',
  description: '',
  url_image: null,
  
});



const imagePreview = ref(null);

const handleImageUpload = (e) => {
  const file = e.target.files[0];
  if (file) {
    if (file.size > 5 * 1024 * 1024) {
      Swal.fire({ icon: 'warning', title: 'File Terlalu Besar', text: 'Ukuran file maksimal 5MB.', confirmButtonColor: '#4f46e5' });
      return;
    }
    form.url_image = file;
    const reader = new FileReader();
    reader.onload = (event) => {
      imagePreview.value = event.target.result;
    };
    reader.readAsDataURL(file);
    errors.url_image = '';
  }
};

const goBack = () => {
  window.location.href = '/content/logo-sertifikasi';
};

const fetchLogoData = async () => {
    isLoading.value = true;
    try {
        const parts = window.location.pathname.split('/');
        logoId.value = parts[parts.length - 1];
        const token = getCookie(TOKEN_COOKIE_NAME);
        
        const response = await axios.get(`/api/certification-logos/${logoId.value}`, {
            headers: { Authorization: `Bearer ${token}` }
        });
        
        if (response.data.status === 'success') {
            const data = response.data.data;
            form.title = data.title;
            form.description = data.description;
            imagePreview.value = data.url_image;
        }
    } catch (error) {
        console.error('Error fetching logo data:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Gagal mengambil data logo sertifikasi.',
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
  if (!form.title) { errors.title = 'Judul logo wajib diisi'; hasError = true; }
  if (!form.description) { errors.content = 'Detail logo wajib diisi'; hasError = true; }
  // Only require image on creation
  if (!isEditMode.value && !imagePreview.value) { errors.url_image = 'Gambar/banner wajib diunggah'; hasError = true; }

  if (hasError) return;

  isSubmitting.value = true;

  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const formData = new FormData();
    formData.append('title', form.title);
    formData.append('description', form.description);
    
    // Only append image if it's a new file
    if (form.url_image instanceof File) {
      formData.append('image', form.url_image);
    }

    const endpoint = isEditMode.value ? `/api/certification-logos/${logoId.value}` : '/api/certification-logos';
    
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
        text: isEditMode.value ? 'Logo berhasil diperbarui.' : 'Logo baru berhasil ditambahkan.',
        confirmButtonText: 'Kembali ke Daftar',
        confirmButtonColor: '#4f46e5'
      });
      window.location.href = '/content/logo-sertifikasi';
    }
  } catch (error) {
    console.error('Error submitting logo:', error);
    const message = error.response?.data?.message || 'Terjadi kesalahan saat menyimpan logo.';
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
        fetchLogoData();
    }
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>

