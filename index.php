<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href="style.css">
</head>
<body>
	<?php
		if($_COOKIE['user'] == ''):
	?>
	<?php header("Location: /sign-in.php") ?>
	<?php else:?>
	<form align="center">
		<?php
			if (isset($_SESSION['message']))
			{
				$message = $_SESSION['message'];
				echo $message;
				unset($_SESSION['message']);
			} ?> <br>
			<p> Добро пожаловать, <?=$_COOKIE['user']?>!</p>
			<img src = "кот.jpg" align = "middle" height="400">
			<p> <a href="/exit_user.php">Чтобы выйти нажмите сюда</a></p>
			<p> <a href="form_change_pass.php">Сменить пароль</a></p>
			<?php endif;?>
	</form>
</body>
</html>
