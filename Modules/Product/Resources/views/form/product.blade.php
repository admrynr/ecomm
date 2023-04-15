<form class="dataForm" method="POST" id="dataForm" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nama" class="control-label">Name :</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                    <div class="form-group">
                        <label for="category" class="control-label">Category :</label>
                        <select class="form-control" name="category" id="category">
                                <option selected='selected' value="">Select Category</option>
                            @foreach ($categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select> 
                    </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label class="control-label">Brand :</label>
                <select name="brand" class="form-control select2">
                    <option>Select Brand</option>
                    @foreach ($brands as $b)
                    <option value="{{$b->id}}">{{$b->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label class="control-label">Available Colors :</label>
                <select name="color[]" class="form-control select2 select2-multiple" multiple="multiple" multiple data-placeholder="Choose ...">
                    <option>Select Colors</option>
                    @foreach ($colors as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label class="control-label">Available Size :</label>
                <select name="size[]" class="form-control select2 select2-multiple" multiple="multiple" multiple data-placeholder="Choose ...">
                    <option>Select Size</option>
                    @foreach ($sizes as $s)
                    <option value="{{$s->id}}">{{$s->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="file" class="filestyle" data-input="false" data-buttonname="btn-secondary">Product Image :</label>
                    <input type="file" name="file" required>
                </div>
            </div>
            <div class="col-md-12">
                    <div class="form-group">
                        <label for="base" class="control-label">Mitra Price :</label>
                        <input type="text" name="mitra_price" id="mitra_price" class="form-control" required>
                    </div>
            </div>
            <div class="col-md-12">
                    <div class="form-group">
                        <label for="final" class="control-label">Reseller Price :</label>
                        <input type="text" name="reseller_price" id="reseller_price" class="form-control" required>
                    </div>
                </div>
            <div class="col-md-12">
                    <div class="form-group">
                        <label for="stock" class="control-label">Stock :</label>
                        <input type="text" name="stock" id="stock" class="form-control" required>
                    </div>
                </div>
        </div>
        
            <input type="hidden" id="method">
            <input type="hidden" id="id">
            <input type="hidden" id="isbid">

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
        <button type="submit"  class="btn btn-success waves-effect waves-light">Simpan</button>
    </div>
</form>
    
