<script setup>

import {ref} from 'vue'
import vAddNewWord from './vAddNewWord.vue';

const showAddWord = ref(false)

</script>

<template>

<vAddNewWord v-if="showAddWord" @close="showAddWord = false"></vAddNewWord>

<button @click="showAddWord = !showAddWord">Add new word</button>

</template>