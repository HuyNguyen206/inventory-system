<template>
    <div>
        <div class="row">
            <div class="col-12">
                <router-link class="btn btn-primary m-2" :to="{ name: 'employees.index'}">List employee</router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">Edit employee</h1>
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
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input v-model='form.joining_date'
                                                           :class="{ 'is-invalid': errors.joining_date}" type="date"
                                                           class="form-control"
                                                           placeholder="Enter joining_date">
                                                    <div class="invalid-feedback" v-if="errors.joining_date">
                                                        {{ errors.joining_date[0] }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input v-model='form.nid' :class="{ 'is-invalid': errors.nid}"
                                                           type="text" class="form-control"
                                                           aria-describedby="emailHelp"
                                                           placeholder="Enter NID">
                                                    <div class="invalid-feedback" v-if="errors.nid">
                                                        {{ errors.nid[0] }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
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
                                                    <img :src="`${originImage}`" alt="" style="width: 200px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block" @click.prevent="update">Update
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
    name: "EditUser",
    mixins: [helper],
    data() {
        return {
            id: this.$route.params.id,
            form: {
                name: '',
                email: '',
                address: '',
                salary: '',
                joining_date: '',
                nid: '',
                phone: '',
                image: ''
            },
            originImage: ''
        }
    },
    created() {
        let token = this.checkLogin()
        if(!token){
            return
        }
        axios.get(`/employees/${this.id}`, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(res => {
            this.form = res.data
            this.originImage =`/storage/${this.form.image}`
            this.form.image = ''
        }).catch(err => {
            Notification.notify('error', err.response.data.message)
        })
    },
    methods:{
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
                    this.originImage = event.target.result
                }
                fileReader.readAsDataURL(file)
            }
        },
        update(){
            let token = this.checkLogin()
            if(!token){
                return
            }
            this.errors = []
            axios.put(`/employees/${this.id}`,this.form, {
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
