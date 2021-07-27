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
                        <h4>User {{ auth.name }} Profile Add</h4>
                    </div>
                    <div class="card-body">
                       <div class="col-12 col-lg-6 col-md-8 offset-lg-3 offset-md-2">
                            <!-- form start -->
                            <form role="form" @submit.prevent="updateUserProfile">
                                <div class="row mt-5">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="name"  v-model="userForm.name" field="name" name="name" :class="{'is-invalid': userForm.errors.has('name')}"  class="form-control" id="name"  placeholder="Enter name" >
                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email"  v-model="userForm.email" field="email" :class="{'is-invalid': userForm.errors.has('email')}" name="email" class="form-control" id="email"  placeholder="Enter email">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"  v-model="userForm.password" authocomplite="new-password"  field="password" :class="{'is-invalid': userForm.errors.has('password')}" name="password" class="form-control" id="password"  placeholder="Enter password">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm_password</label>
                                            <input type="password" v-model="userForm.confirm_password" authocomplite="new-password" field="confirm_password"  :class="{'is-invalid': userForm.errors.has('confirm_password')}"  name="confirm_password" class="form-control" id="confirm_password"  placeholder="Enter confirm password">
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- /.card-body -->               
                                <div class="card-footer">
                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform'
export default {
    data(){
        return{
            userForm: new Form({
                name:'',
                email:'',
                password:'',
                confirm_password:'',
            }),
        }
    },
    methods:{
        updateUserProfile(){
            this.userForm.post('/api/user')
            .then(response =>{
                // set update on vuex store
                this.$store.commit('SET_USER', response.data);
                // sweet alert
                this.$swal.fire(
                    'Done!',
                    'User Update Successfully!',
                    'success'
                );  

            });
        },
        user(){
            let user = this.$store.getters.getUser;
            this.userForm.name = user.name;
            this.userForm.email = user.email;
        },
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
    created(){
        this.user();
    },
    computed:{
        auth(){
            return this.$store.getters.getUser;
        }
    }
}
</script>

<style>

</style>
