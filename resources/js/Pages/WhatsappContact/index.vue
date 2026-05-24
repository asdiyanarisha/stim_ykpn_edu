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
              <span class="hover:text-indigo-600 transition-colors">Pengaturan</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">Kontak Whatsapp</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Pengaturan Kontak WhatsApp</h1>
            <p class="text-slate-500">Kelola daftar kontak WhatsApp dan tentukan nomor utama untuk layanan CS/informasi.</p>
          </div>
        </div>

        <div class="max-w-4xl mx-auto">
          <form @submit.prevent="handleSubmit" class="space-y-6">
            <!-- Contact List Card -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                  <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                  </span>
                  Daftar Kontak WhatsApp
                </h2>
                <span class="text-xs font-semibold px-2.5 py-1 bg-slate-100 text-slate-600 rounded-full">
                  {{ contacts.length }} Kontak
                </span>
              </div>

              <!-- Empty State -->
              <div v-if="contacts.length === 0" class="flex flex-col items-center justify-center py-12 border-2 border-dashed border-slate-200 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <p class="text-slate-500 font-medium mb-1">Belum ada kontak WhatsApp</p>
                <p class="text-xs text-slate-400 mb-4">Tambahkan kontak pertama Anda dengan tombol di bawah.</p>
                <AppButton variant="secondary" size="sm" type="button" @click="addContact">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  Tambah Kontak Pertama
                </AppButton>
              </div>

              <!-- Contacts Form List -->
              <div v-else class="space-y-6">
                <div 
                  v-for="(contact, index) in contacts" 
                  :key="index" 
                  class="p-6 rounded-2xl border border-slate-100 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-200 transition-all relative group"
                >
                  <!-- Header Row -->
                  <div class="flex items-center justify-between mb-4">
                    <span class="text-sm font-bold text-slate-600">Kontak #{{ index + 1 }}</span>
                    <button 
                      type="button" 
                      @click="removeContact(index)" 
                      class="text-rose-500 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 p-2 rounded-xl transition-all duration-200"
                      title="Hapus Kontak"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </div>

                  <!-- Input Fields -->
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <AppInput 
                      v-model="contact.nama" 
                      type="text" 
                      label="Nama Kontak" 
                      placeholder="Misal: Customer Service 1" 
                      :id="'nama-' + index"
                      :error="validationErrors[index]?.nama"
                    />
                    <AppInput 
                      v-model="contact.no_whatsapp" 
                      type="text" 
                      label="Nomor WhatsApp" 
                      placeholder="Misal: 081234567890" 
                      :id="'whatsapp-' + index"
                      :error="validationErrors[index]?.no_whatsapp"
                    />
                  </div>

                  <!-- Is Main Checkbox/Switch -->
                  <div class="mt-4 flex items-center justify-between">
                    <label class="inline-flex items-center cursor-pointer gap-3">
                      <input 
                        type="checkbox" 
                        v-model="contact.is_main" 
                        @change="handleIsMainChange(index)"
                        class="sr-only peer"
                      />
                      <div class="relative w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                      <span class="text-sm font-medium text-slate-700 select-none">Jadikan sebagai Nomor Utama</span>
                    </label>
                    
                    <span 
                      v-if="contact.is_main" 
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800"
                    >
                      Nomor Utama Aktif
                    </span>
                  </div>
                </div>

                <!-- Add More Button -->
                <div class="flex justify-center pt-2">
                  <AppButton variant="secondary" size="md" type="button" @click="addContact" class="w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Nomor
                  </AppButton>
                </div>
              </div>
            </div>

            <!-- Bottom Actions -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-end gap-4">
              <AppButton variant="primary" size="md" type="submit" :disabled="isSubmitting" :loading="isSubmitting">
                <svg v-if="!isSubmitting" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
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
import { ref, onMounted } from 'vue';
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

const contacts = ref([]);
const validationErrors = ref([]);

const addContact = () => {
  contacts.value.push({
    nama: '',
    no_whatsapp: '',
    is_main: false
  });
  validationErrors.value.push({
    nama: '',
    no_whatsapp: ''
  });
};

const removeContact = (index) => {
  contacts.value.splice(index, 1);
  validationErrors.value.splice(index, 1);
};

const handleIsMainChange = (selectedIndex) => {
  if (contacts.value[selectedIndex].is_main) {
    contacts.value.forEach((contact, index) => {
      if (index !== selectedIndex) {
        contact.is_main = false;
      }
    });
  }
};

const fetchData = async () => {
  isLoading.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.get('/api/whatsapp-contacts', {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      contacts.value = response.data.data.map(item => ({
        nama: item.nama,
        no_whatsapp: item.no_whatsapp,
        is_main: !!item.is_main
      }));
      // Initialize validation errors
      validationErrors.value = contacts.value.map(() => ({
        nama: '',
        no_whatsapp: ''
      }));
    }
  } catch (error) {
    console.error('Error fetching data:', error);
    Swal.fire({ 
      icon: 'error', 
      title: 'Kesalahan', 
      text: 'Gagal memuat data kontak WhatsApp.' 
    });
  } finally {
    isLoading.value = false;
  }
};

const validateFrontend = () => {
  let isValid = true;
  validationErrors.value = contacts.value.map(() => ({
    nama: '',
    no_whatsapp: ''
  }));

  // Enforce required fields
  contacts.value.forEach((contact, index) => {
    if (!contact.nama.trim()) {
      validationErrors.value[index].nama = 'Nama kontak wajib diisi';
      isValid = false;
    }
    if (!contact.no_whatsapp.trim()) {
      validationErrors.value[index].no_whatsapp = 'Nomor WhatsApp wajib diisi';
      isValid = false;
    }
  });

  // Verify that is_main <= 1
  const mainCount = contacts.value.filter(c => c.is_main).length;
  if (mainCount > 1) {
    Swal.fire({
      icon: 'warning',
      title: 'Validasi Gagal',
      text: 'Nomor utama tidak boleh lebih dari 1.'
    });
    isValid = false;
  }

  return isValid;
};

const handleSubmit = async () => {
  if (!validateFrontend()) return;

  isSubmitting.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.post('/api/whatsapp-contacts', {
      contacts: contacts.value
    }, {
      headers: { Authorization: `Bearer ${token}` }
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
    
    // Bind backend validation errors if any
    if (error.response?.data?.errors) {
      const backendErrors = error.response.data.errors;
      // Format of laravel array validation errors is contacts.0.nama
      Object.keys(backendErrors).forEach(key => {
        const parts = key.split('.');
        if (parts.length === 3 && parts[0] === 'contacts') {
          const index = parseInt(parts[1]);
          const field = parts[2];
          if (validationErrors.value[index]) {
            validationErrors.value[index][field] = backendErrors[key][0];
          }
        }
      });
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
