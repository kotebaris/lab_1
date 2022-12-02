<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Форма входа</title>
</head>
<body>
            <form action="registration.php" method="post" align="center">
            	<?php if (isset($_SESSION['message']))
				{
					$message = $_SESSION['message'];
					echo $message;
					unset($_SESSION['message']);
				}
            	 ?> <br>
	            <input type="text" name="name" placeholder="Введите имя"><br>
				<input type="text" name="login" placeholder="Введите логин"><br>
				<input type="password" name="pass" placeholder="Введите пароль"><br>
				<input type="password" name="pass2" placeholder="Подтвердите пароль"><br>
				<button type="submit">Зарегистрироваться</button><br>
				<a href="sign-in.php">Уже зарегистрированы?</a>
			</form>
</body>
</html>