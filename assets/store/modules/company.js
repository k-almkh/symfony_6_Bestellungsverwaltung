import axios from "axios";

export default{
    state(){
        return{
            companies:[],
        }
    },
    mutations:{

    },
    actions:{

    },
    getters:{
        getCompanies(state){
            return state.companies;
        }
    }
}