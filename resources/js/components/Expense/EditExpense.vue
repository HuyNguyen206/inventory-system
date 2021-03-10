<template>
    <div>
        <div class="row">
            <div class="col-12">
                <router-link class="btn btn-primary m-2" :to="{ name: 'expenses.index'}">List expenses</router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">Edit expense</h1>
                                    </div>
                                    <form enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="">Expense detail</label>
                                                    <textarea v-model='form.details' :class="{ 'is-invalid': errors.details}" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                    <div class="invalid-feedback" v-if="errors.details">
                                                        {{ errors.details[0] }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="">Expense Amount</label>
                                                    <input v-model='form.amount'
                                                           :class="{ 'is-invalid': errors.amount}" type="number"
                                                           class="form-control"
                                                           placeholder="Enter amount">
                                                    <div class="invalid-feedback" v-if="errors.amount">
                                                        {{ errors.amount[0] }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block"
                                                    @click.prevent="update">Update
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
    name: "EditExpense",
    mixins: [helper],
    data() {
        return {
            form: {
                details: '',
                amount: '',
            },
            id: this.$route.params.id
        }
    },
    created() {
        let token = this.checkLogin()
        axios.get(`/expenses/${this.id}`, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(res => {
            this.form = res.data;
        }).catch(err => {
            Notification.notify('error', err.response.data.message)
        })
    },
    methods:{
        update(){
            let token = this.checkLogin()
            this.errors = []
            axios.put(`/expenses/${this.id}`,this.form, {
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
