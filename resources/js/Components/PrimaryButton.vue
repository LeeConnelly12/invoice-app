<script setup>
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
        class="bg-purple rounded-full h-11 text-white font-bold flex items-center"
    >
        <slot />
    </button>
</template>
