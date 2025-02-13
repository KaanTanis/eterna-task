import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Categories from "../views/Categories.vue";
import Products from "../views/Products.vue";

const routes = [
    { path: "/", component: Home },
    { path: "/categories", component: Categories },
    { path: "/products", component: Products },
];

const router = createRouter({
    history: createWebHistory('/admin'),
    routes,
});

export default router;
