import { createApp } from "vue";
import Oruga from '@oruga-ui/oruga-next';
import '@oruga-ui/theme-oruga/dist/oruga.css';
import axios from "axios";
import App from "./App.vue";

const app = createApp(App);

app.config.globalProperties.$axios = axios;
window.axios = axios;
app.use(Oruga);
app.mount("#app");
