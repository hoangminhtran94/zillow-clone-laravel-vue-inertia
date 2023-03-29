<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({ message: String });
</script>

<template>
    <div>
        <div
            class="h-[50vh] flex flex-col justify-center items-center text-3xl"
        >
            <label class="label"> Search for a listing </label>
            <input class="input w-1/2 mt-4" />
        </div>
        <Link :href="route(`listing.index`)" class="flex justify-center">
        </Link>
    </div>
</template>
