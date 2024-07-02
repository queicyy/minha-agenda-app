<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';

export default {
  setup() {
    const clientes = ref([]);
    const route = useRoute();
    const message = ref('');

    const fetchClientes = async () => {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/cliente');
        clientes.value = response.data.data;
      } catch (error) {
        console.error('Erro ao buscar clientes', error);
      }
    };

    onMounted(() => {
      fetchClientes();
      if (route.query.message) {
        message.value = route.query.message;
        setTimeout(() => {
          message.value = '';
        }, 10000);
      }
    });

    return {
      clientes,
      message
    };
  }
};
</script>

<template>
  <div>
    <div class="pagetitle">
      <h1>Clientes</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lista de Clientes</h5>

              <div v-if="message" class="alert alert-success mt-3">{{ message }}</div>
              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Aniversário</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="cliente in clientes" :key="cliente.id">
                    <td>{{ cliente.nome_completo }}</td>
                    <td>{{ cliente.telefone }}</td>
                    <td>{{ cliente.email }}</td>
                    <td>{{ cliente.aniversario }}</td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>