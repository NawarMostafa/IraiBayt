<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span class="d-block">جميع المقالات</span>
                        <span class="d-block"><a :href="base_site+'/dashboard/abouts/create'" class="btn btn-sm btn-secondary"><i class="fa fa-plus"></i></a></span>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>العنوان</th>
                            <th>المقالة</th>
                            <th>التحكم</th>
                        </tr>
                        <tr v-for="about in abouts.data">
                            <td>{{about.title}}</td>
                            <td v-html="about.body.substring(0,45)"></td>
                            <td>
                                <!--<a :href="base_site+'/dashboard/abouts/'+about.id+'/edit'" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>-->
                                <a :href="base_site+'/dashboard/abouts/'+about.id+'/edit'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                                <button @click="deleteabouts(about.id)" type="button" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash "></i></button>

                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <pagination :data="abouts" :limit="1" @pagination-change-page="getResults"></pagination>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

    export default {
        name: "AboutComponent",

        data(){
            return{

                abouts:{},
                base_site,
                q:'',
            }
        },
        methods:{
            getAllData(){
                axios.get(base_site+'/dashboard/abouts/get?q='+this.q).then(data=>{
                    this.abouts=data.data;
                })
            },
            getResults(page=1){
                axios.get(base_site+'/dashboard/abouts/get?q='+this.q+'&page='+page).then(data=>{
                    this.abouts=data.data;
                })
            },

            deleteabouts(id) {
                Swal.fire({
                    title: 'هل انت متأكد من عملية الحذف ؟',
                    text: "لن تستطيع التراجع عن بعد الحذف",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'تأكيد الحذف!',
                    cancelButtonText: 'إلغاء'
                }).then((result) => {
                    if (result.value) {
                        axios.delete(base_site + '/dashboard/abouts/' + id + '/delete').then(({data}) => {
                            Fire.$emit('DeleteCountry');
                            Swal.fire(
                                'حذف!',
                                'تم الحذف بنجاح .',
                                'success'
                            )
                            this.getAllData()
                        });

                    }
                })


            },
        },

        mounted(){
          this.getResults();
        },
        created(){
          this.getAllData();
        },

    }
</script> 

<style scoped>

</style>