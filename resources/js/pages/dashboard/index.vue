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
                    <div class="card-header">
                        <h4>Content</h4>
                    </div>
                    <div class="card-body">
                        <h5>{{massage}}</h5>
                        <h5>Welcome to Dashboard,Mr {{user.name}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods:{
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
    }
}
</script>

<style>

</style>
