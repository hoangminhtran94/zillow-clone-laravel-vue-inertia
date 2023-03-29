<template>
    <Box>
        <template #header> Make an Offer</template>
        <div>
            <form @submit.prevent="makeOffer">
                <input v-model="form.amount" type="text" class="input" />
                <input
                    v-model="form.amount"
                    type="range"
                    :min="round(+listing.price / 2, 0)"
                    :max="round(+listing.price * 1.5, 0)"
                    step="1000"
                    class="rounded-lg w-full h-4 mt-2 bg-gray-200 appearance-none cursor-pointer"
                />
                <button type="submit" class="btn-outline w-full mt-2 text-sm">
                    Make an Offer
                </button>
            </form>
        </div>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div>
                <Price :price="form.amount - listing.price" />
            </div>
        </div>
    </Box>
</template>
<script setup>
import Box from "../../../../Components/UI/Box.vue";
import Price from "../../../../Components/Price.vue";
import { useForm } from "@inertiajs/vue3";
import { round, debounce } from "lodash";
import { watch } from "vue";
const props = defineProps({ listing: Object });
const form = useForm({ amount: +props.listing.price });
const makeOffer = () => {
    // eslint-disable-next-line no-undef
    form.post(route("listing.offer.store", { listing: props.listing.id }), {
        preserveScroll: true,
        preserveState: true,
    });
};
const emit = defineEmits(["offerUpdated"]);
watch(
    () => form.amount,
    debounce((value) => {
        emit("offerUpdated", value);
    }, 200)
);
</script>
