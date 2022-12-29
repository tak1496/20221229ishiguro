<template>
  <div class="container">
    <div class="product_card">
      <img v-bind:src="`img/${ this.$store.state.image }`" alt="" />
      <div class="product_content">
        <div class="product_name">{{ this.$store.state.product_name }}</div>
        <div class="product_price">￥{{ this.$store.state.price.toLocaleString() }}(税込)</div>
        <div>
          個数：<input type="number" v-model="quantity" />
        </div>
        <div class="cart">
          <span v-on:click="cart_in" class="cart_button">カートに入れる</span>
        </div>
      </div>
    </div>
    <div class="text1">{{ this.$store.state.text1 }}</div>
    <div class="text2">{{ this.$store.state.text2 }}</div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      product_id: this.$route.query.id,
      image: this.$store.state.image,
      quantity: 0,
    }
  },
  created() {
    this.$store.commit('productSet', this.product_id);
  },
  methods: {
    cart_in() {
      if (this.quantity == 0) {
        alert('個数が0です');
      } else if (!Number.isInteger(parseFloat(this.quantity))) {
        alert('個数が不適切です');
      } else if (this.quantity < 0) {
        alert('個数が不適切です');
      } else {
        const sendData = {
          product_id: this.product_id,
          product_name: this.$store.state.product_name,
          price: this.$store.state.price,
          image: this.$store.state.image,
          quantity: this.quantity
        };
        this.$store.commit('cartSet', sendData);
      }
    }
  }
};
</script>

<style scoped>
.container {
  width: 700px;
  margin: 0 auto;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.product_card {
  display: flex;
  justify-content: left;
  align-items: center;
  text-align: center;
}

.product_card img{
  width: 200px;
  height: 200px;
}

.product_card input[type=number] {
  width: 100px;
}

.product_content {
  padding-left: 20px;
}

.product_content div{
  padding-top: 10px;
  text-align: left;
}

.product_name {
  font-size:14pt;
}

.product_price {
  font-size: 22pt;
  font-weight: bold;
}

.cart_button {
  position:relative;
  top:20px;
  background: rgb(120, 187, 120);
  color: #fff;
  padding: 4px 20px;
  border-radius: 20px;
}

.cart_button:before {
    content: '';
    display: inline-block;
    width: 20px;
    height: 20px;
    background: url(/img/whitecart.png) no-repeat;
    background-size: contain;
    vertical-align: middle;
    padding-right: 10px;
}

.cart_button:hover {
  cursor: pointer;
}

.text1 {
  padding: 50px 0 20px 0;
  font-size: 20px;
  font-weight: bold;
}
</style>