<template>
    <div>
        <div class="row">
            <div class="col-12">
                <router-link class="btn btn-primary m-2" :to="{ name: 'products.index'}">List product</router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">Edit product</h1>
                                    </div>
                                    <form enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input v-model='form.product_name' :class="{ 'is-invalid': errors.product_name}"
                                                           type="text" class="form-control"
                                                           placeholder="Enter Name">
                                                    <div class="invalid-feedback" v-if="errors.product_name">
                                                        {{ errors.product_name[0] }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input v-model='form.product_code' :class="{ 'is-invalid': errors.product_code}"
                                                           type="text" class="form-control"
                                                           aria-describedby="product_codeHelp"
                                                           placeholder="Enter Code">
                                                    <div class="invalid-feedback" v-if="errors.product_code">
                                                        {{ errors.product_code[0] }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="category">Select Category</label>
                                                    <select v-model="form.category_id" class="form-control" id="category" :class="{ 'is-invalid': errors.category_id}">
                                                        <option selected value="-1" disabled>--Please select--</option>
                                                        <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
                                                    </select>
                                                    <div class="invalid-feedback" v-if="errors.category_id">
                                                        {{ errors.category_id[0] }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="supplier">Select supplier</label>
                                                    <select v-model="form.supplier_id" class="form-control" id="supplier" :class="{ 'is-invalid': errors.supplier_id}">
                                                        <option selected value="-1" disabled>--Please select--</option>
                                                        <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{supplier.name}}</option>
                                                    </select>
                                                    <div class="invalid-feedback" v-if="errors.supplier_id">
                                                        {{ errors.supplier_id[0] }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <input v-model='form.root'
                                                           :class="{ 'is-invalid': errors.root}" type="text"
                                                           class="form-control"
                                                           placeholder="Enter root">
                                                    <div class="invalid-feedback" v-if="errors.root">
                                                        {{ errors.root[0] }}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input v-model='form.buying_price' :class="{ 'is-invalid': errors.buying_price}"
                                                           type="text" class="form-control"
                                                           aria-describedby="emailHelp"
                                                           placeholder="Enter buying price">
                                                    <div class="invalid-feedback" v-if="errors.buying_price">
                                                        {{ errors.buying_price[0] }}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input v-model='form.selling_price' :class="{ 'is-invalid': errors.selling_price}"
                                                           type="text" class="form-control"
                                                           aria-describedby="emailHelp"
                                                           placeholder="Enter selling price">
                                                    <div class="invalid-feedback" v-if="errors.selling_price">
                                                        {{ errors.selling_price[0] }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="supplier">Enter buying date</label>
                                                    <input v-model='form.buying_date'
                                                           :class="{ 'is-invalid': errors.buying_date}" type="date"
                                                           class="form-control"
                                                           placeholder="Enter buying date">
                                                    <div class="invalid-feedback" v-if="errors.buying_date">
                                                        {{ errors.buying_date[0] }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="supplier">Enter product quantity</label>
                                                    <input v-model='form.product_quantity' :class="{ 'is-invalid': errors.product_quantity}"
                                                           type="text" class="form-control"
                                                           aria-describedby="emailHelp"
                                                           placeholder="Enter product quantity">
                                                    <div class="invalid-feedback" v-if="errors.product_quantity">
                                                        {{ errors.product_quantity[0] }}
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
                                                    <img :src="originImage" alt="" style="width: 200px">
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
    name: "EditProduct",
    mixins: [helper],
    data() {
        return {
            form: {
                product_name: '',
                product_code: '',
                root: '',
                image: '',
                buying_price: '',
                selling_price: '',
                category_id: '',
                supplier_id: '',
                product_quantity: '',
                buying_date: ''
            },
            categories:[],
            suppliers: [],
            originImage: '',
            id: this.$route.params.id
        }
    },
    created() {
        let token = this.checkLogin()
        axios.get(`/products/${this.id}`, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(res => {
            this.form = res.data.data;
            this.originImage =`/storage/${this.form.image}`
            this.form.image = ''
        }).catch(err => {
            Notification.notify('error', err.response.data.message)
        })
        axios.get(`/categories`, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(res => {
            this.categories = res.data.data
        })
            .catch(err => {
                Notification.notify('error', err.response.data.message)
            })

        axios.get(`/suppliers`, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(res => {
            this.suppliers = res.data.data
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
            this.errors = []
            axios.put(`/products/${this.id}`,this.form, {
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
