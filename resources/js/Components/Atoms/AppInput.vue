<template>
  <div class="space-y-1">
    <label v-if="label" :for="id" class="block text-sm font-medium text-slate-700">
      {{ label }}
    </label>
    <div class="relative">
      <div v-if="$slots.icon" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
        <slot name="icon"></slot>
      </div>
      <input
        :id="id"
        :type="type"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="placeholder"
        :class="[
          'block w-full rounded-xl shadow-sm sm:text-sm transition-all duration-200 py-2.5',
          error ? 'border-rose-500 focus:border-rose-500 focus:ring-rose-500 bg-rose-50' : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white',
          $slots.icon ? 'pl-10' : 'pl-4'
        ]"
        v-bind="$attrs"
      />
    </div>
    <p v-if="error" class="text-xs text-rose-600 mt-1">{{ error }}</p>
  </div>
</template>

<script setup>
defineProps({
  modelValue: [String, Number],
  label: String,
  type: {
    type: String,
    default: 'text'
  },
  placeholder: String,
  id: String,
  error: String
});

defineEmits(['update:modelValue']);
</script>
