<script setup>

    import { ref } from 'vue';

    const words_arr_json = '[{"word":"initialize","definition":"to make a computer program or system ready for use or format a disk","examples":"The other option is to __________ the hard drive and reload all your programs.","type":"noun"},{"word":"circumstance","definition":"the conditions and facts that are connected with and affect a situation, an event or an action;\\nthe conditions of a person’s life, especially the money they have","examples":"I know I can trust her in any ____________.\\nThe amount paid will vary according to ____________s.\\nher family/domestic ____________s","type":"noun"},{"word":"arbitrary","definition":"(of an action, a decision, a rule, etc.) not seeming to be based on a reason, system or plan and sometimes seeming unfair;\\nusing power without limits and without considering other people","examples":"The choice of players for the team seemed completely _________.\\nHe makes unpredictable, _________ decisions.\\nthe _________ powers of officials","type":"adjective"},{"word":"perhaps","definition":"used when you want to make a statement or opinion less definite;\\nused when making a rough estimate;\\nused when making a polite request, offer or suggestion","examples":"_______ it would be better if you came back tomorrow.\\nI think _______ you\'ve had enough to drink tonight.\\nHe had a difficult upbringing, which _______ explains why he behaves like that.\\nA change which could affect _______ 20 per cent of the population.","type":"adverb"},{"word":"estimate","definition":"to form an idea of the cost, size, value etc. of something, but without calculating it exactly","examples":"We ________d (that) it would cost about €5 000.\\nIt is ________d (that) the project will last four years.\\nIt is hard to ________ how many children have dyslexia.\\nThe satellite will cost an ________d £400 million.","type":"verb"}]'

    const index = ref(0)
    let words_arr = JSON.parse(words_arr_json)

    console.log(words_arr)

    const revers_card = ref(false)

    const word_ans = ref('')

    const check_ans = (word) => {
        if(word_ans.value !== word) {
            correct_ans();
            word_ans.value = ''
            console.log(index.value)
            if(words_arr.length-1<=index.value) finish_quiz()
            else index.value++;
        }
        else wrong_ans();
    }

    const finish_quiz = () => {
        index.value = 0;
        console.log('finished')
    }

    const correct_ans = () => {
        alert('Correct');
    }

    const wrong_ans = () => {
        alert('Wrong')
    }

</script>

<template>
    <div class="card">
        <button @click="revers_card=!revers_card">reverse</button>
        <div class="word-card-front" v-if="!revers_card">
            
            <input autofocus @keydown.enter="check_ans()" type="text" name="word" id="word" v-model="word_ans">
            <div class="word-type">{{ words_arr[index].type }}</div>
            <div class="word-definition"> {{ words_arr[index].definition }}</div>
            <div class="word-examples"> {{ words_arr[index].examples }}</div>
            
    
            <button @click="check_ans(words_arr[index].word)">Check</button>
        </div>
        <div class="word-card-back" v-if="revers_card">
            <div class="word-type">{{ words_arr[index].type }}</div>
            <div class="word-answer">{{ words_arr[index].word }}</div>
            <div class="word-definition"> {{ words_arr[index].definition }}</div>
            <div class="word-examples"> {{ words_arr[index].examples }}</div>
        </div>
    
    </div>
</template>