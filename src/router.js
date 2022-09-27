import Vue from 'vue'
import Router from 'vue-router'
// import Home from './views/Home.vue'
// import Results from './views/Results.vue'
import Init from './views/init.vue'
// import Main from './views/mainContent.vue'
import Admin from './views/admin/login.vue'
import Products from './views/admin/products.vue'
import Ritem from './views/admin/recipe/rItem/Main.vue'


Vue.use(Router)
const isLoggedIn=(to,from,next)=>{
  
  if(localStorage.getItem('access_token')){
    console.log("Logged in")
    next()
  }else{
    // return false
    // next()
    return '/login'
    // return { name: '/admin' }
    // from();
  }
  
}
export default new Router({
  routes: [
    
    {
      path: '/',
      name: 'Init',
      component: Init
    },
  
    {
      path: '/admin',
      name: 'Admin',
      component: Admin
    },
    {
      path: '/products',
      name: 'Products',
      component: Products,
      beforeEnter:isLoggedIn
    },
    {
      path: '/Ritem',
      name: 'Ritem',
      component: Ritem,
      beforeEnter:isLoggedIn
    },
    
    
   
  ]
})
