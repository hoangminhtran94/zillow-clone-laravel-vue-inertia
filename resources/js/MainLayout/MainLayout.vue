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
        <footer
            class="border-gray-200 border-t dark:border-gray-700 flex px-10 py-3"
        >
            <div class="flex-1">Developed by Minh Hoang Tran</div>
            <div class="flex-1">
                <h2>Technology</h2>
                <div class="flex gap-3">
                    <span>Larvavel</span>
                    <span>Inertia</span>
                    <span>Vuejs</span>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import NavBar from "../Components/UI/NavBar.vue";

const flashSuccess = computed(() => usePage().props.flash.success);

const notificationCount = computed(() =>
    Math.min(usePage().props.user.notificationCount, 9)
);
defineProps({ user: Object });
</script>
