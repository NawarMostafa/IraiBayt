<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>المناطق</span>
                        <abbr title="إضافة منطقة">
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
                            <th>المنطقة</th>
                            <th>المحافظة</th>
                            <th>الدولة</th>

                            <th>التحكم</th>
                        </tr>
                        <tr v-bind:key="region.id" v-for="region in regions.data">
                            <td>{{ region.name }}</td>
                            <td>{{ region.city.name }}</td>
                            <td>{{ region.country.name }}</td>

                            <td>
                                <button @click="showeditDialog(region.id)" type="button" class="btn btn-sm btn-info"><i
                                        class="fa fa-edit"></i></button>
                                <button @click="deleteRegion(region.id)" type="button" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash "></i></button>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <pagination :data="regions" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>


        <!--Dialog -->
        <!-- Modal -->
        <div class="modal fade" id="addRegion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form @submit.prevent="form.id == null ? save() : update()" @keydown="form.onKeydown($event)">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة منطقة</h5>

                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>اسم المنطقة</label>
                                <input type="hidden" v-model="form.id" v-if="form.id != null">
                                <input v-model="form.name" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>الدولة</label>

                                <select v-model="form.country_id" name="country_id" @change="getCityFromCountry"
                                    class="form-control">
                                    <option value="">إختر دولة</option>
                                    <option v-for="country in countries" :value="country.id" v-bind:key="country.id">
                                        {{ country.name }}</option>
                                </select>
                                <has-error :form="form" field="country_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>المحافظة</label>

                                <select v-model="form.city_id" name="city_id" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                    <option value="">إختر المحافظة</option>
                                    <option v-for="city in cities" :value="city.id" v-bind:key="city.id">{{ city.name }}
                                    </option>
                                </select>
                                <has-error :form="form" field="city_id"></has-error>
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
    name: "RegionComponent",
    data() {
        return {
            regions: {},
            cities: null,
            countries: null,

            form: new Form({
                id: null,
                name: '',
                country_id: '',
                city_id: ''
            }),
            q: '',
            relatedPostsCount: 0,
        }
    },
    methods: {
        getAllData() {
            axios.get(base_site + '/dashboard/regions/get?q=' + this.q).then(res => {
                this.regions = res.data;
            });
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/regions/get?page=' + page + '&q=' + this.q)
                .then(response => {
                    this.regions = response.data;
                });
        },
        showAddDialog() {
            this.form.clear();
            this.form.reset();
            $('#addRegion').modal('show');
        },
        save() {
            this.form.post(base_site + '/dashboard/regions/save').then(({ }) => {
                Toast.fire({
                    icon: 'success',
                    text: "تمت الإضافة بنجاح"
                });
                $('#addRegion').modal('hide');
                this.getAllData();
            });
        },
        showeditDialog(id) {
            this.form.clear();
            this.form.reset();
            axios.get(base_site + '/dashboard/regions/' + id + '/get').then(({ data }) => {
                this.form.fill(data);
                this.getCityFromCountry()
            })
            $('#addRegion').modal('show');
        },
        update() {
            this.form.put(base_site + '/dashboard/regions/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: "تم التعديل بنجاح"
                });
                $('#addRegion').modal('hide');
                this.getAllData();
            })
        },
        getAllCountry() {
            axios.get(base_site + '/dashboard/countries/get/all').then(({ data }) => {
                this.countries = data;
            })
        },
        getCityFromCountry() {
            axios.get(base_site + '/dashboard/country/city/' + this.form.country_id + '/all').then(({ data }) => {
                this.cities = data;
            });
        },
        getRelatedPostsCount() {
            axios.get(base_site + '/dashboard/posts/getByRegion/' + this.id).then(res => {
                this.relatedPostsCount = res.data;
            })

        },
        deleteRegion(id) {
            Swal.fire({
                title: 'هل انت متأكد من عملية الحذف ؟',
                text: "في حال موافقتك سيتم حذف المنطقة مع جميع المنشورات المتعلقة بها(عددها " + this.relatedPostsCount + ") و لن تستطيع التراجع عن بعد الحذف",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'تأكيد الحذف!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.value) {
                    axios.delete(base_site + '/dashboard/regions/' + id + '/delete').then(({ data }) => {
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
        Fire.$on('DeleteCountry', () => {
            this.getAllData();
            this.getAllCountry()
        })
    },
    created() {
        this.getAllCountry();
        this.getAllData();
        this.getRelatedPostsCount();
    },
}
</script>

<style scoped>
</style>