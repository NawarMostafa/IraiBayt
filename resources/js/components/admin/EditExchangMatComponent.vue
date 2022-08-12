<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>تعديل أسعار المعادن</span>
                    </h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)" enctype="multipart/form-data">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label :class="{ 'text-danger': form.errors.has('city_id') }">المدينة :
                                    {{ city.name }}
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
    </div>
</template>

<script>
export default {
    name: "EditExchangMatComponent",
    data() {
        return {
            materials: null,
            cities: null,
            curancies: null,
            count: 1,
            city: '',
            form: new Form({
                id: '',
                city_id: '',
                day: '',
                material_id: '',
                price: '',
                currancy_id: 1,
            })

        }
    },
    methods: {


        save() {

            this.form.post(base_site + '/dashboard/materialExchange/' + this.form.id + '/update').then(({ }) => {

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
        getDataEx() {
            axios.get(base_site + '/dashboard/matEx/' + this.id + '/get').then(({ data }) => {
                this.form.fill(data);
                this.city = data.city;
            })
        }

    },
    props: ['id'],
    mounted() {

    },
    created() {
        this.getAllCurancy()
        this.getAllMaterial()
        this.getDataEx()
    },

}
</script>

<style scoped>
</style>