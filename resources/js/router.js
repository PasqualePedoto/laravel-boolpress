// Importiamo Vue e VueRouter

import Vue from "vue";
import VueRouter from "vue-router";

// Importiamo tutti i componenti pages

import PostsPage from "./pages/PostsPage.vue";
import AboutPage from "./pages/AboutPage.vue";
import ContactsPage from "./pages/ContactsPage.vue";
import HomePage from "./pages/HomePage.vue";
import NotFoundPage from "./pages/NotFoundPage.vue";
import PostDetailsPage from "./pages/PostDetailsPage.vue";

// Usa vue-router

Vue.use(VueRouter);

// Definiamo le rotte

const routes = new VueRouter({
    // Gestisce la cronologia delle rotte
    mode: "history",

    // Gestisce l'active dei link delle pagine nell'header
    linkExactActiveClass: "active",

    // Oggetto contenente tutte le rotte
    routes: [
        { path: "/", component: HomePage, name: "home" },
        { path: "/posts", component: PostsPage, name: "posts" },
        { path: "/about", component: AboutPage, name: "about" },
        { path: "/contacts", component: ContactsPage, name: "contacts" },
        {
            path: "/posts/:slug",
            component: PostDetailsPage,
            name: "post-detail",
        },

        // ! Rotta da mettere sempre dopo le altre

        { path: "*", component: NotFoundPage, name: "not_found" },
    ],
});

// Esporto solo l'oggetto fatto e finito

export default routes;
