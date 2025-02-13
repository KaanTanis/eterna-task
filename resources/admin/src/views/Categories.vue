<template>
    <div class="p-4 container mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold mb-4">Kategoriler</h2>
            <router-link 
                to="/categories/create"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Yeni Kategori
            </router-link>
        </div>
        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full bg-gray-100 border border-gray-200 shadow-md">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="py-3 px-6 text-left">İsim</th>
                        <th class="py-3 px-6 text-right">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50" v-for="category in categories" :key="category.id">
                        <td class="py-3 px-6">{{ category.name }}</td>
                        <td class="py-3 px-6 text-right">
                            <router-link :to="`/categories/edit/${category.id}`" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                Düzenle
                            </router-link>
                            <a href="" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 ml-2">Sil</a>
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
import { storeToRefs } from 'pinia'

export default {
    name: 'Categories',
    setup() {
        const store = useStore();
        const { categories } = storeToRefs(store);

        onMounted(async () => {
            await store.fetchCategories();
        });

        return {
            categories,
        };
    },
};
</script>