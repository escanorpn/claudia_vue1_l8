<template>
   
<div data-v-320224c2="" data-v-40b8d964="" class="row" data-v-35ea163e="" style="" id="div2">
  <div class="loading-box" v-if="sending">
                <div class="loader"></div>
              </div>
    <item v-for="(post, index) in posts" :key="index" :post="post" />
    
  </div>
  
</template>

<script>
import item from "./item.vue"
export default {
  props: {
    posts: {
      type: Array,
      required: true,
    },
  },
  data:()=>({
 sending: false,
  }),
  methods:{
    reload(a){
       console.log("list_reload");
       
const index = this.posts.indexOf(a);
if (index > -1) { // only splice array when item is found
  this.posts.splice(index, 1); // 2nd parameter means remove one item only
}
      //  this.posts=a;
       console.log("delresult: "+JSON.stringify(this.posts))
      //  this.$forceUpdate()
        // this.$parent.fetchNews();
    },
     loading(){
       console.log("loading");
        this.sending=true;
    },
     done(){
      //  console.log("list_reload");
        this.sending=false;
    },
  },
  components: {
    item,
  },
  mounted(){
    // alert("list:"+JSON.stringify(this.posts))
  }
}
</script>

<style>
#div2{
width: 100%; max-width: 1300px; padding: 2px;margin-top: 20px;
 margin-right: auto; margin-left: auto;  
 box-shadow: 0px 8px 22px #00000036;
}

.loading-box{
     position: fixed;
    width: 100%;
    height: 5px;
    border-radius: 50px;
    /* border: 2px solid #ededed; */
    overflow: hidden;
    top: 38px;
    left: 0;
}
.loader{
    width: 100%;
    height: 100%;
    position: absolute;
    border-radius: 50px;
    background: linear-gradient(45deg, #3c0d0b,#b6b5ff, #ff9797,#3c0d0b);
    left: 0%;
    animation: load 1s linear infinite;
}


@keyframes load{
    0%{
        left: -100%;
    }
    100%{
        left: 100%;
    }
}
</style>