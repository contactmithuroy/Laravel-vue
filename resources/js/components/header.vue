<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <router-link class="navbar-brand" :to="{name:'home'}">Site Logo </router-link>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
        <ul class="navbar-nav ml-auto" v-if="auth">
          <li><router-link class="nav-item nav-link text-white" :to="{name:'home'}">Home <span class="sr-only">(current)</span></router-link></li>
          <li><router-link class="nav-item nav-link text-white" v-if="auth" :to="{name:'dashboard'}">Dashboard</router-link></li>
          <li><router-link class="nav-item nav-link text-white" :to="{name:'category-list'}">Category</router-link></li>
          <li><router-link class="nav-item nav-link text-white" :to="{name:'product-list'}">Product</router-link></li>
        </ul>
        <ul class="navbar-nav ml-auto " v-else>
          <li><router-link class="nav-item nav-link text-white" :to="{name:'login'}">Login</router-link>  </li>      
          <li><router-link class="nav-item nav-link text-white" :to="{name:'signup'}">Signup</router-link> </li>       
        </ul>
       
        </div>
    </div>
  </div>
</nav>
</template>

<script>
import axios from 'axios'
export default {
    methods:{
      logout(){
        axios.post('/logout').then(response =>{
          this.$router.push({name:'login'})
          console.log('success');
          this.$swal.fire(
                    'Success!',
                    'You are Logout Successfully!',
                    'success'
                ); 
        });
      }
    },
    computed:{
      auth(){
        return this.$store.getters.getAuthenticated;
      }
    }
}
</script>

<style>

</style>