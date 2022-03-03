<template>
    <div>
        <table class="table table-striped">
        <thead>
            <tr>
            <th>#</th>
            <!-- <th>E-Mail</th> -->
            <th>Firma</th>
            <th>Produkte</th>
            <th>Actionen</th>
            </tr>
        </thead>
        <tbody>
            <template v-for="company in companies" :key="company.id">
                    <company-table-row :company="company"></company-table-row>
            </template>
        </tbody>
        </table>
    </div> 
</template>

<script>
import  CompanyTableRow  from './CompanyTableRow.vue'

export default {
    name: 'CompanyTableView',
    props: {
        companies: {
            type: Array,
            required: true,
            default: () => [],
        },

    },
    components: {
        CompanyTableRow,
    },
}
</script>
<style>

</style>
