<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>تعديل الطقس</span>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label :class="{ 'text-danger': form.errors.has('city_id') }">المدينة

                                </label>

                                <br>
                                <label class="d-inline-block m-1 btn btn-secondary">

                                    <input type="radio" v-model="form.city_id" :value="city.id">
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
                                <input type="radio" :value="img.name" v-model="form.icon">
                                <img :src="img.url" alt="" class="img-64">
                            </div>

                        </div>

                        <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "WeatherEditComponent",
    data() {
        return {
            city: null,
            form: new Form({
                id: '',
                city_id: '',
                direction: '',
                day: '',
                temp: '',
                max_temp: '',
                min_temp: '',
                hum: '',
                wind_speed: '',
                wind_dir: '',
                icon: '1.svg',
            }),
            images: [],
            base_storage,
            cities: null,
        }
    },
    props: ['id'],
    methods: {
        getWeather() {
            axios.get(base_site + '/dashboard/weathers/' + this.id + '/getWeather').then(({ data }) => {
                this.form.fill(data);
                this.city = data.city
                this.getFiles()
            })
        },
        getFiles() {
            let myloc = this.base_storage + '/weather/';
            for (let i = 1; i < 25; i++) {
                this.images.push({ name: i + '.svg', url: myloc + i + '.svg' });
            }

        },
        save() {
            this.form.put(base_site + '/dashboard/weathers/' + this.form.id + '/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم التعديل بنجاح'
                }).then(function () {
                    location.href = base_site + '/dashboard/weather';
                })
            })
        }
    },
    created() {
        this.getWeather()
    }
}
</script>

<style scoped>
</style>