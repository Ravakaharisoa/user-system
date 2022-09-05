<?php
	require_once 'session.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require 'vendor/autoload.php';
	$mail = new PHPMailer(true);

	//Handle Add New Ajax Request
	if (isset($_POST['action']) && $_POST['action'] == 'add_note'){
		$title = $cuser->test_input($_POST['title']);
		$note = $cuser->test_input($_POST['note']);

		$cuser->add_new_note($cid,$title,$note);
		$cuser->notification($cid,'admin','Note added');
	}

	//Handle Display All Note Of An User
	if (isset($_POST['action']) && $_POST['action'] == 'display_notes'){
		$output = '';

		$notes = $cuser->get_notes($cid);

		if ($notes) {
			$output .= '<table class="table table-striped text-center">
							<thead>
								<tr>
									<th>#</th>
									<th>Title</th>
									<th>Note</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>';
			foreach ($notes as $row) {
				$output .= '<tr>
								<td>'.$row['id'].'</td>
								<td>'.$row['title'].'</td>
								<td>'.substr($row['note'],0,75).'.....</td>
								<td>
									<a href="#" id="'.$row['id'].'" title="View Details" class=" text-success infoBtn"><i class="fa fa-info-circle fa-lg"></i></a>
									<a href="#" id="'.$row['id'].'" title="Edit Note" class="text-primary editBtn ml-1"><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#editNoteModal"></i></a>
									<a href="#" id="'.$row['id'].'" title="Delete Note" class="text-danger deleteBtn ml-1"><i class="fa fa-trash-alt fa-lg"></i></a>
								</td>
							</tr>';
					}
				$output .= '</tbody></table>';
				echo $output;
		}else{
			echo '<h5 class="text-center text-secondary"> :( You have not written any note yet! Write your first not now!</h5>';
		}
	}

	//Handle Edit Note Of An User Ajax Request
	if (isset($_POST['edit_id'])) {
		$id = $_POST['edit_id'];

		$row = $cuser->edit_note($id);
		echo json_encode($row);
	}

	//Handle Update Note Of An User Ajax Request 
	if (isset($_POST['action']) && $_POST['action'] == 'update_note'){
		$id = $cuser->test_input($_POST['id']);
		$title = $cuser->test_input($_POST['title']);
		$note = $cuser->test_input($_POST['note']);

		$cuser->update_note($id,$title,$note);
		$cuser->notification($cid,'admin','Note Updated');
	}

	//Handle Delete Note Of An User Ajax Request 
	if (isset($_POST['del_id'])){
		$id = $_POST['del_id'];

		$cuser->delete_note($id);
		$cuser->notification($cid,'admin','Note Deleted');
	}

	//Handle Display Note Of An User Ajax Request
	if (isset($_POST['info_id'])){
		$id = $_POST['info_id'];

		$row = $cuser->edit_note($id);
		echo json_encode($row);
	}

	//Handle Profile Update  Ajax Request
	if (isset($_FILES['image'])) {
		$name = $cuser->test_input($_POST['name']);
		$gender = $cuser->test_input($_POST['gender']);
		$dob = $cuser->test_input($_POST['dob']);
		$phone = $cuser->test_input($_POST['phone']);

		$oldImage = $_POST['oldimage'];
		$folder = 'uploads/';

		if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")){
			$newImage = $folder.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $newImage);

			if ($oldImage != null) {
				unlink($oldImage);
			}
		}
		else{
			$newImage = $oldImage;
		}
		$cuser->update_profile($name,$gender,$dob,$phone,$newImage,$cid);
		$cuser->notification($cid,'admin','Profile Updated');
	}

	//Handle Change Password Ajax Request
	if (isset($_POST['action']) && $_POST['action'] =='change_pass'){
		$currentPass = $_POST['curpass'];
		$newPass = $_POST['newpass'];
		$cnewPass = $_POST['cnewpass'];

		$hnewPass = password_hash($newPass,PASSWORD_DEFAULT);

		if ($newPass != $cnewpass) {
			echo $cuser->showMessage('danger','Password did not matched');
		}else{
			if (password_verify($currentPass,$cpass)) {
				$cuser->change_password($hnewPass,$cid);
				echo $cuser->showMessage('success','Password Changed Successfully!');
				$cuser->notification($cid,'admin','Password Changed');
			}
			else{
				echo $cuser->showMessage('danger','Current Password is Wrong!');
			}
		}
	}

	//Handle Verify E-Mail Ajax Request
	if (isset($_POST['action']) && $_POST['action'] == 'verify_email') {
		try{
				$mail->SMTPDebug = SMTP::DEBUG_SERVER;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = Database::Username;
				$mail->Password = Database::Password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
				$mail->Port = 465;

				$mail->setFrom(Database::Username,'Admin Panel');
				$mail->addAddress($cemail);

				$mail->isHTML(true);
				$mail->Subject = 'E-Mail Verification';
				$mail->Body = '<h3>Click the below link to to verify your E-Mail.<br><a href="http://localhost/user-system/verify-email.php?email='.$cemail.'">http://localhost/user-system/verify-email.php?email='.$cemail.'</a><br>Regards<br>Admin Panel</h3>';

				$mail->send();
				echo $cuser->showMessage('success','Verification link sent to your E-Mail.Please check youe mail!');
			}
			catch(Exception $e){
				echo $cuser->showMessage('danger','Something went wrong please try again late!');
			}
		}

	//Handle Send Feedback to Admin Ajax Request
	if (isset($_POST['action']) && $_POST['action'] == 'feedback'){
		$subject = $cuser->test_input($_POST['subject']);
		$feedback = $cuser->test_input($_POST['feedback']);
	
		$cuser->send_feedback($subject,$feedback,$cid);
		$cuser->notification($cid,'admin','Feedback written');
	}	
	
	// Handle Fetch Notification
	if (isset($_POST['action']) && $_POST['action'] == 'fetchNotification'){
		$notification = $cuser->fetchNotification($cid);
		$output = '';

		if ($notification){
			foreach ($notification as $row) {
				$output .= '<div class="alert alert-danger" role="alert">
								<button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="alert-headering">New Notification</h4>
								<p class="mb-0 lead">'.$row['message'].'</p>
								<hr class="my-2">
								<p class="mb-0 float-left">Reply of feedback from Admin</p>
								<p class="mb-0 float-right">'.$cuser->timeInAgo($row['created_at']).'</p>
								<div class="clearfix"></div>
							</div>';
			}
			echo $output;
		}
		else{
			echo '<h3 class="text-center text-secondary mt-5">No any new notification</h3>';
		}
	}

	//Check Notification
	if (isset($_POST['action']) && $_POST['action'] == 'checkNotification') {
		if ($cuser->fetchNotification($cid)){
			echo '<i class="fas fa-circle fa-sm text-danger"></i>';
		}
		else{
			echo '';
		}
	}

	//Remove Notification
	if (isset($_POST['notification_id'])) {
		$id= $_POST['notification_id'];
		$cuser->removeNotification($id);
	}
?>