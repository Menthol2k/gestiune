<template>
    <button @click="$emit('sort', field)" class="group inline-flex">
        <slot />
        <span :class="{
            'rotate-180': params.field === field && params.direction === 'asc',
            'bg-gray-100 text-gray-900': params.field === field,
            'invisible group-hover:visible': params.field != field
        }" class="ml-2 flex-none rounded text-gray-400">
            <ChevronDownIcon class="size-5" aria-hidden="true" />
        </span>
    </button>
</template>
<script>
import { ChevronDownIcon } from '@heroicons/vue/20/solid';

export default {

    components: {
        ChevronDownIcon
    },

    props: {
        params: Object,
        field: String,
    },

    emits: ['sort']
}

</script>