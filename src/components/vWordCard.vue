<script setup>

    import { ref } from 'vue';

    const words = [
        {
            id: 1,
            word: "circumstance",
            type: 'noun',
            definitions: [
                "the conditions and facts that are connected with and affect a situation, an event or an action",
                "the conditions of a person’s life, especially the money they have"
            ],
            examples: [
                "I know I can trust her in any ____________.",
                "The amount paid will vary according to ____________s.",
                "Her family/domestic ____________s"
            ]
        },
        {
            id: 2,
            word: "initialize",
            type: 'noun',
            definitions: [
                "to make a computer program or system ready for use or format a disk",
            ],
            examples: [
                "The other option is to __________ the hard drive and reload all your programs.",
            ]
        },
        {
            id: 3,
            word: "perhaps",
            type: 'adverb',
            definitions: [
                "Used when you want to make a statement or opinion less definite",
                "Used when making a rough estimate",
                "used when making a polite request, offer or suggestion",
            ],
            examples: [
                "_______ it would be better if you came back tomorrow.",
                "I think _______ you've had enough to drink tonight.",
                "He had a difficult upbringing, which _______ explains why he behaves like that.",
                "A change which could affect _______ 20 per cent of the population.",
            ]
        },
        {
            id: 4,
            word: "arbitrary",
            type: 'adjective',
            definitions: [
                "(of an action, a decision, a rule, etc.) not seeming to be based on a reason, system or plan and sometimes seeming unfair",
                "Using power without limits and without considering other people"
            ],
            examples: [
                "The choice of players for the team seemed completely _________.",
                "He makes unpredictable, _________ decisions.",
                "the _________ powers of officials"
            ]
        },
        {
            id: 5,
            word: "estimate",
            type: 'verb',
            definitions: [
                "To form an idea of the cost, size, value etc. of something, but without calculating it exactly"
            ],
            examples: [
                "We ________d (that) it would cost about €5 000.",
                "It is hard to ________ how many children have dyslexia.",
                "The satellite will cost an ________d £400 million."
            ]
        },
    ];

    
    const words_arr_json = JSON.stringify(words)///
    const index = ref(0)
    let words_arr = JSON.parse(words_arr_json)

    console.log(words_arr)

    const revers_card = ref(false)

    const word_ans = ref('')

    const check_ans = (word) => {
        if(word_ans.value === word) {
            correct_ans();
        }
        else wrong_ans();
    }

    const skip_word = () => {
        if(words_arr.length-1<=index.value) finish_quiz()
        else index.value++;
        revers_card.value = false;
    }

    const finish_quiz = () => {  ////////////////////////////////// add functionality
        index.value = 0;
        console.log('finished')
    }

    const correct_ans = () => { ////////////////////////////////// add functionality (styles and animatiion)
        word_ans.value = ''
        if(words_arr.length-1<=index.value) finish_quiz()
        else index.value++;
        alert('Correct');
    }

    const wrong_ans = () => { ////////////////////////////////// add functionality (styles and animatiion)
        alert('Wrong')
    }

</script>

