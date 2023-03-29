<!-- eslint-disable vue/no-v-text-v-html-on-component -->
<!-- eslint-disable vue/no-v-html -->
<template>
    <div class="flex gap-1">
        <Link
            v-for="(link, index) in links"
            :key="index"
            :href="link.url"
            class="py-2 px-4 rounded-md"
            :class="
                link.active && `bg-indigo-500 dark:bg-indigo-800 text-gray-300`
            "
            v-html="link.label"
        >
        </Link>
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({ links: Array });
</script>
