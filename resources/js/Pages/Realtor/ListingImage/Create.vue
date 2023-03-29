<!-- eslint-disable vue/max-attributes-per-line -->
<template>
    <Box>
        <template #header>Upload new Image</template>
        <form @submit.prevent="upload">
            <section class="flex items-center gap-2 my-3">
                <input
                    class="border rounded-md file:px-4 file:py-2 file:text-gray-700 file:dark:text-gray-400 file:mr-4 file:font-medium file:hover:cursor-pointer file:dark:hover:bg-gray-700 file:hover:bg-gray-200 file:dark:bg-gray-800 file:border-0 file:bg-gray-100 border-gray-200 dark:border-gray-700"
                    name="images"
                    multiple
                    type="file"
                    @input="addFiles"
                />
                <button
                    type="submit"
                    class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                    :disabled="!canUpload"
                >
                    Send
                </button>
                <button type="reset" class="btn-outline" @click="reset">
                    Reset
                </button>
            </section>
            <div v-if="imageErrors.length > 0" class="input-error">
                {{ imageErrors[0] }}
            </div>
        </form>
    </Box>
    <Box v-if="listing.images.length > 0" class="mt-4">
        <template #header>Current Listing Images</template>
        <section
            class="mt-4 grid lg:grid-cols-4 gap-4 md:grid-cols-2 sm:grid-cols-1"
        >
            <div
                v-for="image of listing.images"
                :key="image.id"
                class="flex flex-col justify-between"
            >
                <img :src="image.src" class="h-full rounded-md object-cover" />
                <Link
                    :href="
                        route(`realtor.listing.image.destroy`, {
                            listing: listing.id,
                            image: image.id,
                        })
                    "
                    method="delete"
                    as="button"
                    class="mt-2 btn-outline"
                >
                    Delete
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import { useForm, router, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import Box from "../../../Components/UI/Box.vue";
import NProgress from "nprogress";

router.on("progress", (event) => {
    if (event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9);
    }
});

const props = defineProps({ listing: Object });
const form = useForm({ images: [] });
const imageErrors = computed(() => Object.values(form.errors));
const canUpload = computed(() => form.images.length > 0);
const addFiles = (e) => {
    for (const image of e.target.files) {
        form.images.push(image);
    }
};
const upload = () => {
    form.post(
        // eslint-disable-next-line no-undef
        route("realtor.listing.image.store", { listing: props.listing.id }),
        {
            onSuccess: () => {
                form.reset("images");
            },
        }
    );
};
const reset = () => form.reset("images");
</script>
