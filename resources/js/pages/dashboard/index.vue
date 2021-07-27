<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="card-header">
                        <h4>Dashboard</h4>
                    </div>
                <div class="list-group text-white bg-dark">
                <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
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
        logout(){
        axios.post('/logout').then(response =>{
          this.$router.push({name:'login'})
          this.$store.commit('SET_AUTHENTICATED',false);
          localStorage.removeItem('auth');

          
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
