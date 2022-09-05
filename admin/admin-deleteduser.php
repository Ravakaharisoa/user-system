<?php
	require_once 'assets/php/admin-header.php';	
?>

<div class="row">
		<div class="col-md-12">
			<div class="card my-2 border-danger">
				<div class="card-header bg-danger text-white">
					<h4 class="m-0">Total Deleted Users</h4>
				</div>
				<div class="card-header-body">
					<div class="table-responsive mt-3" id="showAllDeletedUsers">
						<p class="text-center align-self-center lead">Please Wait...</p>
					</div>
				</div>
			</div>
		</div>
	</div>

<!---Footer--->
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			//fetch All Deleted Users Ajax Request
			fetchAllDeletedUsers();
			function fetchAllDeletedUsers(){
				$.ajax({
					url: 'assets/php/admin-action.php',
					method:'post',
					data : { action :'fetchAllDeletedUsers'},
					success:function(response){;
						$("#showAllDeletedUsers").html(response);
						$("table").DataTable({
							order: [0,'desc'],
						});
					}
				});
			}

			//Restore Deleted An User Ajax Request
			$("body").on("click",".restoreUserIcon", function(e){
				e.preventDefault();

				res_id = $(this).attr('id');

				swal("Are you sure want restore this user ?",{
					icon : "warning",
					buttons:{
						confirm: {
							text : 'Yes, restore it!',
							className : 'btn btn-success'
						},
						cancel: {
							visible: true,
							className: 'btn btn-danger'
						}
					}
				}).then((Restore) => {
					if (Restore) {
						$.ajax({
							url: 'assets/php/admin-action.php',
							method:'post',
							data : {res_id : res_id},
							success:function(response){
								swal({
									title: 'Restored!',
									text: 'User restored successfully!',
									type: 'success',
									buttons : {
										confirm: {
											className : 'btn btn-success'
										}
									}
								});

								fetchAllDeletedUsers();
							}
						});
					}
				});
			});

			//Check Notification
			checkNotification();
			function checkNotification(){
				$.ajax({
					url : 'assets/php/admin-action.php',
					method: 'post',
					data: {action : 'checkNotification'},
					success:function(response){
						$("#checkNotification").html(response);
					}
				});
			}
		});
	</script>
</body>
</html>
