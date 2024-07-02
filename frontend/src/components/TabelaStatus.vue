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
                    <th>Nº nota</th>
                    <th>Cliente</th>
                    <th>Profissional</th>
                    <th>Data</th>
                    <th>Horario</th>
                    <th>Status Pagamento</th>
                    <th>Data do pagamento</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="todo in todos" :key="todo.nota_Fiscal">
                    <td>{{ todo.nota_Fiscal }}</td>
                    <td>{{ todo.cliente }}</td>
                    <td>{{ todo.Profissional }}</td>
                    <td :class="getAppointmentDateClass(todo.status_pagamento, todo.data)">{{ todo.data }}</td>
                    <td>{{ todo.horas }}</td>
                    <td :class="getAppointmentStatusClass(todo.status_pagamento)">{{ todo.status_pagamento }}</td>
                    <td>{{ todo.data_pagamento }}</td>
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
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  
  const todos = ref([]);
  
  axios.get('http://127.0.0.1:8000/api/agendamento')
    .then((response) => {
      todos.value = response.data.data;
    });
  
  const getAppointmentDateClass = (status, date) => {
    const currentDate = new Date().toISOString().split('T')[0];
    // Obtém a data atual no formato 'yyyy-mm-dd'
  
    if (status === 'Pago' && date === currentDate) {
      return 'purple-color'; // Cor roxa para data igual à data atual com status "Pago"
    } else {
      return ''; // Caso padrão, sem classe de cor
    }
  };
  
  const getAppointmentStatusClass = (status) => {
    if (status === 'Não Pagou') {
      return 'no-color'; // Sem cor para status "Não Pagou"
    } else if (status === 'Pago') {
      return 'green-color'; // Cor verde para status "Pago"
    } else {
      return ''; // Caso padrão, sem classe de cor
    }
  };
  </script>
  
  <style scoped>
  .purple-color {
    background-color: purple; /* Cor roxa para data igual à data atual e status "Pago" */
  }
  
  .green-color {
    background-color: green; /* Cor verde para status "Pago" */
  }
  
  .no-color {
    /* Estilo para células sem cor */
  }
  </style>
  