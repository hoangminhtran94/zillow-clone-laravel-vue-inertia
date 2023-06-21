<template>
    <div class="w-20 h-20 rounded-full shadow-md mx-auto" @click="onAddImage">
        <img :src="src" alt="profile-image" class="w-full h-full" />
        <input
            ref="inputRef"
            class="hidden"
            type="file"
            multiple="false"
            accept=".jpg,.png,.avif,.webp,.jpeg"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
// const inputRef = ref();
const onAddImage = () => {
    this.$refs.inputRef.currentTarget.click();
};
defineProps({ src: { type: String, default: "" } });
</script>
