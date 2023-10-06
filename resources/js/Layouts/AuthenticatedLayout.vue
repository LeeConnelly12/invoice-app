<script setup>
import Nav from '@/Components/Nav.vue'
import Sidebar from '@/Components/Sidebar.vue'
import { inject } from 'vue'
import { ref } from 'vue'

const open = ref(false)

const activeInvoice = ref({
    status: 0,
    items: [],
})

const emitter = inject('emitter')

emitter.on('open', (invoice) => {
    activeInvoice.value = invoice ?? null
    open.value = true
})

emitter.on('close', () => {
    activeInvoice.value = null
    open.value = false
})
</script>

<template>
    <div class="min-h-screen grid grid-rows-[auto_1fr]">
        <Nav />
        <main>
            <slot />
        </main>
        <Sidebar :open="open" :invoice="activeInvoice" />
    </div>
</template>
