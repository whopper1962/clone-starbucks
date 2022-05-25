<template>
<div>
   <font-awesome-icon icon="fa-solid fa-mug-saucer"/>
  <h1>Hello{{msg}}{{flag ? "VUEJS" : "vue.js" }}</h1>
  <button @click=click>クリック1</button>
  <button @click=click_1>クリック2</button>
  <h2 @click="api()">{{apimsg}}</h2>

  <a @click="apisecond()">これは二回目のapi取得：{{apiseconditem}}</a>

  <p @click="apiapiapi()">これは3回目のapi:{{apiapiapiitem}}</p>


  <h1 @click="rikotest()">最後:{{rikoriko}}</h1>

  <h2 @click="last()">{{rikolast}}</h2>

  <h1 class="hoge" @click="hoge()">昨日の復習::{{huga}}</h1>

  <div class="btn">
      <button v-on:click="active01=!active01" v-bind:class="{active:active01}">ボタ
      </button>
  </div>
</div>
</template>
<script>
export default {
  data () {
    return {
        msg:"Vue.js!!",
        flag: true,
	      apimsg:"apimsg",
	      apiseconditem:"apisecond",
	      apiapiapiitem:"初期値",
	      rikoriko:"最終",
	      rikolast:"111111",
	      huga:"初期値",
	      active01:false
    };
  },
  methods:{
     click(){
        if(this.msg === "VUEJS"){
	         this.msg = "vue.js"
	      }else {
        this.msg = "VUEJS"
	    }
    },
    click_1() {
      this.flag = !this.flag
    },
    api(){
      axios.get('/api/test')
      .then((response)=>{
      	const apitest = response.data;
	      this.apimsg = apitest
			}).catch((error)=>{
			})
    },
    apisecond(){
        axios.get('/api/apitest')
	      .then((response)=>{
		      this.apiseconditem = response.data
	      }).catch((error)=>{console.log(error)})
    },
    apiapiapi(){
        axios.get('/api/apitest2')
	      .then((response)=>{
	        this.apiapiapiitem = response.data
	      }).catch(()=>{})
    },

    rikotest(){
        axios.get('api/riko')
	      .then((res)=>{
	          this.rikoriko = res.data
	      }).catch((error)=>{})
    },
    last(){
       axios.get('api/last')
       .then((res)=>this.rikolast = res.data).catch((error)=>{})
    },
    hoge(){
        axios.get('api/hoge')
	      .then((res)=>{
	      this.huga = res.data
	      }).catch((error)=>{})
    }
  }
}
</script>

<style scoped>
    .hoge {
        background-color:blue;
	      color:yellow;
        }
     .btn .active{
         color:yellow;
	       background-color:#000;
     }

</style>