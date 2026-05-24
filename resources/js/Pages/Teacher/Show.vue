<template>
  <div v-if="isAuthenticated" class="flex h-screen bg-slate-50 overflow-hidden font-sans">
    <!-- Sidebar -->
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8" ref="mainScroll">
        <!-- Back Button -->
        <div class="max-w-6xl mx-auto mb-6">
          <button @click="goBack" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Data Dosen
          </button>
        </div>

        <div class="max-w-6xl mx-auto space-y-8 pb-12">
          <!-- Profile Header Section -->
          <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="h-48 w-full bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500 relative">
              <!-- Decorative background patterns -->
              <div class="absolute inset-0 opacity-20 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCI+PGNpcmNsZSBjeD0iNCIgY3k9IjQiIHI9IjEiIGZpbGw9IiNmZmYiLz48L3N2Zz4=')]"></div>
            </div>
            
            <div class="px-6 sm:px-10 pb-8 relative">
              <div class="flex flex-col sm:flex-row gap-6 relative -top-16">
                <!-- Avatar -->
                <div class="flex-shrink-0 relative">
                  <div class="w-32 h-32 rounded-2xl border-4 border-white shadow-lg overflow-hidden bg-slate-100 flex items-center justify-center">
                    <img v-if="teacher.avatar" :src="teacher.avatar" alt="Avatar" class="w-full h-full object-cover" />
                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                  </div>
                  <div class="absolute -bottom-2 -right-2 bg-blue-500 w-8 h-8 rounded-full border-4 border-white flex items-center justify-center shadow-sm" title="Aktif">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                  </div>
                </div>

                <!-- Info -->
                <div class="mt-16 sm:mt-20 flex-1">
                  <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ displayFullName }}
                  </h1>
                  <p class="text-lg font-medium text-blue-600 mt-1">Dosen Pengajar</p>
                  
                  <div class="flex flex-wrap gap-4 mt-4 text-sm text-slate-600">
                    <div class="flex items-center gap-1.5" v-if="teacher.email">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                      {{ teacher.email }}
                    </div>
                    <div class="flex items-center gap-1.5" v-if="teacher.phone_number">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                      {{ teacher.phone_number }}
                    </div>
                    <div class="flex items-center gap-1.5" v-if="teacher.birth_date">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                      {{ formatDate(teacher.birth_date) }}
                    </div>
                  </div>
                </div>

                <!-- Actions -->
                <div class="mt-16 sm:mt-20 flex-shrink-0 flex items-start gap-3">
                  <AppButton variant="primary" size="sm" class="shadow-sm" @click="goToEdit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    Ubah Data
                  </AppButton>
                </div>
              </div>

              <!-- Stats / Summaries -->
              <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex flex-col items-center justify-center hover:bg-blue-100 transition-colors cursor-default">
                  <div class="text-blue-500 font-bold text-3xl">{{ teacher.publications?.length || 0 }}</div>
                  <div class="text-xs font-semibold text-blue-700 uppercase tracking-widest mt-1">Publikasi</div>
                </div>
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex flex-col items-center justify-center hover:bg-blue-100 transition-colors cursor-default">
                  <div class="text-blue-500 font-bold text-3xl">{{ teacher.research_areas?.length || 0 }}</div>
                  <div class="text-xs font-semibold text-blue-700 uppercase tracking-widest mt-1">Bidang Riset</div>
                </div>
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex flex-col items-center justify-center hover:bg-blue-100 transition-colors cursor-default">
                  <div class="text-blue-500 font-bold text-3xl">{{ teacher.books?.length || 0 }}</div>
                  <div class="text-xs font-semibold text-blue-700 uppercase tracking-widest mt-1">Buku</div>
                </div>
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex flex-col items-center justify-center hover:bg-blue-100 transition-colors cursor-default">
                  <div class="text-blue-500 font-bold text-3xl">{{ teacher.awards?.length || 0 }}</div>
                  <div class="text-xs font-semibold text-blue-700 uppercase tracking-widest mt-1">Penghargaan</div>
                </div>
              </div>

            </div>
          </div>

          <!-- Main Details Grid -->
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: About, Education, Experience -->
            <div class="lg:col-span-1 space-y-8">
              
              <!-- About Section -->
              <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-500 group-hover:w-2 transition-all"></div>
                <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                  <span class="p-1.5 bg-blue-50 rounded-lg text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg></span>
                  Tentang
                </h2>
                <p class="text-slate-600 text-sm leading-relaxed" v-if="teacher.personal_description">
                  {{ teacher.personal_description }}
                </p>
                <p class="text-slate-400 text-sm italic" v-else>Belum ada deskripsi pribadi.</p>
                
                <div class="mt-6 pt-6 border-t border-slate-100">
                  <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Bidang Riset</h3>
                  <div class="flex flex-wrap gap-2" v-if="teacher.research_areas?.length > 0">
                    <span v-for="(area, idx) in teacher.research_areas" :key="idx" class="px-3 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded-full border border-slate-200">
                      {{ area.area_name }}
                    </span>
                  </div>
                  <p class="text-slate-400 text-xs italic" v-else>Belum ada data.</p>
                </div>

                <div class="mt-6 pt-6 border-t border-slate-100">
                  <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Profil Online</h3>
                  <div class="flex flex-col gap-2" v-if="teacher.online_academic_profiles?.length > 0">
                    <a v-for="(profile, idx) in teacher.online_academic_profiles" :key="idx" :href="profile.url" target="_blank" class="flex items-center gap-2 text-sm text-blue-600 hover:text-blue-800 transition-colors group/link p-2 rounded-lg hover:bg-blue-50">
                      <span class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center group-hover/link:bg-blue-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                      </span>
                      {{ profile.platform_name }}
                    </a>
                  </div>
                  <p class="text-slate-400 text-xs italic" v-else>Belum ada profile online.</p>
                </div>
              </div>

              <!-- Education Timeline -->
              <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-500 group-hover:w-2 transition-all"></div>
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                  <span class="p-1.5 bg-blue-50 rounded-lg text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" /></svg></span>
                  Pendidikan
                </h2>
                
                <div class="space-y-6" v-if="teacher.education?.length > 0">
                  <div v-for="(edu, idx) in teacher.education" :key="idx" class="relative pl-6 before:absolute before:left-0 before:top-2 before:bottom-[-24px] before:w-px before:bg-slate-200 last:before:hidden">
                    <div class="absolute left-[-4px] top-2 w-2 h-2 rounded-full bg-blue-400 border-2 border-white ring-2 ring-blue-50"></div>
                    <div class="text-sm font-bold text-slate-800">{{ edu.degree }} - {{ edu.major }}</div>
                    <div class="text-sm text-slate-600 mt-1">{{ edu.institution }} <span v-if="edu.country">, {{ edu.country }}</span></div>
                    <div class="text-xs text-slate-400 mt-1 font-medium bg-slate-100 inline-block px-2.5 py-0.5 rounded-md">Lulus Tahun {{ edu.graduation_year }}</div>
                  </div>
                </div>
                <p class="text-slate-400 text-sm italic" v-else>Belum ada data pendidikan.</p>
              </div>

              <!-- Professional Experience -->
              <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-500 group-hover:w-2 transition-all"></div>
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                  <span class="p-1.5 bg-blue-50 rounded-lg text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" /><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" /></svg></span>
                  Jabatan Profesional
                </h2>
                
                <div class="space-y-6" v-if="teacher.professional_positions?.length > 0">
                  <div v-for="(pos, idx) in teacher.professional_positions" :key="idx" class="relative pl-6 before:absolute before:left-0 before:top-2 before:bottom-[-24px] before:w-px before:bg-slate-200 last:before:hidden">
                    <div class="absolute left-[-4px] top-2 w-2 h-2 rounded-full bg-blue-400 border-2 border-white ring-2 ring-blue-50"></div>
                    <div class="text-sm font-bold text-slate-800">{{ pos.position_name }}</div>
                    <div class="text-sm text-slate-600 mt-1 font-medium">{{ pos.organization_name }}</div>
                    <div class="text-xs text-slate-400 mt-1 bg-slate-100 inline-block px-2.5 py-0.5 rounded-md">
                      {{ pos.start_year }} - {{ pos.is_current ? 'Sekarang' : pos.end_year }}
                    </div>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed bg-slate-50 p-3 rounded-xl border border-slate-100" v-if="pos.description">
                      {{ pos.description }}
                    </p>
                  </div>
                </div>
                <p class="text-slate-400 text-sm italic" v-else>Belum ada data jabatan.</p>
              </div>

            </div>

            <!-- Right Column: Publications, Books, Content -->
            <div class="lg:col-span-2 space-y-8">
              
              <!-- Publications Section -->
              <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-6">
                  <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <span class="p-1.5 bg-blue-50 rounded-lg text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" /></svg></span>
                    Publikasi Ilmiah (<span class="text-blue-600">{{ teacher.publications?.length || 0 }}</span>)
                  </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" v-if="teacher.publications?.length > 0">
                  <div v-for="(pub, idx) in teacher.publications" :key="idx" class="group border border-slate-200 rounded-2xl p-5 hover:border-blue-300 hover:shadow-md transition-all duration-300 relative overflow-hidden bg-white hover:-translate-y-1">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-blue-50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-150 group-hover:bg-blue-100/50 mix-blend-multiply"></div>
                    <div class="mb-2">
                      <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-100 text-blue-700">
                        {{ pub.type || 'Jurnal' }}
                      </span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800 leading-snug group-hover:text-blue-700 transition-colors line-clamp-2" :title="pub.title">{{ pub.title }}</h3>
                    <p class="text-xs text-slate-500 mt-2 font-medium">{{ pub.journal_book_name }}</p>
                    <div class="flex flex-wrap items-center mt-3 gap-y-2 gap-x-4 text-[11px] text-slate-400">
                      <span class="flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg> {{ pub.year }}</span>
                      <span v-if="pub.volume">Vol. {{ pub.volume }}</span>
                      <span v-if="pub.pages">Hal. {{ pub.pages }}</span>
                      <span v-if="pub.doi" class="text-blue-600">DOI: {{ pub.doi }}</span>
                    </div>
                  </div>
                </div>
                <div v-else class="text-center py-10 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                  <p class="text-sm text-slate-400">Belum ada data publikasi.</p>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Books Section -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                  <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="p-1.5 bg-blue-50 rounded-lg text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" /></svg></span>
                    Buku ({{ teacher.books?.length || 0 }})
                  </h2>
                  <div class="space-y-4" v-if="teacher.books?.length > 0">
                    <div v-for="(book, idx) in teacher.books" :key="idx" class="flex gap-4 p-4 border border-slate-100 bg-slate-50/50 rounded-2xl hover:border-blue-200 transition-colors">
                      <div class="w-12 h-16 bg-slate-200 rounded shrink-0 flex items-center justify-center text-slate-400 shadow-sm border border-slate-300 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-slate-300 to-white opacity-50"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 relative z-10" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" /></svg>
                      </div>
                      <div>
                        <h3 class="text-sm font-bold text-slate-800 line-clamp-2">{{ book.title }}</h3>
                        <p class="text-xs text-slate-500 mt-1">{{ book.publisher }} &middot; {{ book.year }}</p>
                        <p class="text-[10px] text-slate-400 mt-1 font-mono">ISBN: {{ book.isbn || '-' }}</p>
                      </div>
                    </div>
                  </div>
                  <div v-else class="text-center py-6">
                    <p class="text-sm text-slate-400">Belum ada data buku.</p>
                  </div>
                </div>

                <!-- Awards Section -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                  <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="p-1.5 bg-blue-50 rounded-lg text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 2a1 1 0 01.832.445l2.428 3.593 4.298.541a1 1 0 01.564 1.737l-3.155 2.955.772 4.253a1 1 0 01-1.464 1.064L10 14.39l-3.805 2.198a1 1 0 01-1.464-1.064l.772-4.253-3.155-2.955a1 1 0 01.564-1.737l4.298-.541 2.428-3.593A1 1 0 0110 2z" clip-rule="evenodd" /></svg></span>
                    Penghargaan ({{ teacher.awards?.length || 0 }})
                  </h2>
                  <div class="space-y-4" v-if="teacher.awards?.length > 0">
                    <div v-for="(award, idx) in teacher.awards" :key="idx" class="flex gap-4 items-center p-3 rounded-xl hover:bg-blue-50 transition-colors border border-transparent hover:border-blue-100">
                      <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                      </div>
                      <div>
                        <h3 class="text-sm font-bold text-slate-800">{{ award.award_name }}</h3>
                        <p class="text-xs text-slate-500">{{ award.grantor }} &middot; {{ award.year }}</p>
                      </div>
                    </div>
                  </div>
                  <div v-else class="text-center py-6">
                    <p class="text-sm text-slate-400">Belum ada data penghargaan.</p>
                  </div>
                </div>
              </div>

              <!-- Popular Writings Section -->
              <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                  <span class="p-1.5 bg-blue-50 rounded-lg text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" /></svg></span>
                  Tulisan Populer ({{ teacher.popular_writings?.length || 0 }})
                </h2>
                <div class="space-y-3" v-if="teacher.popular_writings?.length > 0">
                  <a v-for="(writing, idx) in teacher.popular_writings" :key="idx" :href="writing.url" target="_blank" class="block p-4 border border-slate-100 rounded-2xl hover:border-blue-300 hover:shadow-md transition-all group">
                    <h3 class="text-sm font-bold text-slate-800 group-hover:text-blue-700 transition-colors flex items-start justify-between">
                      {{ writing.title }}
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300 group-hover:text-blue-500 shrink-0 ml-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                    </h3>
                    <div class="flex items-center gap-3 mt-2 text-xs text-slate-500">
                      <span class="font-medium text-slate-700">{{ writing.media }}</span>
                      <span>&bull;</span>
                      <span>{{ formatDate(writing.date) }}</span>
                    </div>
                  </a>
                </div>
                <div v-else class="text-center py-6 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                  <p class="text-sm text-slate-400">Belum ada tulisan populer.</p>
                </div>
              </div>

            </div>

          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import AppSidebar from '../../Components/Organisms/AppSidebar.vue';
