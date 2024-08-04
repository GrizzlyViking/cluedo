<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {XMarkIcon, CubeTransparentIcon} from "@heroicons/vue/16/solid/index.js";
import {Head, router} from '@inertiajs/vue3';

const prop = defineProps({game: Object, sheet: Object});

const toggleState = (clue_id, person) => {
    switch (person.state) {
        case 'unknown':
            person.state = 'found';
            break;
        case 'found':
            person.state = 'unanswered';
            break;
        case 'unanswered':
            person.state = 'unknown';
            break;
    }

    router.post(route('clue.update', {
        'clue': clue_id,
    }), {
        'name': person.name,
        'state': person.state,
    }, { preserveScroll: true });
}
</script>

<template>
    <Head title="Clue Sheet" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clue sheet</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="mt-8 flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8"></th>
                                                <th v-for="person in prop.game.participants" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ person.name }}</th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr><td
                                                colspan="4"
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm bg-gray-200 font-medium text-gray-900 sm:pl-6 lg:pl-8"
                                            >Who</td></tr>
                                            <tr v-for="clue in prop.sheet.Who">
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ clue.element }}</td>
                                                <td v-for="person in clue.row"
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 border border-gray-200"
                                                    @click="toggleState(clue.id, person)"
                                                >
                                                    <XMarkIcon v-if="person.state === 'found'" class="h-12 w-12 text-gray-900" aria-hidden="true" />
                                                    <CubeTransparentIcon v-else-if="person.state === 'unanswered'" class="h-12 w-12 text-gray-900" aria-hidden="true" />
                                                    <XMarkIcon v-else class="h-12 w-12 text-white" />
                                                </td>
                                            </tr>
                                            <tr><td
                                                colspan="4"
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm bg-gray-200 font-medium text-gray-900 sm:pl-6 lg:pl-8"
                                            >What</td></tr>
                                            <tr v-for="clue in prop.sheet.What">
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ clue.element }}</td>
                                                <td v-for="person in clue.row"
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500  border border-gray-200"
                                                    @click="toggleState(clue.id, person)"
                                                >
                                                    <XMarkIcon v-if="person.state === 'found'" class="h-12 w-12 text-gray-900" aria-hidden="true" />
                                                    <CubeTransparentIcon v-else-if="person.state === 'unanswered'" class="h-12 w-12 text-gray-900" aria-hidden="true" />
                                                    <XMarkIcon v-else class="h-12 w-12 text-white" />
                                                </td>
                                            </tr>
                                            <tr><td
                                                colspan="4"
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm bg-gray-200 font-medium text-gray-900 sm:pl-6 lg:pl-8"
                                            >Where</td></tr>
                                            <tr v-for="clue in prop.sheet.Where">
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ clue.element }}</td>
                                                <td v-for="person in clue.row"
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500  border border-gray-200"
                                                    @click="toggleState(clue.id, person)"
                                                >
                                                    <XMarkIcon v-if="person.state === 'found'" class="h-12 w-12 text-gray-900" aria-hidden="true" />
                                                    <CubeTransparentIcon v-else-if="person.state === 'unanswered'" class="h-12 w-12 text-gray-900" aria-hidden="true" />
                                                    <XMarkIcon v-else class="h-12 w-12 text-white" />
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
