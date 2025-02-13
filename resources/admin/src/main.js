import { createApp } from 'vue'
import "../css/admin.css";
import App from './App.vue'
import router from "./router";
import { createPinia } from "pinia";
import ToastPlugin from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const app = createApp(App);
app.use(createPinia());
app.use(router);
app.use(ToastPlugin);
app.mount("#app");
