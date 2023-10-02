<script setup>
import Chevron from '@/Components/SVG/Chevron.vue'
import Delete from '@/Components/SVG/Delete.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    open: {
        type: Boolean,
        default: true,
    },
    invoice: {
        type: Object,
        default: {
            items: [],
        },
    },
})

const form = useForm({
    invoice: props.invoice,
})

const submit = () => {}

const addItem = () => {
    form.invoice.items.push({
        name: '',
        quantity: 1,
        price: 0,
    })
}

const removeItem = (index) => {
    form.invoice.items.splice(index, 1)
}
</script>

<template>
    <aside
        class="bg-white min-h-full w-full absolute top-[4.5rem] sm:top-20 left-0 transform transition-transform pt-8"
        :class="{ '-translate-x-full': !open }"
    >
        <button
            @click="open = !open"
            type="button"
            class="flex gap-4 items-center pl-6 font-bold"
        >
            <Chevron class="transform rotate-90" />
            <p>Go back</p>
        </button>
        <form @submit.prevent="submit" class="pt-6 px-6 relative">
            <h2 class="font-bold text-2xl">New Invoice</h2>
            <p class="text-purple pt-4 font-bold col-span-full">Bill From</p>
            <div class="grid grid-cols-2 gap-6 pt-6">
                <div class="col-span-full">
                    <label class="text-light-blue">Street Address</label>
                    <input class="border-border-gray w-full mt-1" type="text" />
                </div>
                <div>
                    <label class="text-light-blue">City</label>
                    <input class="border-border-gray w-full mt-1" type="text" />
                </div>
                <div>
                    <label class="text-light-blue">Post Code</label>
                    <input class="border-border-gray w-full mt-1" type="text" />
                </div>
                <div class="col-span-full">
                    <label class="text-light-blue">Country</label>
                    <input class="border-border-gray w-full mt-1" type="text" />
                </div>
            </div>
            <p class="text-purple pt-10 font-bold col-span-full">Bill To</p>
            <div class="grid grid-cols-2 gap-6 pt-6">
                <div class="col-span-full">
                    <label class="text-light-blue">Client's Name</label>
                    <input class="border-border-gray w-full mt-1" type="text" />
                </div>
                <div class="col-span-full">
                    <label class="text-light-blue">Client's Email</label>
                    <input
                        class="border-border-gray w-full mt-1"
                        type="email"
                    />
                </div>
                <div class="col-span-full">
                    <label class="text-light-blue">Street Address</label>
                    <input
                        class="border-border-gray w-full mt-1"
                        type="email"
                    />
                </div>
                <div>
                    <label class="text-light-blue">City</label>
                    <input class="border-border-gray w-full mt-1" type="text" />
                </div>
                <div>
                    <label class="text-light-blue">Post Code</label>
                    <input class="border-border-gray w-full mt-1" type="text" />
                </div>
                <div class="col-span-full">
                    <label class="text-light-blue">Country</label>
                    <input class="border-border-gray w-full mt-1" type="text" />
                </div>
            </div>
            <div class="pt-10 grid gap-y-6">
                <div>
                    <label class="text-light-blue">Invoice Date</label>
                    <input class="border-border-gray w-full mt-1" type="text" />
                </div>
                <div>
                    <label class="text-light-blue">Payment Terms</label>
                    <input class="border-border-gray w-full mt-1" type="text" />
                </div>
                <div>
                    <label class="text-light-blue">Project Description</label>
                    <input class="border-border-gray w-full mt-1" type="text" />
                </div>
            </div>
            <p class="text-lg text-gray font-bold pt-16">Item List</p>
            <div v-if="form.invoice.items.length > 0" class="grid gap-y-6 pt-6">
                <div
                    v-for="item in form.invoice.items"
                    :key="item.id"
                    class="grid grid-cols-[1fr_1fr_1fr_auto] gap-x-4 gap-y-6 items-end"
                >
                    <div class="col-span-full">
                        <label class="text-light-blue">Item Name</label>
                        <input
                            v-model="item.name"
                            class="border-border-gray w-full mt-1"
                            type="text"
                        />
                    </div>
                    <div>
                        <label class="text-light-blue">Qty.</label>
                        <input
                            v-model="item.quantity"
                            class="border-border-gray w-full mt-1"
                            type="text"
                        />
                    </div>
                    <div>
                        <label class="text-light-blue">Price</label>
                        <input
                            v-model="item.price"
                            class="border-border-gray w-full mt-1"
                            type="text"
                        />
                    </div>
                    <div>
                        <label class="text-light-blue">Total</label>
                        <p>{{ item.quantity * item.price }}</p>
                    </div>
                    <button
                        @click="removeItem(index)"
                        type="button"
                        class="mb-4"
                    >
                        <Delete />
                    </button>
                </div>
            </div>
            <button
                @click="addItem"
                type="button"
                class="flex gap-2 w-full items-center justify-center bg-light-gray rounded-3xl h-12 text-light-blue"
                :class="form.invoice.items.length > 0 ? 'mt-12' : 'mt-6'"
            >
                <svg class="w-[11px] h-[11px]" viewBox="0 0 11 11">
                    <path
                        d="M6.313 10.023v-3.71h3.71v-2.58h-3.71V.023h-2.58v3.71H.023v2.58h3.71v3.71z"
                        fill="currentColor"
                    />
                </svg>
                <p>Add New Item</p>
            </button>
            <div class="h-24 mt-20 -mx-6 shadow-lg px-6 flex justify-end gap-2">
                <button @click="open = !open" type="button">Cancel</button>
                <button type="submit">Save Changes</button>
            </div>
        </form>
    </aside>
</template>
