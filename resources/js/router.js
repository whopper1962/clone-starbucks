import Home from "./components/Home";
import VueRouter from "vue-router";
import ShowItem from "./components/ShowItem";
import MenuList from "./components/MenuList";
import Tweet from "./components/Tweet";
import ShowTweet from "./components/ShowTweet";


const routes = [
    {
        path: "/",
        component: Home,
        name: "home"
    },
    {
       path:"/menulist/:item_id",
       component:ShowItem,
       name:"showitem"
    },
    {
        path:"/menulist",
	      component:MenuList,
	      name:"menulist"
    },
    {
        path:"/tweet",
	      component:Tweet,
	      name:"tweet"
    },
    {
        path:"/tweets/:tweet_id",
	      component:ShowTweet,
	      name:"showtweet"
    }

];

const router = new VueRouter({
    mode: 'history',
    routes,
});

export default router;