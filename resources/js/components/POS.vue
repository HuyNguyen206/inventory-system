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
                                <tr v-for="(cp, index) in cartProducts" :key="cp.id">
                                    <td>{{index+=1}}</td>
                                    <td>{{cp.product_name}}</td>
                                    <td class="pro_quantity">
                                        <input @change="updateCart(cp.id,cp.product_quantity, cp.product_id)" min="1" :max="productById(cp.product_id).product_quantity"  type="number" v-model="cp.product_quantity">
                                        <button  @click="updateCart(cp.id, cp.product_quantity+=1, cp.product_id)" :disabled="cp.product_quantity == productById(cp.product_id).product_quantity" class="btn btn-success btn-sm">+</button>
                                        <button :disabled="cp.product_quantity == 1" @click="updateCart(cp.id, cp.product_quantity-=1, cp.product_id)" class="btn btn-danger btn-sm">-</button>
                                    </td>
                                    <td>{{cp.product_price}}</td>
                                    <td>{{cp.sub_total}}</td>
                                    <td><a @click.prevent="removeCartProduct(cp.id)" class="btn btn-sm btn-primary" style="color:white">X</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Total quantity</span>
                                <b>{{payment.totalQuantity}}</b>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Sub total</span>
                                <b>$ {{formatMoney(payment.subTotal)}}</b>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Vat</span>
                                <b>{{payment.vat}}% ({{formatMoney(payment.vatAmount)}})</b>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Total</span>
                                <b>$ {{formatMoney(payment.total)}}</b>
                            </li>
                        </ul>
                        <form action="" class="mt-3">
                            <div class="form-group">
                                <label for="">Customer Name</label>
                                <select :class="{'is-invalid': this.errors['form.customer_id'] }" name="" class="form-control" v-model="form.customer_id">
                                    <option value="-1" disabled>--Please select--</option>
                                    <option v-for="customer in customers"  :value="customer.id">{{ customer.name }}
                                    </option>
                                </select>
                                <div class="invalid-feedback" v-if="this.errors['form.customer_id']">
                                    {{ this.errors['form.customer_id'][0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Pay</label>
                                <input :class="{'is-invalid': this.errors['form.pay']}" type="text" class="form-control" v-model="form.pay">
                                <div class="invalid-feedback" v-if="this.errors['form.pay']">
                                    {{ this.errors['form.pay'][0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Due</label>
                                <input :class="{'is-invalid': this.errors['form.due']}" type="text" class="form-control" v-model="form.due">
                                <div class="invalid-feedback" v-if="this.errors['form.due']">
                                    {{ this.errors['form.due'][0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Pay by</label>
                                <select :class="{'is-invalid': this.errors['form.pay_by']}" name="" class="form-control" v-model="form.pay_by">
                                    <option value="-1" disabled>--Please select--</option>
                                    <option value="cash"> Cash
                                    </option>
                                    <option value="cheque"> Cheque
                                    </option>
                                </select>
                                <div class="invalid-feedback" v-if="this.errors['form.pay_by']">
                                    {{this.errors['form.pay_by'][0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="form-control btn btn-primary" @click.prevent="order">Submit</button>
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
                                            <a :class="{ 'isDisabled': checkDisable(product)}" @click.prevent="addToCart(product.id, product.product_quantity)" href="">
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
                                         :key="'category_'+ product.id">
                                        <div class="card pos-product">
                                            <a @click.prevent="addToCart(product.id, product.product_quantity)" :class="{ 'isDisabled': checkDisable(product)}" href="">
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
            search: '',
            searchByCategory: '',
            customers: [],
            cartProducts: [],
            form: {
                customer_id: '',
                pay: '',
                due: '',
                pay_by: ''

            },
            payment: {
                totalQuantity: 0,
                subTotal:0,
                vat:5,
                total: '',
                vatAmount:''
            }
        }
    },
    created() {
        this.fetch();
        this.getAllCategory();
        this.getCustomer();
        this.getCartProducts()
        EventBus.$on('updateCart', this.getCartProducts)
    },
    methods: {
        checkDisable(product){
           return this.carProductById(product.id).product_quantity == product.product_quantity
               && product.product_quantity != 0
        },
        order(){
            let token = this.checkLogin();
            if (!token) {
                return
            }
            this.errors = []
            axios.post(`/pos/order`, {
                payment: this.payment, form: this.form, cartProducts: this.cartProducts
            }, {headers: {Authorization: `Bearer ${token}`}})
                .then(res => {
                    Notification.notify('success', 'Order successfully!')
                    this.cartProducts = []
                    this.fetch();
                })
                .catch(err => {
                    if(err.response.data.message){
                        Notification.notify('error', err.response.data.message)
                    }
                    else{
                        this.errors = err.response.data.errors
                    }
                })
        },
        removeCartProduct(id){
            let token = this.checkLogin();
            if (!token) {
                return
            }
            axios.get(`/pos/remove-cart-product/${id}`, {headers: {Authorization: `Bearer ${token}`}})
                .then(res => {
                    EventBus.$emit('updateCart')
                })
                .catch(err => {
                    Notification.notify('error', err.response.data.message)
                })
        },
        getCartProducts() {
            let token = this.checkLogin();
            if (!token) {
                return
            }
            axios.get(`/pos/get-cart-products`, {headers: {Authorization: `Bearer ${token}`}})
                .then(res => {
                    this.payment.totalQuantity = this.payment.subTotal = 0
                    this.cartProducts = res.data.data
                    this.cartProducts.forEach((cp) => {
                        this.payment.totalQuantity+=cp.product_quantity
                        this.payment.subTotal+=parseFloat(cp.sub_total)
                    })
                    let vatAmount = this.payment.subTotal*this.payment.vat/100;
                    this.payment.vatAmount = vatAmount
                    this.payment.total =  this.payment.subTotal + vatAmount;
                    this.payment.subTotal = this.payment.subTotal
                })
                .catch(err => {
                    Notification.notify('error', err.response.data.message)
                })
        },
        productById(id){
            return this.products.find((p) => {
                return p.id == id
            })
        },
        carProductById(id){
            let cartProduct = this.cartProducts.find((p) => {
                return p.product_id == id
            })
            return cartProduct ? cartProduct : { product_quantity : 0}
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
        filterSearchCategory(id) {
            return this.products.filter(product => {
                return product.product_name.match(this.searchByCategory) && product.category_id == id
            })
        },
        addToCart(id, productQuantity){
            let token = this.checkLogin();
            if (!token) {
                return
            }
            console.log(productQuantity)
            if(!productQuantity){
                Swal.fire(
                    `Sorry! This product out of stock at the moment`,
                    'Please noted',
                    'warning'
                )
                return
            }
            if(this.carProductById(id).product_quantity == productQuantity){
                Swal.fire(
                    `Sorry! You can only order ${productQuantity} maximum products`,
                    'Please noted',
                    'warning'
                )
                return
            }
            axios.get(`/pos/add-to-cart/${id}`, {headers: {Authorization: `Bearer ${token}`}})
                .then(res => {
                    Notification.notify('success', 'Add to cart successfully!')
                    EventBus.$emit('updateCart')
                })
                .catch(err => {
                    Notification.notify('error', err.response.data.message)
                })
        },
       async updateCart(cartProductId, product_quantity, productId = 0){
            let token = this.checkLogin();
            if (!token) {
                return
            }
            let canOrder = true
            let product = this.productById(productId)
           console.log(product_quantity,product.product_quantity )
            if( product_quantity  > product.product_quantity)
            {
               let result = (await Swal.fire({
                    title: `There aren't enough stock in storage. Would you like to order ${product.product_quantity} products?`,
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, order it!'
                }))
                console.log('result')
                console.log(result)
                   if(!result.isConfirmed) {
                       canOrder = false
                    }
                    else{
                       product_quantity = product.product_quantity
                   }
            }
            if(!canOrder)
            {
                EventBus.$emit('updateCart')
                return;
            }
            axios.put(`/pos/update-cart/${cartProductId}`, {product_quantity},
                {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(res => {
                    EventBus.$emit('updateCart')
                })
                .catch(err => {
                    Notification.notify('error', err.response.data.message)
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

<style scoped lang="scss">
.pro_quantity{
    display: flex;
    input{
        width: 35px;
    }
    *{
        margin-right: 5px;
    }
}
.isDisabled {
    color: currentColor;
    cursor: not-allowed;
    opacity: 0.5;
    text-decoration: none;
}
</style>
