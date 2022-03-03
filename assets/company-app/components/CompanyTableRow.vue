<template>
    <tr>
        <td>{{ company.id }}</td>
        <td>{{ company.name }}</td>
        <td>
            <ul class="list-group list-group-flush">
                <li  v-for="product in company.products" :key="product.id" class="list-group-item">{{ product.name }}</li>
            </ul>
        </td>
        <td><a :href="getLink()">Produkt anlegen</a></td>
    </tr>

</template>

<script>


export default {
    name: 'CompanyTableRow',
    props: {
        company: {
            type: Object,
            required: true
        },
    },
    methods: {
        getLink() {
            return '/admin/product/add/' + this.company.id;
        },
        randomColor : function(){
            return Math.floor(Math.random() * ['', 'primary', 'secondary', 'success', 'danger', 'warning', 'info']) + 1;
        }
    }


}
</script>
<style>

</style>
