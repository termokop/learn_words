<script setup>
import { ref } from 'vue'

defineProps({
  listProp: String
})

const word = ref('initialize')
const definition = ref([
  'to make a computer program or system ready for use or format a disk',
  'definition #2',
  'def #3'
])
const examples = ref(
  [
    'The other option is to initialize the hard drive and reload all your programs.',
    'Second example'
  ]
)
const type = ref('noun')

const addNewWord = async () => {

  try {
    const url = 'https://www.ukrge.site/learn_words/API/add_word.php'
    const new_word = {
      word: word.value,
      definition: definition.value,
      examples: examples.value,
      type: type.value,
      user_id: 1
    }

    console.log(JSON.stringify(new_word))

    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(new_word)
    })

    if(!response.ok) {
      throw new Error('Network is not ok.')
    }

    const responseData = await response.json();
    console.log('Response:', responseData)

    word.value = ''
    definition.value = ['']
    examples.value = ''
    type.value = 'noun'

    return;
  } catch (error) {
    console.error('Error', error.message);
    throw error;
  }
}

const create_pattern_to_replace_word = (word) => {
  let template = word.replace(/[a-zA-Z]/g, '_')
  return template
}

const replace_word = () => {
  while (examples.value.includes(word.value)) {
    examples.value = examples.value.replace(word.value, create_pattern_to_replace_word(word.value))
  }
}

const add_new_meaning_item = () => {
  definition.value.push('')
}

const remove_meaning_item = index => {
  if(definition.value.length > 1) {
    definition.value.splice(index, 1);
  } else {
    definition.value[0] = '';
  }
}

const add_new_examples_item = () => {
  examples.value.push('')
}

const remove_examples_item = index => {
  if(examples.value.length > 1) {
    examples.value.splice(index, 1);
  } else {
    examples.value[0] = '';
  }
}
</script>

<template>
  <div class="add-new-word">
    <p class="close-btn" @click="$emit('close')">X</p>
    <label for="word">Word</label>
    <input class="input" type="text" name="" id="word" v-model="word" />
    <select name="type" id="type" v-model="type">
      <option value="noun">noun</option>
      <option value="verb">verb</option>
      <option value="adjective">adjective</option>
      <option value="adverb">adverb</option>
      <option value="phrasal_verb">phrasal verb</option>
    </select>

    <!-- Meanings -->

    <div class="meanings">
      <label for="definition">Meanings</label>
      <div class="definition-item" v-for="(def, index) in definition" :key="index" >
        <input v-model="definition[index]" class="definition-item-input"/>
        <button class="delete-item" @click="remove_meaning_item(index)">x</button>
      </div>
      <button class="add-new-item" @click="add_new_meaning_item()">+</button>
    </div>


    <!--Examples-->

    <div class="examples">
      <label for="examples">Examples</label>
      <div class="examples-item" v-for="(def, index) in examples" :key="index" >
        <input v-model="examples[index]" class="examples-item-input"/>
        <button class="delete-item" @click="remove_examples_item(index)">x</button>
      </div>
      <button class="add-new-item" @click="add_new_examples_item()">+</button>
    </div>

    <div class="list-name">({{ listProp }})</div>

    <button @click="addNewWord()" class="add-word">Add word</button>
  </div>
</template>

<style scoped>
.add-new-word {
  width: 350px;
  padding: 20px;
  background-color: #3d3d3d;
  display: flex;
  flex-wrap: wrap;
  position: fixed;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}


/* Meanings area*/
.meanings, .examples {
  width: 100%;
}

.definition-item, .examples-item {
  width: 100%;
  display: flex;
  justify-content: space-between;
  margin-top: 2px;
  margin-bottom: 2px;
}
.definition-item-input, .examples-item-input {
  width: 90%;
}

.delete-item {
  border: none;
  background-color: rgb(228, 46, 46);
  border-radius: 50%;
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

.add-word {
  width: 50%;
  margin: auto;
  background-color: rgb(57, 177, 57);
  padding: 10px;
  font-size: 1.3rem;
  border-radius: 10px;
  margin-top: 15px;
}

.close-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  width: 25px;
  height: 25px;
  background-color: rgba(255, 0, 0, 0.553);
  text-align: center;
  color: white;
  border-radius: 50%;
  cursor: pointer;
}

.list-name {
  color: #ffffff;
  width: 100%;
  text-align: center;
  font-size: 0.8rem;
}

@media (max-width: 1024px) {
  .add-new-word {
    width: 100%;
  }
}
</style>
