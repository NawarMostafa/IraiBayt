<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="justify-content-between d-flex">
                        <span> الإعلانات التي أضافها هذا المستخدم</span>
                    </h3>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>ترقيم</th>
                            <th>اسم الإعلان</th>
                            <th>اسم القسم</th>
                            <th>المنطقة</th>
                            <th>حالة الإعلان</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-bind:key="post.id" v-for="(post, index) in posts.data" :class="post.active">
                            <td>{{ index + 1 }}</td>
                            <td>{{ post.title }}</td>
                            <td>{{ post.category.name }}</td>
                            <td>{{ post.region.name }}</td>
                            <td>{{ post.active }}</td>
                            <td>
                                <a :href="base_site + '/dashboard/posts/' + post.id + '/edit'" class="btn btn-sm btn-info"><i
                                        class="fa fa-edit"></i></a>
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
    name: "UserPostsComponent",
    data() {
        return {
            posts: {},
            form: new Form({
                id: null,
                title: '',
            }),
            base_site: base_site,
        }
    },
    props: ['id'],
    methods: {
        draw(active) {
            if (active == 'pending') {
                return `<i class="fa fa-check"></i>`;
            } else {
                return `<i class="fa fa-ban"></i>`;
            }
        },
        clickedInput() {
            $('#ImgCat').click();
        },
        changeImg(el) {
            var file = el.target.files[0];
            var reader = new FileReader();
            reader.onloadend = () => {
                //console.log('RESULT', reader.result)
                this.form.img.push(reader.result);
            }
            reader.readAsDataURL(file);
        },
        trashImg(i) {
            this.form.img.splice(i, 1);
        },
        getAllData() {
            axios.get(base_site + '/dashboard/posts/getByUserId/' + this.id).then(res => {
                this.posts = res.data;
                //console.log(res.data.data)
            });
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/posts/getByUserId/' + this.id + '?page=' + page).then(res => {
                this.posts = res.data;
            });
        },
        showDialog() {
            this.form.reset()
            this.form.clear()
            $('#addPost').modal('show');
        },
        activePost(id) {
            axios.put(base_site + '/dashboard/post/' + id + '/active').then(({ data }) => {
                // this.getAllData();
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