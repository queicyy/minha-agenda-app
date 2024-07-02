<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';


const todos= ref();

axios.get('http://127.0.0.1:8000/api/profissional')
.then((response)=>{
  
  todos.value = response.data.data;
  
})

</script>

<template>
 
    <div class="pagetitle">
        <h1>Data Tables</h1>
       
      </div><!-- End Page Title -->
  
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Datatables</h5>
                
  
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th> Nome</th>
                      <th>Telefone</th>
                      <th>E-mail</th>
                  
                    
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="todo in todos" :key="todo.id">
                      <td>{{todo.nome_profissional}}</td>
                      <td>{{todo.telefone}}</td>
                      <td>{{todo.email}}</td>
                    
                      
                      
                    </tr>
                  </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
  
</template>


<style>
#main {
  width: 75vw !important;
  margin: 0 15%;
  padding: 0;
}
</style>
