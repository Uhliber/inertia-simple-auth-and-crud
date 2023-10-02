<template>
  <div>
    <label
      :for="id"
      class="block text-sm font-medium leading-6 text-gray-900"
    >
      {{ label }}
    </label>
    <div class="relative mt-2 rounded-md shadow-sm">
      <input
        :id="id"
        :name="name"
        :type="type"
        :value="modelValue"
        :required="required"
        class="block w-full rounded-md border-0 py-1.5 pr-10  ring-1 ring-inset  focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
        :class="[ error ? 'text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500' : 'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600' ]"
        :aria-invalid="error ? 'true' : null"
        :aria-describedby="name"
        @input="updateModelValue"
      >
      <div v-if="error" class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
        <AlertCircle class="h-5 w-5 text-red-500" aria-hidden="true" />
      </div>
    </div>
    <p v-if="error" class="mt-2 text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>

<script setup>
import { AlertCircle } from "lucide-vue-next";

defineProps({
  id: {
    type: String,
    required: true,
  },
  name: {
    type: String,
    default: null,
  },
  type: {
    type: String,
    default: null,
  },
  modelValue: {
    type: String,
    default: null,
  },
  required: {
    type: Boolean,
    default: false,
  },
  label: {
    type: String,
    default: null,
  },
  error: {
    type: String,
    default: null,
  }
});

const emit = defineEmits(["update:modelValue", "input"]);

const updateModelValue = (event) => {
  emit("update:modelValue", event.target.value);
  emit("input");
};

</script>
