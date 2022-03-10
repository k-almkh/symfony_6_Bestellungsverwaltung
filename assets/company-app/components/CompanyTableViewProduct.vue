<template>
    <li class="list-group-item">
        <div class="d-flex">
            <div class="me-auto">{{ product.name }}</div>
            <div>Icons</div>
        </div></li>
</template>

<script>
export default {
    name: "CompanyTableViewProduct",
    props: {
        product: {
            type: Object,
            required: true,
        }
    }
}
</script>

<style scoped>

</style>
