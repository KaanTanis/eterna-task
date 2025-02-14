<template>
    <div class="p-4 container mx-auto">
        <h2 class="text-xl font-bold mb-4">Kategori Düzenle</h2>
        <form @submit.prevent="updateCategory" class="space-y-4" enctype="multipart/form-data">
            <input v-model="name" type="text" placeholder="Kategori Adı" class="border p-2 w-full rounded">
            <input v-model="slug" type="text" placeholder="Slug" class="border p-2 w-full rounded">

            <!-- Mevcut Görsel -->
            <div v-if="previewImage || imageUrl" class="mt-2">
                <p class="text-sm">Mevcut Görsel:</p>
                <img :src="previewImage || imageUrl" alt="Kategori Görseli" class="w-32 h-32 object-cover rounded border">
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
import { useRoute, useRouter } from "vue-router";

import {useToast} from 'vue-toast-notification';

export default {
    name: "CategoryEdit",
    setup() {
        const name = ref("");
        const slug = ref("");
        const image = ref(null);
        const imageUrl = ref(""); // API'den gelen mevcut görsel
        const previewImage = ref(null); // Yeni yüklenen görsel önizleme
        const route = useRoute();
        const router = useRouter();
        const categoryId = route.params.id;

        onMounted(async () => {
            try {
                let response = await axios.get(`/api/categories/${categoryId}`);
                response = response.data;
                
                name.value = response.data.name;
                slug.value = response.data.slug;
                imageUrl.value = response.data.image; // Mevcut görsel URL'si
            } catch (error) {
                console.error("Kategori çekilirken hata oluştu:", error);
            }
        });

        const handleFileUpload = (event) => {
            const file = event.target.files[0];
            image.value = file;

            // Seçilen dosyanın anlık önizlemesini oluştur
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.value = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const updateCategory = async () => {
            try {
                const formData = new FormData();
                
                formData.append("name", name.value);
                formData.append("slug", slug.value);
                // method
                formData.append("_method", "PUT");
                if (image.value) {
                    formData.append("image", image.value);
                }

                const response = await axios.post(`/api/categories/${categoryId}`, formData, {
                    headers: { 
                        "Content-Type": "multipart/form-data",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });

                const $toast = useToast()
                $toast.open({
                    message: response.data.message,
                    type: response.data.status,
                });

                router.push("/categories");
            } catch (error) {
                console.error("Kategori güncellenirken hata oluştu:", error);
            }
        };

        return { name, slug, updateCategory, handleFileUpload, imageUrl, previewImage };
    },
};
</script>
