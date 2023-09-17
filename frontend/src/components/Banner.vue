<script>
export default {
    props: {
        itemTitle: String,
        quantity: Number
    },
    data() {
        return {
            showBanner: false
        }
    },
    mounted() {
        this.showBanner = true
        setTimeout(() => {
            this.showBanner = false
        }, 2000)
    }
}
</script>

<template>
    <div v-if="showBanner" class="banner">
        <h4>{{ itemTitle }}を{{ quantity }}つカートに追加しました</h4>
    </div>
</template>

<style scoped>
.banner {
    background-color: #90eca2;
    border-radius: 4px;
    border: 30px #000000;
    border: 1px solid #ccc;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    margin-top: 1rem;
    width: 20rem;
    transition: opacity 0.5s;
}
</style>