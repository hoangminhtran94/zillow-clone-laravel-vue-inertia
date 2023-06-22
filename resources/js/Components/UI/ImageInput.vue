<template>
    <div class="flex flex-col gap-3">
        <label v-if="label" class="label text-center">{{ label }}</label>
        <label
            for="image-input"
            class="w-[200px] h-[200px] mx-auto cursor-pointer"
        >
            <span
                v-if="!img"
                class="border border-indigo-300 w-full h-full rounded-full shadow-md flex justify-center items-center p-3 text-center"
            >
                Please select profile image
            </span>
            <img
                v-if="img"
                :src="img"
                alt="profile-image"
                class="border border-indigo-300 w-full h-full object-cover rounded-full shadow-md"
            />
            <input
                id="image-input"
                class="hidden"
                type="file"
                multiple="false"
                accept=".jpg,.png,.avif,.webp,.jpeg"
                @input="onChange"
            />
        </label>
    </div>
</template>

<script setup>
import { ref, defineEmits } from "vue";
const emits = defineEmits(["update:modelValue"]);
const img = ref(props.src);
const onChange = (e) => {
    emits("update:modelValue", e.currentTarget.files[0]);
    const file = e.target.files[0];
    const image = URL.createObjectURL(file);
    img.value = image;
};

const props = defineProps({
    label: { type: String, default: "" },
    src: { type: String, default: "" },
    modelValue: { type: File, default: null },
});
</script>
