<template>
    <div>
        <div class="container">
            <!-- <h2>Products</h2> -->
            <div class="row">
                <div class="p-2">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addModal">Add New</button>
                </div>

                <table class="table mt-2">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    <tr v-for="product in products" :key="product.id">
                        <td> {{ product.name }}</td>
                        <td> {{ product.price }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"><span class='fa fa-edit'></span></button>
                            <button  @click="deleteProduct(product.id)" class="btn btn-danger btn-sm"><span class='fa fa-trash'></span></button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
            <!-- Modal -->
            <div class="modal fade" id="addModal" v-if="show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" @submit="addProdcuct">
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" class="form-control" v-model="post.name" id="Name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Price</label>
                                    <input type="number" class="form-control" v-model="post.price" id="" placeholder="Price">
                                </div>
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                    </form>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
import axios from 'axios'
import Vue from 'vue'
Vue.use(axios)
    export default {
        data(){
            return {
                    post: {
                        name: '',
                        price: ''
                    },
                    show: true,
                    products: []
                }
        },
        mounted() {
            this.getAllProducts()
            
        },
        methods: {
            addProdcuct(e){
                e.preventDefault()
                axios.post('api/products/add',this.post)
                .then(res =>{
                    this.$emit('hide', true);
                    this.getAllProducts()
                })
            },
            getAllProducts(){
                axios.get('api/products/all')
                .then(res => {
                    this.products = res.data.data
                    // console.log(res)
                }).catch(err =>{
                    console.log(err)
                })
            },
            deleteProduct(id){
                axios.delete('api/products/delete/'+id)
                .then(res => {
                    this.getAllProducts()
                })
            }
        },
        created(){
            
        },
    }
</script>

<style lang="scss" scoped>

</style>