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
                <p class="text-slate-500 font-medium animate-pulse">Memuat Data...</p>
            </div>
        </div>
      </transition>

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="max-w-4xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
              <a href="/content/profil/facility" class="hover:text-indigo-600 transition-colors">Manajemen Fasilitas</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">Edit</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Edit Fasilitas</h1>
            <p class="text-slate-500">Ubah detail data fasilitas kampus pendukung pendidikan STIM YKPN.</p>
          </div>
        </div>

        <div class="max-w-4xl mx-auto">
          <form @submit.prevent="handleSubmit" class="space-y-6">
            <!-- Image Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </span>
                Gambar Fasilitas
              </h2>

              <div class="flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-3xl p-12 hover:border-indigo-400 hover:bg-indigo-50/30 transition-all group relative overflow-hidden cursor-pointer" @click="$refs.fileInput.click()">
                <input type="file" ref="fileInput" class="hidden" accept="image/*" @change="handleImageUpload">
                
                <template v-if="!imagePreview">
                  <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                  </div>
                  <p class="text-slate-600 font-bold">Pilih atau Seret Gambar ke Sini</p>
                  <p class="text-slate-400 text-sm mt-1">Saran: Gambar fasilitas berukuran landscape (Maks. 2MB)</p>
                </template>

                <div v-if="imagePreview" class="w-full aspect-[21/9] mx-auto rounded-2xl overflow-hidden shadow-lg border border-slate-200 relative">
                  <img :src="imagePreview" class="w-full h-full object-cover">
                  <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                    <span class="px-5 py-2 bg-white text-slate-900 font-bold rounded-xl text-sm shadow-xl">Ganti Gambar</span>
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
                Detail Fasilitas
              </h2>

              <div class="space-y-6">
                <AppInput v-model="form.title" label="Nama Fasilitas" placeholder="Misal: Laboratorium Komputer Terpadu" id="facility-title" :error="errors.title" />

                <AppInput v-model="form.top_facility" label="Highlight / Badge (Opsional)" placeholder="Misal: Eksklusif, Full AC & Multimedia, dll. (Kosongkan jika biasa)" id="facility-badge" :error="errors.top_facility" />

                <div class="space-y-1 icon-picker-container relative">
                  <label for="facility-icon" class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Class Icon (Opsional)</label>
                  <div class="flex gap-3 relative">
                    <!-- Preview Box -->
                    <div class="w-11 h-11 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center text-indigo-600 text-lg flex-shrink-0">
                      <i :class="form.icon || 'fi fi-rr-building'"></i>
                    </div>
                    
                    <!-- Text Input -->
                    <div class="flex-1">
                      <input
                        id="facility-icon"
                        type="text"
                        v-model="form.icon"
                        placeholder="Misal: fi fi-rr-building, fi fi-rr-computer, dll."
                        class="block w-full border border-slate-200 rounded-xl shadow-sm sm:text-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2.5 px-4 transition-all duration-200"
                      />
                    </div>

                    <!-- Picker Button -->
                    <button
                      type="button"
                      @click.stop="toggleIconPicker"
                      class="px-4 py-2 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 border border-indigo-200 font-semibold text-sm rounded-xl transition-all flex items-center gap-1.5 active:scale-95 flex-shrink-0 cursor-pointer"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                      Pilih Ikon
                    </button>
                  </div>
                  
                  <!-- Popup overlay for Icon Picker -->
                  <transition
                    enter-active-class="transition duration-150 ease-out"
                    enter-from-class="opacity-0 scale-95"
                    enter-to-class="opacity-100 scale-100"
                    leave-active-class="transition duration-100 ease-in"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-95"
                  >
                    <div v-if="showIconPicker" class="absolute z-20 mt-2 w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-100 p-4">
                      <div class="flex items-center justify-between mb-3 pb-2 border-b border-slate-100">
                        <span class="font-bold text-slate-800 text-sm">Pilih Ikon Fasilitas</span>
                        <button type="button" @click="showIconPicker = false" class="text-slate-400 hover:text-slate-600">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                      </div>
                      
                      <!-- Icon Search inside Picker -->
                      <div class="mb-3">
                        <input
                          type="text"
                          v-model="iconSearchQuery"
                          placeholder="Cari ikon... (contoh: Lab, Buku, Wifi, Gedung)"
                          class="w-full text-xs border border-slate-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                        />
                      </div>

                      <!-- Icon Grid -->
                      <div class="grid grid-cols-5 gap-2 max-h-48 overflow-y-auto p-1 custom-scrollbar">
                        <button
                          v-for="icon in filteredIcons"
                          :key="icon.class"
                          type="button"
                          @click="selectIcon(icon.class)"
                          class="flex flex-col items-center justify-center p-2 rounded-xl border border-slate-100 hover:border-indigo-300 hover:bg-indigo-50/50 transition-all group"
                          :class="{ 'border-indigo-500 bg-indigo-50': form.icon === icon.class }"
                          :title="icon.name"
                        >
                          <i :class="[icon.class, 'text-xl text-slate-600 group-hover:text-indigo-600 transition-colors', { 'text-indigo-600': form.icon === icon.class }]"></i>
                          <span class="text-[9px] text-slate-400 mt-1 truncate w-full text-center group-hover:text-indigo-600 transition-colors">{{ icon.name }}</span>
                        </button>
                      </div>
                      <div v-if="filteredIcons.length === 0" class="text-center text-xs text-slate-400 py-4">
                        Tidak ada ikon yang cocok.
                      </div>
                    </div>
                  </transition>

                  <p v-if="errors.icon" class="text-xs text-rose-600 mt-1 ml-1">{{ errors.icon }}</p>
                </div>

                <!-- Quill Editor for Content -->
                <div class="space-y-1">
                  <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Deskripsi Fasilitas</label>
                  <div class="quill-editor-wrapper" :class="{ 'quill-error': errors.content }">
                    <QuillEditor 
                      v-model:content="form.content" 
                      contentType="html"
                      :options="editorOptions"
                      style="min-height: 250px;"
                    />
                  </div>
                  <p v-if="errors.content" class="text-xs text-rose-500 mt-1 font-medium ml-1">{{ errors.content }}</p>
                </div>

              </div>
            </div>

            <!-- Bottom Actions -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-end gap-4">
              <a href="/content/profil/facility" class="px-5 py-2 text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-50 rounded-xl transition-all cursor-pointer">
                Batal
              </a>
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
import { ref, reactive, onMounted, computed, watch } from 'vue';
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

