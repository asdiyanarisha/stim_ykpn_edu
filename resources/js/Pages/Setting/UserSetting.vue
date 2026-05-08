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
              <a href="/dashboard" class="hover:text-indigo-600 transition-colors">Dashboard</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">Pengaturan Akun</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Pengaturan Akun</h1>
            <p class="text-slate-500">Kelola informasi akun dan keamanan Anda.</p>
          </div>
        </div>

        <div class="max-w-4xl mx-auto space-y-6">
          <!-- User Info Section -->
          <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
            <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
              <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
              </span>
              Informasi Akun
            </h2>

            <div class="flex items-center gap-6">
              <div class="w-20 h-20 border-3 border-indigo-200 rounded-2xl overflow-hidden shadow-md flex-shrink-0">
                <img :src="avatarUrl" class="w-full h-full object-cover" alt="Avatar">
              </div>
              <div class="space-y-1">
                <p class="text-lg font-semibold text-slate-900">{{ userInfo.username || '-' }}</p>
                <p class="text-sm text-slate-500 flex items-center gap-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                  Role ID: {{ userInfo.role_id || '-' }}
                </p>
              </div>
            </div>
          </div>

          <!-- Change Password Section -->
          <form @submit.prevent="handleChangePassword">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-2 flex items-center gap-2">
                <span class="p-2 bg-amber-50 rounded-xl text-amber-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </span>
                Ubah Password
              </h2>
              <p class="text-sm text-slate-500 mb-6">Untuk keamanan akun, gunakan password yang kuat dan unik.</p>

              <div class="space-y-5">
                <!-- Current Password -->
                <div>
                  <label for="current-password" class="block text-sm font-medium text-slate-700 mb-1.5">Password Saat Ini</label>
                  <div class="relative">
                    <input
                      :type="showCurrentPassword ? 'text' : 'password'"
                      v-model="passwordForm.current_password"
                      id="current-password"
                      placeholder="Masukkan password saat ini"
                      class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all pr-10"
                      :class="{ 'border-red-400 focus:ring-red-400': errors.current_password }"
                    >
                    <button type="button" @click="showCurrentPassword = !showCurrentPassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600">
                      <svg v-if="!showCurrentPassword" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                      <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                  </div>
                  <p v-if="errors.current_password" class="mt-1 text-xs text-red-500">{{ errors.current_password }}</p>
                </div>

                <div class="h-px bg-slate-100"></div>

                <!-- New Password -->
                <div>
                  <label for="new-password" class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru</label>
                  <div class="relative">
                    <input
                      :type="showNewPassword ? 'text' : 'password'"
                      v-model="passwordForm.new_password"
                      id="new-password"
                      placeholder="Masukkan password baru (min. 8 karakter)"
                      class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-300 pr-10"
                      :class="newPasswordInputClass"
                    >
                    <button type="button" @click="showNewPassword = !showNewPassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600">
                      <svg v-if="!showNewPassword" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                      <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                  </div>
                  <p v-if="errors.new_password" class="mt-1 text-xs text-red-500">{{ errors.new_password }}</p>
                </div>

                <!-- Confirm New Password -->
                <div>
                  <label for="confirm-password" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                  <div class="relative">
                    <input
                      :type="showConfirmPassword ? 'text' : 'password'"
                      v-model="passwordForm.new_password_confirmation"
                      id="confirm-password"
                      placeholder="Ulangi password baru"
                      class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-300 pr-10"
                      :class="[confirmPasswordInputClass, { 'animate-shake': shakeConfirm }]"
                    >
                    <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600">
                      <svg v-if="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                      <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                    </button>
                  </div>

                  <!-- Real-time Password Match Validation -->
                  <transition
                    enter-active-class="transition-all duration-300 ease-out"
                    enter-from-class="opacity-0 -translate-y-2 max-h-0"
                    enter-to-class="opacity-100 translate-y-0 max-h-10"
                    leave-active-class="transition-all duration-200 ease-in"
                    leave-from-class="opacity-100 translate-y-0 max-h-10"
                    leave-to-class="opacity-0 -translate-y-2 max-h-0"
                  >
                    <div v-if="passwordForm.new_password_confirmation && passwordForm.new_password" class="mt-2">
                      <!-- Mismatch -->
                      <div v-if="!passwordsMatch" class="flex items-center gap-1.5 text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0 animate-bounce-once" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        <span class="text-xs font-medium">Password tidak cocok</span>
                      </div>
                      <!-- Match -->
                      <div v-else class="flex items-center gap-1.5 text-emerald-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="text-xs font-medium">Password cocok</span>
                      </div>
                    </div>
                  </transition>

                  <p v-if="errors.new_password_confirmation" class="mt-1 text-xs text-red-500">{{ errors.new_password_confirmation }}</p>
                </div>

                <!-- Password Strength Indicator -->
                <div v-if="passwordForm.new_password" class="space-y-2">
                  <div class="flex gap-1">
                    <div class="h-1.5 flex-1 rounded-full transition-all duration-300" :class="passwordStrength >= 1 ? strengthColor : 'bg-slate-200'"></div>
                    <div class="h-1.5 flex-1 rounded-full transition-all duration-300" :class="passwordStrength >= 2 ? strengthColor : 'bg-slate-200'"></div>
                    <div class="h-1.5 flex-1 rounded-full transition-all duration-300" :class="passwordStrength >= 3 ? strengthColor : 'bg-slate-200'"></div>
                    <div class="h-1.5 flex-1 rounded-full transition-all duration-300" :class="passwordStrength >= 4 ? strengthColor : 'bg-slate-200'"></div>
                  </div>
                  <p class="text-xs" :class="strengthTextColor">{{ strengthText }}</p>
                </div>
              </div>
            </div>

            <!-- Bottom Actions -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-end gap-4 mt-6">
              <AppButton variant="primary" size="md" type="submit" :disabled="isSubmitting">
                <svg v-if="isSubmitting" class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <svg v-if="!isSubmitting" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ isSubmitting ? 'Menyimpan...' : 'Ubah Password' }}
              </AppButton>
            </div>
          </form>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted, watch } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../Components/Atoms/AppButton.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isSubmitting = ref(false);
