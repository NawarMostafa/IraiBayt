<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">
                    <span>ترويسة صفحة العملات</span>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                            <label>المحتوى</label>
                            <ckeditor v-model="form.header_ex" :config="editorConfig"></ckeditor>
                            <div class="mt-2" v-html="form.body"></div>
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
    name: "HeaderExComponent",
    data() {
        return {
            editorConfig: {
                // The configuration of the editor.
                language: 'ar',
                uploadiamge: '',
                filebrowserUploadUrl: base_site + '/dashboard/uploadImg',
                filebrowserBrowseUrl: base_site + '/dashboard/browse',
                filebrowserUploadMethod: 'form'
            },
            form: new Form({
                header_ex: ''
            })
        }
    },
    methods: {
        save() {
            this.form.post(base_site + '/dashboard/ex/title').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم التعديل بنجاح'
                })
            })
        },
        getTitle() {
            axios.get(base_site + '/dashboard/ex/title').then(({ data }) => {
                this.form.fill(data);
            })
        }
    },
    created() {
        this.getTitle();
    }
}
</script>

<style scoped>
</style>