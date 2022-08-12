<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>الإجابات</span>
                    </h4>
                </div>
                <div class="card-body table-responsive">
                    <input type="text" class="form-control-sm d-inline-block mb-1" placeholder="بحث" v-model="q"
                        @keyup="getAllData">
                    <table class="table table-bordered">
                        <tr>
                            <th>الإجابة</th>
                            <th>صحيح/خطأ</th>
                            <th>السؤال</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="answer in answers.data">
                            <td>{{ answer.answer }}</td>
                            <td>{{ answer.right == '0' ? 'خطأ' : 'صحيح' }}</td>
                            <td>{{ answer.ask.ask }}</td>


                            <td>
                                <button @click="showeditDialog(answer.id)" type="button" class="btn btn-sm btn-info"><i
                                        class="fa fa-edit"></i></button>
                                <!-- <button @click="deleteCity(answer.id)" type="button" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash "></i></button>-->
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <pagination :data="answers" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>


        <!--Dialog -->
        <!-- Modal -->
        <div class="modal fade" id="addAnswer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form @submit.prevent="form.id == null ? save() : update()" @keydown="form.onKeydown($event)">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل الإجابة</h5>

                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="d-block">الإجابة </label>
                                </div>

                                <div class="col-md-9">
                                    <input v-model="form.answer" type="text" name="name"
                                        class="form-control d-inline-block"
                                        :class="{ 'is-invalid': form.errors.has('answer') }">
                                    <has-error :form="form.answer" field="answer"></has-error>
                                </div>
                                <div class="col-md-3">
                                    <select v-model="form.right" class="form-control-sm d-inline-block">
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
    name: "AnswerQuizComponent",
    data() {
        return {
            answers: {},
            caegories: null,
            form: new Form({
                id: null,
                answer: '',
                right: '',
            }),
            q: '',
        }
    },
    methods: {
        getAllData() {
            axios.get(base_site + '/dashboard/answersQuiz/get?q=' + this.q).then(res => {
                this.answers = res.data;
            });
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/answersQuiz/get?page=' + page + '&q=' + this.q)
                .then(response => {
                    this.answers = response.data;
                });
        },
        showAddDialog() {
            this.form.clear();
            this.form.reset();
            $('#addAnswer').modal('show');
        },
        save() {
            this.form.post(base_site + '/dashboard/answersQuiz/save').then(({ }) => {
                Toast.fire({
                    icon: 'success',
                    text: "تمت الإضافة بنجاح"
                });
                $('#addAnswer').modal('hide');
                this.getAllData();
            });
        },
        showeditDialog(id) {
            this.form.clear();
            this.form.reset();
            axios.get(base_site + '/dashboard/answersQuiz/' + id + '/get').then(({ data }) => {
                this.form.fill(data);
            })
            $('#addAnswer').modal('show');
        },
        update() {
            this.form.put(base_site + '/dashboard/answersQuiz/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: "تم التعديل بنجاح"
                });
                $('#addAnswer').modal('hide');
                this.getAllData();
            })
        },
        getAllAnswer() {
            axios.get(base_site + '/dashboard/answersQuiz/get/all').then(({ data }) => {
                this.categories = data;
            })
        },
        deleteAnswer(id) {
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
                    axios.delete(base_site + '/dashboard/answersQuiz /' + id + '/delete').then(({ data }) => {
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
            //this.getAllCountry()
        })
    },
    created() {
        //this.getAllCategory();
        this.getAllData();
    },
}
</script>

<style scoped>
</style>