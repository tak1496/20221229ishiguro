<template>
  <div class="container">
    <h2>ありがとうございます。注文が確定されました。</h2>
    <p>注文内容と配送状況についてはEメールでお知らせをご確認ください。</p>
    <div class="order_box">
      <div>注文番号</div>
      <div>aaaaaaaaaa</div>
      <div>で承りました</div>
      <div>
        <span v-on:click="home" class="shopping_button">ショッピングを続ける</span>
      </div>
    </div>
  </div>
  
</template>

<script>
export default {
  methods: {
    home() {
      this.$router.push('/');
    }
  },
  created() {
    if (!this.$auth.loggedIn) {
      this.$router.push("/");
    }
  }
}
</script>

<style scoped>
h2 {
  font-size: 24px;
  padding: 20px 0;
}

p {
  font-size: 10pt;
  padding: 10px 0 40px 0;
}

.container {
  margin: 0 auto;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.order_box {
  margin: 0 auto;
  background-color: #ededed;
  width: 70%;
  padding: 10px 0 70px 0;
}

.order_box div {
  padding-top: 20px;
}

.order_box div:nth-child(1) {
  font-weight: bold;
}

.order_box div:nth-child(2) {
  font-weight: bold;
}

.shopping_button {
  position: relative;
  top: 20px;
  background: rgb(120, 187, 120);
  color: #fff;
  padding: 4px 50px;
  border-radius: 20px;
  font-weight: bold;
}
.shopping_button:hover {
  cursor: pointer;
}
</style>