<script setup>
defineProps({
    status: Number,
})

const statusText = (status) => {
    const statuses = {
        0: 'Draft',
        1: 'Pending',
        2: 'Paid',
    }

    return statuses[status]
}

const statusColor = (status) => {
    const colors = {
        0: 'bg-blue/10 text-blue',
        1: 'bg-orange/10 text-orange',
        2: 'bg-green/10 text-green',
    }

    return colors[status]
}
</script>

<template>
    <div
        :class="statusColor(status)"
        class="w-28 h-10 inline-flex items-center justify-center gap-2 font-bold rounded-md"
    >
        <div class="rounded-full w-2 h-2 bg-current"></div>
        {{ statusText(status) }}
    </div>
</template>
