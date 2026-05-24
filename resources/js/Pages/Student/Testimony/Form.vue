<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden font-sans">
    <!-- Sidebar -->
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <div class="max-w-4xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
              <a href="/student/testimony" class="hover:text-indigo-600 transition-colors">Testimoni Alumni</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">{{ isEditMode ? 'Ubah Testimoni' : 'Tambah Testimoni' }}</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">{{ isEditMode ? 'Ubah Informasi Testimoni' : 'Tambah Testimoni Baru' }}</h1>
            <p class="text-slate-500">{{ isEditMode ? 'Perbarui informasi testimoni.' : 'Tambahkan testimoni baru ke dalam sistem.' }}</p>
          </div>
          <div class="flex items-center gap-3">
            <AppButton variant="secondary" size="md" @click="goBack">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
              Kembali
            </AppButton>
          </div>
        </div>

        <!-- Form Card -->
        <div class="max-w-4xl mx-auto">
          <form @submit.prevent="handleSubmit" class="space-y-8">
            
            <!-- Image Upload Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </span>
                Foto Alumni
              </h2>

              <div class="flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-3xl p-8 hover:border-indigo-400 hover:bg-indigo-50/30 transition-all group relative overflow-hidden cursor-pointer" @click="$refs.fileInput.click()">
                <input type="file" ref="fileInput" class="hidden" accept="image/*" @change="handleImageUpload">
                
                <template v-if="!imagePreview">
                  <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                  </div>
                  <p class="text-slate-600 font-bold">Pilih Foto Alumni</p>
                  <p class="text-slate-400 text-sm mt-1">Maks. 5MB (JPG, PNG, WEBP)</p>
                </template>

                <div v-else class="w-48 h-48 rounded-2xl overflow-hidden shadow-lg border border-slate-200 relative">
                  <img :src="imagePreview" class="w-full h-full object-contain bg-slate-50">
                  <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                    <span class="px-5 py-2 bg-white text-slate-900 font-bold rounded-xl text-sm shadow-xl">Ganti Foto</span>
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
                Detail Testimoni
              </h2>

              <div class="space-y-6">
                <!-- Large Title Field -->
                <div class="field-judul-besar">
                    <AppInput v-model="form.name" label="Nama Alumni" placeholder="Masukkan nama alumni..." id="testimony-name" :error="errors.name" />
                </div>

                <!-- WYSIWYG Editor for Content -->
                <div class="space-y-1 mt-6">
                  <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Testimoni</label>
                  <div class="quill-editor-wrapper" :class="{ 'quill-error': errors.testimony }">
                    <QuillEditor 
                      v-model:content="form.testimony" 
                      contentType="html"
                      :options="editorOptions"
                      style="min-height: 200px;"
                    />
                  </div>
                  <p v-if="errors.testimony" class="text-xs text-rose-500 mt-1 font-medium ml-1">{{ errors.testimony }}</p>
                </div>
              </div>
            </div>

            <!-- Bottom Actions -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-end gap-4">
              <AppButton variant="secondary" size="md" @click="goBack" type="button">
                Batal
              </AppButton>
              <AppButton variant="primary" size="md" type="submit" :disabled="isSubmitting">
                <svg v-if="isSubmitting" class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <svg v-if="!isSubmitting" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ isSubmitting ? (isEditMode ? 'Menyimpan...' : 'Menambahkan...') : (isEditMode ? 'Simpan Perubahan' : 'Simpan Testimoni') }}
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
const isEditMode = ref(false);
const itemId = ref(null);

const fileInput = ref(null);
const imagePreview = ref(null);

const form = reactive({
  name: '',
  testimony: '',
  image: null
});

const errors = reactive({});

const editorOptions = {
  placeholder: 'Tulis testimoni di sini...',
  theme: 'snow',
  modules: {
    toolbar: [
      ['bold', 'italic', 'underline', 'strike'],
      [{ 'header': [1, 2, 3, false] }],
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      ['link'],
      ['clean']
    ]
  }
};

const goBack = () => {
  window.location.href = '/student/testimony';
};

