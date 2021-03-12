<template>
    <div>
        <div class="row">
            <div class="col-12">
                <router-link class="btn btn-primary m-2" :to="{ name: 'salaries.employee.index'}">List employee salary</router-link>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-11">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Pay salary</h1>
                                    </div>
                                    <form enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input v-model='form.name' :class="{ 'is-invalid': errors.name}"
                                                           type="text" class="form-control"
                                                           placeholder="Enter Name">
                                                    <div class="invalid-feedback" v-if="errors.name">
                                                        {{ errors.name[0] }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input v-model='form.email' :class="{ 'is-invalid': errors.email}"
                                                           type="email" class="form-control"
                                                           aria-describedby="emailHelp"
                                                           placeholder="Enter Email Address">
                                                    <div class="invalid-feedback" v-if="errors.email">
                                                        {{ errors.email[0] }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="">Select month</label>
                                                    <select v-model="form.salary_month" class="form-control" :class="{ 'is-invalid': errors.salary_month}">
                                                        <option selected value="-1" disabled>--Please select--</option>
                                                        <option value="Jan">Jan</option>
                                                        <option value="Feb">Feb</option>
                                                        <option value="Mar">Mar</option>
                                                        <option value="Apr">Apr</option>
                                                        <option value="May">May</option>
                                                        <option value="Jun">Jun</option>
                                                        <option value="Jul">Jul</option>
                                                        <option value="Aug">Aug</option>
                                                        <option value="Sep">Sep</option>
                                                        <option value="Oct">Oct</option>
                                                        <option value="Nov">Nov</option>
                                                        <option value="Dev">Dev</option>
                                                    </select>
                                                    <div class="invalid-feedback" v-if="errors.salary_month">
                                                        {{ errors.salary_month[0] }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Salary</label>
                                                    <input v-model='form.salary' :class="{ 'is-invalid': errors.salary}"
                                                           type="number" class="form-control"
                                                           aria-describedby="emailHelp"
                                                           placeholder="Enter salary">
                                                    <div class="invalid-feedback" v-if="errors.salary">
                                                        {{ errors.salary[0] }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block" @click.prevent="pay">Pay
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import helper from "../../mixins/helper";

export default {
    name: "PayEmployee",
    mixins: [helper],
    data() {
        return {
            id: this.$route.params.id,
            form: {
                name: '',
                email: '',
                salary_month: '',
                salary: '',
            },
        }
    },
    created() {
        let token = this.checkLogin()
        if(!token){
            return
        }
        axios.get(`/salaries/${this.id}`, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(res => {
            this.form = res.data
        }).catch(err => {
            Notification.notify('error', err.response.data.message)
        })
    },
    methods:{
        pay(){
            let token = this.checkLogin()
            if(!token){
                return
            }
            this.errors = []
            axios.post(`/salaries/pay/${this.id}`,this.form, {
                headers:{
                    Authorization: `Bearer ${token}`
                }
            }).then(res => {
                Notification.notify('success')
            }).catch(err => {
                if(err.response.data.errors){
                    this.errors = err.response.data.errors
                }
                else{
                    Notification.notify('error', err.response.data.message)
                }
            })
        }
    }

}
</script>

<style scoped>

</style>
