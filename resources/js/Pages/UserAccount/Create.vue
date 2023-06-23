<template>
    <form @submit.prevent="signup">
        <div class="w-1/2 mx-auto flex flex-col gap-2">
            <ImageInput v-model="form.profile_image" />
            <Input
                id="name"
                v-model="form.name"
                label="Name"
                :error="form.errors?.name"
            />
            <Input
                id="email"
                v-model="form.email"
                label="Email (username)"
                type="email"
                :error="form.errors?.email"
            />
            <Input
                id="phone_number"
                v-model="form.phone_number"
                label="Phone number"
                type="text"
                :error="form.errors?.phone_number"
            />
            <div class="flex gap-2">
                <Input
                    id="address"
                    v-model="form.address"
                    class-name="flex-1"
                    label="Address"
                    type="text"
                    :error="form.errors?.address"
                />
                <Input
                    id="postal_code"
                    v-model="form.postal_code"
                    label="Postal code"
                    type="text"
                    :error="form.errors?.postal_code"
                />
            </div>
            <Input
                id="password"
                v-model="form.password"
                label="Password"
                type="password"
                :error="form.errors?.password"
            />
            <Input
                id="passwordConfirmation"
                v-model="form.password_confirmation"
                label="Confirm Password"
                type="password"
                :error="form.errors?.password_confirmation"
            />
            <div class="mt-4">
                <button type="submit" class="btn-primary w-full">
                    Register
                </button>
                <div class="mt-2 text-center">
                    <Link :href="route(`login`)" class="text-sm text-gray-500">
                        Already have an account? Login now
                    </Link>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import Input from "../../Components/UI/Input.vue";
import ImageInput from "../../Components/UI/ImageInput.vue";
import { onUpdated } from "vue";
const form = useForm({
    profile_image: null,
    name: null,
    email: null,
    phone_number: null,
    address: null,
    postal_code: null,
    password: null,
    password_confirmation: null,
});
onUpdated(() => {
    console.log(form.profile_image);
});
// eslint-disable-next-line no-undef
const signup = () => form.post(route(`user-account.store`));
</script>
