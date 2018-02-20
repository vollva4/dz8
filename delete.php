<?php
session_start();
if ($_SESSION['user']['is_admin'] == 0) {
    http_response_code(403);
            echo 'У вас нет прав!';
            exit(1);
}
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
<form action="del.php" method="get">
    <fieldset>
        <legend>Выберите тест для удаления:</legend>
        <select name="test_id">
        <?php GetTest($filelist) ?>
        </select>
       <input type="submit" value="Удалить.">
    </fieldset>
</form>
</span>
</body>
</html>