<template>
    <div class="row justify-content-center mb-3">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                            <label>الاسم: </label>
                            <input type="text" v-model="form.name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>البريد الإلكتروني: </label>
                            <input type="text" v-model="form.email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور: </label>
                            <input type="text" v-model="form.password" class="form-control">
                            <span class="text-danger small">اترك الحقل فارغا إذا كن لا تريد تغيير كلمة المرور</span>
                        </div>
                        <div class="form-group">
                            <label>الصلاحيات: </label>
                            <select v-model="form.role" class="form-control">
                                <option value="admin">مدير عام</option>
                                <option value="user">مستخدم</option>
                                <option value="RealEstate-admin">مدير لقسم العقارات</option>
                                <option value="Currancy-admin">مدير لقسم العملات</option>
                                <option value="Weather-admin">مدير لقسم الطقس</option>
                                <option value="Material-admin">مدير لقسم المعادن</option>
                                <option value="Quiz-admin">مدير لقسم المسابقات</option>
                                <option value="Rules-admin">مدير لقسم القوانين</option>
                                <option value="AboutIraq-admin">مدير لقسم "عن العراق"</option>
                                <option value="Info-admin">مدير لقسم "هل تعلم"</option>
                                <option value="Analize-admin">مدير لقسم الإحصائيات</option>

                            </select>
                        </div>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditUserComponent",
    data() {
        return {
            form: new Form({
                id: '',
                name: '',
                email: '',
                password: '',
                role: ''
            })
        }
    },
    props: ['id'],
    methods: {
        getUser() {
            axios.get(base_site + '/dashboard/users/' + this.id + '/getOne').then(({ data }) => {
                this.form.fill(data);
            })
        },
        save() {
            this.form.put(base_site + '/dashboard/users/' + this.form.id + '/update').then(() => {
                Toast.fire({
                    icone: 'success',
                    text: 'تم التعديل بنجاح'
                }).then(function () {
                    location.href = base_site + '/dashboard/users';
                });
            })
        }
    },
    created() {
        this.getUser()
    }
}
</script>

<style scoped>
</style>