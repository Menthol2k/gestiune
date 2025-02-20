<template>
    <Head title="Procese verbale PF" />
    <Layout :breadcrumbs="['Documente', 'Procese verbale de punere in functiune']" title="Procese verbale de punere in functiune">
        <div>
            <div class="mx-auto">
                <div class="overflow-hidden bg-white sm:rounded-lg">
                    <div class="text-gray-900">
                        <div class="flow-root">
                            <div class="flex justify-between items-center mb-3 space-x-2">
                                <div class="flex items-center w-fit space-x-3">
                                    <Menu as="div" class="relative inline-block text-left">
                                        <div>
                                            <MenuButton v-tippy="'Rezultate per pagina'"
                                                class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                {{ params.perPage }}
                                                <ChevronDownIcon class="-mr-1 size-5 text-gray-400"
                                                    aria-hidden="true" />
                                            </MenuButton>
                                        </div>

                                        <transition enter-active-class="transition ease-out duration-100"
                                            enter-from-class="transform opacity-0 scale-95"
                                            enter-to-class="transform opacity-100 scale-100"
                                            leave-active-class="transition ease-in duration-75"
                                            leave-from-class="transform opacity-100 scale-100"
                                            leave-to-class="transform opacity-0 scale-95">
                                            <MenuItems
                                                class="absolute right-0 z-40 mt-2 w-fit origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                                <div class="py-1">
                                                    <MenuItem v-slot="{ active }">
                                                    <button @click="params.perPage = 10"
                                                        :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                        10</button>
                                                    </MenuItem>
                                                    <MenuItem v-slot="{ active }">
                                                    <button @click="params.perPage = 15"
                                                        :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                        15</button>
                                                    </MenuItem>
                                                    <MenuItem v-slot="{ active }">
                                                    <button @click="params.perPage = 25"
                                                        :class="[active ? 'bg-gray-100 text-gray-900 outline-none' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                        25</button>
                                                    </MenuItem>
                                                </div>
                                            </MenuItems>
                                        </transition>
                                    </Menu>
                                    <div class="relative mx-auto text-gray-600">
                                        <input v-model="params.search"
                                            class="border border-gray-300 focus:border-green-500 focus:ring-green-500 bg-white px-5 pr-16 rounded-lg text-sm focus:outline-none"
                                            type="text" name="search" placeholder="Cautare">
                                        <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                                            <svg class="text-gray-600 h-4 w-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                                x="0px" y="0px" viewBox="0 0 56.966 56.966"
                                                style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                                width="512px" height="512px">
                                                <path
                                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <Link href="/commissionings/create"
                                        class="rounded-full sm:rounded-lg transition-all bg-green-600 p-1.5 text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 flex items-center sm:pr-3 sm:pl-2 sm:space-x-2">
                                    <PlusIcon class="size-5" aria-hidden="true" />
                                    <p class="hidden md:inline">Adauga</p>
                                    </Link>
                                </div>
                            </div>
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-4">
                                                    Client
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <Header @sort="sort('number')" :params="params" field="number">Numar
                                                    </Header>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <Header @sort="sort('year')" :params="params"
                                                        field="year">AN
                                                    </Header>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Adaugat de
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 stext-left text-sm font-semibold text-gray-900">
                                                    <Header @sort="sort('items_count')" :params="params" field="items_count">Numar elemente
                                                    </Header>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <Header @sort="sort('status')" :params="params" field="status">Status
                                                    </Header>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <Header @sort="sort('completed')" :params="params" field="completed">Completat la
                                                    </Header>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900 pr-6">
                                                    <h1 class="group inline-flex">
                                                        Actiuni
                                                    </h1>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr v-if="commissions.data.length == 0">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-4">
                                                    Nu exista rezultate...
                                                </td>
                                            </tr>
                                            <tr v-else v-for="commission in commissions.data" :key="commission.id"
                                                class="even:bg-gray-50">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-4">
                                                    {{ commission.client.name }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    commission.number }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    commission.year }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    commission.created_by.name }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">{{
                                                    commission.items_count }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-left">
                                                        <div>
                                                            <span 
                                                                v-if="commission.status === 1"
                                                                class="text-blue-600 px-2 py-1 rounded-md text-xs">
                                                                Nou
                                                            </span>

                                                            <span 
                                                                v-if="commission.status === 2"
                                                                class=" text-indigo-600 px-2 py-1 rounded-md text-xs">
                                                                Completat
                                                            </span>

                                                            <span 
                                                                v-if="commission.status === 3"
                                                                class="text-green-600 px-2 py-1 rounded-md text-xs">
                                                                Validat
                                                            </span>

                                                            <span 
                                                                v-if="commission.status === 4"
                                                                class="text-red-600 px-2 py-1 rounded-md text-xs">
                                                                Anulat
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    commission.completed ? moment(commission.completed).format('DD/MM/YYYY') : '-' }}</td>
                                                <td class="relative whitespace-nowrap flex justify-end pr-6 items-center mt-3.5 text-sm">
                                                    <a v-tippy="'Descarcati documentul'" :href="`/commissionings/${commission.id}/download`"
                                                        class="text-blue-500 hover:text-blue-800 tracking-wider font-extrabold mr-2">
                                                        <ArrowDownTrayIcon class="w-5 h-5"/>
                                                    </a>
                                                    <Link v-tippy="'Modificati documentul'" :href="`/commissionings/${commission.id}/edit`"
                                                        class="text-green-500 hover:text-green-600 tracking-wider font-extrabold">
                                                        <PencilSquareIcon class="w-5 h-5"/>
                                                    </Link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <Pagination class="mt-2" :links="commissions.links" :current="commissions.current_page" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script>
import Layout from '@/Layouts/Layout.vue';
import { ChevronDownIcon, PencilSquareIcon, PlusIcon, ArrowDownTrayIcon } from '@heroicons/vue/20/solid';
import Header from '@/Components/Table/Header.vue'
import { Head, Link } from '@inertiajs/vue3';
import { pickBy } from 'lodash';
import { throttle } from 'lodash';
import Pagination from '@/Components/Table/Pagination.vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import moment from 'moment';

export default {
    components: {
        Layout, Head, Link, ChevronDownIcon, PencilSquareIcon,
        Header, Menu, MenuButton, MenuItem, MenuItems, PlusIcon, Pagination,
        ArrowDownTrayIcon
    },

    props: {
        commissions: Object,
        filters: Object,
        perPage: Number,
    },

    data() {
        return {
            params: {
                search: this.filters.search,
                direction: this.filters.direction,
                field: this.filters.field,
                perPage: this.perPage,
            },
        }
    },

    methods: {
        sort(field) {
            if (this.params.field !== field) {
                this.params.field = field;
                this.params.direction = 'asc';
            } else if (this.params.direction === null) {
                this.params.direction = 'asc';
            } else if (this.params.direction === 'asc') {
                this.params.direction = 'desc';
            } else if (this.params.direction === 'desc') {
                this.removeSort();
            }
        },
        removeSort() {
            this.params.direction = null;
            this.params.field = null;
            this.filters.direction = null;
            this.filters.field = null;
        }
    },

    created(){
        this.moment = moment;
    },

    watch: {
        params: {
            deep: true,
            handler: throttle(function () {
                let query = pickBy(this.params);
                this.$inertia.get('commissionings', Object.keys(query).length > 0 ? query : { remember: 'forget' }, { preserveState: true });
            })
        }
    }
}

</script>