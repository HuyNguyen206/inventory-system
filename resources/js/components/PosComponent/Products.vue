<template>
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id=""
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Month <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                     aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Select Periode</div>
                    <a class="dropdown-item" href="#">Today</a>
                    <a class="dropdown-item" href="#">Week</a>
                    <a class="dropdown-item active" href="#">Month</a>
                    <a class="dropdown-item" href="#">This Year</a>
                </div>
            </div>
        </div>
        <div class="card-body">


            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="product-tab" data-toggle="tab" href="#products"
                       role="tab" aria-controls="home" aria-selected="true">All Product</a>
                </li>
                <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                    <a class="nav-link" :id="`category-tab_${category.id}`" data-toggle="tab"
                       :href="`#category_${category.id}`" role="tab"
                       aria-controls="profile" aria-selected="false">{{ category.name }}</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="products" role="tabpanel"
                     aria-labelledby="product-tab">
                    <div class="row my-2">
                        <div class="col">
                            <input type="text" v-model="search" @change="search" class="form-control"
                                   placeholder="Input your search">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-4" v-for="product in filterSearch" :key="product.id">
                            <div class="card pos-product">
                                <a :class="{ 'isDisabled': checkDisable(product)}"
                                   @click.prevent="addToCart(product.id, product.product_quantity)" href="">
                                    <img :src="`/storage/${product.image}`" class="card-img-top"
                                         style="width: 150px; object-fit: contain" alt="...">
                                    <div class="card-body">
                                        <p class="card-text">{{ product.product_name }}</p>
                                        <span class="badge badge-success p-2" style="font-size: 15px"
                                              v-if="product.product_quantity > 0">Available: {{
                                                product.product_quantity
                                            }}</span>
                                        <span class="badge badge-danger p-2 text-md" style="font-size: 15px"
                                              v-else> Out of stock</span>
                                    </div>

                                </a>
                                <div class="card-footer">
                                    <small class="text-muted">{{ product.created_at }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade " v-for="category in categories" :key="`tab_panel_${category.id}`"
                     :id="`category_${category.id}`" role="tabpanel"
                     aria-labelledby="home-tab">
                    <div class="row my-2">
                        <div class="col">
                            <input type="text" v-model="searchByCategory"
                                   @change="filterSearchCategory(category.id)" class="form-control"
                                   placeholder="Input your search">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-4" v-for="product in filterSearchCategory(category.id)"
                             :key="'category_'+ product.id">
                            <div class="card pos-product">
                                <a @click.prevent="addToCart(product.id, product.product_quantity)"
                                   :class="{ 'isDisabled': checkDisable(product)}" href="">
                                    <img :src="`/storage/${product.image}`" class="card-img-top"
                                         style="width: 150px; object-fit: contain" alt="...">
                                    <div class="card-body">
                                        <p class="card-text">{{ product.product_name }}</p>
                                        <span class="badge badge-success p-2" style="font-size: 15px"
                                              v-if="product.product_quantity > 0">Available: {{
                                                product.product_quantity
                                            }}</span>
                                        <span class="badge badge-danger p-2 text-md" style="font-size: 15px"
                                              v-else> Out of stock</span>
                                    </div>

                                </a>
                                <div class="card-footer">
                                    <small class="text-muted">{{ product.created_at }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="card-footer text-center">
            <a class="m-0 small text-primary card-link" href="#">View More <i
                class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</template>

<script>
export default {
    name: "Products",
    data() {
        return {
            search: '',
            searchByCategory: '',
        }
    },
    props: ['products', 'categories'],

}
</script>

<style scoped>

</style>
