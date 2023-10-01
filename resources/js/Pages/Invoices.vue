<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import Dropdown from '@/Components/Dropdown.vue'
import AddButton from '@/Components/AddButton.vue'
import Empty from '@/Components/SVG/Empty.vue'

defineProps({
    invoices: Array,
})
</script>

<template>
    <Layout>
        <Head title="Invoices" />
        <div class="grid grid-cols-[1fr_auto_auto] gap-4 px-6 pt-9">
            <div>
                <h1 class="text-2xl font-bold leading-none">Invoices</h1>
                <p class="text-light-blue text-sm">No invoices</p>
            </div>
            <Dropdown label="Filter" />
            <AddButton>New</AddButton>
        </div>
        <div class="grid place-items-center text-center pt-24">
            <Empty />
            <h2 class="font-bold text-2xl pt-10">There is nothing here</h2>
            <p class="text-light-blue text-sm max-w-[200px] pt-5">
                Create an invoice by clicking the
                <strong>New</strong> button and get started
            </p>
        </div>
    </Layout>
</template>
