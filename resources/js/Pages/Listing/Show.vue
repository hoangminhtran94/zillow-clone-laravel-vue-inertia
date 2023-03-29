<template>
    <div class="flex flex-col-reverse flex-wrap md:grid grid-cols-12 gap-4">
        <Box
            v-if="listing.images.length > 0"
            class="md:col-span-7 flex w-full items-center"
        >
            <div class="grid lg:grid-cols-2 gap-1 grid-cols-1 object-cover">
                <img
                    v-for="image in listing.images"
                    :key="image.id"
                    :src="image.src"
                    class="h-full"
                />
            </div>
        </Box>
        <EmptyState v-else class="md:col-span-7 flex items-center">
            No images
        </EmptyState>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header> Basic info </template>
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingInfo :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>
            <Box>
                <template #header>Monthly Payment </template>
                <div>
                    <label class="label">
                        Interest rate ({{ interest }} %)
                    </label>
                    <input
                        v-model.number="interest"
                        type="range"
                        min="0.1"
                        max="30"
                        step="0.1"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />
                    <label class="label">Duration ({{ duration }} years)</label>
                    <input
                        v-model.number="duration"
                        type="range"
                        min="3"
                        max="30"
                        step="1"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />
                </div>
                <div class="text-gray-600 dark:text-gray-300 mt-2">
                    <div class="text-gray-400">Your monthly payment</div>
                    <Price :price="monthlyPayment" class="text-3xl" />
                </div>
                <div class="mt-2 text-gray-500">
                    <div class="flex justify-between">
                        <div>Total paid</div>
                        <div>
                            <Price :price="totalPaid" class="font-medium" />
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>Principal paid</div>
                        <div>
                            <Price :price="listing.price" class="font-medium" />
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>Total interest</div>
                        <div>
                            <Price :price="totalInterest" class="font-medium" />
                        </div>
                    </div>
                </div>
            </Box>
            <MakeOffer
                v-if="user && !offerMade && user.id !== listing.by_user_id"
                :listing="listing"
                @offer-updated="offer = $event"
            />
            <OfferMade v-if="user && offerMade" :offer="offerMade" />
        </div>
    </div>
</template>
<script setup>
import ListingAddress from "../../Components/ListingAddress.vue";
import ListingInfo from "../../Components/ListingInfo.vue";
import OfferMade from "./Show/Components/OfferMade.vue";
import EmptyState from "../../Components/UI/EmptyState.vue";
import MakeOffer from "./Show/Components/MakeOffer.vue";
import Price from "../../Components/Price.vue";
import Box from "../../Components/UI/Box.vue";
import { useMonthlyPayment } from "../../Components/Composables/useMonthly";
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
const interest = ref(2.5);
const duration = ref(25);
const offer = ref(props.listing.price);
const props = defineProps({ listing: Object, offerMade: Object });
const user = computed(() => usePage().props.user);
const { monthlyPayment, totalInterest, totalPaid } = useMonthlyPayment(
    offer,
    interest,
    duration
);
</script>
