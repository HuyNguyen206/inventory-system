<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">List Salary</h1>
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
                                <th>Salary Month</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(e, index) in filterSearch" :key="e.salary_month">
                                <td><a href="#">{{ index += 1 }}</a></td>
                                <td>{{ e.salary_month }}</td>
                                <td>
                                    <div class="btn-group">
                                        <router-link :to="{name: 'salaries.detail', params: {month: e.salary_month}}" class="btn btn-primary">View</router-link>
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
    name: "ListSalary",
    mixins: [helper],
    data() {
        return {
            salaries: [],
            search: ''
        }
    },
    methods: {
        fetch() {
            let token = this.checkLogin();
            if(!token){
                return
            }
            axios.get(`/salaries`, {headers: {Authorization: `Bearer ${token}`}})
                .then(res => {
                    this.salaries = res.data.data
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
            return this.salaries.filter(e => {
                return e.salary_month.match(this.search)
            })
        }
    }
}
</script>

<style scoped>

</style>
