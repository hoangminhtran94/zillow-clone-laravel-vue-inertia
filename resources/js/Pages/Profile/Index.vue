<template>
    <div
        class="rounded p-5 shadow-md border border-indigo-300 w-fit min-w-[50%] mx-auto"
    >
        <h1 class="text-center mb-5 font-bold">
            {{ user.name }}
        </h1>
        <div class="flex flex-col justify-center items-center gap-6">
            <img
                :src="user.profile_image?.src"
                alt="profile-image"
                class="w-[200px] h-[200px] border border-indigo-300 object-cover rounded-full shadow-md"
            />
            <div class="flex flex-col gap-3">
                <h2>
                    <span class="font-bold">Contact email:</span>
                    {{ user.email }}
                </h2>
                <h2>
                    <span class="font-bold">Phone Number:</span>
                    {{ user.phone_number }}
                </h2>
                <h2>
                    <span class="font-bold">Address:</span> {{ user.address }}
                </h2>
                <h2>
                    <span class="font-bold">Postal code:</span>
                    {{ user.postal_code }}
                </h2>
            </div>
            <Link
                class="btn-normal w-[200px] max-w-full text-center mt-6"
                :href="route('edit-profile-page')"
            >
                Edit Profile
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({ user: Object });
</script>
