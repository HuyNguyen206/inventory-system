import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
import Forget from "./components/auth/Forget";
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
    // {
    //     path: '/bar',
    //     component: Bar
    // }
    //
]

export default routes;
