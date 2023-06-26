<template>
    <div class="flex-1 flex flex-col-reverse md:flex-col items-center gap-10">
        <div class="flex flex-col gap-3">
            <h1 class="text-center tracking-wider">Features</h1>
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full gap-3"
            >
                <Box
                    v-for="listing in listings"
                    v-bind:key="listing.id"
                    class-name="p-4 h-[500px] hover:scale-[103%] transition-all cursor-pointer"
                >
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
                                new Date(listing.created_at).toLocaleString(
                                    "en-US",
                                    { dateStyle: "long", timeStyle: "short" }
                                )
                            }}
                        </p>
                        <p class="text-slate-400">
                            Listed by {{ listing.owner_name }}
                        </p>
                    </div>
                </Box>
            </div>
        </div>

        <div class="flex flex-col gap-3 w-full items-center text-3xl">
            <label class="label"> Search for a listing </label>
            <input class="input w-full md:w-1/2 mt-4" />
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Box from "../../Components/UI/Box.vue";
const currencyFormater = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "USD",
});
const dateFormater = new Intl.DateTimeFormat("en-US", {
    dateStyle: "long",
    timeStyle: "short",
});

const props = defineProps({ listings: Array });
</script>
