<?php
require_once "NewsDB.class.php";

$news = new NewsDB();
$errMsg = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){                //приход данных из формы всегда проверять так
	require_once "save_news.inc.php";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Новостная лента</title>
	<meta charset="utf-8" />
</head>
<body>
  <h1>Последние новости</h1>
  <?php
	if($errMsg){
		echo "<h3>$errMsg</h3>";
	}
  ?>
  <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
    Заголовок новости:<br />
    <input type="text" name="title" /><br />
    Выберите категорию:<br />
    <select name="category">
      <option value="1">Политика</option>
      <option value="2">Культура</option>
      <option value="3">Спорт</option>
    </select>
    <br />
    Текст новости:<br />
    <textarea name="description" cols="50" rows="5"></textarea><br />
    Источник:<br />
    <input type="text" name="source" /><br />
    <br />
    <input type="submit" value="Добавить!" />
</form>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
  <tr>
    <td>id</td>
    <td>title</td>
    <td>category</td>
    <td>description</td>
  </tr>
    <?php
    	require_once "get_news.inc.php";
      $posts = $news->getNews();
      
      #echo '<pre>'; 
      #print_r($posts);
  if($posts){
    foreach($posts as $post){
    ?>
      <tr>
        <td><?=$post['id']; ?></td>
        <td><?=$post['title']; ?></td>
        <td><?=$post['category']; ?></td>
        <td><?=$post['description']; ?></td>
      </tr>
    <?
     }
  } 

  else echo "Новость не добавленна";
    ?>
</table>
</body>
</html>