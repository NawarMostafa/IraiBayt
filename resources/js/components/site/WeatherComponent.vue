<template>
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="img-thumbnail pad height285 " v-if="weather != null">
                <div class="row justify-content-start">
                    <div class="col-md-6 text-left">
                        <div class="form-group">
                            <label>إختر المدينة</label>
                            <select class="form-control-sm" v-model="city_id">
                                <option value="111">جميع المدن</option>
                                <option v-for="(c, index) in collection_we" v-bind:key="c.id" :value="index">
                                    {{ collection_we[index].city.name }}</option>
                            </select>
                        </div>
                        <div class="flex-column">
                            <p class="lead w-fade"><i class="fa fa-circle t-bd small"></i> حالة الطقس <span
                                    class="small text-muted" style="font-size:12px;">({{ weather.direction }})</span>
                            </p>

                            <p class="lead mt-1 w-fade"><i class="fa fa-map-marker-alt t-bd"></i> {{ weather.city.name
                            }}
                            </p>
                            <p class="lead mt-1 w-fade">اليوم : <span>{{ days[date.getDay()] }}</span></p>
                            <p class="lead mt-1 w-fade">التاريخ :
                                <span>{{ (date.getDate() + '-' + date.toLocaleString('ar-AR', { month: 'long' }))
                                }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="flex-column">
                            <p class="w-fade"><img class="img-icon w-50"
                                    :src="base_storage + '/weather/' + weather.icon" alt=""></p>
                            <p class="m-0 p-0 t-bd w-fade ">
                                <span style="margin-left: 25px;" class="d-inline-block f-s-25 tg w-fade"><i
                                        class="fa fa-temperature-low t-bd"></i> الدنيا </span>
                                <span class="d-inline-block f-s-25 tg w-fade"><i
                                        class="fa fa-temperature-high t-bd"></i> العليا </span>
                            </p>
                            <p class="m-0 p-0 t-bd w-fade ">
                                <span v-if="weather.min_temp.trim() != ''" style="margin-left: 50px;"
                                    class="d-inline-block f-s-25 tg w-fade"><i class="t-bd"></i> {{ weather.min_temp }}
                                    C</span>
                                <span v-if="weather.max_temp.trim() != ''" class="d-inline-block f-s-25 tg w-fade"><i
                                        class="t-bd"></i> {{ weather.max_temp }} C</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <span v-if="weather.hum.trim() != ''" class="d-inline-block f-s-15 tg w-fade"><i
                                    class="fa fa-tint t-bd"></i> {{ weather.hum }} %</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "WeatherComponent",
    data() {
        return {
            base_storage: base_storage,
            collection_we: null,
            weather: null,
            days: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
            date: new Date(),
            item: 0,
            city_id: '',
            cities: null,
            inter: '',
            break: 0,
        }

    },
    methods: {
        getAllCity() {
            axios.get(base_site + '/getCities').then(({ data }) => {
                this.cities = data;
            })
        },
        getDataWeather(v) {
            axios.get('getWeather/' + v).then(({ data }) => {
                this.collection_we = Object.values(data);
                this.weather = this.collection_we[0];

            })
        },
        changeCity() {
            this.inter = setInterval(() => {

                if (this.break == 0) {
                    if (this.item < this.collection_we.length - 1) {
                        $('.w-fade').fadeOut(2000, () => {
                            this.weather = this.collection_we[this.item];
                        }).fadeIn(2000);
                        this.item++;
                        console.log(this.item);

                    } else {
                        this.item = 0;
                        console.log(this.item);
                        $('.w-fade').fadeOut(2000, () => {
                            this.weather = this.collection_we[this.item];
                        }).fadeIn(2000);
                    }

                }

            }, 6000)
        },
    },
    watch: {
        city_id: function (v) {
            if (v != '111') {
                this.break = 1;
                this.weather = this.collection_we[v];
            } else {
                this.break = 0;
                this.item = 0;
                clearInterval(this.inter);
                this.weather = this.collection_we[this.item];
                this.changeCity()
            }
        }
    },

    created() {
        this.getDataWeather('');
        this.getAllCity();
        this.weather = this.collection_we[this.item];
        this.changeCity()

    },
    mounted() {
    },


}
</script>

<style scoped>
.img-icon {
    width: 50%;
}

.pad {
    padding: 5px 10px 5px 10px;
    background-color: #f2f2f2;

}

.height-285 {
    height: 285px !important;
}
</style>