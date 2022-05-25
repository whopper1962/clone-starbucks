<template>
<div>
  <h1>ID:{{ tweetId }}</h1>
  {{ tweet }}
  <p>ここに投稿を表示させたい</p>
      <button @click="addfavorite(tweetId); delfavorite(tweetId)">保存する</button>
      <template v-for="(image,index) in images">
        <img
	          :key="`image_${index}`"
		        :src="`/images/${image.image_path}`"
			      style="width:200px"
	      />
      </template>
</div>
</template>
<script>
export default {
  data () {
    return {
      tweetId: null,
      tweet: {},
      images:[],
      itemId: null,
    }
  },
  created () {
    this.tweetId = this.$route.params['tweet_id'];
    this.getTweet();
    this.getImages();
  },
  methods: {
    getTweet () {
      axios.get(`/api/tweets/${this.tweetId}`).then((res) => {
        console.error(res);
        this.tweet = res.data;
	      this.itemId = res.data.item_id;
      }).catch((err) => {
        console.error(err);
      });
    },
    getImages(){
      axios.get(`/api/tweets/tweetimage/${this.tweetId}`).then((res)=>{
        this.images = res.data;
	      console.log("イメージの配列",this.images);
	     }).catch((erroro)=>{ console.log(error) })
	  },
	  addfavorite(tweetId){
	   axios.get(`/api/tweet/drink/${tweetId}`)
	   .then((res)=>{
	     console.log('イイネされました');
	    }).catch((err)=>{
	     console.log(err);
	    });
	  },
    delfavorite(tweetId){
      axios.delete(`/api/tweet/drink/${tweetId}`)
      .then((res)=>{
        console.log('イイネがはずされました');
	    }).catch((err)=>{
	     console.log(err);
	    });

    }
  }
}
</script>
