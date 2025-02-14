<template>
    <div class="p-4 container mx-auto">
        <h2 class="text-xl font-bold mb-4">Yeni Kategori Ekle</h2>
        <form @submit.prevent="createCategory" class="space-y-4" enctype="multipart/form-data">
            <input v-model="name" type="text" placeholder="Kategori Adı" class="border p-2 w-full rounded">
            <input v-model="slug" type="text" placeholder="Slug" class="border p-2 w-full rounded">

            <!-- Önizleme Görseli -->
            <div v-if="previewImage" class="mt-2">
                <p class="text-sm">Seçilen Görsel:</p>
                <img :src="previewImage" alt="Kategori Görseli" class="w-32 h-32 object-cover rounded border">
            </div>

            <input type="file" @change="handleFileUpload" class="border p-2 w-full rounded">
            
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
import { useToast } from 'vue-toast-notification';

export default {
    name: "CategoryCreate",
    setup() {
        const name = ref("");
        const slug = ref("");
        const image = ref(null);
        const previewImage = ref(null);
        const router = useRouter();
        const toast = useToast();

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

        const createCategory = async () => {
            try {
                const formData = new FormData();
                formData.append("name", name.value);
                formData.append("slug", slug.value);
                if (image.value) {
                    formData.append("image", image.value);
                }

                const response = await axios.post(`/api/categories`, formData, {
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

                router.push("/categories"); // Listeye yönlendir
            } catch (error) {
                console.error("Kategori oluşturulurken hata oluştu:", error);
                toast.error("Kategori eklenirken hata oluştu!");
            }
        };

        return { name, slug, createCategory, handleFileUpload, previewImage };
    },
};
</script>
