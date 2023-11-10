import { createStore } from "vuex";
import auth from './modules/auth.js';

const store = createStore({
    state:{
        cart: [],
        showcart :false
        
        },
        modules: {
            auth,
          },

        mutations: {
            showHide(state){
                state.showcart = !state.showcart;
            },
            addToCart(state, product) {
            var item  = {...product , ...{quantity : 1}}
            item.price = parseFloat(product.price)
            const cartItem = state.cart.find(item => item.id === product.id);
              if (cartItem) {
                state.cart.find(item => item.id === product.id).quantity++;
              }
              else{
                state.cart.push(item);
              }
              
              
            },
            updateCartItemQuantity(state, { productId, quantity }) {
              const cartItem = state.cart.find(item => item.id === productId);
              if (cartItem) {
                cartItem.quantity = quantity;
              }
            },
            removeFromCart(state, productId) {
              state.cart = state.cart.filter(item => item.id !== productId);
            },
            clearCart(state) {
              state.cart = [];
            },
          },
          actions: {
              showHide({commit}){
                commit('showHide')
              },   
                       addToCart({ commit }, product) {
              commit('addToCart', product);
            },
            updateCartItemQuantity({ commit }, { productId, quantity }) {
              commit('updateCartItemQuantity', { productId, quantity });
            },
            removeFromCart({ commit }, productId) {
              commit('removeFromCart', productId);
            },
            clearCart({ commit }) {
              commit('clearCart');
            },
          },
          getters: {
            cartItems: state => state.cart,
            cartTotal: state =>
              state.cart.reduce((total, item) => total + (item.price*100) * item.quantity, 0)/100,
          },

}




);
export default store ;