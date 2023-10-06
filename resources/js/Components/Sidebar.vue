<script setup>
import { inject } from 'vue'
import { useForm } from '@inertiajs/vue3'
import Chevron from '@/Components/SVG/Chevron.vue'
import Delete from '@/Components/SVG/Delete.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import { watch } from 'vue'

const props = defineProps({
    open: {
        type: Boolean,
        default: false,
    },
    invoice: Object,
})

const emitter = inject('emitter')

const form = useForm({
    invoice: props.invoice,
})

const submit = () => {
    form.post('/invoices', {
        onSuccess: () => emitter.emit('close'),
    })
}

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

watch(
    () => props.invoice,
    (value) => {
        form.invoice = value ?? {
            status: 0,
            items: [],
        }
    },
)
</script>

<template>
    <aside
        class="bg-white w-full fixed top-[4.5rem] sm:top-20 left-0 transform transition-transform pt-8 h-[calc(100%-4.5rem)] sm:h-[calc(100%-5rem)] overflow-y-auto"
        :class="{ '-translate-x-full': !open }"
    >
        <button
            @click="emitter.emit('close')"
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
                    <InputLabel for="address" value="Street Address" />
                    <TextInput
                        id="address"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.address"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.address']"
                    />
                </div>
                <div>
                    <InputLabel for="city" value="City" />
                    <TextInput
                        id="city"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.city"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.city']"
                    />
                </div>
                <div>
                    <InputLabel for="post_code" value="Post Code" />
                    <TextInput
                        id="postcode"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.postcode"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.postcode']"
                    />
                </div>
                <div class="col-span-full">
                    <InputLabel for="country" value="Country" />
                    <TextInput
                        id="country"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.country"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.country']"
                    />
                </div>
            </div>
            <p class="text-purple pt-10 font-bold col-span-full">Bill To</p>
            <div class="grid grid-cols-2 gap-6 pt-6">
                <div class="col-span-full">
                    <InputLabel for="client_name" value="Client's name" />
                    <TextInput
                        id="client_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.client_name"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.client_name']"
                    />
                </div>
                <div class="col-span-full">
                    <InputLabel for="client_email" value="Client's email" />
                    <TextInput
                        id="client_email"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.client_email"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.client_email']"
                    />
                </div>
                <div class="col-span-full">
                    <InputLabel for="client_address" value="Street Address" />
                    <TextInput
                        id="client_address"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.client_address"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.client_address']"
                    />
                </div>
                <div>
                    <InputLabel for="cilent_city" value="City" />
                    <TextInput
                        id="cilent_city"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.client_city"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.client_city']"
                    />
                </div>
                <div>
                    <InputLabel for="client_postcode" value="Post Code" />
                    <TextInput
                        id="client_postcode"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.client_postcode"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.client_postcode']"
                    />
                </div>
                <div class="col-span-full">
                    <InputLabel for="client_country" value="Country" />
                    <TextInput
                        id="client_country"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.client_country"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.client_country']"
                    />
                </div>
            </div>
            <div class="pt-10 grid gap-y-6">
                <div>
                    <InputLabel for="invoice_date" value="Invoice Date" />
                    <TextInput
                        id="invoice_date"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.invoice.invoice_date"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.invoice_date']"
                    />
                </div>
                <div>
                    <InputLabel for="payment_terms" value="Payment Terms" />
                    <TextInput
                        id="payment_terms"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.payment_terms"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.payment_terms']"
                    />
                </div>
                <div>
                    <InputLabel
                        for="project_description"
                        value="Project Description"
                    />
                    <TextInput
                        id="project_description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.invoice.project_description"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors['invoice.project_description']"
                    />
                </div>
            </div>
            <p class="text-lg text-gray font-bold pt-16">Item List</p>
            <div v-if="form.invoice.items.length > 0" class="grid gap-y-6 pt-6">
                <div
                    v-for="(item, index) in form.invoice.items"
                    :key="item.id"
                    class="grid grid-cols-[1fr_1fr_1fr_auto] grid-rows-[auto_4.5rem] gap-x-4 gap-y-6"
                >
                    <div class="col-span-full">
                        <InputLabel :for="`name${index}`" value="Name" />
                        <TextInput
                            :id="`name${index}`"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.invoice.items[index].name"
                        />
                        <InputError
                            class="mt-2"
                            :message="
                                form.errors[`invoice.items.${index}.name`]
                            "
                        />
                    </div>
                    <div>
                        <InputLabel
                            :for="`quantity${index}`"
                            value="Quantity"
                        />
                        <TextInput
                            :id="`quantity${index}`"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="form.invoice.items[index].quantity"
                        />
                        <InputError
                            class="mt-2"
                            :message="
                                form.errors[`invoice.items.${index}.quantity`]
                            "
                        />
                    </div>
                    <div>
                        <InputLabel :for="`price${index}`" value="Price" />
                        <TextInput
                            :id="`price${index}`"
                            type="number"
                            step="0.01"
                            class="mt-1 block w-full"
                            v-model="form.invoice.items[index].price"
                        />
                        <InputError
                            class="mt-2"
                            :message="
                                form.errors[`invoice.items.${index}.price`]
                            "
                        />
                    </div>
                    <div>
                        <label class="text-light-blue text-sm">Total</label>
                        <p class="mt-3">{{ item.quantity * item.price }}</p>
                    </div>
                    <button
                        @click="removeItem(index)"
                        type="button"
                        class="mt-6"
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
            <div
                class="h-24 mt-20 -mx-6 shadow-lg px-6 flex justify-center gap-2 items-center"
            >
                <button
                    type="button"
                    class="bg-light-gray h-12 rounded-full text-gray font-bold px-4"
                    @click="emitter.emit('close')"
                >
                    Discard
                </button>
                <button
                    type="submit"
                    class="bg-blue h-12 rounded-full text-gray font-bold px-4"
                    @click="form.invoice.status = 0"
                >
                    Save as Draft
                </button>
                <button
                    type="submit"
                    class="bg-purple rounded-full h-12 text-white font-bold flex items-center px-4 gap-2"
                    @click="form.invoice.status = 1"
                >
                    Save
                </button>
            </div>
        </form>
    </aside>
</template>
