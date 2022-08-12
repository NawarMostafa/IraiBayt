<template>
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-3 text-center" v-for="(part, index) in parts" v-bind:key="part.id">
            <div class="img-thumbnail mt-3 bg-wd none-border-radius">
                <a :href="index == 1 ? info : index == 5 ? quizz : index == 6 ? about : index == 0 ? posts : index == 2 ? pricless : index == 7 ? other : index == 4 ? system : index == 3 ? exchange : url_"
                    class="p-2 d-inline-block">
                    <img v-if="part.data.img != null && part.data.img != ''" :src="base_storage + '/images/' + part.data.img"
                        alt="" class="img-64 rounded border-bd p-2 bg-wd img-thumbnail">
                    <p class="small text-dark mt-3 d-block">{{ part.data.name }}</p>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DepartsComponent",
    data() {
        return {
            base_storage,
            base_site,
            parts: null,
            quizz: base_site + '/quizeCat',
            about: base_site + '/aboutIraq',
            posts: base_site + '/posts/view',
            pricless: base_site + '/tips',
            other: base_site + '/anylize',
            system: base_site + '/System',
            info: base_site + '/note/all',
            exchange: base_site + '/exchange',
            url_: base_site + '/depart',
        }
    },
    methods: {
        getAllData() {
            axios.get(base_site + '/departs').then(({ data }) => {
                this.parts = data;
            })
        }
    },
    created() {
        this.getAllData();
    }
}
</script>

<style scoped>
</style>