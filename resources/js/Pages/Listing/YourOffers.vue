<template>
    <div>
        <div
            v-if="offers.length === 0"
            class="w-full h-[300px] shadow-md rounded p-4 flex justify-center items-center border border-indigo-200"
        >
            <h2 class="font-bold">You do not have any offer</h2>
        </div>
        <ul v-if="offers.length > 0">
            <li v-for="(offer, index) in offers" v-bind:key="index">
                {{ offer.amount }}
            </li>
        </ul>
    </div>
</template>

<script setup>
defineProps({
    offers: Object,
});
</script>
