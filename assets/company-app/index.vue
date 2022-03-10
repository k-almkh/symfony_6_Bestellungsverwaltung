<template>
    <div>
        <h1>Firmenübersicht</h1>
        <company-table-view :companies="companies"></company-table-view>
        <router-link to="/admin/companies">Home</router-link>
        <router-view />
    </div>
</template>

<script>
import CompanyTableView from "./components/CompanyTableView";

export default {
    name: 'Company-App-Index',
    components: {
        CompanyTableView,
    },
    data: function () {
        return {
            companies: [],
        };
    },
    mounted() {
        this.$store.dispatch('loadCompanies')
            .then( companies => {
                this.companies = companies;
            });
    }
};
</script>