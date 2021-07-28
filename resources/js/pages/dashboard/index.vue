<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="card-header">
                        <router-link :to="{name:'dashboard'}" class="list-group-item-action"><h4>Dashboard</h4></router-link>
                    </div>
                <div class="list-group text-white bg-dark">
                <router-link :to="{name:'dashboard'}" class="list-group-item list-group-item-action">Home</router-link>
                <router-link :to="{name:'user-profile'}" class="list-group-item list-group-item-action">User Profile</router-link>
                <router-link :to="{name:'product-list'}" class="list-group-item list-group-item-action">Product</router-link>
                <router-link :to="{name:'category-list'}" class="list-group-item list-group-item-action">Category</router-link>

                <a href="javascrip:void(0)" class="list-group-item list-group-item-action" @click.prevent="logout">Logout</a>
                </div>
            </div>
            <div class="col-md-10">
                
                <div class="card">
                    <!-- card header -->
                    <div class="card-header">
                        <div class="content-head  d-flex justify-content-between">
                            <h4>Products of Mr {{user.name}}</h4>
                            <div class="search">
                               <div class="input-group">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn">
                                            <button type="button" class="btn btn-outline-primary">Go!</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row d-flex justify-content-center mt-50 mb-50">
                            <!-- products -->
                            <div v-for="product in products" :key="product.id" class="col-md-4 mt-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-img-actions"> <img :src="product.image" class="card-img img-fluid" width="96" height="350" alt=""> </div>
                                    </div>
                                    <div class="card-body bg-light text-center">
                                        <div class="mb-2">
                                            <h6 class="font-weight-semibold mb-2"> <a :href="product.slug" class="text-default mb-2" data-abc="true">
                                                {{ product.title }}
                                            </a> </h6> 
                                            <a href="#" class="text-muted" data-abc="true">
                                                {{product.category.name}}
                                            </a>
                                        </div>
                                        <h3 class="mb-0 font-weight-semibold">${{product.price}}</h3>
                                        <div> <i class="fa fa-star star"></i> <i class="fa fa-star star"></i> <i class="fa fa-star star"></i> <i class="fa fa-star star"></i> </div>
                                        <div class="text-muted mb-3">34 reviews</div> <button type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i> Add to cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end product -->
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
        return{
            products:[],
        }
    },
    methods:{
        async loadProduct(){
            let {data} = await axios.get('/api/products');
            console.log(data);
            this.products = data.data;
        },
        async logout(){
            await axios.post('/logout');
            await this.$store.commit('SET_AUTHENTICATED',false);
            localStorage.removeItem('auth');
            this.$router.push({name:'login'})
            this.$swal.fire(
                'Success!',
                'You are Logout Successfully!',
                'success'
            ); 
      }
    },
    computed:{
        massage(){
            return this.$store.getters.getMassage;
        },
        user(){
            return this.$store.getters.getUser;
        }
    },
    mounted(){
        this.loadProduct();
    }
}
</script>

<style>

</style>
