<script setup>
import { ref } from 'vue';

const word = ref('initialize');
const definition = ref('to make a computer program or system ready for use or format a disk');
const examples = ref(
  'The other option is to initialize the hard drive and reload all your programs.'
);
const type = ref('noun');

const words_arr_json = '[{"word":"initialize","definition":"to make a computer program or system ready for use or format a disk","examples":"The other option is to __________ the hard drive and reload all your programs.","type":"noun"},{"word":"circumstance","definition":"the conditions and facts that are connected with and affect a situation, an event or an action;\\nthe conditions of a person’s life, especially the money they have","examples":"I know I can trust her in any ____________.\\nThe amount paid will vary according to ____________s.\\nher family/domestic ____________s","type":"noun"},{"word":"arbitrary","definition":"(of an action, a decision, a rule, etc.) not seeming to be based on a reason, system or plan and sometimes seeming unfair;\\nusing power without limits and without considering other people","examples":"The choice of players for the team seemed completely _________.\\nHe makes unpredictable, _________ decisions.\\nthe _________ powers of officials","type":"adjective"},{"word":"perhaps","definition":"used when you want to make a statement or opinion less definite;\\nused when making a rough estimate;\\nused when making a polite request, offer or suggestion","examples":"_______ it would be better if you came back tomorrow.\\nI think _______ you\'ve had enough to drink tonight.\\nHe had a difficult upbringing, which _______ explains why he behaves like that.\\nA change which could affect _______ 20 per cent of the population.","type":"adverb"},{"word":"estimate","definition":"to form an idea of the cost, size, value etc. of something, but without calculating it exactly","examples":"We ________d (that) it would cost about €5 000.\\nIt is ________d (that) the project will last four years.\\nIt is hard to ________ how many children have dyslexia.\\nThe satellite will cost an ________d £400 million.","type":"verb"}]'



const addNewWord = () => {
  console.log(JSON.parse(words_arr_json))
  // let newWord = {
  //   word: word.value,
  //   definition: definition.value,
  //   examples: examples.value,
  //   type: type.value
  // }

  // words_arr.value.push(newWord)//// add code to add word to basedate

  // console.log(JSON.stringify(words_arr.value))
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
