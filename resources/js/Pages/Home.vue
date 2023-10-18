<template>
  <Head>
    <title>Home</title>
    <meta
      type="description"
      content="Home information"
      head-key="description"
    >
  </Head>

  <h1 class="text-3xl">
    Home
  </h1>
  <div class="bg-slate-600 p-4 mt-2">
    <div id="example-block">
      <Highlight :code="snippet" />
    </div>
    <br>
    <Highlight :code="snippet" />
  </div>
</template>

<script setup>
import Highlight from "@/Components/Highlight.vue";

let snippet = `
class Example
      {
        public function __construct(
          {
            // Hello World
          }
        )
      }
`
  .trim();
</script>
