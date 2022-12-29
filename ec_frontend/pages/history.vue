<template>
  <div class="container">
    <div class="layout">
      <h2 class="title">購入履歴</h2>

      <div v-for="(data, key) in this.$store.state.order_list" class="history_list">
        <img v-bind:src="`img/${ data.products.image }`" alt="" />
        <table class="history_tbl">
          <tr>
            <td colspan="4" class="order_number">注文番号：{{ data.order }}</td>
          </tr>
          <tr>
            <td class="product_name">{{ data.products.name }}</td>
            <td class="order_content">{{ data.created_at | date }}</td>
            <td class="order_content">合計{{ data.quantity }}個</td>
            <td class="order_content">￥{{ data.price.toLocaleString() }}個(税込)</td>
          </tr>
          <tr>
            <td colspan="4" class="order_number">
              <span v-on:click="product(data.product_id)" class="repurchase">もう一度購入する</span>
            </td>
          </tr>
        </table>
      </div>
    </div>

    <section class="section_pagination">
      <ul class="pagination">
        <li v-for="(data, key) in this.$store.state.page">
          <span v-if="(key + 1) == page_current" v-on:click="page(key+1)" class="pagination_current">{{ key+1 }}</span>
          <span v-else v-on:click="page(key+1)">{{ key+1 }}</span>
        </li>
        <li>
          <span v-on:click="page_next()">次へ</span>
        </li>
      </ul>
    </section>

  </div>
</template>

<script>
export default {
  data() {
    return {
      user_id: this.$store.state.user_id,
      page_current: this.$store.state.page_current,
    }
  },
  created() {
    if (!this.$auth.loggedIn) {
      this.$router.push("/");
    }

    const sendData = {
      user_id: this.user_id,
      page: 1
    };
    this.$store.commit('historyList', sendData);
  },
  methods: {
    page(value) {
      this.page_current = value;
      const sendData = {
        user_id: this.user_id,
        page: value
      };
      this.$store.commit('historyList', sendData);
    },
    page_next() {
      let value;
      let chk;
      if (this.page_current != this.$store.state.page) {
        value = this.page_current + 1;
      } else {
        value = this.page_current;
      }
      this.page_current = value;
      const sendData = {
        user_id: this.user_id,
        page: value
      };
      this.$store.commit('historyList', sendData);
    },
    product(value) {
      this.$router.push({ path: '/product', query: { id: value } });
    }
  }
}
</script>

<style scoped>
.container {
  margin: 0 auto;
}

.layout {
  text-align: left;
}

.title {
  padding: 20px 0;
  font-size: 24px;
}

.history_list {
  display: flex;
  border-top: 1px solid #cdcdcd;
  border-bottom: 1px solid #cdcdcd;
  padding: 4px 0;
  width: 700px;
}

.history_list img {
  width: 100px;
  height: 120px;
}

.order_number{
  vertical-align: top;
  height: 25px;
  padding:10px 0 0 20px;
  font-size:14px;
  white-space: nowrap
}

.product_name {
  padding: 10px 0 0 20px;
  font-size: 18px;
  width:250px;
  font-weight: bold;
  white-space: nowrap
}

.order_content {
  padding: 0 10px;
  font-size: 14px;
  white-space: nowrap;
}

.repurchase {
  color: rgb(84, 84, 250);
}

.repurchase:hover {
  color: blue;
  cursor: pointer;
}

.section_pagination {

  padding: 50px 0 100px 0;
}

.pagination {
  display: flex;
  justify-content: center;
  font-family: 'M PLUS Rounded 1c', sans-serif;
}

.pagination a:hover {
  background: #93d8d0;
  color: #fff;
}

.pagination li {
  padding: 0 2px;
}

.pagination span {
  border-radius: 14px;
  display: inline-block;
  padding: 2px 5px;
  width: 35px;
  border: 1px solid rgb(120, 187, 120);
  font-size: 1rem;
  text-align: center;
}

.pagination_current {
  background-color: rgb(120, 187, 120);
  color: #fff;
}

.pagination span:hover {
  cursor: pointer;
  background-color: green;
  color: #000;
  border: 1px solid green;
  color: #fff;
  transition: .5s;
}
</style>