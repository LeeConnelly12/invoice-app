<script setup>
import Navbar from '@/Components/Navbar.vue'
</script>

<template>
  <div>
    <Navbar />
    <main class="px-6 pt-8">
      <slot />
    </main>
  </div>
</template>
