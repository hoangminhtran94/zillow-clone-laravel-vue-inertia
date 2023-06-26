<template>
    <div class="flex-1 flex flex-col-reverse md:flex-col items-center gap-10">
        <FeatureListings :listings="listings" />
        <SearchBar :csrf_token="csrf_token" />
    </div>
</template>

<script setup>
import FeatureListings from "../../Components/Home/FeatureListings.vue";
import SearchBar from "../../Components/Home/SearchBar.vue";
const props = defineProps({
    listings: Array,
    csrf_token: String,
});
</script>
