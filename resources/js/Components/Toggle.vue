<template>
    <SwitchGroup as="div" class="flex items-center">
        <SwitchLabel as="span" class="mr-3 text-sm">
            <span class="font-medium text-gray-900">{{ label }}</span>
        </SwitchLabel>
        <Switch v-model="model"
            :class="[model ? 'bg-green-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-green-600 focus:ring-offset-2']">
            <span aria-hidden="true"
                :class="[model ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block size-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
        </Switch>
    </SwitchGroup>
</template>

<script setup>
import { ref } from 'vue'
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'

const model = defineModel({
    type: Boolean,
    required: true,
});

defineProps({
    label: String
});
</script>