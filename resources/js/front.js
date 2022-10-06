require("./bootstrap");

window.Vue = require("vue");

// Qui importiamo il file router.js e per convenzione
// lo chiamiamo router

import App from "./components/App.vue";

import router from "./router";

const app = new Vue({
    el: "#app",
    render: (h) => h(App),
    // Chiamiamo il router
    router,
});
