<template>
    <div
        class="rounded p-5 shadow-md border border-indigo-300 w-fit min-w-[50%] mx-auto"
    >
        <ul class="flex font-bold mt-3 mb-6">
            <li
                class="cursor-pointer transition-all p-2 rounded-tl-md bg-indigo-700 text-white"
                :class="editMode !== 'info' && ' opacity-20 hover:opacity-40'"
                @click="
                    () => {
                        changeEditMode('info');
                    }
                "
            >
                Edit informations
            </li>
            <li
                class="cursor-pointer transition-all p-2 rounded-tr-md bg-indigo-700 text-white"
                :class="
                    editMode !== 'password' && ' opacity-20 hover:opacity-40'
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
        <form @submit.prevent="submitHandler">
            <div v-if="editMode === 'info'" class="flex flex-col gap-3">
                <ImageInput
                    v-model="infoForm.profile_image"
                    label="Profile Image"
                    :src="user.profile_image?.src"
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
                    v-model="passwordForm.current_password"
                    label="Current password"
                    type="password"
                    :error="passwordForm.errors?.current_password"
                />
                <Input
                    id="password"
                    v-model="passwordForm.new_password"
                    label="Password"
                    type="password"
                    :error="passwordForm.errors?.new_password"
                />
                <Input
                    id="passwordConfirmation"
                    v-model="passwordForm.new_password_confirmation"
                    label="Confirm Password"
                    type="password"
                    :error="passwordForm.errors?.new_password_confirmation"
                />
            </div>

            <div class="flex gap-2 mt-10">
                <Link
                    class="btn-normal w-full text-center"
                    :href="route('your-profile.index')"
                >
                    Cancel
                </Link>
                <button class="btn-normal w-full text-center" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Input from "../../Components/UI/Input.vue";
import ImageInput from "../../Components/UI/ImageInput.vue";
const editMode = ref("info");

const infoForm = useForm({
    profile_image: null,
    name: props.user.name,
    phone_number: props.user.phone_number,
    address: props.user.address,
    postal_code: props.user.postal_code,
    _token: props.csrf_token,
});
const passwordForm = useForm({
    current_password: "",
    new_password: "",
    new_password_confirmation: "",
    _token: props.csrf_token,
});
const submitHandler = () => {
    if (editMode.value === "password") {
        changePassword();
    } else {
        changeProfileInfo();
    }
};
const changeEditMode = (mode) => {
    editMode.value = mode;
};

// eslint-disable-next-line no-undef
const changePassword = () => passwordForm.post(route("change-password"));
// eslint-disable-next-line no-undef
const changeProfileInfo = () => infoForm.post(route("save-edit-profile"));
const props = defineProps({ user: Object, csrf_token: String });
</script>
