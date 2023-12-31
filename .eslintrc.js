module.exports = {
  env: {
    browser: true,
    es2021: true,
    node: true,
  },
  extends: ["eslint:recommended", "plugin:vue/vue3-recommended"],
  parser: "vue-eslint-parser",
  parserOptions: {
    ecmaVersion: 12,
    sourceType: "module",
  },
  plugins: ["vue"],
  rules: {
    indent: ["error", 2],
    "linebreak-style": ["error", "unix"],
    quotes: ["error", "double"],
    semi: ["error", "always"],

    "vue/order-in-components": ["error"],
    "vue/require-default-prop": ["off"],
    "vue/max-attributes-per-line": [
      "error",
      {
        singleline: {
          max: 2,
          allowFirstLine: true,
        },
      },
    ],
  },
  globals: { require: true, defineProps: true },
};
