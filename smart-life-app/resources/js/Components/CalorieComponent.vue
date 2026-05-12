<template>

<div class="bg-[#252525] p-4 rounded-xl mt-6"> 
    <h2 class="text-gray-400">DAILY CALORIES</h2>
    <div class="flex items-end gap-2">
        <p class="text-5xl font-bold"> {{props.target - props.achieved}} </p>
        <p class="text-gray-400 text-2xl"> cal left </p>
    </div>
    <p class="text-gray-400 mt-2"> {{ props.achieved }} consumed • {{ props.target }} target </p>
    <div>
        <ProgressBar :progress="Math.round((props.achieved/props.target)*100)" />
    </div>
</div>

</template>


<script setup>

import ProgressBar from './ProgressBarComponent.vue';
const props = defineProps({
  target: {
    type: Number,
    default: 0
  },
  achieved: {
    type: Number,
    default: 0
  }
});
</script>