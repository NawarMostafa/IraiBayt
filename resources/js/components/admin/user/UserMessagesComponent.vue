<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-right">الرسائل التي أرسلها هذا المستخدم</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>ترقيم</th>
                            <th>نوع الرسالة</th>
                            <th>تم الإرسال</th>
                            <th>تحكم</th>
                        </tr>
                        <tr v-for="(msg, index) in messages.data" v-bind:key="msg.id"
                            :class="msg.isread == 0 ? 'bg-warning' : ''">
                            <td>{{ index + 1 }}</td>
                            <td>{{ msg.type }}</td>
                            <td>{{ msg.created_at }}</td>
                            <td>
                                <button type="button" @click="read(msg)" class="btn btn-sm btn-secondary"><i
                                        class="fa fa-info"></i></button>
                                <button v-if="msg.isread == 0" type="button" @click="readchange(msg.id)"
                                    class="btn btn-sm btn-primary"><i class="fa fa-check-circle"></i></button>
                                <button type="button" @click="deleteMsg(msg.id)" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="MsgDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="send" @keydown="form.onKeydown($event)">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تفاصيل الرسالة</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea v-model="form.oldmsg" readonly class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <textarea v-model="form.msg" placeholder="أكتب الرد" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" v-model="form.isread" :value="0">
                                    <label class="form-check-label">
                                        تعيين كغير مقروءة
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" v-model="form.isread" :value="1">
                                    <label class="form-check-label">
                                        تعيين كمقروءة
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row justify-content-center" v-if="progress">
                                <div class="col-md-6">
                                    <p class="text-center small">يتم الآن إرسال الرد</p>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                            <button :disabled="form.busy" type="submit" class="btn btn-primary">إرسال الرد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "UserMessagesComponent",
    data() {
        return {
            messages: {},
            form: new Form({
                id: null,
                email: '',
                oldmsg: '',
                msg: '',
                isread: 1,
            }),
            progress: false,
        }
    },
    props: ['id'],
    methods: {
        getAllData() {
            axios.get(base_site + '/dashboard/messages/getByUserId/' + this.id).then(data => {
                this.messages = data.data;
            })
        },
        deleteMsg(id) {
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
                    axios.delete(base_site + '/dashboard/messages/' + id + '/delete').then(() => {
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
        read(msg) {
            this.form.id = msg.id;
            this.form.email = msg.email;
            this.form.oldmsg = msg.msg;
            $('#MsgDialog').modal('show')
        },
        readchange(id) {
            axios.post(base_site + '/dashboard/messages/' + id + '/readchange').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم تعيين الرسالة كمقروءة'
                })
                this.getAllData()
            })
        },
        send() {
            this.progress = true;
            this.form.post(base_site + '/dashboard/messages/replay').then(() => {
                this.progress = false;
                Toast.fire({
                    icon: 'success',
                    text: 'تم إرسال الرد بنجاح'
                })
                this.form.reset();
                this.form.clear()
                $('#MsgDialog').modal('hide');
                this.getAllData()
            })
        }
    },
    created() {
        this.getAllData()
    },
}
</script>

<style scoped>
</style>