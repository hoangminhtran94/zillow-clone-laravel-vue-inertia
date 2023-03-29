<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input
                    v-model="form.priceFrom"
                    class="input-filter-l w-28"
                    type="number"
                    min="0"
                    placeholder="Price from"
                />
                <input
                    v-model="form.priceTo"
                    class="input-filter-l w-28"
                    type="number"
                    min="0"
                    placeholder="Price to"
                />
            </div>
            <div class="flex flex-nowrap items-center">
                <select v-model="form.beds" class="input-filter-l w-28">
                    <option :value="null">Beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option :value="6">6+</option>
                </select>
                <select v-model="form.baths" class="input-filter-l w-28">
                    <option :value="null">Baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option :value="6">6+</option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">
                <input
                    v-model="form.areaFrom"
                    class="input-filter-l w-28"
                    type="number"
                    min="0"
                    placeholder="Area from"
                />
                <input
                    v-model="form.areaTo"
                    class="input-filter-r w-28"
                    type="number"
                    min="0"
                    placeholder="Area to"
                />
            </div>
            <button class="btn-normal" type="submit">Filter</button>
            <button type="reset" @click="reset">Clear</button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
const props = defineProps({ filters: Object });
const form = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    beds: props.filters.beds ?? null,
    baths: props.filters.beds ?? null,
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null,
});
const filter = () => {
    // eslint-disable-next-line no-undef
    form.get(route("listing.index"), {
        preserveState: true,
        preserveScroll: true,
    });
};
const reset = () => {
    form.priceFrom = null;
    form.priceTo = null;
    form.beds = null;
    form.baths = null;
    form.areaFrom = null;
    form.areaTo = null;
    filter();
};
</script>
