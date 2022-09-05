<?php
	require_once 'assets/php/admin-header.php';	
?>

	<div class="row">
		<div class="col-md-12">
			<div class="card my-2 border-secondary">
				<div class="card-header bg-secondary text-white">
					<h4 class="m-0">Total Notes By All Users</h4>
				</div>
				<div class="card-header-body">
					<div class="table-responsive mt-3" id="showAllnotes">
						<p class="text-center align-self-center lead">Please Wait...</p>
					</div>
				</div>
			</div>
		</div>
	</div>	

<!--Footer-->
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			//fetch All Users Ajax Request
			fetchAllNotes();
			function fetchAllNotes(){
				$.ajax({
					url: 'assets/php/admin-action.php',
					method:'post',
					data : { action :'fetchAllNotes'},
					success:function(response){;
						$("#showAllnotes").html(response);
						$("table").DataTable({
							order: [0,'desc'],
						});
					}
				});
			}

			//Delete A Note Ajax Request
			$("body").on("click",".deleteNoteIcon", function(e){
				e.preventDefault();

				note_id = $(this).attr('id');

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
							url: 'assets/php/admin-action.php',
							method:'post',
							data : {note_id : note_id},
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

								fetchAllNotes();
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
