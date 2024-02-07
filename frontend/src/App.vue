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
:root {
  --background-gradient: linear-gradient(135deg, #52E5E7 10%, #130CB7 100%);
  --light-sky-blue: #e6f7ff;
  --dark-blue: #130CB7;
  --light-blue: #52E5E7;
  --dark-gray: #333;
  --light-gray: #f0f0f0;
}
.main_content{
  background-color: var(---beckgroud);
}
</style>
