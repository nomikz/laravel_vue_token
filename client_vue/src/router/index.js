import Vue from 'vue'
import VueRouter from 'vue-router'
import PolicyList from '../views/Policies/PolicyList'

Vue.use(VueRouter)

const routes = [
    {
        path: '/policies',
        name: 'policyList',
        component: PolicyList,
        meta: { authOnly: true },
    },
    {
        path: '/policies/create',
        name: 'policyCreate',
        component: () => import('../views/Policies/PolicyCreate'),
        meta: { authOnly: true },
    },
    {
        path: '/policies/:id',
        name: 'policyShow',
        component: () => import('../views/Policies/PolicyShow'),
        meta: { authOnly: true },
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('../views/Auth/Register'),
        meta: { guestOnly: true },
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../views/Auth/Login'),
        meta: { guestOnly: true },
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
            next({ name: 'login' });
        }

        next();
    } else if (to.matched.some(record => record.meta.guestOnly)) {
        if (isLoggedIn()) {
            next({ name: 'policyList'} );
        }

        next();
    } else {
        next();
    }
})

export default router
