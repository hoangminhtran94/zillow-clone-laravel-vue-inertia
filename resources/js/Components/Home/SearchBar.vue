<template>
    <div class="flex flex-col gap-3 w-full items-center">
        <h1 class="label tracking-widest">Search for a listing</h1>
        <div class="w-full md:w-1/2 relative">
            <input
                v-model="form.listing_address"
                placeholder="Enter an address"
                class="input mt-4 text-lg focus:outline-2 focus:outline-indigo-400"
            />
            <div
                v-if="results.length > 0"
                class="w-full flex flex-col shadow-md border absolute top-[110%] border-indigo-300 rounded"
            >
                <Link
                    v-for="listing in results"
                    v-bind:key="listing.id"
                    class="p-3 hover:bg-indigo-700 hover:text-white"
                    :href="route('listing.show', { listing: listing.id })"
                >
                    {{ listing.listing_address }}
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
import { ref, watch } from "vue";
const form = useForm({ listing_address: "", _token: props.csrf_token });
const results = ref([]);
const timeout = ref(null);
const submit = async () => {
    try {
        const res = await axios.post(
            // eslint-disable-next-line no-undef
            route("home-search"),
            { listing_address: form.listing_address, _token: props.csrf_token },
            {
                withCredentials: true,
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            }
        );
        results.value = res.data ? res.data.results : [];
    } catch (error) {
        console.log(error);
    }
};

watch(
    () => form.listing_address,
    (value) => {
        results.value = [];
        clearTimeout(timeout.value);
        if (value) {
            timeout.value = setTimeout(() => {
                submit();
            }, 500);
        }
    }
);

const props = defineProps({ csrf_token: String });
</script>
