<?php

require('./vendor/Alexander-Lugovskoy/MyENV/src/MyENV.php');
?>
<h1>Хочу в Зазекс ;D</h1>
<?php
	$env = MyENV::get('VAR_5');  // в качестве параметра используется любой ключ из env файлов. Возвращает значение ключа.
	echo $env;
?>
