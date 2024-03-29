<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ site?.data.domain }}</h2>
                <div>
                    <SiteSelector :sites="sites?.data"/>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <template v-if="!site">
                    <p class="text-center text-gray-500 font-medium text-sm">No sites yet. Create one to get started</p>
                </template>
                <template v-else>
                    <form @submit.prevent="storeEndpoint"
                          class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-start p-3 mt-4 space-x-2">
                        <div class="grow">
                            <InputLabel for="location" value="Location" class="sr-only"/>
                            <TextInput id="location" type="text" class="block w-full h-9 text-sm"
                                       v-model="endpointForm.location"
                                       placeholder="e.g. /pricing"/>
                            <InputError class="mt-2" :message="endpointForm.errors.location"/>
                        </div>
                        <div>
                            <InputLabel for="frequency" value="Frequency" class="sr-only"/>
                            <select name="frequency" id="frequency"
                                    v-model="endpointForm.frequency"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-9 leading-none text-sm">
                                <option :value="frequency.frequency"
                                        v-for="frequency in page.props.endpointFrequencies.data"
                                        :key="frequency.frequency">
                                    {{ frequency.label }}
                                </option>
                            </select>
                        </div>
                        <PrimaryButton>
                            Add
                        </PrimaryButton>
                    </form>
                    <div class="mt-8 flex flex-col">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                            Currently monitoring ({{ endpoints.data.length }})
                        </h2>
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 mt-3">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div
                                    class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full table-fixed divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="min-w-[12rem] pl-4 py-3.5 px-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                Location
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Frequency
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Last check
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Last status
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Uptime
                                            </th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                <span class="sr-only">Delete</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                        <Endpoint v-for="endpoint in endpoints.data" :key="endpoint.id"
                                                  :endpoint="endpoint"/>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">Notification channels</h2>

                        <div class="grid grid-cols-3 gap-12 mt-4">
                            <EmailNotifications :site="site" :emails="site.data.notification_emails"/>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button @click="deleteSite" class="text-red-500 text-sm">Delete site</button>
                    </div>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm, usePage, router} from '@inertiajs/vue3';
import SiteSelector from "@/Components/SiteSelector.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Endpoint from "@/Components/Endpoint.vue";
import EmailNotifications from "@/Components/EmailNotifications.vue";

const props = defineProps({
    site: Object,
    sites: Object,
    endpoints: Object
})

const page = usePage()


const endpointForm = useForm({
    location: null,
    frequency: page.props.endpointFrequencies.data[0].frequency
})

const storeEndpoint = () => {
    endpointForm.post(route('add-endpoint', props.site.data.id), {
        preserveScroll: true,
        onSuccess: () => {
            endpointForm.reset()
        }
    })
}

const deleteSite = () => {
    if (window.confirm('You sure?')) {
        router.delete(route('site.destroy', props.site.data))
    }
}
</script>
