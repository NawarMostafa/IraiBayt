<template>
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5 mb-3">
            <h4 class="text-center mb-3">أرسل ملاحظاتك</h4>
        </div>
        <div class="col-md-12 img-thumbnail bg-wd mb-5">
            <div class="row justify-content-center mt-3">
                <div class="col-md-4 text-left">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)" class=" pt-5 pb-5">
                        <div class="dropdown">
                            <button class="btn btn-secondary bg-white text-dark dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ form.type == '' ? 'نوع الملاحظة' : form.type }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button type="button" class="dropdown-item" @click="form.type = 'شكر'">شكر</button>
                                <button type="button" class="dropdown-item" @click="form.type = 'إقتراح'">إقتراح</button>
                                <button type="button" class="dropdown-item" @click="form.type = 'مشكلة'">مشكلة</button>
                                <button type="button" class="dropdown-item"
                                    @click="form.type = 'الإعلان في موقعنا'">الإعلان في موقعنا</button>
                            </div>
                            <span class="text-danger"
                                v-if="form.errors.has('msg')">{{ form.errors.errors.type[0] }}</span>
                        </div>
                        <div class="form-group mt-2">
                            <input type="email" v-model="form.email" placeholder="البريد الإلكتروني"
                                :class="{ 'is-invalid': form.errors.has('email') }" id="EmailUser" class="form-control">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group mt-2 ">
                            <textarea class=" form-control" v-model="form.msg"
                                :class="{ 'is-invalid': form.errors.has('msg') }" rows="7"></textarea>
                            <has-error :form="form" field="msg"></has-error>
                        </div>
                        <button :disabled="form.busy" type="submit" class="btn btn-block "
                            style="background:#65aeca;">إرسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ContactUsComponent",
    data() {
        return {
            form: new Form({
                type: '',
                email: this.email,
                msg: '',
            }),
        }
    },
    props: ['email'],
    methods: {
        save() {
            this.form.post(base_site + '/sendMsg').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم إرسال الرسالة شكرا لك'
                })
                this.form.clear()
                this.form.reset();
                //this.form.email=this.email;
            })
        },
    },
    created() {
        if (this.email != '') {
            this.form.email = this.email;
        }
    }
}
</script>

<style scoped>
</style>