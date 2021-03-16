<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
            </ol>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center font-weight-bolder">
                        Search Order
                    </div>
                    <div class="card-body p-5">
                        <form action="" class="form">
                            <div class="form-group">
                                <label for="">Search By Date</label>
                                <input type="date" v-model="search" class="form-control"
                                       placeholder="Input your search">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary form-control" @click.prevent="searchFunc">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                                <th>Total amount</th>
                                <th>Pay</th>
                                <th>Due</th>
                                <th>Pay by</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <transition name="fade">
                                <tbody v-if="orders.length">
                                <tr v-for="(order, index) in orders" :key="order.id">
                                    <td><a href="#">{{ index += 1 }}</a></td>
                                    <td>{{ order.customer.name }}</td>
                                    <td>{{ order.total }}</td>
                                    <td>{{ order.pay }}</td>
                                    <td>{{ order.due }}</td>
                                    <td>{{ order.pay_by }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <router-link :to="{name: 'orders.detail', params: {id: order.id}}"
                                                         class="btn btn-primary">View detail
                                            </router-link>
                                            <!--                                        <a @click.prevent="deleteCategory(category.id)" class="btn btn-danger text-white">Delete</a>-->
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </transition>
                            <transition name="fade">
                                <tbody v-if="!orders.length">
                                <tr>
                                    <td colspan="7" class="text-center">No data</td>
                                </tr>
                                </tbody>
                            </transition>
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
    name: "SearchOrder",
    mixins: [helper],
    data() {
        return {
            orders: [],
            search: ''
        }
    },
    methods: {
        searchFunc() {
            let token = this.checkLogin();
            if (!token) {
                return
            }
            axios.post(`/orders/search-orders-by-date`, {date: this.search}, {headers: {Authorization: `Bearer ${token}`}})
                .then(res => {
                    this.orders = res.data.data
                })
                .catch(err => {
                    Notification.notify('error', err.response.data.message)
                })
        }

    },
    computed: {
        filterSearch() {
            return this.orders.filter(order => {
                return order.customer.name.match(this.search)
            })
        }
    }
}
</script>

<style scoped>

</style>
