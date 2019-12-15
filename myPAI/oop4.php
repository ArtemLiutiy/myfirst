<?php
function __autoload($name){
	require "$name.class.php";
}
$obj = new MyClass('Вася');