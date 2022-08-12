<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>تعديل إعلان</h3>
                </div>
                <div class="card-body">
                    <form @submit.prevent="save()" @keydown="form.onKeydown($event)">
                        <label class="d-block"><i class="fa fa-circle text-primary small"></i> إختر القسم</label>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <select v-model="form.category_id" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('answer') }" @change="changeCategory">
                                    <option value="">إختر قسم رئيسي</option>
                                    <option v-for="category in categories" v-bind:key="category.id"
                                        :value="category.id">{{ category.name }}</option>
                                </select>
                                <has-error :form="form.answer" field="answer"></has-error>
                            </div>
                            <div class="col-md-4">
                                <select v-model="form.subcat_id" @change="changeSubCat" class="form-control">
                                    <option value="">إختر قسم فرعي</option>
                                    <option v-for="sub in subs" v-bind:key="sub.id" :value="sub.id">{{ sub.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select v-model="form.city_id" class="city form-control" @change="changeCity()">
                                    <option value="">إختر مدينة</option>
                                    <option v-for="city in cities" v-bind:key="city.id" :value="city.id">{{ city.name }}
                                    </option>

                                </select>
                            </div>
                            <div class="col-md-2">
                                <select v-model="form.region_id" class="city form-control">
                                    <option value="">إختر منطقة</option>
                                    <option v-for="region in regions" v-bind:key="region.id" :value="region.id">
                                        {{ region.name }}</option>

                                </select>
                            </div>
                        </div>
                        <label class="d-block"><i class="fa fa-circle text-primary small"></i> تفاصيل الإعلان</label>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="text" v-model="form.title" class="form-control mb-2"
                                    placeholder="اكتب عنوان الإعلان ...">
                                <textarea v-model="form.description" class="form-control "
                                    placeholder="أكتب تفاصيل الإعلان ..." cols="30" rows="5"></textarea>
                            </div>
                            <div v-if="type == 'سكني'" class="col-md-6">
                                <div class="row">

                                    <div class="col-md-4">
                                        <select v-model="form.bedroom" class="form-control">
                                            <option value="">عدد الغرف النوم</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>

                                            <option value="أكثر من 3">أكثر من 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select v-model="form.bathroom" class="form-control">
                                            <option value="">عدد الحمامات</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>

                                            <option value="أكثر من 3">أكثر من 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">

                                    <div class="col-md-4">
                                        <select v-model="form.carage" class="form-control">
                                            <option value="">الكراج</option>
                                            <option value="تحتوي كراج">تحتوي كراج</option>
                                            <option value="لا تحتوي كراج">لا تحتوي كراج</option>
                                        </select>
                                    </div>
                                    <div v-if="form.carage == 'تحتوي كراج'" class="col-md-4">
                                        <input v-model="form.num_car" type="number" placeholder="عدد السيارات"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <input type="text" v-model="form.floor" placeholder="الطابق" name=""
                                            class="form-control">


                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" v-model="form.num_floor" placeholder="عدد طوابق البناء"
                                            name="" class="form-control">


                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <input type="text" v-model="form.area" class="form-control" placeholder="مساحة العقار"
                                    :class="{ 'is-invalid': form.errors.has('area') }"
                                    aria-label="Text input with dropdown button">
                                <has-error :form="form" field="area"></has-error>
                            </div>
                            <div class="col-md-2">
                                <select v-model="form.unit_id" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('unit_id') }">
                                    <option value="">حدد وحدة قياس</option>
                                    <option v-for="unit in units" v-bind:key="unit.id" :value="unit.id">{{ unit.name }}
                                    </option>
                                </select>
                                <has-error :form="form" field="unit_id"></has-error>
                            </div>

                            <div class="col-md-3">
                                <input type="text" v-model="form.price" class="form-control" placeholder="سعر العقار"
                                    :class="{ 'is-invalid': form.errors.has('price') }"
                                    aria-label="Text input with dropdown button">
                                <has-error :form="form" field="price"></has-error>
                            </div>
                            <div class="col-md-2">
                                <select v-model="form.currancy_id" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('currancy_id') }">
                                    <option value="">حدد العملة</option>
                                    <option v-for="currancy in currancies" v-bind:key="currancy.id"
                                        :value="currancy.id">{{ currancy.name }}</option>
                                </select>
                                <has-error :form="form" field="currancy_id"></has-error>
                            </div>
                            <div class="col-md-2">
                                <select v-model="form.payment" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('payment') }">
                                    <option value="">طريقة الدفع</option>
                                    <option value="كاش">كاش</option>
                                    <option value="تقسيط">تقسيط</option>
                                    <option value="كاش وتقسيط">كاش وتقسيط</option>
                                </select>
                                <has-error :form="form" field="payment"></has-error>
                            </div>
                        </div>




                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="d-block"><i class="fa fa-circle small text-primary"></i> صور
                                    العقار</label>
                            </div>

                            <div class="col-md-12">
                                <button v-if="form.imgs.length < 30" type="button" @click="openFile1(2)"
                                    class="btn btn-outline-secondary"><i class="fa fa-plus"></i></button>
                                <input type="file" class="input2 hide" @change="addMultipleImg" multiple>
                                <div class="row mt-2">

                                    <div v-if="form.img != ''" class="col-md-2">
                                        <img v-if="form.img != '' && form.img.length > 50" class="img-thumbnail w-100"
                                            :src="form.img" alt="">
                                        <img v-else-if="form.img != '' && form.img.length < 50" class="img-thumbnail w-100"
                                            :src="base_storage + '/posts/' + form.img" alt="">
                                        <button class="btn btn-sm btn-block btn-danger mt-2"
                                            v-if="form.img != '' && form.img != null" @click="form.img = ''"><i
                                                class="fa fa-trash"></i></button>
                                    </div>

                                    <div v-for="(img, index) in form.imgs" v-bind:key="img.id" class="col-md-2">
                                        <img v-if="img.length > 50" class="img-thumbnail w-100" :src="img" alt="">
                                        <img v-else-if="img.length < 20" class="img-thumbnail w-100"
                                            :src="base_storage + '/posts/' + img" alt="">
                                        <button type="button" @click="trashImg(index)"
                                            class="btn btn-sm btn-block btn-danger mt-2"><i
                                                class="fa fa-trash"></i></button>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label><i class="fa fa-circle text-primary"></i>معلومات التواصل</label>
                            </div>

                            <div class="col-md-4">
                                <input type="text" v-model="form.phone" placeholder="رقم الهاتف" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="d-block">يمكن التواصل عن طريق</label>
                                <label class="d-block">

                                    <input v-model="form.contact" value="إتصال مباشر" type="checkbox" name=""
                                        class="form-control-checkbox"> إتصال مباشر
                                </label>
                                <label class="d-block">

                                    <input v-model="form.contact" value="واتسآب" type="checkbox" name=""
                                        class="form-control-checkbox"> واتسآب
                                </label>
                                <label class="d-block">

                                    <input v-model="form.contact" value="تلغرام" type="checkbox" name=""
                                        class="form-control-checkbox"> تلغرام
                                </label>

                                <label class="d-block">

                                    <input v-model="form.contact" value="فايبر" type="checkbox" name=""
                                        class="form-control-checkbox"> فايبر
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block">نوع الإعلان</label>
                            <label class="d-block">

                                <input v-model="form.level" value="0" type="radio" name=""
                                    class="form-control-checkbox"> عادي
                            </label>
                            <label class="d-block">

                                <input v-model="form.level" value="1" type="radio" name=""
                                    class="form-control-checkbox"> مميز
                            </label>
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
    name: "EditPostComponent",
    data() {
        return {
            subcat: '',
            type: '',
            country_id: 1,
            cities: '',
            city: '',
            regions: '',
            subs: null,
            categories: '',
            catgory: '',
            units: null,
            unit: '',
            currancies: null,
            currancy: '',
            base_storage: base_storage,
            form: new Form({
                title: '',
                description: '',
                price: '',
                currancy_id: '',
                area: '',
                unit_id: '',
                rooms: '',
                bedroom: '',
                bathroom: '',
                payment: '',
                furniture: '',
                carage: '',
                num_car: '',
                floor: '',
                age: '',
                num_floor: '',
                name: '',
                phone: '',
                contact: [],
                category_id: '',
                subcat_id: '',
                unit_id: '',
                city_id: '',
                region_id: '',
                level: 0,
                img: '',
                imgs: [],

            }),
        }
    },
    methods: {
        changeSubCat() {
            axios.get(base_site + '/dashboard/subcategories/' + this.form.subcat_id + '/get').then(({ data }) => {
                this.type = data.type;
            })

        },
        openFile1(id) {
            $('.input' + id).click();
        },
        addMultipleImg(el) {
            const files = el.target.files;
            Array.from(files).forEach(file => this.addImg(file));
        },
        addImg(el) {
            if (!el.type.match('image.*')) {
                Toast.fire({
                    icon: 'error',
                    text: 'خطأ في صيغة الملفات المدخلة . الرجاء إدخال الصور فقط'
                });
                return;
            }

            //let file = el.target.files[0];
            let reader = new FileReader();
            reader.onload = (e) => {
                //console.log('RESULT', reader.result)
                this.form.imgs.push(e.target.result)

            }
            reader.readAsDataURL(el);

        },
        trashImg(i) {
            this.form.imgs.splice(i, 1)
        },
        changeImg(el) {

            let file = el.target.files[0];
            var reader = new FileReader();
            reader.onloadend = () => {
                console.log('RESULT', reader.result)
                this.form.img = reader.result;
            }
            reader.readAsDataURL(file);

        },
        getAllCity() {
            axios.get(base_site + '/dashboard/country/city/' + this.country_id + '/all').then(({ data }) => {
                this.cities = data;
            })
        },
        getAllCategory() {
            axios.get(base_site + '/dashboard/categories/get/all').then(({ data }) => {
                this.categories = data;
            })
        },
        getAllUnits() {
            axios.get(base_site + '/dashboard/units/get/all').then(({ data }) => {
                this.units = data;
            })
        },
        getAllCurrancy() {
            axios.get(base_site + '/dashboard/currancies/get/all').then(({ data }) => {
                this.currancies = data;
            })
        },
        changeCity() {
            //console.log(e)
            axios.get(base_site + '/dashboard/city/region/' + this.form.city_id + '/all_list').then(({ data }) => {
                this.regions = data;
            })

        },
        changeCategory() {

            axios.get(base_site + '/dashboard/subcategories/' + this.form.category_id + '/fromCat').then(({ data }) => {
                this.subs = data;
            })
        },
        changUnit() {
            this.form.unit_id = this.unit.id
        },
        changCurrancy() {
            this.form.currancy_id = this.cur.id;
        },
        getOnePost(id) {
            axios.get(base_site + '/dashboard/posts/' + id + '/get').then(({ data }) => {
                this.form.fill(data);
                this.catgory = data.category;
                this.changeCategory();
                this.changeSubCat();
                this.changeCity()
            })
        },
        save() {
            this.form.put(base_site + '/dashboard/posts/' + this.post + '/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم التعديل بنجاح'
                }).then(function () {
                    location.href = base_site + '/dashboard/posts';
                });
            })
        },
    },
    props: ['post'],
    created() {

        this.getAllCity()
        this.getAllCategory()
        this.getAllUnits();
        this.getAllCurrancy();
        this.getOnePost(this.post);

    },
}
</script>

<style scoped lang="scss">
.city {
    &:after {
        content: "\f37f";
        font-family: FontAwesome;
    }
}
</style>