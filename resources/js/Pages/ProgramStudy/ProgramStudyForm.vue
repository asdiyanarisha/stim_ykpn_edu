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
            <p class="text-slate-500">{{ isEditMode ? 'Perbarui informasi program studi, rincian biaya, profil detail, konsentrasi, dan prospek karier.' : 'Tambahkan program studi baru beserta profil lengkapnya ke dalam sistem akademik STIM YKPN.' }}</p>
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
            <!-- Section 1: Informasi Program & Biaya -->
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

                <!-- Slug -->
                <AppInput v-model="form.slug" label="Slug URL" placeholder="Contoh: s1-manajemen" id="slug" :error="errors.slug" />

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

            <!-- Section 2: Metadata & Parameter Akademik -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </span>
                Parameter Akademik & Status
              </h2>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Durasi Studi -->
                <AppInput v-model="form.study_duration" label="Durasi Studi" placeholder="Contoh: 3 Tahun / 6 Semester" id="study-duration" :error="errors.study_duration" />

                <!-- Gelar Lulusan -->
                <AppInput v-model="form.degree_title" label="Gelar Lulusan" placeholder="Contoh: A.Md.E. / S.M." id="degree-title" :error="errors.degree_title" />

                <!-- Jumlah SKS -->
                <AppInput v-model="form.total_sks" label="Total SKS" type="number" placeholder="Contoh: 144" id="total-sks" :error="errors.total_sks" />

                <!-- Akreditasi -->
                <AppInput v-model="form.accreditation" label="Akreditasi" placeholder="Contoh: Unggul / Baik Sekali" id="accreditation" :error="errors.accreditation" />

                <!-- Urutan Tampilan -->
                <AppInput v-model="form.order" label="Urutan Tampilan" type="number" placeholder="Contoh: 0" id="order" :error="errors.order" />

                <!-- Status Aktif -->
                <div class="space-y-1 flex flex-col justify-end pb-2">
                  <span class="block text-sm font-medium text-slate-700 mb-1">Status Publikasi</span>
                  <label class="relative inline-flex items-center cursor-pointer select-none">
                    <input type="checkbox" v-model="form.is_active" class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    <span class="ml-3 text-sm font-semibold" :class="form.is_active ? 'text-indigo-600' : 'text-slate-500'">
                      {{ form.is_active ? 'Aktif (Ditampilkan di Web)' : 'Non-aktif (Disembunyikan)' }}
                    </span>
                  </label>
                </div>
              </div>
            </div>

            <!-- Banner Image Upload Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </span>
                Banner Image
              </h2>

              <div class="flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-3xl p-8 hover:border-indigo-400 hover:bg-indigo-50/30 transition-all group relative overflow-hidden cursor-pointer" @click="$refs.fileInput.click()">
                <input type="file" ref="fileInput" class="hidden" accept="image/*" @change="handleImageUpload">
                
                <template v-if="!imagePreview">
                  <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                  </div>
                  <p class="text-slate-600 font-bold">Pilih Banner Image ke Sini</p>
                  <p class="text-slate-400 text-sm mt-1">Saran: Banner berukuran lebar (Maks. 5MB)</p>
                </template>

                <div v-if="imagePreview" class="w-full rounded-2xl overflow-hidden shadow-lg border border-slate-200 relative">
                  <img :src="imagePreview" class="w-full max-h-60 object-cover">
                  <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                    <span class="px-5 py-2 bg-white text-slate-900 font-bold rounded-xl text-sm shadow-xl">Ganti Foto Banner</span>
                  </div>
                </div>
              </div>
              <p v-if="errors.image" class="text-xs text-rose-500 mt-2 font-medium">{{ errors.image }}</p>
            </div>

            <!-- Section 3: Informasi Profil Detail -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </span>
                Profil Detail Halaman
              </h2>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tagline -->
                <div class="md:col-span-2">
                  <AppInput v-model="form.tagline" label="Tagline / Slogan" placeholder="Contoh: Program Studi dengan Kurikulum Relevan Industri Global" id="tagline" :error="errors.tagline" />
                </div>

                <!-- Deskripsi Program Studi -->
                <div class="md:col-span-2 space-y-1">
                  <label class="block text-sm font-bold text-slate-700 mb-1.5 ml-1">Deskripsi Halaman</label>
                  <div class="quill-editor-wrapper" :class="{ 'quill-error': errors.description }">
                    <QuillEditor 
                      v-model:content="form.description" 
                      contentType="html"
                      :options="editorOptions"
                      style="min-height: 300px;"
                    />
                  </div>
                  <p v-if="errors.description" class="text-xs text-rose-600 mt-1 font-medium ml-1">{{ errors.description }}</p>
                </div>
              </div>
            </div>

            <!-- Section 4: Konsentrasi Program Studi -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                  <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                  </span>
                  Daftar Konsentrasi
                </h2>
                <AppButton type="button" variant="secondary" size="sm" @click="addConcentration">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                  Tambah Konsentrasi
                </AppButton>
              </div>

              <div v-if="form.concentrations.length === 0" class="text-center py-8 border-2 border-dashed border-slate-200 rounded-2xl text-slate-400">
                Belum ada konsentrasi ditambahkan. Silakan klik tombol di atas.
              </div>

              <div v-else class="space-y-4">
                <div v-for="(item, idx) in form.concentrations" :key="idx" class="p-4 bg-slate-50 rounded-2xl border border-slate-200 relative group">
                  <button type="button" @click="removeConcentration(idx)" class="absolute top-4 right-4 text-rose-500 hover:text-rose-700 opacity-60 group-hover:opacity-100 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                  </button>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mr-6">
                    <div>
                      <label class="block text-xs font-semibold text-slate-500 mb-1">Nama Konsentrasi</label>
                      <input 
                        v-model="item.name" 
                        type="text" 
                        required
                        placeholder="Contoh: Digital Bisnis & E-Commerce"
                        class="block w-full rounded-xl text-sm border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2 px-3 shadow-sm"
                      />
                    </div>
                    <div>
                      <label class="block text-xs font-semibold text-slate-500 mb-1">Icon SVG/Lucide (Optional)</label>
                      <input 
                        v-model="item.icon" 
                        type="text" 
                        placeholder="Contoh: Monitor / Activity / Briefcase"
                        class="block w-full rounded-xl text-sm border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2 px-3 shadow-sm"
                      />
                    </div>
                    <div class="md:col-span-2">
                      <label class="block text-xs font-semibold text-slate-500 mb-1">Deskripsi Singkat</label>
                      <textarea 
                        v-model="item.description" 
                        rows="2"
                        placeholder="Jelaskan mengenai konsentrasi ini..."
                        class="block w-full rounded-xl text-sm border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2 px-3 shadow-sm"
                      ></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Section 5: Prospek Karir -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
              <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                  <span class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                  </span>
                  Daftar Prospek Karier Lulusan
                </h2>
                <AppButton type="button" variant="secondary" size="sm" @click="addCareer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                  Tambah Prospek Karier
                </AppButton>
              </div>

              <div v-if="form.careers.length === 0" class="text-center py-8 border-2 border-dashed border-slate-200 rounded-2xl text-slate-400">
                Belum ada prospek karier ditambahkan. Silakan klik tombol di atas.
              </div>

              <div v-else class="space-y-4">
                <div v-for="(item, idx) in form.careers" :key="idx" class="p-4 bg-slate-50 rounded-2xl border border-slate-200 relative group">
                  <button type="button" @click="removeCareer(idx)" class="absolute top-4 right-4 text-rose-500 hover:text-rose-700 opacity-60 group-hover:opacity-100 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                  </button>

                  <div class="grid grid-cols-1 gap-4 mr-6">
                    <div>
                      <label class="block text-xs font-semibold text-slate-500 mb-1">Nama Profesi / Karier</label>
                      <input 
                        v-model="item.title" 
                        type="text" 
                        required
                        placeholder="Contoh: Manajer Operasional / Entrepreneur"
                        class="block w-full rounded-xl text-sm border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2 px-3 shadow-sm"
                      />
                    </div>
                    <div>
                      <label class="block text-xs font-semibold text-slate-500 mb-1">Keterangan / Penjelasan</label>
                      <textarea 
                        v-model="item.description" 
                        rows="2"
                        placeholder="Jelaskan mengenai prospek karier ini..."
                        class="block w-full rounded-xl text-sm border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white py-2 px-3 shadow-sm"
                      ></textarea>
                    </div>
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
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../Components/Atoms/AppButton.vue';
import AppInput from '../../Components/Atoms/AppInput.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const editorOptions = {
  placeholder: 'Tulis deskripsi detail kurikulum, visi misi, atau kompetensi program...',
  theme: 'snow',
  modules: {
    toolbar: [
      [{ header: [1, 2, 3, 4, false] }],
      ['bold', 'italic', 'underline', 'strike'],
      [{ color: [] }, { background: [] }],
      [{ list: 'ordered' }, { list: 'bullet' }],
      [{ align: [] }],
      ['blockquote', 'code-block'],
      ['link', 'image'],
      ['clean']
    ]
  }
};

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const isSubmitting = ref(false);
const isLoading = ref(false);
const errors = reactive({});

