<template>
  <body>
      <div class="login-container">
          usuario e senha
      </div>
  </body>
</template>

<script>
export default {
  name: 'HelloWorld',
  props: {
    msg: String
  }
}
</script>

<style scoped>
  body{
    background-color: var(---beckgroud);
    margin: 0; 
    padding: 0; 
    height: 100vh;
    overflow: auto;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .login-container{
    background-color: var(---light-sky-blue);
    width: 40%;
    height: 60%;
  }
</style>