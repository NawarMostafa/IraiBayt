<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="justify-content-between d-flex">
                        <span> التعليقات التي أضافها هذا المستخدم</span>
                    </h3>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>ترقيم</th>
                            <th>التعليق</th>
                            <th>تاريخ الإضافة</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-bind:key="comment.id" v-for="(comment, index) in comments.data">
                            <td>{{ index + 1 }}</td>
                            <td>{{ comment.body }}</td>
                            <td>{{ comment.created_at }}</td>
                            <td>

                                <button @click="deleteComment(comment.id)" type="button"
                                    class="btn btn-sm btn-danger"><i class="fa fa-trash "></i></button>
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
    name: "UserCommentsComponent",
    data() {
        return {
            comments: {},
            form: new Form({
                id: null,
            }),
            base_site: base_site,
        }
    },
    props: ['id'],
    methods: {
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
            axios.get(base_site + '/dashboard/comments/getByUserId/' + this.id).then(res => {
                this.comments = res.data;
            });
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/comments/getByUserId/' + this.id + '?page=' + page).then(res => {
                this.comments = res.data;
            });
        },
        showDialog() {
            this.form.reset()
            this.form.clear()
            $('#addPost').modal('show');
        },


        showeditDialog(id) {
        },
        deleteComment(cid) {
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
                    axios.delete(base_site + '/dashboard/comments/' + cid + '/delete').then(({ data }) => {
                        Swal.fire(
                            'حذف!',
                            'تم الحذف بنجاح .',
                            'success'
                        )
                        this.getAllData();
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