const fileInput = ref(null);
const imagePreview = ref(null);

const handleImageUpload = (e) => {
  const file = e.target.files[0];
  if (file) {
    if (file.size > 5 * 1024 * 1024) {
      Swal.fire({ icon: 'warning', title: 'File Terlalu Besar', text: 'Ukuran file maksimal 5MB.', confirmButtonColor: '#4f46e5' });
      return;
    }
    form.image = file;
    const reader = new FileReader();
    reader.onload = (event) => {
      imagePreview.value = event.target.result;
    };
    reader.readAsDataURL(file);
    errors.image = '';
  }
};

const isEditMode = computed(() => window.location.pathname.includes('/edit/'));
const itemId = ref(null);

const form = reactive({
  name: '',
  grade: '',
  slug: '',
  spa_fee: 0,
  spa_fee_fixed: 0,
  spa_fee_variable: 0,
  tagline: '',
  description: '',
  image: null,
  study_duration: '',
  degree_title: '',
  total_sks: 0,
  accreditation: '',
  is_active: true,
  order: 0,
  concentrations: [],
  careers: []
});

const addConcentration = () => {
  form.concentrations.push({ name: '', description: '', icon: '', order: form.concentrations.length });
};

const removeConcentration = (idx) => {
  form.concentrations.splice(idx, 1);
  // Re-adjust order
  form.concentrations.forEach((item, index) => {
    item.order = index;
  });
};