const fetchItemData = async () => {
  try {
    const parts = window.location.pathname.split('/');
    if (parts.includes('edit')) {
        isEditMode.value = true;
        itemId.value = parts[parts.length - 1];
        const token = getCookie(TOKEN_COOKIE_NAME);
        
        const response = await axios.get(`/api/testimony-alumnis/${itemId.value}`, {
            headers: { Authorization: `Bearer ${token}` }
        });
        
        if (response.data.status === 'success') {
            const data = response.data.data;
            form.name = data.name || '';
            form.testimony = data.testimony || '';
            imagePreview.value = data.image;
        }
    }
  } catch (error) {
    console.error('Error fetching testimoni data:', error);
    Swal.fire({
        icon: 'error',
        title: 'Kesalahan',
        text: 'Gagal mengambil data testimoni.',
        confirmButtonColor: '#4f46e5'
    });
  }
};

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (!file) return;

  if (!file.type.startsWith('image/')) {
    Swal.fire({ icon: 'error', title: 'File Tidak Valid', text: 'Silakan pilih file gambar yang valid.', confirmButtonColor: '#4f46e5' });
    return;
  }

  if (file.size > 5 * 1024 * 1024) {
    Swal.fire({ icon: 'error', title: 'Ukuran Terlalu Besar', text: 'Ukuran gambar maksimal adalah 5MB.', confirmButtonColor: '#4f46e5' });
    return;
  }

  form.image = file;
  imagePreview.value = URL.createObjectURL(file);
};

const handleSubmit = async () => {
  isSubmitting.value = true;
  Object.keys(errors).forEach(key => delete errors[key]);

  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const formData = new FormData();
    formData.append('name', form.name);
    formData.append('testimony', form.testimony || '');
    
    if (form.image instanceof File) {
      formData.append('image', form.image);
    }

    const endpoint = isEditMode.value ? `/api/testimony-alumnis/${itemId.value}` : '/api/testimony-alumnis';
    
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
        text: isEditMode.value ? 'Testimoni berhasil diperbarui.' : 'Testimoni baru berhasil ditambahkan.',
        confirmButtonText: 'Kembali ke Daftar',
        confirmButtonColor: '#4f46e5'
      });
      window.location.href = '/student/testimony';
    }
  } catch (error) {
    console.error('Error submitting testimony:', error);
    if (error.response?.data?.errors) {
      Object.assign(errors, error.response.data.errors);
      Swal.fire({ icon: 'error', title: 'Validasi Gagal', text: 'Silakan periksa kembali isian formulir Anda.', confirmButtonColor: '#4f46e5' });
    } else {
      Swal.fire({ icon: 'error', title: 'Gagal Menyimpan', text: 'Terjadi kesalahan saat menyimpan data testimoni.', confirmButtonColor: '#4f46e5' });
    }
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
      headers: { Authorization: `Bearer ${token}` },
    });
    isAuthenticated.value = true;
    fetchItemData();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>

<style scoped>
.field-judul-besar :deep(input) {
    font-size: 1.5rem !important;
    font-weight: 700 !important;
    padding: 1.5rem !important;
    height: auto !important;
}

.quill-editor-wrapper {
  border: 1px solid #e2e8f0;
  border-radius: 0.75rem;
  overflow: hidden;
  transition: all 0.2s ease;
  background-color: white;
}

.quill-editor-wrapper:focus-within {
  border-color: #6366f1;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

.quill-error {
  border-color: #f43f5e;
}

:deep(.ql-toolbar) {
  border: none !important;
  border-bottom: 1px solid #e2e8f0 !important;
  background-color: #f8fafc;
  padding: 0.75rem !important;
  font-family: inherit;
}

:deep(.ql-container) {
  border: none !important;
  font-size: 1rem !important;
  font-family: inherit !important;
}

:deep(.ql-editor) {
  padding: 1.5rem !important;
  min-height: 200px;
}

:deep(.ql-editor p) {
  margin-bottom: 1rem;
  color: #475569;
  line-height: 1.7;
}

:deep(.ql-editor.ql-blank::before) {
  color: #94a3b8;
  font-style: normal;
  left: 1.5rem;
}

/* Custom styling for file input area to make it look clickable */
input[type="file"]::-webkit-file-upload-button {
  cursor: pointer;
}
</style>
