<script setup>

    import { ref } from 'vue';
    
    import vAddNewWord from './vAddNewWord.vue';
    const showAddWord = ref(false)

    const lists = ref([])


    const getLists = async () => {// get topics from the server

        lists.value = [
            {
                name: 'J. Piterson',
                amount_of_words: 10
            }, 
            {
                name: 'American English File',
                amount_of_words: 10
            },
            {
                name: 'games',
                amount_of_words: 10
            },
            {
                name: 'investing',
                amount_of_words: 10
            },
            {
                name: 'motivation',
                amount_of_words: 10
            },
            {
                name: 'mining',
                amount_of_words: 10
            }
        ]

    }

    getLists();


</script>


<template>

    <div class="lists">
        <div class="list-element" v-for="list in lists" :key="list" >
            <div class="name-of-list">{{ list.name }}</div>
            <div class="amount-of-words">{{ list.amount_of_words }}</div>
            <button @click="showAddWord = !showAddWord">Add new word</button>
            
            <vAddNewWord v-if="showAddWord" @close="showAddWord = false"></vAddNewWord>


        </div>
    </div>

</template>

<style scoped>

    .lists {
        width: 90vw;
        margin: auto;
    }
    .list-element {
        margin: 10px;
        background-color: white;
        display: flex;
        padding: 10px;
        justify-content: space-between;
    }



</style>
