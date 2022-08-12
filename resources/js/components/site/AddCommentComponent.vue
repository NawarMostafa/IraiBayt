<template>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12 p-3">
            <form @submit.prevent="save()" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea v-model="form.body" class=" form-control" placeholder="أضف تعليق..."></textarea>
                </div>
                <button :disabled="form.busy" type="submit" class="btn text-white mt-3"
                    style="background:#65aeca;">إضافة تعليق</button>
            </form>
        </div>
        <div class="col-md-12 mt-3">
            <h4>التعليقات</h4>
            <div class="" v-for="comment in comments" v-bind:key="comment.id">
                <p class="small pb-0 mb-0 t-bl"><span><i class="fa fa-user"></i> {{ comment.user.name }}</span></p>
                <p class="small p-0 m-0 d-flex justify-content-between"><span class="d-block">{{ comment.body }}</span>
                    <span class="d-block">{{ comment.created_at }}</span></p>
                <div class=" text-center">
                    <hr class="w-50">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddCommentComponent",
    props: ['user_id', 'post_id'],
    data() {
        return {
            comments: {},
            comment: '',
            form: new Form({
                body: '',
                user_id: '',
                post_id: '',
            })
        }
    },
    methods: {
        save() {
            this.form.post(base_site + '/Comments/save').then(({ }) => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم إضافة تعليقك بنجاح'
                });
                this.form.clear()
                this.form.reset()
                this.form.user_id = this.user_id;
                this.form.post_id = this.post_id;
                this.getAllData()
            });
        },
        getAllData() {
            axios.get(base_site + '/comments/' + this.post_id + '/get').then(res => {
                this.comments = res.data;
            })
        }
    },
    created() {
        this.form.user_id = this.user_id;
        this.form.post_id = this.post_id;
        this.getAllData()

    },
    mounted() {
        this.getAllData()
    }
}
</script>

<style scoped>
</style>