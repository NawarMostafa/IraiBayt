<template>
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <hr>
            </div>
            <div class="col-md-12 pt-3 text-left">
                <h4><a href="spicial_posts/view" style="color:#000;"><i class="fa fa-star t-orange-red"></i>العروض
                        المميزة</a></h4>
            </div>
            <div class="col-md-12">
                <div class="row mt-5">
                    <div v-bind:key="post.id" v-for="post in posts" class="col-md-3 mb-3">

                        <div class="card img-thumbnail padd  text-left bg-wd" style=" position: relative;height:550px">
                            <a class="d-block text-dark" style="height:40%" :href="base_site + '/post/' + post.id + '/show'">
                                <div class="special-tag text-white"><i class="fa fa-star"></i></div>
                                <div class="category-tag">{{ post.sub.name }}</div>
                                <div class="price-tag">{{ post.price }} {{ post.currancy.name }}</div>
                                <img v-if="post.img != '' && post.img != null" :src="base_storage + '/posts/' + post.img"
                                    class="card-img-top none-border-radius img-fluid"
                                    style="height: 100%;object-fit: cover;" alt="...">
                                <img v-else :src="'https://iraqibayt.com/storage/app/public/posts/' + default_img"
                                    class="card-img-top none-border-radius img-fluid"
                                    style="height: 100%;object-fit: cover;" alt="...">
                            </a>
                            <a class="d-block text-dark" :href="base_site + '/post/' + post.id + '/show'">
                                <div class="card-body pr-0 pl-0">
                                    <h5 class="card-title text-center pr-1 pl-1 mb-2">{{ post.title | subStr(42) }}</h5>
                                    <hr class="w-100 p-0 m-0" style="color:#275879;background:#275879;">
                                    <!--<p class="card-text text-left">{{post.description |subStr(80)}}</p>-->
                                    <span class="text-left d-block mt-1 pr-1 pl-1"><i
                                            class="fa fa-map-marker-alt t-bl"></i> {{ post.city.name }}-
                                        {{ post.region.name }}</span>
                                    <span class="text-left d-block mt-1 pr-1 pl-1"><i class="fa fa-expand t-bl"></i>
                                        مساحة العقار : {{ post.area }} {{ post.unit.name }}</span>
                                    <span class="text-left d-block mt-1 pr-1 pl-1"><i
                                            class="fa fa-plus-square t-bl"></i> أضيف : {{ post.created_at }}</span>

                                    <div v-if="post.sub.type == 'سكني'" class="d-flex justify-content-around mt-2">
                                        <div class="text-center mb-2 mt-2">
                                            <div class="icon-rounded text-center bg-bl pt-1 d-block"><i
                                                    class="fa fa-car text-white"></i></div>
                                            <span class="small d-block"
                                                v-if="post.num_car === '' || post.num_car === ' ' || post.num_car === null">0</span>
                                            <span class="small d-block" v-else>{{ post.num_car }}</span>
                                        </div>
                                        <div class="text-center mb-2 mt-2">
                                            <div class="icon-rounded text-center bg-bl pt-1 d-inline-block"><i
                                                    class="fa fa-bed text-white"></i></div>
                                            <span class="d-block small">{{ post.bedroom }}</span>
                                        </div>
                                        <div class="text-center mb-2 mt-2">
                                            <div class="icon-rounded text-center bg-bl pt-1 d-inline-block"><i
                                                    class="fa fa-bath text-white"></i></div>
                                            <span class="d-block small">{{ post.bathroom }}</span>
                                        </div>
                                    </div>

                                    <div v-if="post.sub.type == 'غير سكني'" class="d-flex justify-content-around mt-2"
                                        style="height:70px;">
                                    </div>

                                </div>
                            </a>
                            <div class="card-footer" style="position: absolute;bottom: 0px;right: 0px;left:0px;">
                                <button class="btn btn-sm phone mt-2 w-75 "><a
                                        :href="'tel:' + post.phone">{{ post.phone }}</a> <i
                                        class="fa fa-phone-alt t-bl"></i></button>
                                <button type="button" class="btn btn-sm btn-danger mt-2  z-fav"
                                    @click="addFav(post.id)"><i class="fa fa-heart"></i></button>
                                <!-- <hr>
                                    <span class="d-block small">أضافه <a :href="base_site+'/posts/'+post.user.id+'/user'" class="">{{post.user.name}}</a></span>
                                    -->
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
    name: "SpecialComponent",
    data() {
        return {
            posts: null,
            base_storage: base_storage,
            base_site,
            default_img: null,
        }
    },
    methods: {
        getSpecialPost() {
            axios.get(base_site + '/getSpecialPost').then(({ data }) => {
                this.posts = data
            })

            axios.get(base_site + '/get_default_img').then(({ data }) => {
                this.default_img = data
            })
        },
        getResults(page = 1) {
            axios.get(base_site + '/getSpecialPost?page=' + page).then(data => {
                this.posts = data.data;
            })
        },
        addFav(id) {
            axios.get(base_site + '/favorit/' + id + '/store')
                .then(function (response) {
                    if (response.status == 200 || response.status == 201) {
                        Toast.fire({
                            icon: 'success',
                            text: 'تمت الإضافة إلى المفضلة'
                        });
                    }
                }).catch(function (error) {
                    if (error.response.status == 500) {
                        Swal.fire({
                            title: 'يجب عليك تسجيل الدخول أولاً',
                            text: "لكي تتمكن من المتابعة",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'تسجيل الدخول',
                            cancelButtonText: 'إلغاء'
                        }).then((result) => {
                            if (result.value) {
                                location.href = base_site + '/login';
                            }
                        });
                    }
                });
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

    mounted() {

    },
    created() {
        this.getSpecialPost()
    }
}
</script>

<style scoped lang="scss">
</style>