<script>
import Agenda from '@/components/Agenda.vue'

export default {
  name: 'App',
  components: {
    Agenda
  }
}
</script>

<template>
  <main id="main" class="main">
    
    <Agenda />
  
  </main>
</template>

<style>
#main {
  width: 75vw !important;
  margin: 0 15%;
  padding: 0;
}


</style>
