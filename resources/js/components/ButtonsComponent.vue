<template>
    <div class="btn-group-vertical">
        <a class="btn btn-dark mb-2" data-toggle="modal" data-target="#edit">+ Create a new Product</a>
        <a class="btn btn-dark mb-2" href="/home">View products as user</a>
        <a class="btn btn-dark mb-2" href="/Admin/users">Manage Users</a>
    </div>
</template>

<script>

    let user = document.head.querySelector('meta[name="user-auth"]');
 
    console.log(JSON.parse(user.content).api_token);

    import axios from 'axios'

    export default {
        data () {
            return {
                products: null,
            }
        },
        mounted () {
            this.getProducts();
        },
        methods: {
            getProducts: function () {
                axios.get('/api/products' + '?api_token='+ JSON.parse(user.content).api_token).then(response => {
                    this.products = response.data.data
                });
            },
            createProducts () {
                axios.get('/api/products').then(response => {
                    console.log(response.data.data)
                });
            }
        }
    }
</script>
