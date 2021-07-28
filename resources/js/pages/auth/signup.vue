<template>
  <div>
      <div class="container">
          <div class="py-5">
              <div class="row">
                  <div class="col-md-6 offset-3">
                    <div class="card card-default">
                        <div class="card-header">
                           <h4> Create Account</h4>
                        </div>
                        <div class="card-body">
                            <form action="post" @click.prevent="signup()">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" v-model="signupForm.name" :class="{'is-invalid': signupForm.errors.has('name')}" name="name" class="form-control" placeholder="Enter your name">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" v-model="signupForm.email" :class="{'is-invalid': signupForm.errors.has('email')}" name="email" class="form-control" placeholder="Enter your email">
                                </div>

                                <div class="form-group">
                                     <label for="password">Password</label>
                                    <input type="password" v-model="signupForm.password" :class="{'is-invalid': signupForm.errors.has('password')}" name="password" class="form-control" placeholder="Enter your password">
                                </div>
                                <div class="form-group">
                                     <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" v-model="signupForm.password_confirmation" :class="{'is-invalid': signupForm.errors.has('password_confirmation')}" name="password_confirmation" class="form-control" placeholder="Enter your confirm password">
                                </div>
                                
                                <div class="form-group">
                                   <button type="submit" :disabled="signupForm.busy" class="btn btn-success px-4">Signup</button>
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
           signupForm: new Form({
                name:'',
                email:'',
                password:'',
                password_confirmation:'',
            }),  
       }     
    },
    methods:{
        async signup(){
            await axios.get('/sanctum/csrf-cookie');
            await this.signupForm.post('/register');
            await this.getUserData();
            this.$router.push({name:'dashboard'});
            this.$swal.fire(
                'Success!',
                'Your Acount has been Create Successfully!',
                'success'
            ); 
        },
        async getUserData(){
            await axios.get('/api/user').then(response =>{
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