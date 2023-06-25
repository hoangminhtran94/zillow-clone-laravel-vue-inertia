<template>
    <PlaceHolderBox>
        <p class="w-full text-center">You need to verify to acess this page</p>
        <Link
            :href="route(`verification.send`)"
            method="post"
            :data="{ _token: csrf_token }"
            as="button"
            class="text-indigo-600 dark:text-indigo-400 text-lg text-center w-full hover:scale-110 transition-all"
        >
            Resend verification email</Link
        >
    </PlaceHolderBox>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import PlaceHolderBox from "../../Components/UI/PlaceHolderBox.vue";
defineProps({ csrf_token: String });
</script>
