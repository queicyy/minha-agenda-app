<script>
import axios from 'axios';

export default {
  data() {
    return {
      nome: '',
      telefone: '',
      email: '',
      aniversario: ''
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/cliente', {
          nome: this.nome,
          telefone: this.telefone,
          email: this.email,
          aniversario: this.aniversario
        });
        console.log('Resposta da API:', response.data);
        this.$router.push({ path: '/cliente', query: { message: 'Cliente adicionado com sucesso!' } });
      } catch (error) {
        console.error('Erro ao enviar os dados', error);
      }
    }
  }
};
</script>

<template>
    <div>
      <div class="pagetitle">
        <h1>Adicionar Cliente</h1>
      </div><!-- End Page Title -->
  
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Adicionar Cliente</h5>
                
                <form class="row g-3" @submit.prevent="submitForm">
                  <!-- Nome do cliente -->
                  <div class="col-md-12 mt-5 px-3">
                    <label for="validationDefault01" class="form-label">Nome Completo</label>
                    <input type="text" v-model="nome" class="form-control" id="validationDefault01" placeholder="Coloque seu nome completo" required>
                  </div>
                  
                  <!-- Contato do cliente -->
                  <div class="col-md-12 mt-5 px-3">
                    <label for="validationDefault02" class="form-label">Telefone/WhatsApp</label>
                    <input type="tel" v-model="telefone" class="form-control" id="validationDefault02" placeholder="(DD) 9 9999-9999" required>
                  </div>
                  
                  <!-- Email do cliente -->
                  <div class="col-md-12 mt-5 px-3">
                    <label for="validationDefault03" class="form-label">E-mail</label>
                    <input type="email" v-model="email" class="form-control" id="validationDefault03" placeholder="email@emai.com" required>
                  </div>
                  
                  <!-- Data de aniversário -->
                  <div class="col-md-12 mt-5 px-3">
                    <label for="validationDefault04" class="form-label">Data de Aniversário</label>
                    <input type="date" v-model="aniversario" class="form-control" id="validationDefault04">
                  </div>
                  
                  <div class="col-md-12 mt-5 px-3">
                    <button class="btn btn-primary" type="submit">Salvar</button>
                  </div>
                </form>
  
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </template>