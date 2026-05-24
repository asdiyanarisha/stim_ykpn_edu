<template>
  <div class="min-h-screen bg-slate-50 flex flex-col items-center justify-center px-4">
    <!-- Icon -->
    <div class="mb-8">
      <div class="w-24 h-24 bg-gradient-to-br from-rose-100 to-rose-50 rounded-full flex items-center justify-center shadow-lg shadow-rose-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
      </div>
    </div>

    <!-- Content -->
    <div class="text-center max-w-md">
      <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-3">
        Sesi Anda Berakhir
      </h1>
      <p class="text-slate-500 text-base leading-relaxed mb-8">
        Token autentikasi Anda tidak valid atau sudah kadaluarsa.
        Silakan login kembali untuk melanjutkan akses ke dashboard.
      </p>

      <!-- Actions -->
      <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
        <a
          href="/login"
          class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 active:scale-95 w-full sm:w-auto"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
          </svg>
          Kembali ke Login
        </a>
      </div>
    </div>

    <!-- Footer -->
    <p class="mt-12 text-xs text-slate-400">
      &copy; {{ new Date().getFullYear() }} STIM YKPN. All rights reserved.
    </p>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { deleteCookie, TOKEN_COOKIE_NAME } from '../Helpers/cookie.js';

// Pastikan cookie dihapus saat halaman ini dimuat
onMounted(() => {
  deleteCookie(TOKEN_COOKIE_NAME);
});
</script>
