<?php
	$dir = getcwd() . '/tests/';
	$filelist = scandir($dir, 1);
	if (isset($_POST['test_id']))
	{	
		$id = htmlspecialchars(stripslashes($_POST['test_id']));
		
	} elseif (isset($_GET['test_id'])&&(is_numeric($_GET['test_id'])))
	{
		$id = htmlspecialchars(stripslashes($_GET['test_id']))-1;
	} 
	else 
	{
		die("Некорретные данные!");
	}
	
	$id = (intval($id));
	
	if ($id <= (count($filelist)-3))
	{
		$json = $dir . "$filelist[$id]";
		$test = json_decode(file_get_contents($json), true);
	if (isset($test['1']['textQwestion']))
	{
	if (isset($_POST['test_id']))
	{	
		if (isset($_POST['userAnswer']))
		{
			$userAnswer = $_POST['userAnswer'];
			if(count($userAnswer) === count($test))	
			{	
				$result = 0;
				foreach ($test as $key => $value)
				{	
					if ($value['correct'] == $userAnswer[$key])
					{
						$result++;
					}
				}
				
				echo "Ваш результат: $result правильных из " . count($userAnswer);
				if ($result ===count($userAnswer)) {
				$userName = $_POST['name'];
				header('Location: http://university.netology.ru/u/avolvach/me/dz7/cert.php?name='.$userName);
				}
			} else {
    			echo "Не все поля формы заполнены. Повторите ввод!";
    		}
    	} else {
    		echo "Введите ответы!";
    	}
	}
} else {
			http_response_code(404);
			echo 'Cтраница не найдена!';
			exit(1);
}
	} else {
		die("Файл не существует!<p><a href=\"list.php\">Выбрать другой тест</a></p>");
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Окно создания теста</title>
</head>
<body>
<form action="test.php" method="post">
<div>
<fieldset>
    <legend><h3>Тест <?php echo $filelist[$id]?></h3></legend>
	<input name="test_id" type="hidden" value="<?php echo $id ?>">
	<?php
	foreach ($test as $key => $value) 
	{	
		echo "<strong> $key. ". $value['textQwestion'] . "</strong>";
		foreach ($value['answer'] as $k => $val) 
		{
			echo  "<li><input type=\"radio\" name=\"userAnswer[" . $key . "]\" value=\"" . $k . "\" required>$val</li>";
		}
	}
	?>
	<label for="name">Ваше Фамилия и Имя</label>
		<input id="name" name="name" type="text" placeholder="Иванов Иван">
		<br />
<input type="submit" value="Отправить">
<p><a href="list.php">Выбрать другой тест</a></p>
</div>
</form>
</body>
</html>