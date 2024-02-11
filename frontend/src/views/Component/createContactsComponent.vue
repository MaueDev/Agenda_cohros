<template>
    <div class="create-contacts-container">
    <div class="create-contacts-header">
        <div class="item-input-container" >
            <label> Nome </label>
            <input class="input" :class="{ 'error': saveClicked && contact.name === '' }" type="text" placeholder="Name" v-model="contact.name"/>
        </div>
        <div class="item-input-container" >
            <label> Email </label>
            <input class="input" :class="{ 'error': saveClicked && contact.email === '' }" type="text" placeholder="Email" v-model="contact.email"/>
        </div>
        <div class="item-input-container" >
            <label> Endereço </label>
            <input class="input" :class="{ 'error': saveClicked && contact.address === '' }" type="text" placeholder="Endereço" v-model="contact.address"/>
        </div>
        <div class="item-input-container">
            <label> Números de Telefones </label>
        
      </div>
    </div>
    <div class="phone-container">
        <div class="search-phone-container">
            <input class="input" @change="filteredPhones()" type="text" placeholder="Pesquisar" v-model="searchPhones"/>
            <button class="search-button" @click="filteredPhones()">Pesquisar</button>
        </div>
        <div class="button-phone-container"> 
            <button class="create-button" @click="openModalPhone()">Adicionar</button>
        </div>
        <hr class="phone-container-separator">
        <div class="contacts-list-container">
            <ul class="contacts-list">
            <li v-for="(phone, index) in filteredPhones" v-bind:key="index" class="contact-item">
                <span class="phone-number">{{phone}}</span>
                <div class="buttons-container">
                    <button @click="editPhone(index)" class="search-button">Editar</button>
                    <button @click="removePhone(index)" class="remove-button">Remover</button>
                </div>
            <hr class="phone-container-separator">
            </li>

            </ul>
        </div>
    </div>
    <div class="action-contacts"> 
        <button v-if="alterContact" class="create-button" @click="updateContacts()">Alterar</button>
        <button v-else class="create-button" @click="saveContacts()">Salvar</button>
        <button class="remove-button" @click="goToContacts()">Voltar</button>
    </div>
    <div v-if="showModalNumber" class="modalPhone"> 
        <div class="modal-content">
            <span>Adicionar numero</span>
            <input class="input" v-model="phoneNumberInput" @input="validatePhone()" type="text" placeholder="Numero" maxlength="15"/>
            <div class="action">
                <button v-if="indexPhone != null" class="create-button" @click="alterNumber()" :disabled="phoneNumberInput.length < 14">Alterar</button>
                <button v-else class="create-button" @click="addNumber()" :disabled="phoneNumberInput.length < 14">Adicionar</button>
                <button class="remove-button" @click="closeModalPhone()">Cancelar</button>
            </div>
        </div>
    </div>
  </div>
</template>


<script setup>
import { ref , computed, reactive, onMounted } from 'vue';
import router from '../../router';
import http from '@/services/http';
import {useAuthStore} from '@/stores/auth';
const phoneNumberInput = ref('')
const searchPhones = ref('')
const showModalNumber = ref(false)
const alterContact = ref(false)
const indexPhone = ref(null)
const saveClicked = ref(false);
const phonesList = ref([]);
const auth = useAuthStore();
const contactId = router.currentRoute.value.params.id;
const contact = reactive({
  name: '',
  email: '',
  address: '',
  phones: phonesList.value
})

const saveContacts = async () => {
    saveClicked.value = true;
    if (!contact.name.trim() || !contact.email.trim() || !contact.address.trim()) {
    return false;
  }
 
    try {
        const tokenAuth = 'Bearer ' + auth.token
        await http.post('/contacts',contact, {
            headers: {
                Authorization: tokenAuth
            }
        });
        router.push({ name: 'contacts' })
    } catch (error) {
        console.error('Erro ao fazer requisição:', error);
    }

}

const updateContacts = async () => {
    saveClicked.value = true;
    if (!contact.name.trim() || !contact.email.trim() || !contact.address.trim()) {
    return false;
  }
  contact.phones = phonesList.value;
    try {
        const tokenAuth = 'Bearer ' + auth.token
        await http.put('/contacts/' + contactId,contact, {
            headers: {
                Authorization: tokenAuth
            }
        });
        /*router.push({ name: 'contacts' })*/
    } catch (error) {
        console.error('Erro ao fazer requisição:', error);
    }

}
const goToContacts = ()=>{
    router.push({ name: 'contacts' });
}
const removePhone = (index)=>{
    phonesList.value.splice(index, 1)
}
const alterNumber = () => {
    phonesList.value[indexPhone.value] = phoneNumberInput.value
    closeModalPhone();
    console.log(phonesList)
    indexPhone.value = null
}
const openModalPhone = () => {
    showModalNumber.value = true
}

