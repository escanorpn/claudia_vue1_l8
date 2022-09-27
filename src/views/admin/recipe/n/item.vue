<template>
  <div data-v-5e2edc68="" data-v-40b8d964="" class="mb-4 col-md-4" data-v-320224c2="" v-if="post.name" v-on:click="g2p"
  >
  
  
       <mdb-card v-animateOnScroll="{animation: 'fadeInLeft', delay: 30}" wide >
          <mdb-view hover cascade class="ms">
          <a-carousel effect="slide" arrows autoplay  >
      <div
        slot="prevArrow"
        class="custom-slick-arrow"
        style="left: 10px;zIndex: 1"
      >
        <a-icon type="left-circle" />
      </div>
      <div slot="nextArrow"  class="custom-slick-arrow" style="right: 10px">
        <a-icon type="right-circle" />
      </div>
    
      <div  v-for="(item,index) in sm1" :key="index"  >
     
        <!-- <img  :src="murl+item.url" alt="Card image cap" class="ms1"/> -->
                <div class="bgImg" :style="{backgroundImage:`url(${murl+item.url})`}"></div>
  
                  <mdb-mask flex-center waves overlay="white-slight"></mdb-mask>
      </div>
    </a-carousel>
              <!-- <slider ref="slider" :options="options">
           
            <slideritem v-for="(item,index) in someList" :key="index" > 
           <div>
        <mdb-card-image  :src="item.html" alt="Card image cap" ></mdb-card-image>
                  <mdb-mask flex-center waves overlay="white-slight"></mdb-mask>
      </div>
              </slideritem>
            
            <div slot="loading">loading...</div>
        </slider> -->
         
         
          </mdb-view>
          <mdb-card-body class="text-center pb-0" cascade>
       
     <h5 style="text-align: center;color:#000000d9">{{post.name }}</h5> 
     <h5 style="text-align: center;color:#000000d9">{{post.id }}</h5>   
  <!-- <p style="text-align: center;"><b>Price: </b> {{post.price }}</p> -->
          <!-- <h4><b>Description</b></h4> -->
          <!-- <p v-if="post.description!='null'">{{post.description}}</p> -->
          </mdb-card-body>
      
         <div  style="margin-left: auto;margin-right: auto;">
           <!-- <mdb-btn  color="primary"  rounded style="float:left;backgroundColor:#275d2b" @click.native="modal = true">preview</mdb-btn>
               <a href="tel:0702220000">
               <mdb-btn color="primary" rounded >Call</mdb-btn>
          </a>
         <mdb-btn  color="primary" rounded style="float:" @click="showDrawer">Buy</mdb-btn> -->
        <!-- <mdb-btn style="color:#e9ecef;background-color: #ff3547;" color="" type="submit">Read the post</mdb-btn> -->
         </div>
         <div class="float-center" style="margin-left: auto;margin-right: auto;" @click="reload">
          <mdb-btn  color="danger" rounded>Delete</mdb-btn></div>
      </mdb-card>
  
  
        <md-snackbar :md-active.sync="userSaved">{{ sMsg }}</md-snackbar>
          </div>
  </template>
  
  <script>
  import {  mdbBtn, mdbCard, mdbCardBody,mdbView,mdbMask, animateOnScroll,
        } from 'mdbvue';
        
import api from "../../../services/api";
  // import { slider, slideritem } from 'vue-concise-slider'
  export default {
     name: 'HomePage',
    components: {
  
    mdbCard,
    mdbBtn,
    mdbCardBody,
    mdbView,
    mdbMask,
  
    },  directives: {
      animateOnScroll
    },
    props: {
      post: {
        type: Object,
        required: true,
      },
    },
    data() {
    return {
      sMsg:"",
      userSaved:false,
       visible: false,
        placement: 'bottom',
      modal: false,
      isBold: false,
       murl:this.$store.state.iUrl,
       sm1:[],
       
          //Slider configuration [obj]
          options: {
            currentPage: 0,
            effect:'slide',
            // thresholdDistance: 500,
            // thresholdTime: 100,
            // autoplay:3000,
            loop:true,
            // preventDocumentMove:true
            // // direction:'vertical',
            // loopedSlides:1,
            // slidesToScroll:1
          }
      
    }
  },
    methods: {
      reload(){
  //  this.$parent.loading();
   
   this.id=this.post.id;
 
      console.log("item_reload"+this.id);

api.delete('recipe/'+this.id).then((response) => {
      console.log("del response: "+ JSON.stringify(response));
      // const myData = response.data
        
 if(response.data.val==2 ){
            this.$parent.reload(this.post);
              console.log("item_deleted"+this.id);
          }
        // this.$parent.done();
        // console.log("products"+JSON.stringify(myData))
   
}).catch(function (response) {
          //handle error
          console.log("error"+JSON.stringify(response))
      });
       

    },
      g2p(){
        // this.$router.push('/Pitem');
        // this.$store.commit('pdata',this.post)
        //  this.$router.push({ path: '/Ritem', })
        // alert("foo")
      },
      showDrawer() {
        this.visible = true;
      },
      onClose() {
        this.visible = false;
      },
      
  
    },
    mounted() {
    //  alert("gg")
      this.sm1=this.post.images;
      console.log("folio: "+JSON.stringify(this.post.images))
    },
  }
  </script>
  <style scoped>
  .card{
    width: 100%;
  }
  .bgImg{
    height:40vh;
    width:100%;
    background-size:cover;
    background-attachment: fixed;
    background-position: center;
  }
  .ms{
        box-shadow: 0 5px 11px 0 rgb(0 0 0 / 18%), 0 4px 15px 0 rgb(0 0 0 / 15%);
      /* margin-left: -22px;
      margin-right: -22px; */
      /* margin-top: 22px; */
      margin-bottom: 22px;
      background-color: #e9ecef;
  }
  .ms2{
    /* max-width: 1340px;
      width: 100%;
      max-width: 100%;
      height: 2222px; */
      /* max-height: 234px; */
      
      margin-left: auto;
      margin-right: auto;
  }
  .ms1{
    /* max-width: 340px;
      width: 100%; */
      max-width: 100%;
      /* height: 2222px; */
      max-height: 234px;
      
      margin-left: auto;
      margin-right: auto;
  }
  
  #ms2 .ant-carousel >>> .slick-slide {
    text-align: center;
    height: 30px;
    /* max-height: 360px; */
    /* height: 70%; */
    line-height: 160px;
    background: #02050a;
    overflow: hidden;
  }
  /* For demo */
  .ant-carousel >>> .slick-slide {
    text-align: center;
    height: 230px;
    /* max-height: 360px; */
    /* height: 70%; */
    line-height: 160px;
    background: #02050a;
    overflow: hidden;
  }
  
  .ant-carousel >>> .custom-slick-arrow {
    width: 25px;
    height: 25px;
    font-size: 25px;
    color: #fff;
    background-color: rgba(31, 45, 61, 0.11);
    opacity: 0.3;
  }
  .ant-carousel >>> .custom-slick-arrow:before {
    display: none;
  }
  .ant-carousel >>> .custom-slick-arrow:hover {
    opacity: 0.5;
  }
  
  .ant-carousel >>> .slick-slide h3 {
    color: #fff;
  }
  .ant-carousel .slick-dots li{
  background-color: aqua;
  }
  .card .card-body{
      margin-top: -32px;
      font-family: Arial, Helvetica, sans-serif;
  }
  </style>