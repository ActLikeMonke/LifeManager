<template>
    <nav class="bg-[#252525] p-4 text-white fixed bottom-0 left-0 w-full">
        <router-link to="/home" class="mr-4">Home</router-link>
    </nav>

    <!-- This is where your pages (like Home.vue) will appear -->
    <router-view></router-view>
</template>