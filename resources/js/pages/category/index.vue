<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-item-center">
                        <h5>Category Component</h5>
                        <router-link :to="{name:'create-category'}" class="btn btn-primary btn-sm">Create Category</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width:100px">Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th style="width:170px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in categories" :key="category.id" >
                                    <td style="width:100px">{{category.id }}</td>
                                    <td>{{category.name }}</td>
                                    <td>{{category.slug }}</td>
                                    <td style="width:170px">
                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                categories:[],
            }
        },
        methods:{
            loadCategories(){
                axios.get('/api/category')
                .then(response =>{
                    this.categories = response.data;
                });
            }
        },
        mounted() {
            this.loadCategories();
        }
    }
</script>
