<script setup>

    import { ref } from 'vue';
    
    import vAddNewWord from './vAddNewWord.vue';
    const showAddWord = ref(false)

    const lists = ref([])

    const choosen_list = ref('')

    const show_modal = list => {
        showAddWord.value = !showAddWord.value;
        choosen_list.value = list
    }


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
        <div class="title">Lists</div>
        <div class="list-element" v-for="list in lists" :key="list" >
            <div class="name-of-list">{{ list.name }}</div>
            <div class="amount-of-words">{{ list.amount_of_words }}</div>
            <button @click=show_modal(list.name)>Add new word</button>
        </div>
        <vAddNewWord :list-prop="choosen_list" v-if="showAddWord" @close="showAddWord = false"></vAddNewWord>
    </div>

</template>

<style scoped>

    .lists {
        width: 90vw;
        margin: auto;
    }

    .title {
        width: fit-content;
        margin: auto;
        text-transform: uppercase;
        font-size: 2rem;
        font-weight: 700;
    }
    .list-element {
        margin: 10px;
        background-color: white;
        display: flex;
        padding: 10px;
        justify-content: space-between;
    }



</style>
