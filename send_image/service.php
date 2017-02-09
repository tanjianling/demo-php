<?php
	//接收跨域
	header('Access-Control-Allow-Origin:*');

	//接收表单传递图片
	$fp=fopen($_FILES['uploads']['tmp_name'], 'r');
	$data = fread($fp, $_FILES["uploads"]["size"]); 
	
	//post方式发送图片
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://test/t/request.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, [
	    'filename' => 'demo.jpg',
	    'image'=>base64_encode($data)
	]);
	curl_exec($ch);
	if ($error = curl_error($ch)) {
	    die($error);
	}
	curl_close($ch);
