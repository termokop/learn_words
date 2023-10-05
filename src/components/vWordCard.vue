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
        <button class="reverse-btn" @click="revers_card=!revers_card"><svg fill="white" width="20px" height="20px" viewBox="-1 -4.5 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-refresh-reverse"><path d='M4.859 5.308l1.594-.488a1 1 0 0 1 .585 1.913l-3.825 1.17a1 1 0 0 1-1.249-.665L.794 3.413a1 1 0 1 1 1.913-.585l.44 1.441C5.555.56 10.332-1.035 14.573.703a9.381 9.381 0 0 1 5.38 5.831 1 1 0 1 1-1.905.608A7.381 7.381 0 0 0 4.86 5.308zm12.327 8.195l-1.775.443a1 1 0 1 1-.484-1.94l3.643-.909a.997.997 0 0 1 .61-.08 1 1 0 0 1 .84.75l.968 3.88a1 1 0 0 1-1.94.484l-.33-1.322a9.381 9.381 0 0 1-16.384-1.796l-.26-.634a1 1 0 1 1 1.851-.758l.26.633a7.381 7.381 0 0 0 13.001 1.25z' /></svg></button>
        <div class="word-card" v-if="!revers_card">
            <div class="word-answer">
                <input autofocus @keydown.enter="check_ans()" type="text" name="word" id="word" v-model="word_ans">
            <div class="word-type">({{ words_arr[index].type }})</div>
            </div>
            <div class="word-definition"> {{ words_arr[index].definition }}</div>
            <div class="word-examples"> {{ words_arr[index].examples }}</div>
            <button @click="check_ans(words_arr[index].word)">Check</button>
        </div>
        <div class="word-card" v-if="revers_card">
            <div class="word-answer">
                <input type="text" name="word" id="word_ans" disabled :value="words_arr[index].word">
            <div class="word-type">({{ words_arr[index].type }})</div>
            </div>
            <div class="word-definition"> {{ words_arr[index].definition }}</div>
            <div class="word-examples"> {{ words_arr[index].examples }}</div>
            <button @click="check_ans(words_arr[index].word)">Skip</button>
        </div>
    
    </div>
</template>

<style scoped>

.card {
    width: 90vw;
    height: 90vh;
    margin: auto;
    background-color: rgb(70, 218, 94);
    display: flex;
    align-content: center;
    position: absolute;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    position: absolute;
    border-radius: 20px;
}

.word-card {
    width: 90%;
    height: 90%;
    display: flex;
    align-content: space-between;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: center;
}

.reverse-btn {
    width: 2.5rem;
    height: 2.5rem;
    position: absolute;
    top: 5px;
    right: 5px;
    padding: 0;
    background-color: transparent;
    border-width: 0;
    border-radius: 50%;
}

.reverse-btn:hover {
    background-color:  rgb(124, 231, 142);
}

.word-answer {
    width: 100%;
    margin: auto;
    margin-top: 25px;
}

input {
    width: 100%;
    text-align: center;
    border-width: 0;
    background-color: rgb(178, 244, 180);
    border-radius: 25px;
    height: 3rem;
    font-size: 2rem;
}

input:focus {
    outline: none;
    background-color: rgb(228, 245, 226);
}

button{
    width: 100%;
    margin: auto;
    height: 3rem;
    font-size: 2rem;
    border-width: 0;
    background-color: rgb(10, 193, 10);
    border-radius: 25px;
}

.word-type {
    width: fit-content;
    margin: auto;
    font-style: italic;
    font-size: 1.5rem;
}

.word-definition, .word-examples {
    width: 100%;
    text-align: center;
}


</style>