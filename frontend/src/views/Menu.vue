<script>
import { RouterLink } from "vue-router"
import axios from "axios"
import Card from "../components/Card.vue"

export default {
    components: {
        Card,
        RouterLink
    },
    data() {
        return {
            table_number: 0,
            menus: [
                // {
                //     title: "ラズパイ",
                //     price: 300,
                //     description: "食べられるラズパイです！",
                //     imagePath: "src/assets/pie.jpg"
                // },
                // {
                //     title: "クッキー",
                //     price: 200,
                //     description: "フランス人が焼きました。",
                //     imagePath: "src/assets/cookie.jpg"
                // },
                // {
                //     title: "ジュース",
                //     price: 150,
                //     description: "世界一おいしいジュース！",
                //     imagePath: "src/assets/juice.jpg"
                // },
            ],
            cart:
            {
                "1": 2,
                "2": 1,
                "3": 10,
            },
            order_items: [],
            showCartDialog: false
        }
    },
    methods: {
        parseCart() {
            for (let key in this.cart) {
                for (let i = 0; i < this.cart[key]; i++) {
                    this.order_items.push(Number(key))
                }
            }
        },
        fetchMenu() {
            axios.get('http://127.0.0.1:8000/api/menus')
                .then(response => {
                    this.menus = response.data
                })
                .catch(error => {
                    console.log(error);
                });
        },
        createOrder() {
            this.parseCart()
            axios.post('http://127.0.0.1:8000/api/create-order', {
                "table_number": this.table_number,
                "order_items": this.order_items
            })
        }
    },
    mounted() {
        this.fetchMenu()
        this.table_number = this.$route.params["table_number"]
    }
}
</script>

<template>
    <h1>メニュー</h1>
    <div v-if="showCartDialog" class="cart-dialog">
        <h2>カート</h2>
        <ul>
            <li v-for="(quantity, item) in cart">
                {{ item }} x {{ quantity }}
            </li>
        </ul>
        <RouterLink to="/Wait">
            <span @click="createOrder()" class="largeButton">
                注文する
            </span>
        </RouterLink>
    </div>
    <div class="content" :class="{ 'disable-events': showCartDialog }">
        <Card v-for="menu in menus" :title="menu.title" :price="menu.price" :description="menu.description"
            :imagePath="`../src/assets/${menu.menu_id}.jpg`" />
    </div>
    <div class="fixed-button">
        <button @click="showCartDialog = !showCartDialog">
            <span v-if="showCartDialog">
                カートを閉じる
            </span>
            <span v-else>
                カートを見る
            </span>
        </button>
    </div>
</template>

<style scoped>
.fixed-button {
    border-radius: 50%;
    position: fixed;
    bottom: 20px;
    right: 20px;
}

.cart-dialog {
    position: fixed;
    width: 80%;
    height: 60%;
    border: 1px solid #ccc;
    border-radius: 8px;
    /* max-width: 300px; */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: antiquewhite;
}

.disable-events {
    pointer-events: none;
}

.largeButton {
    padding: 18px 30px;
    color: white;
    background: linear-gradient(to bottom right, #f09e41, #e6488f, #4ab1d0);
    background-size: 150% auto;
    border-radius: 8px;
    border: 2.5px solid transparent;
    border-color: #ffffff;
    font-size: 35px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    cursor: pointer;
    transition: 0.5s;
}

.largeButton:hover {
    background-position: right;
    border-color: #646cff;
}
</style>