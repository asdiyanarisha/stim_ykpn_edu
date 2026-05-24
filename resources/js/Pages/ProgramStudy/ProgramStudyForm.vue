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
              <a href="/academic/programs" class="hover:text-indigo-600 transition-colors">Manajemen Program Studi</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">{{ isEditMode ? 'Ubah Program Studi' : 'Tambah Program Studi' }}</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">{{ isEditMode ? 'Ubah Informasi Program Studi' : 'Formulir Program Studi Baru' }}</h1>
            <p class="text-slate-500">{{ isEditMode ? 'Perbarui informasi program studi dan rincian biaya.' : 'Tambahkan program studi baru ke dalam sistem akademik STIM YKPN.' }}</p>
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
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </span>
                Informasi Program & Biaya
              </h2>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Program Name -->
                <div class="md:col-span-2">
                    <AppInput v-model="form.name" label="Nama Program Studi" placeholder="Contoh: Manajemen Perusahaan" id="program-name" :error="errors.name" />
                </div>

                <!-- Grade -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-slate-700">Grade</label>
                    <select 
                        v-model="form.grade" 
                        class="block w-full rounded-xl shadow-sm sm:text-sm transition-all duration-200 py-2.5 pl-4 border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white"
                        :class="{ 'border-rose-500 bg-rose-50': errors.grade }"
                    >
                        <option value="" disabled>Pilih Jenjang</option>
                        <option value="D3">D3</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                    <p v-if="errors.grade" class="text-xs text-rose-600 mt-1">{{ errors.grade }}</p>
                </div>

                <!-- Total SPA Fee -->
                <AppInput v-model="form.spa_fee" label="Total Biaya SPA (Rp)" type="number" placeholder="Contoh: 15000000" id="spa-fee" :error="errors.spa_fee" />

                <!-- Fixed SPA Fee -->
                <AppInput v-model="form.spa_fee_fixed" label="Biaya SPA Tetap (Rp)" type="number" placeholder="Contoh: 10000000" id="spa-fee-fixed" :error="errors.spa_fee_fixed" />

                <!-- Variable SPA Fee -->
                <AppInput v-model="form.spa_fee_variable" label="Biaya SPA Variabel (Rp)" type="number" placeholder="Contoh: 5000000" id="spa-fee-variable" :error="errors.spa_fee_variable" />
              </div>
            </div>

            <!-- Bottom Actions -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center justify-end gap-4">
              <AppButton variant="secondary" size="md" @click="goBack">Batal</AppButton>
              <AppButton variant="primary" size="md" type="submit" :disabled="isSubmitting">
                <svg v-if="isSubmitting" class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <svg v-if="!isSubmitting" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ isSubmitting ? (isEditMode ? 'Menyimpan...' : 'Menambahkan...') : (isEditMode ? 'Simpan Perubahan' : 'Simpan Program Studi') }}
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
const itemId = ref(null);

const form = reactive({
  name: '',
  grade: '',
  spa_fee: 0,
  spa_fee_fixed: 0,
  spa_fee_variable: 0
});

const goBack = () => {
  window.location.href = '/academic/programs';
};

const fetchItemData = async () => {
    isLoading.value = true;
    try {
        const parts = window.location.pathname.split('/');
        itemId.value = parts[parts.length - 1];
        const token = getCookie(TOKEN_COOKIE_NAME);
        
        const response = await axios.get(`/api/program-studies/${itemId.value}`, {
            headers: { Authorization: `Bearer ${token}` }
        });
        
        if (response.data.status === 'success') {
            const data = response.data.data;
            form.name = data.name;
            form.grade = data.grade;
            form.spa_fee = data.spa_fee;
            form.spa_fee_fixed = data.spa_fee_fixed;
            form.spa_fee_variable = data.spa_fee_variable;
        }
    } catch (error) {
        console.error('Error fetching item data:', error);
        Swal.fire({ icon: 'error', title: 'Kesalahan', text: 'Gagal mengambil data program studi.' }).then(() => goBack());
    } finally {
        isLoading.value = false;
    }
};

const handleSubmit = async () => {
  // Clear errors
  Object.keys(errors).forEach(key => errors[key] = '');

  // Validation
  let hasError = false;
  if (!form.name) { errors.name = 'Nama program studi wajib diisi'; hasError = true; }
  if (!form.grade) { errors.grade = 'Grade wajib diisi'; hasError = true; }

  if (hasError) return;

  isSubmitting.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const endpoint = isEditMode.value ? `/api/program-studies/${itemId.value}` : '/api/program-studies';
    
    const response = await axios.post(endpoint, form, {
      headers: { Authorization: `Bearer ${token}` }
    });

    if (response.data.status === 'success') {
      await Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: isEditMode.value ? 'Data berhasil diperbarui.' : 'Data baru berhasil ditambahkan.',
        confirmButtonText: 'Kembali ke Daftar',
        confirmButtonColor: '#4f46e5'
      });
      window.location.href = '/academic/programs';
    }
  } catch (error) {
    console.error('Error submitting data:', error);
    const message = error.response?.data?.message || 'Terjadi kesalahan saat menyimpan data.';
    await Swal.fire({ icon: 'error', title: 'Oops...', text: message });
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
    if (isEditMode.value) fetchItemData();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
