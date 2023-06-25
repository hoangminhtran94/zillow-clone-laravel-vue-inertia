<template>
    <h1>You need to verify</h1>
    <div>
        <Link
            :href="route(`verification.send`)"
            method="post"
            :data="{ _token: csrf_token }"
            as="button"
            class="text-indigo-600 dark:text-indigo-400"
        >
            Resend verification email</Link
        >
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({ csrf_token: String });
</script>
