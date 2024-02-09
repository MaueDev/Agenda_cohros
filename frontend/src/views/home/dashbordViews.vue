<template>
  <header class="header-dashbord">
   <Logo></Logo>
  </header>
  <router-view></router-view>
</template>

<script setup>
import Logo from '@/views/Component/logoComponent.vue'
</script>

<style>
@import url('https://fonts.cdnfonts.com/css/helvetica-neue-55');
.header-dashbord{
    width: 100%;
    min-height: 78px;
    background: var(--background-gradient);
    box-shadow: 0 0 10px rgb(0, 0, 10);
    padding:12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

</style>