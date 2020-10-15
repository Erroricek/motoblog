<?php require_once 'php/connect.php'; require_once 'php/functions.php'; ?>

<div class="page-container">
	<?php 
		get_total();
		require_once 'php/check_com.php';
	?>
	<form action="" method="post" class="main">
		<label>Napis sem nějakej tučnej komentář.</label>
		<textarea class="form-text" name="comment" id="comment"></textarea>
		<br />
		<input type="submit" class="form-submit" name="new_comment" value="post">
	</form>
	<?php get_comments(); ?>
</div>
