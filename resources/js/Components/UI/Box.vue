<template>
    <div
        class="border boder-gray-200 dark:border-gray-800 rounded-md p-4 shadow-md dark:text-gray-300"
        :class="className"
    >
        <div class="text-gray-500 font-medium mb-1">
            <slot name="header"></slot>
        </div>
        <slot></slot>
    </div>
</template>
<script setup>
defineProps({ className: { type: String, default: "" } });
</script>
