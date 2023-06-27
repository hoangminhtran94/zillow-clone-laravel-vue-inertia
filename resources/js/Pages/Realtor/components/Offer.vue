<template>
    <Box>
        <template #header
            >Offer #{{ offer.id }}
            <span
                v-if="offer.accepted_at"
                class="dark:bg-green-900 dark:text-green-200 bg-green-200 text-green-900 p-1 rounded-md uppercase ml-1"
                >accepted</span
            >
            <span
                v-if="offer.rejected_at"
                class="dark:bg-red-900 dark:text-red-200 bg-red-200 text-red-900 p-1 rounded-md uppercase ml-1"
                >Rejected</span
            >
        </template>
        <section class="flex items-center justify-between">
            <div>
                <Price :price="offer.amount" class="text-xl" />

                <div class="text-gray-500">
                    Difference <Price :price="difference" />
                </div>

                <div class="text-gray-500 text-sm">
                    Made by {{ offer.bidder.name }}
                </div>

                <div class="text-gray-500 text-sm">Made on {{ madeOn }}</div>
            </div>
            <div class="flex gap-3">
                <Link
                    v-if="!isSold && !offer.rejected_at"
                    class="btn-outline border-green-700 text-green-700 text-xs font-medium"
                    as="button"
                    method="put"
                    :href="
                        route(`realtor.listing.offer.update`, {
                            listing: listingId,
                            offer: offer.id,
                            status: 'accept',
                            _token: csrf_token,
                        })
                    "
                >
                    Accept
                </Link>
                <Link
                    v-if="!isSold && !offer.rejected_at"
                    class="btn-outline border-red-500 text-red-500 text-xs font-medium"
                    as="button"
                    method="put"
                    :href="
                        route(`realtor.listing.offer.update`, {
                            listing: listingId,
                            offer: offer.id,
                            status: 'reject',
                            _token: csrf_token,
                        })
                    "
                >
                    Reject
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
const props = defineProps({
    index: Number,
    listingId: Number,
    offer: Object,
    listingPrice: Number,
    isSold: Boolean,
    csrf_token: String,
});
const difference = computed(() => props.offer.amount - props.listingPrice);
const madeOn = computed(() => new Date(props.offer.created_at).toDateString());
</script>
