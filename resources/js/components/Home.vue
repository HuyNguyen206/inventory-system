<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Sell</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">${{info.totalSell}}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span>Since last month</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Income</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{info.totalIncome}}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span>Since last years</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Due</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{info.totalDue}}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                                    <span>Since last month</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Expense</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{info.totalExpense}}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                    <span>Since yesterday</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--Row-->
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Out of stock product</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Buying Price</th>
                                <th>Selling price</th>
                                <th>Supplier</th>
                                <th>Category</th>
                                <th>Buying date</th>
                                <th>Quantity product</th>
                                <th>Status</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(product, index) in info.products" :key="product.id">
                                <td><a href="#">{{ index += 1 }}</a></td>
                                <td>{{ product.product_name }}</td>
                                <td><img style="width: 50px;" :src="`storage/${product.image}`" alt=""></td>
                                <td>{{ product.buying_price }}</td>
                                <td>{{ product.selling_price }}</td>
                                <td>{{ product.supplier.name }}</td>
                                <td>{{ product.category.name }}</td>
                                <td>{{ product.buying_date }}</td>
                                <td>{{ product.product_quantity }}</td>
                                <td>
                                    <span class="badge badge-success" v-if="product.product_quantity > 0">Available</span>
                                    <span class="badge badge-danger" v-else> Out of stock</span>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import helper from "../mixins/helper";

export default {
    name: "Home",
    mixins: [helper],
    data(){
        return {
            info:{
                totalSell:'',
                totalIncome:'',
                totalDue:'',
                totalExpense:'',
                products: []
            },
        }
    },
    created() {
        this.fetchDashboardData()
    },
    methods:{
        fetchDashboardData(){
            let token = this.checkLogin();
            if (!token) {
                return
            }
            axios.get(`/dashboard`, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then(res => {
                this.info = res.data.data;
            }).catch(err => {
                Notification.notify('error', err.response.data.message)
            })
        }
    }

}
</script>

<style scoped>

</style>
