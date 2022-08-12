<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span class="d-bloc"> الإحصائيات</span>
                        <span class="d-bloc"><a :href="base_site + '/dashboard/analize/create'"
                                class="btn btn-sm btn-outline-secondary"><i class="fa fa-plus"></i></a></span>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>ترقيم</th>
                            <th>العنوان</th>
                            <th>التحكم</th>
                        </tr>

                        <tr v-bind:key="ana.id" v-for="(ana, index) in ans">
                            <td>{{ index + 1 }}</td>
                            <td>{{ ana.title }}</td>
                            <td>
                                <a :href="base_site + '/dashboard/analize/' + ana.id + '/edit'" class="btn btn-sm btn-info"><i
                                        class="fa fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" @click="deleteAn(ana.id)"><i
                                        class="fa fa-trash"></i></button>
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
    name: "AnalizeComponent",
    data() {
        return {
            ans: {},
            base_site,
        }
    },
    methods: {
        getAllData() {
            axios.get(base_site + '/dashboard/analize/all').then(({ data }) => {
                this.ans = data
            })
        },
        deleteAn(id) {
            Swal.fire({
                title: 'هل انت متأكد من عملية الحذف ؟',
                text: "لن تستطيع التراجع عن بعد الحذف",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'تأكيد الحذف!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.value) {
                    axios.delete(base_site + '/dashboard/analize/' + id + '/delete').then(({ data }) => {
                        Fire.$emit('DeleteCountry');
                        Swal.fire(
                            'حذف!',
                            'تم الحذف بنجاح .',
                            'success'
                        )
                        this.getAllData()
                    });

                }
            })


        },
    },
    created() {
        this.getAllData();
    }
}
</script>

<style scoped>
</style>