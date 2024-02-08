<template>
  <body>
      <div class="login-container">
          <form @submit.prevent="login" class="login-inputs">
            <LogoComponent></LogoComponent>
            <input v-model="user.username" type="text" placeholder="Usuario">
            <input v-model="user.password" type="password" placeholder="Senha">
            <button type="submit" class="login-button">Login</button>
          </form>
      </div>
  </body>
</template>

<script setup>
import http from '@/services/http.js'
import { reactive } from 'vue'
import {useAuthStore} from '@/stores/auth.js'
import router from '@/router'; 
import LogoComponent from '../Component/logoComponent.vue';
const auth = useAuthStore();
const user = reactive({
  username: '',
  password: ''
})

async function login(){
  try {
    const {data} = await http.post('/auth',user)
    auth.setToken(data.token)
    auth.setUser(data.name)
    router.push({ name: 'dashbord' });
  } catch (error) {
    console.log(error?.reponse?.data)
  }
}
</script>

<style scoped>
body {
  background-image: var(--background-gradient);
  margin: 0;
  padding: 0;
  height: 100vh;
  overflow: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.login-container {
  background-color: var(--light-sky-blue);
  width: 30%;
  min-height: 300px;
  border-radius: 30px;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-inputs {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 15px;
  width: 100%;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 5px;
  box-sizing: border-box;
}

input[type="text"]:focus,
input[type="password"]:focus {
  outline: none;
  border: 2px solid rgba(60, 155, 210, 0.5);
}

.login-button {
  padding: 10px 20px;
  background-color: var(--light-blue);
  color: var(--dark-gray);
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
  transition: background-color 0.3s, color 0.3s;
}

.login-button:hover {
  background-color: var(--dark-blue);
  color: #fff;
}

.login-button:focus {
  outline: none;
  box-shadow: 0 0 0 2px var(--light-blue);
}
</style>