<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <router-link class="navbar-brand" :to="{name:'home'}">Site Logo </router-link>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
        <router-link class="nav-item nav-link text-white" :to="{name:'home'}">Home <span class="sr-only">(current)</span></router-link>
        <router-link class="nav-item nav-link text-white" :to="{name:'category-list'}">Category</router-link>
        <router-link class="nav-item nav-link text-white" :to="{name:'product-list'}">Product</router-link>
        <a class="nav-item nav-link" href="#" style="color:red">Pricing</a>
        </div>
    </div>
  </div>
</nav>
</template>

<script>
export default {

}
</script>

<style>

</style>