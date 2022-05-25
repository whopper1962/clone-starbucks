<template>
<div>
    <p @click="apiview()">すべて</p>
    <p @click="sortPriceDesc()">値段昇順</p>
    <p @click="sortPriceAsc()">値段降順</p>
    <p @click="sortCategory('frappuccino')">ふらぺ</p>
    <p @click="sortCategory('drip')">drip</p>
    <p @click="sortCategory('espresso')">espresso</p>
    <p @click="sortCategory('roastery')">roastery</p>
    <p @click="sortCategory('tea')">tea</p>
  <div class="row menulist">
    <template v-for="(item, index) in items">
      <div class="col-lg-3 col-md-4 col-sm-6">
        <router-link :to="{name:'showitem',params:{item_id:item.id}}">
          <img class="menulist_img" :key="`item_img_${index}`" :src="`https://product.starbucks.co.jp${item.item_img}`">
        </router-link>
        <p v-html="item.product_name" :key="`item_name_${index}`">{{ item.product_name }}</p>
        <p v-html="item.price" :key="`item_catch_${index}`">{{ item.price }}円</p>
	      <template>
	         <button @click="addfavorite(item.id); delfavorite(item.id)">いいね</button>
	      </template>
      </div>
    </template>
  </div>
 </div> 
</template>
<script>
export default {
data () {
    return {
        items:[],
	      itemId:null,
	      
    }
},
created(){
    this.apiview();
},
methods:{
  apiview(){
    axios.get('/api/itemsview')
    .then((res)=>{
        this.items = res.data;
    }).catch((err)=>{console.log(err)})
  },
  addfavorite(itemId){
      axios.get(`/api/menulist/favorite/${itemId}`)
      .then((res)=>{
        console.log('イイネされました');
      }).catch((err)=>{
        console.log(err);
      });
  },
  delfavorite(itemId){
      axios.delete(`/api/menulist/favorite/${itemId}`)
      .then((res)=>{
        console.log('イイネがはずされました');
      }).catch((err)=>{
        console.log(err);
      });
  },
  sortPriceDesc(){
      axios.get('/api/getitems/price/desc')
      .then((res)=>{
        console.log('priceの降順で並び替え');
	      this.items = res.data;
      }).catch((err)=>{console.log(err)})
  },
  sortPriceAsc(){
      axios.get('/api/getitems/price/asc')
      .then((res)=>{
        console.log('priceの昇順で並び替え');
	      this.items = res.data;
      }).catch((err)=>{
        console.log(err);
      })
  },
  sortCategory(category){
      axios.get(`/api/getitems/category/${category}`)
      .then((res)=>{
        this.items = res.data;
      }).catch((err)=>{
        console.log(err);
      })
  }
}
}
</script>