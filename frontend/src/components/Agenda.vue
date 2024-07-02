<template>
  <main class="custom-google-agenda mb-5">
    <!-- Botões para selecionar visualização -->
    <div class="custom-view-buttons mt-5 pt-5">
      <button @click="viewMode = 'day'">Dia</button>
      <button @click="viewMode = 'week'">Semana</button>
    </div>

    <!-- Visualização por Dia -->
    <div v-if="viewMode === 'day'">
      <!-- Componente de Calendário -->
      <div class="custom-calendar">
        <h2>Selecione a data para agendar:</h2>
        <div class="custom-dates">
          <div class="custom-date" v-for="(date, index) in dates" :key="index" @click="selectDate(date)">
            <div class="custom-day">{{ formatDate(date, 'ddd') }}</div>
            <div class="custom-number">{{ formatDate(date, 'D') }}</div>
            <div class="custom-month">{{ formatDate(date, 'MMM') }}</div>
          </div>
        </div>
      </div>

      <!-- Tabela de Horários para o Dia Selecionado -->
      <div class="custom-schedule-table">
        <h2>Horários disponíveis em {{ formatDate(selectedDate, 'dddd, D MMMM') }}</h2>
        <table>
          <thead>
            <tr>
              <th>Hora</th>
              <th>Queicy de Carvalho</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(time, timeIndex) in times" :key="timeIndex">
              <td>{{ time }}</td>
              <td
                @click="toggleAppointment(timeIndex)"
                :class="{ 'custom-selected': isSelected(timeIndex), 'custom-unavailable': isUnavailable(timeIndex) }"
              ></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Visualização por Semana -->
    <div v-if="viewMode === 'week'" class="custom-schedule-table">
      <h2>Agendamento para a Semana</h2>
      <table>
        <thead>
          <tr>
            <th>Hora / Dia</th>
            <th v-for="(date, index) in dates" :key="index">{{ formatDate(date, 'ddd, D') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(time, timeIndex) in times" :key="timeIndex">
            <td>{{ time }}</td>
            <td
              v-for="(date, dateIndex) in dates"
              :key="dateIndex"
              :class="{ 'custom-selected': isAppointment(dateIndex, timeIndex), 'custom-unavailable': isUnavailable(timeIndex) }"
              @click="isUnavailable(timeIndex) ? null : selectDate(date); toggleAppointment(timeIndex)"
            >
              <span>{{ getAppointmentInfo(dateIndex, timeIndex) }}</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal para Confirmar Agendamento -->
    <appointment-modal
      v-if="selectedAppointment"
      :appointment="selectedAppointment"
      :professionais="professionais"
      :clientes="clientes"
      :servicos="servicos"
      @confirm="confirmAppointment"
      @cancel="cancelAppointment"
    />
  </main>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import AppointmentModal from './AppointmentModal.vue';

// Dados iniciais
const viewMode = ref('day');
const selectedDate = ref(new Date()); // Inicializa com a data atual
const selectedAppointments = ref([]);
const selectedAppointment = ref(null);
const professionais = ref([]);
const clientes = ref([]);
const servicos = ref([]);
const dates = ref([]);
const times = ref(['09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00']);

// Funções
const formatDate = (date, format) => {
  return new Date(date).toLocaleDateString('pt-BR', { [format]: format });
};

const selectDate = (date) => {
  selectedDate.value = date;
};

const toggleAppointment = (timeIndex) => {
  if (selectedDate.value) {
    const time = times.value[timeIndex];
    const appointment = { date: selectedDate.value, time: time, professional: '', client: '', services: [] };
    selectedAppointment.value = appointment;
  } else {
    alert('Selecione uma data primeiro.');
  }
};

const confirmAppointment = () => {
  selectedAppointments.value.push(selectedAppointment.value);
  selectedAppointment.value = null;

  axios.post('http://127.0.0.1:8000/api/agendamento', selectedAppointment.value)
    .then(response => {
      console.log('Agendamento confirmado:', response.data);
    })
    .catch(error => {
      console.error('Erro ao confirmar agendamento:', error);
    });
};

const cancelAppointment = () => {
  selectedAppointment.value = null;
};

const isSelected = (timeIndex) => {
  if (selectedDate.value) {
    const time = times.value[timeIndex];
    return selectedAppointments.value.some(a => a.date === selectedDate.value && a.time === time);
  }
  return false;
};

const isUnavailable = (timeIndex) => {
  return selectedDate.value && times.value[timeIndex] === '11:00';
};

const isAppointment = (dateIndex, timeIndex) => {
  const appointment = selectedAppointments.value.find(a => a.date === dates.value[dateIndex] && a.time === times.value[timeIndex]);
  return appointment !== undefined;
};

const getAppointmentInfo = (dateIndex, timeIndex) => {
  const appointment = selectedAppointments.value.find(a => a.date === dates.value[dateIndex] && a.time === times.value[timeIndex]);
  if (appointment) {
    return `${appointment.professional}, ${appointment.service}`;
  }
  return '';
};

// Busca de profissionais e serviços via Axios
axios.get('http://127.0.0.1:8000/api/profissional')
  .then(response => {
    professionais.value = response.data.data;
  })
  .catch(error => {
    console.error('Erro ao buscar profissionais:', error);
  });

axios.get('http://127.0.0.1:8000/api/servico')
  .then(response => {
    servicos.value = response.data.data;
  })
  .catch(error => {
    console.error('Erro ao buscar serviços:', error);
  });

axios.get('http://127.0.0.1:8000/api/cliente')
  .then(response => {
    clientes.value = response.data.data;
  })
  .catch(error => {
    console.error('Erro ao buscar clientes:', error);
  });

// Simulação de dados de datas disponíveis (substitua com dados reais do backend)
onMounted(() => {
  for (let i = 0; i < 7; i++) {
    const date = new Date();
    date.setDate(date.getDate() + i);
    dates.value.push(date);
  }
});
</script>

<style scoped>
/* Estilos CSS personalizados para evitar conflitos */

.delete-button {
  color: white;
  background-color: #e53935 !important; /* Cor vermelha */
  border: none;
  padding: 0.5rem 1rem;
  cursor: pointer;
}

.custom-view-buttons {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}

.custom-view-buttons button {
  margin-right: 10px;
  padding: 8px 16px;
  font-size: 16px;
  cursor: pointer;
  border: none;
  border-radius: 4px;
  background-color: #4CAF50;
  color: white;
}

.custom-view-buttons button:hover {
  background-color: #45a049;
}

.custom-calendar {
  margin-bottom: 20px;
}

.custom-dates {
  display: flex;
  justify-content: center; /* Centraliza os dias horizontalmente */
  flex-wrap: wrap;
}

.custom-date {
  cursor: pointer;
  width: calc(100% / 7); /* Divide em 7 colunas para uma semana */
  text-align: center;
  padding: 10px;
}

.custom-date:hover {
  background-color: #f0f0f0;
}

.custom-day {
  font-size: 12px;
  font-weight: bold;
}

.custom-number {
  font-size: 20px;
  font-weight: bold;
  margin-top: 5px;
}

.custom-month {
  font-size: 12px;
}

.custom-schedule-table {
  margin-top: 20px;
}

.custom-schedule-table table {
  width: 100%;
  border-collapse: collapse;
}

.custom-schedule-table th,
.custom-schedule-table td {
  border: 1px solid #ccc;
  padding: 10px;
  text-align: center;
}

.custom-schedule-table th {
  background-color: #f0f0f0;
  font-weight: bold;
}

.custom-schedule-table td {
  cursor: pointer;
}

.custom-selected {
  background-color: #00f308; /* Cor de fundo para horário selecionado */
  color: white;
}

.custom-unavailable {
  background-color: #ccc; /* Cor de fundo para horário indisponível */
  color: #666;
}

.custom-modal {
  width: 650px;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 3%;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  z-index: 999;
}

.custom-modal-content {
  max-width: 500px;
  margin: 0 auto;
}

.custom-modal-content h2 {
  margin-bottom: 10px;
}

.custom-modal-content label {
  display: block;
  margin-bottom: 5px;
}

.custom-modal-content input,
.custom-modal-content select {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.custom-modal-content .custom-buttons {
  text-align: center;
  margin-top: 10px;
}

.custom-modal-content button {
  padding: 10px 20px;
  margin-right: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  background-color: #4CAF50;
  color: white;
}

.custom-modal-content button:hover {
  background-color: #45a049;
}

@media (max-width: 768px) {
  .custom-view-buttons {
    flex-direction: column;
  }

  .custom-view-buttons button {
    margin-bottom: 10px;
  }
}
</style>
