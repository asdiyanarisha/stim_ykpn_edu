<template>
  <div class="form-page-container">
    <!-- Full Page Loader Overlay -->
    <div v-if="isSubmitting" class="page-loader-overlay">
      <div class="spinner"></div>
      <p>Memproses pendaftaran...</p>
    </div>

    <div class="form-card">
      <div class="form-header">
        <h1>FORMULIR PENDAFTARAN</h1>
      </div>

      <div class="helpdesk-banner">
        <div class="helpdesk-icon">🎧</div>
        <div class="helpdesk-text">
          <strong>Butuh bantuan?</strong><br>
          Tim PMB kami siap membantu proses pendaftaran Anda.
        </div>
        <a href="https://wa.me/6285707010333" class="helpdesk-link" target="_blank" rel="noopener noreferrer">Hubungi Admin WA</a>
      </div>

      <form @submit.prevent="submitForm" class="stim-form">
        <!-- Row 1 -->
        <div class="form-row">
          <div class="form-group form-col-100">
            <label for="nama_lengkap">Nama Lengkap <span style="color: #ef4444;">*</span></label>
            <input type="text" id="nama_lengkap" v-model="form.nama_lengkap" class="form-control" :class="{ 'error-border': errors.nama_lengkap }">
            <span v-if="errors.nama_lengkap" class="error-text">{{ errors.nama_lengkap }}</span>
          </div>
        </div>

        <!-- Row 2 -->
        <div class="form-row">
          <div class="form-group form-col-50">
            <label for="email">Email <span style="color: #ef4444;">*</span></label>
            <input type="email" id="email" v-model="form.email" class="form-control" :class="{ 'error-border': errors.email }">
            <span v-if="errors.email" class="error-text">{{ errors.email }}</span>
          </div>
          <div class="form-group form-col-50">
            <label for="nomor_hp_wa">Nomor HP / WA <span style="color: #ef4444;">*</span></label>
            <input type="tel" id="nomor_hp_wa" v-model="form.nomor_hp_wa" class="form-control" :class="{ 'error-border': errors.nomor_hp_wa }">
            <span v-if="errors.nomor_hp_wa" class="error-text">{{ errors.nomor_hp_wa }}</span>
          </div>
        </div>

        <!-- Row 3 -->
        <div class="form-row">
          <div class="form-group form-col-33">
            <label for="tempat_lahir">Tempat Lahir <span style="color: #ef4444;">*</span></label>
            <input type="text" id="tempat_lahir" v-model="form.tempat_lahir" class="form-control" :class="{ 'error-border': errors.tempat_lahir }">
            <span v-if="errors.tempat_lahir" class="error-text">{{ errors.tempat_lahir }}</span>
          </div>
          <div class="form-group form-col-33">
            <label for="tanggal_lahir">Tanggal Lahir <span style="color: #ef4444;">*</span></label>
            <input type="date" id="tanggal_lahir" v-model="form.tanggal_lahir" class="form-control" placeholder="yyyy-mm-dd" :class="{ 'error-border': errors.tanggal_lahir }">
            <span v-if="errors.tanggal_lahir" class="error-text">{{ errors.tanggal_lahir }}</span>
          </div>
          <div class="form-group form-col-33">
            <label for="jenis_kelamin">Jenis Kelamin <span style="color: #ef4444;">*</span></label>
            <select id="jenis_kelamin" v-model="form.jenis_kelamin" class="form-control" :class="{ 'error-border': errors.jenis_kelamin }">
              <option value="" disabled selected>- Pilih Jenis Kelamin -</option>
              <option value="Laki-laki">Laki-Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
            <span v-if="errors.jenis_kelamin" class="error-text">{{ errors.jenis_kelamin }}</span>
          </div>
        </div>

        <!-- Row 4 -->
        <div class="form-row">
          <div class="form-group form-col-100">
            <label for="alamat_asal">Alamat Asal <span style="color: #ef4444;">*</span></label>
            <textarea id="alamat_asal" v-model="form.alamat_asal" class="form-control" :class="{ 'error-border': errors.alamat_asal }"></textarea>
            <span v-if="errors.alamat_asal" class="error-text">{{ errors.alamat_asal }}</span>
          </div>
        </div>

        <!-- Row 5 -->
        <div class="form-row">
          <div class="form-group form-col-50">
            <label for="asal_sekolah">Asal Sekolah <span style="color: #ef4444;">*</span></label>
            <input type="text" id="asal_sekolah" v-model="form.asal_sekolah" class="form-control" :class="{ 'error-border': errors.asal_sekolah }">
            <span v-if="errors.asal_sekolah" class="error-text">{{ errors.asal_sekolah }}</span>
          </div>
          <div class="form-group form-col-50">
            <label for="program_studi">Program Studi (D3 / S1) <span style="color: #ef4444;">*</span></label>
            <select id="program_studi" v-model="form.program_studi" class="form-control" :class="{ 'error-border': errors.program_studi }">
              <option value="" disabled selected>- Pilih Program Studi -</option>
              <option value="D3 Manajemen">D3 - Manajemen</option>
              <option value="S1 Bisnis Digital">S1 - Bisnis Digital</option>
              <option value="S1 Manajemen">S1 - Manajemen</option>
              <option value="S1 Ekstensi">S1 - Manajemen - Ekstensi (Kelas Karyawan)</option>
            </select>
            <span v-if="errors.program_studi" class="error-text">{{ errors.program_studi }}</span>
          </div>
        </div>

        <!-- Row 6 -->
        <div class="form-row">
          <div class="form-group form-col-50">
            <label for="sumber_informasi">Sumber Informasi tentang STIM YKPN <span style="color: #ef4444;">*</span></label>
            <select id="sumber_informasi" v-model="form.sumber_informasi" class="form-control" :class="{ 'error-border': errors.sumber_informasi }">
              <option value="" disabled selected>- Pilih Sumber Info -</option>
              <option value="Sosialisasi di Sekolah">Sosialisasi di Sekolah</option>
              <option value="Brosur">Brosur</option>
              <option value="Instagram">Instagram</option>
              <option value="Facebook">Facebook</option>
              <option value="Tiktok">Tiktok</option>
              <option value="Baliho">Baliho</option>
              <option value="Iklan">Iklan</option>
              <option value="Saudara">Saudara</option>
              <option value="Alumni">Alumni</option>
              <option value="Guru BK">Guru BK</option>
              <option value="Pencarian Google">Pencarian Google</option>
              <option value="Lainnya">Lainnya</option>
            </select>
            <span v-if="errors.sumber_informasi" class="error-text">{{ errors.sumber_informasi }}</span>
          </div>
          <div class="form-group form-col-50">
            <label for="jalur_registrasi">Jalur Registrasi <span style="color: #ef4444;">*</span></label>
            <select id="jalur_registrasi" v-model="form.jalur_registrasi" class="form-control" :class="{ 'error-border': errors.jalur_registrasi }">
              <option value="" disabled selected>- Pilih Jalur -</option>
              <option value="Reguler">Reguler</option>
              <option value="Alih Jalur">Alih Jalur</option>
            </select>
            <span v-if="errors.jalur_registrasi" class="error-text">{{ errors.jalur_registrasi }}</span>
          </div>
        </div>

        <!-- Row 7 -->
        <div class="form-row">
          <div class="form-group form-col-100">
            <label for="kode_voucher">Kode Voucher</label>
            <input type="text" id="kode_voucher" v-model="form.kode_voucher" class="form-control" placeholder="Opsional">
          </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="form-row">
          <div class="form-group form-col-100 checkbox-group">
            <label class="custom-checkbox">
              <input type="checkbox" id="agreement" v-model="form.agreement">
              <span class="checkmark"></span>
              <span class="checkbox-text" :style="errors.agreement === 'error' ? 'color: #ef4444; font-weight: 700;' : ''">
                Saya menyatakan bahwa seluruh data yang saya isikan di atas adalah benar dan dapat dipertanggungjawabkan sesuai peraturan akademik STIM YKPN.
              </span>
            </label>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-submit" :disabled="isSubmitting" style="display: flex; align-items: center; justify-content: center;">
          <svg v-if="isSubmitting" class="loader-spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" style="opacity: 0.25;"></circle>
            <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" style="opacity: 0.75;"></path>
          </svg>
          <span>{{ isSubmitting ? 'Mengirim...' : 'Submit' }}</span>
        </button>

      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import Swal from 'sweetalert2';
