<form class="dataEditForm" method="POST" id="dataEditForm" action="#">
        {{ csrf_field() }}
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nama_client" class="control-label">Name :</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nama_client" class="control-label">Email :</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                </div>
            </div>
                <input type="hidden" id="password">
                <input type="hidden" id="method">
                <input type="hidden" id="id">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
            <button type="submit"  class="btn btn-success waves-effect waves-light">Simpan</button>
        </div>
    </form>
        
    