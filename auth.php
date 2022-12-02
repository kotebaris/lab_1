<?php
	session_start();
	$mysql = mysqli_connect('localhost', 'root', '', 'users');
	$login = htmlspecialchars($_POST['login'] ?? '');
	$pass = htmlspecialchars($_POST['pass'] ?? '');

	$q = "SELECT * FROM `user` WHERE `LOGIN` = '$login'";

	$result = mysqli_query($mysql, $q);
	$user = $result->fetch_assoc();
	if(empty($user)) {
		$_SESSION['message'] = 'Такого пользователя нет в системе!';
		header('Location: /sign-in.php');
	}
	else {
		$salt = $user['SALT'];
		$pass =  crypt($pass, $salt);
	}

	if($pass == $user['HASH']){
		setcookie('user', $user['LOGIN'], time() + (60*60), "/");
		header('Location: /.');
		}
	else {
		$_SESSION['message'] = 'Неверный пароль!';
		header('Location: /sign-in.php');
	}
?>