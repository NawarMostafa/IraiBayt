<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>تعديل أسعار الصرف</span>
                    </h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)" enctype="multipart/form-data">

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
                                    <option v-for="curancy in curancies" :value="curancy.id">{{ curancy.name }}
                                    </option>
                                </select>
                                <has-error :form="form" field="from"></has-error>
                            </div>
                            <div class="col-md-3">
                                <label>القيمة</label>
                                <div class="d-flex">
                                    <input step="0.1" type="number" v-model="form.val_from" class="form-control "
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
                                    <option v-for="curancy in curancies" :value="curancy.id">{{ curancy.name }}
                                    </option>
                                </select>
                                <has-error :form="form" field="to"></has-error>
                            </div>
                            <div class="col-md-3">
                                <label>القيمة</label>
                                <input step="0.1" type="number" v-model="form.val_to" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('val_to') }">
                            </div>
                            <has-error :form="form" field="val_to"></has-error>
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
    name: "ExchangeComponent",
    //components:[FormExchangeComponent],
    data() {
        return {
            curancies: null,
            city: '',
            form: new Form({
                id: '',
                city_id: '',
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
    props: ['id'],
    methods: {
        getExchange() {
            axios.get(base_site + '/dashboard/exchange/' + this.id + '/getExchange').then(({ data }) => {
                this.form.fill(data);
                this.city = data.city;
                this.getAllCurancy()
            })
        },

        save() {

            this.form.put(base_site + '/dashboard/exchange/' + this.form.id + '/update').then(({ }) => {

                Toast.fire({
                    icon: 'success',
                    text: "تمت الإضافة بنجاح"
                });
                $('#addCategory').modal('hide');

                Fire.$emit('DeleteCountry');
            });
        },
        getAllCurancy() {
            axios.get(base_site + '/dashboard/currancies/get/all').then(({ data }) => {
                this.curancies = data;
            })
        },

    },

    mounted() {

    },
    created() {
        //


        this.getExchange()
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