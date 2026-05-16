<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden font-sans">
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Back Button -->
        <div class="max-w-4xl mx-auto mb-6">
          <button @click="goBack" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors cursor-pointer group">
            <div class="p-1.5 rounded-lg bg-white border border-slate-200 group-hover:border-indigo-100 group-hover:bg-indigo-50 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </div>
            Kembali ke Daftar PMB
          </button>
        </div>

        <!-- Loading Overlay -->
        <transition 
          enter-active-class="transition duration-300 ease-out" 
          enter-from-class="opacity-0" 
          enter-to-class="opacity-100" 
          leave-active-class="transition duration-200 ease-in" 
          leave-from-class="opacity-100" 
          leave-to-class="opacity-0"
        >
          <div v-if="!isAuthenticated || isLoading" class="absolute inset-0 z-[60] bg-slate-50/80 backdrop-blur-sm flex items-center justify-center">
              <div class="flex flex-col items-center">
                  <div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin mb-4"></div>
                  <p class="text-slate-500 font-medium animate-pulse">Memuat Data...</p>
              </div>
          </div>
        </transition>

        <div v-if="form.id" class="max-w-4xl mx-auto space-y-6 pb-12">
          <!-- Header Card -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
            <h1 class="text-2xl font-extrabold text-slate-900 mb-2">Edit Data Pendaftar</h1>
            <p class="text-slate-500">Ubah informasi pendaftaran mahasiswa baru di bawah ini.</p>
          </div>

          <!-- Form Grid -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <form @submit.prevent="submitForm">
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    
                    <div class="space-y-1 md:col-span-2">
                        <label class="text-sm font-bold text-slate-700">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <AppInput v-model="form.nama_lengkap" placeholder="Masukkan nama lengkap" required />
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700">Email <span class="text-rose-500">*</span></label>
                        <AppInput v-model="form.email" type="email" placeholder="contoh@email.com" required />
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700">Nomor HP / WA <span class="text-rose-500">*</span></label>
                        <AppInput v-model="form.nomor_hp_wa" placeholder="081234567890" required />
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700">Tempat Lahir <span class="text-rose-500">*</span></label>
                        <AppInput v-model="form.tempat_lahir" placeholder="Kota Kelahiran" required />
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700">Tanggal Lahir <span class="text-rose-500">*</span></label>
                        <AppInput v-model="form.tanggal_lahir" type="date" required />
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700 block mb-1">Jenis Kelamin <span class="text-rose-500">*</span></label>
                        <select v-model="form.jenis_kelamin" class="w-full text-sm border border-slate-200 rounded-xl text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-4 bg-slate-50 focus:bg-white transition-colors" required>
                            <option value="" disabled selected>- Pilih Jenis Kelamin -</option>
                            <option value="Laki-laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700 block mb-1">Program Studi <span class="text-rose-500">*</span></label>
                        <select v-model="form.program_studi" class="w-full text-sm border border-slate-200 rounded-xl text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-4 bg-slate-50 focus:bg-white transition-colors" required>
                            <option value="S1 Bisnis Digital">S1 - Bisnis Digital</option>
                            <option value="D3 Manajemen">D3 - Manajemen</option>
                            <option value="S1 Manajemen">S1 - Manajemen</option>
                            <option value="S1 Ekstensi">S1 - Manajemen - Ekstensi (Kelas Karyawan)</option>
                        </select>
                    </div>

                    <div class="space-y-1 md:col-span-2">
                        <label class="text-sm font-bold text-slate-700 block mb-1">Alamat Asal <span class="text-rose-500">*</span></label>
                        <textarea v-model="form.alamat_asal" rows="3" class="w-full text-sm border border-slate-200 rounded-xl text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-4 bg-slate-50 focus:bg-white transition-colors" placeholder="Jalan, RT/RW, Desa, Kecamatan, Kota/Kabupaten, Provinsi" required></textarea>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700">Asal Sekolah <span class="text-rose-500">*</span></label>
                        <AppInput v-model="form.asal_sekolah" placeholder="Nama SMA/SMK/MA Sederajat" required />
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700 block mb-1">Sumber Informasi <span class="text-rose-500">*</span></label>
                        <select v-model="form.sumber_informasi" class="w-full text-sm border border-slate-200 rounded-xl text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-4 bg-slate-50 focus:bg-white transition-colors" required>
                            <option value="Sosial Media">Sosial Media</option>
                            <option value="Teman/Keluarga">Teman/Keluarga</option>
                            <option value="Brosur/Spanduk">Brosur/Spanduk</option>
                            <option value="Website">Website</option>
                            <option value="Alumni STIM YKPN">Alumni STIM YKPN</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700 block mb-1">Jalur Registrasi <span class="text-rose-500">*</span></label>
                        <select v-model="form.jalur_registrasi" class="w-full text-sm border border-slate-200 rounded-xl text-slate-700 focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-4 bg-slate-50 focus:bg-white transition-colors" required>
                            <option value="Reguler">Reguler</option>
                            <option value="Beasiswa">Beasiswa</option>
                            <option value="Undangan">Undangan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-bold text-slate-700">Kode Voucher (Opsional)</label>
                        <AppInput v-model="form.kode_voucher" placeholder="Voucher diskon jika ada" />
                    </div>

                </div>

                <!-- Footer Actions -->
                <div class="bg-slate-50 p-6 flex justify-end gap-3 border-t border-slate-100">
                    <AppButton type="button" variant="secondary" size="md" @click="goBack" :disabled="isSaving">
                        Batal
                    </AppButton>
                    <AppButton type="submit" variant="primary" size="md" :disabled="isSaving">
                        <svg v-if="isSaving" class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        {{ isSaving ? 'Menyimpan...' : 'Simpan Perubahan' }}
                    </AppButton>
                </div>
            </form>
          </div>
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
const isLoading = ref(false);
const isSaving = ref(false);

