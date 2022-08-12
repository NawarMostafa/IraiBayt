<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>أسعار الصرف</span>
                    </h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)" enctype="multipart/form-data">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label :class="{ 'text-danger': form.errors.has('city_id') }">المدينة

                                </label>

                                <br>
                                <label class="d-inline-block m-1 btn btn-secondary" v-bind:key="city.id"
                                    v-for="city in cities">

                                    <input type="checkbox" v-model="form.city_id" :value="city.id">
                                    <span>{{ city.name }}</span>

                                </label>

                                <span v-if="form.errors.has('city_id')" class="text-danger d-block">يرجى تحديد مدينة
                                    واحدة على الأقل</span>
                            </div>
                            <div class="col-md-3">
                                <label>التاريخ</label>
                                <input type="date" v-model="form.day" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('day') }">
                                <has-error :form="form" field="day"></has-error>
                            </div>

                            <div class="col-md-3">
                                <label>جهة الصرافة</label>
                                <input type="text" v-model="form.direction" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('direction') }">
                                <has-error :form="form" field="direction"></has-error>
                            </div>


                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>العملة</label>
                                <select v-model="form.from" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('from') }">
                                    <option value="">إختر عملة</option>
                                    <option v-bind:key="curancy.id" v-for="curancy in curancies" :value="curancy.id">
                                        {{ curancy.name }}
                                    </option>
                                </select>
                                <has-error :form="form" field="from"></has-error>
                            </div>
                            <div class="col-md-3">
                                <label>القيمة</label>
                                <div class="d-flex">
                                    <input type="test" v-model="form.val_from" class="form-control "
                                        :class="{ 'is-invalid': form.errors.has('val_from') }">
                                    <h3> = </h3>
                                </div>
                                <has-error :form="form" field="val_from"></has-error>
                            </div>
                            <div class="col-md-3">
                                <label>العملة</label>
                                <select v-model="form.to" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('to') }">
                                    <option value="">إختر عملة</option>
                                    <option v-bind:key="curancy.id" v-for="curancy in curancies" :value="curancy.id">
                                        {{ curancy.name }}
                                    </option>
                                </select>
                                <has-error :form="form" field="to"></has-error>
                            </div>
                            <div class="col-md-3">
                                <label>القيمة d</label>
                                <input type="text" v-model="form.val_to" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('val_to') }">
                            </div>
                            <has-error :form="form" field="val_to"></has-error>
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
                            <th>ترقيم</th>
                            <th>المدينة</th>
                            <th>التاريخ</th>
                            <th>كل</th>
                            <th>العملة</th>
                            <th>تساوي</th>
                            <th>العملة</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-bind:key="exchange.id" v-for="(exchange, index) in exchanges.data">
                            <td>{{ index + 1 }}</td>
                            <td>{{ exchange.city.name }}</td>
                            <td>{{ exchange.day }}</td>
                            <td>{{ exchange.val_from }}</td>
                            <td>{{ exchange.from.name }}</td>
                            <td>{{ exchange.val_to }}</td>
                            <td>{{ exchange.to.name }}</td>
                            <td>
                                <a :href="base_site + '/dashboard/exchange/' + exchange.id + '/edit'"
                                    class="btn btn-sm btn-info">
                                    <i class="fa fa-edit"></i></a>
                                <button type="button" @click="deleteExchange(exchange.id)"
                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <pagination :data="exchanges" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

export default {
    name: "ExchangeComponent",
    //components:[FormExchangeComponent],
    data() {
        return {
            exchanges: {},
            exchange: '',
            cities: null,
            curancies: null,
            count: 1,
            form: new Form({
                city_id: [],
                direction: '',
                day: '',
                from: '',
                to: '',
                val_from: 1,
                val_to: 1,
            }),
            base_site,
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
                    axios.delete(base_site + '/dashboard/exchange/' + id + '/delete').then(({ data }) => {
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
            axios.get(base_site + '/dashboard/exchange/get').then(res => {
                this.exchanges = res.data;
            })
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/exchange/get').then(res => {
                this.exchanges = res.data;
            })
        },
        save() {

            this.form.post(base_site + '/dashboard/exchange/save').then(({ }) => {

                Toast.fire({
                    icon: 'success',
                    text: "تمت الإضافة بنجاح"
                });
                $('#addCategory').modal('hide');
                this.getAllData();
                Fire.$emit('DeleteCountry');
            });
            this.getAllData()
        },
        getAllCurancy() {
            axios.get(base_site + '/dashboard/currancies/get/active').then(({ data }) => {
                this.curancies = data;
            })
        },
        getAllCity() {
            axios.get(base_site + '/dashboard/cities/get/all').then(({ data }) => {
                this.cities = data;
            })
        },
    },

    mounted() {
        this.getResults()
    },
    created() {
        this.getAllCurancy()
        this.form.day = this.date
        this.getAllCity()
        this.getAllData()
        //this.getFiles()
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