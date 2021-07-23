<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-item-center">
                        <h5>Product Component</h5>
                        <router-link :to="{name:'create-product'}" class="btn btn-primary btn-sm">Create Product</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width:100px">Id</th>
                                    <th>Image</th>
                                    <th style="max-width:200px">Title</th>
                                    <th>User</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th style="width:170px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products" :key="product.id" >
                                    <td style="width:100px">{{product.id }}</td>
                                    <td>
                                        <div style="max-width:70px; max-height:70px; over-flow:hidden">
                                            <img :src="product.image" class="img-fluid">
                                        </div> 
                                    </td>
                                    <td>{{product.title }}</td>
                                    <td>{{product.user }}</td>
                                    <td>{{product.price }}</td>
                                    <td>{{product.category.name}}</td>
                                    <td>
                                        <span v-if="product.status == 1" class="badge badge-success">Open</span>
                                        <span v-else class="badge badge-warning">Lock</span>
                                    </td>
                                    <td style="width:170px">
                                        <router-link :to="{name:'edit-product',params:{id:product.id}}" class="btn btn-primary btn-sm">Edit </router-link>
                                        <a href="javascript:void(0)" @click.prevent="deleteProduct(product)" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                products:[],
            }
        },
        methods:{
            loadProducts(){
                axios.get('/api/product')
                .then(response =>{
                    this.products = response.data;
                });
            },
            deleteProduct(product){
            this.$swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/api/product/${product.id}`)
                            .then(()=>{
                                this.$swal.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                                )
                        let index = this.products.indexOf(product);
                        console.log(index);
                        this.products.splice(index,1);
                        });
                    }
                });
               
            },
        },
        mounted() {
            this.loadProducts();
        }
    }
</script>
<!--

 --!>