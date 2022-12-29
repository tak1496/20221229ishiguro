<template>
  <div class="container">
    <h2>ショッピングカート</h2>
    <div class="grid_layout">
      <div class="grid1">
        <div v-for="(data, key) in cart" class="cart_list">
          <img v-bind:src="`img/${ data.image }`" alt="" />
          <div class="content1">
            <div>{{ data.product_name }}</div>
            <div>
              <a v-on:click="cart_del(key)" href="#">削除する</a>
            </div>
          </div>
          <div class="content2">
            <div>
              個数：<input type="number" v-on:change="quantity_check(key)" v-model="cart[key].quantity" />
              ￥{{ data.price.toLocaleString() }}(税込)
            </div>
          </div>
        </div>
      </div>
      <div class="grid2">
        <div class="total_container">
          <div class="total">合計：￥{{ total.toLocaleString() }} 税込</div>
          <div>
            <span v-on:click="order" class="order_button">注文する</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cart: this.$store.state.cart,
      total: 0
    }
  },
  created() {
    if (!this.$auth.loggedIn) {
      this.$router.push("/");
    } else {
      this.cart_total();
    }
  },
  methods: {
    cart_del(index) {
      let flg = window.confirm('カートを削除しますか？');
      if (!flg) { return }
      this.cart.splice(index, 1);
      this.cart_total();
    },
    cart_total() {
      this.total = this.cart.reduce(function (sum, element) {
        return sum + (element.price * element.quantity);
      }, 0);
    },
    quantity_check(index) {
      if (this.cart[index].quantity == 0) {
        alert('個数が0です');
      } else if (!Number.isInteger(parseFloat(this.cart[index].quantity))) {
        alert('個数が不適切です');
      } else if (this.cart[index].quantity < 0) {
        alert('個数が不適切です');
      }
      this.cart_total();
    },
    order() {
      let err = '';
      let count = 0;
      let sendData = [];
      this.cart.forEach(data => {
        if (err == '') {
          if (data.quantity == 0) {
            err = '個数が0です';
          } else if (!Number.isInteger(parseFloat(data.quantity))) {
            err = '個数が不適切です';
          } else if (data.quantity < 0) {
            err = '個数が不適切です';
          } else {
            count += data.quantity;
          }
          let value = {
            user_id: this.$store.state.user_id,
            product_id: data.product_id,
            quantity: data.quantity,
            price: data.price,
            order: 'aaaaaaaaaaaaa'
          };
          sendData.push(value);
        }
      });

      if (count == 0) {
        alert('カートは空です');
        return;
      }

      if (err != '') {
        alert(err);
        return;
      }

      let flg = window.confirm('注文を確定します');
      if (!flg) { return }
      this.$store.dispatch('addOrder', sendData);
      this.$store.state.cart = [];
      this.$router.push('/thanks');
    }
  }
}
</script>
<style scoped>
a {
  text-decoration: none;
}

.container {
  padding-bottom: 200px;
}

.grid_layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
}

.grid2 {
  padding-left: 40px;
}

.cart_list {
  display: flex;
  border-top: 1px solid #cdcdcd;
  border-bottom: 1px solid #cdcdcd;
  padding: 4px 0;
  width: 700px;
}

.cart_list img {
  width: 150px;
  height: 200px;
}

.cart_list input[type=number] {
  width: 60px;
}

.content1 div:nth-child(1){
  font-size:20px;
  padding: 50px 0 0 20px;
}

.content1 div:nth-child(2) {
  padding: 20px 0 0 20px;
}

.content2 div {
  padding: 50px 0 0 150px;
}

.total {
  font-size: 24px;
  font-weight: bold;
}

.order_button {
  position: relative;
  top: 20px;
  background: rgb(120, 187, 120);
  color: #fff;
  padding: 2px 50px;
  border-radius: 20px;
}

.order_button:hover {
  cursor: pointer;
}
</style>