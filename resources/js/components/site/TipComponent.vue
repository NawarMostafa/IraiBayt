<template>
    <div class="col-md-12 row">
        <div class="col-md-12 text-left">
            <h3 class="mt-2 mb-2"><i class="fa fa-circle t-orange small"></i> <span>نصائح</span></h3>
        </div>

        <div class="col-md-4">
            <ul class="img-thumbnail bg-wd list-unstyled text-left p-2 mt-2">
                <li class="mt-2" v-for="(about, index) in abouts"><button @click="changeSystem(about)"
                        class="bg-transparent border-none">{{ index + 1 }}- {{ about.name }}</button></li>

            </ul>
        </div>
        <div class="col-md-8 text-left" v-if="tt">
            <div class="img-thumbnail border-bd mt-2 p-3">
                <h4 class="t-orange">{{ system.name }}</h4>
                <p v-html="system.description" class="mt-3 mb-3"></p>

                <iframe v-if="system.url != '' && system.url != null" class="w-100" style="height: 1000px"
                    :src="base_storage.trimRight('public') + system.url"></iframe>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TipComponent",
    data() {
        return {
            abouts: null,
            system: null,
            tt: false,
            base_storage,
        }
    },
    methods: {
        changeSystem(i) {
            this.system = i;
            this.tt = true
        },
        getAllData() {
            axios.get(base_site + '/getTip').then(({ data }) => {
                this.abouts = data;
            })
        },

    },
    created() {
        this.getAllData()
    }
}

</script>

<style scoped>
</style>