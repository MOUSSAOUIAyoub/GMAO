<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-white text-sm font-medium leading-5 text-white focus:outline-none focus:border-indigo-700 transition'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white hover:border-gray-300 focus:outline-none transition';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
