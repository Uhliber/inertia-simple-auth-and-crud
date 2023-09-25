<template>
  <Head title="Create User" />

  <h1 class="text-3xl">
    Edit User
  </h1>

  <form class="max-w-md mx-auto mt-8" @submit.prevent="submit">
    <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name"> Name </label>

      <input
        id="name"
        v-model="form.name"
        class="border border-gray-400 p-2 w-full"
        type="text"
        name="name"
        required
      >
      <div
        v-if="form.errors.name"
        class="text-red-500 text-xs mt-1"
        v-text="form.errors.name"
      />
    </div>

    <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email"> Email </label>

      <input
        id="email"
        v-model="form.email"
        class="border border-gray-400 p-2 w-full"
        type="email"
        name="email"
        required
      >

      <div
        v-if="form.errors.email"
        class="text-red-500 text-xs mt-1"
        v-text="form.errors.email"
      />
    </div>

    <div class="mb-6">
      <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password"> Password </label>

      <input
        id="password"
        v-model="form.password"
        class="border border-gray-400 p-2 w-full"
        type="password"
        name="password"
      >

      <div
        v-if="form.errors.password"
        class="text-red-500 text-xs mt-1"
        v-text="form.errors.password"
      />
    </div>

    <div class="mb-6">
      <button
        type="submit"
        class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
        :disabled="form.processing"
      >
        Submit
      </button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

let form = useForm({
  name: "",
  email: "",
  password: "",
});

let submit = () => {
  form.post("/users");
};
</script>
