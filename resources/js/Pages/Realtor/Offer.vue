<template>
    <div class="mb-4">
        <Link :href="route('realtor.listing.index')">
            ← Go back to Listings
        </Link>
    </div>

    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
            <div class="w-full text-center font-medium text-gray-500">
                No offers
            </div>
        </Box>

        <div v-else class="md:col-span-7 flex flex-col gap-4">
            <Offer
                v-for="(offer, index) in listing.offers"
                :key="offer.id"
                :offer="offer"
                :listing-id="listing.id"
                :listing-price="listing.price"
                :index="index"
                :is-sold="listing.sold_at != null"
                :csrf_token="csrf_token"
            />
        </div>

        <div class="md:col-span-5">
            <Box>
                <template #header>Basic Info</template>
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingInfo :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>
        </div>
    </section>
</template>

<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";
import ListingInfo from "../../Components/ListingInfo.vue";
import Offer from "./components/Offer.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
const props = defineProps({ listing: Object, csrf_token: String });
const hasOffers = computed(() => props.listing.offers.length);
</script>
