<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">
                    <span>إضافة إحصائيات</span>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                            <label>العنوان</label>
                            <input type="text" class="form-control" v-model="form.title">
                        </div>
                        <div class="form-group">
                            <label>المحتوى</label>
                            <textarea class="form-control" v-model="form.body"></textarea>
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
    name: "AddAnalizeComponent",
    data() {
        return {
            form: new Form({
                id: '',
                title: '',
                body: ''
            })
        }
    },
    props: ['id'],
    methods: {
        save() {
            this.form.put(base_site + '/dashboard/analize/' + this.form.id + '/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم التعديل بنجاح'
                }).then(function () {
                    location.href = base_site + '/dashboard/analize';
                });
            })
        }
    },
    created() {
        axios.get(base_site + '/dashboard/analize/' + this.id + '/get').then(({ data }) => {
            this.form.fill(data);
        })
    }
}
</script>

<style scoped>
</style>