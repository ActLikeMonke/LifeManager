<template>

<div class="bg-[#252525] p-4 rounded-xl mt-6"> 
    <h2 class="text-gray-400">MACROS</h2>
    
    <ProgressBar :progress="Math.round((props.protein/props.proteinTarget)*100)" :color="'bg-blue-600'" />
    <p class="text-gray-400 mt-1"> Protein: {{ props.protein }}g / {{ props.proteinTarget }}g </p> 
    <ProgressBar :progress="Math.round((props.carbs/props.carbsTarget)*100)" :color="'bg-yellow-600'" />
    <p class="text-gray-400 mt-1"> Carbs: {{ props.carbs }}g / {{ props.carbsTarget }}g </p> 
    <ProgressBar :progress="Math.round((props.fats/props.fatsTarget)*100)" :color="'bg-red-600'" />
    <p class="text-gray-400 mt-1"> Fats: {{ props.fats }}g / {{ props.fatsTarget }}g </p>
   
</div>

</template>


<script setup>

import ProgressBar from './ProgressBarComponent.vue';
const props = defineProps({
  protein: {
    type: Number,
    default: 0
  },
  carbs: {
    type: Number,
    default: 0
  },
  fats: {
    type: Number,
    default: 0
  },
  proteinTarget: {
    type: Number,
    default: 0
  },
  carbsTarget: {
    type: Number,
    default: 0
  },
  fatsTarget: {
    type: Number,
    default: 0
  }
});
</script>