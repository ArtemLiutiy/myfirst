<?php
$t = $news->clearStr($_POST["title"]);
$d = $news->clearStr($_POST["description"]);
$s = $news->clearStr($_POST["source"]);
$c = $news->clearInt($_POST["category"]);

if(empty($t) or empty($d)){                              //текстовые поля из формы всегда проверять так (поскольку даже если они пустые они всегда есть (set))
	$errMsg = "Заполните все поля формы";
}else{
	if(!$news->saveNews($t, $c, $d, $s)){
		$errMsg = "Произошла ошибка при добавлении новости";
	}else{
		header("location: news.php");
		exit;
	}
}