import axios from 'axios';

const form = ref({
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
  kode_voucher: '',
  agreement: false
});

const errors = ref({});
const isSubmitting = ref(false);

// Hapus pesan error secara real-time saat user mengetik
watch(() => form.value, (newForm) => {
  if (errors.value.nama_lengkap && newForm.nama_lengkap.trim() !== '') delete errors.value.nama_lengkap;
  if (errors.value.email && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(newForm.email)) delete errors.value.email;
  if (errors.value.nomor_hp_wa && newForm.nomor_hp_wa.length >= 10) delete errors.value.nomor_hp_wa;
  if (errors.value.tempat_lahir && newForm.tempat_lahir.trim() !== '') delete errors.value.tempat_lahir;
  if (errors.value.tanggal_lahir && newForm.tanggal_lahir !== '') delete errors.value.tanggal_lahir;
  if (errors.value.jenis_kelamin && newForm.jenis_kelamin !== '') delete errors.value.jenis_kelamin;
  if (errors.value.alamat_asal && newForm.alamat_asal.trim() !== '') delete errors.value.alamat_asal;
  if (errors.value.asal_sekolah && newForm.asal_sekolah.trim() !== '') delete errors.value.asal_sekolah;
  if (errors.value.program_studi && newForm.program_studi !== '') delete errors.value.program_studi;
  if (errors.value.sumber_informasi && newForm.sumber_informasi !== '') delete errors.value.sumber_informasi;
  if (errors.value.jalur_registrasi && newForm.jalur_registrasi !== '') delete errors.value.jalur_registrasi;
  if (errors.value.agreement === 'error' && newForm.agreement === true) delete errors.value.agreement;
}, { deep: true });

