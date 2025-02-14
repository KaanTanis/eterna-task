import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../store/auth";
import Home from "../views/Home.vue";
import Categories from "../views/Categories.vue";
import Products from "../views/Products.vue";
import CategoryCreate from "../views/CategoryCreate.vue";
import CategoryEdit from "../views/CategoryEdit.vue";
import ProductCreate from "../views/ProductCreate.vue";
import ProductEdit from "../views/ProductEdit.vue";
import Login from "../views/Login.vue";

const routes = [
    { 
        path: "/", 
        component: Home,
        meta: { requiresAuth: true },
    },
    { path: "/login", component: Login },
    {
        path: "/categories",
        component: Categories,
        meta: { requiresAuth: true },
    },
    {
        path: "/categories/create",
        component: CategoryCreate,
        meta: { requiresAuth: true },
    },
    {
        path: "/categories/edit/:id",
        component: CategoryEdit,
        props: true,
        meta: { requiresAuth: true },
    },
    { path: "/products", component: Products, meta: { requiresAuth: true } },
    {
        path: "/products/create",
        component: ProductCreate,
        meta: { requiresAuth: true },
    },
    {
        path: "/products/edit/:id",
        component: ProductEdit,
        props: true,
        meta: { requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHistory('/admin'),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const auth = useAuthStore();
    await auth.fetchUser();

    if (to.meta.requiresAuth && !auth.user) {
        next("/login");
    } else {
        next();
    }
});

export default router;
