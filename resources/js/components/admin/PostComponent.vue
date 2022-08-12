<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="justify-content-between d-flex">
                        <span>الإعلانات</span>
                        <abbr title="">
                            <a :href="base_site + '/dashboard/posts/create'" class="btn btn-sm btn-outline-secondary"><i
                                    class="fa fa-plus"></i></a>
                        </abbr>

                    </h3>
                </div>

                <div class="card-body table-responsive">
                    <div class="mb-1">
                        <input type="text" v-model="q" @keyup="getAllData" placeholder="بحث" class="form-control-sm">
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>ترقيم</th>
                            <th>اسم الإعلان</th>
                            <th>اسم المعلن</th>
                            <th>اسم القسم</th>
                            <th>المنطقة</th>
                            <th>حالة الإعلان</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-bind:key="post.id" v-for="(post, index) in posts.data" :class="post.active">
                            <td>{{ index + 1 }}</td>
                            <td>{{ post.title }}</td>
                            <td>{{ post.user.name }}</td>
                            <td>{{ post.category.name }}</td>
                            <td>{{ post.region.name }}</td>
                            <td>{{ post.active }}</td>
                            <td>
                                <a :href="base_site + '/dashboard/posts/' + post.id + '/edit'"
                                    class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <abbr :title="post.active == 'pending' ? 'تفعيل' : 'إلغاء التفعيل'">
                                    <button v-html="draw(post.active)" @click="activePost(post.id)" type="button"
                                        class="btn btn-sm btn-outline-secondary">

                                    </button>
                                </abbr>


                                <button @click="deletePost(post.id)" type="button" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash "></i></button>
                            </td>

                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <pagination :data="posts" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>


            </div>

            <!--Dialog -->


        </div>
    </div>
</template>

<script>
//import InputImgComponent from 'InputImgComponent';
export default {
    name: "PostComponent",
    data() {
        return {
            q: '',
            posts: {},
            form: new Form({
                id: null,
                rooms: 0,
                payment: 'كاش',
                tags: [],
                currancy: 'USD',
                unit: 'متر مربع',
                bedroom: 0,
                bathroom: 0,
                title: '',
                description: '',
                area: 0,
                price: 0,
                country_id: '',
                type: 1,
                category_id: '',
                city_id: '',
                region_id: '',
                name: this.user.name,
                phone: '',
                img: [],
            }),
            countries: null,
            categories: null,
            cities: null,
            regions: null,
            base_site: base_site,
        }
    },
    props: ['user'],
    methods: {

        draw(active) {
            if (active == 'pending') {
                return `<i class="fa fa-check"></i>`;
            } else {
                return `<i class="fa fa-ban"></i>`;
            }
        },
        getRegions() {
            axios.get(base_site + '/dashboard/city/region/' + this.form.city_id + '/all').then(({ data }) => {
                this.regions = data;
            })
        },
        getCities() {
            axios.get(base_site + '/dashboard/country/city/' + this.form.country_id + '/all').then(({ data }) => {
                this.cities = data;
            })
        },
        getAllCategory() {
            axios.get(base_site + '/dashboard/categories/get/all').then(({ data }) => {
                this.categories = data;
            })
        },
        getAllCountry() {
            axios.get(base_site + '/dashboard/countries/get/all').then(({ data }) => {
                this.countries = data;
            })
        },
        clickedInput() {
            $('#ImgCat').click();
        },
        changeImg(el) {
            var file = el.target.files[0];
            var reader = new FileReader();
            reader.onloadend = () => {
                this.form.img.push(reader.result);
            }
            reader.readAsDataURL(file);
        },
        trashImg(i) {
            this.form.img.splice(i, 1);
        },
        getAllData() {
            axios.get(base_site + '/dashboard/posts/get?q=' + this.q).then(res => {
                this.posts = res.data;
            });
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/posts/get?page=' + page + '&q=' + this.q).then(res => {
                this.posts = res.data;
            });
        },
        showDialog() {
            this.form.reset()
            this.form.clear()
            $('#addPost').modal('show');
        },
        save() {
            this.form.post(base_site + '/dashboard/posts/save').then(({ data }) => {
                this.form.reset()
                this.form.clear()
                Toast.fire({
                    icon: 'success',
                    text: 'تمت الإضافة بنجاح'
                })
                $('#addPost').modal('hide');
                this.getAllData()

            })
        },
        activePost(id) {
            axios.put(base_site + '/dashboard/post/' + id + '/active').then(({ data }) => {
                this.getResults()
            })
        },
        showeditDialog(id) {
        },
        updatePost() {
        },
        deletePost(id) {
            Swal.fire({
                title: 'هل انت متأكد من عملية الحذف ؟',
                text: "لن تستطيع التراجع عن بعد الحذف",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'تأكيد الحذف!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.value) {
                    axios.delete(base_site + '/dashboard/posts/' + id + '/delete').then(({ data }) => {
                        Fire.$emit('DeleteCountry');
                        Swal.fire(
                            'حذف!',
                            'تم الحذف بنجاح .',
                            'success'
                        )
                        this.getAllData()
                    });

                }
            })


        },
    },
    created() {
        this.getAllData()
        this.getAllCountry()
        this.getAllCategory();

    },
    mounted() {
        this.getResults();

    },

}
</script>

<style scoped>
#ImgCat {
    display: none;
}

.pending {
    background-color: #ffc107;
}
</style>