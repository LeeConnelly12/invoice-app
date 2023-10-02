<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import AddButton from '@/Components/AddButton.vue'
import InvoiceFilter from '@/Components/InvoiceFilter.vue'
import Empty from '@/Components/SVG/Empty.vue'

defineProps({
    invoices: Array,
})

const form = useForm({
    status: null,
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
                <p class="text-light-blue text-sm">No invoices</p>
            </div>

            <div class="relative">
                <InvoiceFilter
                    v-model="form.status"
                    label="Filter"
                    @update:model-value="form.get('/')"
                />
            </div>

            <AddButton>New</AddButton>
        </div>

        <div v-if="invoices.length > 0" class="grid gap-4">
            <button
                v-for="invoice in invoices"
                :key="invoice.id"
                type="button"
                class="bg-white rounded-lg p-6 grid-cols-2 grid-rows-3"
            >
                <p>{{ invoice.invoice_id }}</p>
                <p>{{ invoice.client_name }}</p>
                <p>Due 19 Aug 2021</p>
                <div>{{ invoice.status }}</div>
                <p>$1,800.90</p>
            </button>
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
