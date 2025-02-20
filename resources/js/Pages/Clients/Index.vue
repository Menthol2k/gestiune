<template>

    <Head title="Clienti" />

    <Layout :breadcrumbs="['Nomenclatoare', 'Clienti']" title="Clienti">
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
                                    <Link href="/clients/create"
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
                                                    <Header @sort="sort('name')" :params="params" field="name">Societate
                                                    </Header>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <Header @sort="sort('cui')" :params="params" field="cui">CUI
                                                    </Header>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <Header @sort="sort('contact_person')" :params="params"
                                                        field="contact_person">Persoana de contact
                                                    </Header>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 stext-left text-sm font-semibold text-gray-900">
                                                    <Header @sort="sort('email')" :params="params" field="email">Email
                                                    </Header>
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    <Header @sort="sort('phone')" :params="params" field="phone">Telefon
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
                                            <tr v-if="clients.data.length == 0">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-4">
                                                    Nu exista rezultate...
                                                </td>
                                            </tr>
                                            <tr v-else v-for="client in clients.data" :key="client.id"
                                                class="even:bg-gray-50">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-4">
                                                    {{ client.name }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    client.cui }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    client.contact_person }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    client.email }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    formatPhoneNumber(client.phone) }}</td>
                                                <td class="relative whitespace-nowrap text-right text-sm pr-6">
                                                    <Link :href="`/clients/${client.id}/edit`"
                                                        class="text-green-500 hover:text-green-600 tracking-wider font-extrabold">
                                                    EDIT
                                                    </Link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <Pagination class="mt-2" :links="clients.links" :current="clients.current_page" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script>
import Layout from '@/Layouts/Layout.vue';
import { ChevronDownIcon, PencilSquareIcon, PlusIcon } from '@heroicons/vue/20/solid';
import Header from '@/Components/Table/Header.vue'
import { Head, Link } from '@inertiajs/vue3';
import { pickBy } from 'lodash';
import { throttle } from 'lodash';
import Pagination from '@/Components/Table/Pagination.vue';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'

export default {
    components: {
        Layout, Head, Link, ChevronDownIcon, PencilSquareIcon,
        Header, Menu, MenuButton, MenuItem, MenuItems, PlusIcon, Pagination
    },

    props: {
        clients: Object,
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

    computed: {
        formatPhoneNumber() {
            return (phoneNumber) => {
                let cleaned = phoneNumber.replace(/\D/g, "");

                if (/^07\d{8}$/.test(cleaned)) {
                    return cleaned.replace(/(\d{4})(\d{3})(\d{3})/, "$1-$2-$3");
                } else {
                    return phoneNumber;
                }
            };
        }
    },

    watch: {
        params: {
            deep: true,
            handler: throttle(function () {
                let query = pickBy(this.params);
                this.$inertia.get('clients', Object.keys(query).length > 0 ? query : { remember: 'forget' }, { preserveState: true });
            })
        }
    }
}

</script>