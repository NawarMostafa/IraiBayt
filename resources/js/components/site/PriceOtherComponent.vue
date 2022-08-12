<template>

    <div class="col-md-12 text-left">
        <div class="form-group m-2 ">
            <label>إختر المدينة </label>
            <select v-model="city" class="form-control-sm ">
                <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
            </select>
        </div>
        <div class=" p-5 bg-wd d-flex justify-content-center">
            <div class="img-thumbnail w-75">
                <h4>أسعار بعض المواد في مدينة {{ name }}</h4>
                <table class="table table-bordered w-100">
                    <tr class="bg-bl">
                        <td class="bg-bl">المادة</td>
                        <td class="bg-bl">السعر</td>
                        <td class="bg-bl">التاريخ</td>
                    </tr>
                    <tr v-for="mat in materials">
                        <td>{{ mat.material.name }}</td>
                        <td>{{ mat.price }} - {{ mat.currancy.name }}</td>
                        <td>{{ mat.day }}</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

</template>

<script>
export default {
    name: "PriceLessComponent",
    data() {
        return {
            city: '',
            cities: null,
            materials: null,
            name: ''
        }
    },
    methods: {
        getAllCity() {
            axios.get(base_site + '/getCities').then(({ data }) => {
                this.cities = data;
                this.city = data[0].id
                this.getAllData(this.city);
            })
        },
        getAllData(v) {
            axios.get(base_site + '/priceOther/get/' + v + '/city').then(({ data }) => {
                this.materials = data;
            })
        }
    },
    created() {
        this.getAllCity()
    },
    watch: {
        city: function (v) {
            this.cities.forEach((el) => {
                if (el.id == v) {
                    this.name = el.name
                }
            })
            this.getAllData(v)
        }
    }

}
</script>

<style scoped>
</style>