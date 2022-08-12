<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="img-thumbnail  p-4">
                    <div class="row">

                        <div class="col-md-12 bg-wd">
                            <div class="row justify-content-start">
                                <div class="col-md-4 mt-1">
                                    <select v-model="numRoom" @change="changesearch"
                                        class="d-inline-block form-control  w-100">
                                        <option value="">عدد الغرف</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>

                                        <option value="5">5</option>
                                        <option value="أكثر من 5">أكثر من 5</option>
                                    </select>
                                    <select v-model="numBath" @change="changesearch"
                                        class="d-inline-block form-control  w-100 mt-2">
                                        <option value="">عدد الحمامات</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>

                                        <option value="أكثر من 3">أكثر من 3</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="select-icon">
                                                <div class="icon bg-trans">
                                                    <i class="fa fa-grip-horizontal "></i>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <select v-model="category" @change="changeCategory"
                                                        class="custom-select  " id="inputGroupSelect01">
                                                        <option selected value="">جميع الأقسام</option>
                                                        <option v-for="category in categories" :value="category.id">
                                                            {{ category.name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <select v-model="subCat" @change="changesearch" class="custom-select  "
                                                    id="inputGroupSelect02">
                                                    <option selected value="">القسم الفرعي</option>
                                                    <option v-for="sub in subs" :value="sub.id">{{ sub.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="select-icon">
                                                <div class="icon bg-trans">
                                                    <i class="fa fa-grip-horizontal "></i>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <select v-model="city" class="custom-select "
                                                        id="inputGroupSelect03" @change="changeCity">
                                                        <option value="">جميع المدن</option>
                                                        <option v-for="city in cities" :value="city.id">{{ city.name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <select v-model="ragion" @change="changesearch" class="custom-select  "
                                                    id="inputGroupSelect04">
                                                    <option selected value="">جميع المناطق</option>
                                                    <option v-for="region in regions" :value="region.id">{{ region.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div v-if="results.length <= 0" class="row"></div>
        <div v-else class="row mt-3">
            <div class="col-md-12 text-left">
                <h4> <i class="fa fa-circle small t-orange"></i>
                    <span>النتائج ({{ count }})
                    </span>
                </h4>
            </div>
            <div v-for="post in results.data" class="col-md-4 ">

                <div class="card img-thumbnail padd  text-left mt-2 bg-wd" style=" position: relative;">

                    <div class="category-tag">{{ post.sub.name }}</div>
                    <div class="price-tag">{{ post.price }} {{ post.currancy.name }}</div>
                    <img :src="base_storage + '/posts/' + post.img" class="card-img-top none-border-radius"
                        style="height: 50%" alt="...">
                    <div class="card-body">
                        <h6 class="card-title text-center small p-0 mb-2"><a
                                :href="base_site + '/post/' + post.id + '/show'">{{ post.title | subStr(35) }}</a></h6>
                        <hr class="w-100 p-0 m-0">
                        <!--<p class="card-text text-left">{{post.description |subStr(80)}}</p>-->
                        <span class="text-left d-block mt-1"><i class="fa fa-map-marker-alt t-bl"></i>
                            {{ post.city.name }}- {{ post.region.name }}</span>
                        <span class="text-left d-block mt-1"><i class="fa fa-expand t-bl"></i> مساحة العقار :
                            {{ post.area }} {{ post.unit.name }}</span>
                        <span class="text-left d-block mt-1"><i class="fa fa-plus-square t-bl"></i> أضيف :
                            {{ post.created_at }}</span>
                        <div class="d-flex justify-content-around mt-2">
                            <div class="text-center mb-2 mt-2">
                                <div class="icon-rounded text-center bg-bl pt-1 d-block"> <i
                                        class="fa fa-car text-white"></i></div><span
                                    class="small d-block">{{ post.num_car }}</span>
                            </div>
                            <div class="text-center mb-2 mt-2">
                                <div class="icon-rounded text-center bg-bl pt-1 d-inline-block"><i
                                        class="fa fa-bed text-white"></i></div><span
                                    class="d-block small">{{ post.bedroom }}</span>
                            </div>
                            <div class="text-center mb-2 mt-2">
                                <div class="icon-rounded text-center bg-bl pt-1 d-inline-block"><i
                                        class="fa fa-bath text-white"></i></div><span
                                    class="d-block small">{{ post.bathroom }}</span>
                            </div>

                        </div>
                        <button class="btn btn-block phone mt-2"><span class="">{{ post.phone }}</span> <i
                                class="fa fa-phone-alt t-bl"></i></button>
                    </div>
                    <div class="card-footer">
                        <pagination :data="results" :limit="1" @pagination-change-page="searchResultpage"></pagination>
                    </div>
                </div>

            </div>

        </div>

    </div>
</template>

<script>
export default {
    name: "ResultComponent",
    data() {
        return {
            city: '',
            count: 0,
            ragion: '',
            category: '',
            subCat: '',
            numRoom: '',
            numBath: '',
            base_site,
            base_storage,
            results: {},
            categories: null,
            subs: '',
            cities: null,
            regions: '',
        }
    },
    filters: {

        subStr: function (string, v) {
            let x = ''
            if (string.length > v) {
                x = '...'
            }
            return string.substring(0, v) + x;
        }

    },
    methods: {
        getCategory() {
            axios.get(base_site + '/getCategories').then(({ data }) => {
                this.categories = data;
            })
        },
        changeCategory() {
            this.categories.forEach((el) => {
                if (el.id == this.category) {
                    this.subs = el.sub_cats
                }
            })

            this.searchResult()
        },
        getCity() {
            axios.get(base_site + '/getCities').then(({ data }) => {
                this.cities = data;
            })
        },
        changeCity() {
            this.cities.forEach((el) => {
                if (el.id == this.city) {
                    this.regions = el.regions
                }
            })

            this.searchResult()
            // this.regions = this.city.regions;
        },
        searchResult() {
            axios.get(base_site + '/posts?city=' + this.city + '&ragion=' + this.ragion + '&category=' + this.category + '&subCat=' + this.subCat + '&numRoom=' + this.numRoom + '&numBath=' + this.numBath).then(res => {
                this.results = res.data;
                this.count = res.data.total;
            })
        },

        searchResultpage(page = 1) {
            axios.get(base_site + '/posts?city=' + this.city + '&ragion=' + this.ragion + '&category=' + this.category + '&subCat=' + this.subCat + '&numRoom=' + this.numRoom + '&numBath=' + this.numBath + '&page=' + page).then(res => {
                this.results = res.data;
            })
        },
        changesearch() {
            this.searchResult()
        }
    },
    props: ['search'],
    created() {

        this.searchResult();

        this.getCategory()
        this.getCity()
    },
    mounted() {
        this.searchResultpage()
    }
}
</script>

<style scoped>
</style>