<script>
export default {
  props: {
    menuId: Number,
    title: String,
    price: Number,
    stock: Number,
    description: String,
    imagePath: String,
  },
  data() {
    return {
      quantity: 1,
    };
  },
  methods: {
    incrementQuantity() {
      this.quantity++;
    },
    decrementQuantity() {
      if (this.quantity > 1) {
        this.quantity--;
      }
    },
    addToCart() {
      this.$emit('update-cart', this.menuId, this.quantity);
    }
  },
};
</script>

<template>
  <div class="card">
    <div class="card-image">
      <img :src="imagePath" alt="商品画像" />
    </div>
    <div class="card-content">
      <h3 class="card-title">{{ title }}</h3>
      <span v-if="stock === 0">在庫ないよ</span>
      <p class="card-description">{{ description }}</p>
      <div class="card-footer">
        <span class="card-price">¥{{ price }}</span>
        <div class="quantity-selector">
          <button class="decrement-button" @click="decrementQuantity">-</button>
          <span class="quantity-number">{{ quantity }}</span>
          <button class="increment-button" @click="incrementQuantity">+</button>
        </div>
      </div>
      <button class="add-to-cart-button" @click="addToCart">カートに追加</button>
    </div>
  </div>
</template>
  

<style scoped>
.card {
  border: 1px solid #ccc;
  background-color: #c41c4c;
  border-radius: 8px;
  margin: 16px;
  overflow: hidden;
  max-width: 300px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s;
}

.card-image img {
  width: 100%;
  height: auto;
}

.card-content {
  background-color: #ffffff;
  /* padding-left: 1rem;
  padding-right: 1rem; */
  padding: 1rem;
}

.card-title {
  font-size: 1.2rem;
  font-weight: bold;
  margin: 0;
}

.card-description {
  font-size: 1rem;
  margin: 8px 0;
}

.card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 12px;
}

.card-price {
  font-size: 1.5rem;
  font-weight: bold;
}

.add-to-cart-button {
  background-color: #419dff;
  color: #fff;
  border: none;
  border-radius: 4px;
  /* padding: 8px 16px; */
  ;
  margin-top: 1rem;
  cursor: pointer;
  transition: background-color 0.2s;
}

.decrement-button {
  background-color: #efefef;
  color: #c41c4c;
  border: none;
  border-radius: 4px;
  padding: 6px 12px;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.2s;
}

.increment-button {
  background-color: #efefef;
  color: #419dff;
  border: none;
  border-radius: 4px;
  padding: 6px 12px;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.2s;
}

.quantity-number {
  background-color: #ffffff;
  font-size: 1.5rem;
  width: 1.5rem;
  border: none;
  border-radius: 4px;
  margin: 2px 0px 2px 0px;
  transition: background-color 0.2s;
}

.quantity-selector {
  display: flex;
  background-color: #efefef;
  border-radius: 4px;
}
</style>
  