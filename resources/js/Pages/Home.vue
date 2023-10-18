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
      <pre>
        <code ref="example-code">
          class Example
          {
            public function __construct(
              {
                // Hello
              }
            )
          }
        </code>
      </pre>
    </div>
    <br>
    <pre>
      <code>
        class Another Example
        {
          public function __construct(
            {
              // World
            }
          )
        }
      </code>
    </pre>
  </div>
</template>

<script>
import { highlight } from "@/Services/SyntaxHighlighting";

export default {
  mounted() {
    // highlight("#example-block");

    // highlightElement(this.$refs["example-code"]);

    highlight();
  }
};
</script>
