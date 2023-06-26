<template>
    <div class="flex-1 flex flex-col-reverse md:flex-col items-center gap-10">
        <FeatureListings :listings="listings" />

        <div class="flex flex-col gap-3 w-full items-center">
            <label class="label text-3xl"> Search for a listing </label>
            <input
                placeholder="Enter an address"
                class="input w-full md:w-1/2 mt-4 text-lg"
            />
        </div>
    </div>
</template>

<script setup>
import FeatureListings from "../../Components/Home/FeatureListings.vue";
const props = defineProps({ listings: Array });
</script>
