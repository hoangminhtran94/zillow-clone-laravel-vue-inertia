<template>
    <Filters :filters="filters" />
    <div v-if="listings.data.length > 0" class="flex-1">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <Listing
                v-for="listing in listings.data"
                :key="listing.id"
                :listing="listing"
            />
        </div>
    </div>
    <PlaceHolderBox v-else>There is no listing yet</PlaceHolderBox>
    <div
        v-if="listings.data.length > 0"
        class="w-full flex justify-center mt-8 mb-8"
    >
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>
import Listing from "./Index/Components/Listing.vue";
import PlaceHolderBox from "../../Components/UI/PlaceHolderBox.vue";
import Pagination from "../../Components/UI/Pagination.vue";
import Filters from "./Index/Components/Filters.vue";
console.log(props.listings.data);
const props = defineProps({
    listings: Object,
    filters: Object,
});
</script>
