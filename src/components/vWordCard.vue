<script setup>

    import { ref, onBeforeMount } from 'vue';

    const getWords4Today = async (userID) => {
        try {
            const url = 'https://www.ukrge.site/learn_words/API/get_today_words.php'
            const body = {
                user_id: userID,
            };

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    "Content-type": 'application/json',
                },
                body: JSON.stringify(body)
            });

            const result = await response.json()
            words_arr.value = result['list'];
            console.log(words_arr.value)
        }
        catch (error) {
            console.error(error)
        }
    }

    onBeforeMount(() => {
        getWords4Today(1)
    })

    const index = ref(0)
    const words_arr = ref([]);

    const revers_card = ref(false)

    const word_ans = ref('')

    const check_ans = (wordObj) => {
        if(word_ans.value === wordObj.word) {
            correct_ans(wordObj);
        }
        else wrong_ans();
    }

    const skip_word = () => {
        if(words_arr.value.length-1<=index.value) finish_quiz()
        else index.value++;
        revers_card.value = false;
    }

    const finish_quiz = () => {  ////////////////////////////////// add functionality
        index.value = 0;
        this.$router.push('/');
    }

    const saveWordProgress = async (word_done) => {

        try {
        const url = 'https://www.ukrge.site/learn_words/API/save_word_progress.php'


        console.log(JSON.stringify(word_done))

        const response = await fetch(url, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify(word_done)
        })

        if(!response.ok) {
            throw new Error('Network is not ok.')
        }

        const responseData = await response.json();
        console.log('Response:', responseData)

        return;
        } catch (error) {
        console.error('Error', error.message);
        throw error;
        }
    }  

    const correct_ans = async (wordObj) => { ////////////////////////////////// add functionality (styles and animatiion) передавати об'єктб і при правильній відповіді відправляти об'єкт на сервер.
        const word_done = {
            id: wordObj.id,
            user_id: wordObj.user_id,
        }
        await saveWordProgress(word_done)

        word_ans.value = ''
        if(words_arr.value.length-1<=index.value) finish_quiz()
        else index.value++;
        alert('Correct');
    }

    const wrong_ans = () => { ////////////////////////////////// add functionality (styles and animatiion)
        alert('Wrong')
    }

</script>

<template>
    <Transition>
    <div class="card"  v-if="!revers_card && words_arr.length">
        <button class="close-btn" @click="this.$router.push('/')">x</button>
        <button class="reverse-btn" @click="revers_card=!revers_card"><svg fill="white" width="20px" height="20px" viewBox="-1 -4.5 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-refresh-reverse"><path d='M4.859 5.308l1.594-.488a1 1 0 0 1 .585 1.913l-3.825 1.17a1 1 0 0 1-1.249-.665L.794 3.413a1 1 0 1 1 1.913-.585l.44 1.441C5.555.56 10.332-1.035 14.573.703a9.381 9.381 0 0 1 5.38 5.831 1 1 0 1 1-1.905.608A7.381 7.381 0 0 0 4.86 5.308zm12.327 8.195l-1.775.443a1 1 0 1 1-.484-1.94l3.643-.909a.997.997 0 0 1 .61-.08 1 1 0 0 1 .84.75l.968 3.88a1 1 0 0 1-1.94.484l-.33-1.322a9.381 9.381 0 0 1-16.384-1.796l-.26-.634a1 1 0 1 1 1.851-.758l.26.633a7.381 7.381 0 0 0 13.001 1.25z' /></svg></button>

            <div class="word-card">
                <div class="word-answer">
                    <input 
                        autofocus 
                        @keydown.enter="check_ans(words_arr[index])" 
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
                            <li v-for="definition in words_arr[index].definition" :key="definition"> {{ definition }}</li>
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
                    @click="check_ans(words_arr[index])"
                    :disabled="!word_ans"
                >
                    Check
                </button>
            </div>
    </div>
    </Transition>

    <Transition>
    <div class="card" v-if="revers_card  && words_arr.length">
        <button class="close-btn" @click="this.$router.push('/')">x</button>
        <button class="reverse-btn" @click="revers_card=!revers_card"><svg fill="white" width="20px" height="20px" viewBox="-1 -4.5 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-refresh-reverse"><path d='M4.859 5.308l1.594-.488a1 1 0 0 1 .585 1.913l-3.825 1.17a1 1 0 0 1-1.249-.665L.794 3.413a1 1 0 1 1 1.913-.585l.44 1.441C5.555.56 10.332-1.035 14.573.703a9.381 9.381 0 0 1 5.38 5.831 1 1 0 1 1-1.905.608A7.381 7.381 0 0 0 4.86 5.308zm12.327 8.195l-1.775.443a1 1 0 1 1-.484-1.94l3.643-.909a.997.997 0 0 1 .61-.08 1 1 0 0 1 .84.75l.968 3.88a1 1 0 0 1-1.94.484l-.33-1.322a9.381 9.381 0 0 1-16.384-1.796l-.26-.634a1 1 0 1 1 1.851-.758l.26.633a7.381 7.381 0 0 0 13.001 1.25z' /></svg></button>
        <!-- Reverse card  -->
        
            <div class="word-card" >
                <div class="word-answer">
                    <input type="text" name="word" id="word_ans" disabled :value="words_arr[index].word">
                    <div class="word-type">({{ words_arr[index].type }})</div>
                </div>
                <div class="scroll-area">
                    <div class="word-definition"> 
                        Definitions:
                        <ul>
                            <li v-for="definition in words_arr[index].definition" :key="definition"> {{ definition }}</li>
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
</Transition>
</template>

<style scoped>

@keyframes loading1 {
  0% {
    opacity: 0;
    transform: perspective(1000px) rotateX(0deg) rotateY(0deg);
  }


  50% {
    opacity: 0;
    scale: .5;
    transform: perspective(1000px) rotateX(0deg) rotateY(-90deg);
  }

  100% {
    opacity: 1;
    transform: perspective(1000px) rotateX(0deg) rotateY(0deg);
  }
}

@keyframes loading2 {
  0% {
    opacity: 1;
    transform: perspective(1000px) rotateX(0deg) rotateY(-0deg);
  }

  50% {
    opacity: 0;
    scale: .5;
    transform: perspective(1000px) rotateX(0deg) rotateY(-90deg);
  }


  100% {
    opacity: 0;
    transform: perspective(1000px) rotateX(0deg) rotateY(-0deg);
  }
}

.v-enter-active {
    animation: loading1 1s ease;
}


.v-leave-active {
    animation: loading2 1s ease;
}


.card {
    width: 90vw;
    height: 90vh;
    margin: 0;
    background-color: #1d1d1d;
    display: flex;
    align-content: center;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    position: fixed;
    border-radius: 20px;
    color: white;
    overflow: hidden;
}

.word-card {
    position: absolute;
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
    z-index: 2;
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