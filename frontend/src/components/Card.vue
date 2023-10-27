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
      <h2 class="card-title">
        <s v-if="stock === 0">{{ title }}</s>
        <span v-else>{{ title }}</span>
      </h2>
      <!-- <p class="card-description">{{ description }}</p> -->
      <span class="card-price">¥{{ price }}</span>
      <div class="card-footer">
        <div v-if="$route.path !== '/Products'" class="quantity-selector">
          <button class="decrement-button" @click="decrementQuantity" :disabled="stock === 0">-</button>
          <span class="quantity-number">{{ quantity }}</span>
          <button class="increment-button" @click="incrementQuantity" :disabled="stock === 0">+</button>
        </div>
        <div style="display: flex; flex-direction: column;">
          <span class="sold-out" v-if="stock === 0">売り切れました</span>
          <div v-if="$route.path !== '/Products'">
            <button v-if="stock === 0" class="add-to-cart-button-disabled" disabled>カートに追加</button>
            <button v-else class="add-to-cart-button" @click="addToCart">カートに追加</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  

<style scoped>
.card {
  display: flex;
  flex-direction: row;
  border: 1px solid #ccc;
  background-color: #c41c4c;
  border-radius: 0.5rem;
  margin-bottom: 0.5rem;
  /* margin: 1rem; */
  overflow: hidden;
  /* max-width: 300px; */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s;
}

.card-image img {
  width: 10rem;
  height: 10rem;
  aspect-ratio: 1;
  height: auto;
}

.card-content {
  background-color: #ffffff;
  width: 20rem;
  padding: 1rem;
}

.card-title {
  font-size: 1rem;
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
  font-size: 1.4rem;
}

.add-to-cart-button {
  background-color: #419dff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.add-to-cart-button-disabled {
  background-color: #919191;
  color: #fff;
  border: none;
  border-radius: 4px;
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

.sold-out {
  color: #c41c4c;
}
</style>
  