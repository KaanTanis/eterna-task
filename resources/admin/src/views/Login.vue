<template>
    <div class="p-4 container mx-auto">
        <h2 class="text-xl font-bold mb-4">Giriş Yap</h2>
        <form @submit.prevent="login" class="space-y-4">
            <input v-model="email" type="email" required placeholder="E-posta" class="border p-2 w-full rounded">
            <input v-model="password" type="password" required placeholder="Şifre" class="border p-2 w-full rounded">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Giriş Yap
            </button>
        </form>
    </div>
</template>

<script>
import { ref } from "vue";
import { useAuthStore } from "../store/auth";
import { useRouter } from "vue-router";
import axios from 'axios';
import { useToast } from 'vue-toast-notification';

axios.defaults.withCredentials = true;
axios.defaults.baseURL = '/';

export default {
    setup() {
        const email = ref("");
        const password = ref("");
        const auth = useAuthStore();
        const router = useRouter();
        const toast = useToast();

        const login = async () => {
            try {
                // CSRF Cookie al
                await axios.get('/sanctum/csrf-cookie');

                // Login isteği
                const response = await axios.post('/api/login', {
                    email: email.value,
                    password: password.value
                });

                if (response.data) {
                    await auth.fetchUser();
                    router.push("/");

                    toast.success("Başarıyla giriş yaptınız!");
                }
            } catch (error) {
                console.error("Giriş hatası:", error);
                alert(error.response?.data?.message || "Giriş başarısız!");
            }
        };

        return { email, password, login };
    },
};
</script>