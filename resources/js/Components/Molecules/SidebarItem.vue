<template>
  <div>
    <!-- Regular Link (No Submenu) -->
    <a v-if="!item.submenu || item.submenu.length === 0" 
      :href="item.link || '#'"
      class="flex items-center gap-3 py-2.5 rounded-lg transition-all duration-200 group"
      :class="[
        item.active ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/20' : 'hover:bg-slate-800 hover:text-white',
        indentClass
      ]"
    >
      <span v-if="item.icon && depth === 0" v-html="item.icon" class="w-5 h-5 opacity-70 group-hover:opacity-100 flex-shrink-0"></span>
      <div v-else-if="depth > 0" class="flex-shrink-0 w-1.5 h-1.5 rounded-full transition-all duration-200"
        :class="item.active ? 'bg-white scale-125' : 'bg-slate-600 group-hover:bg-slate-400'"
      ></div>
      <span class="font-medium truncate text-[0.9375rem]">{{ item.name }}</span>
    </a>

    <!-- Toggleable Button (Has Submenu) -->
    <div v-else>
      <button @click="item.isOpen = !item.isOpen"
        class="w-full flex items-center justify-between py-2.5 rounded-lg transition-all duration-200 group"
        :class="[
          item.active ? 'text-white' : 'hover:bg-slate-800 hover:text-white text-slate-300',
          indentClass
        ]"
      >
        <div class="flex items-center gap-3 overflow-hidden">
          <span v-if="item.icon && depth === 0" v-html="item.icon" class="w-5 h-5 opacity-70 group-hover:opacity-100 flex-shrink-0"></span>
          <div v-else-if="depth > 0" class="flex-shrink-0 w-1.5 h-1.5 rounded-full"
            :class="item.active ? 'bg-indigo-400' : 'bg-slate-600'"
          ></div>
          <span class="font-medium truncate text-[0.9375rem]">{{ item.name }}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" 
          class="w-4 h-4 transition-transform duration-200 flex-shrink-0" 
          :class="[
            item.isOpen ? 'rotate-180' : '',
            item.active ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300'
          ]" 
          fill="none" viewBox="0 0 24 24" stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      
      <div v-show="item.isOpen" class="mt-0.5 space-y-0.5 overflow-hidden transition-all duration-300">
        <SidebarItem 
          v-for="sub in item.submenu" 
          :key="sub.name" 
          :item="sub" 
          :depth="depth + 1" 
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SidebarItem'
}
</script>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  item: {
    type: Object,
    required: true
  },
  depth: {
    type: Number,
    default: 0
  }
});

const indentClass = computed(() => {
  if (props.depth === 0) return 'px-3';
  if (props.depth === 1) return 'pl-11 pr-3';
  if (props.depth === 2) return 'pl-16 pr-3';
  // Fallback for deeper levels if needed
  return `pl-${Math.min(20, 11 + props.depth * 5)} pr-3`;
});
</script>
