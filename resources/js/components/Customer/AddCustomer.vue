<template>
    <div>
        <div class="row">
            <div class="col-12">
                <router-link class="btn btn-primary m-2" :to="{ name: 'customers.index'}">List customer</router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">Add customer</h1>
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
                                                    <input v-model='form.address'
                                                           :class="{ 'is-invalid': errors.address}" type="text"
                                                           class="form-control"
                                                           placeholder="Enter address">
                                                    <div class="invalid-feedback" v-if="errors.address">
                                                        {{ errors.address[0] }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input v-model='form.phone' :class="{ 'is-invalid': errors.phone}"
                                                           type="tel" class="form-control" id="exampleInputFirstName"
                                                           placeholder="Enter phone">
                                                    <div class="invalid-feedback" v-if="errors.phone">
                                                        {{ errors.phone[0] }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                               @change="onSeletedImage">
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <img :src="form.image" alt="" style="width: 200px">
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
    name: "AddCustomer",
    data() {
        return {
            form: {
                name: '',
                email: '',
                address: '',
                phone: '',
                image: '',
            }
        }
    },
    methods: {
        onSeletedImage(event) {
            console.log(event)
            let file = event.target.files[0];
            if (file.size > 1024 * 1024) {
                Notification.notify('error', "File size can't not exceed 1MB")
            } else {
                let fileReader = new FileReader();
                fileReader.onload = event => {
                    console.log(event)
                    console.log(event.target.result)
                    this.form.image = event.target.result
                }
                fileReader.readAsDataURL(file)
            }
        },
        create() {
            let token = this.checkLogin();
            if(!token){
                return
            }
                this.errors = [];
                axios.post(`/customers`, this.form, {
                    headers: {Authorization: `Bearer ${token}`}
                })
                    .then(res => {
                        Notification.notify('success')
                        this.$router.push({name: 'customers.index'})
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
