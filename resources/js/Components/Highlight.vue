<template>
  <pre>
    <code ref="codeBlock">
      {{ code }}
    </code>
  </pre>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { highlightElement } from "@/Services/SyntaxHighlighting";

const codeBlock = ref(null);

defineProps({
  code: {
    type: String,
    required: true,
  }
});

onMounted(() => {
  highlightElement(codeBlock.value);
});
</script>
