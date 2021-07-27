<template>
  <div>
      <div class="container">
          <div class="py-5">
              <div class="row">
                  <div class="col-md-6 offset-3">
                    <div class="card card-default">
                        <div class="card-header">
                           <h4> Login</h4>
                        </div>
                        <div class="card-body">
                            <form action="post" @click.prevent="login()">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" v-model="loginForm.email" :class="{'is-invalid': loginForm.errors.has('email')}" name="email" class="form-control" placeholder="Enter your email">
                                    <!-- <span :form="loginForm" field="email"></span> -->
                                </div>

                                <div class="form-group">
                                     <label for="password">Password</label>
                                    <input type="password" v-model="loginForm.password" :class="{'is-invalid': loginForm.errors.has('password')}" name="password" class="form-control" placeholder="Enter your password">
                                    <!-- <span :form="loginForm" field="password"></span> -->
                                </div>
                                
                                <div class="form-group">
                                   <button type="submit" class="btn btn-success px-4">Login</button>
                                </div>

                            </form>
                        </div>
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
           loginForm: new Form({
                email:'ethen@gmail.com',
                password:'aaaaaaaa',
            }),  
       }     
    },
    methods:{
        login(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                this.loginForm.post('/login').then(response =>{
                    console.log(response); 

                     this.getUserData();

                    this.$router.push({name:'dashboard'});
                    this.$swal.fire(
                    'Success!',
                    'You are Login Successfully!',
                    'success'
                ); 

                }); 
            });
        },

        getUserData(){
            axios.get('/api/user').then(response =>{
                console.log(response.data);
                let user = response.data;
                this.$store.commit('SET_USER', user);
                this.$store.commit('SET_AUTHENTICATED',true);

                // set data on local storage
                localStorage.setItem('auth',true);
            });
        },
    },

    mounted(){
       
    }
}
</script>

<style>

</style>


<!--  --!>