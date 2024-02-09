<template>
  <div class="contacts-container">
  <div class="contacts-header">
    <div class="search-container">
      <input class="input" @change="search" type="text" placeholder="Pesquisar" v-model="searchText"/>
      <button class="search-button" @click="search">Pesquisar</button>
    </div>
    <div class="button-container"> 
      <button @click="goTocreateContacts()" class="create-button">Criar</button>
    </div>
  </div>
  <hr class="separator">
  <div class="tabela-container">
  <table class="table-contacts">
    <thead>
      <th>
        Nome
      </th>
      <th>
        E-mail
      </th>
      <th>
        Endereço
      </th>
      <th> 
        Telefones
      </th>
    </thead>
  <tbody>
    <tr v-for="contact in paginatedContacts" v-bind:key="contact.id">
      <td>{{ contact.name }}</td>
      <td align="center">{{ contact.email }}</td>
      <td align="center">{{ contact.address }}</td>
    </tr>
  </tbody>
</table>
</div>
  <div class="pagination">
    <button @click="previousPage" :disabled="currentPage === 1" :class="{ active: currentPage !== 1 }">Anterior</button>
    <button v-for="page in totalPages" :key="page" @click="goToPage(page)" :class="{ active: page === currentPage }">{{ page }}</button>
    <button @click="nextPage" :disabled="currentPage === totalPages" :class="{ active: currentPage !== totalPages }">Próxima</button>
  </div>
</div>
</template>

<script setup>
import http from '@/services/http';
import { onMounted } from 'vue';
import { useAuthStore } from '@/stores/auth';
import { ref, computed } from 'vue';
import router from '@/router'; 

const auth = useAuthStore();
const contacts = ref([])
const searchText = ref('');
const currentPage = ref(1);
const pageSize = 9

const goTocreateContacts = ()=>{
  router.push({ name: 'createContacts' });
}
const fetchData = async () => {
try {
  const tokenAuth = 'Bearer ' + auth.token
  const response = await http.get('/contacts', {
              headers: {
                  Authorization: tokenAuth
              }
          });
  contacts.value = response.data;
  paginatedContacts
} catch (error) {
  console.error('Erro ao fazer requisição:', error);
}
};

const filteredContacts = computed(() => {
  const searchLower = searchText.value.toLowerCase();
  return contacts.value.filter(contact => {
    return contact.name.toLowerCase().includes(searchLower) ||
           contact.email.toLowerCase().includes(searchLower) ||
           contact.address.toLowerCase().includes(searchLower);
  });
});

const paginatedContacts = computed(() => {
const start = (currentPage.value - 1) * pageSize;
return filteredContacts.value.slice(start, start + pageSize);
});

const totalPages = computed(() => {
return Math.ceil(filteredContacts.value.length / pageSize);
});

const previousPage = () => {
currentPage.value--;
};

const goToPage = (page) => {
currentPage.value = page;
};

const nextPage = () => {
currentPage.value++;
};

const search = () => {
if(searchText.value){
  filteredContacts()
}else{
  fetchData()
}
};
onMounted(() => {
fetchData(); 
});
</script>
<style>
.separator{
  width: 100%;
  border-bottom: 0.1px solid rgba(0, 0, 0, 0.1);
  margin: 5px 0;
}
.button-container{
display: flex;
justify-content: center;
margin-right: 1%;
width: 18.5%;
}
.search-container{
display: flex;
justify-content: center;
margin-left: 1%;
width: 78.5%;
}
.contacts-container{
  display: grid;
  grid-template-columns: 1fr;
  grid-template-rows: 40px 2px 1fr;
  grid-column-gap: 0px;
  grid-row-gap: 0px;
  height: 100%;
  font-family: 'Helvetica Neue', sans-serif;
  width: 100%;
  margin:15px 0 0 0;
  padding: 5px 0 5px 0;
  background-color: #fcfcfc;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}
.contacts-header{
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  width: 100%;
  gap:1%;
}
.input {
width: 100%;
padding: 10px;
border-radius: 5px;
box-sizing: border-box;
border: 2px solid rgba(60, 155, 210, 0.5);
}

.input:focus {
outline: none;
border: 2px solid rgba(60, 155, 210, 0.5);
}

.search-button,.create-button {
padding: 10px 15px;
border: none;
border-radius: 5px;
background-color: rgba(60, 155, 210, 1);
color: #fff;
cursor: pointer;
}
.create-button {
background-color: #28a745;
width: 100%;
}
.create-button:hover{
background-color: #218838;
}
.search-button:hover {
background-color: rgba(60, 155, 210, 0.8);
}

.table-contacts {
width: 100%;
border-collapse: collapse;
}

.table-contacts th {
padding: 10px;
font-family: 'Helvetica Neue', sans-serif;
font-weight: 500;
font-size:14px;
}

.table-contacts td {
padding: 10px;
color: #333333; /* Cor do texto */
}

.pagination {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  padding: 10px 0;
  background-color: #fff;
  box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
  width: 100%;
  text-align: center;
}
.pagination button {
padding: 8px 12px;
margin: 0 3px;
border: none;
border-radius: 4px;
background-color: rgba(60, 155, 210, 0.5);
color: #fff;
cursor: pointer;
}

.pagination button:hover {
background-color: rgba(60, 155, 210, 0.8);
}

.pagination button.active {
background-color: rgba(60, 155, 210, 1);
}
</style>