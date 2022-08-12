<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    إعدادات الموقع
                </div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                            <label>اسم الموقع : </label>
                            <input type="text" class="form-control" v-model="form.name">
                        </div>
                        <div class="form-group">
                            <label>بريد الموقع : </label>
                            <input type="text" class="form-control" v-model="form.email">
                        </div>
                        <div class="form-group">
                            <label>سياسة الخصوصية : </label>
                            <ckeditor v-model="form.priv" :config="editorConfig"></ckeditor>
                        </div>

                        <div class="form-group">
                            <label>من نحن : </label>
                            <ckeditor v-model="form.about" :config="editorConfig"></ckeditor>
                        </div>

                        <div class="form-group">
                            <label>شروط الاستخدام : </label>
                            <ckeditor v-model="form.terms" :config="editorConfig"></ckeditor>
                        </div>

                        <div class="form-group">
                            <label>لوغو الموقع : </label>
                            <input type="file" @change="changeImg" class="form-control">
                            <img v-if="form.logo != '' && form.logo != null" :src="form.logo" class="img-thumbnail w-25"
                                alt="">

                        </div>

                        <div class="form-group">
                            <label>صورة العقارات الإفتراضية : </label>
                            <input type="file" @change="changeImg1" class="form-control">
                            <img v-if="form.default_img != '' && form.default_img != null && form.default_img.length <= 110"
                                :src="base_storage + '/posts/' + form.default_img" class="img-thumbnail w-25" alt="">
                            <img v-if="form.default_img != '' && form.default_img != null && form.default_img.length > 110"
                                :src="form.default_img" class="img-thumbnail w-25" alt="">

                        </div>

                        <div class="form-group">
                            <label>صورة العلامة المائية : </label>
                            <input type="file" @change="changeImg2" class="form-control">
                            <img v-if="form.water_img != '' && form.water_img != null && form.water_img.length <= 110"
                                :src="base_storage + '/cats/' + form.water_img" class="img-thumbnail w-25" alt="">
                            <img v-if="form.water_img != '' && form.water_img != null && form.water_img.length > 110"
                                :src="form.water_img" class="img-thumbnail w-25" alt="">

                        </div>
                        <div class="form-group">
                            <label>رابط صفحة فيس بوك : </label>
                            <input type="text" class="form-control" v-model="form.face">
                        </div>
                        <div class="form-group">
                            <label> رابط صفحة تويتر : </label>
                            <input type="text" class="form-control" v-model="form.twitter">
                        </div>
                        <div class="form-group">
                            <label>رابط صفحة لينكدن : </label>
                            <input type="text" class="form-control" v-model="form.lenkedin">
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
    name: "SettingsComponent",
    data() {
        return {
            editorConfig: {
                // The configuration of the editor.
                language: 'ar',
                uploadiamge: '',
                extraPlugins: 'autogrow',
                filebrowserUploadUrl: base_site + '/dashboard/uploadImg',
                filebrowserBrowseUrl: base_site + '/dashboard/browse',
                filebrowserUploadMethod: 'form'
            },
            form: new Form({
                id: '',
                name: '',
                lenkedin: '',
                twitter: '',
                face: '',
                email: '',
                about: '',
                priv: '',
                terms: '',
                logo: '',
                water_img: '',
                default_img: ''
            }),
            setting: null,
            base_storage,
        }
    },
    methods: {
        getSettings() {
            axios.get(base_site + '/dashboard/settings/get').then(({ data }) => {
                this.form.fill(data);
            })
        },
        changeImg(el) {
            let file = el.target.files[0];
            let reader = new FileReader();
            reader.onloadend = () => {
                console.log('RESULT', reader.result)
                this.form.logo = reader.result

            }
            reader.readAsDataURL(file);

        },
        changeImg1(el) {
            let file = el.target.files[0];
            let reader = new FileReader();
            reader.onloadend = () => {
                console.log('RESULT', reader.result)
                this.form.default_img = reader.result

            }
            reader.readAsDataURL(file);

        },
        changeImg2(el) {
            let file = el.target.files[0];
            let reader = new FileReader();
            reader.onloadend = () => {
                console.log('RESULT', reader.result)
                this.form.water_img = reader.result

            }
            reader.readAsDataURL(file);

        },
        save() {
            this.form.post(base_site + '/dashboard/settings/save').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم تعديل الإعدادات'
                })
            });
        }
    },
    created() {
        this.getSettings()
    }
}
</script>

<style scoped>
</style>