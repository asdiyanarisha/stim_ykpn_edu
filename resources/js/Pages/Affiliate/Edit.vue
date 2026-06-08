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
                <p class="text-slate-500 font-medium">Memuat data affiliate...</p>
            </div>
        </div>
      </transition>

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="max-w-4xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
              <a href="/affiliate" class="hover:text-indigo-600 transition-colors">Manajemen Affiliate</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">Ubah Affiliate</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Ubah Informasi Affiliate</h1>
            <p class="text-slate-500">Perbarui profil atau informasi rekening mitra affiliate.</p>
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
            <!-- Main Content Card -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </span>
                Data Profil Mitra
              </h2>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <AppInput v-model="form.name" label="Nama *" placeholder="Nama Lengkap Mitra" id="affiliate-name" :error="errors.name" />

                <!-- Username -->
                <AppInput v-model="form.username" label="Username * (tanpa spasi)" placeholder="Username untuk Login" id="affiliate-username" :error="errors.username" />

                <!-- Email -->
                <AppInput v-model="form.email" label="Email *" type="email" placeholder="Alamat Email Aktif" id="affiliate-email" :error="errors.email" />

                <!-- Phone -->
                <AppInput v-model="form.phone_number" label="No. HP / Whatsapp *" placeholder="Contoh: 08123456789" id="affiliate-phone" :error="errors.phone_number" />

                <!-- Institution -->
                <AppInput v-model="form.institution" label="Instansi *" placeholder="Nama Instansi/Lembaga" id="affiliate-institution" :error="errors.institution" />

                <!-- Position -->
                <AppInput v-model="form.position" label="Jabatan *" placeholder="Contoh: Staff Akademik, Guru, dll" id="affiliate-position" :error="errors.position" />

                <!-- City -->
                <AppInput v-model="form.city" label="Kota *" placeholder="Nama Kota Domisili" id="affiliate-city" :error="errors.city" />

                <!-- Password -->
                <AppInput v-model="form.password" label="Password (kosongkan jika tidak diubah)" type="password" placeholder="Password Akun Baru" id="affiliate-password" :error="errors.password" />

                <!-- Address -->
                <div class="md:col-span-2 space-y-1">
                    <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Alamat *</label>
                    <textarea 
                        v-model="form.address" 
                        rows="3" 
                        class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all text-sm font-medium placeholder:text-slate-400"
                        :class="errors.address ? 'border-rose-500' : 'border-slate-200'"
                        placeholder="Alamat lengkap mitra..."
                    ></textarea>
                    <p v-if="errors.address" class="text-xs text-rose-500 mt-1 font-medium ml-1">{{ errors.address }}</p>
                </div>

                <div class="md:col-span-2 border-t border-slate-100 my-4 pt-6">
                  <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                    </span>
                    Informasi Rekening Bank
                  </h2>
                </div>

                <!-- Bank Name -->
                <AppInput v-model="form.bank_name" label="Nama Bank" placeholder="Contoh: BCA, BNI, Mandiri, dll" id="affiliate-bank" :error="errors.bank_name" />

                <!-- Account Holder Name -->
                <AppInput v-model="form.account_holder_name" label="Atas Nama Rekening" placeholder="Nama Pemilik Rekening" id="affiliate-account-holder" :error="errors.account_holder_name" />

                <!-- Account Number -->
                <AppInput v-model="form.account_number" label="No. Rekening" placeholder="Nomor Rekening Bank" id="affiliate-account-number" :error="errors.account_number" />
              </div>
            </div>

            <!-- Bottom Actions -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-end gap-4">
              <AppButton variant="secondary" size="md" @click="goBack">Batal</AppButton>
              <AppButton variant="primary" size="md" type="submit" :disabled="isSubmitting">
                <svg v-if="isSubmitting" class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <svg v-if="!isSubmitting" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                Simpan Perubahan
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
const affiliateId = ref(null);

const form = reactive({
  name: '',
  username: '',
  email: '',
  phone_number: '',
  institution: '',
  position: '',
  city: '',
  address: '',
  bank_name: '',
  account_holder_name: '',
  account_number: '',
  password: ''
});

const goBack = () => {
  window.location.href = '/affiliate';
};

const fetchAffiliateData = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    affiliateId.value = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const response = await axios.get(`/api/affiliates/${affiliateId.value}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      const data = response.data.data;
      form.name = data.name;
      form.username = data.username;
      form.email = data.email;
      form.phone_number = data.phone_number;
      form.institution = data.institution;
      form.position = data.position;
      form.city = data.city;
      form.address = data.address;
      form.bank_name = data.bank_name || '';
      form.account_holder_name = data.account_holder_name || '';
      form.account_number = data.account_number || '';
    }
  } catch (error) {
    console.error('Error fetching affiliate data:', error);
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan',
      text: 'Gagal mengambil data affiliate.',
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
  if (!form.name.trim()) { errors.name = 'Nama wajib diisi'; hasError = true; }
  if (!form.username.trim()) { errors.username = 'Username wajib diisi'; hasError = true; }
  if (!form.email.trim()) { errors.email = 'Email wajib diisi'; hasError = true; }
  if (!form.phone_number.trim()) { errors.phone_number = 'No. HP/Whatsapp wajib diisi'; hasError = true; }
  if (!form.institution.trim()) { errors.institution = 'Instansi wajib diisi'; hasError = true; }
  if (!form.position.trim()) { errors.position = 'Jabatan wajib diisi'; hasError = true; }
  if (!form.city.trim()) { errors.city = 'Kota wajib diisi'; hasError = true; }
  if (!form.address.trim()) { errors.address = 'Alamat wajib diisi'; hasError = true; }

  if (hasError) return;

  isSubmitting.value = true;

  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.post(`/api/affiliates/${affiliateId.value}`, form, {
      headers: { Authorization: `Bearer ${token}` }
    });

    if (response.data.status === 'success') {
      await Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Data affiliate berhasil diperbarui.',
        confirmButtonText: 'Kembali ke Daftar',
        confirmButtonColor: '#4f46e5'
      });
      window.location.href = '/affiliate';
    }
  } catch (error) {
    console.error('Error submitting affiliate:', error);
    if (error.response?.data?.errors) {
      Object.keys(error.response.data.errors).forEach(key => {
        errors[key] = error.response.data.errors[key][0];
      });
    } else {
      const message = error.response?.data?.message || 'Terjadi kesalahan saat menyimpan data affiliate.';
      await Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: message,
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
    await fetchAffiliateData();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
