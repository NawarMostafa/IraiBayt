<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><span>
                        أقسام الموقع
                    </span></div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>اسم القسم</th>
                            <th>الصورة</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="part in parts">
                            <td>{{ part.data.name }}</td>
                            <td>
                                <img class="img-size-64" :src="base_storage + '/images/' + part.data.img" alt="">
                            </td>
                            <td>
                                <a :href="base_site + '/dashboard/departs/' + part.id + '/edit'"
                                    class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DepartComponent",
    data() {
        return {
            base_storage,
            base_site,
            parts: null,
        }
    },
    methods: {
        getAllData() {
            axios.get(base_site + '/dashboard/departs/getAll').then(({ data }) => {
                this.parts = data;
            })
        }
    },
    created() {
        this.getAllData();
    }

}
</script>

<style scoped>
</style>