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
            axios.get("http://127.0.0.1:8000/api/order-status")
                .then(response => {
                    this.orderStatus = response.data
                })
                .catch(error => {
                    console.log(error);
                });
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
    <table>
        <thead>
            <tr>
                <th>テーブル番号</th>
                <th>メニュー</th>
                <th>数量</th>
            </tr>
        </thead>
        <tbody v-for="order in orderStatus">
            <tr v-for="(orderItems, tableNumber) in order" :key="tableNumber">
                <td>{{ tableNumber }}</td>
                <td>
                    <span v-for="(_, menu_id) in orderItems" :key="menu_id">
                        {{ menus[menu_id - 1]["title"] }}<br>
                    </span>
                </td>
                <td>
                    <span v-for="(quantity, menu_id) in orderItems" :key="menu_id">
                        {{ quantity }}<br>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
table {
    width: 100%;
    font-size: 25px;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th,
td {
    border: 1px solid #ccc;
    padding: 10px;
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
    margin-bottom: 5px;
}
</style>
