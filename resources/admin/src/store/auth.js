import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
    }),
    actions: {
        async fetchUser() {
            try {
                const response = await axios.get("/api/user");
                this.user = response.data;
            } catch (error) {
                this.user = null;
            }
        },
        async logout() {
            await axios.post("/api/logout");
            this.user = null;
        },
    },
});
