<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import TabelaProfissional from '@/components/TabelaProfissional.vue';

</script>

<template>
  <main id="main" class="main" >
   <TabelaProfissional/>
  </main>
</template>

<style>
#main {
  width: 73vw !important;
  margin: 8% 20%;
  padding: 0;
}
</style>
