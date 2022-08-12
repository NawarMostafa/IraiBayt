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
    name: "AddAboutComponent",

    data() {
        return {
            form: new Form({
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
    methods: {
        save() {
            this.form.post(base_site + '/dashboard/abouts/save').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تمت الإضافة بنجاح'
                })
            })
        },
    }

}
</script>

<style scoped>
</style>