<template>
   <div class="header">
        <p class="header_menuLink"><router-link :to="{name:'menulist'}"><font-awesome-icon icon="fa-solid fa-mug-saucer" style="color: #00552e;"/></router-link></p>
   </div>
</template>

<script>
export default {
    data(){
        return {
	        title:"Header",
		      text:"Hello Vue.js!"
	    }
    },
    methods:{
	    }
}