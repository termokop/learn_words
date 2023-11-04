<script setup>

import vLists from './vLists.vue'


</script>

<template>

    <div class="menu">
        
        <v-lists></v-lists>
    
        <div class="btn">
            <button @click="this.$router.push('/practice')">Practice</button>
        </div>

    </div>

</template>


<style scoped>

.btn {
    /* background-color: pink; */
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    height: 10vh;


}

button {
    background-color: rgba(61, 113, 234, 0.785);
    outline: none;
    border: none;
    padding: 20px;
    border-radius: 20px;
    width: 200px;
    font-size: 1.5rem;
    height: 75px;
}

button:hover {
    background-color:  rgb(61, 113, 234);
    color: white;
}

</style>

