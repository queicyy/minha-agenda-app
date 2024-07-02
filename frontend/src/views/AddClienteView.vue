<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import FormClienteVue from '@/components/FormCliente.vue';
FormClienteVue


</script>

<template>
  <main id="main" class="main" >
   <FormClienteVue/>
  
  </main>
</template>

<style>
#main {
  width: 73vw !important;
  margin: 8% 20%;
  padding: 0;
}
</style>
