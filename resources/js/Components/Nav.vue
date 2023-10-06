<script setup>
import Logo from '@/Components/SVG/Logo.vue'
import Moon from '@/Components/SVG/Moon.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <nav
        class="bg-blue h-[4.5rem] sm:h-20 grid grid-cols-[auto_1fr_auto_auto] items-center fixed left-0 right-0 top-0"
    >
        <Link href="/">
            <Logo />
        </Link>
        <button type="button" class="col-start-3 mr-6">
            <Moon />
        </button>
        <div
            class="px-6 grid place-items-center h-full border-l border-dark-gray"
        >
            <img
                src="/images/avatar.jpg"
                alt="Avatar"
                class="w-8 h-8 rounded-full"
            />
        </div>
    </nav>
</template>
