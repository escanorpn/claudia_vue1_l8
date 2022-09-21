<template>
  <div class="">
    <form novalidate style="
    margin-left: auto;
    margin-right: auto;z-index:0;
    justify-content: space-around;" class="md-layout" @submit.prevent="validateQuize">
      <md-card class="md-layout-item md-size-90 md-small-size-100">
        <md-card-header>
          <div class="md-title">Quiz</div>
          </md-card-header>

        <md-card-content>
          <mdb-row>
      <mdb-col col="sm">   
        <mdb-input type="text" label="Link" outline :disabled="sending" 
        v-model="heading4" name="heading" />
      </mdb-col>

    </mdb-row>
        </md-card-content>
          <div class="text-center py-4 mt-3">
          <mdb-btn style="color:#e9ecef;background-color:#0c0f24;" color="" type="submit" :disabled="sending">Update</mdb-btn>
        </div>

      </md-card>
        <md-snackbar :md-active.sync="error4">{{ emsg4 }} </md-snackbar>
      </form>
  </div>
</template>

<script>
  import {  mdbBtn, mdbInput, mdbRow, mdbCol } from 'mdbvue';
  
  import { validationMixin } from 'vuelidate';
  import {
    required,
 
    minLength,

  } from 'vuelidate/lib/validators'
  import api from "../../../services/api";

// const axios = require('axios');
  export default {
      components: {
      
        mdbBtn,
        mdbInput, mdbRow, mdbCol,
        // mdbIcon,
        // mdbDatatable2 
      },
    name: 'Upload',
    mixins: [validationMixin],
    data: () => ({
   
      top: 50,
        collapsed: true,
       heading4: null,
       desc4: null,
      emsg4:null,
      error4:false,
      sending: false,
    }),
    validations: {
      form: {
   
        heading4: {
          required,
          minLength: minLength(3)
        },
      }
    },
     mounted() {


  },
    methods: {
      getValidationClass2 (fieldName) {
        const field = this.$v.form[fieldName]

        if (field) {
          return {
            'md-invalid': field.$invalid && field.$dirty
          }
        }
      },
      handleRimages(files){
          //  alert("foo"+files[0].name);
                // console.log(files)
                this.rImages=files;
            },
            validateQuize () {
            // this.$v.$touch()
            // alert(this.desc1)
        if(this.heading4==null){
           alert("There is an error")
          this.error4 = true;
          this.emsg4 = "Please add a heading";
        }else{
          this.saveQuiz()
        }
      },
      saveQuiz (){
        // this.sending = true
        // var murl=this.$store.state.mUrl;
        var form_data = new FormData();

      form_data.append('link',this.heading4);
  
   
// console.log(murl)
console.log(JSON.stringify(form_data))
      api.post('quiz',form_data).then((response) => {
      console.log("response: "+ JSON.stringify(response));
       
    this.emsg4 = response.data;
            //  this.clearForm1();
            this.error4 = true
          if(response.data.code==2){ 
            this.emsg4 = response.data.message;
            //  this.clearForm1();
            this.error4 = true
          }
          this.sending = false
           this.clearForm4();
}).catch(function (response) {
          //handle error
          console.log("error"+JSON.stringify(response))
          // this.clearForm2();
          this.sending = false
      });
        // Instead of this timeout, here you can call your API
        
      },
   
     


      clearForm4 () {
        this.heading4 = null
      },
      
    }
  }
</script>

<style lang="scss" scoped>

</style>