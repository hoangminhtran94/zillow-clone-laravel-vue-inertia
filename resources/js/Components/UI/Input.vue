<template>
    <div :class="className">
        <label :for="id" class="label">{{ label }}</label>
        <input
            :id="id"
            :value="modelValue"
            :type="type"
            :placeholder="placeholder"
            class="input"
            @input="onChange"
        />
        <div v-if="error" class="input-error">
            {{ error }}
        </div>
    </div>
</template>

<script setup>
import { defineEmits } from "vue";

const emitChangeEvent = defineEmits(["update:modelValue"]);
const onChange = (e) => {
    emitChangeEvent("update:modelValue", e.currentTarget.value);
};

defineProps({
    id: { type: String, default: "" },
    label: { type: String, default: "" },
    modelValue: { type: String, default: "" },
    className: { type: String, default: "" },
    error: { type: String, default: "" },
    type: { type: String, default: "text" },
    placeholder: { type: String, default: "" },
});
</script>
