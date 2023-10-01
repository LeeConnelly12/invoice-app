<script setup>
import Nav from '@/Components/Nav.vue'
</script>

<template>
    <div class="min-h-screen grid grid-rows-[auto_1fr]">
        <Nav />
        <main>
            <slot />
        </main>
    </div>
</template>
