import { ref } from "vue";

export function useClipboard(text) {
  const copied = ref(false);

  const supported = navigator && "clipboard" in navigator;

  const copy = () => {
    if (supported) {
      navigator.clipboard.writeText(text);
      copied.value = true;

      setTimeout(() => {
        copied.value = false;
      }, 3000);

      return;
    }
    // handle not supporte devices
  };

  return { copy, copied, supported };
}
