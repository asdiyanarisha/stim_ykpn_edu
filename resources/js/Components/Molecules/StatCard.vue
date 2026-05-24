<template>
  <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
    <div class="flex items-center justify-between mb-4">
      <div :class="`w-12 h-12 ${colorClass} rounded-xl flex items-center justify-center transition-transform group-hover:scale-110`" v-html="icon"></div>
      <div v-if="trend" :class="`flex items-center text-xs font-semibold px-2 py-1 rounded-full ${trend > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600'}`">
        <svg v-if="trend > 0" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" /></svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd" /></svg>
        {{ Math.abs(trend) }}%
      </div>
    </div>
    <h3 class="text-sm font-medium text-slate-500 mb-1">{{ label }}</h3>
    <p class="text-2xl font-bold text-slate-900">{{ value }}</p>
  </div>
</template>

<script setup>
defineProps({
  label: String,
  value: String,
  icon: String,
  colorClass: {
    type: String,
    default: 'bg-indigo-50 text-indigo-600'
  },
  trend: Number
});
</script>
