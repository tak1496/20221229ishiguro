<template>
  <div>
    <CommonHeader />
    <Nuxt />
    <Footer />
  </div>
</template>

<script>

import Footer from "@/components/footer.vue"; // footerをインポート
export default {
  components: {
    Footer
  }
};
</script>

<style>
Footer {
  position: fixed;
  /*←絶対位置*/
  bottom: 0;
  /*下に固定*/
}
</style>