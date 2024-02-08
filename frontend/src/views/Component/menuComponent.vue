<template>
<main class="menus-container">
    <div v-on:click="goToContacts()" class="menu-container">
        <span class="material-symbols-outlined">
            book_4
        </span>
        <span> Contatos </span>
    </div>
</main>
</template>

<script setup>
    import router from '@/router'; 

    const goToContacts = () => {
        router.push({ name: 'contacts' });
    }
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0');

.menus-container{
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: space-between;
    margin: 20px;
}

.menu-container{
    cursor: pointer;
    width: 100px;
    height: 100px;
    background-color: #fcfcfc;
    border-radius: 15px;
    box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    display: flex;
    flex-direction: column;
    gap:5px;
    align-items: center;
    justify-content: center;
}
.menu-container:hover{
    background-color: #c8c8c8;
}


</style>