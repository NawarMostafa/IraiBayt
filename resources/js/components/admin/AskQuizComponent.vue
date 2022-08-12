<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>الأسئلة</span>
                        <abbr title="إضافة سؤال">
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
                            <th>السؤال</th>
                            <th>القسم</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="ask in asks.data">
                            <td>{{ ask.ask }}</td>
                            <td>{{ ask.category.name }}</td>


                            <td>
                                <button @click="showeditDialog(ask.id)" type="button" class="btn btn-sm btn-info"><i
                                        class="fa fa-edit"></i></button>
                                <button @click="deleteCity(ask.id)" type="button" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash "></i></button>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <pagination :data="countries" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>


        <!--Dialog -->
        <!-- Modal -->
        <div class="modal fade" id="addCity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form @submit.prevent="form.id == null ? save() : update()" @keydown="form.onKeydown($event)">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة محافظة</h5>

                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>القسم</label>

                                <select v-model="form.cat_quiz_id" name="country_id" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('cat_quiz_id') }">
                                    <option value="">إختر القسم</option>
                                    <option v-for="category in categories" :value="category.id">{{ category.name }}
                                    </option>
                                </select>
                                <has-error :form="form" field="cat_quiz_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>السؤال</label>
                                <input type="hidden" v-model="form.id" v-if="form.id != null">
                                <input v-model="form.ask" type="text" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('ask') }">
                                <has-error :form="form" field="ask"></has-error>
                            </div>
                            <div class="form-group">
                                <label> الوقت المسموح به بالثانية</label>

                                <input v-model="form.time" type="number" name="name" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div v-if="form.id == null" class="form-group row">
                                <div class="col-md-12">
                                    <label class="d-block">الإجابة الأولى</label>
                                </div>

                                <div class="col-md-9">
                                    <input v-model="form.ask1.answer" type="text" name="name"
                                        class="form-control d-inline-block"
                                        :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form.ask1" field="answer"></has-error>
                                </div>
                                <div class="col-md-3">
                                    <select v-model="form.ask1.right" class="form-control-sm d-inline-block">
                                        <option value="0">خطأ</option>
                                        <option value="1">صحيح</option>
                                    </select>
                                </div>
                            </div>
                            <div v-if="form.id == null" class="form-group row">
                                <div class="col-md-12">
                                    <label class="d-block">الإجابة الثانية</label>
                                </div>

                                <div class="col-md-9">
                                    <input v-model="form.ask2.answer" type="text" name="name"
                                        class="form-control d-inline-block"
                                        :class="{ 'is-invalid': form.errors.has('ask2.answer') }">
                                    <has-error :form="form.ask2" field="answer"></has-error>
                                </div>
                                <div class="col-md-3">
                                    <select v-model="form.ask2.right" class="form-control-sm d-inline-block">
                                        <option value="0">خطأ</option>
                                        <option value="1">صحيح</option>
                                    </select>
                                </div>
                            </div>

                            <div v-if="form.id == null" class="form-group row">
                                <div class="col-md-12">
                                    <label class="d-block">الإجابة الثالثة</label>
                                </div>

                                <div class="col-md-9">
                                    <input v-model="form.ask3.answer" type="text" name="name"
                                        class="form-control d-inline-block"
                                        :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form.ask3" field="answer"></has-error>
                                </div>
                                <div class="col-md-3">
                                    <select v-model="form.ask3.right" class="form-control-sm d-inline-block">
                                        <option value="0">خطأ</option>
                                        <option value="1">صحيح</option>
                                    </select>
                                </div>
                            </div>

                            <div v-if="form.id == null" class="form-group row">
                                <div class="col-md-12">
                                    <label class="d-block">الإجابة الرابعة</label>
                                </div>

                                <div class="col-md-9">
                                    <input v-model="form.ask4.answer" type="text" name="name"
                                        class="form-control d-inline-block"
                                        :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form.ask4" field="answer"></has-error>
                                </div>
                                <div class="col-md-3">
                                    <select v-model="form.ask4.right" class="form-control-sm d-inline-block">
                                        <option value="0">خطأ</option>
                                        <option value="1">صحيح</option>
                                    </select>
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
    name: "AskQuizComponent",
    data() {
        return {
            asks: {},
            caegories: null,
            form: new Form({
                id: null,
                ask: '',
                time: 10,
                cat_quiz_id: '',
                ask1: {
                    answer: '',
                    right: 0,
                },
                ask2: {
                    answer: '',
                    right: 0,
                },
                ask3: {
                    answer: '',
                    right: 0,
                },
                ask4: {
                    answer: '',
                    right: 0,
                }
            }),
            q: '',
        }
    },
    methods: {
        getAllData() {
            axios.get(base_site + '/dashboard/asksQuiz/get?q=' + this.q).then(res => {
                this.asks = res.data;
            });
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/asksQuiz/get?page=' + page + '&q=' + this.q)
                .then(response => {
                    this.asks = response.data;
                });
        },
        showAddDialog() {
            this.form.clear();
            this.form.reset();
            $('#addCity').modal('show');
        },
        save() {
            this.form.post(base_site + '/dashboard/asksQuiz/save').then(({ }) => {
                Toast.fire({
                    icon: 'success',
                    text: "تمت الإضافة بنجاح"
                });
                $('#addCity').modal('hide');
                this.getAllData();
            });
        },
        showeditDialog(id) {
            this.form.clear();
            this.form.reset();
            axios.get(base_site + '/dashboard/asksQuiz/' + id + '/get').then(({ data }) => {
                this.form.fill(data);
            })
            $('#addCity').modal('show');
        },
        update() {
            this.form.put(base_site + '/dashboard/asksQuiz/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: "تم التعديل بنجاح"
                });
                $('#addCity').modal('hide');
                this.getAllData();
            })
        },
        getAllCategory() {
            axios.get(base_site + '/dashboard/categoriesQuiz/get/all').then(({ data }) => {
                this.categories = data;
            })
        },
        deleteCity(id) {
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
                    axios.delete(base_site + '/dashboard/asksQuiz/' + id + '/delete').then(({ data }) => {
                        Swal.fire(
                            'حذف!',
                            'تم الحذف بنجاح .',
                            'success'
                        )
                        Fire.$emit('DeleteCountry');
                        this.getAllData()
                    });

                }
            })


        },
    },
    mounted() {
        this.getResults()
        Fire.$on('DeleteCountry', () => {
            this.getAllData();
            this.getAllCountry()
        })
    },
    created() {
        this.getAllCategory();
        this.getAllData();
    },
}
</script>

<style scoped>
</style>