import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory('/learn_words/'),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../components/vMenu.vue')
    },
    {
      path: '/practice',
      name: 'practice',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../components/vWordCard.vue')
    }
  ]
})

export default router
