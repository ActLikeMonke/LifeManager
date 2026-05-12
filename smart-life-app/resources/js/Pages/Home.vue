<template>
  <div class="p-6 bg-[#1a1a1a] text-white min-h-screen">
    <h1 class="text-3xl font-bold">Dashboard</h1>
    <CalorieComponent :target="2000" :achieved="1700"> </CalorieComponent>
    <MacrosComponent :protein="100" :proteinTarget="150" :carbs="200" :carbsTarget="300" :fats="50" :fatsTarget="100"> </MacrosComponent>
  </div>
</template>

<script setup>
    import CalorieComponent from '@/Components/CalorieComponent.vue';
    import MacrosComponent from '@/Components/MacrosComponent.vue';
</script>