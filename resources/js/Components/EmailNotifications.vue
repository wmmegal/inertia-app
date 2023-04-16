<template>
    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4">
        <h2 class="font-semibold text-base text-gray-800 leading-tight">Email</h2>

        <form
            v-on:submit.prevent="submit"
            class="flex items-start mt-4 space-x-2">
            <div class="grow">
                <InputLabel for="email" value="Email" class="sr-only"/>
                <TextInput id="email" type="text" class="block w-full h-9 text-sm" v-model="form.email"/>
                <InputError class="mt-2" :message="form.errors.email"/>
            </div>
            <PrimaryButton>
                Add
            </PrimaryButton>
        </form>
    </div>
</template>

<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import {useForm} from '@inertiajs/vue3'

const props = defineProps({
    site: Object,
})

const form = useForm({
    email: ''
})

const submit = () => {
    form.post(route('notifications.email', props.site.data), {
        preserveScroll: true, onSuccess: () => {
            form.reset()
        }
    })
}
</script>
