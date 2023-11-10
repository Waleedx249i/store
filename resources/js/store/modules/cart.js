// store/modules/cart.js

const state = {
  cartItems: []
};

const getters = {
  cartItems: state => state.cartItems
};

const actions = {
  addToCart({ commit }, product) {
    commit('ADD_TO_CART', product);
  },
  updateCartItem({ commit }, { product, quantity }) {
    commit('UPDATE_CART_ITEM', { product, quantity });
  },
  removeCartItem({ commit }, productId) {
    commit('REMOVE_CART_ITEM', productId);
  },
  clearCart({ commit }) {
    commit('CLEAR_CART');
  },
  checkout({ commit, state }) {
    // Simulate a checkout process
    // You can make an API call here to send the cart data to the server

    // Reset the cart after successful checkout
    commit('CLEAR_CART');

    // You can also show a success message or perform any other post-checkout actions
  }
};

const mutations = {
  ADD_TO_CART(state, product) {
    item = product;
    item.quantity = 1;
    state.cartItems.push(item);
  },
  UPDATE_CART_ITEM(state, { product, quantity }) {
    const item = state.cartItems.find(item => item.id === product.id);
    if (item) {
      item.quantity = quantity;
    }
  },
  REMOVE_CART_ITEM(state, productId) {
    state.cartItems = state.cartItems.filter(item => item.id !== productId);
  },
  CLEAR_CART(state) {
    state.cartItems = [];
  }
};

export default {
  state,
  getters,
  actions,
  mutations
};