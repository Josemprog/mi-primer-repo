<form method="POST" @submit.prevent="createProduct">
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
                            <input name="brand" id="brand" class="form-control" value="brand">

                            <label class="text-muted" for="name">Name</label>
                            <input name="name" id="name" class="form-control" value="name">

                            <label class="text-muted" for="price">Unit Price</label>
                            <input name="price" id="price" class="form-control" value="350000">

                            <label class="text-muted" for="quantity">Quantity</label>
                            <input name="quantity" id="quantity" class="form-control" value="7">

                            <label class="text-muted" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30"
                                rows="5">description</textarea>
                        </div>

                        <div class=" image-create col-6 d-flex flex-column justify-content-between">
                            <h3 class="text-muted"> Image</h3>
                            <img src="#" class="img-fluid" alt="Responsive image">
                            <div class="custom-file">
                                <label class="text-muted" for="image">Image</label>
                                <input name="image" id="image" class="form-control"
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