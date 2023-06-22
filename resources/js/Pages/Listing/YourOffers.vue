<template>
    <div>
        <PlaceHolderBox v-if="offers.length === 0">
            You do not have any offer
        </PlaceHolderBox>

        <ul v-else>
            <li v-for="(offer, index) in offers" v-bind:key="index">
                {{ offer.amount }}
            </li>
        </ul>
    </div>
</template>

<script setup>
import PlaceHolderBox from "../../Components/UI/PlaceHolderBox.vue";
defineProps({
    offers: Object,
});
</script>
