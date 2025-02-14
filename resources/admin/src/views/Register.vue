<template>
    <div class="p-4 container mx-auto">
        <h2 class="text-xl font-bold mb-4">Kayıt Ol</h2>
        <form @submit.prevent="register" class="space-y-4">
            <input v-model="name" type="text" required placeholder="İsim" class="border p-2 w-full rounded">
            <input v-model="surname" type="text" required placeholder="Soyisim" class="border p-2 w-full rounded">
            <input v-model="username" type="text" required placeholder="Kullanıcı Adı" class="border p-2 w-full rounded">
            <input v-model="email" type="email" required placeholder="E-posta" class="border p-2 w-full rounded">
            <input v-model="password" type="password" required placeholder="Şifre" class="border p-2 w-full rounded">
            <input v-model="password_confirmation" type="password" required placeholder="Şifre Tekrar" class="border p-2 w-full rounded">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Kayıt Ol
            </button>
        </form>
    </div>
</template>

<script>
import { ref } from "vue";
import { useAuthStore } from "../store/auth";
import { useRouter } from "vue-router";
import axios from "axios";
import { useToast } from "vue-toast-notification";

axios.defaults.withCredentials = true;
axios.defaults.baseURL = "/";

export default {
    setup() {
        const name = ref("");
        const surname = ref("");
        const username = ref("");
        const email = ref("");
        const password = ref("");
        const password_confirmation = ref("");
        const auth = useAuthStore();
        const router = useRouter();
        const toast = useToast();

        const register = async () => {
            try {
                // CSRF Cookie al
                await axios.get("/sanctum/csrf-cookie");

                // Register isteği
                const response = await axios.post("/api/register", {
                    name: name.value,
                    surname: surname.value,
                    username: username.value,
                    email: email.value,
                    password: password.value,
                    password_confirmation: password_confirmation.value,
                });

                if (response.data) {
                    await auth.fetchUser();
                    router.push("/");

                    toast.success("Başarıyla kayıt oldunuz!");
                }
            } catch (error) {
                for (const key in error.response.data.errors) {
                    toast.error(error.response.data.errors[key][0]);
                }
            }
        };

        return { name, surname, username, email, password, password_confirmation, register };
    },
};
</script>
