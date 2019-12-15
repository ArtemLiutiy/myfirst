<?php 
  header( "Content-Type: text/html;charset=utf-8"); 
  //Здесь уже ООП
  // Создание объекта, экземпляра класса DomDocument
	$dom = new DomDocument();

	//Если создаем с нуля:
	#$dom = new DomDocument("1.0", "utf-8");
	// создаем корневой элемент
	#$rss = $dom->createElement("rss");
	//Привязываем корень к дому:
	#$dom = appendChild("rss");
	
	
  // Загрузка документа (зачитывается документ в память и разворачивается дерево dom)
	$dom->load("catalog.xml");	

	// Получение коневого элемента
	$root = $dom->documentElement;	

	// Получение типа узла
	echo $root->nodeType;
	
	// Получение текстового содержимого узла
	//echo $root->textContent;
	
	//Получение коллекции дочерних узлов
	$books = $root->childNodes;
	//var_dump($books);
	
	//Перебираем обьект форычем и здеся Жистокая Засада ожидает - пустая строка (пробел) в catalog.xml дает тоже текстовый узел
	/*
	foreach($books as $book){
		echo $book->textContent.'<br>';
		echo '<hr>';
	}
	*/
  
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
	  
	foreach($books as $book){
		if($book->nodeType == 1){
			echo "<tr>";
			foreach($book->childNodes as $item){
				if($item->nodeType == 1){
					
					echo "<td>".$item->textContent.'</td>';
				}
			}
			echo '</tr>';
		}
	}
	  
	  
    ?>
  </table>
</body>

</html>