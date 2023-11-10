import { createApp } from 'vue';
import router from './router/index.js';
import store from './store/index.js';
import cart from './components/Cart.vue';
import NavBar from './components/NavBar.vue';
import CheckoutForm from './components/CheckoutForm.vue';
import {  mapActions } from 'vuex';

import.meta.glob([
  '../images/**',
  '../fonts/**',
]);




  
const app = createApp({
    
    components: 
    {
      'Cart' : cart,
      'nav-bar' :NavBar,
      'checkout-form':CheckoutForm
    },
    data() {
      return {
        showcart: false,
        
      }
    },
    methods:{
      ...mapActions(['showHide'])
    }
   
    
    
    
  });


app.use(router);
app.use(store);




Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});


/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');

const dashbord = createApp({
  template:{

  },
    
  components: 
  {
  
  
    
  },
  data() {
    return {
      showcart: false,
      
    }
  },
  methods:{
  
  }
 
  
  
  
})

dashbord.mount('#dashbord');



