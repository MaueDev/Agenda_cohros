<template>
    <div class="create-contacts-container">
    <div class="create-contacts-header">
      <div class="item-input-container">
          <label> Nome </label>
        <input class="input" @change="search" type="text" placeholder="Pesquisar" v-model="searchText"/>
      </div>
      <div class="item-input-container">
          <label> E-mail </label>
        <input class="input" @change="search" type="text" placeholder="Pesquisar" v-model="searchText"/>
      </div>
      <div class="item-input-container">
          <label> Endereço </label>
        <input class="input" @change="search" type="text" placeholder="Pesquisar" v-model="searchText"/>
      </div>
      <div class="item-input-container">
        <label> Números de Telefones </label>
        
      </div>
    </div>
    <div class="phone-container">
        <div class="search-phone-container">
            <input class="input" @change="search" type="text" placeholder="Pesquisar" v-model="searchText"/>
            <button class="search-button" @click="search">Pesquisar</button>
        </div>
        <div class="button-phone-container"> 
            <button class="create-button">Adicionar</button>
        </div>
        <hr class="phone-container-separator">
        <div class="contacts-list-container">
            <ul class="contacts-list">
            <li class="contact-item">
                <span class="phone-number">+55 1234-5678</span>
                <div class="buttons-container">
                <button class="edit-button">Editar</button>
                <button class="remove-button">Remover</button>
                </div>
            </li>
            <hr class="phone-container-separator">

            <!-- Adicione mais itens conforme necessário -->
            </ul>
        </div>
    </div>
    <div class="modalPhone"> 
        <div class="modal-content">
            <span>Adicionar numero</span>
            <input class="input" v-model="phoneNumberInput" @input="phoneMask()" type="text" placeholder="Numero" maxlength="15"/>
            <div class="action">
                <button class="create-button" style="width:auto;">Adicionar</button>
                <button class="remove-button">Cancelar</button>
            </div>
        </div>
    </div>
  </div>
</template>


<script setup>
import { ref } from 'vue';

let phoneNumberInput = ref('')

const phoneMask= ()=> {
    phoneNumberInput.value = phoneNumberInput.value.replace(/\D/g, '') 
                               .replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3'); 
}
</script>

<style>
    .create-contacts-container .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 25%;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
    border-radius: 15px;
    box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .create-contacts-container .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .modalPhone{
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
    }
    .modalPhone .action{
        display: flex;
        justify-content: end;
        width: 100%;
        gap:8px;
    }
    .modalPhone .action .create-button,
    .modalPhone .action .remove-button{
        margin: 0;
        width: 25% !important;
    }
    .create-contacts-header{
        display:flex;
        flex-direction: column;
        gap: 16px;
    }
    .create-contacts-container{
        height: 100%;
        font-family: 'Helvetica Neue', sans-serif;
        width: 98%;
        margin:15px 0 0 0;
        padding: 5px 1% 5px 1%;
        background-color: #fcfcfc;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 0.5fr 1fr;
        grid-column-gap: 0px;
        grid-row-gap: 0px; 
    }
    .create-contacts-header label {
        padding: 10px 2px 0 0;
        font-family: 'Helvetica Neue', sans-serif;
        font-weight: 500;
        font-size:14px;
        margin-bottom: 5px;
        width: 100%;
    }
    .item-input-container {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        gap:0;
    }
    .item-input-container .input{
        width: 100%;
    }
    .phone-container{
        border: 0.1px solid rgba(0, 0, 0, 0.1);
        display: flex;
        flex-wrap: wrap;
        align-content: baseline;
        width: 100%;
        padding: 5px;
        gap:5px;
    }
    .phone-container-separator{
        border: 0.1px solid rgba(0, 0, 0, 0.1);
        width: 100%;
        margin: 0;
    }
    .button-phone-container{
        display:flex; 
        height: 8%;
        width: 25%;
        align-items: flex-end;
    }
    .search-phone-container{
        display:flex;
        flex-basis: 1;
        height: 8%; 
        flex-grow: 1;       
    }

    .button-phone-container  .create-button{
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
    justify-content: space-between; /* Alinha os itens nas extremidades */
    margin-bottom: 5px; /* Espaçamento entre os itens */
}

.phone-number {
  padding: 10px;
  font-size: 14px;
}

.buttons-container {
  display: flex;
  gap:5px;
}

.edit-button,
.remove-button {
  padding: 10px;
  border: none;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
}

.edit-button {
  background-color: rgba(60, 155, 210, 0.7); /* Cor azul para o botão de editar */
}

.edit-button:hover {
  background-color: rgba(60, 155, 210, 0.9); /* Tornando a cor ainda mais escura ao passar o mouse */
}

.remove-button {
  background-color: #e74c3c; 
  margin-right: 5px;
}

.remove-button:hover {
  background-color: #c0392b; /* Tornando a cor ainda mais escura ao passar o mouse */
}
</style>