const facilityId = ref(null);

const form = reactive({
  title: '',
  content: '',
  top_facility: '',
  icon: '',
  image: null,
});

const showIconPicker = ref(false);
const iconSearchQuery = ref('');

const iconOptions = [
  { class: 'fi fi-rr-building', name: 'Gedung', tags: 'gedung building kelas kampus room' },
  { class: 'fi fi-rr-computer', name: 'Lab Komputer', tags: 'komputer computer lab laboratory pc teknologi tech' },
  { class: 'fi fi-rr-book-alt', name: 'Perpustakaan', tags: 'buku perpustakaan library book membaca read' },
  { class: 'fi fi-rr-chalkboard-user', name: 'Ruang Kuliah', tags: 'kelas kuliah chalkboard chalkboard-user ruang room student belajar' },
  { class: 'fi fi-rr-users-alt', name: 'Aula / Hall', tags: 'aula hall pertemuan users meeting gather' },
  { class: 'fi fi-rr-wifi', name: 'Wi-Fi / Internet', tags: 'wifi internet connection signal hotspot' },
  { class: 'fi fi-rr-parking', name: 'Parkir', tags: 'parkir parking motor mobil area' },
  { class: 'fi fi-rr-gym', name: 'Olahraga / Gym', tags: 'gym olahraga sport fit physical' },
  { class: 'fi fi-rr-utensils', name: 'Kantin / Makan', tags: 'kantin makan utensils food drink canteen' },
  { class: 'fi fi-rr-flask', name: 'Lab Sains', tags: 'sains flask kimia biology lab laboratory science' },
  { class: 'fi fi-rr-briefcase', name: 'Kantor / Layanan', tags: 'kantor layanan briefcase office administration staf staff' },
  { class: 'fi fi-rr-heartbeat', name: 'Klinik / Sehat', tags: 'klinik sehat heartbeat medical health doctor obat' },
  { class: 'fi fi-rr-graduation-cap', name: 'Akademik', tags: 'akademik kelulusan graduation cap toga wisuda' },
  { class: 'fi fi-rr-calendar-lines', name: 'Kalender', tags: 'kalender calendar lines jadwal date event schedule' },
  { class: 'fi fi-rr-bell', name: 'Notifikasi / Bel', tags: 'notifikasi bell bel alarm info penting' },
  { class: 'fi fi-rr-trophy', name: 'Prestasi / Trophy', tags: 'piala prestasi trophy win reward' },
  { class: 'fi fi-rr-globe', name: 'Akses Publik / Web', tags: 'globe dunia public web site internet international' },
  { class: 'fi fi-rr-shield', name: 'Keamanan / Satpam', tags: 'satpam security pos shield aman' },
  { class: 'fi fi-rr-print', name: 'Fotokopi / Print', tags: 'fotokopi cetak print copy paper' },
  { class: 'fi fi-rr-wallet', name: 'Keuangan / Bank', tags: 'keuangan bank wallet money cash bayar payment' },
];

