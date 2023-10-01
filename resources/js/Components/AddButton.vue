<script setup>
import Plus from '@/Components/SVG/Plus.vue'

defineProps({
    type: {
        type: String,
        default: 'button',
    },
})
</script>

<template>
    <button
        :type="type"
        class="bg-purple rounded-full h-11 text-white font-bold flex items-center pl-2 pr-4 gap-2"
    >
        <Plus />
        <p>
            <slot />
        </p>
    </button>
</template>
