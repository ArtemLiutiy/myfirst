<?php 
  header( "Content-Type: text/html;charset=utf-8");

  $sxml = simplexml_load_file("catalog.xml"); 

  //название 2 й книги
  echo $sxml->book[1]->title;

  //меняем название книги
  $sxml->book[1]->title = "XML и ie11";

  //записываем то что поменяли
  $xml = $sxml->asXML();
  file_put_contents("catalog.xml",$xml);

  $str = $sxml->book[1]->title->asXML(); //отобразиться в title
  $str = $sxml->book[1]->asXML(); //отобразиться в title
  echo $str;
  
?>
<html>

<head>
  <title>Каталог</title>
</head>

<body>
  <h1>Каталог книг</h1>
  <table border="1" width="100%">
    <tr>
      <th>Автор</th>
      <th>Название</th>
      <th>Год издания</th>
      <th>Цена, руб</th>
    </tr>
    <?php 
      //Парсинг 
    ?>
  </table>
</body>

</html>