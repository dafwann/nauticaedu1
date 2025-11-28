<template>
  <div id="app">
    <Layout />
  </div>
</template>

<script>
import Layout from './components/Layout.vue'

export default {
  name: 'App',
  components: {
    Layout
  }
}
</script>

<style>
/* GLOBAL STYLES */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin: 0; 
  padding: 0;
  background: #5BA6FA;
  background: linear-gradient(to bottom, #5BA6FA 0%, #004B85 69%, #144E75 100%);
  color: #004d40;
  min-height: 100vh;
}

#app {
  min-height: 100vh;
}
</style>