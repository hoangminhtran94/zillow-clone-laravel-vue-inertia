<template>
    <div>
        {{ listing.street }} {{ listing.street_number }} {{ listing.city }}
    </div>
</template>

<script setup>
defineProps({ listing: Object });
</script>
