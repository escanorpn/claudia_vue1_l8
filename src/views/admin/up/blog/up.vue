<template>
  <div class="">
    <form novalidate style="
    margin-left: auto;
    margin-right: auto;z-index:0;
    justify-content: space-around;" class="md-layout" @submit.prevent="validateQuize">
      <md-card class="md-layout-item md-size-90 md-small-size-100">
        <md-card-header>
          <div class="md-title">Blog</div>
          </md-card-header>

        <md-card-content>
          <mdb-col col="sm">   
        <mdb-input type="text" label="Heading" outline :disabled="sending" 
        v-model="header" name="heading" />
      </mdb-col>
          <h5>Description</h5>
        <quill-editor
          class="editor"
          v-model="blog"
          :options="editorOption"
        >
        </quill-editor>
        <div class="md-layout md-gutter">
            <div class="md-layout-item md-small-size-100">
              <md-field :class="getValidationClass2('rImages')">
            <UploadImages :max="1" maxError="Max files exceed" @changed="handleRimages"/>
              <span class="md-error" v-if="!$v.form.rImages.required">An Image is required</span>
              </md-field>
             
            </div>
        </div>
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
  import {  mdbBtn,mdbInput   } from 'mdbvue';
  
 import UploadImages from "vue-upload-drop-images"
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
        mdbInput,
        UploadImages
        // mdbIcon,
        // mdbDatatable2 
      },
    name: 'Upload',
    mixins: [validationMixin],
    data: () => ({
      editorOption: {
          modules: {
            toolbar: [
              ['bold', 'italic', 'underline', 'strike'],
              [{ 'list': 'ordered'}, { 'list': 'bullet' }],
              [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
              [{ 'color': [] }, { 'background': [] }],
              [{ 'font': [] }],
              [{ 'align': [] }],
              ['link', 'image'],
              ['clean']
            ]
          }
        },
      top: 50,
        collapsed: true,
       blog: null,
       desc4: null,
       header:null,
      emsg4:null,
      error4:false,
      sending: false,
    }),
    validations: {
      form: {
   
        header: {
          required,
          minLength: minLength(3)
        },
        rImages: {
          required,
          // sImages
        },
      }
    },
     mounted() {


  },
    methods: {
      handleRimages(files){
          //  alert("foo"+files[0].name);
                // console.log(files)
                this.rImages=files;
            },
      getValidationClass2 (fieldName) {
        const field = this.$v.form[fieldName]

        if (field) {
          return {
            'md-invalid': field.$invalid && field.$dirty
          }
        }
      },
    
            validateQuize () {
            // this.$v.$touch()
            // alert(this.desc1)
        if(this.blog==null){
           alert("There is an error")
          this.error4 = true;
          this.emsg4 = "Please add a blog";
        }else  if(this.header==null){
           alert("There is an error")
          this.error4 = true;
          this.emsg4 = "Please add a heading";
        }
        else{
          this.saveBlog()
        }
      },
      saveBlog (){
        // this.sending = true
        // var murl=this.$store.state.mUrl;
        var form_data = new FormData();

form_data.append('blog',this.blog);
form_data.append('header',this.header);
      for( var i = 0; i < this.rImages.length; i++ ){
          let file = this.rImages[i];
          console.log(file);
          form_data.append('images[]', file);
        }
   
// console.log(murl)
console.log(JSON.stringify(form_data))
      api.post('blog',form_data).then((response) => {
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
        this.blog = null
      },
      
    }
  }
</script>

<style lang="scss" scoped>

</style>