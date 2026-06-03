<template>
  <div
    class="min-h-screen bg-slate-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8"
  >
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
      <!-- Logo -->
      <div class="flex justify-center mb-6">
        <img :src="'/images/LOGO%20STIM%20YPKN.png'" alt="Logo STIM YKPN" class="h-24 hover:scale-105 transition-transform duration-300">
      </div>
      <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
        Selamat Datang Kembali
      </h2>
      <p class="mt-2 text-sm text-slate-600">
        Masuk ke akun Anda untuk mengelola STIM YKPN
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div
        class="bg-white py-8 px-4 shadow-xl shadow-slate-200/50 sm:rounded-2xl sm:px-10 border border-slate-100"
      >
        <form class="space-y-6" @submit.prevent="handleLogin">
          <!-- Error Message -->
          <div
            v-if="errorMessage"
            class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ errorMessage }}
          </div>

          <AppInput
            id="username"
            label="Username atau Email"
            v-model="form.username"
            placeholder="Masukkan username Anda"
            required
          >
            <template #icon>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                />
              </svg>
            </template>
          </AppInput>

          <div class="space-y-1">
            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
            <div class="relative">
              <!-- Lock icon -->
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                  />
                </svg>
              </div>
              <!-- Password input -->
              <input
                id="password"
                :type="showPassword ? 'text' : 'password'"
                v-model="form.password"
                placeholder="••••••••"
                required
                class="block w-full border border-slate-200 rounded-xl shadow-sm sm:text-sm transition-all duration-200 py-2.5 pl-10 pr-10 focus:border-indigo-500 focus:ring-indigo-500 bg-white"
              />
              <!-- Toggle show/hide password button -->
              <button
                type="button"
                @click="showPassword = !showPassword"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-indigo-500 transition-colors duration-200 focus:outline-none"
                :title="showPassword ? 'Sembunyikan password' : 'Tampilkan password'"
              >
                <!-- Eye icon (password visible) -->
                <svg
                  v-if="showPassword"
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                  />
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                  />
                </svg>
                <!-- Eye-off icon (password hidden) -->
                <svg
                  v-else
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"
                  />
                </svg>
              </button>
            </div>
          </div>

          <div>
            <AppButton
              type="submit"
              variant="primary"
              size="lg"
              class="w-full justify-center text-base shadow-lg shadow-indigo-200"
              :loading="loading"
            >
              {{ loading ? "Memproses..." : "Sign In" }}
            </AppButton>
          </div>
        </form>

        <div class="mt-6">
          <div class="relative">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-slate-100"></div>
            </div>
          </div>

          <div class="mt-6 flex flex-col items-center space-y-3 text-sm">
            <p class="text-slate-600 font-medium">
              Lupa kata sandi?
              <a
                href="#"
                class="text-indigo-600 hover:text-indigo-500 transition-colors underline underline-offset-4"
              >
                Klik di sini untuk mereset
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import axios from "axios";
import AppInput from "../Components/Atoms/AppInput.vue";
import AppButton from "../Components/Atoms/AppButton.vue";
import { setCookie, TOKEN_COOKIE_NAME } from "../Helpers/cookie.js";

const loading = ref(false);
const errorMessage = ref("");
const showPassword = ref(false);

const form = reactive({
  username: "",
  password: "",
});

const handleLogin = async () => {
  loading.value = true;
  errorMessage.value = "";

  try {
    const response = await axios.post("/api/auth/login", {
      username: form.username,
      password: form.password,
    });

    const { token, expires_in } = response.data.data;

    // Simpan token ke cookie dengan durasi sesuai JWT expiry
    setCookie(TOKEN_COOKIE_NAME, token, expires_in);

    // Redirect ke dashboard
    window.location.href = "/dashboard";
  } catch (error) {
    if (error.response && error.response.data) {
      errorMessage.value = error.response.data.message;
    } else {
      errorMessage.value = "Terjadi kesalahan jaringan. Silakan coba lagi.";
    }
  } finally {
    loading.value = false;
  }
};
</script>
