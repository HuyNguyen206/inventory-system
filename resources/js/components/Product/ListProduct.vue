<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
            </ol>
        </div>
        <div class="row mb-2">
            <div class="col-md-4">
                <input type="text" v-model="search" @change="search" class="form-control"
                       placeholder="Input your search">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Simple Tables</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Root</th>
                                <th>Buying Price</th>
                                <th>Selling price</th>
                                <th>Supplier</th>
                                <th>Category</th>
                                <th>Buying date</th>
                                <th>Quantity product</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(product, index) in filterSearch" :key="product.id">
                                <td><a href="#">{{ index += 1 }}</a></td>
                                <td>{{ product.product_name }}</td>
                                <td>{{ product.product_code }}</td>
                                <td>{{ product.root }}</td>
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
                                <td><img style="width: 100%;" :src="`storage/${product.image}`" alt=""></td>
                                <td>
                                    <div class="btn-group">
                                        <router-link :to="{name: 'products.edit', params: {id: product.id}}" class="btn btn-primary">Edit</router-link>
                                        <a @click.prevent="deleteProduct(product.id)" class="btn btn-danger text-white">Delete</a>
                                    </div>
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
import AppStorage from "../../helpers/AppStorage";
import helper from "../../mixins/helper";

export default {
    name: "ListProduct",
    mixins: [helper],
    data() {
        return {
            products: [],
            search: ''
        }
    },
    methods: {
        deleteProduct(id) {
            let token = this.checkLogin();
            if(!token){
                return
            }
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/products/${id}`, {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    }).then(res => {
                        Swal.fire(
                            'Deleted!',
                            'This employee has been deleted.',
                            'success'
                        )
                        this.products = this.products.filter(product => {
                            return product.id !== id
                        })
                    })
                        .catch(err => {
                            Notification.notify('error', err.response.data.message)
                        })

                }
            })
        },
        fetch() {
            let token = this.checkLogin();
            if(!token){
                return
            }
            axios.get(`/products`, {headers: {Authorization: `Bearer ${token}`}})
                .then(res => {
                    this.products = res.data.data
                })
                .catch(err => {
                    Notification.notify('error', err.response.data.message)
                })
        }

    },
    created() {
        this.fetch()
    },
    computed: {
        filterSearch() {
            return this.products.filter(product => {
                return product.product_name.match(this.search)
            })
        }
    }
}
</script>

<style scoped>

</style>
