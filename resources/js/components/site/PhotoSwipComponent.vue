<template>
    <div>
        <div class="paragraph">

            <div>
                <img v-for="(img, index) in images" @click="showPhotoSwipe(index)" :src="img" alt=""
                    class="img-thumbnail" :class="index == 0 ? 'w-100' : 'w-25'"
                    :style="index == 0 ? 'height:350px' : 'height:200px'" style="object-fit: cover;">

            </div>
        </div>

        <v-photoswipe :isOpen="isOpen" :items="items" :options="options" @close="hidePhotoSwipe"></v-photoswipe>
    </div>
</template>

<script>
import { PhotoSwipe, PhotoSwipeGallery } from 'v-photoswipe'
export default {
    name: "PhotoSwipComponent",
    components: {
        'v-photoswipe': PhotoSwipe,
        'v-photoswipe-gallery': PhotoSwipeGallery
    },
    data() {
        return {
            images: null,
            isOpen: false,
            isOpenGallery: false,
            options: {
                index: 0
            },
            optionsGallery: {},
            items: [

            ]
        }
    },
    props: ['imgs'],
    methods: {
        showPhotoSwipe(index) {
            this.isOpen = true
            this.$set(this.options, 'index', index)
        },
        hidePhotoSwipe() {
            this.isOpen = false
        }
    },
    created() {
        let img2 = new Image();

        this.images = JSON.parse(this.imgs)
        this.images.forEach((el) => {
            img2.src = el;
            this.items.push({
                src: el,
                w: img2.width,
                h: img2.height,
                title: ''
            })
        })
    }
}

</script>

<style scoped>
</style>