import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Post from '../components/Post.vue'
import PostDetails from '../components/PostDetails.vue';
import CategoryPosts from '../components/CategoryPosts.vue';
import AdminIndex from '../components/admin/AdminIndex.vue';
import Notifications from '../components/Notifications.vue';



const routes =[
    {path:'/',component : Post,name:'Post'},
    {path:'/Notifications',component : Notifications,name:'Notifications'},
    {path:'/post/:slug',component:PostDetails,name:'PostDetails'},
    {path:'/category/:slug/posts',component:CategoryPosts,name:'CategoryPosts'},
    {path:'/admin',component:AdminIndex,name:'AdminIndex'}
];

const router = new VueRouter({
    routes,hashbang:false,mode:'history'
})

export default router;
