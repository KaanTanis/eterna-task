<template>
    <div class="p-4 container mx-auto">
        <h2 class="text-xl font-bold mb-4">Kategoriler</h2>
        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full bg-gray-100 border border-gray-200 shadow-md">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">İsim</th>
                        <th class="py-3 px-6 text-left">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50" v-for="category in categories" :key="category.id">
                        <td class="py-3 px-6">1</td>
                        <td class="py-3 px-6">{{ category.name }}</td>
                        <td class="py-3 px-6">
                            <a href="" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Düzenle</a>
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