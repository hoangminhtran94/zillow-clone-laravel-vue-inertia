<template>
    <div>
        <PlaceHolderBox v-if="offers.length === 0">
            You do not have any offer
        </PlaceHolderBox>

        <div class="grid grid-cols-1 gap-3 md:grid-cols-2" v-else>
            <OfferItem
                v-for="(offer, index) in offers"
                :offer="offer"
                v-bind:key="index"
            />
        </div>
    </div>
</template>

<script setup>
import PlaceHolderBox from "../../Components/UI/PlaceHolderBox.vue";
import OfferItem from "../../Components/YourOffer/OfferItem.vue";
defineProps({
    offers: Array,
});
</script>
