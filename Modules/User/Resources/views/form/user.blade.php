<form class="dataForm" method="POST" id="dataForm" action="#">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name" class="control-label">Name :</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="phone" class="control-label">Phone :</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="level" class="control-label">Role :</label>
                    <select name="level" id="level" class="form-control" required>
                        <option value="">Select Role --</option>
                        @foreach ($levels as $level)
                        <option value="{{$level->id}}">{{$level->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row password_form">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_client" class="control-label">Passsword :</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_client" class="control-label">Password Confirmation :</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>
            </div>
        </div>
            <input type="hidden" id="method">
            <input type="hidden" id="id">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
        <button type="submit"  class="btn btn-success waves-effect waves-light">Simpan</button>
    </div>
</form>
    
