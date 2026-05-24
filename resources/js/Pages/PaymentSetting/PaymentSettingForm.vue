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
              <span class="text-slate-900 font-medium">Pembayaran</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Pengaturan Pembayaran</h1>
            <p class="text-slate-500">Kelola biaya pendaftaran, PKKMB, dan pengaturan afiliasi.</p>
          </div>
        </div>

        <div class="max-w-4xl mx-auto">
          <form @submit.prevent="handleSubmit" class="space-y-6">
            <!-- Payment Details Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </span>
                Detail Pembayaran & Afiliasi
              </h2>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <AppInput v-model="form.register_fee" type="number" label="Biaya Pendaftaran (Rp)" placeholder="Misal: 250000" id="register-fee" :error="errors.register_fee" />
                <AppInput v-model="form.pkkmb_fee" type="number" label="Biaya PKKMB (Rp)" placeholder="Misal: 500000" id="pkkmb-fee" :error="errors.pkkmb_fee" />
                <AppInput v-model="form.affiliate_point_per_register" type="number" label="Poin Afiliasi per Pendaftar" placeholder="Misal: 50000" id="affiliate-point" :error="errors.affiliate_point_per_register" />
                <AppInput v-model="form.minimal_withdraw_affiliate" type="number" label="Minimal Penarikan Afiliasi (Rp)" placeholder="Misal: 100000" id="minimal-withdraw" :error="errors.minimal_withdraw_affiliate" />
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

const form = reactive({
  register_fee: '',
  pkkmb_fee: '',
  affiliate_point_per_register: '',
  minimal_withdraw_affiliate: '',
});

const fetchData = async () => {
    isLoading.value = true;
    try {
        const token = getCookie(TOKEN_COOKIE_NAME);
        const response = await axios.get('/api/payment-settings', {
            headers: { Authorization: `Bearer ${token}` }
        });
        
        if (response.data.status === 'success' && response.data.data) {
            const data = response.data.data;
            form.register_fee = data.register_fee || '';
            form.pkkmb_fee = data.pkkmb_fee || '';
            form.affiliate_point_per_register = data.affiliate_point_per_register || '';
            form.minimal_withdraw_affiliate = data.minimal_withdraw_affiliate || '';
        }
    } catch (error) {
        console.error('Error fetching data:', error);
        Swal.fire({ icon: 'error', title: 'Kesalahan', text: 'Gagal memuat data pengaturan pembayaran.' });
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
    const response = await axios.post('/api/payment-settings', form, {
      headers: {
        Authorization: `Bearer ${token}`
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
    
    if (error.response?.data?.errors) {
        Object.assign(errors, error.response.data.errors);
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