const filteredIcons = computed(() => {
  if (!iconSearchQuery.value) return iconOptions;
  const q = iconSearchQuery.value.toLowerCase();
  return iconOptions.filter(icon => 
    icon.name.toLowerCase().includes(q) || 
    icon.tags.toLowerCase().includes(q)
  );
});

const toggleIconPicker = () => {
  showIconPicker.value = !showIconPicker.value;
  if (showIconPicker.value) {
    iconSearchQuery.value = '';
  }
};

const selectIcon = (iconClass) => {
  form.icon = iconClass;
  showIconPicker.value = false;
};

const closePickerOnOutside = (e) => {
  if (showIconPicker.value) {
    const pickerEl = document.querySelector('.icon-picker-container');
    if (pickerEl && !pickerEl.contains(e.target)) {
      showIconPicker.value = false;
    }
  }
};

watch(showIconPicker, (isOpen) => {
  if (isOpen) {
    document.addEventListener('click', closePickerOnOutside);
  } else {
    document.removeEventListener('click', closePickerOnOutside);
  }
});

const editorOptions = {
  placeholder: 'Tuliskan deskripsi lengkap fasilitas di sini...',
  theme: 'snow',
  modules: {
    toolbar: [
      [{ header: [1, 2, 3, false] }],
      ['bold', 'italic', 'underline', 'strike'],
      [{ color: [] }, { background: [] }],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['link', 'clean']
    ]
  }
};

const imagePreview = ref(null);

const handleImageUpload = (e) => {
  const file = e.target.files[0];
  if (file) {
    if (file.size > 2 * 1024 * 1024) {
      Swal.fire({ icon: 'warning', title: 'File Terlalu Besar', text: 'Ukuran file maksimal 2MB.', confirmButtonColor: '#4f46e5' });
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

const fetchFacility = async (id) => {
  isLoading.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.get(`/api/facilities/${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    if (response.data.status === 'success') {
      const data = response.data.data;
      form.title = data.title || '';
      form.content = data.content || '';
      form.top_facility = data.top_facility || '';
      form.icon = data.icon || '';
      imagePreview.value = data.header_image || null;
    }
  } catch (error) {
    console.error('Error fetching facility:', error);
    Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Gagal mengambil data fasilitas.' });
    setTimeout(() => {
      window.location.href = '/content/profil/facility';
    }, 1500);
  } finally {
    isLoading.value = false;
  }
};

const handleSubmit = async () => {
  // Clear errors
  Object.keys(errors).forEach(key => errors[key] = '');

  if (!form.title) {
    errors.title = 'Nama fasilitas wajib diisi';
    return;
  }
  if (!form.content || form.content === '<p><br></p>') {
    errors.content = 'Deskripsi fasilitas wajib diisi';
    return;
  }

  isSubmitting.value = true;

  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const formData = new FormData();
    formData.append('title', form.title);
    formData.append('content', form.content);
    formData.append('top_facility', form.top_facility || '');
    formData.append('icon', form.icon || '');
    
    if (form.image instanceof File) {
      formData.append('image', form.image);
    }

    const response = await axios.post(`/api/facilities/${facilityId.value}`, formData, {
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
        confirmButtonColor: '#4f46e5',
        timer: 1500,
        showConfirmButton: false
      });
      setTimeout(() => {
        window.location.href = '/content/profil/facility';
      }, 1500);
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

  // Parse ID from URL path (e.g. /content/profil/facility/edit/12)
  const pathParts = window.location.pathname.split('/');
  facilityId.value = pathParts[pathParts.length - 1];

  try {
    await axios.post('/api/auth/validate-token', {}, {
      headers: { Authorization: `Bearer ${token}` }
    });
    isAuthenticated.value = true;
    if (facilityId.value) {
      fetchFacility(facilityId.value);
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

/* Custom Scrollbar for Icon Grid */
.custom-scrollbar::-webkit-scrollbar {
  width: 5px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 99px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}
</style>
