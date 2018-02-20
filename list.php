<?php
session_start();
$dir = getcwd() . '/tests/';
$filelist = scandir($dir, 1);
function GetList($filelist)
{   
    if (!$filelist) 
        {
            echo "<h3>Тесты не найдены!</h3>";
        } else {
            echo "<h3>Список тестов:</h3><ol>";
            for ($i = 0; $i < (count($filelist)-2); $i++)
                {   
                    echo '<li>' . $filelist[$i] . '</li>';
                 };
            echo "</ol>"; 
        }
}
function GetTest($filelist)
{   
    for ($i = 0; $i < (count($filelist)-2); $i++)
        {   
            $id = $i+1;
            echo "<option value=\"$id\">" . $filelist[$i] . "</option>";
        };
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
</head>
<body>
<span>
<?php GetList($filelist)?>
<form action="test.php" method="get">
    <fieldset>
        <legend>Выберите тест для загрузки:</legend>
        <select name="test_id">
        <?php GetTest($filelist) ?>
        </select>
       <input type="submit" value="Отправить">
    </fieldset>
</form>
<h3>Добро пожаловать,  <?= $_SESSION['user']['username']; ?></h3>
    <ul>
        <li><a href="logout.php" >Выйти</a></li>
        <li><? if ($_SESSION['user']['is_admin'] == 1) {?>
        	<a href="admin.php" >Добавить тест.</a>
        <?	
        }
        ?></li>
    </ul>
</span>
</body>
</html>