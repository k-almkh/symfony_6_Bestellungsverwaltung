import { createApp } from "vue";
import App from './company-app/index';
import store from './store';

createApp(App)
    .use(store)
    .mount('#company-app')
