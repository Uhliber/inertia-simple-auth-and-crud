<template>
  <Head title="User" />

  <h1 class="text-3xl">
    User
  </h1>
  <div class="mt-2">
    <h4 class="text-xl">
      {{ user.name }}
    </h4>
    <p>
      Registered: {{ user.register_date }}
    </p>
  </div>
</template>

<script setup>
defineProps({
  user: Object,
});
</script>
