<template>
    <div class="p-5 shadow-lg rounded border border-indigo-300">
        <h1 class="text-center mb-5">New Listing</h1>
        <form @submit.prevent="create">
            <div class="grid grid-cols-6 gap-4">
                <Input
                    id="beds"
                    v-model.number="form.beds"
                    class-name="col-span-2"
                    label="Number of Beds"
                    placeholder="Enter number of beds"
                    :error="form.errors.beds"
                />
                <Input
                    id="baths"
                    v-model.number="form.baths"
                    class-name="col-span-2"
                    label="Number of Baths"
                    placeholder="Enter number of baths"
                    :error="form.errors.baths"
                />
                <Input
                    id="area"
                    v-model.number="form.area"
                    class-name="col-span-2"
                    label="Total Area (m2)"
                    placeholder="Enter the real estate total area"
                    :error="form.errors.area"
                />
                <Input
                    id="city"
                    v-model="form.city"
                    class-name="col-span-4"
                    label="City"
                    placeholder="Enter real estate city"
                    :error="form.errors.city"
                />
                <Input
                    id="code"
                    v-model="form.code"
                    class-name="col-span-2"
                    label="Post Code"
                    placeholder="Enter real estate postal code"
                    :error="form.errors.code"
                />
                <Input
                    id="street"
                    v-model="form.street"
                    class-name="col-span-4"
                    label="Street"
                    placeholder="Enter real estate street"
                    :error="form.errors.street"
                />
                <Input
                    id="street_number"
                    v-model.number="form.street_number"
                    class-name="col-span-2"
                    label="Street number"
                    placeholder="Enter street number"
                    :error="form.errors.street_number"
                />
                <Input
                    id="price"
                    v-model.number="form.price"
                    class-name="col-span-6"
                    label="Listing Price"
                    placeholder="Enter listing size"
                    :error="form.errors.price"
                />

                <div class="col-span-6 flex justify-center my-5">
                    <button type="submit" class="w-1/2 btn-primary">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Input from "../../Components/UI/Input.vue";

const form = useForm({
    beds: null,
    baths: null,
    area: null,
    city: null,
    street: null,
    code: null,
    street_number: null,
    price: null,
    _token: props.csrf_token,
});
// eslint-disable-next-line no-undef
const create = () => form.post(route("realtor.listing.store"));
const props = defineProps({ csrf_token: String });
</script>
