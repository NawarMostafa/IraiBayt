<template>
    <div class="row">
        <div class="col-md-12 text-left">
            <h3 class="mt-2 mb-2"><i class="fa fa-circle t-orange small"></i> <span>معلومات عامة عن العراق</span></h3>
        </div>
        <div class="col-md-4">
            <ul class="img-thumbnail bg-wd list-unstyled text-left p-2 mt-2">
                <li class="mt-2" v-for="(about, index) in abouts"><a :href="'#about' + index">{{ index + 1 }}-
                        {{ about.title }}</a></li>

            </ul>
        </div>
        <div class="col-md-8 text-left">
            <div class="img-thumbnail border-bd p-3 mt-2" v-for="(about, index) in abouts" :id="'about' + index">
                <h4 class="t-orange">{{ about.title }}</h4>
                <p v-html="about.body"></p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AboutIraqComponent",
    data() {
        return {
            abouts: null,
        }
    },
    methods: {
        getAllData() {
            axios.get(base_site + '/getAbouts').then(({ data }) => {
                this.abouts = data;
            })
        }
    },
    created() {
        this.getAllData()
    }
}
</script>

<style scoped>
</style>