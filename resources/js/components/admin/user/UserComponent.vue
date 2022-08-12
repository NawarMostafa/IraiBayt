<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body table-responsive">
                    <div class="mb-2">
                        <input type="text" v-model="q" @keyup="getAllData" placeholder="بحث" class="form-control-sm">
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>ترقيم</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>تاريخ التسجيل</th>
                            <th>الحالة</th>
                            <th>النوع</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-bind:key="user.id" v-for="(user, index) in users.data"
                            :class="user.active == 0 ? 'bg-warning' : ''">
                            <td>{{ index + 1 }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.created_at }}</td>
                            <td>{{ user.active | activate }}</td>
                            <td>{{ user.role }}</td>
                            <td>
                                <a :href="base_site + '/dashboard/users/' + user.id + '/edit'" class="btn btn-sm btn-info"><i
                                        class="fa fa-edit"></i></a>
                                <button class="btn btn-sm btn-warning" @click="activeUser(user.id)"
                                    v-html="checkActive(user.active)">


                                </button>
                                <button class="btn btn-sm btn-danger" @click="deleteUser(user.id)"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <pagination :data="users" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "UserComponent",
    filters: {
        activate: function (v) {
            if (v == 0) {
                return "محظور"
            } else {
                return "مفعل"
            }
        }
    },
    data() {
        return {
            users: {},
            base_site,
            q: '',
        }
    },
    methods: {
        checkActive(v) {
            if (v == 1) {
                return `<i class="fa fa-user-lock"></i>`
            } else {
                return `<i class="fa fa-check"></i>`
            }
        },
        getAllData() {
            axios.get(base_site + '/dashboard/users/all?q=' + this.q).then(res => {
                this.users = res.data;
            })
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/users/all?q=' + this.q + '&page=' + page).then(res => {
                this.users = res.data;
            })
        },
        activeUser(id) {
            axios.get(base_site + '/dashboard/users/' + id + '/active').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم العملية بنجاح'
                })
                this.getAllData()
            })
        },
        deleteUser(id) {
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
                    axios.delete(base_site + '/dashboard/users/' + id + '/delete').then(({ data }) => {
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
        this.getResults()
    }
}
</script>

<style scoped>
</style>