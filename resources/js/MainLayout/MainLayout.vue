<template>
    <header
        class="w-full border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900"
    >
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div
                    ref="dropdownref"
                    class="text-lg font-medium relative"
                    @mouseenter="hoverHandler"
                    @mouseleave="mouseLeaveHandler"
                >
                    <span class="cursor-pointer">Listing</span>
                    <MenuDropdown
                        v-if="toggleDropdown"
                        class="absolute top-full"
                    />
                </div>
                <div
                    class="text-xl font-bold text-center text-indigo-600 dark:text-indigo-300"
                >
                    <Link :href="route(`home`)">Main Page</Link>
                </div>
                <div v-if="user" class="flex gap-4 items-center">
                    <Link
                        class="text-gray-500 relative pr-2 py-2 text-lg"
                        :href="route(`notification.index`)"
                    >
                        🔔
                        <div
                            v-if="notificationCount > 0"
                            class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center"
                        >
                            {{ notificationCount }}
                        </div>
                    </Link>
                    <Link
                        class="text-gray-500 text-sm"
                        :href="route(`realtor.listing.index`)"
                    >
                        {{ user.name }}
                    </Link>
                    <Link
                        :href="route(`realtor.listing.create`)"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium p-2 rounded-md"
                    >
                        + New Listing
                    </Link>
                    <div>
                        <Link
                            :href="route(`logout`)"
                            method="delete"
                            as="button"
                        >
                            Logout
                        </Link>
                    </div>
                </div>
                <div v-else class="flex gap-4">
                    <Link :href="route(`user-account.create`)">Register</Link>
                    <Link :href="route(`login`)">Sign in</Link>
                </div>
            </nav>
        </div>
    </header>
    <main class="container h-[calc(100vh-160px)] mx-auto p-4">
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
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { debounce } from "lodash";
import { computed, ref } from "vue";
import useClickOutSide from "../Components/Composables/useClickOutside";
import MenuDropdown from "../Components/UI/MenuDropdown.vue";
const dropdownref = ref(null);
const toggleDropdown = ref(false);
useClickOutSide(dropdownref, toggleDropdown);
const hoverHandler = debounce(() => {
    toggleDropdown.value = true;
}, 500);
const mouseLeaveHandler = debounce(() => {
    toggleDropdown.value = false;
}, 500);

const flashSuccess = computed(() => usePage().props.flash.success);

const user = computed(() => usePage().props.user);

const notificationCount = computed(() =>
    Math.min(usePage().props.user.notificationCount, 9)
);
</script>
