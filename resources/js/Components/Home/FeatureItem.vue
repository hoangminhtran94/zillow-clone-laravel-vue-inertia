<template>
    <Box
        class-name="p-4 h-[500px] hover:scale-[103%] transition-all cursor-pointer"
    >
        <Link :href="route('listing.show', { listing: listing.id })">
            <div class="h-1/2 w-full">
                <img
                    :src="listing.listing_image"
                    class="w-full h-full object-cover"
                />
            </div>
            <div class="flex flex-col mt-3 gap-1">
                <h2 class="font-bold">
                    {{ listing.listing_address }}
                </h2>
                <h1>{{ currencyFormater.format(listing.price) }}</h1>
                <p class="text-slate-400">
                    {{
                        new Date(listing.created_at).toLocaleString("en-US", {
                            dateStyle: "long",
                            timeStyle: "short",
                        })
                    }}
                </p>
                <p class="text-slate-400">Listed by {{ listing.owner_name }}</p>
            </div>
        </Link>
    </Box>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Box from "../UI/Box.vue";
const currencyFormater = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "USD",
});
defineProps({ listing: Object });
</script>
