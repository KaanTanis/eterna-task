<template>
    <div class="p-4">
        <h2 class="text-xl font-bold mb-4">Kategoriler</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div v-for="category in categories" :key="category.id" class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold">{{ category.name }}</h3>
            <p>{{ category.description }}</p>
        </div>
        </div>
    </div>
</template>

<script>
import { useStore } from '../store';
import { onMounted, ref } from 'vue';

export default {
    name: 'Categories',
    setup() {
        const store = useStore();
        const loading = ref(true);

        onMounted(async () => {
            await store.fetchCategories();
            loading.value = false;
        });

        return { store, loading };
        // return {
        //     categories: store.categories,
        // };
    },
};
</script>