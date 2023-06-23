<template>
    <div
        class="rounded p-5 shadow-md border border-indigo-300 w-fit min-w-[50%] mx-auto"
    >
        <h1 class="text-center mb-5 font-bold">
            {{ inEditMode ? "Edit profile" : user.name }}
        </h1>
        <div
            v-if="!inEditMode"
            class="flex flex-col justify-center items-center gap-6"
        >
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
            <button
                class="btn-normal w-full text-center"
                @click="toggleEditModeHandler"
            >
                Edit Profile
            </button>
        </div>
        <div v-if="inEditMode">
            <ul class="flex gap-4 font-bold my-3">
                <li
                    class="cursor-pointer transition-all"
                    :class="
                        editMode === 'info'
                            ? 'scale-110 border-b border-indigo-800'
                            : ' opacity-30 hover:scale-105'
                    "
                    @click="
                        () => {
                            changeEditMode('info');
                        }
                    "
                >
                    Edit informations
                </li>
                <li
                    class="cursor-pointer transition-all"
                    :class="
                        editMode === 'password'
                            ? 'scale-110 border-b border-indigo-800'
                            : ' opacity-30 hover:scale-105'
                    "
                    @click="
                        () => {
                            changeEditMode('password');
                        }
                    "
                >
                    Change Password
                </li>
            </ul>
            <form>
                <div v-if="editMode === 'info'" class="flex flex-col gap-3">
                    <ImageInput
                        v-model="infoForm.profile_image"
                        label="Profile Image"
                        :src="user.profile_image.src"
                    />
                    <Input id="name" v-model="infoForm.name" label="Name" />
                    <Input
                        id="phone_number"
                        v-model="infoForm.phone_number"
                        label="Phone number"
                        type="text"
                        :error="infoForm.errors?.phone_number"
                    />
                    <div class="flex gap-2">
                        <Input
                            id="address"
                            v-model="infoForm.address"
                            class-name="flex-1"
                            label="Address"
                            type="text"
                            :error="infoForm.errors?.address"
                        />
                        <Input
                            id="postal_code"
                            v-model="infoForm.postal_code"
                            label="Postal code"
                            type="text"
                            :error="infoForm.errors?.postal_code"
                        />
                    </div>
                </div>
                <div v-if="editMode === 'password'" class="flex flex-col gap-3">
                    <Input
                        id="password"
                        v-model="passwordForm.password"
                        label="Password"
                        type="password"
                        :error="passwordForm.errors?.password"
                    />
                    <Input
                        id="passwordConfirmation"
                        v-model="passwordForm.password_confirmation"
                        label="Confirm Password"
                        type="password"
                        :error="passwordForm.errors?.password_confirmation"
                    />
                </div>

                <div class="flex gap-2 mt-4">
                    <button
                        class="btn-normal w-full text-center"
                        @click="toggleEditModeHandler"
                    >
                        Cancel
                    </button>
                    <button
                        class="btn-normal w-full text-center"
                        @click="toggleEditModeHandler"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Input from "../../Components/UI/Input.vue";
import ImageInput from "../../Components/UI/ImageInput.vue";

import { ref } from "vue";

const inEditMode = ref(false);
const editMode = ref("info");
const toggleEditModeHandler = () => {
    inEditMode.value = !inEditMode.value;
};
const changeEditMode = (mode) => {
    editMode.value = mode;
};
const infoForm = useForm({
    profile_image: null,
    name: props.user.name,
    phone_number: props.user.phone_number,
    address: props.user.address,
    postal_code: props.user.postal_code,
    _token: props.csrf_token,
});
const passwordForm = useForm({
    password: "",
    password_confirmation: "",
    _token: props.csrf_token,
});
const props = defineProps({ user: Object, csrf_token: String });
</script>
