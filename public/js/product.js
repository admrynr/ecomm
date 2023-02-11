
var appuser = {
    handleUserPage : function(filter){
		user.handleTable(filter);
		user.handleBulkData();
		user.handleModalShow();
		user.handleModalClose();
		user.handleLogout();
		user.handlePostData();
		user.handleEditData();
		user.handleInfoData();
		user.handleDeleteData();
		user.handleApproveData();
		user.handleDeclineData();
		user.handleBidding();
    },
};

var user = {
	handleTable : function(filter){
		var table = $('#dataTableProduct').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			// ajax: '/roles/data',
			ajax: {
                url: baseURL+"/product/data?filter="+filter,
                method: 'GET',
            },
			columns: [
				// { data: 'id', name: 'id', className: "text-center", searchable: false },
				{data:'id',orderable:false,searchable:false},
				{
					data: null,
					orderable: false,
					className : "text-center",
					searchable: false,
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
                { data: 'product_name', name: 'name' },
                { data: null, name: 'type',render:function(data){
					if(data.product_type == "regular"){
						var type = '<b class="">Regular</b>';
					}else if(data.product_type == "bidding"){
						var type = '<b class="">Bidding</b>'
					}return type;
					}
                },
                { data: null, name: 'category',render:function(data){
					if (data.categories == null)
					{
						var uncategorized = "Uncategorized";
						return uncategorized;
					}else{
						return data.categories.name;
					}
				}},
				{ data: null, name: 'image', render:function(data){
					return '<td><image width="75px" class="rounded mx-auto d-block"' 
					+'src="'+baseURL+'/public/storage/images/'+data.image+'"></td>';
				}},
                { data: 'base_price', name: 'base_price' },
                { data: 'final_price', name: 'final_price' },
                { data: 'stock', name: 'stock' },
                { data: null, name: 'status',render:function(data){
					if(data.deleted_at != null){
						return status = '<b class="text-danger">TRASHED</b>'
					}
					if(data.is_verified == 1){
						var status = '<b class="text-success">ACTIVE</b>';
					}else{
						var status = '<b class="text-danger">DEACTIVE</b>'
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
						var button = "<button type='button' data-id='"+data.id+"' class='btn dotip btn-success btn-outline btn-circle m-r-5 btn-edt-data' data-toggle='tooltip' title='Edit Product'>"
										+"<i class='ti-pencil-alt'></i>"
									+"</button>"
									+"<a data-toggle='modal' data-target='#approveModal'><button type='button' data-url='"+baseURL+"/product/approve/"+data.id+"' class='btn dotip btn-info btn-outline btn-circle m-r-5 btn-activate-data' data-toggle='tooltip' title='Approve Product'>"
										+"<i class='ti-check'></i>"
									+"</button>"
									// +"<button type='button' data-id='"+data.id+"' class='btn btn-info btn-outline btn-circle btn-sm m-r-5 btn-show-permission' data-toggle='tooltip' title='Show Permission'>"
									//	+"<i class='fa fa-certificate'></i>"
									// +"</button>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/product/destroy/"+data.id+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Delete Product'>"
										+"<i class='ti-trash'></i>"
									+"</button></a>";
						} else {
						var button = "<button type='button' data-id='"+data.id+"' class='btn dotip btn-success btn-outline btn-circle m-r-5 btn-edt-data' data-toggle='tooltip' title='Edit Product'>"
										+"<i class='ti-pencil-alt'></i>"
									+"</button>"
									+"<a data-toggle='modal' data-target='#declineModal'><button type='button' data-url='"+baseURL+"/product/decline/"+data.id+"' class='btn dotip btn-warning btn-outline btn-circle m-r-5 btn-decline-data' data-toggle='tooltip' title='Deactivate Product'>"
										+"<i class='ti-close'></i>"
									+"</button>"
									// +"<button type='button' data-id='"+data.id+"' class='btn btn-info btn-outline btn-circle btn-sm m-r-5 btn-show-permission' data-toggle='tooltip' title='Show Permission'>"
									//	+"<i class='fa fa-certificate'></i>"
									// +"</button>"
									+"<a data-toggle='modal' data-target='#deleteModal'><button type='button' data-url='"+baseURL+"/product/destroy/"+data.id+"' class='btn dotip btn-danger btn-outline btn-circle m-r-5 btn-delete-data' data-toggle='tooltip' title='Delete Product'>"
										+"<i class='ti-trash'></i>"
									+"</button></a>";
						}
						return button;
					}
				}
			],
			columnDefs: [
				{
				   targets: 0,
				   orderable:false,
				   searchable:false,
				   checkboxes: {
					  selectRow: true
				   }
				}
			 ],
			 select: {
				style: 'multi'
			 },
		});
		user.handleInfoData();
		$(".bulk-button").on("click", function(){
			var rows_selected = table.column(0).checkboxes.selected();
			
			// Iterate over all selected checkboxes
			var bulkvalue = [];
			$.each(rows_selected, function(index, rowId){
				// Create a hidden element 
				bulkvalue[index] = rowId;
				
			});
			bulklength = bulkvalue.length;
			if(bulklength == 0){
				alert('Please choose data first !');
				return false;
			}

			$('#bulkvalue').val(bulkvalue);
			$('#bulkModal').modal('show');
			user.handleBulkData($(this).data('title'),bulkvalue);
			return false;
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
			modal.find(".modal-title").text("Insert Product");
			form.find("#method").val("store");
			form.find("#id").val("");
			user.handleBidding();
		})
	},

	handlePostData : function(){
		$('.dataForm').validator(['validate']).on('submit', function (e) {
			if (!e.isDefaultPrevented()) {
				var data = $(this).serialize();
				if($(this).find("#id").val() == "" && $(this).find("#method").val() === "store"){
					var url = baseURL+"/product/store";
				} else if($(this).find("#id").val() != "" && $(this).find("#method").val() === "update"){
					var url = baseURL+"/product/update/"+$(this).find("#id").val();
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
					user.handleTable($('#filter').val());
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
		$("#dataTableProduct tbody").on("click", ".btn-edt-data",function(){
            console.log('clicked edit');
			$.ajax({
				url: baseURL+"/product/edit/"+$(this).attr("data-id"),
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

		form.find("#name").val(data.product_name);
		form.find("#type").val(data.product_type);
		form.find("#category").val(data.categories_id);
		form.find("#base").val(data.base_price);
		form.find("#final").val(data.final_price);
		form.find("#stock").val(data.stock);
		form.find("#id").val(data.id);

        // about.html(data.about);
		form.find("#method").val("update");
	},

	handleBulkData : function(data, bulkdata){
		$('#bulk-title').html(data);
		$('#btn-bulk').on('click',function(){
			$.ajax({
				url: baseURL+'/product/bulk/'+data+'?id='+bulkdata,
				type: 'GET',
				dataType: 'JSON',
				success: function(data){
					$('#bulkModal').modal('hide');
					notification._toast('Success', 'Success Edit Data', 'success');
					user.handleTable($('#filter').val());
				}
			});
		})
		
	},

	handleDeleteData : function(){
		$("#dataTableProduct tbody").on("click", ".btn-delete-data", function(){
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
					user.handleTable($('#filter').val());
				}
			});
		});
	},

	handleApproveData : function(){
		$("#dataTableProduct tbody").on("click", ".btn-activate-data", function(){
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
					user.handleTable($('#filter').val());
				}
			});
		});
	},

	handleDeclineData : function(){
		$("#dataTableProduct tbody").on("click", ".btn-decline-data", function(){
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
					user.handleTable($('#filter').val());
				}
			});
		});
	},

	handleInfoData : function(){
		$.ajax({
			url: baseURL+"/product/info",
			type: 'GET',
			dataType: 'JSON',
			success: function(data){
				for (x in data){
					($('#'+x).html(data[x]));
				}
				}
		});
	},

	handleBidding : function(){
		$("select.type").change(function(){
				if(this.value == 'bidding'){
					var bidding = $('#dataModalBidding').children().html();
					$('#bidding').html(bidding);
				}else{
					$('#bidding').html('');
				}
		});
	}
};

