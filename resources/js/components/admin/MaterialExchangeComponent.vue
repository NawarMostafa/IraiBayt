<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>أسعار المعادن</span>

                    </h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)" enctype="multipart/form-data">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label :class="{ 'text-danger': form.errors.has('city_id') }">المدينة

                                </label>

                                <br>
                                <label class="d-inline-block m-1 btn btn-secondary" v-for="city in cities">

                                    <input type="checkbox" v-model="form.city_id" :value="city.id">
                                    <span>{{ city.name }}</span>

                                </label>

                                <span v-if="form.errors.has('city_id')" class="text-danger d-block">يرجى تحديد مدينة
                                    واحدة على الأقل</span>
                            </div>
                            <div class="col-md-6">
                                <label>التاريخ</label>
                                <input type="date" v-model="form.day" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('day') }">
                            </div>
                            <has-error :form="form" field="day"></has-error>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>المعدن</label>
                                <select v-model="form.material_id" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('material_id') }">
                                    <option value="">إختر معدن</option>
                                    <option v-for="material in materials" :value="material.id">{{ material.name }}
                                    </option>
                                </select>
                                <has-error :form="form" field="material_id"></has-error>
                            </div>
                            <div class="col-md-4">
                                <label>السعر</label>
                                <input type="number" v-model="form.price" class="form-control "
                                    :class="{ 'is-invalid': form.errors.has('price') }">
                                <has-error :form="form" field="price"></has-error>
                            </div>
                            <div class="col-md-4">
                                <label>العملة</label>
                                <select v-model="form.currancy_id" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('currancy_id') }">
                                    <option value="">إختر عملة</option>
                                    <option v-for="curancy in curancies" :value="curancy.id">{{ curancy.name }}
                                    </option>
                                </select>
                                <has-error :form="form" field="currancy_id"></has-error>
                            </div>

                        </div>


                        <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>


                    </form>
                </div>


            </div>
        </div>
        <div class="col-md-10" mt-2>
            <div class="card">
                <div class="card-header">
                    <h3>الأسعار</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>المدينة</th>
                            <th>التاريخ</th>
                            <th>المعدن</th>
                            <th>السعر</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="ex in exchange.data">
                            <td>{{ ex.city.name }}</td>
                            <td>{{ ex.day }}</td>
                            <td>{{ ex.material.name }}</td>
                            <td>{{ ex.price }} {{ ex.currancy.name }}</td>
                            <td>
                                <a :href="base_site + '/dashboard/matEx/' + ex.id + '/edit'"
                                    class="btn btn-sm btn-info"> <i class="fa fa-edit"></i></a>
                                <button type="button" @click="deleteExchange(ex.id)" class="btn btn-danger btn-sm"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <pagination :data="exchange" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>


    </div>
</template>

<script>

export default {
    name: "MaterialComponent",
    //components:[FormExchangeComponent],
    data() {
        return {
            exchange: {},
            materials: null,
            cities: null,
            curancies: null,
            base_site,
            count: 1,
            form: new Form({
                city_id: [],
                day: '',
                material_id: '',
                price: '',
                currancy_id: 1,
            })

        }
    },
    methods: {
        deleteExchange(id) {
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
                    axios.delete(base_site + '/dashboard/MatEx/' + id + '/delete').then(({ data }) => {
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
        getAllData() {
            axios.get(base_site + '/dashboard/materialExchange/get').then(res => {
                this.exchange = res.data;
            })
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/materialExchange/get?page=' + page).then(res => {
                this.exchange = res.data;
            })
        },
        save() {

            this.form.post(base_site + '/dashboard/materialExchange/save').then(({ }) => {

                Toast.fire({
                    icon: 'success',
                    text: "تمت الإضافة بنجاح"
                });
                $('#addCategory').modal('hide');
                this.getAllData();
                Fire.$emit('DeleteCountry');
            });
        },
        getAllCurancy() {
            axios.get(base_site + '/dashboard/currancies/get/all').then(({ data }) => {
                this.curancies = data;
            })
        },
        getAllMaterial() {
            axios.get(base_site + '/dashboard/materials/get/all').then(({ data }) => {
                this.materials = data;
            })
        },
        getAllCity() {
            axios.get(base_site + '/dashboard/cities/get/all').then(({ data }) => {
                this.cities = data;
            })
        },
    },
    props: ['date'],
    mounted() {
        this.getResults()
    },
    created() {
        this.getAllCurancy()
        this.form.day = this.date
        this.getAllCity()
        this.getAllData()
        this.getAllMaterial()
    },
}
</script>

<style scoped>
/*#img-preview{*/
/*position: relative;*/
/*}*/
/*#img-preview>#BtnTrash{*/
/*position: absolute;*/
/*right: 10px;*/
/*bottom: 5px;*/
/*}*/
</style>