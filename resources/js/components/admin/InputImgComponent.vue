<template>
    <div class="form-group">
        <label for="">إختر صورة</label>
        <input type="file" @change="changeImg">
    </div>
</template>

<script>
export default {
    name: "InputImgComponent",
    data() {
        return {

        }
    },
    methods: {
        changeImg(el) {
            var file = el.files[0];
            var reader = new FileReader();
            reader.onloadend = function () {
                console.log('RESULT', reader.result)
            }
            reader.readAsDataURL(file);
        }
    }
}
</script>

<style scoped>
</style>