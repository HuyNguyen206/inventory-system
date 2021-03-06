<ul v-show="$route.name !== 'login' && $route.name !== 'register'" v-cloak
    class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{asset('backend/img/logo/logo2.png')}}">
        </div>
        <div class="sidebar-brand-text mx-3">RuangAdmin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <router-link :to="{name: 'home'}" class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></router-link>
    </li>
    <li class="nav-item">
        <router-link :to="{name: 'pos'}" class="nav-link">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Poin of Sale</span>
        </router-link>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
           aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Employee</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" :to="{ name: 'employees.index'}">List</router-link>
                <router-link class="collapse-item" :to="{ name: 'employees.create'}">Create new</router-link>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2"
           aria-expanded="true" aria-controls="collapseBootstrap2">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Supplier</span>
        </a>
        <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" :to="{name: 'suppliers.index'}">List</router-link>
                <router-link class="collapse-item" :to="{name: 'suppliers.create'}">Create new</router-link>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap3"
           aria-expanded="true" aria-controls="collapseBootstrap3">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Category</span>
        </a>
        <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" :to="{name: 'categories.index'}">List</router-link>
                <router-link class="collapse-item" :to="{name: 'categories.create'}">Create new</router-link>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap4"
           aria-expanded="true" aria-controls="collapseBootstrap4">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Product</span>
        </a>
        <div id="collapseBootstrap4" class="collapse" aria-labelledby="headingBootstrap"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" :to="{name: 'products.index'}">List</router-link>
                <router-link class="collapse-item" :to="{name: 'products.create'}">Create new</router-link>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap5"
           aria-expanded="true" aria-controls="collapseBootstrap5">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Expense</span>
        </a>
        <div id="collapseBootstrap5" class="collapse" aria-labelledby="headingBootstrap"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" :to="{name: 'expenses.index'}">List</router-link>
                <router-link class="collapse-item" :to="{name: 'expenses.create'}">Create new</router-link>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap7"
           aria-expanded="true" aria-controls="collapseBootstrap7">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Customer</span>
        </a>
        <div id="collapseBootstrap7" class="collapse" aria-labelledby="headingBootstrap"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" :to="{name: 'customers.index'}">List</router-link>
                <router-link class="collapse-item" :to="{name: 'customers.create'}">Create new</router-link>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap6"
           aria-expanded="true" aria-controls="collapseBootstrap6">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Salary</span>
        </a>
        <div id="collapseBootstrap6" class="collapse" aria-labelledby="headingBootstrap"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" :to="{name: 'salaries.employee.index'}">List employee salary</router-link>
                <router-link class="collapse-item" :to="{name: 'salaries.index'}">List salary</router-link>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap8"
           aria-expanded="true" aria-controls="collapseBootstrap8">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Orders</span>
        </a>
        <div id="collapseBootstrap8" class="collapse" aria-labelledby="headingBootstrap"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link class="collapse-item" :to="{name: 'orders.index'}">List Order today</router-link>
                <router-link class="collapse-item" :to="{name: 'orders.search'}">Search Order</router-link>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="forms.html">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Forms</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable"
           aria-expanded="true"
           aria-controls="collapseTable">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tables</h6>
                <a class="collapse-item" href="simple-tables.html">Simple Tables</a>
                <a class="collapse-item" href="datatables.html">DataTables</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="ui-colors.html">
            <i class="fas fa-fw fa-palette"></i>
            <span>UI Colors</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Examples
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage"
           aria-expanded="true"
           aria-controls="collapsePage">
            <i class="fas fa-fw fa-columns"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Example Pages</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>
