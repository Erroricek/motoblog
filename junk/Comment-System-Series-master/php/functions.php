
<?php

	//session_start();
	//$_SESSION['user'] = 'Admin';

	function get_total() {
		//include "Comment-System-Series-master/js/global.js";
		//require 'connect.php';
		DB::query("SELECT * FROM `parents` ORDER BY `date` DESC");
		//$result = mysqli_query($connect, "SELECT * FROM `parents` ORDER BY `date` DESC");
		$row_cnt = DB::query("SELECT COUNT(*) AS num_rows FROM parents");
		
		
		//mysqli_num_rows($result);

		
		echo '<h1>All Comments ('. (int)$row_cnt[0]["num_rows"] .')</h1>';
	}

	function get_comments() {
		
		//include "Comment-System-Series-master/js/global.js";
		//require 'connect.php';
		$result_parents =  DB::query("SELECT * FROM `parents` ORDER BY `date` DESC");
		//mysqli_query($connect, "SELECT * FROM `parents` ORDER BY `date` DESC");
		$row_cnt = DB::query("SELECT COUNT(*) AS num_rows FROM `parents`");
		//mysqli_num_rows($result);

		foreach($result_parents as $parent) {
			$date = new dateTime($parent['date']);
			$date = date_format($date, 'M j, Y | H:i:s');
			$user = $parent['user'];
			$userName = DB::query("Select firstName, lastName FROM users WHERE id=" . $parent['user']);
			$comment = $parent['text'];
			$par_code = $parent['code'];


			echo '<div  id="'.$par_code.'">'
					.'<p >Uživatel: '.$userName[0]["firstName"].$userName[0]["lastName"].'</p>&nbsp'
					.'<p >'.$date.'</p>'
					.'<p >'.$comment.'</p>'
					.'<a  id="reply" name="'.$par_code.'">Reply</a>'
					.'<br>'
					.'<br>';
				$chi_result = DB::query("SELECT * FROM `children` WHERE `par_code`='$par_code' ORDER BY `date` DESC");
				//mysqli_query($connect, "SELECT * FROM `children` WHERE `par_code`='$par_code' ORDER BY `date` DESC");
				$chi_cnt = DB::query("SELECT COUNT(*) AS num_rows FROM children");

				//mysqli_num_rows($chi_result);

				if((int)$chi_cnt[0]["num_rows"] == 0){
				} else {
					echo '<a class="link-reply" id="children" name="'.$par_code.'"><span id="tog_text">replies</span> ('.$chi_cnt.')</br>'
						.'<div class="child-comments" id="C-'.$par_code.'">';

					foreach($chi_result as $com) {
						$chi_date = new dateTime($com['date']);
						$chi_date = date_format($chi_date, 'M j, Y | H:i:s');
						$chi_user = $com['user'];
						$chi_com = $com['text'];
						$chi_par = $com['par_code'];

						echo '<div class="child" id="'.$par_code.'-C">'
								.'<p class="user">'.$chi_user.'</p>&nbsp;'
								.'<p class="time">'.$chi_date.'</p>'
								.'<p class="comment-text">'.$chi_com.'</p>'
							.'</div>';
					}
					echo '</div>';
				}
				echo '</div>';
		}
	}

	function generateRandomString($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characterLength = strlen($characters);
		$randomString = '';

		for($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $characterLength - 1)];
		}
		return $randomString;
	}

?>