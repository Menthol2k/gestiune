<template>

    <Head title="Adaugare client nou" />

    <Layout :breadcrumbs="['Nomenclatoare', 'Clienti', 'Adaugare client']" title="Adaugare client nou">
        <div>
            <div class="mx-auto">
                <div class="overflow-hidden bg-white sm:rounded-lg">
                    <div class="text-gray-900">
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-12 gap-3">
                                <div class="col-span-12 sm:col-span-3 flex items-center space-x-2 rounded-lg bg-white">
                                    <div class="flex-1">
                                        <InputLabel :required="true" for="cui" value="CUI societate"
                                            class="text-gray-700 font-medium" />
                                        <TextInput id="cui" type="text"
                                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                            v-model="form.cui" autofocus autocomplete="cui" />
                                        <InputError class="mt-2 text-red-500 text-sm" :message="errors.cui" />
                                    </div>

                                    <div :class="errors.cui ? 'mt-0' : 'mt-6'">
                                        <button type="button" @click="fetchCompanyData"
                                            class="bg-gray-200 hover:bg-gray-300 p-2 rounded-lg shadow-sm transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-3">
                                    <InputLabel :required="true" for="name" value="Denumire societate" />

                                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                        autocomplete="name" />

                                    <InputError class="mt-2" :message="errors.name" />
                                </div>

                                <div class="col-span-12 sm:col-span-3">
                                    <InputLabel :required="true" for="reg_com" value="Nr. Reg. Com." />

                                    <TextInput id="reg_com" type="text" class="mt-1 block w-full" v-model="form.reg_com"
                                        autocomplete="reg_com" />

                                    <InputError class="mt-2" :message="errors.reg_com" />
                                </div>

                                <div class="col-span-12 sm:col-span-3">
                                    <InputLabel for="capital_social" value="Capital social" />

                                    <TextInput id="capital_social" type="text" class="mt-1 block w-full"
                                        v-model="form.capital_social" autocomplete="capital_social" />

                                    <InputError class="mt-2" :message="errors.capital_social" />
                                </div>

                                <div class="col-span-12">
                                    <InputLabel :required="true" for="office_address" value="Adresa sediului social" />

                                    <TextInput id="office_address" type="text" class="mt-1 block w-full"
                                        v-model="form.office_address" autocomplete="office_address" />

                                    <InputError class="mt-2" :message="errors.office_address" />
                                </div>

                                <div class="col-span-12 sm:col-span-4">
                                    <InputLabel :required="true" for="contact_person" value="Persoana de contact" />

                                    <TextInput id="contact_person" type="text" class="mt-1 block w-full"
                                        v-model="form.contact_person" autocomplete="contact_person" />

                                    <InputError class="mt-2" :message="errors.contact_person" />
                                </div>

                                <div class="col-span-12 sm:col-span-4">
                                    <InputLabel :required="true" for="email" value="Email" />

                                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                                        autocomplete="email" />

                                    <InputError class="mt-2" :message="errors.email" />
                                </div>

                                <div class="col-span-12 sm:col-span-4">
                                    <InputLabel :required="true" for="phone" value="Numar de telefon" />

                                    <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone"
                                        autocomplete="phone" />

                                    <InputError class="mt-2" :message="errors.phone" />
                                </div>

                                <div class="col-span-12 sm:col-span-3">
                                    <InputLabel for="euid" value="EUID" />

                                    <TextInput id="euid" type="text" class="mt-1 block w-full" v-model="form.euid"
                                        autocomplete="euid" />

                                    <InputError class="mt-2" :message="errors.euid" />
                                </div>

                                <div class="col-span-12 sm:col-span-3">
                                    <InputLabel for="bank" value="Banca" />

                                    <TextInput id="bank" type="text" class="mt-1 block w-full" v-model="form.bank"
                                        autocomplete="bank" />

                                    <InputError class="mt-2" :message="errors.bank" />
                                </div>

                                <div class="col-span-12 sm:col-span-3">
                                    <InputLabel for="bank_account" value="IBAN" />

                                    <TextInput id="bank_account" type="text" class="mt-1 block w-full"
                                        v-model="form.bank_account" autocomplete="bank_account" />

                                    <InputError class="mt-2" :message="errors.bank_account" />
                                </div>
                                <div class="col-span-12 sm:col-span-3 flex items-center justify-center mt-4">
                                    <Toggle v-model="form.vat" label="Platitor TVA" />
                                </div>
                            </div>
                            <div class="flex gap-4 justify-between mt-5">
                                <Link href="/clients"
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
import { Head, Link } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Toggle from '@/Components/Toggle.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        Layout, Head, Link, InputLabel,
        TextInput, InputError, Toggle
    },

    props: {
        errors: Object,
    },

    data() {
        return {
            form: useForm({
                cui: '',
                name: '',
                contact_person: '',
                email: '',
                phone: '',
                reg_com: '',
                office_address: '',
                capital_social: '',
                euid: '',
                bank: '',
                bank_account: '',
                iban: '',
                vat: false,
                loading: false,
                created_by: this.$page.props.auth.user.id
            }),
        }
    },

    methods: {
        submit() {
            this.form.loading = true;
            this.$inertia.post('/clients/store', this.form, {
                inline: 'default',
                onSuccess: () => {
                    console.log("Clientul a fost salvat cu success!");
                    this.$toast.success(this.$page.props.toast.success.message);
                },
                onError: (errors) => {
                    console.error(errors);
                }
            });
            this.form.loading = false;
        },
        async fetchCompanyData() {
            await axios.get(`/itrack/${this.form.cui}`)
                .then((response) => {
                    let company = response.data;
                    this.form.cui = company.cui;
                    this.form.name = company.name;
                    this.form.office_address = company.office_address;
                    this.form.reg_com = company.reg_com;
                    this.form.phone = company.phone;
                    this.form.vat = company.vat;
                })
                .catch((errors) => {
                    console.error(errors);
                })
        }
    }
}

</script>