<template>
    <div>
        <h1 class="black" @click="kotei()">これは固定コンポーネント!{{test}}</h1>
    </div>
</template>
<script>
    export default {
        data(){
	        return {
		          test:"初期値"
		      }
	     },
	     methods :{
	       kotei(){
	           this.test = "固定！！"
	        }
	     }
    }
</script>
<style>
    .black {
        background-color:#000;
	      color:#fff;
    }
</style>