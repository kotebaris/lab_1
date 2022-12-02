<?php
	session_start();
	$login = htmlspecialchars($_POST['login'] ?? '');
	$name = htmlspecialchars($_POST['name'] ?? '');
	$pass = htmlspecialchars($_POST['pass'] ?? '');
	$pass2 = htmlspecialchars($_POST['pass2'] ?? '');

	if (mb_strlen($pass) < 8 || mb_strlen($pass) > 20) {
		$_SESSION['message'] = "Недопустимая длина пароля!";
		header('Location: /sign-up.php');
	}
	elseif($pass != $pass2)
	{
		$_SESSION['message'] = "Пароли не совпадают!";
		header('Location: /sign-up.php');
	}
	else
	{
	$salt = substr(hash("sha512", time()), 10, 10);
	$pass =  crypt($pass, $salt);
	$mysql = mysqli_connect('localhost', 'root', '', 'users');
	$q = "UPDATE `user` SET `HASH`='$pass',`SALT`='$salt' WHERE `LOGIN` = '$login' AND `NAME` = '$name'";
	mysqli_query($mysql, $q);
	mysqli_close($mysql);
	setcookie('user', $_POST['login'], time() + (60*60), "/");
	$_SESSION['message'] = 'Пароль успешно обновлён!';
	header('Location: /');
}