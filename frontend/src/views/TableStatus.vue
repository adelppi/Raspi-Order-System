<script>
import axios from "axios"

export default {
    data() {
        return {
            menus: [],
            orderStatus: [],
            token: 0
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
        fetchOrderStatus() {
            axios.get(import.meta.env.VITE_API_URL + '/order-status-sorted')
                .then(response => {
                    this.orderStatus = response.data
                })
                .catch(error => {
                    console.log(error);
                });
        },
        doneServing(tableNumber) {
            axios.post(import.meta.env.VITE_API_URL + '/done-serving', {
                "table_number": tableNumber
            })
            this.deleteToken(tableNumber)
            this.fetchOrderStatus()
        },
        calculateTotal(tableNumber) {
            let totalPrice = 0
            for (let menuId in this.orderStatus[tableNumber]) {
                totalPrice += this.menus[menuId - 1]["price"] * this.orderStatus[tableNumber][menuId]
            }
            return totalPrice
        },
        createQR(tableNumber) {
            axios.post(import.meta.env.VITE_API_URL + '/create-qr', {
                "table_number": tableNumber
            })
                .then(response => {
                    this.token = response.data
                })
                .catch(error => {
                    console.log(error);
                });
        },
        deleteToken(tableNumber) {
            axios.post(import.meta.env.VITE_API_URL + '/delete-token', {
                "table_number": tableNumber
            })
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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <h2>注文状況</h2>
    <table>
        <thead>
            <tr>
                <th>テーブル<br>番号</th>
                <th>注文・金額</th>
                <th>提供状況</th>
                <th>提供終了<br>ボタン</th>
                <th>QR発行<br>ボタン</th>
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
                    <button class="done-button" @click="doneServing(tableNumber)">
                        <span class="material-symbols-outlined">
                            check
                        </span>
                    </button>
                </td>

                <td v-else>
                    <button class="done-button-disabled" disabled>
                        <span class="material-symbols-outlined">
                            check
                        </span>
                    </button>
                </td>

                <!-- <td v-if="orderStatus[tableNumber]"> -->
                    <button class="done-button" @click="createQR(tableNumber)">
                        <span class="material-symbols-outlined" style="color: #213547;">
                            qr_code_2
                        </span>
                    </button>
                <!-- </td> -->

                <!-- <td v-else>
                    <button class="done-button-disabled" disabled>
                        <span class="material-symbols-outlined">
                            qr_code_2
                        </span>
                    </button>
                </td> -->
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
    margin-left: auto;
    margin-right: auto;
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
    align-items: center;
    justify-content: center;
    background-color: #90eca2;
    cursor: pointer;
    margin-left: auto;
    margin-right: auto;
}

.done-button-disabled {
    background-color: #cbcbcb;
}

.price {
    text-align: right;
    font-weight: 600;
}

.material-symbols-outlined {
    font-size: 20px;
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