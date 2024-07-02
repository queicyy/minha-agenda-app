<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import TabelaCliente from '@/components/TabelaCliente.vue';

</script>

<template>
  <main id="main" class="main" >
   <TabelaCliente/>
  </main>
</template>

<style>
#main {
  width: 73vw !important;
  margin: 8% 20%;
  padding: 0;
}
</style>
