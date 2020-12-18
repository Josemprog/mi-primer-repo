<template>
    <form @submit.prevent="createProduct">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Create a New Product</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group" style="padding: 10px">
                        <div class="col-6">
                            <label class="text-muted" for="brand">Brand</label>
                            <input type="text" v-model="newProduct.brand" id="brand" class="form-control" value="brand">

                            <label class="text-muted" for="name">Name</label>
                            <input type="text" v-model="newProduct.name" id="name" class="form-control" value="name">

                            <label class="text-muted" for="price">Unit Price</label>
                            <input type="number" v-model="newProduct.price" id="price" class="form-control" value="350000">

                            <label class="text-muted" for="quantity">Quantity</label>
                            <input type="number" v-model="newProduct.quantity" id="quantity" class="form-control" value="7">

                            <label class="text-muted" for="description">Description</label>
                            <textarea type="text" class="form-control" v-model="newProduct.description" id="description" cols="30"
                                rows="5">description</textarea>
                        </div>

                        <div class=" image-create col-6 d-flex flex-column justify-content-between">
                            <h3 class="text-muted"> Image</h3>
                            <img src="#" class="img-fluid" alt="Responsive image">
                            <div class="custom-file">
                                <label class="text-muted" for="image">Image</label>
                                <input type="text" v-model="newProduct.image" id="image" class="form-control"
                                    value="https://lorempixel.com/output/fashion-q-c-640-480-10.jpg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary btn-block" value="Create">
                </div>
            </div>
        </div>
    </div>
</form>
</template>

<script>

    let user = document.head.querySelector('meta[name="user-auth"]');

    import axios from 'axios'

    export default {
        data () {
            return {
                newProduct: {
                    brand: 'brand',
                    name: 'name',
                    price: 350000,
                    quantity: 7,
                    description: 'description',
                    image: 'https://lorempixel.com/output/fashion-q-c-640-480-10.jpg',
                    enabled: true,
                    api_token: JSON.parse(user.content).api_token
                }
            }
        },
        methods: {
            createProduct: function() {
                var url = '/api/products/';
                axios.post(url, this.newProduct)
                .then(response => {
                    this.$emit('createProduct');
                    $('#create').modal('hide');
                    alert('The product has been create successfully');
                })
            }
        }
    }
</script>

