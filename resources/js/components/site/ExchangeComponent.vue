<template>
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="img-thumbnail pad height285 " v-if="exchange != null">
                <div class="row justify-content-start">
                    <div class="col-md-12 text-left">
                        <p class="lead d-block"><i class="fa fa-circle t-bd small"></i> سعر صرف الدولار الأمريكي مقابل
                            الدينار العراقي <span class="small text-muted"
                                style="font-size:12px;">({{ exchange.direction }})</span></p>
                    </div>
                    <div class="col-md-6 text-left">
                        <div class="flex-column">
                            <p class="lead "><i class="fa fa-map-marker-alt t-bd"></i> {{ exchange.city.name }}</p>
                            <p class="lead"><i class="fa fa-dollar-sign t-bd"></i> السعر : {{ this.price }} </p>
                            <p class="lead m-2">اليوم : <span>{{ days[date.getDay()] }}</span></p>
                            <p class="lead m-3">التاريخ : <span>{{ (date.getDate() + '-' + date.toLocaleString('ar-AR', {
                                    month: 'long'
                                }))
                            }}</span></p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="flex-column justify-content-center">
                            <div class="d-block">
                                <label>من دولار امريكي</label>
                                <input type="text" v-model="eg" class="form-control ">
                            </div>
                            <div class="d-block">
                                <label>إلى دينار عراقي

                                </label>
                                <input type="text" v-model="sar" class="form-control ">
                            </div>




                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "ExchangeComponent",
    data() {
        return {
            base_storage: base_storage,
            collection_we: null,
            exchange: null,
            days: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
            date: new Date(),
            item: 0,
            from: 1,
            to: 0,
            eg: 0,
            sar: 0,
            price: 1,
        }
    },
    methods: {
        getDataExchange() {
            axios.get('getExchange').then(({ data }) => {
                this.collection_we = data;
                this.exchange = this.collection_we;
                this.from = (this.exchange.val_from);
                this.to = (this.exchange.val_to);
                this.price = this.to / this.from;

            })
        },
        changeCity() {
            //console.log(this.collection_we.length);

        },
    },

    created() {
        this.getDataExchange();

    },
    mounted() {

        //this.changeCity()
    },
    watch: {
        eg: function (v) {
            //  console.log(this.to);
            //alert('ii')
            this.sar = v * this.price;

        },
        sar: function (v) {
            // alert('')
            // console.log(parseFloat(this.exchange.val_to));
            this.eg = v / this.price;
        },
    }

}
</script>

<style scoped>
.img-icon {
    width: 50%;
}

.pad {
    padding: 10px 20px 10px 20px;
    background-color: #f2f2f2;

}

.height-285 {
    height: 285px !important;
}
</style>