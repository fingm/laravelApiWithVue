import { createApp } from "vue";
import Oruga from '@oruga-ui/oruga-next';
import '@oruga-ui/theme-oruga/dist/oruga.css';
import '@mdi/font/css/materialdesignicons.css';
import axios from "axios";
import App from "./App.vue";

import router from './router';

const app = createApp(App);

app.config.globalProperties.$axios = axios;
window.axios = axios;
app.use(Oruga).use(router);
app.mount("#app");