const editPhone = (index) =>{
    console.log(index)
    phoneNumberInput.value = phonesList.value[index];
    indexPhone.value = index
    openModalPhone()
}
const addNumber = () => {
    phonesList.value.push(phoneNumberInput.value)
    phoneNumberInput.value = ''
    closeModalPhone()
}
const closeModalPhone = () => {
    showModalNumber.value = false
    indexPhone.value = null
    phoneNumberInput.value = ''
}
const validatePhone= ()=> {
    phoneNumberInput.value = phoneNumberInput.value.replace(/\D/g, '') 
                               .replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3'); 
}
const filteredPhones = computed(() => {
  const searchLower = searchPhones.value.toLowerCase().replace(/\D/g, '');
  return phonesList.value.filter(phone => {
    const phoneDigitsOnly = phone.replace(/\D/g, ''); 
    return phoneDigitsOnly.includes(searchLower);
  });
});
const fetchContacts = async () => {
    
    if (contactId) {
        alterContact.value = true;
        try {
            const tokenAuth = 'Bearer ' + auth.token
            const response = await http.get('/contacts/' + contactId, {
                headers: {
                    Authorization: tokenAuth
                }
            });
            populate(response.data)
        } catch (error) {
            console.error('Erro ao fazer requisição:', error);
        }
    }

    function populate(contactData){
        contact.name = contactData.name;
        contact.email = contactData.email;
        contact.address = contactData.address;
        phonesList.value = contactData.phones
    }
}
onMounted(() => {
fetchContacts();
});
</script>

<style>
.create-contacts-container .modal-content {
    background-color: var(--modal-background-color);
    margin: 15% auto;
    padding: 20px;
    border: 1px solid var(--border-color);
    width: 25%;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
    border-radius: 15px;
    box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.create-contacts-container .close {
    color: var(--text-color);
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.modalPhone {
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
}

.modalPhone .action {
    display: flex;
    justify-content: end;
    width: 100%;
    gap: 8px;
}

.action-contacts .create-button,
.action-contacts .remove-button,
.modalPhone .action .create-button,
.modalPhone .action .remove-button {
    margin: 0;
    width: 25% !important;
}

.action-contacts .create-button:disabled,
.action-contacts .remove-button:disabled,
.modalPhone .action .create-button:disabled,
.modalPhone .action .remove-button:disabled {
    opacity: 0.5;
}

.create-contacts-header {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.create-contacts-container {
    height: 88.1%;
    font-family: 'Helvetica Neue', sans-serif;
    width: 98%;
    margin: 1% 0 0 0;
    padding: 0 1% 0 1%;
    background-color: var(--container-background-color);
    box-shadow: 2px 0px 4px rgba(0, 0, 0, 0.5);
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 0.5fr 1fr 0.18fr;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
}

.create-contacts-header label {
    padding: 10px 2px 0 0;
    font-family: 'Helvetica Neue', sans-serif;
    font-weight: 500;
    font-size: 14px;
    margin-bottom: 5px;
    width: 100%;
}

.item-input-container {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    gap: 0;
}

.item-input-container .input {
    width: 100%;
}
.item-input-container .input.error {
  border: 0.06px solid #e74c3c; 
  box-shadow: 0 0 5px #e74c3c;
}

.item-input-container .input.error:focus {
  border: 0.06 solid #e74c3c;
}

.item-input-container .error-message {
  color: #e74c3c;
  font-size: 12px;
  margin-top: 5px;
}


.phone-container {
    border: 0.1px solid rgba(0, 0, 0, 0.1);
    display: flex;
    flex-wrap: wrap;
    align-content: baseline;
    width: 100%;
    gap: 5px;
}

.phone-container-separator {
    border: 0.1px solid rgba(0, 0, 0, 0.1);
    width: 100%;
    margin: 0;
}

.button-phone-container {
    display: flex;
    height: 8%;
    min-height: 35px;
    width: 25%;
    align-items: flex-end;
}

.search-phone-container {
    display: flex;
    flex-basis: 1;
    height: 8%;
    min-height: 35px;
    flex-grow: 1;
}

.button-phone-container .create-button {
    height: 100%;
}

.contacts-list-container {
    width: 100%;
}

.contacts-list {
    list-style-type: none;
    padding: 0;
}

.contact-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 5px;
    flex-wrap: wrap;
    gap: 5px;
}

.phone-number {
    padding: 10px;
    font-size: 14px;
}

.buttons-container {
    display: flex;
    gap: 5px;
}

.edit-button,
.remove-button {
    padding: 10px;
    border: none;
    border-radius: 5px;
    color: var(--button-text-color);
    cursor: pointer;
}

.edit-button {
    background-color: var(--edit-button-color);
}

.edit-button:hover {
    background-color: var(--edit-button-hover-color);
}

.remove-button {
    background-color: var(--remove-button-color);
    margin-right: 5px;
}

.remove-button:hover {
    background-color: var(--remove-button-hover-color);
}

.action-contacts {
    min-height: 50px;
    display: flex;
    justify-content: end;
    align-items: center;
    width: 100%;
    gap: 8px;
}
</style>