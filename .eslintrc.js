// eslint-disable-next-line no-undef
module.exports = {
    env: {
        browser: true,
        es2021: true,
    },
    extends: ["eslint:recommended", "plugin:vue/vue3-recommended"],
    overrides: [],
    parserOptions: {
        ecmaVersion: "latest",
        sourceType: "module",
    },
    plugins: ["vue"],
    rules: {
        indent: "off",
        "vue/html-indent": "off",
        "vue/multi-word-component-names": "off",
        "vue/max-attributes-per-line": [
            "error",
            {
                singleline: {
                    max: 3,
                },
                multiline: {
                    max: 1,
                },
            },
        ],
        "vue/html-self-closing": "off",
        "vue/singleline-html-element-content-newline": "off",
    },
};
