import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
import Forget from "./components/auth/Forget";
import Home from "./components/Home";
const routes = [
    {
        path: '/',
        component: Login,
        name: 'login'
    },
    {
        path: '/register',
        component: Register,
        name: 'register'
    },
    {
        path: '/forget',
        component: Forget,
        name: 'forget'
    },
    {
        path: '/home',
        component: Home,
        name: 'home'
    },
    // {
    //     path: '/bar',
    //     component: Bar
    // }
    //
]

export default routes;
