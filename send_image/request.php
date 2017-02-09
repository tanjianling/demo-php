<?php

	file_put_contents("images/a.txt", var_export($_POST, 1));
	file_put_contents("images/a.jpg", base64_decode($_POST['image']));