const validateForm = () => {
  let isValid = true;
  errors.value = {}; // Reset errors

  const requiredFields = {
    nama_lengkap: 'Nama Lengkap wajib diisi',
    email: 'Email wajib diisi',
    nomor_hp_wa: 'Nomor HP/WA wajib diisi',
    tempat_lahir: 'Tempat Lahir wajib diisi',
    tanggal_lahir: 'Tanggal Lahir wajib diisi',
    jenis_kelamin: 'Jenis Kelamin wajib dipilih',
    alamat_asal: 'Alamat Asal wajib diisi',
    asal_sekolah: 'Asal Sekolah wajib diisi',
    program_studi: 'Program Studi wajib dipilih',
    sumber_informasi: 'Sumber Informasi wajib dipilih',
    jalur_registrasi: 'Jalur Registrasi wajib dipilih'
  };

  for (const [key, message] of Object.entries(requiredFields)) {
    if (!form.value[key] || String(form.value[key]).trim() === '') {
      errors.value[key] = message;
      isValid = false;
    }
  }

  // Validasi format email sederhana
  if (form.value.email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.value.email)) {
    errors.value.email = 'Format email tidak valid';
    isValid = false;
  }

  // Validasi nomor telepon minimal 10 digit
  if (form.value.nomor_hp_wa && form.value.nomor_hp_wa.length < 10) {
    errors.value.nomor_hp_wa = 'Nomor HP/WA minimal 10 digit';
    isValid = false;
  }

  if (!form.value.agreement) {
    errors.value.agreement = 'error';
    isValid = false;
    Swal.fire({
      icon: 'warning',
      title: 'Perhatian',
      text: 'Anda harus menyetujui pernyataan kebenaran data.',
      confirmButtonColor: '#004b93'
    });
  }

  return isValid;
};

