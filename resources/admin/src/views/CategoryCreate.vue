<template>
    <div class="p-4">
        <h2 class="text-xl font-bold mb-4">Yeni Kategori Ekle</h2>
        <form @submit.prevent="createCategory" class="space-y-4">
            <input v-model="name" type="text" placeholder="Kategori Adı" class="border p-2 w-full rounded">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Kaydet
            </button>
        </form>
    </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default {
    name: "CategoryCreate",
    setup() {
        const name = ref("");
        const router = useRouter();

        const createCategory = async () => {
            try {
                await axios.post("/api/categories", { name: name.value });
                router.push("/categories"); // Başarılı olursa yönlendir
            } catch (error) {
                console.error("Kategori eklenirken hata oluştu:", error);
            }
        };

        return { name, createCategory };
    },
};
</script>
