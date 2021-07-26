<template>
    <div class="container">
        <!-- <div class="py-5"> -->
              <div class="row">
                  <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h4>Dashboard</h4>
                  </div>
                  <div class="card-body">
                        <h5>{{massage}}</h5>
                      <h5>Welcome to Dashboard,Mr {{user.name}}</h5>
                  </div>
              </div>
            </div>
        <!-- </div> -->
      </div>
  </div>
</template>

<script>
export default {
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