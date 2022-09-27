<template>
  <Layout>
    <div style="margin-top: -15px; overflow-x: ;">
       <mdb-progress-bar md-mode="indeterminate" v-if="sending" />
       <mdb-edge-header color="" style="background-color: #3c0d0b ">
        <div class="home-page-background"></div>
           <div class="container">
           
        <div class="row">
          <div class="col-lg-8 text-center mx-auto" style="margin-top:87px;position: fixed;">
          <!-- <h1 class="text-white pt-3 mt-n5" style=" font-weight: 900;color: #ffffff;text-shadow: #cb6dff 1px 1px 2px;margin-top: 5px;margin-left: auto;margin-right: auto;" >Portfolio</h1> -->
        </div>
        </div>
           </div>
      </mdb-edge-header>
      <div style="margin-bottom: 222px;margin-top: -157px;">
          <a-affix :offset-top="top"  >
     
            <input class="form-control search_input dProperty mDiv" id="search" style="float:;border-radius: 50px 50px;max-width: 400px;text-align:left;margin-left: auto;margin-right: auto;padding-left:32px;cursor:text; box-shadow:12px 12px 12px black;box-shadow: 1px 6px 14px 6px #09131596;margin-bottom:33px" type="search" placeholder="Search" aria-label="Search"  v-on:keyup="keymonitor"/>
           
                <mdb-list-group v-if="dList">
                  <div style="margin-top: -22px;box-shadow: rgb(9 19 21 / 59%) 1px 6px 14px 6px;max-width: 410px;
                  margin-left: auto;
                  margin-right: auto;
                  width: 80%;">
                  <mdb-list-group-item  :action="true"  v-for="(item,index) in mItemsList" :key="index"   >
                  <div @click="g2r(item)">{{item.name}}</div >
                  </mdb-list-group-item>
                  </div>
                </mdb-list-group>   

                <mdb-list-group v-if="cRequest">
                  <div style="margin-top: -22px;box-shadow: rgb(9 19 21 / 59%) 1px 6px 14px 6px;max-width: 410px;
                  margin-left: auto;
                  margin-right: auto;
                  width: 80%;">
                  <mdb-list-group-item  :action="true" href="#" tag="a">Make request for this product?</mdb-list-group-item>
                  </div>
                </mdb-list-group>

            </a-affix>
        </div>

        <a-layout id="components-layout-demo-responsive" style="padding-top: 2px; margin-top: -174px;    background: #3b3b3b">
    <a-affix :offset-top="top" class="mTop" style="background: #110303;" >
    <a-layout-sider 
      breakpoint="lg"
      collapsed-width="0"
      style="color:#fff;background-color:transparent; text-shadow: 1px 1px 2px black;
    font-weight: 600 !important;margin-top:22px;"
    >
   <p style="margin-left:12px"><u>Recommendations</u></p>

      <ul v-for="(item,index) in mItems" :key="index" >
        <li @click="g2r(item)" style="cursor:pointer">{{item.name}} </li>
       
      </ul>
    </a-layout-sider>
    </a-affix>
    <a-layout class="mTop" >
      <!-- <a-layout-header :style="{ background: '#fff', padding: 0 }" /> -->
      <a-layout-content :style="{ margin: '54px 16px 0' }">
        <div :style="{ padding: '24px', background: '#fff', minHeight: '360px' }">

          <div class="wrap" style="max-width: 1500px;">
			<div class="card text-center"   style="width: 100%; max-width: 1200px; margin-right: auto; margin-left: auto; margin-top: -142px;background: linear-gradient(#483f3f 15%, #ffffff 3%, #ffffff 71%, #3c0d0b 44%);box-shadow:rgb(40 18 10 / 59%) 0px 32px 32px;" >
			<div class="card-body">
				<h2 style="color:white;text-shadow: 1px 1px 2px black;margin-top: -15px;text-shadow: 4px 2px 2px #2c0406;">
					<b>{{products.name }}</b>
				</h2>
<folio :posts="mItems" :key="list_key" />
<div v-html="products.description"></div>
</div>
  
    <Recipe/>
    <mdb-btn style="width:50%;margin-left:auto;margin-right:auto;color:#e9ecef;background: linear-gradient(315deg,#3f0d12,#a71d31 74%);box-shadow: rgb(38 3 3) 1px 5px 5px;" color="" type="submit" v-on:click="print">Print</mdb-btn>
  </div>
  </div>
        </div>
      </a-layout-content>
    </a-layout>
  </a-layout>
     </div>
   
  </Layout>
</template>

<script>
import folio from "./folio.vue"
import Recipe from "./Recipe.vue"
import {  mdbEdgeHeader, mdbListGroup,mdbListGroupItem,mdbBtn,mdbProgressBar } from 'mdbvue';
// import data from "./posts.json"

export default {
  name: 'pItem',
  components: {
    // Layout,
    // NewsFilter,
    // mylist,
      mdbListGroup,
      mdbListGroupItem,
    Recipe,
    mdbEdgeHeader,
    mdbProgressBar,
    // mdbIcon,
    mdbBtn,
    folio
    // mdbInput,
    // mdbCardBody
  },
  // props: ['name',],


  data() {
    return {
       top:50,
       top1:50,
      products: [],
      mItemsList: [],
      mItems: [],
      loading: false,
      sending: false,
      dList:false,
      cRequest:false,
      list_key:0,
      printing:false,
    }
  },
  methods: {
    print(){
      // this.printing=true;
      // this.$router.push({ path: '/Print', })
      window.print()
    },
         keymonitor(event) {
     
        console.log(event.target.value);
        if(event.target.value!= ""){
        this.mSearch(event.target.value);
        
        }else{
           this.mItemsList=[]; 
           this.dList=false;
        }
    },
      g2r(d){
      // this.$router.push('/Pitem');
      
    this.mItems=d.images
    this.products=d
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
              await this.$api.$post('srecipe',mData).then((response) => {
                  this.loading=false;
        // console.log("srecipe: "+ JSON.stringify(response));
        console.log("srecipe: "+ response);
        const myData = response.data
       
      if(response.val==2){
          this.cRequest=false;
          console.log(myData)
           this.mItemsList = myData
           
           this.dList=true;
        }

          // console.log("products"+JSON.stringify(myData))
     
  }).catch(function (response) {
      context.loading=false;
            //handle error
            console.log("error: "+response)
        });
    },
  },
  mounted() {
   
    this.mItems=this.$store.state.pitem.images
    this.products=this.$store.state.pitem
    // console.log('Data: ' +JSON.stringify(this.$store.state.pitem));
  },

}
</script>
<style scoped>
  .md-progress-bar {
    position: fixed;
    height:7px;
    top: 48px;
    right: 0;
    left: 0;
    z-index: 3;
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