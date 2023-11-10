import axios from 'axios';

const state = {
  user: null,
  accessToken:null,
};

const getters = {
  getUser: state => state.user,
  isAuthenticated: state => state.accessToken,
};

const mutations = {
  SET_USER(state, user) {
    state.user = user;
  },
  SET_ACCESS_TOKEN(state, token) {
    state.accessToken = localStorage.getItem('token') ;
  },
  CLEAR_USER(state) {
    state.user = null;
    state.accessToken = null;
  },
};

const actions = {
  registerUser({ commit }, userData) {
    return new Promise((resolve, reject) => {
      axios.post('http://127.0.0.1:8001/api/user/register', userData)
        .then(response => {
            console.log(userData);
          
          commit('SET_USER',response.data.user);
          commit('SET_ACCESS_TOKEN', response.data.token);
          // Save the access token to local storage  for persistent authentication
          localStorage.setItem('token',response.data.token);
          resolve(user);
        })
        .catch(error => {
          reject(error);
        });
    });
  },
  loginUser({ commit }, credentials) {
    return new Promise((resolve, reject) => {
      axios.post('http://127.0.0.1:8001/api/user/login', credentials)
        .then(response => {
          const { user, token } = response.data;
          commit('SET_USER', user);
          commit('SET_ACCESS_TOKEN', token);
          // Save the access token to local storage  for persistent authentication
          localStorage.setItem('token', token);
          resolve(user);
        })
        .catch(error => {
          reject(error);
        });
    });
  },
  logoutUser({ commit }) {
    commit('CLEAR_USER');
    console.log( localStorage.getItem('token'))
    // Clear the access token from local storage 
    localStorage.removeItem('token');
    router.go('home')
  },
};

export default {
namespaced: true,
  state,
  getters,
  mutations,
  actions,
};