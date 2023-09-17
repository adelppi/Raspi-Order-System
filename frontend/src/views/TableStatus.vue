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
                <th>注文</th>
                <th>提供状況</th>
                <th>提供終了ボタン</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="tableNumber in 6">
                <td>{{ tableNumber }}</td>
                <td>
                    <span v-for="(quantity, menu_id) in orderStatus[tableNumber]">
                        {{ menus[menu_id - 1]["title"] }} x {{ quantity }}
                    </span>
                </td>
                <td v-if="orderStatus[tableNumber]"><span class="status-done">提供待ち</span></td>
                <td v-else><span class="status-not-done">空席/提供済み</span></td>
                <td v-if="orderStatus[tableNumber]"><button class="done-button"
                        @click="doneServing(tableNumber)">✔</button></td>
                <td v-else><button class="done-button-disabled" disabled>✔︎</button></td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
.status-done {
    border-radius: 8px;
    border: 3px solid transparent;
    padding: 1rem;
    font-size: 1em;
    font-weight: 500;
    font-family: inherit;
    border-color: #ecaa90;
    transition: border-color 0.25s;
}

.status-not-done {
    border-radius: 8px;
    border: 3px solid transparent;
    padding: 1rem;
    font-size: 1em;
    font-weight: 500;
    font-family: inherit;
    border-color: #90eca2;
    transition: border-color 0.25s;
}

.done-button {
    border-radius: 8px;
    border: 1px solid transparent;
    padding: 1rem;
    font-size: 1em;
    font-weight: 500;
    font-family: inherit;
    background-color: #90eca2;
    cursor: pointer;
    transition: border-color 0.25s;
}

.done-button-disabled {
    border-radius: 8px;
    border: 1px solid transparent;
    padding: 1rem;
    font-size: 1em;
    font-weight: 500;
    font-family: inherit;
    background-color: #c1c1c1;
    transition: border-color 0.25s;
}

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