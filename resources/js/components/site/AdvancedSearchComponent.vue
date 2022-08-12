<template>
    <div class="col-md-12 s_main">
        <form :action="base_site + '/posts_adv'" method="get">
            <div class="img-thumbnail bg-wd  p-3 mb-5">

                <div class="col-md-12 pt-2 text-left">
                    <h4> محرك بحث العقارات </h4>
                </div>


                <div class="row justify-content-start">

                    <div class="col-md-3 mt-2">
                        <div class="select-icon">
                            <div class="icon bg-trans">
                                <i class="fa fa-grip-horizontal "></i>
                            </div>
                            <div class="input-group mb-3">
                                <select v-model="category" name="category" class="custom-select  border-none"
                                    id="inputGroupSelect01">
                                    <option selected value="">جميع الأقسام</option>
                                    <option v-bind:key="category.id" v-for="category in categories"
                                        :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-2">
                        <div class="dd">
                            <div class="dd-a">
                                <span>القسم الفرعي</span>
                            </div>
                            <input type="checkbox">
                            <div class="dd-c" style="text-align: right;">
                                <ul>
                                    <li>
                                        <input type='checkbox' @click="subCatsToggleSelect" :checked='selectAllSs'>
                                        <label>جميع الأقسام الفرعية</label>
                                    </li>
                                    <li v-for="sub in subs" v-bind:key="sub.id">
                                        <input type="checkbox" name="subCats[]" v-model='sub.checked' :id="sub.id"
                                            :value="sub.id" number>
                                        <label :for="sub.id">{{ sub.name }}</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 mt-2">
                        <div class="select-icon">
                            <div class="icon bg-trans">
                                <i class="fa fa-grip-horizontal "></i>
                            </div>
                            <div class="input-group mb-3">
                                <select v-model="city" name="city" class="custom-select  border-none"
                                    id="inputGroupSelect03">
                                    <option selected value="">جميع المدن</option>
                                    <option v-bind:key="city.id" v-for="city in cities" :value="city.id">{{ city.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 mt-2">
                        <div class="dd">
                            <div class="dd-a">
                                <span>جميع المناطق</span>
                            </div>
                            <input type="checkbox">
                            <div class="dd-c" style="text-align: right;">
                                <ul>
                                    <li>
                                        <input type='checkbox' @click="regionsToggleSelect" :checked='selectAllRs'>
                                        <label>جميع المناطق</label>
                                    </li>
                                    <li v-for="region in regions" v-bind:key="region.id">
                                        <input type="checkbox" name="regions[]" v-model="region.checked" :id="region.id"
                                            :value="region.id" number>
                                        <label :for="region.id">{{ region.name }}</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1 mt-2">
                        <button class="btn btn-sm btn-block btn-primary text-white" type="submit"
                            style="height: 37px; background:#65aeca;">بحث</button>
                    </div>

                </div>

                <div class="row justify-content-start">

                    <div class="col-md-8 text-left">
                    </div>

                    <div class="col-md-4 text-left">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="background:#65aeca;">
                                ترتيب حسب
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" name="sortBy" value="1" type="submit">(تاريخ النشر) من
                                    الأحدث إلى الأقدم</button>
                                <button class="dropdown-item" name="sortBy" value="2" type="submit">(تاريخ النشر) من
                                    الأقدم إلى الأحدث</button>
                                <button class="dropdown-item" name="sortBy" value="3" type="submit">(عدد غرف النوم) من
                                    الأكثر إلى الأقل عدداً</button>
                                <button class="dropdown-item" name="sortBy" value="4" type="submit">(عدد غرف النوم) من
                                    الأقل إلى الأكثر عدداً</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </form>

    </div>


</template>

<script>
export default {
    name: "AdvancedSearchComponent",
    data() {
        return {
            base_site,
            categories: null,
            category: '',
            subs: [],
            subCats: [],
            subCat: '',
            cities: null,
            city: '',
            regions: [],
            region: '',
            cat: '',
            cit: '',
            sortBy: '',
        }
    },
    computed: {
        selectAllRs: function () {
            return this.regions.every(function (region) {
                return region.checked;
            });
        },
        selectAllSs: function () {
            return this.subs.every(function (sub) {
                return sub.checked;
            });
        },
    },
    methods: {
        regionsToggleSelect: function () {
            var select = this.selectAllRs;
            this.regions.forEach(function (region) {

                region.checked = !select;

            });
            this.selectAllRs = !select;
        },
        subCatsToggleSelect: function () {
            var select = this.selectAllSs;
            this.subs.forEach(function (sub) {

                sub.checked = !select;

            });
            this.selectAllSs = !select;
        },
        getCategory() {
            axios.get(base_site + '/getCategories').then(({ data }) => {
                this.categories = data;
            })
        },
        changeCategory() {
            this.subs = this.category.sub_cats;
        },
        getCity() {
            axios.get(base_site + '/getCities').then(({ data }) => {
                this.cities = data;
            })
        },
        changeCity() {
            this.regions = this.city.regions;
        },

    },
    created() {
        this.getCategory()
        this.getCity()
    },
    watch: {
        category: function (v) {
            this.cat = v;
            this.changeCategory()
            this.categories.forEach((el) => {
                if (el.id == v) {
                    this.subs = el.sub_cats;
                }

            })
        },
        city: function (v) {
            this.cit = v;
            this.changeCity()
            this.cities.forEach((el) => {
                if (el.id == v) {
                    this.regions = el.regions;
                }
            })
        }
    },
}

</script>

<style scoped>
label {
    margin-right: 8px;
}


/* Dropdown menu css style */


.dd {
    z-index: 1;
    position: relative;
    display: inline-block;
    width: 100%;
}

.dd-a {
    padding: 5px 5px 5px 5px;
    background: white;
    position: relative;
    -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.0);
    -moz-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.0);
    box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.0);
    transition-duration: 0.2s;
    -webkit-transition-duration: 0.2s;
    border-radius: 5px;
    text-align: right;
}

