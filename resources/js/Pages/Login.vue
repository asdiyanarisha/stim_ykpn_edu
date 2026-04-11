<template>
  <div
    class="min-h-screen bg-slate-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8"
  >
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
      <!-- Logo -->
      <div class="flex justify-center mb-6">
        <img src="https://stimykpn.ac.id/storage/quill-upload/19827f3a460e91d1ccb121b2a810d720.webp" alt="Logo STIM YKPN" class="h-24 hover:scale-105 transition-transform duration-300">
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
            <AppInput
              id="password"
              label="Password"
              type="password"
              v-model="form.password"
              placeholder="••••••••"
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
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                  />
                </svg>
              </template>
            </AppInput>
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
