
<?php
    // Для того чтобы выводить все ошибки и предупреждения
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    $errors = [];
    if (!empty($_POST)) {
        $fileData = file_get_contents(__DIR__ . '/users.json');
        $users = json_decode($fileData, true);
        foreach ($users as $user) {
            if ($_POST['login'] == $user['login'] && $_POST['password'] == $user['password'])  {
                $_SESSION['user'] = $user;
                if ($user['is_admin'] == 1) {
               		header('Location: admin.php');
                }
                else{
                	header('Location: list.php');
                }
                die;
            }
        }
        $errors[] = 'Неверный логин или пароль';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Окно создания теста</title>
</head>
<body>
<form  method="post">
<div>
<fieldset>
    <legend><h3>Авторизация:</h3></legend>
	<label for="login">Логин</label>
		<input id="login" name="login" type="text" placeholder="user">
		<br />
	<label for="password">Пароль</label>
		<input id="password" name="password" type="text" placeholder="user">
<input type="submit" value="Войти">
</div>
</form>
<form action="list.php"  method="post">
<div>
<fieldset>
    <legend><h3>Войти как гость:</h3></legend>
	<label for="name">Имя</label>
		<input id="name" name="name" type="text" placeholder="user">
		<br />
<input type="submit" value="Войти">
</div>
</form>
</body>
</html>