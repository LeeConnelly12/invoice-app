<script setup>
import { ref } from 'vue'
import Chevron from '@/Components/SVG/Chevron.vue'

const open = ref(false)

defineProps({
    modelValue: String,
    label: String,
})

defineEmits(['update:modelValue'])
</script>

<template>
    <button @click="open = !open" type="button" class="flex items-center gap-2">
        <p class="font-bold">{{ label }}</p>
        <Chevron class="transform" :class="{ 'rotate-180': open }" />
    </button>
    <div
        v-if="open"
        class="absolute top-full right-0 bg-white rounded-md shadow-md pl-4 pr-6 pt-3 pb-3 mt-1 justify-items-start grid gap-1"
    >
        <button @click="$emit('update:modelValue', 2)" type="button">
            Paid
        </button>
        <button @click="$emit('update:modelValue', 1)" type="button">
            Pending
        </button>
        <button @click="$emit('update:modelValue', 0)" type="button">
            Draft
        </button>
    </div>
</template>
