<template>
        <div class="row justify-content-center">
            <div class="col-md-6 col-11">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user" @submit.prevent="login">
                                        <div class="form-group">
                                            <input v-model="form.email" :class="{ 'is-invalid': errors.email }" type="email" class="form-control"
                                                   id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address">
                                            <div v-if="errors.email" class="invalid-feedback">{{errors.email[0]}}</div>
                                        </div>
                                        <div class="form-group">
                                            <input v-model="form.password" :class="{ 'is-invalid': errors.password }"  type="password" class="form-control"
                                                   id="exampleInputPassword" placeholder="Password">
                                            <div v-if="errors.password" class="invalid-feedback">{{errors.password[0]}}</div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small"
                                                 style="line-height: 1.5rem;">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <router-link class="font-weight-bold small" :to="{ name: 'forget'}">Forgot
                                            password
                                        </router-link>
                                    </div>
                                    <div class="text-center">
                                        <router-link class="font-weight-bold small" :to="{ name: 'register'}">Create new
                                            Account!
                                        </router-link>
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
    name: "Login",
    mixins: [helper],
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            errors: []
        }
    },
    created() {
       if(User.loggedInAlready())
       {
           this.$router.push({name: 'home'})
       }
    },
    methods: {
        login() {
            this.errors = []
            axios.post(`/auth/login`, this.form)
                .then(res => {
                    User.responseAfterLogin(res)
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    })
                    this.$router.push({name: 'home'})
                })
                .catch(err => {
                    this.errors = err.response.data.errors
                    if(err.response.data.error)
                    {
                        Toast.fire({
                            icon: 'warning',
                            title: err.response.data.error
                        })
                    }
                    else {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Signed in fail!'
                        })
                    }

                })
        }
    }
}
</script>

<style scoped>

</style>
