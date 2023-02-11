
var appcashier = {
    handleUserPage : function(){
        cashier.handleTable();
		cashier.handleModalShow();
		cashier.handleModalClose();
		cashier.handleLogout();
		cashier.handlePostData();
		cashier.handleEditData();
		cashier.handleDeleteData();
		cashier.handleApproveData();
		cashier.handleSetCashier();
		cashier.handleSetRegular();
		cashier.handleDeclineData();
    },
};

var cashier = {
	handleTable : function(){
		$('#dataTable').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			// ajax: '/roles/data',
			ajax: {
                url: baseURL+"/cashier/data",
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
				{ data: 'product', name: 'product_name' },
                { data: 'base_price', name: 'base_price' },
                { data: 'final_price', name: 'final_price' },
                { data: 'stock', name: 'stock' },
                { data: 'image', name: 'image' },
				{
					data: null,
					orderable: false,
					className: "text-center",
					searchable: false,
					render: function(data, type, row){
							var button = "<a data-toggle='modal' data-target='#cashierModal'><button type='button' data-url='"+baseURL+"/user/setCashier/"+data.id+"' class='btn dotip btn-warning btn-outline btn-circle m-r-5 btn-set-cashier' data-toggle='tooltip' title='Set As Cashier'>"
							+"<i class='ti-money'></i>"
						+"</button>";
						return button;
					}
				}
			],
		});
	},

	handleLogout : function(){
		$("#log-out").on("click", function(){
			var modal = $("#logoutModal");
			var form = $("#logout-form");
			
			modal.modal("show");
		})
	},

	handleModalShow: function(){
		$(".add-data").on("click", function(){
			var modal = $(".dataModal");
			var form = $(".dataForm");

			modal.modal("show");
			modal.find(".modal-title").text("Create User");
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
				user.handleStoreData(url, data);
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
					user.handleTable();
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
					user.handleShowEditForm(data);
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
		form.find("#name").val(data.name);
		form.find("#email").val(data.email);

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
					user.handleTable();
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
					user.handleTable();
				}
			});
		});
	},

	handleSetCashier : function(){
		$("#dataTable tbody").on("click", ".btn-set-cashier", function(){
			url = $(this).attr('data-url');

			$("#roleUser").text("Cashier");
		});

		$('#btn-cashier').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#cashierModal').modal('hide');
					notification._toast('Success', 'Success Change Level', 'success');
					user.handleTable();
				}
			});
		});
	},

	handleSetRegular : function(){
		$("#dataTable tbody").on("click", ".btn-set-regular", function(){
			url = $(this).attr('data-url');
			$("#roleUser").text("Regular User");
		});

		$('#btn-regular').on('click',function(){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#regularModal').modal('hide');
					notification._toast('Success', 'Success Change Level', 'success');
					user.handleTable();
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
					user.handleTable();
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

