import { createStore } from "vuex";
import company from './modules/company';

const store = createStore({
    modules: {
        company,
    }
})

export default store;