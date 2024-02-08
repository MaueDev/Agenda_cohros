import { ref } from 'vue'
import { defineStore } from 'pinia'
import http from '@/services/http.js'
export const useAuthStore = defineStore('auth', ()=>{
    const token = ref(localStorage.getItem('token'))
    const user = ref(localStorage.getItem('user'))

    function setToken(tokenValue){
        localStorage.setItem('token', tokenValue)
        token.value = tokenValue
    }
    function setUser(userValue){
        localStorage.setItem('user', userValue)
        user.value = userValue
    }

    async function checkToken(){
        try {
            const tokenAuth = 'Bearer ' + token.value
            const {data} = await http.get('/auth/verify', {
                headers: {
                    Authorization: tokenAuth
                }
            })
            return data;
        } catch (error) {
           console.log(error.response.data) 
        }
    }

    return {
        setToken,setUser,token,user,checkToken
    }
})