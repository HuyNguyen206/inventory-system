<template>
    <div class="row justify-content-center">
        <div class="col-md-6 col-11">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Add employee</h1>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input v-model='form.name' :class="{ 'is-invalid': errors.name}" type="text" class="form-control"
                                                       placeholder="Enter Name">
                                                <div class="invalid-feedback" v-if="errors.name"> {{errors.name[0]}}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <input v-model='form.email' :class="{ 'is-invalid': errors.email}"  type="email" class="form-control"
                                                       aria-describedby="emailHelp"
                                                       placeholder="Enter Email Address">
                                                <div class="invalid-feedback" v-if="errors.email"> {{errors.email[0]}}</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input v-model='form.address' :class="{ 'is-invalid': errors.address}" type="text" class="form-control"
                                                       placeholder="Enter address">
                                                <div class="invalid-feedback" v-if="errors.address"> {{errors.address[0]}}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <input v-model='form.salary' :class="{ 'is-invalid': errors.salary}"  type="number" class="form-control"
                                                       aria-describedby="emailHelp"
                                                       placeholder="Enter salary">
                                                <div class="invalid-feedback" v-if="errors.salary"> {{errors.salary[0]}}</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input v-model='form.birthday' :class="{ 'is-invalid': errors.birthday}" type="date" class="form-control"
                                                       placeholder="Enter birthday">
                                                <div class="invalid-feedback" v-if="errors.birthday"> {{errors.birthday[0]}}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <input v-model='form.nid' :class="{ 'is-invalid': errors.nid}"  type="text" class="form-control"
                                                       aria-describedby="emailHelp"
                                                       placeholder="Enter NID">
                                                <div class="invalid-feedback" v-if="errors.nid"> {{errors.nid[0]}}</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input v-model='form.phone' :clphoneass="{ 'is-invalid': errors.phone}" type="tel" class="form-control" id="exampleInputFirstName"
                                                       placeholder="Enter phone">
                                                <div class="invalid-feedback" v-if="errors.phone"> {{errors.phone[0]}}</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block" @click.prevent="create">Create</button>
                                    </div>
                                </form>
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
    name: "AddUser",
    data(){
        return {
            errors: [],
            form:{
                name: '',
                email:'',
                address:'',
                salary:'',
                birthday:'',
                nid:'',
                phone:'',
                image:''
            }
        }
    }
}
</script>

<style scoped>

</style>
