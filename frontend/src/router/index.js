import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/home/homeViews.vue';

const routes = [{

  path: '/',
  name: 'home',
  component:Home
},
{

  path: '/teste',
  name: 'hometeste',
  component:Home
}
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;