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

        <div class="mt-6" v-if="emails.length">
            <ul class="space-y-2">
                <li class="flex items-center justify-between" v-for="email in emails" :key="email">
                    <span class="text-sm">{{ email }}</span>

                    <button type="button" @click="deleteEmail(email)">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path
                                d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
                        </svg>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import {useForm, router} from '@inertiajs/vue3'

const props = defineProps({
    site: Object,
    emails: Array
})

const form = useForm({
    email: ''
})

const submit = () => {
    form.post(route('notifications.email', props.site.data), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
        }
    })
}

const deleteEmail = (email) => {
    router.delete(route('notifications.email.delete', {
        site: props.site.data.id,
        email
    }))
}
</script>
