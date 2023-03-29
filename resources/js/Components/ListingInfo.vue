<template>
    <div>
        <span class="font-bold px-1">{{ listing.beds }} beds</span>
        <span class="">|</span>
        <span class="font-bold px-1">{{ listing.baths }} baths</span>
        <span class="">|</span>
        <span class="font-bold px-1">{{ listing.area }} m²</span>
    </div>
</template>
<script setup>
defineProps({ listing: { type: Object, default: null } });
</script>
