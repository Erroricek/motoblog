<?php
	// new comment
	if(isset($_POST['new_comment'])) {
		$new_com_name = $_SESSION['id'];
		$new_com_text = $_POST['comment'];
		$new_com_date = date('Y-m-d H:i:s');
		$new_com_code = generateRandomString();

		if(isset($new_com_text)) {
			DB::query("INSERT INTO `parents` (`user`, `text`, `date`, `code`) VALUES ('$new_com_name', '$new_com_text', '$new_com_date', '$new_com_code')");
			//mysqli_query($connect, "INSERT INTO `parents` (`user`, `text`, `date`, `code`) VALUES ('$new_com_name', '$new_com_text', '$new_com_date', '$new_com_code')");
		}
		header("Location: ");
	}
	// new reply
	if(isset($_POST['new_reply'])) {
		$new_reply_name = $_SESSION['id'];
		$new_reply_text = $_POST['new-reply'];
		$new_reply_date = date('Y-m-d H:i:s');
		$new_reply_code = $_POST['code'];

		if(isset($new_reply_text)) {
			DB::query("INSERT INTO `children` (`user`, `text`, `date`, `par_code`) VALUES ('$new_reply_name', '$new_reply_text', '$new_reply_date', '$new_reply_code");
			//mysqli_query($connect, "INSERT INTO `children` (`user`, `text`, `date`, `par_code`) VALUES ('$new_reply_name', '$new_reply_text', '$new_reply_date', '$new_reply_code')") or die(mysqli_error());
		}
		header("Location: ");
	}
?>