<template>
  <aside 
    class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 transition-all duration-300 ease-in-out lg:static"
    :class="isOpen ? 'translate-x-0 lg:-ml-64 lg:-translate-x-full' : '-translate-x-full lg:ml-0 lg:translate-x-0'"
  >
    <div class="flex h-16 items-center justify-between px-6 bg-slate-950">
      <span class="text-xl font-bold text-white flex items-center gap-2">
        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5l10-5-10-5zM2 17l10 5l10-5M2 12l10 5l10-5"/></svg>
        </div>
        Admin<span class="text-indigo-400">Panel</span>
      </span>
      <button @click="$emit('close')" class="lg:hidden text-slate-400 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
      </button>
    </div>

    <nav class="mt-6 px-4 space-y-1 overflow-y-auto max-h-[calc(100vh-5.5rem)] pb-4">
      <div v-for="item in menuItems" :key="item.name">
        <!-- Regular Menu Item -->
        <a v-if="!item.submenu" href="#" 
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
            <a v-for="sub in item.submenu" :key="sub.name" href="#"
              class="flex items-center pl-11 pr-3 py-2 text-sm text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-colors"
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
import { ref } from 'vue';

defineProps({
  isOpen: Boolean
});

defineEmits(['close']);

// Using ref to make `isOpen` property dynamically reactive when toggled
const menuItems = ref([
  { 
    name: 'Dashboard', 
    active: true, 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>' 
  },
  {
    name: 'Master Data',
    active: false,
    isOpen: false,
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>',
    submenu: [
      { name: 'Dosen' },
      { name: 'Mahasiswa' },
      { name: 'Kelas' },
      { name: 'Jurusan' }
    ]
  },
  { 
    name: 'Analytics', 
    active: false, 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>' 
  },
  { 
    name: 'Users', 
    active: false, 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>' 
  },
  { 
    name: 'Orders', 
    active: false, 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>' 
  },
  { 
    name: 'Settings', 
    active: false, 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>' 
  },
]);
</script>
