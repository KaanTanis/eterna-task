import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Categories from "../views/Categories.vue";
import Products from "../views/Products.vue";
import CategoryCreate from "../views/CategoryCreate.vue";
import CategoryEdit from "../views/CategoryEdit.vue";
import ProductCreate from "../views/ProductCreate.vue";
import ProductEdit from "../views/ProductEdit.vue";

const routes = [
    { path: "/", component: Home },
    { path: "/categories", component: Categories },
    { path: "/categories/create", component: CategoryCreate },
    { path: "/categories/edit/:id", component: CategoryEdit, props: true },
    { path: "/products", component: Products },
    { path: "/products/create", component: ProductCreate },
    { path: "/products/edit/:id", component: ProductEdit, props: true },
];

const router = createRouter({
    history: createWebHistory('/admin'),
    routes,
});

export default router;
