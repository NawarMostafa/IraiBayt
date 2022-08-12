<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>المحافظات</span>
                        <abbr title="إضافة محافظة">
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
                            <th></th>
                            <th>المحافظة</th>
                            <th>الدولة</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="(city, index) in cities.data" :key="city.id">
                            <td>{{ index + 1 }}</td>
                            <td><a href='dashboard/(city.id)/region'>{{ city.name }} </a></td>
                            <td>{{ city.country.name }}</td>

                            <td>
                                <button @click="showeditDialog(city.id)" type="button" class="btn btn-sm btn-info"><i
                                        class="fa fa-edit"></i></button>
                                <button @click="deleteCity(city.id)" type="button" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash "></i></button>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <pagination :data="cities" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>


        <!--Dialog -->
        <!-- Modal -->
        <div class="modal fade" id="addCity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form @submit.prevent="form.id == null ? save() : update()" @keydown="form.onKeydown($event)">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة محافظة</h5>

                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>اسم المحافظة</label>
                                <input type="hidden" v-model="form.id" v-if="form.id != null">
                                <input v-model="form.name" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>ترتيب الظهور</label>
                                <input v-model="form.sort" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('sort') }">
                                <has-error :form="form" field="sort"></has-error>
                            </div>
                            <div class="form-group">
                                <label>الدولة</label>

                                <select v-model="form.country_id" name="country_id" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('country_id') }">
                                    <option value="">إختر دولة</option>
                                    <option v-for="country in countries" :key="country.id" :value="country.id">
                                        {{ country.name }}</option>
                                </select>
                                <has-error :form="form" field="country_id"></has-error>
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
    name: "CityComponent",
    data() {
        return {
            cities: {},
            countries: null,
            form: new Form({
                id: null,
                name: '',
                sort: '',
                country_id: ''
            }),
            q: '',
            countt: 0,
        }
    },

    methods: {
        getAllData() {
            axios.get(base_site + '/dashboard/cities/get?q=' + this.q).then(res => {
                this.cities = res.data;
            });
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/cities/get?page=' + page + '&q=' + this.q)
                .then(response => {
                    this.cities = response.data;
                });
        },
        showAddDialog() {
            this.form.clear();
            this.form.reset();
            $('#addCity').modal('show');
        },
        save() {
            this.form.post(base_site + '/dashboard/cities/save').then(({ }) => {
                Toast.fire({
                    icon: 'success',
                    text: "تمت الإضافة بنجاح"
                });
                $('#addCity').modal('hide');
                this.getAllData();
            });
        },
        showeditDialog(id) {
            this.form.clear();
            this.form.reset();
            axios.get(base_site + '/dashboard/cities/' + id + '/get').then(({ data }) => {
                this.form.fill(data);
            })
            $('#addCity').modal('show');
        },
        update() {
            this.form.put(base_site + '/dashboard/cities/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: "تم التعديل بنجاح"
                });
                $('#addCity').modal('hide');
                this.getAllData();
            })
        },
        getAllCountry() {
            axios.get(base_site + '/dashboard/countries/get/all').then(({ data }) => {
                this.countries = data;
            })
        },
        deleteCity(id) {
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
                    axios.delete(base_site + '/dashboard/cities/' + id + '/delete').then(({ data }) => {
                        Swal.fire(
                            'حذف!',
                            'تم الحذف بنجاح .',
                            'success'
                        )
                        Fire.$emit('DeleteCountry');
                        this.getAllData()
                    });

                }
            })


        },
    },
    mounted() {
        this.getResults()
        Fire.$on('DeleteCountry', () => {
            this.getAllData();
            this.getAllCountry()
        })
    },
    created() {
        this.getAllCountry();
        this.getAllData();
    },
}
</script>

<style scoped>
</style>