<template>
    <div class="card">
        <button class="close-btn" @click="this.$router.push('/')">x</button>
        <button class="reverse-btn" @click="revers_card=!revers_card"><svg fill="white" width="20px" height="20px" viewBox="-1 -4.5 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-refresh-reverse"><path d='M4.859 5.308l1.594-.488a1 1 0 0 1 .585 1.913l-3.825 1.17a1 1 0 0 1-1.249-.665L.794 3.413a1 1 0 1 1 1.913-.585l.44 1.441C5.555.56 10.332-1.035 14.573.703a9.381 9.381 0 0 1 5.38 5.831 1 1 0 1 1-1.905.608A7.381 7.381 0 0 0 4.86 5.308zm12.327 8.195l-1.775.443a1 1 0 1 1-.484-1.94l3.643-.909a.997.997 0 0 1 .61-.08 1 1 0 0 1 .84.75l.968 3.88a1 1 0 0 1-1.94.484l-.33-1.322a9.381 9.381 0 0 1-16.384-1.796l-.26-.634a1 1 0 1 1 1.851-.758l.26.633a7.381 7.381 0 0 0 13.001 1.25z' /></svg></button>
        <div class="word-card" v-if="!revers_card">
            <div class="word-answer">
                <input 
                    autofocus 
                    @keydown.enter="check_ans(words_arr[index].word)" 
                    type="text" 
                    name="word" 
                    id="word" 
                    v-model="word_ans"
                    autocomplete="off"
                />
            <div class="word-type">({{ words_arr[index].type }})</div>
            </div>
            <div class="scroll-area">
                <div class="word-definition"> 
                    Definitions:
                    <ul>
                        <li v-for="definition in words_arr[index].definitions" :key="definition"> {{ definition }}</li>
                    </ul>
                </div>
                <div class="word-examples">
                    Examples:
                    <ul>
                        <li v-for="example in words_arr[index].examples" :key="example"> {{ example }}</li>
                    </ul>
                </div>
            </div>
            <button 
                class="check-ans" 
                @click="check_ans(words_arr[index].word)"
                :disabled="!word_ans"
            >
                Check
            </button>
        </div>
        <!-- Reverse card  -->
        <div class="word-card" v-if="revers_card">
            <div class="word-answer">
                <input type="text" name="word" id="word_ans" disabled :value="words_arr[index].word">
                <div class="word-type">({{ words_arr[index].type }})</div>
            </div>
            <div class="scroll-area">
                <div class="word-definition"> 
                    Definitions:
                    <ul>
                        <li v-for="definition in words_arr[index].definitions" :key="definition"> {{ definition }}</li>
                    </ul>
                </div>
                <div class="word-examples">
                    Examples:
                    <ul>
                        <li v-for="example in words_arr[index].examples" :key="example"> {{ example }}</li>
                    </ul>
                </div>
            </div>
            <button class="check-ans" @click="skip_word()">Skip</button>
        </div>
    
    </div>
</template>

<style scoped>

.card {
    width: 90vw;
    height: 90vh;
    margin: auto;
    background-color: #1d1d1d;
    display: flex;
    align-content: center;
    position: absolute;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    position: absolute;
    border-radius: 20px;
    color: white;
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

.reverse-btn, .close-btn {
    width: 30px;
    height: 30px;
    position: absolute;
    padding: 0;
    background-color: transparent;
    border-width: 0;
    border-radius: 50%;
}

.reverse-btn {
    top: 8px;
    right: 8px;
}

.close-btn {
    top: 8px;
    left: 8px;
    font-size: 25px;
    color: white;
    background-color: darkred;

}

.reverse-btn:hover {
    background-color:  #3d3d3e;
}

.close-btn:hover {
    background-color:  red;
}

.word-answer {
    width: 100%;
    margin: auto;
    margin-top: 25px;
}

input {
    width: 80%;
    margin-inline: 10%;
    text-align: center;
    border-width: 0;
    background-color: rgb(255, 255, 255);
    border-radius: 25px;
    height: 3rem;
    font-size: 2rem;
}

input:focus {
    outline: none;
    background-color: rgb(255, 255, 255);
}

.check-ans{
    width: 50%;
    min-width: 300px;
    margin: auto;
    height: 3rem;
    font-size: 2rem;
    border-width: 0;
    background-color: #3986d4;
    border-radius: 10px;
}

.check-ans:disabled {
    background-color: gray;
}

.word-type {
    width: fit-content;
    margin: auto;
    font-style: italic;
    font-size: 1.5rem;
}

.scroll-area {
    width: 80%;
    max-height: 60%;
    height: fit-content;
    overflow-y: scroll;
}

.scroll-area::-webkit-scrollbar {
  width: 12px;               /* width of the entire scrollbar */
}

.scroll-area::-webkit-scrollbar-thumb {
  background-color: #3d3d3d;    /* color of the scroll thumb */
  border-radius: 20px;       /* roundness of the scroll thumb */
  border: 3px solid #1d1d1d;  /* creates padding around scroll thumb */
}
.word-definition, .word-examples {
    width: 100%;
    text-align: left;
    font-weight: bold;
    font-size: 1.3rem;
}


</style>