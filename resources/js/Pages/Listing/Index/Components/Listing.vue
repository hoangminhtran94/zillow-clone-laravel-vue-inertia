<template>
    <Box class-name="cursor-pointer hover:scale-[103%] transition-all">
        <div>
            <Link :href="route(`listing.show`, { listing: listing.id })">
                <div class="flex items-center gap-2">
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" />/month
                    </div>
                </div>
                <ListingInfo :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Link>
        </div>
    </Box>
</template>

<script setup>
import ListingInfo from "../../../../Components/ListingInfo.vue";
import ListingAddress from "../../../../Components/ListingAddress.vue";
import Price from "../../../../Components/Price.vue";
import Box from "../../../../Components/UI/Box.vue";
import { Link } from "@inertiajs/vue3";
import { useMonthlyPayment } from "../../../../Components/Composables/useMonthly";
const props = defineProps({ listing: { type: Object, default: null } });
const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25);
</script>
