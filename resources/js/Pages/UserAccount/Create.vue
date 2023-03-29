<template>
    <form @submit.prevent="signup">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="name" class="label">Name</label>
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="input"
                />
                <div v-if="form.errors.name" class="input-error">
                    {{ form.errors.name }}
                </div>
            </div>
            <div class="mt-4">
                <label for="email" class="label">Email (username)</label>
                <input
                    id="email"
                    v-model="form.email"
                    type="text"
                    class="input"
                />
                <div v-if="form.errors.email" class="input-error">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="input"
                />
                <div v-if="form.errors.password" class="input-error">
                    {{ form.errors.password }}
                </div>
            </div>
            <div class="mt-4">
                <label for="passwordConfirmation" class="label">
                    Confirm Password
                </label>
                <input
                    id="passwordConfirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="input"
                />
                <div
                    v-if="form.errors.password_confirmation"
                    class="input-error"
                >
                    {{ form.errors.password_confirmation }}
                </div>
            </div>
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

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});
// eslint-disable-next-line no-undef
const signup = () => form.post(route(`user-account.store`));
</script>
