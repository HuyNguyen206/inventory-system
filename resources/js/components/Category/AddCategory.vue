<template>
    <div>
        <div class="row">
            <div class="col-12">
                <router-link class="btn btn-primary m-2" :to="{ name: 'categories.index'}">List category</router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">Add category</h1>
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
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block"
                                                    @click.prevent="create">Create
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
    mixins: [helper],
    created() {
        this.checkLogin()
    },
    name: "AddCategory",
    data() {
        return {
            form: {
                name: '',
            }
        }
    },
    methods: {
        create() {
            let token = this.checkLogin();
            if(!token){
                return
            }
                this.errors = [];
                axios.post(`/categories`, this.form, {
                    headers: {Authorization: `Bearer ${token}`}
                })
                    .then(res => {
                        Notification.notify('success')
                        this.$router.push({name: 'categories.index'})
                    })
                    .catch(err => {
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
