<template>
    <li class="mt-0.5 w-full" v-if="$page.props.auth.can.viewDashboard">
        <Link @click="$emit('closeSideBar')" :class="{'bg-gray-100 rounded-lg': isUrl('dashboard') || isUrl('')}"
            class="dark:text-white dark:opacity-80 mt-4 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
            href="/dashboard">
        <div
            class="flex md:h-10 md:w-10 h-8 w-8 md:text-base text-sm items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
            <PresentationChartBarIcon class="size-6 text-green-500" />
        </div>
        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease text-gray-700">Dashboard</span>
        </Link>
    </li>
    <!-- SEPARATOR -->
    <div v-if="$page.props.auth.can.viewAdministration">
        <li class="w-full my-4">
            <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60">
                Documente</h6>
        </li>

        <li class="mt-0.5 w-full" v-if="$page.props.auth.can.viewUsers">
            <Link @click="$emit('closeSideBar')" :class="{ 'bg-gray-100 rounded-lg': isUrl('commissionings') }"
                class=" dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="/commissionings">
            <div
                class="flex md:h-10 md:w-10 h-8 w-8 md:text-base text-sm items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <Cog8ToothIcon class="size-6 text-yellow-500" />
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease text-gray-700">Proces verbal de
                PF</span>
            </Link>
        </li>
    </div>
    <!-- SEPARATOR -->
    <div v-if="$page.props.auth.can.viewAdministration">
        <li class="w-full my-4">
            <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60">
                Nomenclatoare</h6>
        </li>

        <li class="mt-0.5 w-full" v-if="$page.props.auth.can.viewUsers">
            <Link @click="$emit('closeSideBar')" :class="{ 'bg-gray-100 rounded-lg': isUrl('clients') }"
                class=" dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="/clients">
            <div
                class="flex md:h-10 md:w-10 h-8 w-8 md:text-base text-sm items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <BuildingOffice2Icon class="size-6 text-red-500" />
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease text-gray-700">Clienti</span>
            </Link>
        </li>
    </div>
    <!-- SEPARATOR -->
    <div v-if="$page.props.auth.can.viewAdministration">
        <li class="w-full my-4">
            <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60">
                Administrare</h6>
        </li>

        <li class="mt-0.5 w-full" v-if="$page.props.auth.can.viewUsers">
            <Link @click="$emit('closeSideBar')" :class="{'bg-gray-100 rounded-lg': isUrl('administration/users')}"
                class=" dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="/administration/users">
            <div
                class="flex md:h-10 md:w-10 h-8 w-8 md:text-base text-sm items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <UserGroupIcon class="size-6 text-slate-700" />
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease text-gray-700">Utilizatori</span>
            </Link>
        </li>

        <li class="mt-0.5 w-full" v-if="$page.props.auth.can.viewRoles">
            <Link @click="$emit('closeSideBar')" :class="{'bg-gray-100 rounded-lg': isUrl('administration/roles')}"
                class=" dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="/administration/roles">
            <div
                class="flex md:h-10 md:w-10 h-8 w-8 md:text-base text-sm items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <KeyIcon class="size-6 text-orange-500" />
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease text-gray-700">Roluri</span>
            </Link>
        </li>

        <li class="mt-0.5 w-full" v-if="$page.props.auth.can.viewPermissions">
            <Link @click="$emit('closeSideBar')"
                :class="{'bg-gray-100 rounded-lg': isUrl('administration/permissions')}"
                class=" dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="/administration/permissions">
            <div
                class="flex md:h-10 md:w-10 h-8 w-8 md:text-base text-sm items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <WrenchScrewdriverIcon class="size-6 text-cyan-500" />
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease text-gray-700">Permisii</span>
            </Link>
        </li>
    </div>

</template>
<script>
import {Link} from "@inertiajs/vue3";
import {
    UserGroupIcon,
    KeyIcon,
    WrenchScrewdriverIcon,
    PresentationChartBarIcon,
    BuildingOffice2Icon,
    Cog8ToothIcon
} from "@heroicons/vue/24/outline/index.js";

export default {
    components: {
        Link, UserGroupIcon, KeyIcon, WrenchScrewdriverIcon, PresentationChartBarIcon,
        BuildingOffice2Icon, Cog8ToothIcon
    },

    emits: ['closeSideBar'],

    methods: {
        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1);
            if (urls[0] === "") {
                return currentUrl === "";
            }

            return urls.filter((url) => currentUrl.startsWith(url)).length;
        },
    }
}

</script>

