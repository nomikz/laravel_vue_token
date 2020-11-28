import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: { authOnly: true }
    },
    {
        path: '/about',
        name: 'About',
        component: () => import('../views/About.vue')
    },
    {
        path: '/register',
        name: 'Register',
        component: () => import('../views/Register')
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../views/Login'),
        meta: { guestOnly: true }
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

function isLoggedIn() {
    return localStorage.getItem("token");
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authOnly)) {
        if (!isLoggedIn()) {
            next({ name: 'Login' });
        }

        next();
    } else if (to.matched.some(record => record.meta.guestOnly)) {
        if (isLoggedIn()) {
            next({ name: 'Home'} );
        }

        next();
    } else {
        next();
    }
})

export default router