const addCareer = () => {
  form.careers.push({ title: '', description: '', order: form.careers.length });
};

const removeCareer = (idx) => {
  form.careers.splice(idx, 1);
  // Re-adjust order
  form.careers.forEach((item, index) => {
    item.order = index;
  });
};

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
            form.slug = data.slug || '';
            form.spa_fee = data.spa_fee || 0;
            form.spa_fee_fixed = data.spa_fee_fixed || 0;
            form.spa_fee_variable = data.spa_fee_variable || 0;
            form.tagline = data.tagline || '';
            form.description = data.description || '';
            imagePreview.value = data.image_banner || '';
            form.study_duration = data.study_duration || '';
            form.degree_title = data.degree_title || '';
            form.total_sks = data.total_sks || 0;
            form.accreditation = data.accreditation || '';
            form.is_active = data.is_active === 1 || data.is_active === true || data.is_active === '1';
            form.order = data.order || 0;
            form.concentrations = (data.concentrations || []).map((c, i) => ({
              name: c.name,
              description: c.description || '',
              icon: c.icon || '',
              order: c.order ?? i
            }));
            form.careers = (data.careers || []).map((c, i) => ({
              title: c.title,
              description: c.description || '',
              order: c.order ?? i
            }));
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
  if (!form.slug) { errors.slug = 'Slug URL wajib diisi'; hasError = true; }

  if (hasError) return;

  isSubmitting.value = true;
  try {
    const token = getCookie(TOKEN_COOKIE_NAME);
    const endpoint = isEditMode.value ? `/api/program-studies/${itemId.value}` : '/api/program-studies';
    
    const formData = new FormData();
    formData.append('name', form.name || '');
    formData.append('grade', form.grade || '');
    formData.append('slug', form.slug || '');
    formData.append('spa_fee', form.spa_fee || 0);
    formData.append('spa_fee_fixed', form.spa_fee_fixed || 0);
    formData.append('spa_fee_variable', form.spa_fee_variable || 0);
    formData.append('tagline', form.tagline || '');
    formData.append('description', form.description || '');
    formData.append('study_duration', form.study_duration || '');
    formData.append('degree_title', form.degree_title || '');
    formData.append('total_sks', form.total_sks || 0);
    formData.append('accreditation', form.accreditation || '');
    formData.append('is_active', form.is_active ? 1 : 0);
    formData.append('order', form.order || 0);
    formData.append('concentrations', JSON.stringify(form.concentrations || []));
    formData.append('careers', JSON.stringify(form.careers || []));

    if (form.image instanceof File) {
      formData.append('image', form.image);
    }
    
    const response = await axios.post(endpoint, formData, {
      headers: { 
        Authorization: `Bearer ${token}`,
        'Content-Type': 'multipart/form-data'
      }
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
    // Fill validator errors if exists
    if (error.response?.data?.errors) {
      Object.keys(error.response.data.errors).forEach(key => {
        errors[key] = error.response.data.errors[key][0];
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
    if (isEditMode.value) fetchItemData();
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>

<style scoped>
/* Quill Editor Custom Styling */
.quill-editor-wrapper :deep(.ql-toolbar) {
  border: 1px solid #e2e8f0;
  border-top-left-radius: 1.5rem;
  border-top-right-radius: 1.5rem;
  background-color: #f8fafc;
  padding: 12px 16px;
}

.quill-editor-wrapper :deep(.ql-container) {
  border: 1px solid #e2e8f0;
  border-top: none;
  border-bottom-left-radius: 1.5rem;
  border-bottom-right-radius: 1.5rem;
  font-size: 0.938rem;
  font-family: 'Inter', sans-serif;
  color: #334155;
  background-color: white;
}

.quill-editor-wrapper :deep(.ql-editor) {
  min-height: 300px;
  padding: 20px 24px;
  line-height: 1.7;
}

.quill-editor-wrapper :deep(.ql-editor.ql-blank::before) {
  color: #94a3b8;
  font-style: normal;
}

.quill-editor-wrapper :deep(.ql-editor:focus) {
  outline: none;
}

.quill-editor-wrapper:focus-within :deep(.ql-toolbar) {
  border-color: #6366f1;
}

.quill-editor-wrapper:focus-within :deep(.ql-container) {
  border-color: #6366f1;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

/* Error state */
.quill-error :deep(.ql-toolbar) {
  border-color: #f43f5e;
}

.quill-error :deep(.ql-container) {
  border-color: #f43f5e;
  background-color: #fff1f2;
}

.quill-error:focus-within :deep(.ql-toolbar) {
  border-color: #f43f5e;
}

.quill-error:focus-within :deep(.ql-container) {
  border-color: #f43f5e;
  box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.1);
}
</style>

