<template>
    <div v-swiper:mySwiper="swiperOption">
        <div class="swiper-wrapper">
            <div class="swiper-slide" :key="banner" v-for="banner in banners">
                <img :src="banner">
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide, directive } from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'

export default {
    data() {
        return {
            banners: ['https://natureconservancy-h.assetsadobe.com/is/image/content/dam/tnc/nature/en/photos/Central_ID_River.jpg?crop=196,0,2607,1434&wid=4000&hei=2200&scl=0.6518181818181819', 'https://natureconservancy-h.assetsadobe.com/is/image/content/dam/tnc/nature/en/photos/Central_ID_River.jpg?crop=196,0,2607,1434&wid=4000&hei=2200&scl=0.6518181818181819', 'https://natureconservancy-h.assetsadobe.com/is/image/content/dam/tnc/nature/en/photos/Central_ID_River.jpg?crop=196,0,2607,1434&wid=4000&hei=2200&scl=0.6518181818181819'],
            swiperOption: {
                pagination: {
                    el: '.swiper-pagination'
                },
                // ...
            }
        }
    },
    mounted() {
        console.log('Current Swiper instance object', this.mySwiper)
        this.mySwiper.slideTo(3, 1000, false)
    }
}
</script>