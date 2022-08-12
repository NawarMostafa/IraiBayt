<template>
    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-md-10 text-left">

            <div class="img-thumbnail" v-if="info != null">
                <h4 class="alert"> <span class="info-box-icon t-bl"><i class="fa fa-brain"></i></span>
                    <span class="note text-muted">{{ note.name }}</span>
                </h4>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "InfoComponent",
    data() {
        return {
            info: null,
            note: '',
            index: 0,
        }
    },
    methods: {

        getInfo() {
            axios.get('Info').then(({ data }) => {
                this.info = data;

                this.index = 0;
                this.note = this.info[this.index];
                this.index++;
            })
        },
        changeInfo() {

            setInterval(() => {

                $('.note').fadeOut(1000, () => {
                    if (this.info != null) {
                        if (this.index == this.info.length) {
                            this.index = 0;
                            this.note = this.info[this.index];
                        } else {
                            this.note = this.info[this.index];
                            this.index++;
                        }

                    }
                }).fadeIn(1000)

            }, 10000)
        }
    },
    created() {
        this.getInfo()
        this.changeInfo()
    }
}
</script>

<style scoped>
</style>