<template>
  <aside 
    class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 transition-all duration-300 ease-in-out lg:static"
    :class="isOpen ? 'translate-x-0 lg:-ml-64 lg:-translate-x-full' : '-translate-x-full lg:ml-0 lg:translate-x-0'"
  >
    <div class="flex h-16 items-center justify-between px-6 bg-slate-950">
      <a href="/dashboard" class="text-lg font-extrabold text-white flex items-center gap-2.5 tracking-tight">
        <div class="bg-white rounded-lg p-1.5 shadow-md shadow-black/20 flex items-center justify-center">
          <img src="https://stimykpn.ac.id/storage/quill-upload/19827f3a460e91d1ccb121b2a810d720.webp" alt="Logo STIM YKPN" class="h-7 w-auto">
        </div>
        <span>Panel<span class="text-indigo-400 ml-1">Admin</span></span>
      </a>
      <button @click="$emit('close')" class="lg:hidden text-slate-400 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
      </button>
    </div>

    <nav class="mt-6 px-4 space-y-1 overflow-y-auto max-h-[calc(100vh-5.5rem)] pb-4">
      <div v-for="item in menuItems" :key="item.name">
        <!-- Regular Menu Item -->
        <a v-if="!item.submenu" :href="item.link || '#'" 
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group"
          :class="item.active ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white'"
        >
          <span v-html="item.icon" class="w-5 h-5 opacity-70 group-hover:opacity-100 flex-shrink-0"></span>
          <span class="font-medium">{{ item.name }}</span>
        </a>

        <!-- Menu Item with Submenu -->
        <div v-else>
          <button @click="item.isOpen = !item.isOpen"
            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors group"
            :class="item.active ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white'"
          >
            <div class="flex items-center gap-3">
              <span v-html="item.icon" class="w-5 h-5 opacity-70 group-hover:opacity-100 flex-shrink-0"></span>
              <span class="font-medium">{{ item.name }}</span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200" :class="item.isOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
          </button>
          
          <div v-show="item.isOpen" class="mt-1 space-y-1 overflow-hidden transition-all duration-300">
            <a v-for="sub in item.submenu" :key="sub.name" :href="sub.link || '#'"
              class="flex items-center pl-11 pr-3 py-2 text-sm rounded-lg transition-colors"
              :class="sub.active ? 'bg-indigo-600 text-white font-medium shadow-sm shadow-indigo-200' : 'text-slate-400 hover:text-white hover:bg-slate-800'"
            >
              {{ sub.name }}
            </a>
          </div>
        </div>
      </div>
    </nav>


  </aside>
</template>

<script setup>
import { ref, onMounted } from 'vue';

defineProps({
  isOpen: Boolean
});

defineEmits(['close']);

// Using ref to make `isOpen` property dynamically reactive when toggled
const menuItems = ref([
  { 
    name: 'Dashboard', 
    link: '/dashboard',
    active: false, 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>' 
  },
  {
    name: 'Master Data',
    active: false,
    isOpen: false,
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>',
    submenu: [
      { name: 'Dosen', link: '/masterData/teacher' }
    ]
  },
  {
    name: 'Manajemen Konten',
    active: false,
    isOpen: false,
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>',
    submenu: [
      { name: 'Banner', link: '/content/banner' },
      { name: 'Berita', link: '/content/berita' },
      { name: 'Lowongan Kerja', link: '/content/lowongan-kerja' },
      { name: 'Logo Sertifikasi', link: '/content/logo-sertifikasi' }
    ]
  },
]);

onMounted(() => {
  const path = window.location.pathname;

  menuItems.value.forEach(item => {
    item.active = false;
    if (item.submenu) {
      item.submenu.forEach(sub => sub.active = false);
    }
  });

  for (const item of menuItems.value) {
    if (item.link === path || (item.link && item.link !== '/' && path.startsWith(item.link))) {
      item.active = true;
    } else if (item.submenu) {
      for (const sub of item.submenu) {
        if (sub.link === path || (sub.link && path.startsWith(sub.link))) {
          sub.active = true;
          item.isOpen = true;
        }
      }
    }
  }
});
</script>