const isLoading = ref(false);
const errors = reactive({});

const showCurrentPassword = ref(false);
const showNewPassword = ref(false);
const showConfirmPassword = ref(false);
const shakeConfirm = ref(false);

const userInfo = reactive({
  username: '',
  role_id: '',
});

const passwordForm = reactive({
  current_password: '',
  new_password: '',
  new_password_confirmation: '',
});

const avatarUrl = computed(() => {
  const name = userInfo.username || 'User';
  return `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=6366f1&color=fff&size=128`;
});

// Password strength calculator
const passwordStrength = computed(() => {
  const pw = passwordForm.new_password;
  if (!pw) return 0;
  let score = 0;
  if (pw.length >= 8) score++;
  if (/[A-Z]/.test(pw)) score++;
  if (/[0-9]/.test(pw)) score++;
  if (/[^A-Za-z0-9]/.test(pw)) score++;
  return score;
});

const strengthColor = computed(() => {
  const colors = { 1: 'bg-red-400', 2: 'bg-amber-400', 3: 'bg-blue-400', 4: 'bg-emerald-400' };
  return colors[passwordStrength.value] || 'bg-slate-200';
});

const strengthTextColor = computed(() => {
  const colors = { 1: 'text-red-500', 2: 'text-amber-500', 3: 'text-blue-500', 4: 'text-emerald-500' };
  return colors[passwordStrength.value] || 'text-slate-400';
});

const strengthText = computed(() => {
  const texts = { 0: '', 1: 'Lemah', 2: 'Cukup', 3: 'Kuat', 4: 'Sangat Kuat' };
  return texts[passwordStrength.value] || '';
});

// Real-time password match
const passwordsMatch = computed(() => {
  return passwordForm.new_password === passwordForm.new_password_confirmation;
});

// Dynamic input classes based on match status
const newPasswordInputClass = computed(() => {
  if (errors.new_password) return 'border-red-400 focus:ring-red-400';
  if (passwordForm.new_password && passwordForm.new_password_confirmation) {
    return passwordsMatch.value
      ? 'border-emerald-400 focus:ring-emerald-400'
      : 'border-red-400 focus:ring-red-400';
  }
  return 'border-slate-200 focus:ring-indigo-500';
});

const confirmPasswordInputClass = computed(() => {
  if (errors.new_password_confirmation) return 'border-red-400 focus:ring-red-400';
  if (passwordForm.new_password_confirmation && passwordForm.new_password) {
    return passwordsMatch.value
      ? 'border-emerald-400 focus:ring-emerald-400'
      : 'border-red-400 focus:ring-red-400';
  }
  return 'border-slate-200 focus:ring-indigo-500';
});

// Shake animation on mismatch when user types in confirm field
watch(() => passwordForm.new_password_confirmation, (newVal) => {
  if (newVal && passwordForm.new_password && newVal !== passwordForm.new_password) {
    shakeConfirm.value = true;
    setTimeout(() => { shakeConfirm.value = false; }, 500);
  }
});

const fetchUserInfo = async () => {
  isLoading.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.get('/api/auth/me', {
      headers: { Authorization: `Bearer ${token}` }
    });

    if (response.data.status === 'success' && response.data.data) {
      userInfo.username = response.data.data.username || '';
      userInfo.role_id = response.data.data.role_id || '';
    }
  } catch (error) {
    console.error('Error fetching user info:', error);
  } finally {
    isLoading.value = false;
  }
};

const handleChangePassword = async () => {
  // Clear errors
  Object.keys(errors).forEach(key => errors[key] = '');

  // Client-side validation
  let hasError = false;

  if (!passwordForm.current_password) {
    errors.current_password = 'Password saat ini harus diisi.';
    hasError = true;
  }

  if (!passwordForm.new_password) {
    errors.new_password = 'Password baru harus diisi.';
    hasError = true;
  } else if (passwordForm.new_password.length < 8) {
    errors.new_password = 'Password baru minimal 8 karakter.';
    hasError = true;
  }

  if (!passwordForm.new_password_confirmation) {
    errors.new_password_confirmation = 'Konfirmasi password harus diisi.';
    hasError = true;
  } else if (passwordForm.new_password !== passwordForm.new_password_confirmation) {
    errors.new_password_confirmation = 'Konfirmasi password tidak cocok.';
    hasError = true;
  }

  if (hasError) return;

  isSubmitting.value = true;

  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const response = await axios.post('/api/auth/change-password', passwordForm, {
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
      // Reset form
      passwordForm.current_password = '';
      passwordForm.new_password = '';
      passwordForm.new_password_confirmation = '';
    }
  } catch (error) {
    console.error('Error changing password:', error);
    const message = error.response?.data?.message || 'Terjadi kesalahan saat mengubah password.';
    Swal.fire({ icon: 'error', title: 'Gagal', text: message, confirmButtonColor: '#4f46e5' });

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
    fetchUserInfo();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
