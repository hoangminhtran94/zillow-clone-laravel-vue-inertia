<template>
    <div>
        <Link :href="route(`listing.index`)">View all listings</Link>
        <Link :href="route(`listing.index`)">Your listings</Link>
        <Link :href="route(`listing.index`)">Your offer</Link>
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
</script>
