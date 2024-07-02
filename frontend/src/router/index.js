import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
     
      component: () => import('../views/ClienteView.vue')
    },
    {
      path: '/cliente',
      name: 'cliente',
     
      component: () => import('../views/ClienteView.vue')
    },
    {
      path: '/add_cliente',
      name: 'add_cliente',
     
      component: () => import('../views/AddClienteView.vue')
    },
    {
      path: '/servico',
      name: 'servico',
     
      component: () => import('../views/ServicoView.vue')
    },
    {
      path: '/profissional',
      name: 'profissional',
     
      component: () => import('../views/ProfissionalView.vue')
    },
    {
      path: '/status-cliente',
      name: 'status-cliente',
     
      component: () => import('../views/StatusClienteView.vue')
    },
    
  ]
})

export default router
