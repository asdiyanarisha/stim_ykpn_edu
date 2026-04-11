<template>
  <div
    class="min-h-screen bg-slate-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8"
  >
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
      <!-- Logo placeholder -->
      <div class="flex justify-center mb-6">
        <div
          class="w-16 h-16 bg-gradient-to-tr from-indigo-600 to-violet-500 rounded-2xl shadow-xl flex items-center justify-center transform rotate-12 group hover:rotate-0 transition-transform duration-300"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-10 h-10 text-white"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"
            />
          </svg>
        </div>
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
import AppInput from "../Components/Atoms/AppInput.vue";
import AppButton from "../Components/Atoms/AppButton.vue";

const loading = ref(false);
const form = reactive({
  username: "",
  password: "",
  remember: false,
});

const handleLogin = () => {
  loading.value = true;
  console.log("Logging in with:", form);

  // Simulate API call
  setTimeout(() => {
    loading.value = false;
    alert("Pesan: Implementasi backend diperlukan untuk proses login.");
    window.location.href = "/dashboard";
  }, 1500);
};
</script>
