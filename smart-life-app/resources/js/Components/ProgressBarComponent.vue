<template>
  <div class="w-full">
    <div class="flex justify-between mb-1">
    </div>
    <div class="w-full bg-gray-700 mt-4 rounded-full h-2 overflow-hidden">
      <div 
        :class="color"
        class="h-full transition-all duration-500 ease-out"
        :style="{ width: progress + '%' }"
      ></div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  progress: {
    type: Number,
    default: 0
  },
  color: {
    type: String,
    default: 'bg-green-600'
  }
});
</script>