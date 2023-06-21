<template>
    <div
        class="flex flex-col w-fit rounded shadow-md dark:shadow-white text-base"
    >
        <Link
            class="dark:hover:bg-white hover:bg-indigo-900 whitespace-nowrap p-2"
            :href="route(`listing.index`)"
        >
            View all listings
        </Link>
        <Link
            class="dark:hover:bg-white hover:bg-indigo-900 whitespace-nowrap p-2"
            :href="route(`listing.index`)"
        >
            Your listings
        </Link>
        <Link
            class="dark:hover:bg-white hover:bg-indigo-900 whitespace-nowrap p-2"
            :href="route(`listing.index`)"
        >
            Your offer
        </Link>
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
</script>
