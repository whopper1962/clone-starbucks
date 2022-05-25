<template>
    <div class="showitems">
    <div>
        <h1>今選択されている商品のitemIDは{{ itemId }}</h1>
        <h1>これは一覧画面から遷移する商品詳細画面プラス、投稿一覧ページ</h1>
	      <h1>以下商品詳細「{{ itemId }}」と一致したレコードだけを表示する</h1>
        <template v-for="(item,index) in items">
          <h3 class="showitems_ttl" v-html="item.product_name" v-if="item.id == itemId" :key="`item_name_${index}`" />
	        <div class="showitems_flexbox">
		        <img class="showitems_img" v-if='item.id == itemId' :key="`item_img_${index}`" :src="`https://product.starbucks.co.jp${item.item_img}`">
	          <div class="showitems_flexbox-item">
		        <h4 class="showitems_flexbox-item--catch" v-html="item.catchcopy" v-if="item.id == itemId" :key="`item_catch_${index}`"/>
		        <p v-html="item.product_note" v-if="item.id == itemId" :key="`item_product_${index}`"/>
		        <p v-if="item.id == itemId" :key="`item_price_${index}`"><span class="fontgray">Tall</span>&nbsp &nbsp &yen;{{ item.price }}</p>
			      <p class="fontgray">価格は税込み価格です</p>
          </div>
	      </div>
	      </template>

        <h2>みんなのカスタマイズ↓↓↓↓</h2>
        {{ details }}
	      

        <template v-for="(tweet, index) in tweets">
	      <p :key="`tweet_user_${index}`">誰の投稿か→{{ tweet.user_id }}</p>
	      <p :key="`tweet_text_${index}`">{{ tweet.text }}</p>
	      <p :key="`tweet_cream_${index}`">{{ tweet.cream }}</p>
	      <p :key="`tweet_change_cream_${index}`">{{ tweet.change_cream }}</p>
	      <p :key="`tweet_milk_${index}`">{{ tweet.milk }}</p>
	      <p :key="`tweet_powder_${index}`">{{ tweet.powder }}</p>
	      <p :key="`tweet_source_${index}`">{{ tweet.source }}</p>
	      <p :key="`tweet_ice_${index}`">{{ tweet.ice }}</p>
	        <template v-for="(image, i) in imageFilter(tweet.id)">
	          <img
		            :key="`image_${image.id}_${i}`"
			          :src="`/images/${image.image_path}`"
				        style="width: 200px"
			      />
		      </template>
	      <router-link :to="{name:'showtweet',params:{tweet_id:tweet.id}}">カスタム詳細画面へ遷移</router-link>
	      </template>
    </div>
    </div>
</template>

<script>
export default{
   data(){
       return {
           tweets: [],
	         itemId: null,
		       details:{},
		       items:[],
		       images:[]
       }
   },
   created(){
    this.itemId = this.$route.params['item_id'];
    this.getTweets();
    this.getImages();
    this.getDetail();
    this.getItems();
   },
   methods:{
       getTweets(){
           axios.get(`/api/tweets/tweet/${this.itemId}`).then((response) => {
	           this.tweets = response.data;
	       }).catch((error) => {
	           console.error(error);
	       });
	    },
	    getDetail(){
	        axios.get(`/api/tweets/${this.itemId}`).then((response)=>{
			        this.details = response.data;
			        console.log("tweet",this.details);
		      }).catch((error)=>{
		          console.error(error);
		      });
	    },
	    getItems(){//パスパラを引数にして、コントローラでそのパスパラと一致したレコードだけを取得する。
	        axios.get(`/api/tweets/custom/${this.itemId}`).then((response)=>{
		          this.items = response.data;
		      }).catch((error)=>{ console.error(error) })
	    },
	    getImages(){
	        axios.get(`/api/tweets/image/${this.itemId}`).then((response)=>{
		          this.images = response.data;
			        console.log("111",this.images);
		      }).catch((erroro)=>{ console.log(error) })
	    },
	    imageFilter(tweet_id){
	        return this.images.filter(image => {//もし、一致するtweet_idの画像をもっていない場合はエラーがでないようにしたい
	            return image.tweet_id === tweet_id
					})
	    },
   }
}
</script>
