<?php
	session_start();
	$login = $_COOKIE['user'];
	$old_pass = htmlspecialchars($_POST['old_pass'] ?? '');
	$pass = htmlspecialchars($_POST['pass'] ?? '');
	$pass2 = htmlspecialchars($_POST['pass2'] ?? '');
	$mysql = mysqli_connect('localhost', 'root', '', 'users');
	$q = "SELECT * FROM `user` WHERE `LOGIN` = '$login'";
	$result = mysqli_query($mysql, $q);
	$user = $result->fetch_assoc();
	$hash = crypt($old_pass, $user['SALT']);
	if($user['HASH'] != $hash){
		$_SESSION['message'] = "Старый пароль введён неверно!";
		header('Location: /change_pass_form.php');
	}
	elseif (mb_strlen($pass) < 8 || mb_strlen($pass) > 20) {
		$_SESSION['message'] = "Недопустимая длина пароля!";
		header('Location: /form_change_pass.php');
	}
	elseif($pass != $pass2)
	{
		$_SESSION['message'] = "Пароли не совпадают!";
		header('Location: /form_change_pass.php');
	}
	elseif($pass == $old_pass){
		$_SESSION['message'] = "Новый и старый пароли не должны совпадать!";
		header('Location: /form_change_pass.php');
	}
	else{
		$salt = substr(hash("sha512", time()), 10, 10);
		$pass =  crypt($pass, $salt);
		$q = "UPDATE `user` SET `HASH`='$pass',`SALT`='$salt' WHERE `LOGIN` = '$login'";
		mysqli_query($mysql, $q);
		mysqli_close($mysql);
		$_SESSION['message'] = 'Пароль успешно обновлён!';
		header('Location: /');
	}