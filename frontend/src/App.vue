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
  --background-gradient: linear-gradient(135deg, var(--light-blue, #52E5E7) 10%, var(--dark-blue, #130CB7) 100%);
  --light-sky-blue: #e6f7ff;
  --dark-blue: #130CB7;
  --light-blue: #52E5E7;
  --dark-gray: #333;
  --light-gray: #f0f0f0;
  --modal-background-color: #fefefe;
  --border-color: #888;
  --text-color: #aaa;
  --container-background-color: #fcfcfc;
  --button-text-color: #fff;
  --edit-button-color: rgba(60, 155, 210, 0.7);
  --edit-button-hover-color: rgba(60, 155, 210, 0.9);
  --remove-button-color: #e74c3c;
  --remove-button-hover-color: #c0392b;
  --pagination-active-color: rgba(60, 155, 210, 1);
  --light-green: #28a745;
  --darker-green: #218838;
}
.main_content {
  background-color: var(--background-gradient);
}
</style>
