<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row justify-content-center">
                    <ul class="list-unstyled w-50 mt-3">
                        <li class="alert alert-danger small" v-for="error in errors1">{{ error[0] }}</li>
                    </ul>
                </div>
                <form @submit="submitForm">
                    <div class="card-body">
                        <div class="form-group">
                            <label>نوع المقال</label>
                            <select v-model="type" class="form-control">
                                <option value="system">قوانين</option>
                                <option value="other">نصائح العقارات</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>العنوان</label>
                            <input type="text" v-model="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>وصف </label>
                            <ckeditor v-model="description" :config="editorConfig"></ckeditor>
                        </div>
                        <div class="form-group">
                            <label>ملف مرفق</label>
                            <input type="file" ref="file" v-on:change="handleFileUpload()" class="form-control-file">
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4> القوانين</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>اسم القانون</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="sys in systems.data">
                            <td style="width:70%">{{ sys.name }}</td>
                            <td style="width:30%">
                                <a :href="base_site + '/dashboard/system/' + sys.id + '/edit'" class="btn btn-sm btn-info"><i
                                        class="fa fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" @click="deletePost(sys.id)"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <pagination :data="systems" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4> نصائح العقارات</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>العنوان</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="tip in tips.data">
                            <td style="width:70%">{{ tip.name }}</td>
                            <td style="width:30%">
                                <a :href="base_site + '/dashboard/system/' + tip.id + '/edit'" class="btn btn-sm btn-info"><i
                                        class="fa fa-edit"></i></a><button class="btn btn-sm btn-danger"
                                    @click="deletePost(tip.id)"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <pagination :data="tips" :limit="1" @pagination-change-page="getResults_tips"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SystemComponent",
    data() {
        return {

            file: '',
            name: '',
            description: '',
            type: 'system',
            editorConfig: {
                // The configuration of the editor.
                language: 'ar',
                uploadiamge: '',
                extraPlugins: 'autogrow',
                filebrowserUploadUrl: base_site + '/dashboard/uploadImg',
                filebrowserBrowseUrl: base_site + '/dashboard/browse',
                filebrowserUploadMethod: 'form'
            },
            errors1: 0,
            errors: {
                name: '',
                url: '',
            },
            systems: {},
            tips: {},
            base_site,
        }

    },
    methods: {
        getAllData() {
            axios.get(base_site + '/dashboard/system/all').then(res => {
                this.systems = res.data;
            })

            axios.get(base_site + '/dashboard/tips/all').then(res => {
                this.tips = res.data;
            })
        },
        getResults(page = 1) {
            axios.get(base_site + '/dashboard/system/all?page=' + page).then(res => {
                this.systems = res.data;
            })
        },

        getResults_tips(page = 1) {
            axios.get(base_site + '/dashboard/tips/all?page=' + page).then(res => {
                this.tips = res.data;
            })
        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        },
        submitForm(e) {
            e.preventDefault();
            // console.log(e.target.file.files[0]);
            let currentObj = this;
            this.errors.name = '';
            this.errors.url = '';
            const conf = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },

            };
            let formData = new FormData();
            formData.append('url', this.file)
            formData.append('name', this.name)
            formData.append('description', this.description)
            formData.append('type', this.type)
            axios.post(base_site + '/dashboard/system/save', formData, conf).then(({ data }) => {
                if (data != 'success') {
                    this.errors1 = data;
                    /*console.log(data.name[0])
                    if(data.name!='undefined'){

                        this.errors.name=data.name[0]
                    }
                    if(data.url!='undefined'){

                        this.errors.url=data.url[0]
                    }*/

                } else {
                    Toast.fire({
                        icon: 'success',
                        text: 'تمت إضافة القانون'
                    })
                    this.name = '',
                        this.description = '';

                    this.getAllData()
                }
            })
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
                    axios.delete(base_site + '/dashboard/system/' + id + '/delete').then(({ data }) => {
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
    }
}
</script>

<style scoped>
</style>