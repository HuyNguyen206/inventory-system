import Login from "./components/auth/Login";
import Register from "./components/auth/Register";
import Forget from "./components/auth/Forget";
import Home from "./components/Home";
import Logout from "./components/auth/Logout";
import AddUser from "./components/Employee/AddUser";
import ListUser from "./components/Employee/ListUser";
import EditUser from "./components/Employee/EditUser";
import AddSupplier from "./components/Supplier/AddSupplier";
import ListSupplier from "./components/Supplier/ListSupplier";
import EditSupplier from "./components/Supplier/EditSupplier";
import AddCategory from "./components/Category/AddCategory";
import ListCategory from "./components/Category/ListCategory";
import EditCategory from "./components/Category/EditCategory";
import AddProduct from "./components/Product/AddProduct";
import ListProduct from "./components/Product/ListProduct";
import EditProduct from "./components/Product/EditProduct";
import AddExpense from "./components/Expense/AddExpense";
import ListExpense from "./components/Expense/ListExpense";
import EditExpense from "./components/Expense/EditExpense";
import ListEmployee from "./components/Salary/ListEmployee";
import PayEmployee from "./components/Salary/PayEmployee";
import ListSalary from "./components/Salary/ListSalary";
import ListSalaryMonth from "./components/Salary/ListSalaryMonth";
import EditEmployeeSalary from "./components/Salary/EditEmployeeSalary";
import AddCustomer from "./components/Customer/AddCustomer";
import ListCustomer from "./components/Customer/ListCustomer";
import EditCustomer from "./components/Customer/EditCustomer";
import POS from "./components/POS";
import ListOrder from "./components/Order/ListOrder";
import OrderDetail from "./components/Order/OrderDetail";
import SearchOrder from "./components/Order/SearchOrder";
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
    {
        path: '/employees/:id/edit',
        component: EditUser,
        name: 'employees.edit'
    },
    {
        path: '/suppliers/create',
        component: AddSupplier,
        name: 'suppliers.create'
    },
    {
        path: '/suppliers',
        component: ListSupplier,
        name: 'suppliers.index'
    },
    {
        path: '/suppliers/:id/edit',
        component: EditSupplier,
        name: 'suppliers.edit'
    },
    {
        path: '/categories/create',
        component: AddCategory,
        name: 'categories.create'
    },
    {
        path: '/categories',
        component: ListCategory,
        name: 'categories.index'
    },
    {
        path: '/categories/:id/edit',
        component: EditCategory,
        name: 'categories.edit'
    },
    {
        path: '/products/create',
        component: AddProduct,
        name: 'products.create'
    },
    {
        path: '/products',
        component: ListProduct,
        name: 'products.index'
    },
    {
        path: '/products/:id/edit',
        component: EditProduct,
        name: 'products.edit'
    },
    {
        path: '/expenses/create',
        component: AddExpense,
        name: 'expenses.create'
    },
    {
        path: '/expenses',
        component: ListExpense,
        name: 'expenses.index'
    },
    {
        path: '/expenses/:id/edit',
        component: EditExpense,
        name: 'expenses.edit'
    },
    {
        path: '/salaries',
        component: ListSalary,
        name: 'salaries.index'
    },
    {
        path: '/salaries/employees',
        component: ListEmployee,
        name: 'salaries.employee.index'
    },
    {
        path: '/salaries/:id/pay',
        component: PayEmployee,
        name: 'salaries.pay'
    },
    {
        path: '/salaries/:month',
        component: ListSalaryMonth,
        name: 'salaries.detail'
    },
    {
        path: '/salaries/edit/:id',
        component: EditEmployeeSalary,
        name: 'salaries.edit'
    },
    {
        path: '/customers/create',
        component: AddCustomer,
        name: 'customers.create'
    },
    {
        path: '/customers',
        component: ListCustomer,
        name: 'customers.index'
    },
    {
        path: '/customers/:id/edit',
        component: EditCustomer,
        name: 'customers.edit'
    },
    {
        path: '/pos',
        component: POS,
        name: 'pos'
    },
    {
        path: '/orders',
        component: ListOrder,
        name: 'orders.index'
    },
    {
        path: '/orders/order-detail/:id',
        component: OrderDetail,
        name: 'orders.detail'
    },
    {
        path: '/orders/search-orders',
        component: SearchOrder,
        name: 'orders.search'
    }
    // {
    //     path: '/bar',
    //     component: Bar
    // }
    //
]

export default routes;
