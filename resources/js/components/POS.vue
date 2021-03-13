<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">POS</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
        <div class="row mb-3">
            <!-- Area Chart -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
                        <router-link :to="{ name: 'customers.create'}" class="btn btn-outline-primary">Add customer
                        </router-link>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" style="font-size: 15px">
                                <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="#">RA0449</a></td>
                                    <td>Udin Wayang</td>
                                    <td>Nasi Padang</td>
                                    <td><span class="badge badge-success">Delivered</span></td>
                                    <td>25</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                </tr>
                                <tr>
                                    <td><a href="#">RA5324</a></td>
                                    <td>Jaenab Bajigur</td>
                                    <td>Gundam 90' Edition</td>
                                    <td><span class="badge badge-warning">Shipping</span></td>
                                    <td>25</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                </tr>
                                <tr>
                                    <td><a href="#">RA8568</a></td>
                                    <td>Rivat Mahesa</td>
                                    <td>Oblong T-Shirt</td>
                                    <td><span class="badge badge-danger">Pending</span></td>
                                    <td>25</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                </tr>
                                <tr>
                                    <td><a href="#">RA1453</a></td>
                                    <td>Indri Junanda</td>
                                    <td>Hat Rounded</td>
                                    <td><span class="badge badge-info">Processing</span></td>
                                    <td>25</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                </tr>
                                <tr>
                                    <td><a href="#">RA1998</a></td>
                                    <td>Udin Cilok</td>
                                    <td>Baby Powder</td>
                                    <td><span class="badge badge-success">Delivered</span></td>
                                    <td>25</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Total quantity</span>
                                <b>10</b>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Sub total</span>
                                <b>$562</b>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Vat</span>
                                <b>35%</b>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Total</span>
                                <b>$5620</b>
                            </li>
                        </ul>
                        <form action="" class="mt-3">
                            <div class="form-group">
                                <label for="">Customer Name</label>
                                <select name="" class="form-control" v-model="name_id">
                                    <option value="-1" disabled>--Please select--</option>
                                    <option v-for="customer in customers" :value="customer.id">{{ customer.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Pay</label>
                                <input type="text" class="form-control" v-model="form.pay">
                            </div>
                            <div class="form-group">
                                <label for="">Due</label>
                                <input type="text" class="form-control" v-model="form.due">
                            </div>
                            <div class="form-group">
                                <label for="">Pay by</label>
                                <select name="" class="form-control" v-model="pay_by_id">
                                    <option value="-1" disabled>--Please select--</option>
                                    <option v-for="customer in customers" :value="customer.id">{{ customer.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="form-control btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id=""
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Month <i class="fas fa-chevron-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                 aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Select Periode</div>
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Week</a>
                                <a class="dropdown-item active" href="#">Month</a>
                                <a class="dropdown-item" href="#">This Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">


                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="product-tab" data-toggle="tab" href="#products"
                                   role="tab" aria-controls="home" aria-selected="true">All Product</a>
                            </li>
                            <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                                <a class="nav-link" :id="`category-tab_${category.id}`" data-toggle="tab"
                                   :href="`#category_${category.id}`" role="tab"
                                   aria-controls="profile" aria-selected="false">{{ category.name }}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="products" role="tabpanel"
                                 aria-labelledby="product-tab">
                                <div class="row my-2">
                                    <div class="col">
                                        <input type="text" v-model="search" @change="search" class="form-control"
                                               placeholder="Input your search">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-4" v-for="product in filterSearch" :key="product.id">
                                        <div class="card pos-product">
                                            <a @click.prevent="addToCart(product.id)" href="">
                                                <img :src="`/storage/${product.image}`" class="card-img-top"
                                                     style="width: 150px; object-fit: contain" alt="...">
                                                <div class="card-body">
                                                    <p class="card-text">{{ product.product_name }}</p>
                                                    <span class="badge badge-success p-2" style="font-size: 15px"
                                                          v-if="product.product_quantity > 0">Available: {{
                                                            product.product_quantity
                                                        }}</span>
                                                    <span class="badge badge-danger p-2 text-md" style="font-size: 15px"
                                                          v-else> Out of stock</span>
                                                </div>

                                            </a>
                                            <div class="card-footer">
                                                <small class="text-muted">{{ product.created_at }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " v-for="category in categories" :key="`tab_panel_${category.id}`"
                                 :id="`category_${category.id}`" role="tabpanel"
                                 aria-labelledby="home-tab">
                                <div class="row my-2">
                                    <div class="col">
                                        <input type="text" v-model="searchByCategory"
                                               @change="filterSearchCategory(category.id)" class="form-control"
                                               placeholder="Input your search">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-4" v-for="product in filterSearchCategory(category.id)"
                                         :key="product.id">
                                        <div class="card pos-product">
                                            <a @click.prevent="addToCart(product.id)">
                                                <img :src="`/storage/${product.image}`" class="card-img-top"
                                                     style="width: 150px; object-fit: contain" alt="...">
                                                <div class="card-body">
                                                    <p class="card-text">{{ product.product_name }}</p>
                                                    <span class="badge badge-success p-2" style="font-size: 15px"
                                                          v-if="product.product_quantity > 0">Available: {{
                                                            product.product_quantity
                                                        }}</span>
                                                    <span class="badge badge-danger p-2 text-md" style="font-size: 15px"
                                                          v-else> Out of stock</span>
                                                </div>

                                            </a>
                                            <div class="card-footer">
                                                <small class="text-muted">{{ product.created_at }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer text-center">
                        <a class="m-0 small text-primary card-link" href="#">View More <i
                            class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import helper from "../mixins/helper";

export default {
    name: "POS",
    mixins: [helper],
    data() {
        return {
            products: [],
            categories: [],
            productOfCategory: [],
            search: '',
            searchByCategory: '',
            customers: [],
            form: {
                name_id: '',
                pay: '',
                due: '',
                pay_by_id: ''

            }
        }
    },
    created() {
        this.fetch();
        this.getAllCategory();
        this.getCustomer()
    },
    methods: {
        addToCart(id){
            let token = this.checkLogin();
            if (!token) {
                return
            }
            axios.get(`/pos/add-to-cart/${id}`, {headers: {Authorization: `Bearer ${token}`}})
                .then(res => {
                   Notification.notify('success', 'Add to cart successfully!')
                })
                .catch(err => {
                    Notification.notify('error', err.response.data.message)
                })
        },
        getCustomer() {
            let token = this.checkLogin();
            if (!token) {
                return
            }
            axios.get(`/customers`, {headers: {Authorization: `Bearer ${token}`}})
                .then(res => {
                    this.customers = res.data.data
                })
                .catch(err => {
                    Notification.notify('error', err.response.data.message)
                })
        },
        fetch() {
            let token = this.checkLogin();
            if (!token) {
                return
            }
            axios.get(`/pos`, {headers: {Authorization: `Bearer ${token}`}})
                .then(res => {
                    this.products = res.data.data
                })
                .catch(err => {
                    Notification.notify('error', err.response.data.message)
                })
        },
        getAllCategory() {
            let token = this.checkLogin();
            if (!token) {
                return
            }
            axios.get(`/pos/get-all-category`, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
                .then(res => {
                    this.categories = res.data.data
                })
                .catch(err => {
                    Notification.notify('error', err.response.data.message)
                })
        },
        getProductByCategoryId(id) {
            let token = this.checkLogin();
            if (!token) {
                return
            }
            axios.get(`/pos/product-of-category/${id}`, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
                .then(res => {
                    this.productOfCategory = res.data.data
                })
                .catch(err => {
                    Notification.notify('error', err.response.data.message)
                })
        },
        filterSearchCategory(id) {
            return this.products.filter(product => {
                return product.product_name.match(this.searchByCategory) && product.category_id == id
            })
        }
    },
    computed: {
        filterSearch() {
            return this.products.filter(product => {
                return product.product_name.match(this.search)
            })
        },
    }
}
</script>

<style scoped>

</style>
