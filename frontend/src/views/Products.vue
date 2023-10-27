<script>
import axios from "axios"
import Card from "../components/Card.vue"

export default {
    components: {
        Card,
    },
    data() {
        return {
            menus: [],
            extra: "",
        }
    },
    methods: {
        fetchMenu() {
            axios.get(import.meta.env.VITE_API_URL + '/menus')
                .then(response => {
                    this.menus = response.data
                })
                .catch(error => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.fetchMenu()
        this.extra = import.meta.env.VITE_EXTRA
    }
}
</script>

<template>
    <h1>メニュー</h1>
    <div>
        <Card v-for="menu in menus" :menuId="menu.menu_id" :title="menu.title" :price="menu.price" :stock="menu.stock"
            :description="menu.description" :imagePath="menu.description === 'drink' ? `${extra}/assets/thumbnails/${menu.menu_id}.png` : `${extra}/assets/thumbnails/${menu.menu_id}.jpg`" />
    </div>
</template>

<style scoped>
</style>
