<template>
    <div class="p-4">
        <h2 class="text-xl font-bold mb-4">Ürünler</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div v-for="product in products" :key="product.id" class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold">{{ product.name }}</h3>
            <p>{{ product.description }}</p>
            <p class="text-gray-600">{{ product.price }} TL</p>
        </div>
        </div>
    </div>
</template>

<script>
import { useStore } from '../store';

export default {
    name: 'Products',
    setup() {
        const store = useStore();
        return {
            products: store.products,
        };
    },
};
</script>