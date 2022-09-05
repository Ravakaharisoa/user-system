<?php require_once 'assets/php/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php if ($verified == 'Not Verified!'):?>
				<div class=" alert alert-danger alert-dismissible text-center mt-2 m-0">
					<button class="close" type="button" data-dismiss="alert">&times;</button>
					<strong>Your E-mail is not verified! We've sent you an E-mail Verfication link on your E-mail, check and verify now!</strong>
				</div>
			<?php endif; ?>
			<h4 class="text-center text-primary mt-2">Write Your Notes Here And Access Anytime Anywhere!</h4>
		</div>
	</div>
	<div class="card border-primary">
		<h5 class="card-header bg-primary d-flex justify-content-between">
			<span class="text-light lead align-self-center">All Notes</span>
			<a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNoteModal"><i class="fa fa-plus-circle fa-lg"></i>&nbsp; Add New Note</a>
		</h5>
		<div class="card-body">
			<div class="table-responsive" id="showNote">
				<p class="text-center lead mt-5">Please Wait...</p>	
			</div>
		</div>
	</div>
</div>

<!---Start Add New Note Modal -->
<div class="modal fade" id="addNoteModal">
	<div class="modal-dialog modal-dialog-center">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h4 class="modal-title text-light">Add New Note</h4>
				<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form method="post" action="#" id="add-note-form" class="px-3">
					<div class="form-group">
						<input type="text" name="title" class="form-control form-group-lg" placeholder="Enter Title" required>
					</div>
					<div class="form-group">
						<textarea name="note" class="form-control form-control-lg" placeholder="Write Your Note Here..." rows="6" required></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="addNote" id="addNoteBtn" value="Add Note" class="btn btn-success btn-block btn-lg">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!---End Add New Note Modal -->

<!---Start Edit Note Modal -->
<div class="modal fade" id="editNoteModal">
	<div class="modal-dialog modal-dialog-center">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h4 class="modal-title text-light">Edit Note</h4>
				<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form method="post" action="#" id="edit-note-form" class="px-3">
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<input type="text" name="title" id="title" class="form-control form-group-lg" placeholder="Enter Title" required>
					</div>
					<div class="form-group">
						<textarea name="note" class="form-control form-control-lg" id="note" placeholder="Write Your Note Here..." rows="6" required></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="editNote" id="editNoteBtn" value="Edit Note" class="btn btn-info btn-block btn-lg">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!---End Add New Note Modal -->
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="assets/js/all.js"></script>
<script type="text/javascript" src="assets/js/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
<script>
	$(document).ready(function(){
		//datatable en francais
		/*$("table").dataTable({
    		language: {
       			 url: "assets/json/french.json"
    				}
		});*/

		//Add New Note Ajax Request
		$("#addNoteBtn").click(function(e){
			if($("#add-note-form")[0].checkValidity()){
				e.preventDefault();

				$("#addNoteBtn").val('Please Wait...');

				$.ajax({
					url: 'assets/php/process.php',
					method: 'post',
					data: $("#add-note-form").serialize()+'&action=add_note',
					success:function(response){
						$("#addNoteBtn").val('Add Note');
						$("#add-note-form")[0].reset();
						$("#addNoteModal").modal('hide');
						swal("Success!", "Note added successfully!", {
							icon : "success",
							buttons: false,
							timer: 3000,
						});

						displayAllNotes();
					}
				});
			}
		});

		//Edit Note Of An User Ajax Request
		$("body").on("click",".editBtn", function(e){
			e.preventDefault();

			edit_id = $(this).attr('id');
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: {edit_id: edit_id },
				success:function(response){
					data = JSON.parse(response);
					$("#id").val(data.id);
					$("#title").val(data.title);
					$("#note").val(data.note);
				}
			});
		});

		//Update Note Of An User Ajax Request
		$("#editNoteBtn").click(function(e){
			if ($("#edit-note-form")[0].checkValidity()){
				e.preventDefault();

				$.ajax({
					url:'assets/php/process.php',
					method: 'post',
					data : $("#edit-note-form").serialize()+'&action=update_note',
					success:function(response){
						swal("Success!", "Note updated successfully!", {
							icon : "success",
							buttons: false,
							timer: 3000,
						});
						$("#edit-note-form")[0].reset();
						$("#editNoteModal").modal('hide');

						displayAllNotes();
					}
				});
			}
		});

		//Delete a Note of An User Ajax Request
		$("body").on("click",".deleteBtn", function(e){
			e.preventDefault();

			del_id = $(this).attr('id');

			swal("Are you sure?", "You won't be able to revert this!",{
				icon : "warning",
				buttons:{
					confirm: {
						text : 'Yes, delete it!',
						className : 'btn btn-success'
					},
					cancel: {
						visible: true,
						className: 'btn btn-danger'
					}
				}
			}).then((Delete) => {
				if (Delete) {
					$.ajax({
						url: 'assets/php/process.php',
						method:'post',
						data : {del_id : del_id},
						success:function(response){
							swal({
								title: 'Deleted!',
								text: 'Note deleted successfully!',
								type: 'success',
								buttons : {
									confirm: {
										className : 'btn btn-success'
									}
								}
							});

							displayAllNotes();
						}
					});
				}
			});
		});

		//Display Note of An User in Details Ajax Request
		$("body").on("click",".infoBtn",function(e){
			e.preventDefault();
			info_id = $(this).attr('id');

			$.ajax({
				url:'assets/php/process.php',
				method:'post',
				data : {info_id : info_id},
				success:function(response){
					data = JSON.parse(response);
					swal({
						title: '<strong>Note : ID('+data.id+')<strong>',
						type :'info',
						html : '<b>Title : </b>'+data.title+'<br><br><b>Note : </b>'+data.note+'<br><br><b>Written On : </b>'+data.created_at+'<br><br><b>Updated On : </b>'+data.updated_at,
						showCloseButton : true,
					});
				}
			});
		});

		displayAllNotes();
		//Display All Note Of an User
		function displayAllNotes(){
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: { action: 'display_notes'},
				success:function(response){
					$("#showNote").html(response);
					$("table").dataTable({
						order: [0,'desc'],
						//ordre decroissant
					});
				}
			});
		}

		//Check Notification
		checkNotification();
		function checkNotification(){
			$.ajax({
				url:'assets/php/process.php',
				method :'post',
				data :{ action : 'checkNotification'},
				success:function(response){
					$("#checkNotification").html(response);
				}
			});
		}
		
		//checking user is logged in or not
		$.ajax({
			url : 'assets/php/action.php',
			method: 'post',
			data : {action : 'checkUser'},
			success:function(response){
				if (response === 'Bye'){
					window.location = 'index.php';
				}
			}
		});
	});
</script>
</body>
</html>
