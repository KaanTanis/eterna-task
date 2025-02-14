import { defineStore } from "pinia";
import axios from "axios";

export const useStore = defineStore("main", {
    state: () => ({
        categories: [],
        products: [],
    }),
    getters: {
        getCategories: (state) => state.categories,
        getProducts: (state) => state.products,
    },
    actions: {
        async fetchCategories() {
            try {
                const response = await axios.get("/api/categories");
                this.categories = response.data;
            } catch (error) {
                console.error("Kategorileri çekerken hata oluştu:", error);
            }
        },
        async deleteCategory(id) {
            try {
                await axios.delete(`/api/categories/${id}`);
                this.categories = this.categories.filter(
                    (category) => category.id !== id
                );
            } catch (error) {
                console.error("Kategori silinirken hata oluştu:", error);
            }
        },
        async fetchProducts() {
            try {
                const response = await axios.get("/api/products");
                this.products = response.data;
            } catch (error) {
                console.error("Ürünleri çekerken hata oluştu:", error);
            }
        },
        async deleteProduct(id) {
            try {
                await axios.delete(`/api/products/${id}`);
                this.products = this.products.filter(
                    (product) => product.id !== id
                );
            } catch (error) {
                console.error("Ürün silinirken hata oluştu:", error);
            }
        },
        addCategory(category) {
            this.categories.push(category);
        },
        addProduct(product) {
            this.products.push(product);
        },
    },
});