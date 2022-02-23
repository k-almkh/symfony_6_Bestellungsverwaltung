import axios from "axios";

export default{
    state(){
        return{
            companies:[],
        }
    },
    mutations: {
        setCompanies(state, companies) {
            state.companies = companies;
        },
    },
    actions: {
        loadCompanies({commit, state}) {
            return new Promise((resolve, reject) => {
                axios.get('/api/companies')
                    .then((response) => {
                        commit('setCompanies', response.data);
                        resolve(state.companies);
                    });

            });
        },
    },

    getters:{
        getCompanies(state){
            return state.companies;
        }
    }
}