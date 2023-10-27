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
      <div class="card-footer">
        <span class="card-price">¥{{ price }}</span>
      </div>
      <span class="sold-out" v-if="stock === 0">売り切れました</span>
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
  padding: 1rem 3rem 1rem 3rem;
}

.card-title {
  font-size: 1.5rem;
  font-weight: bold;
  margin: 0;
}

.card-footer {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 12px;
}

.card-price {
  font-size: 1.5rem;
  font-weight: bold;
}

.sold-out {
  color: #c41c4c;
}
</style>
  