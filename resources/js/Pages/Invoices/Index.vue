<script setup>
import Navbar from '@/Components/Navbar.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
  invoices: Array,
})
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Invoices" />

    <div>invoices page</div>
  </AuthenticatedLayout>
</template>
