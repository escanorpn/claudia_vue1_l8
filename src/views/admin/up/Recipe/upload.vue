<template>
  <div class="">
    <form novalidate style="
    margin-left: auto;
    margin-right: auto;z-index:0;
    justify-content: space-around;" class="md-layout" @submit.prevent="validateRecipe">
      <md-card class="md-layout-item md-size-90 md-small-size-100">
        <md-card-header>
          <div class="md-title">Recipes</div>
          </md-card-header>

        <md-card-content>
          <mdb-row>
      <mdb-col col="sm">   
        <mdb-input type="text" label="Heading" outline :disabled="sending" 
        v-model="heading4" name="heading" />
      </mdb-col>
      <mdb-col col="sm">   
        <mdb-input type="number" label="Prep Time" outline :disabled="sending" 
        v-model="pTime" name="Prep Time" />
      </mdb-col> 
      <mdb-col col="sm">   
        <mdb-input type="number" label="Cook Time" outline :disabled="sending" 
        v-model="cTime" name="Cook Time" />
      </mdb-col> 
      <mdb-col col="sm">   
        <mdb-input type="number" label="Serving" outline :disabled="sending" 
        v-model="serving" name="Serving" />
      </mdb-col> 
    </mdb-row>
          <mdb-row>
      <mdb-col col="sm">   
        <mdb-input type="date" label="Date" outline :disabled="sending" 
        v-model="mDate" name="heading" />
      </mdb-col>
      <mdb-col col="sm">   
        <select class="browser-default custom-select"  v-model="mCat" Category>
    <!-- <option selected value="11">Open this select menu</option> -->
    <option value="Breakfast">Breakfast</option>
    <option value="Savory">Savory</option>
    <option value="Desserts">Desserts</option>
    <option value="Drinks">Drinks</option>
  </select>
        <!-- <mdb-input type="text" label="Category" outline :disabled="sending" 
        v-model="mCat" name="Prep Time" /> -->
      </mdb-col> 
    </mdb-row>
<!-- <mdb-row>
      <mdb-col col="sm">   
         <mdb-input
                type="textarea"
                outline
                inputClass="z-depth-1 p-3"
                label="Description"  
                :rows="3"
                :disabled="sending"
                v-model="desc4"
              /></mdb-col>
              
      <mdb-col col="sm">   
         <mdb-input
                type="textarea"
                outline
                inputClass="z-depth-1 p-3"
                label="Ingredients"  
                :rows="3"
                :disabled="sending"
                v-model="Ingredients"
              /></mdb-col>

      <mdb-col col="sm">   
         <mdb-input
                type="textarea"
                outline
                inputClass="z-depth-1 p-3"
                label="Instructions"  :rows="3"
                :disabled="sending"
                v-model="Instructions"
                v-on:change="bullet"
              /></mdb-col>
    </mdb-row> -->
<h5>Description</h5>
    <quill-editor
      class="editor"
      v-model="desc4"
      :options="editorOption"
    >
    </quill-editor>
<h5>Ingredients</h5>
    <quill-editor
      class="editor"
      v-model="Ingredients"
      :options="editorOption"
    >
    </quill-editor>
<h5>Instructions</h5>
    <quill-editor
      class="editor"
      v-model="Instructions"
      :options="editorOption"
    >
    </quill-editor>
  
        
        <div class="md-layout md-gutter">
            <div class="md-layout-item md-small-size-100">
              <md-field :class="getValidationClass2('rImages')">
            <UploadImages  @changed="handleRimages"/>
              <span class="md-error" v-if="!$v.form.rImages.required">An Image is required</span>
              </md-field>
             
            </div>
        </div>
  
        </md-card-content>
          <div class="text-center py-4 mt-3">
          <mdb-btn style="color:#e9ecef;background-color:#0c0f24;" color="" type="submit" :disabled="sending">Add</mdb-btn>
        </div>

      </md-card>
        <md-snackbar :md-active.sync="error4">{{ emsg4 }} </md-snackbar>
      </form>
  </div>
</template>

