<template>
  <div class="contacts-container">
    <div class="contacts-header">
      <div class="search-container">
        <input class="search-input" type="text" placeholder="Pesquisar"/>
        <button class="search-button" @click="search">Pesquisar</button>
      </div>
      <div class="button-container"> 
        <button class="create-button">Criar</button>
      </div>
    </div>
    <hr class="separator">
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
      <tr>
        <td>

        </td>
      </tr>
    </tbody>
    </table>
  </div>
</template>

<script setup>
import http from '@/services/http';
import { onMounted } from 'vue';
import { useAuthStore } from '@/stores/auth';

const auth = useAuthStore();
const fetchData = async () => {
  try {
    const tokenAuth = 'Bearer ' + auth.token
    const response = await http.get('/contacts', {
                headers: {
                    Authorization: tokenAuth
                }
            });

    console.log(response.data); // A resposta da API
  } catch (error) {
    console.error('Erro ao fazer requisição:', error);
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
  display: flex;
  flex-direction: column;
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
.search-input {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  box-sizing: border-box;
  border: 2px solid rgba(60, 155, 210, 0.5);
}

.search-input:focus {
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
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  padding: 10px;
  color: #333333;
  font-size:14px;
}

.table-contacts td {
  padding: 10px;
  color: #333333; /* Cor do texto */
}
</style>