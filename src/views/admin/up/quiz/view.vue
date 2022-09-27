<template>
 <div :style="{ padding: '0px', background: '#fff', minHeight: '360px',paddingRight:'0px',
    paddingLeft: '0px'}">
  <div class="loading-box" v-if="loading">
                <div class="loader"></div>
              </div>
<div class="card white lighten-1 black-text" style="box-shadow:rgb(34 94 222 / 19%) -1px -11px 32px;width: 100%; max-width: 1300px;margin-left:auto; margin-right: auto;    border-radius: 0.25rem;margin-top: 25px;adding-right: 0px;
    padding-left: 0px;">
    <div class="card-body" style="color: rgba(1, 5, 9, 0.63);background: linear-gradient(21deg, white 9%, white 57%, #d9d0d000 1%) center center / cover fixed;">
        <!-- <div id="editor" ref="editor">HTML TABLE HERE</div> -->
        <iframe 
        v-if="loaded"
        :src="iframe.src"
      
        frameborder="0"  style="height:380px;width:6000px;border:none;"
        
      >loading</iframe>

    </div>
</div>
 </div>
 

</template>

<script>
  
  import api from "../../../services/api";
export default {
  data() {
    return {
      loaded: false,
      iframe: {
        src: 'https://docs.google.com/forms/d/e/1FAIpQLSd4F2CZX5POMMBUg0wLyfiE2xhex4fSDSRlGWQbcXonHddh4A/viewform?embedded=true',
        style: null,
        wrapperStyle: null,
      }
    }
  },
  methods:{
  init(){
    api.get('quiz').then((response) => {
      console.log("response: "+ JSON.stringify(response));
       
    this.emsg4 = response.data;
            //  this.clearForm1();
            this.error4 = true
          if(response.data.code==2){ 
            this.iframe.src=response.data.data.link
            // this.emsg4 = response.data.message;
            //  this.clearForm1();
            // this.error4 = true
          }
          this.sending = false
           this.clearForm4();
}).catch(function (response) {
          //handle error
          console.log("error"+JSON.stringify(response))
          // this.clearForm2();
          this.sending = false
      });
  }
  },
   
  mounted() {
    this.init();
    // let editor = this.$refs.editor;
    this.iframe.style = {
      // position: 'absolute',
      // width: window.innerWidth,
      // height: window.innerHeight,
      
      height: 89+ "%",
      width: 89+ "%",
      // <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSd4F2CZX5POMMBUg0wLyfiE2xhex4fSDSRlGWQbcXonHddh4A/viewform?embedded=true" width="640" height="1049" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
      // top: -editor.offsetTop + "px",
      // left: -editor.offsetLeft + "px",
    }    
    this.iframe.wrapperStyle = {
      // overflow: 'hidden',
      // height: 89+ "%",
      // height: 1049+ "px",
      // width: editor.clientWidth + "px",
    } 
    this.loaded = true;
  }
}
</script>
14106394985