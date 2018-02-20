<?php
	header('Content-type: image/png');
	session_start();
	$GETValue = $_SESSION['user']['username'];

	renderCaptcha($GETValue);
	function renderCaptcha($code) {
		$im = imagecreatetruecolor(800, 566);
		$backColor = imagecolorallocate($im, 255, 224, 221);
		$textColor = imagecolorallocate($im, 0, 0, 0);
		$font = __DIR__.'/AaarghBold.ttf';
		$imBox = imagecreatefrompng('sert.png');
		imagefill($im, 0, 0, $backColor);
		imagecopy($im, $imBox, 0, 0, 0, 0, 800, 566);
		imagettftext($im, 55, 0, 300, 290, $textColor, $font, $code);
		imagepng($im);
		imagedestroy($im);
	}