const submitForm = async () => {
  if (!validateForm()) {
    // Scroll and focus to the first error
    const errorKeys = Object.keys(errors.value);
    if (errorKeys.length > 0) {
      const firstErrorKey = errorKeys[0];
      const el = document.getElementById(firstErrorKey);
      if (el) {
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        el.focus();
      }
    }
    return;
  }

  isSubmitting.value = true;

  try {
    const payload = { ...form.value };
    if (!payload.kode_voucher) {
        payload.kode_voucher = null; // Matches old behavior
    }

    const response = await axios.post('/api/pmb/register', payload);

    if (response.status === 200 || response.status === 201) {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: response.data.message || 'Pendaftaran Mahasiswa Baru berhasil disubmit!',
        confirmButtonColor: '#f18721'
      });
      
      // Reset form
      Object.keys(form.value).forEach(key => {
        if (key === 'agreement') {
          form.value[key] = false;
        } else {
          form.value[key] = '';
        }
      });
      errors.value = {};
    }
  } catch (error) {
    console.error(error);
    if (error.response && error.response.status === 422) {
      const serverErrors = error.response.data.errors;
      let errorMsg = '';
      for (let key in serverErrors) {
        errorMsg += `${serverErrors[key][0]}\n`;
        errors.value[key] = serverErrors[key][0]; // Map to input fields
      }
      
      Swal.fire({
        icon: 'error',
        title: 'Validasi Gagal',
        text: errorMsg,
        confirmButtonColor: '#d33'
      }).then(() => {
        // Auto-focus after alert closes for server-side errors
        const errorKeys = Object.keys(errors.value);
        if (errorKeys.length > 0) {
          const firstErrorKey = errorKeys[0];
          const el = document.getElementById(firstErrorKey);
          if (el) {
            el.scrollIntoView({ behavior: 'smooth', block: 'center' });
            el.focus();
          }
        }
      });
      
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: error.response?.data?.message || 'Terjadi kesalahan pada server.',
        confirmButtonColor: '#d33'
      });
    }
  } finally {
    isSubmitting.value = false;
  }
};
</script>

<style scoped>
/* Full Page Loader */
.page-loader-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgba(255, 255, 255, 0.85);
  z-index: 99999;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  backdrop-filter: blur(4px);
}

.page-loader-overlay .spinner {
  border: 4px solid rgba(0, 75, 147, 0.1);
  width: 56px;
  height: 56px;
  border-radius: 50%;
  border-left-color: #f18721; /* Orange STIM */
  animation: spin 1s linear infinite;
  margin-bottom: 16px;
}

.page-loader-overlay p {
  font-weight: 700;
  color: #004b93;
  font-size: 18px;
  margin: 0;
  letter-spacing: 0.5px;
}

.loader-spinner {
  animation: spin 1s linear infinite;
  height: 20px;
  width: 20px;
  margin-right: 8px;
}

@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

.error-text {
  color: #ef4444;
  font-size: 0.75rem;
  margin-top: 0.25rem;
  display: block;
}

.error-border {
  border-color: #ef4444 !important;
}

.error-border:focus {
  box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important;
}

.form-page-container {
  max-width: 900px;
  margin: -60px auto 100px;
  /* Negative top margin to overlap header */
  padding: 0 20px;
  position: relative;
  z-index: 10;
}

