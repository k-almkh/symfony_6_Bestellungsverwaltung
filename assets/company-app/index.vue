<template>
 <div >
     <h1>Hallo Company</h1>
 </div>
</template>

<script>
    export default {
        name: 'Company-App-Index',
        date: function () {
            return {
                companies: [],
            };
        },
        mounted() {
            this.$store.dispatch('loadCompanies')
                .then( companies => {
                    console.log(companies);
                    this.companies = companies;
            });
        }

    }  

</script>

<style>

</style>