<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden">
    <!-- Sidebar -->
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <main ref="mainScroll" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Toast -->
        <div
          v-if="toast.show"
          :class="[
            'fixed top-5 right-5 z-50 min-w-[280px] max-w-md px-4 py-3 rounded-xl shadow-lg text-sm font-medium border',
            toast.type === 'success'
              ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
              : 'bg-rose-50 text-rose-700 border-rose-200'
          ]"
        >
          <div class="flex items-start justify-between gap-3">
            <span>{{ toast.message }}</span>
            <button @click="toast.show = false" class="text-slate-400 hover:text-slate-600">✕</button>
          </div>
        </div>
        <!-- Header Section -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
              <a href="/masterData/teacher" class="hover:text-indigo-600 transition-colors">Data Dosen</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">Ubah Data Dosen</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Formulir Ubah Data Dosen</h1>
            <p class="text-slate-500">Lengkapi informasi dosen secara lengkap per bagian.</p>
          </div>
          <div class="flex items-center gap-3">
            <AppButton variant="secondary" size="md" @click="goBack">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
              Kembali
            </AppButton>
          </div>
        </div>

        <!-- Step Indicator -->
        <div class="mb-8">
          <div class="flex items-center justify-between max-w-2xl mx-auto">
            <template v-for="(step, i) in steps" :key="i">
              <button @click="currentStep = i" class="flex flex-col items-center gap-2 group relative">
                <div :class="[
                  'w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 border-2',
                  currentStep === i 
                    ? 'bg-indigo-600 border-indigo-600 text-white shadow-lg shadow-indigo-200 scale-110' 
                    : currentStep > i 
                      ? 'bg-emerald-500 border-emerald-500 text-white' 
                      : 'bg-white border-slate-300 text-slate-400 group-hover:border-indigo-300 group-hover:text-indigo-400'
                ]">
                  <svg v-if="currentStep > i" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                  <span v-else>{{ i + 1 }}</span>
                </div>
                <span :class="['text-xs font-semibold transition-colors whitespace-nowrap', currentStep === i ? 'text-indigo-600' : currentStep > i ? 'text-emerald-600' : 'text-slate-400']">{{ step.label }}</span>
              </button>
              <div v-if="i < steps.length - 1" :class="['flex-1 h-0.5 mx-2 rounded-full transition-all duration-500', currentStep > i ? 'bg-emerald-400' : 'bg-slate-200']"></div>
            </template>
          </div>
        </div>

        <!-- Page Content (3 sections per page) -->
        <transition name="slide" mode="out-in">
          <div :key="currentStep" class="space-y-6">

            <!-- ================================ -->
            <!-- STEP 1: Pribadi, Pendidikan, Matkul -->
            <!-- ================================ -->
            <template v-if="currentStep === 0">
              <!-- 1. Data Pribadi -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-indigo-50/50 to-transparent">
                  <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center text-sm font-bold">1</span>
                    Data Pribadi
                  </h2>
                  <p class="text-sm text-slate-500 mt-1 ml-10">Informasi identitas dasar dosen.</p>
                </div>
                <div class="p-6 space-y-6">
                  <!-- Photo Upload + Name -->
                  <div class="flex flex-col sm:flex-row items-start gap-6">
                    <div class="flex-shrink-0">
                      <input type="file" ref="fotoInput" accept="image/*" class="hidden" @change="handleFotoUpload" />
                      <div @click="$refs.fotoInput.click()" class="w-36 h-36 bg-slate-100 border-2 border-dashed border-slate-300 rounded-2xl flex flex-col items-center justify-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50/30 transition-all group relative overflow-hidden">
                        <img v-if="fotoPreview" :src="fotoPreview" class="absolute inset-0 w-full h-full object-cover" />
                        <template v-if="!fotoPreview">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                          <span class="text-xs text-slate-400 mt-2 group-hover:text-indigo-500 font-medium">Upload Foto</span>
                          <span class="text-[10px] text-slate-300 mt-0.5">JPG, PNG, max 2MB</span>
                        </template>
                        <div v-if="fotoPreview" class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                          <span class="text-white text-xs font-semibold">Ganti Foto</span>
                        </div>
                      </div>
                    </div>
                    <div class="flex-1 space-y-4 w-full">
                      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <AppInput v-model="form.full_name" :error="formErrors.full_name ? formErrors.full_name[0] : ''" label="Nama Lengkap (tanpa gelar)" placeholder="contoh: Budi Santoso" id="full_name" />
                        <div class="space-y-1">
                          <label for="category_teacher_id" class="block text-sm font-medium text-slate-700">Kategori Dosen</label>
                          <select id="category_teacher_id" v-model="form.category_teacher_id" :class="['block w-full border rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4 transition-all duration-200', formErrors.category_teacher_id ? 'border-rose-500 bg-rose-50' : 'border-slate-200 bg-white']">
                            <option :value="null">Pilih Kategori</option>
                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.title }}</option>
                          </select>
                          <p v-if="formErrors.category_teacher_id" class="text-xs text-rose-600 mt-1">{{ formErrors.category_teacher_id[0] }}</p>
                        </div>
                      </div>
                      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <AppInput v-model="form.front_title" label="Gelar Depan" placeholder="contoh: Prof. Dr." id="front_title" />
                        <AppInput v-model="form.back_title" label="Gelar Belakang" placeholder="contoh: S.E., M.M." id="back_title" />
                      </div>
                    </div>
                  </div>
                  <!-- Additional Fields -->
                  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1">
                      <label for="birth_date" class="block text-sm font-medium text-slate-700">Tanggal Lahir</label>
                      <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <input type="date" id="birth_date" v-model="form.birth_date" class="block w-full border rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-10 pr-4 transition-all duration-200" />
                      </div>
                    </div>
                    <AppInput v-model="form.email" :error="formErrors.email ? formErrors.email[0] : ''" label="Alamat Email" placeholder="dosen@stimykpn.ac.id" id="email" />
                    <AppInput v-model="form.phone_number" :error="formErrors.phone_number ? formErrors.phone_number[0] : ''" label="No. Telepon" placeholder="0812xxxxxxxx" id="phone_number" />
                  </div>
                  <div class="space-y-1">
                    <label for="job_title_teacher_id" class="block text-sm font-medium text-slate-700">Jabatan</label>
                    <select id="job_title_teacher_id" v-model="form.job_title_teacher_id" :class="['block w-full border rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4 transition-all duration-200', formErrors.job_title_teacher_id ? 'border-rose-500 bg-rose-50' : 'border-slate-200 bg-white']">
                      <option :value="null">Pilih Jabatan</option>
                      <option v-for="job in jobTitles" :key="job.id" :value="job.id">{{ job.title }}</option>
                    </select>
                    <p v-if="formErrors.job_title_teacher_id" class="text-xs text-rose-600 mt-1">{{ formErrors.job_title_teacher_id[0] }}</p>
                  </div>
                  <div class="space-y-1">
                    <label for="address" class="block text-sm font-medium text-slate-700">Alamat Rumah</label>
                    <textarea id="address" v-model="form.address" rows="4" placeholder="Jl. Contoh No. 123, Kelurahan, Kecamatan, Kota, Provinsi" :class="['block w-full border rounded-xl shadow-sm sm:text-sm py-2.5 pl-4 transition-all duration-200 resize-none', formErrors.address ? 'border-rose-500 focus:border-rose-500 focus:ring-rose-500 bg-rose-50' : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white']"></textarea>
                    <p v-if="formErrors.address" class="text-xs text-rose-600 mt-1">{{ formErrors.address[0] }}</p>
                  </div>
                  <div class="space-y-1">
                    <label for="personal_description" class="block text-sm font-medium text-slate-700">Deskripsi Pribadi</label>
                    <textarea id="personal_description" v-model="form.personal_description" rows="3" placeholder="Tuliskan ringkasan singkat tentang diri Anda, keahlian, dan minat profesional..." class="block w-full border rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4 transition-all duration-200 resize-none"></textarea>
                  </div>
                </div>
              </div>

              <!-- 2. Pendidikan -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-emerald-50/50 to-transparent flex items-center justify-between">
                  <div>
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                      <span class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center text-sm font-bold">2</span>
                      Riwayat Pendidikan
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 ml-10">Riwayat education formal (S1, S2, S3, dll).</p>
                  </div>
                  <AppButton variant="primary" size="sm" @click="addItem('education')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-if="formErrors.education" class="text-xs font-semibold text-rose-600 mb-2">
                    {{ formErrors.education[0] }}
                  </div>
                  <div v-for="(item, i) in form.education" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('education', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Pendidikan {{ i + 1 }}</div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Jenjang</label>
                        <select v-model="item.degree" :class="['block w-full border rounded-xl shadow-sm sm:text-sm py-2.5 pl-4 transition-all duration-200', formErrors[`education.${i}.degree`] ? 'border-rose-500 focus:border-rose-500 focus:ring-rose-500 bg-rose-50' : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white']">
                          <option value="">Pilih degree</option>
                          <option value="D3">D3</option>
                          <option value="S1">S1</option>
                          <option value="S2">S2</option>
                          <option value="S3">S3</option>
                        </select>
                        <p v-if="formErrors[`education.${i}.degree`]" class="text-xs text-rose-600 mt-1">{{ formErrors[`education.${i}.degree`][0] }}</p>
                      </div>
                      <AppInput v-model="item.institution" :error="formErrors[`education.${i}.institution`] ? formErrors[`education.${i}.institution`][0] : ''" label="Institusi" placeholder="Universitas..." />
                      <AppInput v-model="item.major" label="Jurusan / Program Studi" placeholder="Ilmu Komputer..." />
                      <AppInput v-model="item.country" label="Negara" placeholder="Indonesia" />
                      <AppInput v-model="item.graduation_year" label="Tahun Lulus" type="number" placeholder="2020" />
                    </div>
                  </div>
                  <div v-if="form.education.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    Belum ada data education. Klik "Tambah" untuk menambahkan.
                  </div>
                </div>
              </div>

              <!-- 3. Jabatan Profesional -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-orange-50/50 to-transparent flex items-center justify-between">
                  <div>
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                      <span class="w-8 h-8 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center text-sm font-bold">3</span>
                      Jabatan Profesional
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 ml-10">Posisi di perusahaan atau lembaga.</p>
                  </div>
                  <AppButton variant="primary" size="sm" @click="addItem('professional_positions')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-if="formErrors.professional_positions" class="text-xs font-semibold text-rose-600 mb-2">
                    {{ formErrors.professional_positions[0] }}
                  </div>
                  <div v-for="(item, i) in form.professional_positions" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('professional_positions', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                      <AppInput v-model="item.position_name" :error="formErrors[`professional_positions.${i}.position_name`] ? formErrors[`professional_positions.${i}.position_name`][0] : ''" label="Nama Jabatan" placeholder="Komisaris, Ketua..." />
                      <AppInput v-model="item.organization_name" :error="formErrors[`professional_positions.${i}.organization_name`] ? formErrors[`professional_positions.${i}.organization_name`][0] : ''" label="Nama Organisasi / Lembaga" placeholder="PT Contoh..." />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                      <AppInput v-model="item.start_year" label="Tahun Mulai" type="number" placeholder="2018" />
                      <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Tahun Terakhir</label>
                        <input type="number" v-model="item.end_year" :disabled="item.is_current" :class="['block w-full border rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4 transition-all duration-200', item.is_current ? 'bg-slate-100 text-slate-400 cursor-not-allowed' : '']" placeholder="2024" />
                      </div>
                      <div class="flex items-end pb-1">
                        <label class="flex items-center gap-2.5 cursor-pointer select-none group">
                          <input type="checkbox" v-model="item.is_current" @change="item.is_current ? (item.end_year = '') : null" class="w-4.5 h-4.5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer" />
                          <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Masih menjabat saat ini</span>
                        </label>
                      </div>
                    </div>
                    <div class="mt-4 space-y-1">
                      <label class="block text-sm font-medium text-slate-700">Deskripsi Pekerjaan</label>
                      <textarea v-model="item.description" rows="2" placeholder="Jelaskan tanggung jawab dan pencapaian di posisi ini..." class="block w-full border rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4 transition-all duration-200 resize-none"></textarea>
                    </div>
                  </div>
                  <div v-if="form.professional_positions.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    Belum ada jabatan profesional. Klik "Tambah" untuk menambahkan.
                  </div>
                </div>
              </div>
            </template>

            <!-- ================================ -->
            <!-- STEP 2: Riset, Publikasi, Buku   -->
            <!-- ================================ -->
            <template v-if="currentStep === 1">
              <!-- 4. Bidang Riset -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-violet-50/50 to-transparent flex items-center justify-between">
                  <div>
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                      <span class="w-8 h-8 bg-violet-100 text-violet-600 rounded-lg flex items-center justify-center text-sm font-bold">4</span>
                      Bidang Riset
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 ml-10">Topik-topik penelitian yang ditekuni.</p>
                  </div>
                  <AppButton variant="primary" size="sm" @click="addItem('research_areas')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.research_areas" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group flex items-center gap-4">
                    <div class="flex-1">
                      <AppInput v-model="item.area_name" label="Nama Bidang Riset" placeholder="Machine Learning, Data Science..." />
                    </div>
                    <button @click="removeItem('research_areas', i)" class="mt-5 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors flex-shrink-0">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                  </div>
                  <div v-if="form.research_areas.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                    Belum ada bidang riset. Klik "Tambah" untuk menambahkan.
                  </div>
                </div>
              </div>

              <!-- 5. Publikasi -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-amber-50/50 to-transparent flex items-center justify-between">
                  <div>
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                      <span class="w-8 h-8 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center text-sm font-bold">5</span>
                      Publikasi Ilmiah
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 ml-10">Makalah di jurnal ilmiah dan book chapter.</p>
                  </div>
                  <AppButton variant="primary" size="sm" @click="addItem('publications')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.publications" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('publications', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Publikasi {{ i + 1 }}</div>
                    <div class="space-y-4">
                      <AppInput v-model="item.title" label="Judul Publikasi" placeholder="Judul makalah / paper..." />
                      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <AppInput v-model="item.journal_book_name" label="Nama Jurnal / Buku" placeholder="Journal of..." />
                        <div class="space-y-1">
                          <label class="block text-sm font-medium text-slate-700">Jenis</label>
                          <select v-model="item.type" class="block w-full border rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4">
                            <option value="">Pilih type</option>
                            <option value="jurnal">Jurnal</option>
                            <option value="book_chapter">Book Chapter</option>
                            <option value="conference">Conference Paper</option>
                          </select>
                        </div>
                      </div>
                      <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <AppInput v-model="item.volume" label="Volume" placeholder="Vol. 12" />
                        <AppInput v-model="item.pages" label="Halaman" placeholder="pp. 1-15" />
                        <AppInput v-model="item.year" label="Tahun" type="number" placeholder="2024" />
                        <AppInput v-model="item.doi" label="DOI" placeholder="10.1000/xyz" />
                      </div>
                    </div>
                  </div>
                  <div v-if="form.publications.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Belum ada publications. Klik "Tambah" untuk menambahkan.
                  </div>
                </div>
              </div>

              <!-- 6. Buku -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-rose-50/50 to-transparent flex items-center justify-between">
                  <div>
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                      <span class="w-8 h-8 bg-rose-100 text-rose-600 rounded-lg flex items-center justify-center text-sm font-bold">6</span>
                      Buku
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 ml-10">Buku yang diterbitkan oleh dosen.</p>
                  </div>
                  <AppButton variant="primary" size="sm" @click="addItem('books')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.books" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('books', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Buku {{ i + 1 }}</div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                      <AppInput v-model="item.title" label="Judul Buku" placeholder="Judul books..." class="sm:col-span-2" />
                      <AppInput v-model="item.publisher" label="Penerbit" placeholder="Penerbit books..." />
                      <div class="grid grid-cols-2 gap-4">
                        <AppInput v-model="item.year" label="Tahun" type="number" placeholder="2024" />
                        <AppInput v-model="item.isbn" label="ISBN" placeholder="978-..." />
                      </div>
                    </div>
                  </div>
                  <div v-if="form.books.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    Belum ada books. Klik "Tambah" untuk menambahkan.
                  </div>
                </div>
              </div>
            </template>

            <!-- ================================ -->
            <!-- STEP 3: Tulisan, Jabatan, Org    -->
            <!-- ================================ -->
            <template v-if="currentStep === 2">
              <!-- 7. Tulisan Populer -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-cyan-50/50 to-transparent flex items-center justify-between">
                  <div>
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                      <span class="w-8 h-8 bg-cyan-100 text-cyan-600 rounded-lg flex items-center justify-center text-sm font-bold">7</span>
                      Tulisan Populer
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 ml-10">Opini, esai, atau artikel di media massa.</p>
                  </div>
                  <AppButton variant="primary" size="sm" @click="addItem('popular_writings')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.popular_writings" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('popular_writings', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Tulisan {{ i + 1 }}</div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                      <AppInput v-model="item.title" label="Judul Tulisan" placeholder="Judul opini / esai..." class="sm:col-span-2" />
                      <AppInput v-model="item.media" label="Media" placeholder="Kompas, Jakarta Post..." />
                      <AppInput v-model="item.date" label="Tanggal Terbit" type="date" />
                      <AppInput v-model="item.url" label="URL Artikel" placeholder="https://..." class="sm:col-span-2" />
                    </div>
                  </div>
                  <div v-if="form.popular_writings.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                    Belum ada tulisan populer. Klik "Tambah" untuk menambahkan.
                  </div>
                </div>
              </div>

              <!-- 8. Penghargaan -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-yellow-50/50 to-transparent flex items-center justify-between">
                  <div>
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                      <span class="w-8 h-8 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center text-sm font-bold">8</span>
                      Penghargaan
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 ml-10">Penghargaan yang diterima beserta grantor dan tahunnya.</p>
                  </div>
                  <AppButton variant="primary" size="sm" @click="addItem('awards')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.awards" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('awards', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                      <AppInput v-model="item.award_name" label="Nama Penghargaan" placeholder="Best Paper Award..." />
                      <AppInput v-model="item.grantor" label="Pemberi" placeholder="IEEE, ACM..." />
                      <AppInput v-model="item.year" label="Tahun" type="number" placeholder="2024" />
                    </div>
                  </div>
                  <div v-if="form.awards.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                    Belum ada awards. Klik "Tambah" untuk menambahkan.
                  </div>
                </div>
              </div>

              <!-- 9. Profil Akademik Online -->
              <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-pink-50/50 to-transparent flex items-center justify-between">
                  <div>
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                      <span class="w-8 h-8 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center text-sm font-bold">9</span>
                      Profil Akademik Online
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 ml-10">Tautan ke Google Scholar, SINTA, Scopus, dll.</p>
                  </div>
                  <AppButton variant="primary" size="sm" @click="addItem('online_academic_profiles')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.online_academic_profiles" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group flex items-end gap-4">
                    <div class="w-48">
                      <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Platform</label>
                        <select v-model="item.platform_name" class="block w-full border rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4">
                          <option value="">Pilih platform</option>
                          <option value="Google Scholar">Google Scholar</option>
                          <option value="SINTA">SINTA</option>
                          <option value="Scopus">Scopus</option>
                          <option value="ORCID">ORCID</option>
                          <option value="ResearchGate">ResearchGate</option>
                          <option value="Lainnya">Lainnya</option>
                        </select>
                      </div>
                    </div>
                    <div class="flex-1">
                      <AppInput v-model="item.url" label="URL Profil" placeholder="https://scholar.google.com/..." />
                    </div>
                    <button @click="removeItem('online_academic_profiles', i)" class="mb-1 w-9 h-9 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors flex-shrink-0">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                  </div>
                  <div v-if="form.online_academic_profiles.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                    Belum ada profil online. Klik "Tambah" untuk menambahkan.
                  </div>
                </div>
              </div>
            </template>

          </div>
        </transition>

        <!-- Bottom Action Bar -->
        <div class="mt-8 mb-4 bg-white rounded-2xl border border-slate-100 shadow-sm p-4 flex flex-col sm:flex-row items-center justify-between gap-4">
          <div class="flex items-center gap-3">
            <button @click="prevStep" :disabled="currentStep === 0" :class="['inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all', currentStep === 0 ? 'text-slate-300 cursor-not-allowed' : 'text-slate-700 bg-slate-100 hover:bg-slate-200 active:scale-95']">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
              Sebelumnya
            </button>
            <div class="flex items-center gap-1.5 px-3">
              <span v-for="(_, i) in steps" :key="i" :class="['w-2 h-2 rounded-full transition-all duration-300', currentStep === i ? 'bg-indigo-600 w-6' : 'bg-slate-300']"></span>
            </div>
            <button v-if="currentStep < steps.length - 1" @click="nextStep" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-all active:scale-95 shadow-sm shadow-indigo-200">
              Selanjutnya
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
          </div>
          <div class="flex items-center gap-3">
            <AppButton variant="secondary" size="md" @click="goBack">Batal</AppButton>
            <AppButton variant="primary" size="md" @click="handleSubmit">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
              Simpan Semua Data
            </AppButton>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, watch, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../Components/Atoms/AppButton.vue';
import AppInput from '../../Components/Atoms/AppInput.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const mainScroll = ref(null);
const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const currentStep = ref(0);
const formErrors = ref({});
const toast = ref({ show: false, type: 'success', message: '' });
let toastTimer = null;
// Pindahkan wacth ke bawah setelah inisialisasi form
const categories = ref([]);
const jobTitles = ref([]);
const steps = [
  { label: 'Identitas & Akademik' },
  { label: 'Riset & Karya Ilmiah' },
  { label: 'Publikasi Ekstra & Profil' },
];

const fotoPreview = ref(null);
const fotoFile = ref(null);

const handleFotoUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    if (file.size > 2 * 1024 * 1024) {
      alert('Ukuran file maksimal 2MB');
      return;
    }
    fotoFile.value = file;
    const reader = new FileReader();
    reader.onload = (e) => { fotoPreview.value = e.target.result; };
    reader.readAsDataURL(file);
  }
};

const form = reactive({
  full_name: '',
  category_teacher_id: null,
  job_title_teacher_id: null,
  front_title: '',
  back_title: '',
  birth_date: '',
  email: '',
  phone_number: '',
  address: '',
  personal_description: '',
  education: [{ degree: '', institution: '', major: '', country: '', graduation_year: '' }],
  research_areas: [],
  publications: [],
  books: [],
  popular_writings: [],
  professional_positions: [{ position_name: '', organization_name: '', start_year: '', end_year: '', is_current: false, description: '' }],
  awards: [],
  online_academic_profiles: [],
});

const templates = {
  education: () => ({ degree: '', institution: '', major: '', country: '', graduation_year: '' }),
  research_areas: () => ({ area_name: '' }),
  publications: () => ({ title: '', journal_book_name: '', type: '', volume: '', pages: '', year: '', doi: '' }),
  books: () => ({ title: '', publisher: '', year: '', isbn: '' }),
  popular_writings: () => ({ title: '', media: '', date: '', url: '' }),
  professional_positions: () => ({ position_name: '', organization_name: '', start_year: '', end_year: '', is_current: false, description: '' }),
  awards: () => ({ award_name: '', grantor: '', year: '' }),
  online_academic_profiles: () => ({ platform_name: '', url: '' }),
};

const addItem = (key) => { form[key].push(templates[key]()); };
const removeItem = (key, index) => { form[key].splice(index, 1); };

// Otomatis hilangkan pesan error saat pengguna mulai mengetik / mengisi data
watch(form, (newVal) => {
  if (newVal.full_name && formErrors.value.full_name) delete formErrors.value.full_name;
  if (newVal.category_teacher_id && formErrors.value.category_teacher_id) delete formErrors.value.category_teacher_id;
  if (newVal.job_title_teacher_id && formErrors.value.job_title_teacher_id) delete formErrors.value.job_title_teacher_id;
  if (newVal.email && formErrors.value.email) delete formErrors.value.email;
  if (newVal.phone_number && formErrors.value.phone_number) delete formErrors.value.phone_number;
  if (newVal.address && formErrors.value.address) delete formErrors.value.address;
  
  if (newVal.education && newVal.education.length > 0) {
    if (formErrors.value.education) delete formErrors.value.education;
    newVal.education.forEach((edu, idx) => {
      if (edu.degree && formErrors.value[`education.${idx}.degree`]) delete formErrors.value[`education.${idx}.degree`];
      if (edu.institution && formErrors.value[`education.${idx}.institution`]) delete formErrors.value[`education.${idx}.institution`];
    });
  }

  if (newVal.professional_positions && newVal.professional_positions.length > 0) {
    if (formErrors.value.professional_positions) delete formErrors.value.professional_positions;
    newVal.professional_positions.forEach((prof, idx) => {
      if (prof.position_name && formErrors.value[`professional_positions.${idx}.position_name`]) delete formErrors.value[`professional_positions.${idx}.position_name`];
      if (prof.organization_name && formErrors.value[`professional_positions.${idx}.organization_name`]) delete formErrors.value[`professional_positions.${idx}.organization_name`];
    });
  }
}, { deep: true });

const prevStep = () => {
  if (currentStep.value > 0) {
    currentStep.value--;
    if (mainScroll.value) {
      setTimeout(() => {
        mainScroll.value.scrollTo({ top: 0, behavior: 'smooth' });
      }, 50);
    }
  }
};

const nextStep = () => {
  if (currentStep.value < steps.length - 1) {
    currentStep.value++;
    if (mainScroll.value) {
      setTimeout(() => {
        mainScroll.value.scrollTo({ top: 0, behavior: 'smooth' });
      }, 50);
    }
  }
};

const showToast = (type, message) => {
  toast.value = { show: true, type, message };
  if (toastTimer) clearTimeout(toastTimer);
  toastTimer = setTimeout(() => {
    toast.value.show = false;
  }, 3500);
};

const goBack = () => { window.location.href = '/masterData/teacher'; };

const handleSubmit = async () => {
  formErrors.value = {}; // Reset errors

  let hasError = false;

  // Validasi Frontend (Sama dengan kriteria Backend)
  if (!form.full_name) { formErrors.value.full_name = ['Nama lengkap wajib diisi.']; hasError = true; }
  if (!form.category_teacher_id) { formErrors.value.category_teacher_id = ['Kategori dosen wajib dipilih.']; hasError = true; }
  if (!form.job_title_teacher_id) { formErrors.value.job_title_teacher_id = ['Jabatan wajib dipilih.']; hasError = true; }
  if (!form.email) { formErrors.value.email = ['Alamat email wajib diisi.']; hasError = true; }
  if (!form.phone_number) { formErrors.value.phone_number = ['No. Telepon wajib diisi.']; hasError = true; }
  if (!form.address) { formErrors.value.address = ['Alamat rumah wajib diisi.']; hasError = true; }

  if (!form.education || form.education.length === 0) {
    formErrors.value.education = ['Minimal harus menambahkan 1 riwayat pendidikan.'];
    hasError = true;
  } else {
    for (let i = 0; i < form.education.length; i++) {
      if (!form.education[i].degree) {
        formErrors.value[`education.${i}.degree`] = ['Jenjang wajib diisi.'];
        hasError = true;
      }
      if (!form.education[i].institution) {
        formErrors.value[`education.${i}.institution`] = ['Institusi wajib diisi.'];
        hasError = true;
      }
    }
  }
  if (!form.professional_positions || form.professional_positions.length === 0) {
    formErrors.value.professional_positions = ['Minimal harus menambahkan 1 jabatan profesional.'];
    hasError = true;
  } else {
    for (let i = 0; i < form.professional_positions.length; i++) {
      if (!form.professional_positions[i].position_name) {
        formErrors.value[`professional_positions.${i}.position_name`] = ['Nama jabatan wajib diisi.'];
        hasError = true;
      }
      if (!form.professional_positions[i].organization_name) {
        formErrors.value[`professional_positions.${i}.organization_name`] = ['Organisasi wajib diisi.'];
        hasError = true;
      }
    }
  }

  if (hasError) {
    currentStep.value = 0; // Kembali ke Tab 1 (Atau disesuaikan)
    if (mainScroll.value) { mainScroll.value.scrollTo({ top: 0, behavior: 'smooth' }); }
    return; // Cegah axios.post kepanggil jika gagal divalidasi frontend
  }

  try {
    const token = getCookie(TOKEN_COOKIE_NAME);

    const payload = JSON.parse(JSON.stringify(form));

    payload.professional_positions = (payload.professional_positions || []).map((item) => ({
      ...item,
      start_year: item?.start_year === null || item?.start_year === undefined || item?.start_year === '' ? '' : String(item.start_year),
      end_year: item?.end_year === null || item?.end_year === undefined || item?.end_year === '' ? '' : String(item.end_year),
    }));

    const formData = new FormData();

    // scalar fields
    formData.append('full_name', payload.full_name || '');
    formData.append('category_teacher_id', payload.category_teacher_id || '');
    formData.append('job_title_teacher_id', payload.job_title_teacher_id || '');
    formData.append('front_title', payload.front_title || '');
    formData.append('back_title', payload.back_title || '');
    formData.append('birth_date', payload.birth_date || '');
    formData.append('email', payload.email || '');
    formData.append('phone_number', payload.phone_number || '');
    formData.append('address', payload.address || '');
    formData.append('personal_description', payload.personal_description || '');

    // arrays as JSON strings (backend can decode)
    formData.append('education', JSON.stringify(payload.education || []));
    formData.append('research_areas', JSON.stringify(payload.research_areas || []));
    formData.append('publications', JSON.stringify(payload.publications || []));
    formData.append('books', JSON.stringify(payload.books || []));
    formData.append('popular_writings', JSON.stringify(payload.popular_writings || []));
    formData.append('professional_positions', JSON.stringify(payload.professional_positions || []));
    formData.append('awards', JSON.stringify(payload.awards || []));
    formData.append('online_academic_profiles', JSON.stringify(payload.online_academic_profiles || []));

    // optional uploaded image file
    if (fotoFile.value) {
      formData.append('image', fotoFile.value);
    }

    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1];

    const response = await axios.post(`/api/teachers/${id}`, formData, {
      headers: {
        Authorization: `Bearer ${token}`,
        'Content-Type': 'multipart/form-data'
      }
    });

    if (response.status === 200 || response.status === 201) {
      await Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: response.data.message || 'Data berhasil dikirim ke server!',
        confirmButtonText: 'OK',
      });
      window.location.href = '/masterData/teacher';
    }
  } catch (error) {
    if (error.response && error.response.status === 422) {
      formErrors.value = error.response.data.errors || {};

      const firstErrorKey = Object.keys(formErrors.value)[0];
      const firstErrorMessage = firstErrorKey
        ? formErrors.value[firstErrorKey][0]
        : 'Terdapat kesalahan validasi. Silakan periksa kembali isian Anda.';

      showToast('error', firstErrorMessage);
      
      // Kembali ke section awal
      currentStep.value = 0;
      
      if (mainScroll.value) {
        mainScroll.value.scrollTo({ top: 0, behavior: 'smooth' });
      }
    } else {
      console.error('Error submitting form:', error);
      const backendMessage = error?.response?.data?.message || 'Terjadi kesalahan saat mengirim data ke server.';
      showToast('error', backendMessage);
    }
  }
};

onMounted(async () => {
  const token = getCookie(TOKEN_COOKIE_NAME);
  if (!token) { window.location.href = '/unauthenticated'; return; }
  try {
    await axios.post('/api/auth/validate-token', {}, { headers: { Authorization: `Bearer ${token}` } });
    isAuthenticated.value = true;

    // Fetch categories
    const catResp = await axios.get('/api/category-teachers', { headers: { Authorization: `Bearer ${token}` } });
    if (catResp.data && catResp.data.data) {
      categories.value = catResp.data.data;
    }

    // Fetch job titles
    const jobResp = await axios.get('/api/job-titles', { headers: { Authorization: `Bearer ${token}` } });
    if (jobResp.data && jobResp.data.data) {
      jobTitles.value = jobResp.data.data;
    }
    
    // Ambil detail guru yang ada
    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1];
    if (id && !isNaN(id)) {
      const resp = await axios.get(`/api/teachers/${id}`, { headers: { Authorization: `Bearer ${token}` } });
      const data = resp.data?.data;
      if (data) {
        Object.keys(form).forEach(key => {
          if (data[key] !== undefined && data[key] !== null) {
            form[key] = data[key];
          }
        });
        if (!data.education || data.education.length === 0) form.education = [templates.education()];
        if (!data.professional_positions || data.professional_positions.length === 0) form.professional_positions = [templates.professional_positions()];
        
        if (data.image_url && String(data.image_url).trim() !== '') {
          const rawUrl = String(data.image_url).trim();
          if (rawUrl.startsWith('http://') || rawUrl.startsWith('https://')) {
            fotoPreview.value = rawUrl;
          } else if (rawUrl.startsWith('/storage/')) {
            fotoPreview.value = rawUrl;
          } else if (rawUrl.startsWith('storage/')) {
            fotoPreview.value = `/${rawUrl}`;
          } else {
            fotoPreview.value = `/storage/${rawUrl.replace(/^\/+/, '')}`;
          }
        } else {
          fotoPreview.value = null;
        }
      }
    }

  } catch (error) {
    if (error.response && error.response.status === 401) {
       deleteCookie(TOKEN_COOKIE_NAME);
       window.location.href = '/unauthenticated';
    } else {
       console.error('Failed to load data', error);
       alert('Gagal memuat data dosen.');
    }
  }
});
</script>

<style scoped>
.slide-enter-active,
.slide-leave-active {
  transition: opacity 0.25s ease, transform 0.25s ease;
}
.slide-enter-from {
  opacity: 0;
  transform: translateX(30px);
}
.slide-leave-to {
  opacity: 0;
  transform: translateX(-30px);
}
</style>
