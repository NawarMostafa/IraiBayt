<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>التصنيفات</span>
                        <abbr title="إضافة تصنيف">
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
                            <th>التصنيف</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="tag in tags.data">
                            <td>{{ tag.name }}</td>

                            <td>
                                <button @click="showeditDialog(tag.id)" type="button" class="btn btn-sm btn-info">
                                    <i class="fa fa-edit"></i></button>
                                <button @click="deleteTag(tag.id)" type="button" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash "></i></button>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <pagination :data="tags" :limit="1" @pagination-change-page="getResults"></pagination>
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
                            <h5 class="modal-title" id="exampleModalLabel">إضافة تصنيف</h5>

                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>اسم التصنيف</label>
                                <input type="hidden" v-model="form.id" v-if="form.id != null">
                                <input v-model="form.name" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
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
    name: "TagComponent",
    data() {
        return {
            tags: {},

            form: new Form({
                id: null,
                name: '',

            }),
            base_storage: base_storage,
            q: '',
        }
    },
    methods: {
        getAllData() {
            axios.get(base_site + '/dashboard/tags/get?q=' + this.q).then(res => {
                this.tags = res.data;
            });
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/tags/get?page=' + page + '&q=' + this.q)
                .then(response => {
                    this.tags = response.data;
                });
        },

        showAddDialog() {
            $('#ImgCat').val('');
            this.form.clear();
            this.form.reset();
            $('#addCategory').modal('show');
        },
        save() {
            this.form.post(base_site + '/dashboard/tags/save').then(({ }) => {
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
            axios.get(base_site + '/dashboard/tags/' + id + '/get').then(({ data }) => {
                this.form.fill(data);

            })
            $('#addCategory').modal('show');
        },
        update() {
            this.form.put(base_site + '/dashboard/tags/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: "تم التعديل بنجاح"
                });
                $('#addCategory').modal('hide');
                Fire.$emit('DeleteCountry');
                this.getAllData();
            })
        },
        deleteTag(id) {
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
                    axios.delete(base_site + '/dashboard/tags/' + id + '/delete').then(({ data }) => {
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
    mounted() {
        this.getResults()
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