<script>
  import {  mdbBtn, mdbInput, mdbRow, mdbCol } from 'mdbvue';
  
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
        UploadImages,
      
        mdbBtn,
        mdbInput, mdbRow, mdbCol,
        // mdbIcon,
        // mdbDatatable2 
      },
    name: 'Upload',
    mixins: [validationMixin],
    data: () => ({
      editorOption: {
          modules: {
            toolbar: [
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  // ['blockquote', 'code-block'],

  // [{ 'header': 1 }, { 'header': 2 }],               // custom button values
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  // [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  // [{ 'direction': 'rtl' }],                         // text direction

  // [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
  // [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  // [{ 'font': [] }],
  // [{ 'align': [] }],

  // ['clean']                                         // remove formatting button
],
          }
        },
      top: 50,
        collapsed: true,
       heading4: null,
       desc4: null,
      emsg4:null,
      error4:false,
      sending: false,
      pTime:null,
      cTime:null,
      mDate:null,
      mCat:null,
      serving:null,
      Ingredients:null,
      Instructions:null,
      previousLength : 0,
      
    }),
    validations: {
      form: {
   
        heading4: {
          required,
          minLength: minLength(3)
        }, 
        pTime: {
          required,
          minLength: minLength(1)
        }, 
        cTime: {
          required,
          minLength: minLength(1)
        },
      mDate:{
          required,
          minLength: minLength(1)
        }, 
      mCat:{
          required,
          minLength: minLength(1)
        }, 
        serving: {
          required,
          minLength: minLength(1)
        }, 
        Ingredients: {
          required,
          minLength: minLength(3)
        }, 
        Instructions: {
          required,
          minLength: minLength(3)
        },
 
        rImages: {
          required,
          // sImages
        },
        desc1: {
          // required,
          // sImages
        },
        desc4: {
          required,
          // sImages
        }
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
      validateRecipe () {
            // this.$v.$touch()
            // alert(this.desc1)
        if(this.heading4==null){
           alert("There is an error")
          this.error4 = true;
          this.emsg4 = "Please add a heading";
        }else if(this.desc4==null){
          this.error4 = true;
          alert("There is an error")
          this.emsg4 = "Please add a description";
        }else if(this.pTime==null){
          this.error4 = true;
          alert("There is an error")
          this.emsg4 = "Please add  prep time";
        }else if(this.cTime==null){
          this.error4 = true;
          alert("There is an error")
          this.emsg4 = "Please add  cook time";
        }else if(this.mDate==null){
          this.error4 = true;
          alert("There is an error")
          this.emsg4 = "Please add  date";
        }else if(this.mCat==null){
          this.error4 = true;
          alert("There is an error")
          this.emsg4 = "Please add  category";
        }else if(this.serving==null){
          this.error4 = true;
          alert("There is an error")
          this.emsg4 = "Please add serving";
        }else if(this.Ingredients==null){
          this.error4 = true;
          alert("There is an error")
          this.emsg4 = "Please add a ingredients";
        }else if(this.Instructions==null){
          this.error4 = true;
          alert("There is an error")
          this.emsg4 = "Please add a instructions";
        }else if(this.rImages==null){
          this.error4 = true;
          alert("There is an error")
          this.emsg4 = "Please add an Image";
        }else{
          this.saveRecipe();
        }
      },
      saveRecipe (){
        // this.sending = true
        // var murl=this.$store.state.mUrl;
        var form_data = new FormData();

      form_data.append('name',this.heading4);
      form_data.append('description',this.desc4);
      form_data.append('pTime',this.pTime);
      form_data.append('cTime',this.cTime);
      form_data.append('mDate',this.mDate);
      form_data.append('mCat',this.mCat);
      form_data.append('serving',this.serving);
      form_data.append('Ingredients',this.Ingredients);
      form_data.append('Instructions',this.Instructions);
      // form_data.append('images[]',this.sImages);
      for( var i = 0; i < this.rImages.length; i++ ){
          let file = this.rImages[i];
          console.log(file);
          form_data.append('images[]', file);
        }
       for (var pair of form_data.entries()) {
        console.log(pair[0]+ ' - ' + pair[1]); 
      }
// console.log(murl)
console.log(JSON.stringify(form_data))
      api.post('recipe',form_data).then((response) => {
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
      bullet(){
       
        const bullet = "\u2022";
  const newLength = this.Instructions.length;
  const characterCode = this.Instructions.substr(-1).charCodeAt(0);
console.log("newLength: "+newLength)
console.log("characterCode: "+characterCode)
  if (newLength > this.previousLength) {
  
    if (characterCode === 10) {
      this.Instructions = `${this.Instructions}${bullet} `;
      // this.Instructions = +bullet;
    } else if (newLength === 1) {
      this.Instructions = `${bullet} ${this.Instructions}`;
    }
  }

  this.previousLength = newLength;


      },
     


      clearForm4 () {
      this.pTime=null
      this.cTime=null
      this.mDate=null
      this.mCat=null
        this.heading4 = null
        this.serving = null
        this.desc4 = null
        this.rImages = null
        this.Instructions = null
        this.Ingredients = null
      },
      
    }
  }
</script>

<style lang="scss" scoped>

</style>