<template>
   
<div data-v-320224c2="" data-v-40b8d964="" class="row" data-v-35ea163e=""  id="div2">
 <md-progress-bar md-mode="indeterminate" v-if="sending" />
    <item v-for="(post, index) in posts" :key="index" :post="post" />
    <!-- <VueSlickCarousel v-bind="settings">
     <item v-for="(post, index) in posts" :key="index" :post="post" />
    </VueSlickCarousel> -->
    <div></div>
     <!-- <VueSlickCarousel v-bind="settings">
      <item1 v-for="(post, index) in posts" :key="index" :post="post" />
      <div></div>
      
    </VueSlickCarousel> -->
  </div>
  
</template>

<script>
import item from "./sitem.vue"
// import item1 from "./item.vue"
// import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
  // optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
export default {
  props: {
    posts: {
      type: Array,
      required: true,
    },
  },
  data:()=>({
 sending: false,
 settings:{
  "lazyLoad": "ondemand",
 "arrows": false,
  "dots": true,
  "infinite": true,
  "slidesToShow": 4,
  "slidesToScroll": 1,
  "autoplay": true,
  "speed": 4000,
  "autoplaySpeed": 30,
  "cssEase": "linear",
  // "initialSlide": 0,
  "responsive": [
    {
      "breakpoint": 1024,
      "settings": {
        "slidesToShow": 3,
        "slidesToScroll": 3,
        "infinite": true,
        "dots": true
      }
    },
    {
      "breakpoint": 600,
      "settings": {
        "slidesToShow": 2,
        "slidesToScroll": 2,
        "initialSlide": 2
      }
    },
    {
      "breakpoint": 480,
      "settings": {
        "slidesToShow": 1,
        "slidesToScroll": 1
      }
    }
  ]
  
}
  }),
  components: {
    item,
    // item1,
    // VueSlickCarousel
  },
  methods:{
     reload(){
      //  console.log("list_reload");
        this.$parent.fetchNews();
    },
     loading(){
      //  console.log("loading");
        this.sending=true;
    },
     done(){
      //  console.log("list_reload");
        this.sending=false;
    },

  },
}
</script>

<style>
#div2{
width: 100%; max-width: 1200px; padding: 2px;margin-top: 20px; margin-right: auto; margin-left: auto;  box-shadow: 0px 8px 22px #00000036;
}
.md-progress-bar {
    position: fixed;
    height:7px;
    top: 48px;
    right: 0;
    left: 0;
    z-index: 3;
  }
</style>