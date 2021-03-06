import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
import Forget from "./components/auth/Forget";
import Home from "./components/Home";
import Logout from "./components/auth/Logout";
import AddUser from "./components/Employee/AddUser";
import ListUser from "./components/Employee/ListUser";
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
    {
        path: '/logout',
        component: Logout,
        name: 'logout'
    },
    {
        path: '/employees/create',
        component: AddUser,
        name: 'employees.create'
    },
    {
        path: '/employees',
        component: ListUser,
        name: 'employees.index'
    },
    // {
    //     path: '/bar',
    //     component: Bar
    // }
    //
]

export default routes;
