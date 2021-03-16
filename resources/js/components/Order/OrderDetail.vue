<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order detail</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
            </ol>
        </div>
        <div class="row my-2">
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">
                        <b>Name</b>: {{ order.customer.name }}
                    </li>
                    <li class="list-group-item"><b>Phone:</b> {{ order.customer.phone }}</li>
                    <li class="list-group-item"><b>Address</b>: {{ order.customer.address }}</li>
                    <li class="list-group-item"><b>Date</b>: {{ order.order_date }}</li>
                    <li class="list-group-item"><b>Pay through</b>: {{ order.pay_by }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item"><b>Sub total</b>: {{ order.sub_total }}</li>
                    <li class="list-group-item"><b>Vat</b>: {{ order.vat }}</li>
                    <li class="list-group-item"><b>Total</b>: {{ order.total }}</li>
                    <li class="list-group-item"><b>Pay amount</b>: {{ order.pay }}</li>
                    <li class="list-group-item"><b>Due amount</b>: {{ order.due }}</li>
                </ul>
            </div>
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
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Image</th>
                                <th>Qty</th>
                                <th>Unit price</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(od, index) in filterSearch" :key="od.id">
                                <td><a href="#">{{ index += 1 }}</a></td>
                                <td>{{ od.product.product_name }}</td>
                                <td>{{ od.product.product_code }}</td>
                                <td><img :src="`/storage/${od.product.image}`" alt=""></td>
                                <td>{{ od.product_quantity }}</td>
                                <td>{{ od.product_price }}</td>
                                <td>{{ od.sub_total }}</td>

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
import helper from "../../mixins/helper";

export default {
    name: "OrderDetail",
    mixins: [helper],
    data() {
        return {
            id: this.$route.params.id,
            orderDetail: [],
            order: {},
            search:''
        }
    },
    created() {
        let token = this.checkLogin()
        if (!token) {
            return
        }
        axios.get(`/orders/order-detail/${this.id}`, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(res => {
            this.order = res.data.data.order;
            this.orderDetail = res.data.data.orderDetail
        }).catch(err => {
            Notification.notify('error', err.response.data.message)
        })
    },
    methods: {
        update() {

        }
    },
        computed: {
            filterSearch() {
                return this.orderDetail.filter(od => {
                    return od.product.product_name.match(this.search)
                })
            }
        }

    }
</script>

<style scoped>

</style>
