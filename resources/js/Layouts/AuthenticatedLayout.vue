<script setup>
import Nav from '@/Components/Nav.vue'
import Sidebar from '@/Components/Sidebar.vue'
</script>

<template>
    <div class="min-h-screen grid grid-rows-[auto_1fr]">
        <Nav />
        <main>
            <slot />
        </main>
        <Sidebar />
    </div>
</template>
