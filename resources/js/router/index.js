import  { createWebHistory, createRouter } from 'vue-router'
import store from '../store/index';

const routes = [
  // Define your routes here
  {
    path: '/store',
    redirect : '/store/home',
  },
  {
    name:'home',
    path: '/store/home',
    component: () => import('../pages/Home.vue'),
    meta: { requiresAuth: true }
  },
  {
    name:'about',
    path: '/store/about',
    component: () => import('../pages/About.vue'),
    meta: { requiresAuth: true }
  },
  {
    name:'login',
    path: '/store/login',
    component: () => import('../pages/Login.vue'),
    meta: { requiresGuest: true }
  },
  {
    name:'regester',
    path: '/store/regester',
    component: () => import('../pages/regester.vue'),
    meta: { requiresGuest: true }
  },
  {
    name:'dashbord',
    path: '/store/dashbord/',
    component: () => import('../pages/dashbord/dashbord.vue'),
    
  },
];
const router =createRouter({
    history:createWebHistory(),
    routes
  });



// Route Guard
router.beforeEach((to, from, next) => {
  const isAuthenticated = store.getters['auth/isAuthenticated'];

  if (to.matched.some(record => record.meta.requiresAuth)) {
    // Protected route requires authentication
    if (!isAuthenticated) {
      // User is not authenticated, redirect to login page
      next({ name: 'login' });
    } else {
      // User is authenticated, proceed to the route
      next();
    }
  } else if (to.matched.some(record => record.meta.requiresGuest)) {
    // Guest route, should not be accessed by authenticated users
    if (isAuthenticated) {
      // User is authenticated, redirect to home page
      next({ name: 'home' });
    } else {
      // User is not authenticated, proceed to the route
      next();
    }
  } else {
    // Public route, proceed to the route
    next();
  }
});

export default router;