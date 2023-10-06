<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import AddButton from '@/Components/AddButton.vue'
import Invoice from '@/Components/Invoice.vue'
import InvoiceFilter from '@/Components/InvoiceFilter.vue'
import Empty from '@/Components/SVG/Empty.vue'
import { inject } from 'vue'
import { computed } from 'vue'

const props = defineProps({
    invoices: Array,
})

const emitter = inject('emitter')

const form = useForm({
    status: null,
})

const invoiceCount = computed(() => {
    if (props.invoices.length === 0) {
        return 'No invoices'
    }

    if (props.invoices.length === 1) {
        return '1 invoice'
    }

    return props.invoices.length + ' invoices'
})
</script>

<template>
    <Layout>
        <Head title="Invoices" />
        <div
            class="grid grid-cols-[1fr_auto_auto] gap-4 px-6 pt-9 items-center"
        >
            <div>
                <h1 class="text-2xl font-bold leading-none">Invoices</h1>
                <p class="text-light-blue text-sm">
                    {{ invoiceCount }}
                </p>
            </div>

            <div class="relative">
                <InvoiceFilter
                    v-model="form.status"
                    label="Filter"
                    @update:model-value="form.get('/')"
                />
            </div>

            <AddButton @click="emitter.emit('open')">New</AddButton>
        </div>

        <div v-if="invoices.length > 0" class="grid gap-4 px-6 pt-8">
            <Invoice
                v-for="invoice in invoices"
                :key="invoice.id"
                :invoice="invoice"
            />
        </div>

        <div v-else class="grid place-items-center text-center pt-24">
            <Empty />
            <h2 class="font-bold text-2xl pt-10">There is nothing here</h2>
            <p class="text-light-blue text-sm max-w-[200px] pt-5">
                Create an invoice by clicking the
                <strong>New</strong> button and get started
            </p>
        </div>
    </Layout>
</template>
