<script>
import axios from "axios"

export default {
    data() {
        return {
            menus: [],
            updateQuantity: 0
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
        updateStock(menuId, updateQuantity) {
            axios.post(import.meta.env.VITE_API_URL + '/update-stock', {
                "menuId": menuId,
                "updateQuantity": updateQuantity
            })
        }
    },
    mounted() {
        this.fetchMenu()
    }
}
</script>

<template>
    <h2>在庫管理</h2>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>メニュー</th>
                <th>在庫</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="menu in menus">
                <td>{{ menu.menu_id }}</td>
                <td>{{ menu.title }}</td>
                <td>
                    <input type="number" v-model="menus[menu.menu_id - 1]['stock']" />
                    <button @click="updateStock(menu.menu_id, menus[menu.menu_id - 1]['stock'])">更新</button>
                </td>
            </tr>
            <button class="fixed-button" @click="fetchMenu()">
                <span style="font-size: 25px;">⟳</span>
            </button>
        </tbody>
    </table>
</template>

<style scoped>
.fixed-button {
    background-color: #f2f2f2;
    border-radius: 8px;
    position: fixed;
    width: 4rem;
    height: 4rem;
    bottom: 10%;
    left: 50%;
    transform: translate(-50%, 0);
}

.stock-input {
    width: 60px;
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    text-align: center;
    outline: none;
}

.stock-input:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
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

input {
    width: 4rem;
    padding: 3px 7px;
    border-radius: 5px;
    border: 2px solid #ccc;
}
</style>