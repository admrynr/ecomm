var app = {
	init : function(){
		handleTooltip._tooltip();
		handleClock.digital();
	},

  	handleDashboard : function(){
    	dashboard.handleDonut();
    },

    handleUserPage : function(){
        user.handleTable();
		user.handleModalShow();
		user.handleModalClose();
		user.handlePostData();
		user.handleEditData();
		user.handleDeleteData();
		user.handleApproveData();
		user.handleDeclineData();
    },
};


var notification = {
	_toast : function(heading, text, icon){
		$.toast({
            heading: heading,
            text: text,
            position: 'top-right',
            loaderBg: '#fff',
            icon: icon,
            hideAfter: 3500
        });
	}
};

var handleTooltip = {
	_tooltip : function(){
		$('.dotip').tooltip({
            content: function () {
                return $(this).prop('title');
            }
        });
	}
};

var progressbar = {
	iUploadHandle : function(b) {
		b = b || false;
		if (b) {
			$('.progArea').show();
		} else {
			$('.progArea').hide();
		}
		$('.progValue').css('width','0%').text('0%');
	}
};

var user = {
	handleTable : function(){
		$('#dataTable').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			// ajax: '/roles/data',
			ajax: {
                url: baseURL+"/user/data",
                method: 'GET',
            },
			columns: [
				// { data: 'id', name: 'id', className: "text-center", searchable: false },
				{
					data: null,
					orderable: false,
					className : "text-center",
					searchable: false,
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{ data: 'username', name: 'username' },
				{ data: 'name', name: 'name' },
				{ data: 'email', name: 'email' },
                { data: null, name: 'is_verified',render:function(data){
					if(data.is_verified == 1){
						var status = '<b class="text-success">VERIFIED</b>';
					}else{
						var status = '<b class="text-danger">UNVERIFIED</b>'
					}return status;
					}
				},
				{
					data: null,
					orderable: false,
					className: "text-center",
					searchable: false,
					render: function(data, type, row){
						if(data.is_verified == 0){
						var button = "<button type='button' data-id='"+data.id+"' class='btn dotip btn-success btn-outline btn-circle m-r-5 btn-edt-data' data-toggle='tooltip' title='Edit User'>"
										+"<i class='ti-pencil-alt'></i>"
									+"</button>"
									+"<a data-toggle='modal' data-target='#approveModal'><button type='button' data-url='"+baseURL+"/user/approve/"+data.id+"' class='btn dotip btn-info btn-outline btn-circle m-r-5 btn-activate-data' data-toggle='tooltip' title='Approve User'>"
										+"<i class='ti-check'></i>"
									+"</button>"
									// +"<button type='button' data-id='"+data.id+"' class='btn btn-info btn-outline btn-circle btn-sm m-r-5 btn-show-permission' data-toggle='tooltip' title='Show Permission'>"
									//	+"<i class='fa fa-certificate'></i>"
									// +"</button>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/user/destroy/"+data.id+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Delete User'>"
										+"<i class='ti-trash'></i>"
									+"</button></a>";
						} else {
						var button = "<button type='button' data-id='"+data.id+"' class='btn dotip btn-success btn-outline btn-circle m-r-5 btn-edt-data' data-toggle='tooltip' title='Edit User'>"
										+"<i class='ti-pencil-alt'></i>"
									+"</button>"
									+"<a data-toggle='modal' data-target='#declineModal'><button type='button' data-url='"+baseURL+"/user/decline/"+data.id+"' class='btn dotip btn-warning btn-outline btn-circle m-r-5 btn-decline-data' data-toggle='tooltip' title='Deactivate User'>"
										+"<i class='ti-close'></i>"
									+"</button>"
									// +"<button type='button' data-id='"+data.id+"' class='btn btn-info btn-outline btn-circle btn-sm m-r-5 btn-show-permission' data-toggle='tooltip' title='Show Permission'>"
									//	+"<i class='fa fa-certificate'></i>"
									// +"</button>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/user/destroy/"+data.id+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Delete User'>"
										+"<i class='ti-trash'></i>"
									+"</button></a>";
						}
						return button;
					}
				}
			],
		});
		user.handleInfoData();
	},

	handleModalShow: function(){
		$("#add-data").on("click", function(){
			var modal = $("#dataModal");
			var form = $("#dataForm");

			modal.modal("show");
			modal.find(".modal-title").text("Tambah User");
			form.find("#method").val("store");
			form.find("#id").val("");
		})
	},

	handlePostData : function(){
		$('#dataForm').validator(['validate']).on('submit', function (e) {
			if (!e.isDefaultPrevented()) {
				var data = $(this).serialize();
				if($(this).find("#id").val() == "" && $(this).find("#method").val() === "store"){
					var url = baseURL+"/user/store";
				} else if($(this).find("#id").val() != "" && $(this).find("#method").val() === "update"){
					var url = baseURL+"/user/update/"+$(this).find("#id").val();
				}
				useruser.handleStoreData(url, data);
				return false;
			} else {
				notification._toast('ERROR', 'Please input value', 'error');
			}
		});
	},

	handleStoreData : function(url, data){
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: data,
			success: function(data) {
				if(data.status == 1){
					notification._toast('Success', 'Success Update Data', 'success');
					$("#dataModal").modal("hide");
					useruser.handleTable();
				}else{
					notification._toast('Error', data.message, 'error');
				}
			},
		});
	},

	handleModalClose : function(){
		$('#dataModal').on('hidden.bs.modal', function () {
			$(this).find(".has-error").removeClass("has-error");
			$('#dataForm').find("input[type=checkbox]").prop('checked',false);
			$('#dataForm').find("input[type=text], input[type=email], input[type=password], textarea").val("");
		})
	},

	handleEditData : function(){
		$("#dataTable tbody").on("click", ".btn-edt-data",function(){
            console.log('clicked edit');
			$.ajax({
				url: baseURL+"/user/edit/"+$(this).attr("data-id"),
				type: "GET",
				dataType: "JSON",
				success : function(data){
					useruser.handleShowEditForm(data);
				}
			});
		})
	},

	handleShowEditForm : function(data){
		var modal = $("#dataModal");
        var form = $("#dataForm");
        var about = $('#about');

		modal.modal("show");
		modal.find(".modal-title").text("Edit Data User");

		form.find("#id").val(data.id);
		form.find("#username").val(data.username);
		form.find("#name").val(data.name);
		form.find("#email").val(data.email);
		data.user_role.forEach(function(entry) {
			form.find("#"+entry.role_id).prop('checked', true);
		});

        // about.html(data.about);
		form.find("#method").val("update");
	},

	handleDeleteData : function(){
		$("#dataTable tbody").on("click", ".btn-delete-data", function(){
			url = $(this).attr('data-url');
		});

		$('#btn-hapus').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#deleteModal').modal('hide');
					notification._toast('Success', 'Success Delete Data', 'success');
					useruser.handleTable();
				}
			});
		});
	},

	handleApproveData : function(){
		$("#dataTable tbody").on("click", ".btn-activate-data", function(){
			url = $(this).attr('data-url');
		});

		$('#btn-approve').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#approveModal').modal('hide');
					notification._toast('Success', 'Success Approve Data', 'success');
					useruser.handleTable();
				}
			});
		});
	},

	handleDeclineData : function(){
		$("#dataTable tbody").on("click", ".btn-decline-data", function(){
			url = $(this).attr('data-url');
		});

		$('#btn-decline').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#declineModal').modal('hide');
					notification._toast('Success', 'User Deactivated', 'success');
					useruser.handleTable();
				}
			});
		});
	},

	handleInfoData : function(){
		$.ajax({
			url: baseURL+"/user/info",
			type: 'GET',
			dataType: 'JSON',
			success: function(data){
				$('#total').html(data.total);
			}
		});
	}
};

