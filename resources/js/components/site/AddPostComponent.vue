<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background:#275879;color:#ffffff;">
                    <h3 class="text-left">إضافة إعلان جديد</h3>
                </div>
                <div class="card-body text-left">
                    <form @submit.prevent="form.id == '' || form.id == null ? save() : update()"
                        @keydown="form.onKeydown($event)">
                        <label class="d-block"><i class="fa fa-circle text-primary small"></i> إختر قسم</label>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <select v-model="catgory" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('category_id') }" @change="changeCategory">
                                    <option value="">إختر قسم رئيسي</option>
                                    <option v-for="category in categories" v-bind:key="category.id" :value="category">
                                        {{ category.name }}</option>
                                </select>
                                <has-error :form="form" field="category_id"></has-error>
                            </div>
                            <div class="col-md-4">
                                <select v-model="subcat" @change="changeSubCat" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('subcat_id') }">
                                    <option value="">إختر قسم فرعي</option>
                                    <option v-for="sub in subs" v-bind:key="sub.id" :value="sub">{{ sub.name }}</option>
                                </select>
                                <has-error :form="form" field="subcat_id"></has-error>
                            </div>

                            <div class="col-md-2">
                                <select v-model="city" class="city form-control" @change="changeCity()"
                                    :class="{ 'is-invalid': form.errors.has('city_id') }">
                                    <option value="">إختر مدينة</option>
                                    <option v-for="city in cities" v-bind:key="city.id" :value="city">{{ city.name }}
                                    </option>

                                </select>
                                <has-error :form="form" field="city_id"></has-error>
                            </div>
                            <div class="col-md-2">
                                <select v-model="form.region_id" class="city form-control"
                                    :class="{ 'is-invalid': form.errors.has('region_id') }">
                                    <option value="">إختر منطقة</option>
                                    <option v-for="region in regions" v-bind:key="region.id" :value="region.id">
                                        {{ region.name }}</option>

                                </select>
                                <has-error :form="form" field="region_id"></has-error>
                            </div>
                        </div>
                        <label class="d-block"><i class="fa fa-circle text-primary small"></i> تفاصيل الإعلان</label>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="text" v-model="form.title" class="form-control mb-2"
                                    placeholder="اكتب عنوان الإعلان ..."
                                    :class="{ 'is-invalid': form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                                <textarea v-model="form.description" class="form-control "
                                    placeholder="أكتب تفاصيل الإعلان ..." cols="30"
                                    :class="{ 'is-invalid': form.errors.has('description') }" rows="5"></textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                            <div v-if="type == 'سكني'" class="col-md-6">
                                <div class="row">

                                    <div class="col-md-6">
                                        <select v-model="form.bedroom" class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('bedroom') }">
                                            <option value="">عدد الغرف النوم</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>

                                            <option value="أكثر من 3">أكثر من 3</option>
                                        </select>
                                        <has-error :form="form" field="bedroom"></has-error>
                                    </div>
                                    <div class="col-md-6">
                                        <select v-model="form.bathroom" class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('bathroom') }">
                                            <option value="">عدد الحمامات</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="أكثر من 3">أكثر من 3</option>
                                        </select>
                                        <has-error :form="form" field="bathroom"></has-error>
                                    </div>
                                </div>
                                <div class="row mt-3">

                                    <div class="col-md-6">
                                        <select v-model="form.carage" class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('carage') }">
                                            <option value="">الكراج</option>
                                            <option value="تحتوي كراج">تحتوي كراج</option>
                                            <option value="لا تحتوي كراج">لا تحتوي كراج</option>
                                        </select>
                                        <has-error :form="form" field="carage"></has-error>
                                    </div>
                                    <div v-if="form.carage == 'تحتوي كراج'" class="col-md-6">
                                        <input v-model="form.num_car" type="number" placeholder="عدد السيارات"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('num_car') }">
                                        <has-error :form="form" field="num_car"></has-error>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="text" v-model="form.floor" placeholder="الطابق" name=""
                                            class="form-control">


                                    </div>
                                    <div class="col-md-6">
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
                                <div class="row mt-2" v-if="form.imgs.length > 0">
                                    <div v-for="(img, index) in form.imgs" v-bind:key="index" class="col-md-2">
                                        <img v-if="img.length > 50" class="img-thumbnail w-100" :src="img" alt="">
                                        <img v-else class="img-thumbnail w-100" :src="base_storage + '/posts/' + img"
                                            alt="">
                                        <button type="button" @click="trashImg(index)"
                                            class="btn btn-sm btn-block mt-2"><i class="fa fa-trash"></i></button>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label><i class="fa fa-circle text-primary"></i>معلومات التواصل</label>
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" v-model="form.name" placeholder="اسم المعلن" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="col-md-4">
                                <input type="text" v-model="form.phone" placeholder="رقم الاتصال" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('phone') }">
                                <has-error :form="form" field="phone"></has-error>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block">يمكن التواصل عن طريق</label>
                                <label class="d-block">

                                    <input v-model="form.contact" value=" إتصال مباشر" type="checkbox" name=""
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

                        <button :disabled="form.busy" type="submit" class="btn btn-primary"
                            style="background:#65aeca;">أضف الاعلان </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</template>

