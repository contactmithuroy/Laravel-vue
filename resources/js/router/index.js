import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
import Home from '../pages/home.vue'
import Category from '../pages/category/index.vue'
import CreateCategory from '../pages/category/create.vue'

const routes = new VueRouter({
	mode:'history',
	routes: [
		{
			path : '/',
			component : Home,
			name : 'home',
		},
		{
			path : '/category',
			component : Category,
			name : 'category-list',
		},
		{
			path : '/category/create',
			component : CreateCategory,
			name : 'create-category',
		},
		
	]
});   

export default routes;