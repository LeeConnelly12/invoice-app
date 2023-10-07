<script setup>
import { inject } from 'vue'
import InvoiceStatus from '@/Components/InvoiceStatus.vue'

defineProps({
    invoice: Object,
})

const emitter = inject('emitter')
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
            <p class="text-light-blue text-sm text-left">
                <template v-if="invoice.formatted_invoice_date">
                    Due {{ invoice.formatted_invoice_date }}
                </template>
                <template v-else>Due date not set</template>
            </p>
            <div class="text-right row-span-2">
                <InvoiceStatus :status="invoice.status" />
            </div>
            <p class="font-bold text-left mt-1">$1,800.90</p>
        </div>
    </button>
</template>