@php
        $publish_state_json = DB::select('Select default (active) from posts limit 1'); 
        $publish_state_string = json_encode($publish_state_json);
        $active = '';
        if(strpos($publish_state_string , "pending"))
        {
           $active = 'pending';
        }
        else
        {
            $active = 'active';
        }
        echo 'active:'.$active;
@endphp

<script>
export default {
    name: "SiteAddPostComponent",
    props: ['user'],
    data() {
        return {
            base_storage,
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
            form: new Form({
                id: '',
                title: '',
                description: '',
                price: '',
                currancy_id: '',
                area: '',
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
            this.form.subcat_id = this.subcat.id;
            this.type = this.subcat.type;
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
            axios.get(base_site + '/getCities').then(({ data }) => {
                this.cities = data;
            })
        },
        getAllCategory() {
            axios.get(base_site + '/getCategories').then(({ data }) => {
                this.categories = data;
            })
        },
        getAllUnits() {
            axios.get(base_site + '/getUnits').then(({ data }) => {
                this.units = data;
            })
        },
        getAllCurrancy() {
            axios.get(base_site + '/getCurrancies').then(({ data }) => {
                this.currancies = data;
            })
        },
        changeCity() {
            //console.log(e)
            this.form.city_id = this.city.id;
            this.regions = this.city.regions;
        },
        changeCategory() {
            this.form.category_id = this.catgory.id;
            // console.log(this.category.sub_cats)
            this.subs = this.catgory.sub_cats;
        },
        changUnit() {
            this.form.unit_id = this.unit.id
            //this.unit = unit;
        },
        changCurrancy() {
            this.form.currancy_id = this.currancy.id;
            //this.currancy = cur;
        },
        save() {
            this.form.post(base_site + '/savePost').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تمت الإضافة بنجاح'
                });
                this.catgory = '';
                this.subcat = '';
                this.city = '';
                this.unit = '';
                this.currancy = '';
                this.form.reset()

            }).then(function () {
                location.href = base_site + '/profile';
            }).catch(function (error) {
            });
        },
        update() {
            this.form.post(base_site + '/post/' + this.form.id + '/update').then(() => {
                Toast.fire({
                    icon: 'success',
                    text: 'تم التعديل بنجاح'
                });

            })
        },
    },
    created() {

        this.form.name = this.user;
        this.getAllCity()
        this.getAllCategory()
        this.getAllUnits();
        this.getAllCurrancy();
    },
    watch: {
        catgory: function (v) {
            this.subs = v.sub_cats
            this.subs.forEach((el) => {
                if (el.id == this.form.subcat_id) {
                    this.subcat = el;
                }
            })
        },
        city: function (v) {
            this.regions = v.regions;
        }
    }
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