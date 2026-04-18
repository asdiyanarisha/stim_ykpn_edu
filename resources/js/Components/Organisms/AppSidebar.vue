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
      <SidebarItem 
        v-for="item in menuItems" 
        :key="item.name" 
        :item="item" 
        :depth="0" 
      />
    </nav>
  </aside>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import SidebarItem from '../Molecules/SidebarItem.vue';
import sidebarMenu from '../../Config/sidebarMenu.json';

defineProps({
  isOpen: Boolean
});

defineEmits(['close']);

// Using ref to make `isOpen` property dynamically reactive when toggled
const menuItems = ref(sidebarMenu);

const updateActiveState = (items, currentPath) => {
  let anyChildActive = false;
  
  items.forEach(item => {
    item.active = false;
    
    // Check if link matches
    const isDirectMatch = item.link === currentPath || (item.link && item.link !== '/' && currentPath.startsWith(item.link));
    
    if (item.submenu && item.submenu.length > 0) {
      const hasActiveChild = updateActiveState(item.submenu, currentPath);
      if (hasActiveChild) {
        item.isOpen = true;
        anyChildActive = true;
      }
    }

    if (isDirectMatch) {
      item.active = true;
      anyChildActive = true;
    }
  });

  return anyChildActive;
};

onMounted(() => {
  const path = window.location.pathname;
  updateActiveState(menuItems.value, path);
});
</script>

