<script setup>
defineProps({
    value: {
        type: String,
    },
    required: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <label class="block text-sm font-medium text-gray-700">
        <span v-if="value"><span class="text-red-500" v-if="required">*</span> {{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
