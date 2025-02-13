<template>
  <div class="flex flex-col min-h-screen">
    <Header />
    <div class="flex flex-1">
      <Sidebar />
      <main class="flex-1 p-4">
        <router-view />
      </main>
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from './components/Header.vue';
// import Sidebar from './components/Sidebar.vue';
import Footer from './components/Footer.vue';

export default {
  name: 'App',
  components: {
    Header,
    // Sidebar,
    Footer,
  },
};
</script>

<style>
/* Burada gerekli stilleri ekleyebilirsiniz */
</style>