/* Form Card with Accent */
.form-card {
  background: #ffffff;
  border-radius: 20px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
  padding: 60px;
  border-top: 6px solid var(--orange-500, #f97316);
  position: relative;
}

/* ORNAMENT: Watermark Logo inside card */
.form-card::after {
  content: '';
  position: absolute;
  bottom: 20px;
  right: 20px;
  width: 200px;
  height: 200px;
  background-image: url('/images/img/logo/logo-stim-new.png');
  background-size: contain;
  background-repeat: no-repeat;
  background-position: bottom right;
  opacity: 0.03;
  pointer-events: none;
}

.form-header {
  text-align: center;
  margin-bottom: 48px;
}

.form-header h1 {
  font-size: 30px;
  font-weight: 800;
  color: var(--navy-900, #004b93);
  margin-bottom: 8px;
  letter-spacing: -0.5px;
}

/* Form Layout Grid */
.stim-form {
  display: flex;
  flex-direction: column;
  gap: 24px;
  position: relative;
  z-index: 2;
}

.form-row {
  display: flex;
  gap: 24px;
  width: 100%;
}

.form-col-100 {
  flex: 1;
  width: 100%;
}

.form-col-50 {
  flex: 1;
  width: calc(50% - 12px);
}

.form-col-33 {
  flex: 1;
  width: calc(33.333% - 16px);
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.form-group label {
  font-size: 14px;
  color: #334155;
  font-weight: 600;
}

.form-control {
  width: 100%;
  height: 52px;
  padding: 0 16px;
  background-color: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 14px;
  color: #1e293b;
  outline: none;
  transition: all 0.2s ease;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.01);
}

textarea.form-control {
  height: auto;
  min-height: 120px;
  padding: 16px;
  resize: vertical;
}

.form-control:hover {
  border-color: #cbd5e1;
  background-color: #f1f5f9;
}

.form-control:focus {
  background-color: #ffffff;
  border-color: var(--blue-500, #3b82f6);
  box-shadow: 0 0 0 4px rgba(0, 75, 147, 0.1);
}

select.form-control {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 16px center;
  cursor: pointer;
}

.btn-submit {
  width: 100%;
  height: 56px;
  background-color: #f18721;
  color: #ffffff;
  font-size: 16px;
  font-weight: 800;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  margin-top: 16px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(241, 135, 33, 0.3);
  animation: formSubmitPulse 2s infinite;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.btn-submit:hover:not(:disabled) {
  background-color: #d9771a;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(241, 135, 33, 0.5);
}

.btn-submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  animation: none;
}

@keyframes formSubmitPulse {
  0% {
    box-shadow: 0 0 0 0 rgba(241, 135, 33, 0.4);
  }
  70% {
    box-shadow: 0 0 0 12px rgba(241, 135, 33, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(241, 135, 33, 0);
  }
}

/* Helpdesk Banner */
.helpdesk-banner {
  display: flex;
  align-items: center;
  gap: 16px;
  background: #eff6ff;
  border: 1px solid #bfdbfe;
  padding: 16px 20px;
  border-radius: 12px;
  margin-bottom: 32px;
}

.helpdesk-icon {
  font-size: 24px;
  background: #dbeafe;
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
}

.helpdesk-text {
  flex: 1;
  font-size: 14px;
  color: #1e3a8a;
  line-height: 1.4;
}

.helpdesk-link {
  background: #25D366;
  color: white;
  text-decoration: none;
  padding: 10px 16px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 700;
  transition: background 0.3s;
}

.helpdesk-link:hover {
  background: #1ebc5a;
}

/* Checkbox Styling */
.checkbox-group {
  margin-top: 8px;
  margin-bottom: 8px;
}

.custom-checkbox {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  cursor: pointer;
  user-select: none;
}

.custom-checkbox input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

.checkmark {
  display: block;
  flex-shrink: 0;
  width: 24px;
  height: 24px;
  background-color: #f8fafc;
  border: 2px solid #cbd5e1;
  border-radius: 6px;
  position: relative;
  transition: all 0.2s ease;
  margin-top: 2px;
}

.custom-checkbox:hover input~.checkmark {
  border-color: #0060ba;
}

.custom-checkbox input:checked~.checkmark {
  background-color: #004b93;
  border-color: #004b93;
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
  left: 7px;
  top: 3px;
  width: 6px;
  height: 12px;
  border: solid white;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}

.custom-checkbox input:checked~.checkmark:after {
  display: block;
}

.checkbox-text {
  font-size: 14px;
  color: #475569;
  line-height: 1.5;
}

@media (max-width: 768px) {
  .form-row {
    flex-direction: column;
    gap: 20px;
  }

  .form-col-50,
  .form-col-33 {
    width: 100%;
  }

  .helpdesk-banner {
    flex-direction: column;
    text-align: center;
  }

  .helpdesk-link {
    width: 100%;
    text-align: center;
  }

  .form-card {
    padding: 40px 24px;
  }
}
</style>
