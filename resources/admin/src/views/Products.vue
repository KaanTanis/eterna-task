<template>
    <div class="p-4 container mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold mb-4">Ürünler</h2>
            <router-link 
                to="/products/create"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Yeni Ürün
            </router-link>
        </div>
        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full bg-gray-100 border border-gray-200 shadow-md">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="py-3 px-6 text-left">İsim</th>
                        <th class="py-3 px-6 text-left">Kategori</th>
                        <th class="py-3 px-6 text-right">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50" v-for="product in products" :key="product.id">
                        <td class="py-3 px-6">{{ product.name }}</td>
                        <td class="py-3 px-6">{{ product.first_category ? product.first_category.name : 'Kategori Yok' }}</td>
                        <td class="py-3 px-6 text-right">
                            <router-link :to="`/products/edit/${product.id}`" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                Düzenle
                            </router-link>
                            <button 
                                @click="confirmDelete(product.id)"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 ml-2"
                            >
                                Sil
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { useStore } from '../store';
import { onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import { useToast } from 'vue-toast-notification';

export default {
    name: 'Products',
    setup() {
        const store = useStore();
        const { products } = storeToRefs(store);
        const toast = useToast();

        onMounted(async () => {
            await store.fetchProducts();
        });

        const confirmDelete = async (id) => {
            if (confirm("Bu ürünü silmek istediğinize emin misiniz?")) {
                await store.deleteProduct(id);
                toast.success("Ürün başarıyla silindi!");
            }
        };

        return {
            products,
            confirmDelete
        };
    },
};
</script>
