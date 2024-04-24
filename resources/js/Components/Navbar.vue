<script setup>
import { Link } from '@inertiajs/vue3'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Moon from '@/Components/Moon.vue'
</script>

<template>
  <aside class="h-[4.5rem] bg-[#373B53] md:h-20">
    <nav class="grid grid-cols-[auto_1fr_auto_auto] items-center">
      <Link href="/">
        <ApplicationLogo class="h-[4.5rem] w-[4.5rem] md:h-20 md:w-20" />
      </Link>
      <button class="col-start-3 mr-6 md:mr-8" type="button">
        <Moon class="" />
      </button>
      <div class="border-l border-l-blue-500 p-5 md:px-8 md:py-6">
        <img
          class="h-8 w-8 rounded-full"
          src="/images/image-avatar.jpg"
          alt="Avatar"
          width="80"
          height="80"
        />
      </div>
    </nav>
  </aside>
</template>
