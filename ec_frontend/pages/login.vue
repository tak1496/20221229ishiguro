<template>
  <div class="container">

    <div class="layout">
      <validation-observer ref="obs" v-slot="ObserverProps">
        <form @submit.prevent="login">
          <h2>ログイン</h2>
          <div class="content1">会員のお客さま</div>
          <div  class="content2">メールアドレスとパスワードを入力して下さい</div>
          
          <div class="content3_box">
            <div class="content3">
              <validation-provider v-slot="ProviderProps" rules="required|email">
                <div class="error">{{ ProviderProps.errors[0] }}</div>
                <label>メールアドレス：</label>
                <input type="email" v-model="log_email" name="email" placeholder="email" required />
              </validation-provider>
            </div>
            
            <div class="content3">
              <validation-provider v-slot="ProviderProps" rules="required|min:6">
                <div class="error">{{ ProviderProps.errors[0] }}</div>
                <label>パスワード：</label>
                <input type="password" v-model="log_password" name="password" placeholder="password" required />
              </validation-provider>
            </div>
          </div>

          <div class="content4">
            <button type="submit" :disabled="ObserverProps.invalid || !ObserverProps.validated" class="login_btn">ログイン</button>
          </div>

        </form>
      </validation-observer>
    </div>

    <div class="layout">
      <validation-observer ref="obs" v-slot="ObserverProps">
        <form @submit.prevent="register">
          <h2>新規会員登録</h2>
          <div class="content1">初めてご利用の方・会員以外の方</div>
          <div class="content2">初めてご利用のお客様は、こちらから会員登録を行って下さい。</div>
    
          <div class="content3_box">
            <div class="content3">
              <validation-provider v-slot="ProviderProps" rules="required|email">
                <div class="error">{{ ProviderProps.errors[0] }}</div>
                <label>メールアドレス：</label>
                <input type="email" v-model="reg_email"  name="email" placeholder="email" required />
              </validation-provider>
            </div>
    
            <div class="content3">
              <validation-provider v-slot="ProviderProps" rules="required|min:6">
                <div class="error">{{ ProviderProps.errors[0] }}</div>
                <label>パスワード：</label>
                <input type="password" v-model="reg_password" name="password" placeholder="password" required />
              </validation-provider>
            </div>
      
            <div class="content3">
              <validation-provider v-slot="ProviderProps" rules="required|min:4">
                <div class="error">{{ ProviderProps.errors[0] }}</div>
                <label>お名前：</label>
                <input type="text" v-model="reg_name" name="name" placeholder="name" required />
              </validation-provider>
            </div>
          </div>

          <div class="content4">
            <button type="submit" :disabled="ObserverProps.invalid || !ObserverProps.validated" class="reg_btn">新規会員登録</button>
          </div>
    
        </form>
      </validation-observer>
    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      log_email: null,
      log_password: null,
      reg_email: null,
      reg_password: null,
      reg_name: null,
      page: this.$route.query.page,
    };
  },
  methods: {
    async login() {
      try {
        await this.$auth.loginWith("laravelJWT", {
          data: {
            email: this.log_email,
            password: this.log_password,
          },
        })
          .then(() => {
            const sendData = {
              email: this.log_email
            }
            this.$store.commit('search_user', sendData);
          })
        
      } catch {
        alert("メールアドレスまたはパスワードが間違っております");
      }
    },
    register() {
      const sendData = {
        name: this.reg_name,
        email: this.reg_email,
        password: this.reg_password,
      }
      this.$store.dispatch('register', sendData);
    }

  },
};
</script>

<style scoped>
h2 {
  font-size: 20px;
}

.container {
  position: absolute;
  display: flex;
  margin: 0 auto;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.layout {
  text-align:left;
  width: 400px;
}

.content1 {
  padding-top: 25px;
  padding-left: 10px;
  border-bottom: 2px solid #000;
  width: 360px;
}

.content2 {
  padding: 20px 0 20px 10px;
  font-size: 12px;
}

.content3_box {
  height: 110px;
}

.content3 {
  padding-left: 20px;
}

.content3 label {
  display: block;
  float: left;
  width: 120px;
  text-align: right;
  font-size: 14px;
  font-weight: bold;
}

.content3 input {
  border: 1px solid gray;
}
.content4 {
  text-align: center;
}

.button1 {
  padding-top: 40px;
  text-align: center;
}

.login_btn {
  background-color: #000;
  color: #fff;
  font-weight: bold;
  width: 200px;
}

.login_btn:hover {
  cursor: pointer;
}

.button2 {
  padding-top: 20px;
  text-align: center;
}

.reg_btn {
  background-color: rgb(120, 187, 120);
  border: 1px solid rgb(120, 187, 120);
  color: #fff;
  font-weight: bold;
  width: 200px;
}

.reg_btn:hover {
  cursor: pointer;
}

.error {
  text-align: center;
  color: red;
  font-weight: bold;
}
</style>