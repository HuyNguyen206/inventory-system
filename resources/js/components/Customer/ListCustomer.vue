<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customers</h1>
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
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(customer, index) in filterSearch" :key="customer.id">
                                <td><a href="#">{{ index += 1 }}</a></td>
                                <td>{{ customer.name }}</td>
                                <td>{{ customer.email }}</td>
                                <td>{{ customer.address }}</td>
                                <td>{{ customer.phone }}</td>
                                <td><img style="width: 100%;" :src="`/storage/${customer.image}`" alt=""></td>
                                <td>
                                    <div class="btn-group">
                                        <router-link :to="{name: 'customers.edit', params: {id: customer.id}}" class="btn btn-primary">Edit</router-link>
                                        <a @click.prevent="deleteSupplier(customer.id)" class="btn btn-danger text-white">Delete</a>
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
    name: "ListCustomer",
    mixins: [helper],
    data() {
        return {
            customers: [],
            search: ''
        }
    },
    methods: {
        deleteSupplier(id) {
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
                    axios.delete(`/customers/${id}`, {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    }).then(res => {
                        Swal.fire(
                            'Deleted!',
                            'This customer has been deleted.',
                            'success'
                        )
                        this.customers = this.customers.filter(customer => {
                            return customer.id !== id
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
            axios.get(`/customers`, {headers: {Authorization: `Bearer ${token}`}})
                .then(res => {
                    this.customers = res.data.data
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
            return this.customers.filter(customer => {
                return customer.name.match(this.search) || customer.email.match(this.search) || customer.address.match(this.search)
            })
        }
    }
}
</script>

<style scoped>

</style>
