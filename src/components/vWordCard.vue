<script setup>

    import { ref } from 'vue';

    const json_word = ref('{"word":"initialize","definition":"to make a computer program or system ready for use or format a disk","examples":"The other option is to __________ the hard drive and reload all your programs. ","type":"verb"}')

    let word_obj = JSON.parse(json_word.value)

    const revers_card = ref(false)

    const word_ans = ref('')

    const check_ans = () => {
        if(word_ans.value === word_obj.word) correct_ans();
        else wrong_ans();
    }

    const correct_ans = () => {
        alert('Correct');
    }

    const wrong_ans = () => {
        alert('Wrong')
    }

</script>

<template>
    <div class="word-card-front" v-if="!revers_card">
        <div class="word-type">{{ word_obj.type }}</div>
        <div class="word-definition"> {{ word_obj.definition }}</div>
        <div class="word-examples"> {{ word_obj.examples }}</div>
        
        <input type="text" name="word" id="word" v-model="word_ans">

        <button @click="check_ans()">Check</button>

    </div>
</template>