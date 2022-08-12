<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>وحدات القياس</span>
                        <abbr title="إضافة وحدة">
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
                            <th>الوحدة</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="unit in units.data">
                            <td>{{ unit.name }}</td>

                            <td>
                                <button @click="showeditDialog(unit.id)" type="button" class="btn btn-sm btn-info">
                                    <i class="fa fa-edit"></i></button>
                                <button @click="deleteUnit(unit.id)" type="button" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash "></i></button>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <pagination :data="units" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>


        <!--Dialog -->
        <!-- Modal -->
        <div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form @submit.prevent="form.id == null ? save() : update()" @keydown="form.onKeydown($event)"
                    enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة وحدة</h5>

                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>اسم الوحدة</label>
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
    name: "UnitComponent",
    data() {
        return {
            units: {},

            form: new Form({
                id: null,
                name: '',

            }),

            q: '',
        }
    },
    methods: {

        getAllData() {
            axios.get(base_site + '/dashboard/units/get?q=' + this.q).then(res => {
                this.units = res.data;
            });
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/units/get?page=' + page + '&q=' + this.q)
                .then(response => {
                    this.units = response.data;
                });
        },

        showAddDialog() {
            $('#ImgCat').val('');
            this.form.clear();
            this.form.reset();
            $('#addUnit').modal('show');
        },
        save() {
            this.form.post(base_site + '/dashboard/units/save').then(({ }) => {
                Toast.fire({
                    icon: 'success',
                    text: "تمت الإضافة بنجاح"
                });
                $('#addUnit').modal('hide');
                this.getAllData();
                Fire.$emit('DeleteCountry');
            });
        },
        showeditDialog(id) {
            $('#ImgCat').val('');
            this.form.clear();
            this.form.reset();
            axios.get(base_site + '/dashboard/units/' + id + '/get').then(({ data }) => {
                this.form.fill(data);

            })
            $('#addUnit').modal('show');
        },
        update() {
            this.form.put(base_site + '/dashboard/units/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: "تم التعديل بنجاح"
                });
                $('#addUnit').modal('hide');
                Fire.$emit('DeleteCountry');
                this.getAllData();
            })
        },
        deleteUnit(id) {
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
                    axios.delete(base_site + '/dashboard/units/' + id + '/delete').then(({ data }) => {
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