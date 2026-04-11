<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden">
    <!-- Sidebar -->
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <main ref="mainScroll" class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
              <a href="/masterData/teacher" class="hover:text-indigo-600 transition-colors">Data Dosen</a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
              <span class="text-slate-900 font-medium">Tambah Dosen</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Formulir Data Dosen</h1>
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
                      <AppInput v-model="form.nama_lengkap" label="Nama Lengkap (tanpa gelar)" placeholder="contoh: Budi Santoso" id="nama_lengkap" />
                      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <AppInput v-model="form.gelar_depan" label="Gelar Depan" placeholder="contoh: Prof. Dr." id="gelar_depan" />
                        <AppInput v-model="form.gelar_belakang" label="Gelar Belakang" placeholder="contoh: S.E., M.M." id="gelar_belakang" />
                      </div>
                    </div>
                  </div>
                  <!-- Additional Fields -->
                  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1">
                      <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700">Tanggal Lahir</label>
                      <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <input type="date" id="tanggal_lahir" v-model="form.tanggal_lahir" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-10 pr-4 transition-all duration-200" />
                      </div>
                    </div>
                    <AppInput v-model="form.email" label="Alamat Email" placeholder="dosen@stimykpn.ac.id" id="email" />
                    <AppInput v-model="form.no_telpon" label="No. Telepon" placeholder="0812xxxxxxxx" id="no_telpon" />
                  </div>
                  <div class="space-y-1">
                    <label for="alamat" class="block text-sm font-medium text-slate-700">Alamat Rumah</label>
                    <textarea id="alamat" v-model="form.alamat" rows="4" placeholder="Jl. Contoh No. 123, Kelurahan, Kecamatan, Kota, Provinsi" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4 transition-all duration-200 resize-none"></textarea>
                  </div>
                  <div class="space-y-1">
                    <label for="deskripsi_pribadi" class="block text-sm font-medium text-slate-700">Deskripsi Pribadi</label>
                    <textarea id="deskripsi_pribadi" v-model="form.deskripsi_pribadi" rows="3" placeholder="Tuliskan ringkasan singkat tentang diri Anda, keahlian, dan minat profesional..." class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4 transition-all duration-200 resize-none"></textarea>
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
                    <p class="text-sm text-slate-500 mt-1 ml-10">Riwayat pendidikan formal (S1, S2, S3, dll).</p>
                  </div>
                  <AppButton variant="primary" size="sm" @click="addItem('pendidikan')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.pendidikan" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('pendidikan', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Pendidikan {{ i + 1 }}</div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                      <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Jenjang</label>
                        <select v-model="item.jenjang" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4">
                          <option value="">Pilih jenjang</option>
                          <option value="D3">D3</option>
                          <option value="S1">S1</option>
                          <option value="S2">S2</option>
                          <option value="S3">S3</option>
                        </select>
                      </div>
                      <AppInput v-model="item.institusi" label="Institusi" placeholder="Universitas..." />
                      <AppInput v-model="item.jurusan" label="Jurusan / Program Studi" placeholder="Ilmu Komputer..." />
                      <AppInput v-model="item.negara" label="Negara" placeholder="Indonesia" />
                      <AppInput v-model="item.tahun_lulus" label="Tahun Lulus" type="number" placeholder="2020" />
                    </div>
                  </div>
                  <div v-if="form.pendidikan.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    Belum ada data pendidikan. Klik "Tambah" untuk menambahkan.
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
                  <AppButton variant="primary" size="sm" @click="addItem('jabatan_profesional')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.jabatan_profesional" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('jabatan_profesional', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                      <AppInput v-model="item.nama_jabatan" label="Nama Jabatan" placeholder="Komisaris, Ketua..." />
                      <AppInput v-model="item.nama_organisasi" label="Nama Organisasi / Lembaga" placeholder="PT Contoh..." />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                      <AppInput v-model="item.tahun_mulai" label="Tahun Mulai" type="number" placeholder="2018" />
                      <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Tahun Terakhir</label>
                        <input type="number" v-model="item.tahun_terakhir" :disabled="item.sekarang" :class="['block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4 transition-all duration-200', item.sekarang ? 'bg-slate-100 text-slate-400 cursor-not-allowed' : '']" placeholder="2024" />
                      </div>
                      <div class="flex items-end pb-1">
                        <label class="flex items-center gap-2.5 cursor-pointer select-none group">
                          <input type="checkbox" v-model="item.sekarang" @change="item.sekarang ? (item.tahun_terakhir = '') : null" class="w-4.5 h-4.5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer" />
                          <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">Masih menjabat saat ini</span>
                        </label>
                      </div>
                    </div>
                    <div class="mt-4 space-y-1">
                      <label class="block text-sm font-medium text-slate-700">Deskripsi Pekerjaan</label>
                      <textarea v-model="item.deskripsi" rows="2" placeholder="Jelaskan tanggung jawab dan pencapaian di posisi ini..." class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4 transition-all duration-200 resize-none"></textarea>
                    </div>
                  </div>
                  <div v-if="form.jabatan_profesional.length === 0" class="text-center py-10 text-slate-400 text-sm">
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
                  <AppButton variant="primary" size="sm" @click="addItem('bidang_riset')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.bidang_riset" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group flex items-center gap-4">
                    <div class="flex-1">
                      <AppInput v-model="item.nama_bidang" label="Nama Bidang Riset" placeholder="Machine Learning, Data Science..." />
                    </div>
                    <button @click="removeItem('bidang_riset', i)" class="mt-5 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors flex-shrink-0">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                  </div>
                  <div v-if="form.bidang_riset.length === 0" class="text-center py-10 text-slate-400 text-sm">
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
                  <AppButton variant="primary" size="sm" @click="addItem('publikasi')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.publikasi" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('publikasi', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Publikasi {{ i + 1 }}</div>
                    <div class="space-y-4">
                      <AppInput v-model="item.judul" label="Judul Publikasi" placeholder="Judul makalah / paper..." />
                      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <AppInput v-model="item.nama_jurnal_buku" label="Nama Jurnal / Buku" placeholder="Journal of..." />
                        <div class="space-y-1">
                          <label class="block text-sm font-medium text-slate-700">Jenis</label>
                          <select v-model="item.jenis" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4">
                            <option value="">Pilih jenis</option>
                            <option value="jurnal">Jurnal</option>
                            <option value="book_chapter">Book Chapter</option>
                            <option value="conference">Conference Paper</option>
                          </select>
                        </div>
                      </div>
                      <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <AppInput v-model="item.volume" label="Volume" placeholder="Vol. 12" />
                        <AppInput v-model="item.halaman" label="Halaman" placeholder="pp. 1-15" />
                        <AppInput v-model="item.tahun" label="Tahun" type="number" placeholder="2024" />
                        <AppInput v-model="item.doi" label="DOI" placeholder="10.1000/xyz" />
                      </div>
                    </div>
                  </div>
                  <div v-if="form.publikasi.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Belum ada publikasi. Klik "Tambah" untuk menambahkan.
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
                  <AppButton variant="primary" size="sm" @click="addItem('buku')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.buku" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('buku', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Buku {{ i + 1 }}</div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                      <AppInput v-model="item.judul" label="Judul Buku" placeholder="Judul buku..." class="sm:col-span-2" />
                      <AppInput v-model="item.penerbit" label="Penerbit" placeholder="Penerbit buku..." />
                      <div class="grid grid-cols-2 gap-4">
                        <AppInput v-model="item.tahun" label="Tahun" type="number" placeholder="2024" />
                        <AppInput v-model="item.isbn" label="ISBN" placeholder="978-..." />
                      </div>
                    </div>
                  </div>
                  <div v-if="form.buku.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    Belum ada buku. Klik "Tambah" untuk menambahkan.
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
                  <AppButton variant="primary" size="sm" @click="addItem('tulisan_populer')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.tulisan_populer" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('tulisan_populer', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Tulisan {{ i + 1 }}</div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                      <AppInput v-model="item.judul" label="Judul Tulisan" placeholder="Judul opini / esai..." class="sm:col-span-2" />
                      <AppInput v-model="item.media" label="Media" placeholder="Kompas, Jakarta Post..." />
                      <AppInput v-model="item.tanggal" label="Tanggal Terbit" type="date" />
                      <AppInput v-model="item.url" label="URL Artikel" placeholder="https://..." class="sm:col-span-2" />
                    </div>
                  </div>
                  <div v-if="form.tulisan_populer.length === 0" class="text-center py-10 text-slate-400 text-sm">
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
                    <p class="text-sm text-slate-500 mt-1 ml-10">Penghargaan yang diterima beserta pemberi dan tahunnya.</p>
                  </div>
                  <AppButton variant="primary" size="sm" @click="addItem('penghargaan')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.penghargaan" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group">
                    <button @click="removeItem('penghargaan', i)" class="absolute top-3 right-3 w-7 h-7 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors opacity-0 group-hover:opacity-100">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                      <AppInput v-model="item.nama_penghargaan" label="Nama Penghargaan" placeholder="Best Paper Award..." />
                      <AppInput v-model="item.pemberi" label="Pemberi" placeholder="IEEE, ACM..." />
                      <AppInput v-model="item.tahun" label="Tahun" type="number" placeholder="2024" />
                    </div>
                  </div>
                  <div v-if="form.penghargaan.length === 0" class="text-center py-10 text-slate-400 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                    Belum ada penghargaan. Klik "Tambah" untuk menambahkan.
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
                  <AppButton variant="primary" size="sm" @click="addItem('profil_akademik_online')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" /></svg>
                    Tambah
                  </AppButton>
                </div>
                <div class="p-6 space-y-4">
                  <div v-for="(item, i) in form.profil_akademik_online" :key="i" class="relative border border-slate-200 rounded-xl p-5 bg-slate-50/50 hover:border-indigo-200 transition-colors group flex items-end gap-4">
                    <div class="w-48">
                      <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Platform</label>
                        <select v-model="item.nama_platform" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 pl-4">
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
                    <button @click="removeItem('profil_akademik_online', i)" class="mb-1 w-9 h-9 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-300 transition-colors flex-shrink-0">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                  </div>
                  <div v-if="form.profil_akademik_online.length === 0" class="text-center py-10 text-slate-400 text-sm">
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
            <AppButton v-if="currentStep === steps.length - 1" variant="primary" size="md" @click="handleSubmit">
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
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';
import AppSidebar from '../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../Components/Organisms/AppNavbar.vue';
import AppButton from '../Components/Atoms/AppButton.vue';
import AppInput from '../Components/Atoms/AppInput.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../Helpers/cookie.js';

const mainScroll = ref(null);
const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const currentStep = ref(0);

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
  nama_lengkap: '',
  gelar_depan: '',
  gelar_belakang: '',
  tanggal_lahir: '',
  email: '',
  no_telpon: '',
  alamat: '',
  deskripsi_pribadi: '',
  pendidikan: [{ jenjang: '', institusi: '', jurusan: '', negara: '', tahun_lulus: '' }],
  bidang_riset: [],
  publikasi: [],
  buku: [],
  tulisan_populer: [],
  jabatan_profesional: [{ nama_jabatan: '', nama_organisasi: '', tahun_mulai: '', tahun_terakhir: '', sekarang: false, deskripsi: '' }],
  penghargaan: [],
  profil_akademik_online: [],
});

const templates = {
  pendidikan: () => ({ jenjang: '', institusi: '', jurusan: '', negara: '', tahun_lulus: '' }),
  bidang_riset: () => ({ nama_bidang: '' }),
  publikasi: () => ({ judul: '', nama_jurnal_buku: '', jenis: '', volume: '', halaman: '', tahun: '', doi: '' }),
  buku: () => ({ judul: '', penerbit: '', tahun: '', isbn: '' }),
  tulisan_populer: () => ({ judul: '', media: '', tanggal: '', url: '' }),
  jabatan_profesional: () => ({ nama_jabatan: '', nama_organisasi: '', tahun_mulai: '', tahun_terakhir: '', sekarang: false, deskripsi: '' }),
  penghargaan: () => ({ nama_penghargaan: '', pemberi: '', tahun: '' }),
  profil_akademik_online: () => ({ nama_platform: '', url: '' }),
};

const addItem = (key) => { form[key].push(templates[key]()); };
const removeItem = (key, index) => { form[key].splice(index, 1); };

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

const goBack = () => { window.location.href = '/masterData/teacher'; };

const handleSubmit = () => {
  console.log('Form data:', JSON.parse(JSON.stringify(form)));
  alert('Data dosen berhasil disimpan! (simulasi)');
};

onMounted(async () => {
  const token = getCookie(TOKEN_COOKIE_NAME);
  if (!token) { window.location.href = '/unauthenticated'; return; }
  try {
    await axios.post('/api/auth/validate-token', {}, { headers: { Authorization: `Bearer ${token}` } });
    isAuthenticated.value = true;
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
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
