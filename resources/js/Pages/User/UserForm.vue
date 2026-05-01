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
              <a href="/user" class="hover:text-indigo-600 transition-colors">Manajemen User</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">{{ isEditMode ? 'Ubah User' : 'Tambah User' }}</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">{{ isEditMode ? 'Ubah Informasi User' : 'Formulir User Baru' }}</h1>
            <p class="text-slate-500">{{ isEditMode ? 'Perbarui informasi profil dan hak akses pengguna.' : 'Daftarkan pengguna baru untuk sistem STIM YKPN.' }}</p>
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
            <!-- Content Details Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </span>
                Informasi Profil
              </h2>

              <div class="space-y-6">
                <AppInput v-model="form.name" label="Nama Lengkap" placeholder="Masukkan nama lengkap..." id="user-name" :error="errors.name" />
                <AppInput v-model="form.email" label="Alamat Email" type="email" placeholder="Masukkan email aktif..." id="user-email" :error="errors.email" />
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1 relative">
                        <AppInput 
                            v-model="form.password" 
                            label="Kata Sandi" 
                            :type="showPassword ? 'text' : 'password'" 
                            :placeholder="isEditMode ? 'Kosongkan jika tidak ingin diubah' : 'Masukkan kata sandi...'" 
                            id="user-password" 
                            :error="errors.password" 
                        />
                        <button 
                            type="button" 
                            @click="showPassword = !showPassword" 
                            class="absolute right-4 top-[33px] text-slate-400 hover:text-indigo-600 transition-colors"
                        >
                            <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" /></svg>
                        </button>
                    </div>

                    <div class="space-y-1 relative">
                        <AppInput 
                            v-model="form.password_confirmation" 
                            label="Konfirmasi Kata Sandi" 
                            :type="showConfirmPassword ? 'text' : 'password'" 
                            placeholder="Ulangi kata sandi..." 
                            id="user-password-confirmation" 
                            :error="errors.password_confirmation" 
                        />
                        <button 
                            type="button" 
                            @click="showConfirmPassword = !showConfirmPassword" 
                            class="absolute right-4 top-[33px] text-slate-400 hover:text-indigo-600 transition-colors"
                        >
                            <svg v-if="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" /></svg>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Hak Akses (Role)</label>
                        <select 
                            v-model="form.role_id" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none text-slate-700 bg-white"
                            :class="{ 'border-rose-500 bg-rose-50': errors.role_id }"
                        >
                            <option value="" disabled>Pilih Role</option>
                            <option v-for="role in roles" :key="role.id" :value="role.id">
                                {{ role.name }}
                            </option>
                        </select>
                        <p v-if="errors.role_id" class="text-xs text-rose-500 mt-1 font-medium ml-1">{{ errors.role_id }}</p>
                    </div>
                </div>
              </div>
            </div>

            <!-- Bottom Actions -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-end gap-4">
              <AppButton variant="secondary" size="md" @click="goBack">Batal</AppButton>
              <AppButton variant="primary" size="md" type="submit" :disabled="isSubmitting">
                <svg v-if="isSubmitting" class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <svg v-if="!isSubmitting" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ isSubmitting ? (isEditMode ? 'Menyimpan...' : 'Menambahkan...') : (isEditMode ? 'Simpan Perubahan' : 'Simpan User') }}
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
const userId = ref(null);

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role_id: ''
});

const showPassword = ref(false);
const showConfirmPassword = ref(false);

const roles = ref([]);

const goBack = () => {
  window.location.href = '/user';
};

const fetchRoles = async () => {
    try {
        const token = getCookie(TOKEN_COOKIE_NAME);
        const response = await axios.get('/api/roles', {
            headers: { Authorization: `Bearer ${token}` }
        });
        if (response.data.status === 'success') {
            // Filter out administrator role
            roles.value = response.data.data.filter(r => r.name !== 'administrator');
        }
    } catch (error) {
        console.error('Error fetching roles:', error);
    }
};

const fetchUserData = async () => {
    isLoading.value = true;
    try {
        const parts = window.location.pathname.split('/');
        userId.value = parts[parts.length - 1];
        const token = getCookie(TOKEN_COOKIE_NAME);
        
        const response = await axios.get(`/api/users/${userId.value}`, {
            headers: { Authorization: `Bearer ${token}` }
        });
        
        if (response.data.status === 'success') {
            const data = response.data.data;
            form.name = data.name;
            form.email = data.email;
            form.role_id = data.role_id;
            
            if (data.role?.name === 'administrator') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Akses Ditolak',
                    text: 'User administrator tidak dapat diubah melalui menu ini.',
                }).then(() => {
                    goBack();
                });
            }
        }
    } catch (error) {
        console.error('Error fetching user data:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Gagal mengambil data user.',
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
  if (!form.name) { errors.name = 'Nama lengkap wajib diisi'; hasError = true; }
  if (!form.email) { errors.email = 'Alamat email wajib diisi'; hasError = true; }
  
  if (!isEditMode.value && !form.password) { 
    errors.password = 'Kata sandi wajib diisi'; 
    hasError = true; 
  } else if (form.password && form.password.length < 8) {
    errors.password = 'Kata sandi minimal 8 karakter';
    hasError = true;
  }

  if (form.password && form.password !== form.password_confirmation) {
    errors.password_confirmation = 'Konfirmasi kata sandi tidak cocok';
    hasError = true;
  }

  if (!form.role_id) { errors.role_id = 'Pilih role untuk user ini'; hasError = true; }

  if (hasError) return;

  isSubmitting.value = true;

  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const payload = {
      name: form.name,
      email: form.email,
      role_id: form.role_id
    };

    if (form.password) {
        payload.password = form.password;
        payload.password_confirmation = form.password_confirmation;
    }

    const endpoint = isEditMode.value ? `/api/users/${userId.value}` : '/api/users';
    
    const response = await axios.post(endpoint, payload, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });

    if (response.data.status === 'success') {
      await Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: isEditMode.value ? 'User berhasil diperbarui.' : 'User baru berhasil ditambahkan.',
        confirmButtonText: 'Kembali ke Daftar',
        confirmButtonColor: '#4f46e5'
      });
      window.location.href = '/user';
    }
  } catch (error) {
    console.error('Error submitting user:', error);
    const message = error.response?.data?.message || 'Terjadi kesalahan saat menyimpan user.';
    const validationErrors = error.response?.data?.errors;
    
    if (validationErrors) {
        Object.keys(validationErrors).forEach(key => {
            errors[key] = validationErrors[key][0];
        });
    } else {
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
    
    fetchRoles();
    
    if (isEditMode.value) {
        fetchUserData();
    }
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
