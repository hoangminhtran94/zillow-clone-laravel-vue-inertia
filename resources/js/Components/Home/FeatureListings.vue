<template>
    <div class="flex flex-col gap-3">
        <h1 class="text-center tracking-wider">Features</h1>
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full gap-3"
        >
            <FeatureItem
                v-for="listing in listings"
                :listing="listing"
                v-bind:key="listing.id"
                class-name="p-4 h-[500px] hover:scale-[103%] transition-all cursor-pointer"
            />
        </div>
    </div>
</template>

<script setup>
import FeatureItem from "./FeatureItem.vue";

defineProps({ listings: Array });
</script>