import AppNavbar from '../../Components/Organisms/AppNavbar.vue';
import AppButton from '../../Components/Atoms/AppButton.vue';
import { getCookie, deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

const sidebarOpen = ref(false);
const isAuthenticated = ref(false);
const teacher = ref({});

const displayFullName = computed(() => {
  const front = teacher.value.front_title ? teacher.value.front_title.trim() + ' ' : '';
  const back = teacher.value.back_title ? ', ' + teacher.value.back_title.trim() : '';
  const name = teacher.value.full_name || 'Nama Dosen';
  return `${front}${name}${back}`;
});

const formatDate = (dateStr) => {
  if (!dateStr) return '';
  const date = new Date(dateStr);
  return date.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
};

const goBack = () => {
  window.location.href = '/masterData/teacher';
};

const goToEdit = () => {
  const parts = window.location.pathname.split('/');
  const id = parts[parts.length - 1]; 
  window.location.href = `/masterData/teacher/edit/${id}`;
};

const fetchTeacherDetail = async (token) => {
  try {
    const parts = window.location.pathname.split('/');
    const id = parts[parts.length - 1]; 
    
    if (isNaN(id)) return;

    const response = await axios.get(`/api/teachers/${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    });
    
    teacher.value = response.data?.data || {};

    const buildAvatarUrl = (imageUrl, displayName) => {
      if (!imageUrl || !String(imageUrl).trim()) {
        const fallbackName = displayName && displayName !== '-' ? displayName : 'Teacher';
        return `https://ui-avatars.com/api/?name=${encodeURIComponent(fallbackName)}&background=eff6ff&color=1d4ed8`;
      }
      if (imageUrl.startsWith('http://') || imageUrl.startsWith('https://')) return imageUrl;
      if (imageUrl.startsWith('/storage/')) return imageUrl;
      if (imageUrl.startsWith('storage/')) return `/${imageUrl}`;
      return `/storage/${imageUrl.replace(/^\/+/, '')}`;
    };

    teacher.value.avatar = buildAvatarUrl(teacher.value.image_url, displayFullName.value);

  } catch (error) {
    console.error('Could not fetch teacher details:', error);
    alert('Ops! Gagal mengambil data detail dosen dari server.');
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
    
    await fetchTeacherDetail(token);
    
  } catch (error) {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/unauthenticated';
  }
});
</script>

<style scoped>
/* Custom Scrollbar for hidden elements if needed */
</style>
