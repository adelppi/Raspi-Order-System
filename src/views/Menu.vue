<template>
    <h1>これはMenu.vueです</h1>
    <Card />
</template>

<style scoped>
h1 {
    font-size: 100px;
}
</style>

<script>
import Card from '../components/Card.vue'

export default {
    components: {
        Card
    },
}
</script>