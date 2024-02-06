<template>
    <router-view class="main_content"></router-view>
</template>

<script>
import Router from './router';

export default {
  name: 'App',
  router: Router
};
</script>

<style>
:root{
  ---beckgroud: #f8f9fa;
  ---light-sky-blue: #e6f7ff;
}
.main_content{
  background-color: var(---beckgroud);
}
</style>
