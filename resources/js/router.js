import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)


// import addEvents from './components/pages/addEvents.vue'
import addEvent from './pages/event/addEvent.vue'
import event from './pages/event/event.vue'
import registration from './pages/registration.vue'
import login from './pages/login.vue'
import forgetPassword from './pages/forgetPassword.vue'
import index from './pages/profile/index.vue'
import eventIndex from './pages/event/eventIndex.vue'
import eventDetails from './pages/event/eventDetails.vue'

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/addEvent',
      name: 'addEvent',
      component: addEvent
    },
    {
      path: '/event/:id',
      name: 'event-id',
      component: event
    },
    {
      path: '/registration',
      name: 'registration',
      component: registration
    },
    {
      path: '/login',
      name: 'login',
      component: login
    },
    {
      path: '/forgetPassword',
      name: 'forgetPassword',
      component: forgetPassword
    },
    {
      path: '/index',
      name: 'index',
      component: index
    },
    {
      path: '/eventIndex',
      name: 'eventIndex',
      component: eventIndex
    },
    {
      path: '/eventDetails/:id',
      name: 'eventDetails-id',
      component: eventDetails
    },

  ]
});