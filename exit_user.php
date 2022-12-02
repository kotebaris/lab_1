<?php
	setcookie('user', $user['LOGIN'], time() - (60*60), "/");

	header('Location: /')
?>