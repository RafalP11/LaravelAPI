import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import Countries from '../components/Countries';
import AddCountry from '../components/AddCountry';
import EditCountry from '../components/EditCountry';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'countries',
        path: '/countries',
        component: Countries
    },
    {
        name: 'addcountry',
        path: '/countries/add',
        component: AddCountry
        
    },
    {
        name: 'editcountry',
        path: '/countries/edit/:id',
        component: EditCountry
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});


export default router;