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
                <td scope="row">{{ index+1 }}</td>
                <td>{{ product.image.substr(-50, 15) + '...' }}</td>
                <td>{{ product.brand }}</td>
                <td>{{ product.name }}</td>
                <td class="text-success">${{ product.price}}</td>
                <td>{{ product.quantity }}</td>
                <td>{{ product.created }}</td>
                <td>{{ product.updated_at }}</td>
                <td class="text-success" v-if="product.enabled"><button class="btn btn-outline-success" disabled>Enabled</button></td>
                <td class="text-success" v-else><button class="btn btn-outline-secondary" disabled>Disabled</button></td>
                <td class="btn-group">
                    <i class="btn fas fa-pencil-alt text-primary" data-toggle="modal" data-target="#edit"></i>
                    <i class="btn fas fa-trash-alt text-danger" v-on:click="deleteProduct(product)"></i>
                </td>
            </tr>
        </tbody>
    </table>
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
            deleteProduct: function (product) {
                axios.delete('/api/products/' + product.id + '/?api_token='+ JSON.parse(user.content).api_token).then(response => {
                    this.getProducts();
                    alert('The product has been removed successfully');
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
