<template>
    <div class="p-4 container mx-auto">
        <h2 class="text-xl font-bold mb-4">Ürünü Düzenle</h2>
        <form @submit.prevent="updateProduct" class="space-y-4" enctype="multipart/form-data">
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

            <!-- Mevcut Görsel -->
            <div v-if="previewImage || currentImage" class="mt-2">
                <p class="text-sm">Mevcut / Seçilen Görsel:</p>
                <img :src="previewImage || currentImage" alt="Ürün Görseli" class="w-32 h-32 object-cover rounded border">
            </div>

            <input type="file" @change="handleFileUpload" class="border p-2 w-full rounded">
            
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Güncelle
            </button>
        </form>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";
import { useToast } from 'vue-toast-notification';

export default {
    name: "ProductEdit",
    setup() {
        const name = ref("");
        const slug = ref("");
        const price = ref(0);
        const description = ref("");
        const image = ref(null);
        const previewImage = ref(null);
        const currentImage = ref(null);
        const selectedCategories = ref([]);
        const categories = ref([]);
        const router = useRouter();
        const route = useRoute();
        const toast = useToast();
        const productId = route.params.id;

        // Ürün detaylarını API'den çek
        onMounted(async () => {
            try {
                const [productRes, categoryRes] = await Promise.all([
                    axios.get(`/api/products/${productId}`),
                    axios.get("/api/categories")
                ]);

                // Ürün bilgilerini doldur
                const product = productRes.data;
                name.value = product.name;
                slug.value = product.slug;
                price.value = product.price;
                description.value = product.description;
                currentImage.value = product.image;
                selectedCategories.value = product.categories.map(cat => cat.id);

                // Kategorileri API'den çek
                categories.value = categoryRes.data;
            } catch (error) {
                console.error("Ürün veya kategoriler alınırken hata oluştu:", error);
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

        const updateProduct = async () => {
            try {
                const formData = new FormData();
                formData.append("name", name.value);
                formData.append("slug", slug.value);
                formData.append("price", price.value);
                formData.append("description", description.value);
                // method
                formData.append("_method", "PUT");
                selectedCategories.value.forEach(category => {
                    formData.append("categories[]", category);
                });
                if (image.value) {
                    formData.append("image", image.value);
                }

                const response = await axios.post(`/api/products/${productId}`, formData, {
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

        return { name, slug, price, description, updateProduct, handleFileUpload, previewImage, currentImage, selectedCategories, categories };
    },
};
</script>
