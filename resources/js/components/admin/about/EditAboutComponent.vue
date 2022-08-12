<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><span>إضافة مقالة</span></div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                            <label>العنوان</label>
                            <input type="text" v-model="form.title" class="form-control">
                        </div>
                        <div class="form-group">
                            <ckeditor v-model="form.body" :config="editorConfig"></ckeditor>

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
    name: "EditAboutComponent",

    data() {
        return {
            form: new Form({
                id: '',
                title: '',
                body: '',
            }),
            editorConfig: {
                // The configuration of the editor.
                language: 'ar',
                uploadiamge: '',
                filebrowserUploadUrl: base_site + '/dashboard/uploadImg',
                filebrowserBrowseUrl: base_site + '/dashboard/browse',
                filebrowserUploadMethod: 'form'
            },

        }
    },
    props: ['id'],
    methods: {
        getAbout() {
            axios.get(base_site + '/dashboard/abouts/' + this.id + '/get').then(({ data }) => {
                this.form.fill(data);
            });
        },
        save() {
            this.form.put(base_site + '/dashboard/abouts/' + this.form.id + '/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم التعديل بنجاح'
                }).then(function () {
                    location.href = base_site + '/dashboard/abouts';
                });
            })
        },
    },
    created() {
        this.getAbout();
    }

}
</script>

<style scoped>
</style>