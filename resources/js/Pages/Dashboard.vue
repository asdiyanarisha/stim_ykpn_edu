<template>
  <div class="flex h-screen bg-slate-50 overflow-hidden">
    <!-- Sidebar -->
    <AppSidebar :is-open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <AppNavbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

      <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
        <!-- Welcome Section -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <h1 class="text-2xl font-bold text-slate-900">Halo, Admin 👋</h1>
            <p class="text-slate-500">Berikut adalah ringkasan data terbaru hari ini.</p>
          </div>
          <div class="flex items-center gap-3">
            <AppButton variant="secondary" size="md">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
              Ekspor Data
            </AppButton>
            <AppButton variant="primary" size="md">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
              Tambah Data
            </AppButton>
          </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
          <StatCard 
            label="Total Pengguna" 
            value="12,456" 
            :trend="12.5" 
            color-class="bg-indigo-100 text-indigo-600"
            icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>'
          />
          <StatCard 
            label="Pendapatan" 
            value="Rp 45.2jta" 
            :trend="8.1" 
            color-class="bg-emerald-100 text-emerald-600"
            icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
          />
          <StatCard 
            label="Pesanan Baru" 
            value="384" 
            :trend="-2.4" 
            color-class="bg-amber-100 text-amber-600"
            icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>'
          />
          <StatCard 
            label="Tingkat Konversi" 
            value="3.24%" 
            :trend="4.3" 
            color-class="bg-rose-100 text-rose-600"
            icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>'
          />
        </div>

        <!-- Charts/Tables Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <!-- Recent Activity -->
          <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex items-center justify-between">
              <h2 class="font-bold text-slate-900">Daftar Pengguna Terbaru</h2>
              <button class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Lihat Semua</button>
            </div>
            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse">
                <thead>
                  <tr class="bg-slate-50">
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Pengguna</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Bergabung</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                  <tr v-for="user in recentUsers" :key="user.id" class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                      <div class="flex items-center gap-3">
                        <img :src="user.avatar" class="w-8 h-8 rounded-full">
                        <div>
                          <p class="text-sm font-semibold text-slate-900">{{ user.name }}</p>
                          <p class="text-xs text-slate-500">{{ user.email }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      <span :class="`inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase ${user.status === 'Active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600'}`">
                        {{ user.status }}
                      </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ user.role }}</td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ user.date }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Quick Stats -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-bold text-slate-900 mb-6">Penyelesaian Tugas</h2>
            <div class="space-y-6">
              <div v-for="task in tasks" :key="task.name">
                <div class="flex items-center justify-between mb-2">
                  <span class="text-sm font-medium text-slate-700">{{ task.name }}</span>
                  <span class="text-sm font-bold text-slate-900">{{ task.progress }}%</span>
                </div>
                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                  <div :class="`h-full ${task.color} rounded-full`" :style="`width: ${task.progress}%`"></div>
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
import { ref } from 'vue';
import AppSidebar from '../components/AppSidebar.vue';
import AppNavbar from '../components/AppNavbar.vue';
import StatCard from '../components/StatCard.vue';
import AppButton from '../components/AppButton.vue';

const sidebarOpen = ref(false);

const recentUsers = [
  { id: 1, name: 'Budi Santoso', email: 'budi@example.com', status: 'Active', role: 'Premium', date: '12 Jan 2024', avatar: 'https://ui-avatars.com/api/?name=Budi+Santoso&background=random' },
  { id: 2, name: 'Sari Wijaya', email: 'sari@example.com', status: 'Active', role: 'Basic', date: '11 Jan 2024', avatar: 'https://ui-avatars.com/api/?name=Sari+Wijaya&background=random' },
  { id: 3, name: 'Andi Pratama', email: 'andi@example.com', status: 'Inactive', role: 'Basic', date: '10 Jan 2024', avatar: 'https://ui-avatars.com/api/?name=Andi+Pratama&background=random' },
  { id: 4, name: 'Lia Ananda', email: 'lia@example.com', status: 'Active', role: 'Premium', date: '09 Jan 2024', avatar: 'https://ui-avatars.com/api/?name=Lia+Ananda&background=random' },
];

const tasks = [
  { name: 'Server Migration', progress: 75, color: 'bg-indigo-600' },
  { name: 'UI/UX Redesign', progress: 40, color: 'bg-emerald-500' },
  { name: 'Database Optimization', progress: 95, color: 'bg-amber-500' },
  { name: 'New Features Launch', progress: 15, color: 'bg-rose-500' },
];
</script>
