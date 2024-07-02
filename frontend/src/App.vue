<script setup>
import { RouterLink, RouterView } from 'vue-router'

import Teste from './components/Teste.vue';
import Menu from './components/Menu.vue'
import Footer from './components/Footer.vue';
</script>

<template>

 <Menu /> 
  <router-view/>
 


</template>

<style>
@import url("@/assets/vendor/bootstrap/css/bootstrap.min.css");
@import url("@/assets/vendor/bootstrap-icons/bootstrap-icons.css");
@import url("@/assets/vendor/boxicons/css/boxicons.min.css");
@import url("@/assets/vendor/quill/quill.snow.css");
@import url("@/assets/vendor/quill/quill.bubble.css");
@import url("@/assets/vendor/remixicon/remixicon.css");
@import url("@/assets/vendor/simple-datatables/style.css");


@import url("@/assets/css/style.css");
</style>
