<?php
session_start();
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
	
	unlink($dir . "$filelist[$id]");
	header('Location: http://university.netology.ru/u/avolvach/me/dz8/list.php');
?>