const form = ref({
    id: null,
    nama_lengkap: '',
    email: '',
    nomor_hp_wa: '',
    tempat_lahir: '',
    tanggal_lahir: '',
    jenis_kelamin: '',
    alamat_asal: '',
    asal_sekolah: '',
    program_studi: '',
    sumber_informasi: '',
    jalur_registrasi: '',
    kode_voucher: ''
});

const pmbId = ref(null);

const fetchPmbDetail = async () => {
  isLoading.value = true;
  try {
    const parts = window.location.pathname.split('/');
    pmbId.value = parts[parts.length - 1];
    const token = getCookie(TOKEN_COOKIE_NAME);
    
    const response = await axios.get(`/api/pmbs/${pmbId.value}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    if (response.data.status === 'success') {
      const data = response.data.data;
      form.value = {
        ...data,
        kode_voucher: data.kode_voucher || ''
      };
    }
  } catch (error) {
    console.error('Error fetching PMB detail:', error);
    if (error.response?.status === 404) {
       window.location.href = '/pmb';
    }
  } finally {
    isLoading.value = false;
  }
};

const submitForm = async () => {
    isSaving.value = true;
    try {
        const token = getCookie(TOKEN_COOKIE_NAME);
        const response = await axios.post(`/api/pmbs/${pmbId.value}`, form.value, {
            headers: { Authorization: `Bearer ${token}` }
        });

        if (response.data.status === 'success') {
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data PMB berhasil diperbarui.',
                timer: 2000,
                showConfirmButton: false
            });
            window.location.href = '/pmb';
        }
    } catch (error) {
        console.error('Error updating PMB:', error);
        
        if (error.response?.status === 422) {
            let errorMsg = '';
            const errors = error.response.data.errors;
            for (let key in errors) {
                errorMsg += `${errors[key][0]}\n`;
            }
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: errorMsg,
                confirmButtonColor: '#d33'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat memperbarui data.',
                confirmButtonColor: '#d33'
            });
        }
    } finally {
        isSaving.value = false;
    }
};

const goBack = () => {
    window.location.href = '/pmb';
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
    fetchPmbDetail();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>
