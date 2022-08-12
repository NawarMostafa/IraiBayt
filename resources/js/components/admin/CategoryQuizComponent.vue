<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>أقسام المسابقات</span>
                        <abbr title="إضافة قسم">
                            <button @click="showAddDialog" type="button" class="btn btn-sm btn-outline-secondary"><i
                                    class="fa fa-plus"></i></button>
                        </abbr>
                    </h4>
                </div>
                <div class="card-body table-responsive">
                    <input type="text" class="form-control-sm d-inline-block mb-1" placeholder="بحث" v-model="q"
                        @keyup="getAllData">
                    <table class="table table-bordered">
                        <tr>
                            <th>الترقيم</th>
                            <th>القسم</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-bind:key="category.id" v-for="(category, index) in categories.data">
                            <td>{{ index + 1 }}</td>
                            <td>{{ category.name }}</td>
                            <td>
                                <button @click="showeditDialog(category.id)" type="button" class="btn btn-sm btn-info">
                                    <i class="fa fa-edit"></i></button>
                                <button @click="deleteCategory(category.id)" type="button"
                                    class="btn btn-sm btn-danger"><i class="fa fa-trash "></i></button>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <pagination :data="categories" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>


        <!--Dialog -->
        <!-- Modal -->
        <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form @submit.prevent="form.id == null ? save() : update()" @keydown="form.onKeydown($event)"
                    enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة قسم</h5>

                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>اسم القسم</label>
                                <input type="hidden" v-model="form.id" v-if="form.id != null">
                                <input v-model="form.name" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>صورة القسم</label>
                                <input type="file" name="img" id="ImgCat" class="form-control" @change="changeImg">
                                <div class="mt-1 w-25" v-if="form.img != '' && form.img.length > 50">
                                    <img :src="form.img" alt="" class="w-100 img-thumbnail d-block">
                                    <button type="button" @click="trashImg" class="btn btn-danger btn-sm btn-block"><i
                                            class="fa fa-trash"></i></button>
                                </div>
                                <div class="mt-1 w-25" v-if="form.img != '' && form.img.length < 50">
                                    <label for="">الصورة القديمة</label>
                                    <img :src="base_storage + '/cats/' + form.img" alt=""
                                        class="w-100 img-thumbnail d-block">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>



                            <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name: "CategoryQuizComponent",
    data() {
        return {
            categories: {},
            oldImg: '',
            form: new Form({
                id: null,
                name: '',
                img: '',
            }),
            base_storage: base_storage,
            q: '',
        }
    },
    methods: {
        trashImg() {
            this.form.img = '';
            $('#ImgCat').val('');
        },
        changeImg(el) {
            var file = el.target.files[0];
            var reader = new FileReader();
            reader.onloadend = () => {
                console.log('RESULT', reader.result)
                this.form.img = reader.result;
            }
            reader.readAsDataURL(file);
        },


        getAllData() {
            axios.get(base_site + '/dashboard/categoriesQuiz/get?q=' + this.q).then(res => {
                this.categories = res.data;
            });
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/categoriesQuiz/get?page=' + page + '&q=' + this.q)
                .then(response => {
                    this.categories = response.data;
                });
        },

        showAddDialog() {
            $('#ImgCat').val('');
            this.form.clear();
            this.form.reset();
            $('#addCategory').modal('show');
        },
        save() {
            this.form.post(base_site + '/dashboard/categoriesQuiz/save').then(({ }) => {
                Toast.fire({
                    icon: 'success',
                    text: "تمت الإضافة بنجاح"
                });
                $('#addCategory').modal('hide');
                this.getAllData();
                Fire.$emit('DeleteCountry');
            });
        },
        showeditDialog(id) {
            $('#ImgCat').val('');
            this.form.clear();
            this.form.reset();
            axios.get(base_site + '/dashboard/categoriesQuiz/' + id + '/get').then(({ data }) => {
                //  this.form.fill(data);
                if (data.img == null) {
                    this.form.name = data.name
                    this.form.id = data.id;
                } else {
                    // alert('dd')
                    this.form.fill(data)
                }

            })
            $('#addCategory').modal('show');
        },
        update() {
            this.form.put(base_site + '/dashboard/categoriesQuiz/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: "تم التعديل بنجاح"
                });
                $('#addCategory').modal('hide');
                Fire.$emit('DeleteCountry');
                this.getAllData();
            })
        },
        deleteCategory(id) {
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
                    axios.delete(base_site + '/dashboard/categoriesQuiz/' + id + '/delete').then(({ data }) => {
                        Fire.$emit('DeleteCountry');
                        Swal.fire(
                            'حذف!',
                            'تم الحذف بنجاح .',
                            'success'
                        )
                        Fire.$emit('DeleteCountry');
                    });

                }
            })


        },

    },
    mounted() {
        this.getResults()
        Fire.$on('DeleteCountry', () => {
            this.getAllData()
        })
    },
    created() {
        this.getAllData();
    },
}
</script>

<style scoped>
/*#img-preview{*/
/*position: relative;*/
/*}*/
/*#img-preview>#BtnTrash{*/
/*position: absolute;*/
/*right: 10px;*/
/*bottom: 5px;*/
/*}*/
</style>