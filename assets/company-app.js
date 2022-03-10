import { createApp } from "vue";
import App from './company-app/index';
import store from './store';
import router from "./router";

createApp(App)
    .use(store)
    .use(router)
    .mount('#company-app')
