<template>
        <div class="row justify-content-center">
            <div class="col-md-6 col-11">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <input v-model='user.name' :class="{ 'is-invalid': errors.name}" type="text" class="form-control" id="exampleInputFirstName"
                                                   placeholder="Enter Name">
                                            <div class="invalid-feedback" v-if="errors.name"> {{errors.name[0]}}</div>
                                        </div>
                                        <div class="form-group">
                                            <input v-model='user.email' :class="{ 'is-invalid': errors.email}"  type="email" class="form-control" id="exampleInputEmail"
                                                   aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address">
                                            <div class="invalid-feedback" v-if="errors.email"> {{errors.email[0]}}</div>
                                        </div>
                                        <div class="form-group">
                                            <input v-model='user.password' :class="{ 'is-invalid': errors.password}"   type="password" class="form-control" id="exampleInputPassword"
                                                   placeholder="Password">
                                            <div class="invalid-feedback" v-if="errors.password"> {{errors.password[0]}}</div>
                                        </div>
                                        <div class="form-group">
                                            <input v-model='user.password_confirmation'   type="password" class="form-control" id="exampleInputPasswordRepeat"
                                                   placeholder="Repeat Password">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block" @click.prevent="register">Register</button>
                                        </div>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-block">
                                            <i class="fab fa-google fa-fw"></i> Register with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <router-link class="font-weight-bold small" :to="{ path: '/'}">Already have an
                                            account?
                                        </router-link>
                                    </div>
                                    <div class="text-center">
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
export default {
    name: "Register",
    data(){
        return {
            user:{
                name:'',
                email:'',
                password:'',
                password_confirmation:''
            },
            errors: []
        }
    },
    methods:{
        register(){
            this.errors = []
            axios.post(`/auth/register`, this.user)
            .then(res => {
                Toast.fire({
                    icon: 'success',
                    title: 'Register successfully'
                })
            })
            .catch(err => {
                this.errors = err.response.data.errors
                Toast.fire({
                    icon: 'warning',
                    title: 'Register fail!'
                })
            })
        }
    }
}
</script>

<style scoped>

</style>
