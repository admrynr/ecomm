
<form class="dataForm" method="POST" action="#" id="dataForm" enctype="multipart/form-data">
        @csrf
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
                        <label for="file" class="control-label">Brand Image :</label>
                        <input type="file" name="image" required>
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
        
    