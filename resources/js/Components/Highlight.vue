<template>
  <div>
    <header class="bg-gray-800 text-white flex justify-end px-2 py-1 text-xs border-b border-gray-700">
      <button
        class="rounded px-2"
        :class="{'hover:bg-gray-600': !copied}"
        :disabled="copied"
        @click="copyToClipboard"
      >
        {{ copied ? 'Copied' : 'Copy' }}
      </button>
    </header>
    <pre><code ref="codeBlock">{{ code }}</code></pre>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { highlightElement } from "@/Services/SyntaxHighlighting";

const codeBlock = ref(null);
const copied = ref(false);

const props = defineProps({
  code: {
    type: String,
    required: true,
  }
});

onMounted(() => {
  highlightElement(codeBlock.value);
});

const copyToClipboard = () => {
  if (navigator && navigator.clipboard) {
    navigator.clipboard.writeText(props.code);
    copied.value = true;

    setTimeout(() => {
      copied.value = false;
    }, 3000);

    return;
  }

  // handle not supporte devices
};
</script>
