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
                        <!-- search box -->
                        <div class="search d-flex justify-content-between">
                             <div class="col-md-4 mb-3">
                                <div class="form-group">
                                <select v-model="takeProduct" @click.prevent="take_product()" name="" id="" class="form-control" >
                                    <option value="" style="display: none" selected >Take</option>
                                    <option value="10" >10 Products</option>
                                    <option value="15" >15 Products</option>
                                    <option  value="20" >20 Products</option>

                                </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="input-group">
                                    <input type="text" v-model="search" class="form-control" placeholder="Live Search">
                                </div>
                            </div>
                            
                        </div>
                        <!-- end search -->
                        <table class="table dataTable">
                            <thead>
                                <tr>
                                    <th style="width:100px">
                                        <a href="javascript:void(0)" @click.prevent="change_sort('id')" style="color:black; text-decoration: none; ">
                                            Id
                                        <span v-if="sort_direction == 'DESC' && sort_field == 'id' "> &uarr;</span>
                                        <span v-if="sort_direction == 'ASC' && sort_field == 'id' " >&darr;</span>
                                       </a>
                                    </th>
                                    <th>Image</th>
                                    <th style="max-width:200px">
                                       <a href="javascript:void(0)" @click.prevent="change_sort('title')" style="color:black; text-decoration: none;  font-weight: bold;">
                                            Title
                                        <span v-if="sort_direction == 'DESC' && sort_field == 'title' "> &uarr;</span>
                                        <span v-if="sort_direction == 'ASC' && sort_field == 'title' " >&darr;</span>
                                       </a>
                                    </th>
                                    <th>User</th>
                                    <th>
                                        <a href="javascript:void(0)" @click.prevent="change_sort('price')"  style="color:black; text-decoration: none; ">
                                            Price
                                        <span v-if="sort_direction == 'DESC' && sort_field == 'price' "> &uarr;</span>
                                        <span v-if="sort_direction == 'ASC' && sort_field == 'price' " >&darr;</span>
                                       </a>
                                    </th>
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
                        <div v-if="apiCallLoaded" class="text-center mt-5">
                            <button :disabled="!next_page_url" @click.prevent="loadMoreProduct(next_page_url)" class="btn btn-warning">Load More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        data(){
            return {
                products:[],
                next_page_url:null,
                apiCallLoaded:false,
                search:'',
                sort_direction:'DESC',
                sort_field:'created_at',
                takeProduct:'',
            }
        },
        methods:{
            async loadProduct(){
            let {data} = await axios.get('/api/products'); // data load using api
            console.log(data);
            this.products = data.data; //api json data set
            this.next_page_url = data.next_page_url; // this next_page_url is api url, see on consol data
            this.apiCallLoaded = true; // if apiCallLoaded is true then product are lode
        },
            async loadMoreProduct(url){ //this parameter url valu is next_page_url valu 
            let {data} = await axios.get(url);
            let products = data.data; // new product value
            products.forEach(element =>{
                this.products.push(element); // new products data push on products array
            });
            this.next_page_url = data.next_page_url; // if have more next_page_url then set on 
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
            searchData(searchValue){
                axios.get('/api/products/search/'+searchValue)
                .then(response =>{
                    this.products = response.data; //set api json data 
                });
            },

            change_sort(field){
                if(this.sort_field == field){
                    this.sort_direction = this.sort_direction == "ASC" ? "DESC" : "ASC";
                }else{
                    this.sort_field =field;
                }
                this.getResult();
            },
            take_product(take){
                this.takeProduct = take;
                this.getResult();
            },
            getResult(){
                axios.get('/api/productby/sort?'
                +"sort_direction="+this.sort_direction
                +"&sort_field="+this.sort_field
                +"&take="+this.takeProduct
                
                ).then(response =>{
                    this.products = response.data;
                });

            }

        },
        watch:{
            search(){
                this.searchData(this.search);
                console.log(this.search);
            }
        },
        mounted() {
            this.loadProduct();
        }
    }
</script>
<!--

 --!>