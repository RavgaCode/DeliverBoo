import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from "./pages/HomePage.vue";
import AboutPage from "./pages/AboutPage.vue";
import MenuPage from "./pages/MenuPage.vue";
import ErrorNotFound from "./pages/ErrorNotFound.vue";
import RestaurantPage from "./pages/RestaurantPage.vue";
import ContactPage from "./pages/ContactPage.vue";
import PaymentPage from "./pages/PaymentPage.vue";
import PaymentSuccessful from "./pages/PaymentSuccessful.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            component: HomePage,
            name: "home",
        },
        {
            path: "/about",
            component: AboutPage,
            name: "about",
        },
        {
            path: "/plates",
            component: MenuPage,
            name: "plates",
        },
        {
            path: "/restaurants/:slug",
            component: RestaurantPage,
            name: "restaurant",
        },
        {
            path: "/contact",
            component: ContactPage,
            name: "contact",
        },
        {
            path: "/payment",
            component: PaymentPage,
            name: "payment",
        },
        {
            path: "/payment-successful",
            component: PaymentSuccessful,
            name: "payment-successful",
        },
        {
            path: "/*",
            component: ErrorNotFound,
            name: "error",
        },
    ],
});

export default router;
