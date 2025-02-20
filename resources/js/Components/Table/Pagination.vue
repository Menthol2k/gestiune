<template>
    <nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0">
        <div class="-mt-px flex w-0 flex-1 ml-0">
            <Link :href="links[0].url"
                :class="!links[0].url ? 'text-gray-300 hover:text-gray-200 cursor-no-drop' : 'hover:text-gray-700'"
                class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
            </svg>
            </Link>
        </div>
        <div class="hidden md:-mt-px md:flex">
            <Link v-for="link in links.slice(1, -1)" :key="link.label" :href="link.url"
                :class="current == link.label ? 'border-green-500 text-green-600' : ''"
                class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
            {{ link.label }}
            </Link>
        </div>
        <div class="md:-mt-px md:hidden flex mt-5">
            <h1 class="text-gray-400 font-extrabold text-sm">
                Pagina {{ current }}
            </h1>
        </div>
        <div class="-mt-px flex w-0 flex-1 justify-end">
            <Link :href="links[links.length - 1].url"
                :class="!links[links.length - 1].url ? 'text-gray-300 hover:text-gray-200 cursor-no-drop' : 'hover:text-gray-700'"
                class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
            </svg>
            </Link>
        </div>
    </nav>
</template>
<script>
import { Link } from '@inertiajs/vue3';

export default {

    components: {
        Link
    },

    props: {
        links: Object,
        current: String,
    }
}
</script>