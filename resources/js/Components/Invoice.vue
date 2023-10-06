<script setup>
import { inject } from 'vue'

defineProps({
    invoice: Object,
})

const emitter = inject('emitter')

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
        0: 'bg-green/10 text-green',
        1: 'bg-orange/10 text-orange',
        2: 'bg-blue/10 text-blue',
    }

    return colors[status]
}
</script>

<template>
    <button
        type="button"
        class="bg-white rounded-lg p-6 shadow-sm"
        @click="emitter.emit('open', invoice)"
    >
        <div class="flex justify-between">
            <p class="font-bold text-left flex">
                <span class="text-light-blue">#</span>
                {{ invoice.invoice_id }}
            </p>
            <p class="text-light-blue text-sm text-right">
                {{ invoice.client_name }}
            </p>
        </div>
        <div class="grid grid-cols-2 grid-rows-2 items-center pt-6">
            <p class="text-light-blue text-sm text-left">Due 19 Aug 2021</p>
            <div class="text-right row-span-2">
                <div
                    :class="statusColor(invoice.status)"
                    class="w-28 h-10 inline-flex items-center justify-center gap-2 font-bold rounded-md"
                >
                    <div class="rounded-full w-2 h-2 bg-current"></div>
                    {{ statusText(invoice.status) }}
                </div>
            </div>
            <p class="font-bold text-left mt-1">$1,800.90</p>
        </div>
    </button>
</template>
