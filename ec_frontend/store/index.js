import Vuex from 'vuex'

const createStore = () => {
  return new Vuex.Store({
    state: {
      user_id: null,
      user_name: null,
      cart: [],
      product_list: [],
      page: 0,
      page_current: 1,
      product_name: null,
      price: 0,
      image: null,
      product_text1: '',
      product_text2: '',
      order_list: []
    },
    mutations: {
      setUser(state, value) {
        state.user_id = value.id;
        state.user_name = value.name;
      },

      async search_user(state, sendData) {
        await this.$axios.post("http://127.0.0.1:8000/api/auth/search", sendData)
          .then(result => {
            state.user_id = result.data.data.id;
            state.user_name = result.data.data.name;
        });
      },

      /*
      async productCount(state) {
        await this.$axios.get("http://127.0.0.1:8000/api/product/product_count")
          .then(result => {
            state.page = Math.ceil(result.data.data / 8);
        });
      },
      */
      
      async productList(state, value) {
        await this.$axios.get("http://127.0.0.1:8000/api/product?page="+ value)
          .then(result => {
            state.page_current = value;
            state.product_list = result.data.data.data;
            state.page = Math.ceil(result.data.data.total / 8);
        });
      },

      async productSet(state, value) {
        await this.$axios.get("http://127.0.0.1:8000/api/product/"+ value)
          .then(result => {
            state.product_list = result.data.data;
            state.product_name = state.product_list[0].name;
            state.price = state.product_list[0].price;
            state.image = state.product_list[0].image;
            state.text1 = state.product_list[0].text1;
            state.text2 = state.product_list[0].text2;
        });
      },

      cartSet(state, sendData) {
        state.cart.push({ product_id: sendData.product_id, product_name: sendData.product_name, price: sendData.price, image:sendData.image, quantity: sendData.quantity });
        alert('カートに追加しました');
        this.$router.push({ path: '/', query: { page: state.page_current } });
      },

      async historyList(state, sendData) {
        await this.$axios.post("http://127.0.0.1:8000/api/order/list", sendData)
          .then(result => {
            console.log(result);
            state.page_current = sendData.page;
            state.order_list = result.data.data.data;
            state.page = Math.ceil(result.data.data.total / 8);
        });
      },

    },
    actions: {
      async register(state, sendData) {
        try {
          await this.$axios.post("http://localhost:8000/api/auth/register", sendData)
            .then(result => {
              this.$auth.loginWith("laravelJWT", {
                data: {
                  email: sendData.email,
                  password: sendData.password,
                },
              });
              let value = {
                user_id: result.data.data.id,
                user_name: result.data.data.name,
              }
              state.commit('setUser', value);
              alert('新規登録しました');
            })
        } catch {
          alert("メールアドレスがすでに登録されています");
        }
      },

      async addOrder(state, sendData) {
        await this.$axios.post("http://127.0.0.1:8000/api/order", sendData)
      },

    }
  })
}

export default createStore