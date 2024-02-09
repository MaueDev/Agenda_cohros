import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/home/homeViews.vue';
import Dashbord from '../views/home/dashbordViews.vue';
import { useAuthStore } from '@/stores/auth';
import menuComponent from '@/views/Component/menuComponent';
import contactsComponent from '@/views/Component/contactsComponent';
import createContactsComponent from '@/views/Component/createContactsComponent';
const routes = [{

  path: '/',
  name: 'home',
  component:Home
},
{

  path: '/dashbord',
  name: 'dashbord',
  component:Dashbord,
  children:[
    {
      path: '',
      component: menuComponent
    },
    {
      path: 'contacts',
      name: 'contacts',
      component: contactsComponent
    },
    {
      path: 'contacts/criar',
      name: 'createContacts',
      component: createContactsComponent
    }
  ],
  meta:{
    auth:true
  }
}
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

router.beforeEach(async(to,from,next)=>{
  if(to.meta?.auth){
    const auth = useAuthStore();
    if(auth.token && auth.user){
      const isAuthenticated = await auth.checkToken()
      if(isAuthenticated){
        next();
      }else{
        next({name: 'home'})
      }
    }else{
      next({name: 'home'})
    }
  }else{
    next();
  }
})
export default router;