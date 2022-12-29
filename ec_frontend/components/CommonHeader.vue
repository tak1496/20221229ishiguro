<template>
  <header>
    <h1 v-on:click="home" class="title">Trace</h1>
    <nav class="nav">
      <ul class="menu-group">
        <li class="menu-item" v-if="$auth.loggedIn">Name：{{ $auth.user.name }}</li>
        <li v-on:click="cart" class="menu-item">
          <img src="/img/cart.png" class="img_icon" />
        </li>
        <li v-on:click="history" class="menu-item">
          <img src="/img/user.png" class="img_icon" />
        </li>
        <li v-if="$auth.loggedIn" @click="logout" class="menu-item">
          <img src="/img/logout.png" class="img_icon" />
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  methods: {
    async logout() {
      let flg = window.confirm('ログアウトします');
      if (!flg) { return }
      try {
        this.$store.state.user_id = null;
        this.$store.state.cart = [];
        await this.$auth.logout();
        this.$router.push("/");
      } catch (error) {
        console.log(error);
      }
    },
    home() {
      this.$router.push("/");
    },
    cart() {
      if (this.$auth.loggedIn) {
        this.$router.push("/cart");
      } else {
        this.$router.push({ path: '/login', query: { page: 'cart' } });
      }
    },
    history() {
      if (this.$auth.loggedIn) {
        this.$router.push("/history");
      } else {
        this.$router.push({ path: '/login', query: { page: 'history' } });
      }
    },
  },
};
</script>

<style scoped>
h1 {
  font-size:30px;
}

header {
  display: flex;
  height: 50px;
  padding: 0 50px;
  margin-bottom: 10px;
  align-items: center;
}

.title {
  margin-right: auto;
}

.title:hover {
  cursor: pointer;
}

.menu-item {
  list-style: none;
  display: inline-block;
  padding: 10px;
}

.menu-item a {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.img_icon {
  width: 20px;
  height: 20px;
  cursor: pointer;
}
</style>