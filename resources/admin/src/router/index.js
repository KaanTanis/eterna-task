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
import Register from "../views/Register.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
        meta: { requiresAuth: true },
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: { requiresGuest: true },
    },
    {
        path: "/register",
        name: "register",
        component: Register,
        meta: { requiresGuest: true },
    },
    {
        path: "/categories",
        name: "categories",
        component: Categories,
        meta: { requiresAuth: true },
    },
    {
        path: "/categories/create",
        name: "category-create",
        component: CategoryCreate,
        meta: { requiresAuth: true },
    },
    {
        path: "/categories/edit/:id",
        name: "category-edit",
        component: CategoryEdit,
        props: true,
        meta: { requiresAuth: true },
    },
    {
        path: "/products",
        name: "products",
        component: Products,
        meta: { requiresAuth: true },
    },
    {
        path: "/products/create",
        name: "product-create",
        component: ProductCreate,
        meta: { requiresAuth: true },
    },
    {
        path: "/products/edit/:id",
        name: "product-edit",
        component: ProductEdit,
        props: true,
        meta: { requiresAuth: true },
    },
    {
        path: "/:pathMatch(.*)*",
        redirect: "/",
    },
];

const router = createRouter({
    history: createWebHistory("/admin"),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const auth = useAuthStore();

    try {
        await auth.fetchUser();

        if (!auth.user && to.meta.requiresAuth) {
            return next({ name: "login" });
        }

        if (auth.user && to.meta.requiresGuest) {
            return next({ name: "home" });
        }

        return next();
    } catch (error) {
        console.error("Navigation error:", error);
        if (to.meta.requiresAuth) {
            return next({ name: "login" });
        }
        return next();
    }
});

export default router;
