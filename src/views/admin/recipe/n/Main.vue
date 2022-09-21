<template>
<div :style="{ padding: '0px', background: '#fff', minHeight: '360px',paddingRight:'0px',
    paddingLeft: '0px'}">
  <div class="loading-box" v-if="loading">
                <div class="loader"></div>
              </div>
<div class="card white lighten-1 black-text" style="box-shadow:rgb(34 94 222 / 19%) -1px -11px 32px;width: 100%; max-width: 1300px;margin-left:auto; margin-right: auto;    border-radius: 0.25rem;margin-top: 25px;adding-right: 0px;
    padding-left: 0px;">
    <div class="card-body" style="color: rgba(1, 5, 9, 0.63);background: linear-gradient(21deg, white 9%, white 57%, #d9d0d000 1%) center center / cover fixed;">

      <mlist :posts="products" :key="list_key" />

      <mdb-row>
      <mdb-col col="sm">
        <mdb-btn style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;" color="" type="submit" v-on:click="previous">Previous</mdb-btn>
      </mdb-col>
      <mdb-col col="sm">
        <!-- <mdb-btn style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;" color="" type="submit">Next</mdb-btn> -->
      </mdb-col>
      <mdb-col col="sm">
        <mdb-btn style="color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;" color="" type="submit" v-on:click="next">Next</mdb-btn>
      </mdb-col>
      </mdb-row>
      
  
      <!-- <mlist :posts="products" :key="list_key" /> -->
</div>
</div>
</div>
</template>

<script>
import mlist from "./list.vue"
import api from "../../../services/api";
import {  mdbCol, mdbRow,mdbBtn, } from 'mdbvue';


export default {
  name: 'Recipe_main',
  components: {
  
    mlist,
    mdbCol,
    mdbRow,
    
    // mdbIcon,
    mdbBtn,
    // mdbInput,
    // mdbCardBody
  },
  // props: ['name',],


  data() {
    return {
       top:50,
       top1:50,
      products: [],
      mItems: [],
      sending: false,
      loading: false,
      loading1: true,
      dList:false,
      cRequest:false,
      list_key:0,
      bottom: false,
      lastId:1,
      counter:3,
      direction:1
    }
  },
  watch: {
    bottom(newValue) {
      if (newValue) {
        this.addMore();
        console.log(newValue)
      }
    }
  },
  created() {
    // this.lastId=0;
 
  },
  methods: {
    bottomVisible() {
      const scrollY = window.scrollY+150;
      const visible = document.documentElement.clientHeight;
      const pageHeight = document.documentElement.scrollHeight;
      const bottomOfPage = visible + scrollY >= pageHeight;
      // console.log("scrollY: "+scrollY+" visible: "+visible+" pageHeight:"+pageHeight+" bottomOfPage:"+bottomOfPage)
      return bottomOfPage || pageHeight < visible;
    },
    addMore() {
      // alert("more")
      // this.fetchFolio();
    },
      reload(){
      console.log("reloading...");
      // this.list_key=this.list_key+1;
       this.refresh();
       this.fetchFolio();
    },
    refresh(){
      console.log("refreshing...");
      this.list_key=this.list_key+1;
    },

     keymonitor(event) {
     
        // console.log(event.target.value);
        if(event.target.value!= ""){
        this.mSearch(event.target.value);
        
        }else{
           this.mItems=[]; 
           this.dList=false;
        }
    },
    
   // Helper function for extracting a nested image object
   onCollapse(collapsed, type) {
      console.log(collapsed, type);
    },
    onBreakpoint(broken) {
      console.log(broken);
    },
    
      g2r(d){
      // this.$router.push('/Pitem');
      this.$store.commit('pdata',d)
       this.$router.push({ path: '/Ritem', })
      // alert("foo")
    },
    async mSearch(search) {
      let mData={
        s:search
      }
      const context=this;
  this.loading=true;
              await api.post('srecipe',mData).then((response) => {
                  this.loading=false;
        // console.log("srecipe: "+ JSON.stringify(response));
        // console.log("srecipe: "+ response);
        const myData = response.data
       
      if(response.val==2){
          this.cRequest=false;
          // console.log(myData)
           this.mItems = myData
           
           this.dList=true;
        }else if(response.val==0){
           
           this.dList=false;
           this.cRequest=true;
        }

          // console.log("products"+JSON.stringify(myData))
     
  }).catch(function (response) {
      context.loading=false;
            //handle error
            console.log("error: "+response)
        });
    },
    previous(){
      if(this.lastId-this.counter>1){
        // this.lastId=this.lastId-this.counter;
        // alert(this.lastId)
        this.direction=2;
        this.fetchFolio() 
      }
      // this.fetchFolio1() 
    },
    
    next(){
      this.direction=1;
      this.fetchFolio() 
      // this.lastId=this.lastId+this.counter;
      
    },
    async fetchFolio() {
      const context=this;
      this.loading=true;
      let mData={
        id:this.lastId,
        counter:this.counter,
        direction:this.direction
      }
              await api.post('recipe1',mData).then((response) => {
                  this.loading=false;
        // console.log("mData: "+ JSON.stringify(mData));
        // console.log("response: "+ JSON.stringify(response.data.val));
     
        const myData = response.data.data
        if(this.direction==2){
           myData.reverse()
        }
        // let newData 
      if(response.data.val==2){
          // console.log("products1"+JSON.stringify(myData))
          // alert("data")
          // const lastData1 = myData;
          // const lastData = lastData1.reverse()[0];
          // const lastData = myData.reverse()[0]; 
          
          // console.log("lastData.id: "+JSON.stringify(lastData.id))
        
          this.products= myData.map(post => ({
            id: post.id,
            name: post.name,
            description: post.description,
            ctime: post.ctime,
            ptime: post.ptime,
            serving: post.serving,
            instructions: post.instructions,
            ingredients: post.ingredients, 
            images: post.images,
            
          
          }))
          this.products.forEach(element => {
            // console.log(Object.entries(element))
            // this.products.push(element)
            this.lastId=element.id
          });
          
          console.log("lastData.id: "+this.lastId)
       
          // console.log("typeofnewData[0]: "+typeof newData)
          // this.products.push(newData[0])
          // let prevData=this.products;
          // this.products = Object.assign({}, newData,prevData );
          // this.products = prevData+newData;
      }
          // console.log("new products"+JSON.stringify( this.products))
     
  }).catch(function (response) {
      context.loading=false;
            //handle error
            console.log("error: "+response)
        });
    },
    
  },
  mounted() {

     this.fetchFolio()
    this.lastId=1;
    window.addEventListener("scroll", () => {
      this.bottom = this.bottomVisible();
    });
    // this.addMore();
      console.log("loading folio")
  },

}
</script>
<style scoped>
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

.btn-default {
  margin-left: 41%;
  margin-right:45%;
 color:#e9ecef;
 background-color:#0c0f24 !important
}
 .mDiv{
    background-color: #fff;
   padding-top: 3px;
    padding-left: 3px;
 }
.md-form {
  
    /* border-radius: 30px; */
    background-color: #fff;

}
.ant-affix{
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%) ;
}
@keyframes rotate {

from {transform: rotate(0deg)}
to {transform: rotate(360deg)}

}
.refresh-start {

animation-name: rotate;
animation-duration: 1s;
animation-iteration-count: infinite;
animation-timing-function: linear;
animation-play-state: running;

}
</style>