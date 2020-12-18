<template>
    <div class="btn-group-vertical">
        <a class="btn btn-dark mb-2" href="/home">View products as user</a>
        <a class="btn btn-dark mb-2" href="/Admin/users">Manage Users</a>
    </div>
</template>

<script>

    let user = document.head.querySelector('meta[name="user-auth"]');

    import axios from 'axios'

    export default {
        data () {
            return {
                products: null,
                newProduct: null
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
            createProduct: function(product) {
                var url = '/api/products/' + product.id + '/?api_token='+ JSON.parse(user.content).api_token;
                axios.post(url, {
                    brand: this.newProduct,
                    name: this.newProduct,
                    price: this.newProduct,
                    quantity: this.newProduct,
                    description: this.newProduct,
                    image: this.newProduct,
                    enabled: this.newProduct,
                }).then(response => {
                    this.getProducts();
                    this.newProduct = null;
                    $('create'.modal('hide'));
                    alert('The product has been create successfully');
                })
            }
        }
    }
</script>

