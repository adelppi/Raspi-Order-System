<script>
import axios from "axios"

export default {
    data() {
        return {
            menus: [],
            orderStatus: []
        }
    },
    methods: {
        fetchMenu() {
            axios.get('http://127.0.0.1:8000/api/menus')
                .then(response => {
                    this.menus = response.data
                })
                .catch(error => {
                    console.log(error);
                });
        },
        fetchOrderStatus() {
            axios.get("http://127.0.0.1:8000/api/order-status-sorted")
                .then(response => {
                    this.orderStatus = response.data
                })
                .catch(error => {
                    console.log(error);
                });
        },
        doneServing(tableNumber) {
            axios.get(`http://127.0.0.1:8000/api/${tableNumber}/done-serving`)
            this.fetchOrderStatus()
        },
        calculateTotal(tableNumber) {
            let totalPrice = 0
            for (let menuId in this.orderStatus[tableNumber]) {
                totalPrice += this.menus[menuId - 1]["price"] * this.orderStatus[tableNumber][menuId]
            }
            return totalPrice
        }
    },
    mounted() {
        this.fetchMenu()
        this.fetchOrderStatus()
        setInterval(() => {
            this.fetchOrderStatus();
        }, 2500);
    }
}
</script>

<template>
    <h2>注文状況</h2>
    <table>
        <thead>
            <tr>
                <th>テーブル<br>番号</th>
                <th>注文・金額</th>
                <th>提供状況</th>
                <th>提供終了<br>ボタン</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="tableNumber in 6">
                <td>{{ tableNumber }}</td>

                <td>
                    <span v-for="(quantity, menu_id) in orderStatus[tableNumber]" style="text-align: right;">
                        {{ menus[menu_id - 1]["title"] }} × {{ quantity }} <br>
                    </span>
                    <hr v-if="orderStatus[tableNumber]">
                    <span v-if="orderStatus[tableNumber]" class="price">
                        ¥{{ calculateTotal(tableNumber) }}
                    </span>
                </td>

                <td v-if="orderStatus[tableNumber]">
                    <span class="status-done">
                        <p>提供待ち</p>
                    </span>
                </td>

                <td v-else>
                    <span class="status-not-done">
                        <p>空席 or<br>提供済み</p>
                    </span>
                </td>

                <td v-if="orderStatus[tableNumber]">
                    <button class="done-button" @click="doneServing(tableNumber)">✔</button>
                </td>

                <td v-else>
                    <button class="done-button-disabled" disabled>✔︎</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
.status-done,
.status-not-done,
.done-button,
.done-button-disabled {
    width: 3rem;
    height: 2rem;
    display: flex;
    align-items: center;
    font-size: 10px;
    font-weight: 500;
    border-radius: 8px;
}

.status-done,
.status-not-done {
    /* height: 100%; */
    border: 1.25px solid transparent;
}

.status-done {
    border-color: #ecaa90;
}

.status-not-done {
    border-color: #90eca2;
}

.done-button,
.done-button-disabled {
    height: 2rem;
    width: 2rem;
    border: 1px solid transparent;
    font-size: 10px;
    background-color: #90eca2;
    cursor: pointer;
}

.done-button-disabled {
    background-color: #c1c1c1;
}

.price {
    text-align: right;
    font-weight: 600;
}

p {
    margin-left: auto;
    margin-right: auto;
}

table {
    width: 100%;
    font-size: 10px;
    border-collapse: collapse;
}

th,
td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

td span {
    display: block;
}

hr {
    height: 1px;
    background-color: #213547;
    width: 100%;
    border: none;
}
</style>