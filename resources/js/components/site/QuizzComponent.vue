<template>
    <div>
        <div v-if="quizz" class="row justify-content-center">
            <div class="col-md-12 text-left">
                <h3 id="quizz" class="mt-2 mb-5"><i class="fa fa-circle t-orange small"></i> <span>{{ cat.name }}</span>
                </h3>
                <button v-if="btn" @click="startQuizz" class="btn btn-sm btn-outline-secondary">إضغط لبدأ
                    المسابقة</button>
            </div>
            <div class="col-md-12">
                <span class="text-danger" v-if="asks.length > 0">النتيجة :{{ win }} %</span>
                <div class="row">
                    <div class="col-md-12 text-left" v-if="!btn">
                        <h4><span class="d-inline-block p-2 rounded border-bd">{{ order + 1 }}</span> <span
                                class="d-inline-block">السؤال {{ order + 1 }}/ {{ asks.length }}</span></h4>
                    </div>
                    <div class="col-md-12 text-left" v-if="!btn">
                        <h4><i class="fa fa-circle t-orange small"></i> {{ asks[order].ask }} ؟</h4>
                    </div>
                    <div class="col-md-6 text-left">

                        <ol class="">
                            <li class=" d-block" v-for="(ans, index) in answers" v-bind:key="index">
                                <div class="form-check mt-3">
                                    <span class="mr-4 ff-digital f-s-15">{{ index + 1 }}</span>
                                    <input class="form-check-input answer" type="radio" v-model="answer" :value="index">
                                    <label class="form-check-label">
                                        {{ ans.answer }}
                                    </label>
                                </div>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-2 text-center" v-if="right">
                        <span class="rounded border-green d-inline-block text-center p-3 w-75  mt-3"><i
                                class="fa fa-check f-s-25"></i></span>
                    </div>
                    <div class="col-md-2 text-center" v-if="wrong">
                        <span class="rounded border-red d-inline-block text-center p-3 w-75  mt-3"><i
                                class="fa fa-times f-s-25"></i></span>
                    </div>
                    <div class="col-md-4 text-center" :class="!right && !wrong ? 'offset-2' : ''" v-if="!btn">
                        <span class="t-green">الوقت المتبقي للإجابة</span><br>
                        <span
                            class="rounded border-bd t-orange d-inline-block text-center p-3 w-25  mt-3 ff-digital f-s-30">{{ time }}</span>

                    </div>
                </div>
            </div>
            <div class="col-sm-8 ">
                <div class="text-left mt-3">
                    <button v-if="time != 0 && btn_ok" class="btn-sm btn-success w-25 p-2 ml-5"
                        @click="finish">نعم</button>
                </div>
            </div>
            <div class="col-sm-4" v-if="!btn">
                <div class="mt-3">
                    <button class="btn btn-sm  w-50 p-2 ml-5"
                        :class="!next_btn || order == asks.length - 1 ? 'btn-secondary disabled' : 'btn-success'"
                        :disabled="!next_btn || order == asks.length - 1" @click="nextAsk">السؤال التالي
                    </button>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="col-md-12 text-center">
                <h3 class="mt-2">لقد حققت نتيجة</h3>
                <h3><span class="rounded border-bd d-inline-block p-3">{{ win }} %</span></h3>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "QuizzComponent",
    data() {
        return {
            quizz: true,
            right: false,
            wrong: false,
            btn: true,
            asks: [],
            askNum: 0,
            cat: '',
            ask: null,
            answers: null,
            order: 0,
            answer: 0,
            time: 1,
            interval: null,
            btn_ok: false,
            next_btn: false,
            okanswer: 0,
            win: 0,
        }
    },
    props: ['id'],
    methods: {
        nextAsk() {
            this.next_btn = false,
                this.answer = 0;
            this.order++;
            $('.selected-box,.selected-box-right').removeClass('selected-box ')
            $('.selected-box,.selected-box-right').removeClass('selected-box-right ')
            this.wrong = false;
            this.right = false
            this.startQuizz()
        },
        finish() {

            clearInterval(this.interval)
            this.selectedRight();

            this.btn_ok = false;

            let r = this.answers[this.answer].right;
            if (r == 1) {
                this.right = true;
                this.okanswer++;
            } else {
                this.wrong = true;
            }
            if (this.okanswer != 0) {
                this.win = ((this.okanswer / this.asks.length) * 100).toFixed(2);
            }
        },

        selectedRight() {
            //selected-box-right
            setTimeout(() => {
                $('input.answer').each((i, el) => {

                    if (this.answers[i].right == 1) {
                        $($('input.answer')[i]).parent().parent().addClass('selected-box-right')
                    }
                    if (this.order == this.asks.length - 1) {
                        this.quizz = false;
                    }
                    this.next_btn = true;
                });

            }, 1000)
        },
        createdQuizz() {
            //this.btn=false;
            axios.get(base_site + '/quizz/' + this.id + '/asks').then(({ data }) => {
                this.asks = data.asks15;
                this.cat = data;
                this.askNum = this.asks.length;
            })
        },
        startQuizz() {
            this.btn = false;
            this.ask = this.asks[this.order];
            this.getAnswers(this.ask.id);
        },
        getAnswers(id) {
            axios.post(base_site + '/answers/' + id + '/getanswers').then(({ data }) => {
                this.answers = data;
                this.time = (this.asks[this.order].time)
                this.minTime()
                this.btn_ok = true;
            })
        },
        minTime() {
            this.interval = setInterval(() => {
                if (this.time == 0) {
                    this.btn_ok = false;
                    this.finish()
                    //this.getRightAnswer()
                } else {
                    this.time--;
                }

            }, 1000)
        }
    },
    created() {
        this.createdQuizz()


    },
    mounted() {

    },
    watch: {
        answer: function () {
            // alert('');
            $('input[value="' + this.answer + '"]').parent().parent().addClass('selected-box').siblings().removeClass('selected-box')
        },

    }
}


</script>

<style scoped>
</style>