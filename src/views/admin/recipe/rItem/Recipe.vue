<template>
  <Layout>
    <div style="margin-top: 15px; ">
       <mdb-progress-bar md-mode="indeterminate" v-if="sending" />
    <div class="wrap" style="max-width: 1200px;">
			<div class="card "   style="width: 100%; max-width: 1200px; margin-right: auto; margin-left: auto; margin-top: 142px;background-color:#483f3f
      /* background: linear-gradient(#483f3f 15%, #483f3f 3%, #483f3f 81%, #3c0d0b 4%); */
      box-shadow:rgb(40 18 10 / 59%) 0px 32px 32px;" >
			<div class="card-body" >
				<h2 style="color:white;text-shadow: 1px 1px 2px black;margin-top: -15px;text-shadow: 4px 2px 2px #2c0406;">
					<b>{{products.name }}</b>
				</h2>
      <mdb-card v-animateOnScroll="{animation: 'fadeInLeft', delay: 30}"  >
      <mdb-view hover cascade class="ms">
              <img  :src="murl+mItems.url" alt="Card image cap" class="ms1" style="max-width:200px"/>
                <mdb-mask flex-center waves overlay="white-slight"></mdb-mask>
      </mdb-view>
		<mdb-card-body class="text-center pb-0" cascade>
		</mdb-card-body>
	</mdb-card>
 <div style="text-align: left;">
    <mdb-row>
      <mdb-col col="sm">
        <p style="color:white;margin-top: 15px;">
					<b style="text-shadow: 4px 2px 2px #2c0406;">Cooking time: </b> {{products.ctime}}
				</p> 
      </mdb-col>
      <mdb-col col="sm">
        <p style="color:white;margin-top: 15px;text-shadow: 4px 2px 2px #2c0406;">
					<b>Preparation time: {{products.ptime}}</b>
				</p> 
      </mdb-col>
      <mdb-col col="sm">
        <p style="color:white;margin-top: 15px;text-shadow: 4px 2px 2px #2c0406;">
					<b>Total time: {{products.ptime}}</b>
				</p> 
      </mdb-col>
    </mdb-row>
    <mdb-row>
      <mdb-col col="sm">
        <p style="color:white;margin-top: 15px;text-shadow: 4px 2px 2px #2c0406;">
					<b>Ingredients</b>
				</p> 
        <!-- <p style="color:white;">{{products.ingredients}}</p> -->
        <div style="color:white;" v-html="products.ingredients"></div>
      </mdb-col>
    </mdb-row>
    <mdb-row>
      <mdb-col col="sm">
        <p style="color:white;margin-top: 15px;text-shadow: 4px 2px 2px #2c0406;">
					<b>Instructions</b>
				</p> 
        <!-- <p style="color:white;">{{products.instructions}}</p> -->
        <div style="color:white;" v-html="products.instructions"></div>
      </mdb-col>
    </mdb-row>
  </div>

	</div>
</div>
</div>
    
     </div>
   
  </Layout>
</template>

<script>
// import folio from "./folio.vue"
// import mlist from "./list.vue"
// import Sitem from "./sitem.vue"
import {  mdbCol,   mdbProgressBar } from 'mdbvue';
// import data from "./posts.json"

export default {
  name: 'Recipe',
  components: {
  
  
    mdbCol,
    mdbProgressBar,

  },
  // props: ['name',],


  data() {
    return {
   
      murl:this.$store.state.iUrl,
      mItems: [],
      products: [],
    
    }
  },
  methods: {
        
  },
  mounted() {
   
    this.mItems=this.$store.state.pitem.images[0]
    this.products=this.$store.state.pitem
    console.log('Data: ' +JSON.stringify(this.mItems));
  },

}
</script>
<style scoped>
 
</style>