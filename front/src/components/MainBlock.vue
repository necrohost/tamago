<template>
  <div>
    <h1>Animals!</h1>
    <a @click="this.killAll()" class="btn kill">kill all</a>
  </div>
    <div>
      <div class="kind-container" v-for="kind in kinds" @click="this.createAnimal(kind.id)" v-bind:key="kind">
          <img class="animal-img" :id="kind.id" :src="baseUrl + kind.img" :alt="kind.img">
      </div>
    </div>
  <div class="container">
    <div v-for="animal in animals" v-bind:key="animal" >
      <div class="animal-container">
        <div class="animal-img" :style="{ width: animal.size + '%' }">
          <img :src="baseUrl + animal.kind.img" alt="">
        </div>
        <div class="animal-info">
          <h3 style="text-align: center">{{ animal.kind.kind }}</h3>
          <ul>
            <li>name: {{ animal.name }} </li>
            <li>age: {{ animal.age }} </li>
            <li>size: {{ animal.size }} </li>
            <li>state: {{ animal.state }} </li>
          </ul>

          <div class="btn-block">
            <a @click="this.ageAnimal(animal.id)" class="btn age">age</a>
            <a @click="this.deleteAnimal(animal.id)" class="btn del">del</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
axios.defaults.baseURL = 'http://127.0.0.1:8000';


export default {
  name: 'MainBlock',
  props: {
    msg: String
  },

  data() {
    return {
      kinds: [],
      animals: [],
      size: 0,
      baseUrl: axios.defaults.baseURL + '/',
    }
  },

  mounted() {
    this.getKinds();
    this.getAnimals();
  },

  methods: {
    getKinds() {
      axios.get('/api/kinds').then(res => {this.kinds = res.data;});
    },

    getAnimals() {
      axios.get('/api/animals').then(res => {this.animals = res.data;});
    },
    createAnimal(kind){
      axios.post('/api/animals', { kind_id:kind });
    },
    ageAnimal(id){
      axios.post('/api/animals/age', { id:id });
    },
    deleteAnimal(id){
      axios.post('/api/animals/remove', { id:id });
    },
    killAll(){
      axios.get('/api/animals/kill');
    },

    sync(){
      this.$forceUpdate();
    }
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
ul {
  list-style-type: none;
}
li{

  padding-top: 5px;
}
a {
  color: #42b983;
}
.container{
  display: grid;
  width: 80%;
  margin: 0 auto;
  grid-template-columns: repeat(4, 1fr);
}
.kind-container{
  display: inline-block;
  width: 50px;
  cursor: pointer;
}

.animal-info{
  margin: 20px;
  text-align: left;
}

.animal-container {
  margin: 20px;
  padding: 20px;
  border-radius: 10px;
  width: 300px;
  height: auto;
  box-shadow: 0 5px 10px 2px rgba(34, 60, 80, 0.2) inset;
}
.animal-img{
  margin: 0 auto;
  max-width: 300px !important;
}
img{
  width: 100%;
}
.btn-block{
  margin: 0 auto;
  width: 220px;
}
.btn{
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-left: 10px;
  display: inline-block;
  width: 50px;
  border: 1px solid darkseagreen;
  border-radius: 5px;
  padding: 10px 20px;
}

.btn:hover{
  transition: 0.3s;
  color: white;
  background-color: #42b983;
}
.kill{
  margin: 20px;
  width: 100px;
}
.kill:hover{
  border: 1px solid darkred;
  transition: 0.3s;
  color: white;
  background-color: darkred;
}
</style>
