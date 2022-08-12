<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>حالة الطقس</span>
                    </h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)">
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
                                <label>بحسب الارصاد</label>
                                <input type="text" v-model="form.direction" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('direction') }">
                                <has-error :form="form" field="direction"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>درجة الحرارة</label>
                                <input type="text" v-model="form.temp" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('temp') }">
                                <has-error :form="form" field="temp"></has-error>
                            </div>
                            <div class="col-md-4">
                                <label>درجة الحرارة العظمى</label>
                                <input type="number" v-model="form.max_temp" class="form-control "
                                    :class="{ 'is-invalid': form.errors.has('max_temp') }">
                                <has-error :form="form" field="max_temp"></has-error>
                            </div>
                            <div class="col-md-4">
                                <label>درجة الحرارة الدنيا</label>
                                <input type="number" v-model="form.min_temp" class="form-control "
                                    :class="{ 'is-invalid': form.errors.has('min_temp') }">
                                <has-error :form="form" field="min_temp"></has-error>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label> سرعة الرياح (كم/سا )</label>

                                <input type="number" v-model="form.wind_speed" class="form-control d-inline-block"
                                    :class="{ 'is-invalid': form.errors.has('wind_speed') }">

                                <has-error :form="form" field="wind_speed"></has-error>

                            </div>

                            <div class="col-md-4">
                                <label>جهة الرياح</label>
                                <input type="text" v-model="form.wind_dir" class="form-control "
                                    :class="{ 'is-invalid': form.errors.has('wind_dir') }">
                                <has-error :form="form" field="wind_dir"></has-error>
                            </div>
                            <div class="col-md-4">
                                <label>الرطوبة (%)</label>
                                <input type="text" v-model="form.hum" class="form-control "
                                    :class="{ 'is-invalid': form.errors.has('hum') }">

                                <has-error :form="form" field="hum"></has-error>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block">إختر صورة للطقس</label>
                            <div v-for="img in images" v-bind:key="img.id" class="d-inline-block img-thumbnail m-2 p-2">
                                <input type="radio" :value="img.name" v-model="form.img">
                                <img :src="img.url" alt="" class="img-64">
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
                    <h3>حالة الطقس</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ترقيم</th>
                            <th>المدينة</th>
                            <th>التاريخ</th>
                            <th>درجة الحرارة</th>
                            <th>الرياح</th>
                            <th>جهة الأرصاد</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="(weather, index) in weathers.data" v-bind:key="weather.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ weather.city.name }}</td>
                            <td>{{ weather.day }}</td>
                            <td>{{ weather.temp }}</td>
                            <td>{{ weather.wind_speed }}</td>
                            <td>{{ weather.direction }}</td>
                            <td>
                                <a :href="base_site + '/dashboard/weathers/' + weather.id + '/edit'"
                                    class="btn btn-sm btn-info"> <i class="fa fa-edit"></i></a>
                                <button type="button" @click="deleteWeather(weather.id)"
                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <pagination :data="weathers" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>


        <!--Dialog -->
        <!-- Modal -->


    </div>
</template>

<script>

export default {
    name: "WeatherComponent",
    //components:[FormExchangeComponent],
    data() {
        return {
            base_site,
            weathers: {},
            cities: null,
            curancies: null,
            count: 1,
            form: new Form({
                city_id: [],
                direction: 'أرصاد العراق',
                day: '',
                temp: 32,
                max_temp: 35,
                min_temp: 30,
                hum: 40,
                wind_speed: '7',
                wind_dir: 'شمال غرب',
                img: '1.svg',


            }),
            base_storage: base_storage,
            images: [],
        }
    },
    props: ['date'],
    methods: {
        getFiles() {
            let myloc = this.base_storage + '/weather/';
            for (let i = 1; i < 25; i++) {
                this.images.push({ name: i + '.svg', url: myloc + i + '.svg' });
            }

        },
        deleteWeather(id) {
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
                    axios.delete(base_site + '/dashboard/weathers/' + id + '/delete').then(({ data }) => {
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
            axios.get(base_site + '/dashboard/weathers/get').then(res => {
                this.weathers = res.data;
            })
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/weathers/get?page=' + page).then(res => {
                this.weathers = res.data;
            })
        },
        save() {

            this.form.post(base_site + '/dashboard/weathers/save').then(({ }) => {

                Toast.fire({
                    icon: 'success',
                    text: "تمت الإضافة بنجاح"
                });
                $('#addCategory').modal('hide');
                this.getAllData();
                Fire.$emit('DeleteCountry');
            });
        },

        getAllCity() {
            axios.get(base_site + '/dashboard/cities/get/all').then(({ data }) => {
                this.cities = data;
                this.form.day = this.date
            })
        },
    },

    mounted() {
        this.getResults()
        Fire.$on('DeleteCountry', () => {
            this.getAllData()
        })
    },
    created() {
        //this.getAllCurancy()

        this.getAllCity()
        this.getAllData()
        this.getFiles()

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