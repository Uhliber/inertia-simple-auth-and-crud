<template>
  <Head title="Log In" />

  <main class="grid place-items-center min-h-screen">
    <section class="bg-white p-8 rounded-xl max-w-md mx-auto border w-full">
      <h1 class="text-3xl mb-6">
        Log In
      </h1>

      <form @submit.prevent="submit">
        <FormInput
          id="email"
          v-model="form.email"
          label="Email"
          type="email"
          name="email"
          required
          class="mb-6"
          :error="form.errors.email"
          @input="form.clearErrors()"
        />

        <FormInput
          id="password"
          v-model="form.password"
          label="Password"
          type="password"
          name="password"
          class="mb-6"
          :error="form.errors.password"
          @input="form.clearErrors()"
        />

        <div>
          <button
            type="submit"
            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
            :disabled="form.processing"
          >
            Log In
          </button>
        </div>
      </form>
    </section>
  </main>
</template>

<script>
export default {
  layout: null,
};
</script>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import FormInput from "@/Shared/FormInput.vue";

let form = useForm({
  email: "",
  password: "",
});

let submit = () => {
  form.post("/login");
};
</script>
