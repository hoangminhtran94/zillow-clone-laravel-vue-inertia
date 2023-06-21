<template>
    <header
        class="w-full border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900"
    >
        <div class="container mx-auto">
            <nav class="flex p-4 items-center justify-between">
                <div class="text-lg font-medium flex gap-3">
                    <Link
                        class="nav-link"
                        :class="{ active: $page.url === '/listing' }"
                        :href="route(`listing.index`)"
                    >
                        View all listings
                    </Link>
                    <Link
                        class="nav-link"
                        :class="{ active: $page.url === '/realtor/listing' }"
                        :href="route(`realtor.listing.index`)"
                    >
                        Your listings
                    </Link>
                    <Link
                        class="nav-link"
                        :class="{ active: $page.url === '/listing/offer' }"
                        :href="route(`listing.offer`)"
                    >
                        Your offer
                    </Link>
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
                        :href="route('profile')"
                        class="text-gray-500 text-sm"
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
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({ user: Object, notificationCount: { type: Number, default: 0 } });
</script>
