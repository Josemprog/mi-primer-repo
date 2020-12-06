<template>
    <table class="table table-responsive-sm table-striped table-light">
        <thead class="thead-dark h5">
            <tr>
                <th>#</th>
                <th>image</th>
                <th>Brand</th>
                <th>Name</th>
                <th>Unit price</th>
                <th>Quantity</th>
                <th>Creation date</th>
                <th>Modification date</th>
                <th>State</th>
                <th>Set up</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product, index) in products" :key="index">
                <th scope="row">{{ index+1 }}</th>
                <th>{{ product.image.substr(-50, 15) + '...' }}</th>
                <th>{{ product.brand }}</th>
                <th>{{ product.name }}</th>
                <th class="text-success">${{ product.price}}</th>
                <th>{{ product.quantity }}</th>
                <th>{{ product.created }}</th>
                <th>{{ product.updated_at }}</th>
                <th> state </th>
                <th class="btn-group">
                    <!-- <div> -->
                        <i class="btn fas fa-pencil-alt text-info" data-toggle="modal" data-target="#edit"></i>
                        <i class="btn fas fa-trash-alt text-danger" v-on:click="deleteProducts(product)"></i>
                    <!-- </div> -->
                </th>
            </tr>
        </tbody>
    </table>
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
            deleteProducts: function (product) {
                axios.delete('/api/products/' + product.id + '/?api_token='+ JSON.parse(user.content).api_token).then(response => {
                    this.getProducts();
                    alert('The product has been removed successfully');
                });
            },
            edit () {
                axios.get('/api/products').then(response => {
                    console.log(response.data.data)
                });
            }
        }
    }
</script>
