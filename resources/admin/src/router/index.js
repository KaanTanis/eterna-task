import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Categories from "../views/Categories.vue";
import Products from "../views/Products.vue";
import CategoryCreate from "../views/CategoryCreate.vue";
import CategoryEdit from "../views/CategoryEdit.vue";

const routes = [
    { path: "/", component: Home },
    { path: "/categories", component: Categories },
    { path: "/categories/create", component: CategoryCreate },
    { path: "/categories/edit/:id", component: CategoryEdit, props: true },
    { path: "/products", component: Products },
];

const router = createRouter({
    history: createWebHistory('/admin'),
    routes,
});

export default router;
