<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>الدول</span>
                        <abbr title="إضافة دولة">
                            <button @click="showAddDialog" type="button" class="btn btn-sm btn-outline-secondary"><i
                                    class="fa fa-plus"></i></button>
                        </abbr>
                    </h4>
                </div>
                <div class="card-body table-responsive">
                    <input type="text" class="form-control-sm d-inline-block mb-1" placeholder="بحث" v-model="q"
                        @keyup="getAllData">
                    <table class="table table-bordered">
                        <tr>
                            <th>الدولة</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="country in countries.data">
                            <td>{{ country.name }}</td>
                            <td>
                                <button @click="showeditDialog(country.id)" type="button" class="btn btn-sm btn-info"><i
                                        class="fa fa-edit"></i></button>
                                <button @click="deleteCountry(country.id)" type="button"
                                    class="btn btn-sm btn-danger"><i class="fa fa-trash "></i></button>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <pagination :data="countries" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>


        <!--Dialog -->
        <!-- Modal -->
        <div class="modal fade" id="addCountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form @submit.prevent="form.id == null ? save() : update()" @keydown="form.onKeydown($event)">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة دولة</h5>

                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>اسم الدولة</label>
                                <input type="hidden" v-model="form.id" v-if="form.id != null">
                                <input v-model="form.name" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                            <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name: "CountryComponent",
    data() {
        return {
            countries: {},
            form: new Form({
                id: null,
                name: '',
            }),
            q: '',
        }
    },
    methods: {
        getAllData() {
            axios.get(base_site + '/dashboard/countries/get?q=' + this.q).then(res => {
                this.countries = res.data;
            });
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/countries/get?page=' + page + '&q=' + this.q)
                .then(response => {
                    this.countries = response.data;
                });
        },

        showAddDialog() {
            this.form.clear();
            this.form.reset();
            $('#addCountry').modal('show');
        },
        save() {
            this.form.post(base_site + '/dashboard/countries/save').then(({ }) => {
                Toast.fire({
                    icon: 'success',
                    text: "تمت الإضافة بنجاح"
                });
                $('#addCountry').modal('hide');
                this.getAllData();
                Fire.$emit('DeleteCountry');
            });
        },
        showeditDialog(id) {
            this.form.clear();
            this.form.reset();
            axios.get(base_site + '/dashboard/countries/' + id + '/get').then(({ data }) => {
                this.form.fill(data);
            })
            $('#addCountry').modal('show');
        },
        update() {
            this.form.put(base_site + '/dashboard/countries/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: "تم التعديل بنجاح"
                });
                $('#addCountry').modal('hide');
                Fire.$emit('DeleteCountry');
                this.getAllData();
            })
        },
        deleteCountry(id) {
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
                    axios.delete(base_site + '/dashboard/countries/' + id + '/delete').then(({ data }) => {
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
    mounted() {
        this.getResults()
    },
    created() {
        this.getAllData();
    },
}
</script>

<style scoped>
</style>