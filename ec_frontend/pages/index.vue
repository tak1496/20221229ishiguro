<template>
  <div class="container">

    <div class="top_image">
      <div class="top_image_ttl">
        <div>New Arrivals</div>
        <div>for BOYS & GIRLS</div>
      </div>
    </div>
    
    <section>
      <h1 class="products_ttl">Products</h1>
      <div class="products_grid">
      
        <div v-for="(data, key) in this.$store.state.product_list" v-on:click="product(data.id)" class="product_card">
          <img v-bind:src="`img/${ data.image }`" alt="" />
          <div>{{ data.name }}</div>
          <div>￥{{ data.price }}(税込)</div>
        </div>
      
      </div>
    </section>

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
      page_current: this.$store.state.page_current,
    }
  },
  created() {
    if (this.$auth.loggedIn && this.$store.state.user_id == null) {
      const sendData = {
        email: this.$auth.user.email
      }
      this.$store.commit('search_user', sendData);
    }

    this.$store.commit('productList', 1);
  },
  methods: {
    page(value) {
      this.page_current = value;
      this.$store.commit('productList', value);
    },
    page_next() {
      let value
      if (this.page_current != this.$store.state.page) {
        value = this.page_current + 1;
      } else {
        value = this.page_current;
      }
      this.page_current = value;
      this.$store.commit('productList', value);
    },
    product(value) {
      this.$router.push({ path: '/product', query: { id: value } });
    },
  }
}
</script>

<style>
h1 {
  font-size: 30px;
  padding: 10px 0;
}

.container {
  width: 1000px;
  margin: 0 auto;
}

.top_image {
  margin: 0 auto;
  position: relative;
  background-image: url(/img/sandal.jpg);
  background-repeat: no-repeat;
  background-position: center top;
  background-size: contain;
  width: 1000px;
  height: 680px;
}

.top_image_ttl {
  position: absolute;
  top: 50%;
  left: 70%;
  transform: translate(-50%, -50%);
}

.top_image_ttl div:nth-child(1) {
    font-size: 40px;
    padding: 0;
}

.top_image_ttl div:nth-child(2) {
  font-size: 20px;
  padding: 0;
}

.products_ttl {
  text-align: center;
}

.products_grid {
  justify-content: space-between;
  display: grid;
  gap: 0px;
  grid-template-columns: repeat(4, minmax(25%,1fr) );
  margin-top: 0%;
  margin-bottom: 50px;
  text-align: center;
}

.product_card {
  width: 95%;
  padding-bottom: 10px;
}

.product_card:hover {
  cursor: pointer;
}

.product_card img{
  width: 100%;
  height: 20vh;
  object-fit: cover;
}

.product_card div {
  text-align: left;
}

li {
  list-style: none;
}

.section_pagination {
  padding-bottom: 100px;
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

.pagination span:hover{
  cursor: pointer;
  background-color: green;
  color: #000;
  border: 1px solid green;
  color: #fff;
  transition: .5s;
}
</style>