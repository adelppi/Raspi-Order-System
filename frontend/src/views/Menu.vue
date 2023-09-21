<script>
import { RouterLink } from "vue-router"
import axios from "axios"
import Card from "../components/Card.vue"
import Banner from "../components/Banner.vue"

export default {
    components: {
        Card,
        Banner,
        RouterLink
    },
    data() {
        return {
            table_number: 0,
            menus: [],
            cart: {},
            order_items: [],
            showCartDialog: false,
            banners: []
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
        },
        // 子(Card.vue)から親(Menu.vue)へ変数の受け渡し
        updateCart(menuId, quantity) {
            if (menuId in this.cart) {
                this.cart[menuId] += quantity
            } else {
                this.cart[menuId] = quantity
            }
            this.banners.push(
                {
                    "itemTitle": this.menus[menuId - 1]["title"],
                    "quantity": quantity
                }
            )
        },
        removeItem(item) {
            delete (this.cart[item])
        },
        calculateTotal() {
            let totalPrice = 0
            for (let menuId in this.cart) {
                totalPrice += this.menus[menuId - 1]["price"] * this.cart[menuId]
            }
            return totalPrice
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
        <div v-if="Object.keys(cart).length">
            <h2>カート</h2>
            <table>
                <thead>
                    <tr>
                        <th>商品名</th>
                        <th>数量</th>
                        <th>価格</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(quantity, item) in cart" :key="item">
                        <td>
                            <button @click="removeItem(item)">削除</button>
                            {{ menus[item - 1]["title"] }}
                        </td>
                        <td>{{ quantity }}</td>
                        <td>¥{{ menus[item - 1]["price"] * quantity }}</td>
                    </tr>
                </tbody>
            </table>
            <p class="total">合計金額: ¥{{ calculateTotal() }}</p>
            <RouterLink to="/Wait">
                <span @click="createOrder()" class="order-button">
                    注文する
                </span>
            </RouterLink>
        </div>
        <div v-else>
            <h2>カートに何もないよ！</h2>
        </div>
    </div>
    <div v-if="showCartDialog" class="overlay" @click="showCartDialog = false"></div>

    <div class="banner-stack">
        <Banner v-for="banner in banners" :itemTitle="banner.itemTitle" :quantity="banner.quantity" />
    </div>
    <div :class="{ 'disable-events': showCartDialog }">
        <Card v-for="menu in menus" :menuId="menu.menu_id" :title="menu.title" :price="menu.price" :stock="menu.stock"
            :description="menu.description" :imagePath="`../src/assets/${menu.menu_id}.jpg`" @update-cart="updateCart" />
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
.banner-stack {
    display: flex;
    flex-direction: column-reverse;
    position: fixed;
    bottom: 10%;
    left: 50%;
    transform: translate(-50%, 0); 
}

.fixed-button {
    border-radius: 50%;
    position: fixed;
    bottom: 20px;
    right: 20px;
}

.order-button {
    background-color: #419dff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 1rem;
    margin-top: 1rem;
    cursor: pointer;
    transition: background-color 0.2s;
}

.cart-dialog {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    max-width: 400px;
    width: 90%;
}

.cart-dialog h2 {
    font-size: 1.5rem;
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 10px;
}

th {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}


.total {
    font-weight: bold;
    text-align: right;
}

.disable-events {
    pointer-events: none;
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9998;
    cursor: pointer;
    overflow: hidden;
    touch-action: none;
}
</style>
