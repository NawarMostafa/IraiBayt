<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row justify-content-center">
                    <ul class="list-unstyled w-50 mt-3">
                        <li class="alert alert-danger small" v-for="error in errors1" v-bind:key="error.id">{{ error[0] }}
                        </li>
                    </ul>
                </div>
                <form @submit="submitForm">
                    <div class="card-body">
                        <div class="form-group">
                            <label>اسم القانون</label>
                            <input type="text" v-model="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>وصف القانون</label>
                            <ckeditor v-model="description" :config="editorConfig"></ckeditor>
                        </div>
                        <div class="form-group">
                            <label>ملف مرفق</label>
                            <input type="file" ref="file" v-on:change="handleFileUpload()" class="form-control-file">
                            <embed class="w-75" v-if="file != '' && file != null" :src="base_storage.trimRight('public') + file"
                                type="application/pdf">
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditSystemComponent",
    data() {
        return {
            file: '',
            name: '',
            description: '',
            editorConfig: {
                // The configuration of the editor.
                language: 'ar',
                uploadiamge: '',
                filebrowserUploadUrl: base_site + '/dashboard/uploadImg',
                filebrowserBrowseUrl: base_site + '/dashboard/browse',
                filebrowserUploadMethod: 'form'
            },
            errors1: 0,
            errors: {
                name: '',
                url: '',
            },
            base_storage,
        }
    },
    props: ['id'],
    methods: {
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        },
        getOneData() {
            axios.get(base_site + '/dashboard/system/' + this.id + '/getOne').then(({ data }) => {
                this.name = data.name;
                this.description = data.description;
                this.file = data.url == null ? '' : data.url;
            })
        },
        submitForm(e) {
            e.preventDefault();
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
            axios.post(base_site + '/dashboard/system/' + this.id + '/update', formData, conf).then(({ data }) => {
                if (data != 'success') {
                    this.errors1 = data;

                } else {
                    Toast.fire({
                        icon: 'success',
                        text: 'تم تعديل القانون'
                    }).then(function () {
                        location.href = base_site + '/dashboard/systems';
                    });

                }
            })
        },
    },
    created() {
        this.getOneData();
    }
}
</script>

<style scoped>
</style>