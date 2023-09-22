<script setup>
import { ref } from 'vue';

const word = ref('initialize');
const definition = ref('to make a computer program or system ready for use or format a disk');
const examples = ref('The other option is to initialize the hard drive and reload all your programs.');

const addNewWord = () => {
    let newWord = {
        word: word.value,
        definition: definition.value,
        examples: examples.value
    }

    console.log(JSON.stringify(newWord))
}


</script>

<template>
    <div class="add-new-word">

        <label for="word">Word</label>
        <input class="input" type="text" name="" id="word" v-model="word">
        <select name="type" id="type">
            <option value="noun">noun</option>
            <option value="verb">verb</option>
            <option value="adjective">adjective</option>
        </select>

        <label for="definition">Meaning</label>
        <textarea class="input" rows="5" name="" id="definition" v-model="definition"></textarea>

        <label class="example">Examples</label>
        <textarea name="" id="example" rows="10" v-model="examples"></textarea>

        <button @click="addNewWord()">Send</button>

    </div>
</template>

<style scoped>

.add-new-word{
    width: 350px;
    border: solid 2px red;
    display: flex;
    flex-wrap: wrap;
}

label {
    width: 100%;
}

textarea {
    width: 100%;
}

input, select {
    width: 50%;
}

</style>