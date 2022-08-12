<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><span>
                        تعديل القسم
                    </span></div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                            <label>اسم القسم</label>
                            <input type="text" class="form-control" v-model="form.obj.name">
                        </div>
                        <div class="form-group">
                            <label>صورة القسم</label>
                            <input type="file" class="form-control" @change="changeImg">
                            <img class="img-size-64  img-thumbnail"
                                v-if="form.obj.img.length < 20 && form.obj.img != '' && form.obj.img != null"
                                :src="base_storage + '/images/' + form.obj.img" alt="">
                            <img class="w-25 img-thumbnail" v-else-if="form.obj.img.length > 50" :src="form.obj.img"
                                alt="">
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
    name: "EditDepartComponent",
    data() {
        return {
            form: new Form({
                id: '',
                obj: {
                    name: '',
                    img: ''
                },
            }),
            base_storage,
        }
    },
    props: ['id'],
    methods: {
        changeImg(el) {
            let file = el.target.files[0];
            let reader = new FileReader();
            reader.onloadend = () => {
                console.log('RESULT', reader.result)
                this.form.obj.img = reader.result;

            }
            reader.readAsDataURL(file);

        },
        save() {
            this.form.put(base_site + '/dashboard/departs/' + this.form.id + '/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم التعديل بنجاح'
                }).then(function () {
                    location.href = base_site + '/dashboard/departs';
                });
            });
        },
        getPart() {
            axios.get(base_site + '/dashboard/departs/' + this.id + '/get').then(({ data }) => {
                this.form.id = data.id;
                this.form.obj = data.data;
            })
        }
    },
    created() {
        this.getPart();
    }
}
</script>

<style scoped>
</style>