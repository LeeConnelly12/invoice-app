<script setup>
import { ref } from 'vue'
import Chevron from '@/Components/SVG/Chevron.vue'

const open = ref(false)

defineProps({
    label: String,
})
</script>

<template>
    <button @click="open = !open" type="button" class="flex items-center gap-2">
        <p class="font-bold">{{ label }}</p>
        <Chevron class="transform" :class="{ 'rotate-180': open }" />
    </button>
</template>
