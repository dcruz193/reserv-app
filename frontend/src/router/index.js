import Vue from 'vue'
import VueRouter from 'vue-router'
import Hotels from '../views/Hotels.vue'
import Reservations from '../views/Reservations.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Hotels',
    component: Hotels
  },
  {
    path: '/reservations/email/:email',
    name: 'Reservations',
    component: Reservations
  },
]

const router = new VueRouter({
  routes
})

export default router
