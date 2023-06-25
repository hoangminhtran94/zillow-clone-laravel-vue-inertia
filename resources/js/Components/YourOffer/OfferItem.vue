<template>
    <div
        class="flex rounded shadow-md border border-indigo-300 p-5 hover:scale-[101%] transition-all cursor-pointer w-[800px] max-w-full flex-wrap"
    >
        <div>
            <img
                class="w-[140px] h-[140px] border border-slate-300 shadow-md object-cover"
                :src="listingImage"
                :alt="offer.listing_info"
            />
        </div>
        <div class="flex-1 px-4">
            <p class="font-bold">{{ offer.listing_info }}</p>
            <p>Listed Date: {{ formatedListDate }}</p>
            <p>Owner: {{ offer.owner_name }}</p>
        </div>
        <div class="flex flex-col px-4 gap-2">
            <span class="text-slate-200 text-sm">Status:</span>
            <div class="flex gap-2">
                <span
                    v-if="!accepted_at && !rejected_at"
                    class="p-2 rounded bg-yellow-100"
                    >Pending</span
                >
                <span v-if="accepted_at" class="">Accepted</span>
                <span v-if="rejected_at" class="">Rejected</span>
            </div>
        </div>
        <div class="flex flex-col px-4">
            <div color="flex gap-2">
                <span class="text-slate-200 text-sm">Offered price:</span>
                <h2>{{ formatedAmount }}</h2>
            </div>
            <div color="flex gap-2">
                <span class="text-slate-200 text-sm">Offered date:</span>
                <p>{{ formatedOfferedDate }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
const formatCurrency = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "USD",
});
const formatedOfferedDate = new Date(
    props.offer.created_at
).toLocaleDateString();
const formatedListDate = new Date(
    props.offer.listing_date
).toLocaleDateString();
const listingImage = props.offer.listing_image
    ? props.offer.listing_image
    : "https://res.cloudinary.com/dso1cyy53/image/upload/v1687680742/Group_147_jgfacg.png";
const formatedAmount = formatCurrency.format(props.offer.amount);
const props = defineProps({ offer: Object });
</script>
