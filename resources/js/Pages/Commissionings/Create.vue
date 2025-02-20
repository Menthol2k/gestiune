<template>

    <Head title="Adaugare proces verbal PF" />

    <Layout :breadcrumbs="['Documente', 'Proces verbal de PF', 'Adaugare proces verbal PF']"
        title="Adaugare nou proces verbal de punere in functiune">
        <div>
            <div class="mx-auto">
                <div class="overflow-hidden bg-white sm:rounded-lg">
                    <div class="text-gray-900">
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-12 gap-3">
                                <div class="col-span-12">
                                    <combo-box :error="errors.client_id" :required="true" label="Client" class="z-90"
                                        :options="clients" v-model="form.client_id" placeholder="Alegeti un client" />
                                </div>

                                <div class="col-span-12">
                                    <InputLabel :required="false" for="number" value="Numar" />

                                    <TextInput disabled placeholder="Aceasta valoare se completeaza automat" id="number"
                                        type="text" class="mt-1 block w-full" v-model="form.number"
                                        autocomplete="number" />

                                    <InputError class="mt-2" :message="errors.number" />
                                </div>

                                <div class="col-span-12">
                                    <InputLabel :required="false" for="year" value="An" />

                                    <TextInput disabled placeholder="Aceasta valoare se completeaza automat" id="year"
                                        type="text" class="mt-1 block w-full" v-model="form.year" autocomplete="year" />

                                    <InputError class="mt-2" :message="errors.year" />
                                </div>

                                <div class="col-span-12">
                                    <InputLabel :required="false" for="created_by" value="Montatj realizat de" />

                                    <TextInput disabled :placeholder="$page.props.auth.user.name" id="created_by"
                                        type="text" class="mt-1 block w-full" autocomplete="created_by" />

                                    <InputError class="mt-2" :message="errors.created_by" />
                                </div>

                                <div class="col-span-12">
                                    <InputLabel :required="false" for="completed" value="Completat la data de" />

                                    <TextInput disabled :placeholder="moment().format('DD/MM/YYYY')" id="completed"
                                        type="text" class="mt-1 block w-full" autocomplete="completed" />

                                    <InputError class="mt-2" :message="errors.completed" />
                                </div>

                            </div>
                            <div class="relative my-5">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                    <div class="w-full border-t border-gray-300" />
                                </div>
                                <div class="relative flex justify-center">
                                    <span class="bg-white px-2 text-sm text-gray-500">Locații</span>
                                </div>
                            </div>

                            <transition-group name="fade" tag="div" class="grid grid-cols-12 gap-3">
                                <div v-for="(item, index) in form.items" :key="index"
                                    class="col-span-12 flex justify-between space-x-3">
                                    <div class="w-full">
                                        <TextInput :placeholder="'Introdu locatia ' + (index + 1)" id="completed"
                                            type="text" class="mt-1 block w-full" v-model="form.items[index].name"
                                            autocomplete="completed" />
                                        <InputError class="mt-2" :message="errors[`items.${index}.name`]" />
                                    </div>
                                    <div class="flex justify-center items-center">
                                        <button v-if="form.items.length === (index + 1)" @click="pushNewField"
                                            class="bg-green-500 hover:bg-green-600 transition-all p-1.5 rounded-lg text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6 stroke-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </button>
                                        <button v-else @click="subtractField(index)"
                                            class="bg-red-500 hover:bg-red-600 transition-all p-1.5 rounded-lg text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </transition-group>

                            <div class="flex gap-4 justify-between mt-5">
                                <Link href="/commissionings"
                                    class="flex font-semibold items-center gap-2 bg-red-500  text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-700 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Anulează
                                </Link>

                                <button type="submit" :disabled="form.loading"
                                    :class="form.loading ? 'bg-gray-400 hover:bg-gray-300 cursor-no-drop' : ''"
                                    class="flex font-semibold items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Salvează
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Layout from '@/Layouts/Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import ComboBox from '@/Components/ComboBox.vue';
import moment from 'moment';
import { subtract } from 'lodash';
import { FireIcon } from '@heroicons/vue/20/solid';

export default {
    components: {
        Layout, Head, Link, InputLabel, TextInput, InputError,
        ComboBox
    },

    props: {
        errors: Object,
        clients: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                client_id: null,
                created_by: this.$page.props.auth.user.id,
                items: [
                    { name: '' }
                ],
                loading: false,
            }),
        }
    },

    methods: {
        pushNewField() {
            this.form.items.push({ name: '' });
        },
        subtractField(index) {
            this.form.items.splice(index, 1);
        },
        submit() {
            this.form.loading = true;
            this.$inertia.post('/commissionings/store', this.form, {
                inline: 'default',
                onSuccess: () => {
                    this.$toast.success(this.$page.props.toast.success.message);
                },
            })
            this.form.loading = false;
        }
    },

    created() {
        this.moment = moment;
    },
}


</script>
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>