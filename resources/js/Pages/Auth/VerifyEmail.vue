<template>
    <h1>You need to verify</h1>
    <div>
        <Link
            :href="route(`verification.send`)"
            method="post"
            as="button"
            class="text-indigo-600 dark:text-indigo-400"
        >
            Resend verification email</Link
        >
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
</script>
