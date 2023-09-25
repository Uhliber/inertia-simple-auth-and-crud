<template>
  <Head title="Create User" />

  <h1 class="text-3xl">
    Create New User
  </h1>

  <form class="max-w-md mx-auto mt-8" @submit.prevent="submit">
    <FormInput
      id="name"
      v-model="form.name"
      label="Name"
      type="text"
      name="name"
      required
      class="mb-6"
      :error="form.errors.name"
      @input="form.clearErrors('name')"
    />
    <FormInput
      id="email"
      v-model="form.email"
      label="Email"
      type="email"
      name="email"
      required
      class="mb-6"
      :error="form.errors.email"
      @input="form.clearErrors('email')"
    />
    <FormInput
      id="password"
      v-model="form.password"
      label="Password"
      type="password"
      name="password"
      class="mb-6"
      :error="form.errors.password"
      @input="form.clearErrors('password')"
    />

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
import FormInput from "@/Shared/FormInput.vue";

let form = useForm({
  name: "",
  email: "",
  password: "",
});

let submit = () => {
  form.post("/users");
};
</script>
