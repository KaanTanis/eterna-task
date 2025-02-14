<template>
    <div class="p-4 container mx-auto">
        <h2 class="text-xl font-bold mb-4">Yeni Ürün Ekle</h2>
        <form @submit.prevent="createProduct" class="space-y-4" enctype="multipart/form-data">
            <input v-model="name" type="text" placeholder="Ürün Adı" class="border p-2 w-full rounded">
            <input v-model="slug" type="text" placeholder="Slug" class="border p-2 w-full rounded">
            <input v-model="price" type="number" step="0.01" placeholder="Fiyat" class="border p-2 w-full rounded">
            <textarea v-model="description" placeholder="Açıklama" class="border p-2 w-full rounded"></textarea>

            <!-- Kategori Seçimi -->
            <select v-model="selectedCategories" multiple class="border p-2 w-full rounded">
                <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                </option>
            </select>

            <!-- Önizleme Görseli -->
            <div v-if="previewImage" class="mt-2">
                <p class="text-sm">Seçilen Görsel:</p>
                <img :src="previewImage" alt="Ürün Görseli" class="w-32 h-32 object-cover rounded border">
            </div>

            <input type="file" @change="handleFileUpload" class="border p-2 w-full rounded">
            
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Kaydet
            </button>
        </form>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { useToast } from 'vue-toast-notification';

export default {
    name: "ProductCreate",
    setup() {
        const name = ref("");
        const slug = ref("");
        const price = ref(0);
        const description = ref("");
        const image = ref(null);
        const previewImage = ref(null);
        const selectedCategories = ref([]);
        const categories = ref([]);
        const router = useRouter();
        const toast = useToast();

        // Kategorileri API'den çek
        onMounted(async () => {
            try {
                const response = await axios.get("/api/categories");
                categories.value = response.data;
            } catch (error) {
                console.error("Kategoriler alınırken hata oluştu:", error);
            }
        });

        const handleFileUpload = (event) => {
            const file = event.target.files[0];
            image.value = file;

            // Seçilen dosyanın önizlemesini göster
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.value = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const createProduct = async () => {
            try {
                const formData = new FormData();
                formData.append("name", name.value);
                formData.append("slug", slug.value);
                formData.append("price", price.value);
                formData.append("description", description.value);
                selectedCategories.value.forEach(category => {
                    formData.append("categories[]", category);
                });
                if (image.value) {
                    formData.append("image", image.value);
                }

                const response = await axios.post(`/api/products`, formData, {
                    headers: { 
                        "Content-Type": "multipart/form-data",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                toast.open({
                    message: response.data.message,
                    type: response.data.status,
                });

                router.push("/products"); // Listeye yönlendir
            } catch (error) {
                for (const key in error.response.data.errors) {
                    toast.error(error.response.data.errors[key][0]);
                }
            }
        };

        return { name, slug, price, description, createProduct, handleFileUpload, previewImage, selectedCategories, categories };
    },
};
</script>
