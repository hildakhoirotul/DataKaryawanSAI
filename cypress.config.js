const { defineConfig } = require("cypress");

module.exports = defineConfig({
  defaultCommandTimeout: 1000000,
  pageLoadTimeout: 1000000,
  e2e: {
    setupNodeEvents(on, config) {
      // implement node event listeners here
    },
  },
});
