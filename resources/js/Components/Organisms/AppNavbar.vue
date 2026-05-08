<template>
  <header class="h-16 bg-white border-b border-slate-200 sticky top-0 z-40 flex items-center justify-between px-4 sm:px-6">
    <div class="flex items-center gap-4">
      <button @click="$emit('toggleSidebar')" class="p-2 -ml-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
      </button>
      
      <div class="hidden sm:flex relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <svg class="w-5 h-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
          </svg>
        </span>
        <input type="text" placeholder="Search anything..." class="block w-64 md:w-80 pl-10 pr-3 py-2 border border-slate-200 rounded-lg bg-slate-50 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all shadow-sm">
      </div>
    </div>

    <div class="flex items-center gap-2 sm:gap-4">
      <button class="p-2 text-slate-500 hover:bg-slate-100 rounded-lg relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
        <span class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
      </button>
      
      <div class="h-8 w-px bg-slate-200 mx-1 hidden sm:block"></div>
      
      <div class="relative">
        <button @click="isUserMenuOpen = !isUserMenuOpen" class="flex items-center gap-3 focus:outline-none rounded-lg p-1 hover:bg-slate-50 transition-colors z-50 relative">
          <div class="text-right hidden sm:block">
            <p class="text-xs font-semibold text-slate-900 leading-tight">Admin User</p>
            <p class="text-[10px] text-slate-500">Super Admin</p>
          </div>
          <div class="w-9 h-9 border-2 border-slate-200 rounded-lg overflow-hidden transition-transform active:scale-95 shadow-sm">
            <img src="https://ui-avatars.com/api/?name=Admin+User&background=6366f1&color=fff" class="w-full h-full object-cover pointer-events-none">
          </div>
        </button>

        <!-- Dropdown Menu -->
        <transition 
          enter-active-class="transition ease-out duration-100" 
          enter-from-class="transform opacity-0 scale-95" 
          enter-to-class="transform opacity-100 scale-100" 
          leave-active-class="transition ease-in duration-75" 
          leave-from-class="transform opacity-100 scale-100" 
          leave-to-class="transform opacity-0 scale-95"
        >
          <div v-show="isUserMenuOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-100 z-50 overflow-hidden">
            <div class="py-1">
              <a href="/setting" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                Pengaturan
              </a>
              <div class="h-px bg-slate-100 my-1"></div>
              <button @click="handleLogout" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-slate-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                Logout
              </button>
            </div>
          </div>
        </transition>

        <!-- Overlay to Close Dropdown on Click Outside -->
        <div v-show="isUserMenuOpen" @click="isUserMenuOpen = false" class="fixed inset-0 z-40"></div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue';
import { deleteCookie, TOKEN_COOKIE_NAME } from '../../Helpers/cookie.js';

defineEmits(['toggleSidebar']);

const isUserMenuOpen = ref(false);

const handleLogout = () => {
    deleteCookie(TOKEN_COOKIE_NAME);
    window.location.href = '/login';
};
</script>
