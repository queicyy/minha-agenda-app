<template>
    <div class="custom-modal">
        <div class="custom-modal-content">
            <!-- Formulário para criar um novo agendamento -->
            <form v-if="!appointmentCreated" @submit.prevent="submitForm">
                <h2>Criando atendimento</h2>
                <p>Data: {{ formatDate(appointment.date, 'dddd, D MMMM') }}</p>
                <p>Hora: {{ appointment.time }}</p>

                <label for="professional">Profissional:</label>
                <select v-model="profissional">
                    <option v-for="professional in professionais" :key="professional.id" :value="professional.id">
                        {{ professional.nome_profissional }}
                    </option>
                </select>

                <label for="client">Cliente:</label>
                <select v-model="cliente">
                    <option v-for="client in clientes" :key="client.id" :value="client.id">
                        {{ client.nome_completo }}
                    </option>
                </select>

                <label for="pagamento">Forma de pagamento:</label>
                <div class="row">
                    <div class="col-3">
                        <div class="form-check">
                            <label class="form-check-label" for="gridRadios1">Credito</label>
                            <input type="radio" name="gridRadios" id="gridRadios1" value="C" v-model="pagamento">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-check">
                            <label class="form-check-label" for="gridRadios2">Debito</label>
                            <input type="radio" name="gridRadios" id="gridRadios2" value="D" v-model="pagamento">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-check">
                            <label class="form-check-label" for="gridRadios3">Pix</label>
                            <input type="radio" name="gridRadios" id="gridRadios3" value="P" v-model="pagamento">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-check">
                            <label class="form-check-label" for="gridRadios4">Dinheiro</label>
                            <input type="radio" name="gridRadios" id="gridRadios4" value="Di" v-model="pagamento">
                        </div>
                    </div>
                </div>
                <input type="hidden" v-model="status_agenda" value="0">
                <input type="hidden" v-model="preco" value="0">

                <button type="submit">Gerar Agendamento</button>
            </form>

            <!-- Formulário para adicionar serviços ao agendamento -->
            <form v-if="appointmentCreated" @submit.prevent="submitServices">
                <label for="service">Serviço:</label>
                <div class="service-section">
                    <div v-for="(service, index) in appointment.services" :key="index" class="service-item row">
                        <div class="col-6">
                            <select v-model="service.servico_id" @change="calculateServiceValue(index)">
                                <option v-for="s in servicos" :key="s.id" :value="s.id">{{ s.tipo }}</option>
                            </select>
                        </div>
                        <div class="col-3">R$ {{ service.value }}</div>
                        <div class="col-3 service-actions">
                            <button class="delete-button" @click="removeService(index)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="total-section">
                        
                        <div class="col-12 text-end">Total: R$ {{ calculateTotal() }}</div>
                    </div>
                    <div class="add-service-section">
                        <button type="button" @click="addService">Adicionar serviço</button>
                        <button type="submit">Salvar serviços</button>
                    </div>
                </div>
            </form>

            <!-- Botões de controle -->
            <div class="custom-buttons">
                <button v-if="appointmentCreated" @click="confirmAppointment">Confirmar</button>
                <button @click="cancelAppointment">Cancelar</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        appointment: Object,
        professionais: Array,
        clientes: Array,
        servicos: Array
    },
    data() {
        return {
            appointmentId: null,
            appointmentCreated: false,
            cliente: '',
            profissional: '',
            pagamento: '',
            status_agenda: 0,
            preco: 0
        };
    },
    methods: {
        formatDate(date, format) {
            const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            const [month, day, year] = new Date(date).toLocaleDateString('en-US', options).split('/');
            return `${year}-${month}-${day}`;
        },
        async submitForm() {
            try {
                const formattedData = {
                    cliente_id: this.cliente,
                    profissional_id: this.profissional,
                    data: this.formatDate(this.appointment.date),
                    hora: this.appointment.time,
                    status: this.status_agenda,
                    pagamento: this.pagamento,
                    preco: this.preco
                };

                const response = await axios.post('http://127.0.0.1:8000/api/agendamento', formattedData);
                this.appointmentId = response.data.id; // Supondo que o ID do agendamento esteja na resposta
                this.appointmentCreated = true; // Altera o estado para permitir adicionar serviços
                this.appointment.services = []; // Limpa a lista de serviços para começar do zero
            } catch (error) {
                console.error('Erro ao criar agendamento:', error.response);
            }
        },
        calculateServiceValue(index) {
            const selectedService = this.appointment.services[index];
            const selectedServiceData = this.servicos.find(s => s.id === selectedService.servico_id);
            if (selectedServiceData) {
                selectedService.value = selectedServiceData.preco.replace('R$', '').trim(); // Define o valor do serviço selecionado
            }
        },
        calculateTotal() {
            let total = 0;
            this.appointment.services.forEach(service => {
                total += parseFloat(service.value);
            });
            return total.toFixed(2);
        },
        addService() {
            const newService = { servico_id: '', value: 0 }; // Ajustado para criar um novo serviço com servico_id vazio
            this.appointment.services.push(newService);
        },
        removeService(index) {
            this.appointment.services.splice(index, 1); // Remove o serviço pelo índice
        },
        async submitServices() {
            try {
              
                    const serviceData = {
                        agendamento_id: this.appointmentId,
                        servico_id: service.servico_id,
                        cliente_id: this.cliente,
                       
                    };
                    await axios.post('http://127.0.0.1:8000/api/cliente_servico', serviceData);
                    this.appointmentCreated = true;
                console.log('Serviços salvos com sucesso!');
            } catch (error) {
                console.error('Erro ao salvar serviços:', error.response);
            }
        },
        async confirmAppointment() {
            try {
                await axios.put(`http://127.0.0.1:8000/api/agendamento/${this.appointmentId}`, this.appointment);
                this.$emit('confirm'); // Emite um evento para confirmar o agendamento
            } catch (error) {
                console.error('Erro ao atualizar agendamento:', error.response);
            }
        },
        cancelAppointment() {
            this.$emit('cancel'); // Emite um evento para cancelar o agendamento
        }
    }
};
</script>

<style scoped>
/* Estilos para o modal */
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

.custom-modal-content .row {
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
}

.custom-modal-content .row .col-3 {
    flex: 0 0 calc(25% - 10px);
}

.custom-modal-content .custom-buttons {
    text-align: center;
    margin-top: 10px;
}

.custom-modal-content button {
    padding: 10px 20px;
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.custom-modal-content button:hover {
    background-color: #45a049;
}

.custom-modal-content .delete-button {
    background-color: red;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    padding: 5px 10px;
    margin-left: 10px;
}

.custom-modal-content .delete-button:hover {
    background-color: darkred;
}
</style>