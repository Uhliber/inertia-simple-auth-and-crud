<template>
  <div>
    <header class="bg-gray-800 text-white flex justify-end px-2 py-1 text-xs border-b border-gray-700">
      <button
        v-if="supported"
        class="rounded px-2"
        :class="{'hover:bg-gray-600': !copied}"
        :disabled="copied"
        @click="copy"
      >
        {{ copied ? 'Copied' : 'Copy' }}
      </button>
    </header>
    <pre><code ref="codeBlock">{{ code }}</code></pre>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useClipboard } from "@/Composables/useClipboard";
import { highlightElement } from "@/Services/SyntaxHighlighting";

const codeBlock = ref(null);

const { copy, copied, supported } = useClipboard(props.code);

const props = defineProps({
  code: {
    type: String,
    required: true,
  }
});

onMounted(() => {
  highlightElement(codeBlock.value);
});
</script>