.dd-a>span {
    margin-right: 15px;
}

.dd>input:after {
    content: "";
    width: 100%;
    height: 2px;
    position: absolute;
    display: block;
    background: #C63D0F;
    bottom: 0;
    right: 0;
    transform: scaleX(0);
    transform-origin: bottom left;
    transition-duration: 0.2s;
    -webkit-transform: scaleX(0);
    -webkit-transform-origin: bottom left;
    -webkit-transition-duration: 0.2s;
}

.dd>input {
    top: 0;
    opacity: 0;
    display: block;
    padding: 0;
    margin: 0;
    border: 0;
    position: absolute;
    height: 100%;
    width: 100%;
}

.dd>input:hover {
    cursor: pointer;
}

.dd>input:hover~.dd-a {
    -webkit-box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.2);
    box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.2);
}

.dd>input:checked:after {
    transform: scaleX(1);
    -webkit-transform: scaleX(1);
}

.dd>input:checked~.dd-c {
    transform: scaleY(1);
    -webkit-transform: scaleY(1);
}

.dd-c {
    display: block;
    position: absolute;
    background: white;
    height: auto;
    width: 100%;
    transform: scaleY(0);
    transform-origin: top left;
    transition-duration: 0.2s;
    -webkit-transform: scaleY(0);
    -webkit-transform-origin: top left;
    -webkit-transition-duration: 0.2s;
}

.dd-c ul {
    margin: 0;
    padding: 0;
    list-style-type: none;
}

.dd-c li {
    margin-bottom: 5px;
    margin-right: 25px;
    word-break: keep-all;
    white-space: nowrap;
    display: block;
    position: relative;
    align-items: right;
}

.dd-c>ul>li>input {
    padding-right: 10px;
}

#dropdownMenu2 {
    width: 100%;
    text-align: right;
}
</style>