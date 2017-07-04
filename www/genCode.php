<?php
	session_start();
	header("Content-type: image/png");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	$h = 20;
	$l = 110;
	$im = @imagecreate($l, $h) or die("Impossible d'initialiser la bibliothèque GD");
	$background_color = imagecolorallocate($im, 0, 0, 0);
	$text_color = imagecolorallocate($im, 233, 14, 91);
	$font = './VLADIMIR.TTF';
	imagettftext($im, 17, 0, 20, 17,$text_color,$font,$_SESSION['code']);
	for($i=0;$i<2;$i++) {
		imageline($im,0,rand(0,$h),$l,rand(0,$h),$text_color);
	}
	for($i=0;$i<2;$i++) {
		imageline($im,rand(0,$l),0,rand(0,$l),$h,$text_color);
	}
	imagepng($im);
	imagedestroy($im);
?>
