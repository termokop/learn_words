<script setup>
import { ref } from 'vue';

const word = ref('initialize');
const definition = ref('to make a computer program or system ready for use or format a disk');
const examples = ref(
  'The other option is to initialize the hard drive and reload all your programs.'
);
const type = ref('noun');

const addNewWord = () => {
    
  let newWord = {
    word: word.value,
    definition: definition.value,
    examples: examples.value,
    type: type.value
  }

  console.log(JSON.stringify(newWord))
  console.log(create_pattern_to_replace_word(word.value))
}

const create_pattern_to_replace_word = (word) => {
    let template = word.replace(/[a-zA-Z]/g, '_');
    return template;
}

const replace_word = () => {
    while(examples.value.includes(word.value)) {
        examples.value = examples.value.replace(word.value, create_pattern_to_replace_word(word.value));
    }
}
</script>

<template>
  <div class="add-new-word">
    <label for="word">Word</label>
    <input class="input" type="text" name="" id="word" v-model="word" />
    <select name="type" id="type" v-model="type">
      <option value="noun">noun</option>
      <option value="verb">verb</option>
      <option value="adjective">adjective</option>
      <option value="adverb">adverb</option>
      <option value="phrasal_verb">phrasal verb</option>
    </select>

    <label for="definition">Meaning</label>
    <textarea class="input" rows="5" name="" id="definition" v-model="definition"></textarea>

    <label class="example">Examples</label>
    <textarea name="" id="example" rows="10" v-model="examples" @change="replace_word()"></textarea>

    <button @click="addNewWord()">Add word</button>
  </div>
</template>

<style scoped>
.add-new-word {
  width: 350px;
  padding: 20px;
  background-color: #3d3d3d;
  display: flex;
  flex-wrap: wrap;
}

label {
  width: 100%;
  color: white;
}

textarea {
  width: 100%;
}

input,
select {
  width: 50%;
}

button {
    width: 50%;
    margin: auto;
    background-color: rgb(57, 177, 57);
    padding: 10px;
    font-size: 1.3rem;
    border-radius: 10px;
    margin-top: 15px;
}

@media (max-width: 1024px) {
  .add-new-word {
    width: 100%;
  }
}
</style>
