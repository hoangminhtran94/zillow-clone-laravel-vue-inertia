<template>
    <div class="flex flex-col min-h-screen">
        <NavBar :user="user" :notification-count="notificationCount" />
        <main class="container flex-1 mx-auto p-4">
            <div
                v-if="flashSuccess"
                class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2"
            >
                {{ flashSuccess }}
            </div>
            <slot></slot>
        </main>
        <Footer />
    </div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import NavBar from "../../Components/UI/NavBar.vue";
import Footer from "../../Components/UI/Footer.vue";

const flashSuccess = computed(() => usePage().props.flash.success);

const notificationCount = computed(() =>
    Math.min(usePage().props.user?.notificationCount, 9)
);
defineProps({ user: Object });
</script>
