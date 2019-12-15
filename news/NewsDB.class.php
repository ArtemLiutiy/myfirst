<?php

require_once "INewsDB.class.php";

class NewsDB implements INewsDB {
	
	const DB_NAME = "news.db";

	//для хранения имени RSS-файла
	const RSS_NAME = "rss.xml";    
	
	//для хранения заголовка новостной ленты
	const RSS_TITLE = "Последние новости";
	
	//для хранения ссылки на саму новостную ленту
	const RSS_LINK = "http://mysite.local/news/news.php";

	private $_db = null;
	
	// на случай если надо отнаследовать приватный метод пишем геттер
	public function __get($name){
		if($name == "db")
		require_once "INewsDB.class.php";
			return $this->_db;
		throw new Exception("Unknown property!");
	}
	
	function __construct(){
		
		$this->_db = new SQLite3(self::DB_NAME);
		
		if( (file_exists(self::DB_NAME)) and (filesize(self::DB_NAME) == 0) ){
			
			try{
				$sql = "CREATE TABLE msgs(
					id INTEGER PRIMARY KEY AUTOINCREMENT,
					title TEXT,
					category INTEGER,
					description TEXT,
					source TEXT,
					datetime INTEGER)";
				
				if(!$this->_db->exec($sql)){ // or die($this->_db->lastErrorMsg()); //это было до введения try catch
					throw new Exception($this->_db->lastErrorMsg());
				}
					
				$sql = "CREATE TABLE category(
					id INTEGER,
					name TEXT)";
					
				if(!$this->_db->exec($sql)){ 
					throw new Exception($this->_db->lastErrorMsg());
				}
				
				$sql = "INSERT INTO category(id, name)
					SELECT 1 as id, 'Политика' as name
					UNION SELECT 2 as id, 'Культура' as name
					UNION SELECT 3 as id, 'Спорт' as name ";
					
				if(!$this->_db->exec($sql)){ 
					throw new Exception($this->_db->lastErrorMsg());
				}	
			}catch(Exception $e){
				$e->getMessage();  //это пишем в лог или файл или куда еще это для разработчика
				echo "На данный момент сайт не работает - зайдите завтра";//это для человека пользователя
			}
		}
	}
	
	function __destruct(){
		unset ($this->_db);
	}
	
	function saveNews($title, $category, $description, $source){
		
		$dt = time();
		$sql = "INSERT INTO msgs(title,category,description,source,datetime) VALUES ('$title',$category,'$description','$source',$dt)";
		#return $this->_db->exec($sql);
		$res = $this->_db->exec($sql);
		if(!$res) return false;
		
		$this->createRss();
		
		return true;
	}
	
	private function db2Arr($data){
		#var_dump($data);
		$arr = [];
		while($row = $data->fetchArray(SQLITE3_ASSOC)){
			$arr[] = $row;
		}
		
		return $arr;
	}
	
	function getNews(){
		$sql = "SELECT 
			msgs.id as id,
			title,
			category.name as category,
			description,
			source,
			datetime
			FROM msgs, category
			WHERE category.id = msgs.category
			ORDER BY msgs.id
			DESC";
		
		$res = $this->_db->query($sql);                                //Запрос к БД
		
		//если результат не случился
		if(!$res) return false;
		
		//иначе восвращаем результат метода db2Arr
		return $this->db2Arr($res);
	}
	
	function deleteNews($id){}
	
	//Функции полезняшки (хелперы)
	function clearStr($data){
		$data = strip_tags($data);
		return $this->_db->escapeString($data);      //озвращает правильно экранированную строку
	}
	
	function clearInt($data){
		return abs((int)$data);
	}


	private function createRss(){
	
		// Это все фигачим чтобы получилось по образцу rss.txt

		// Создание объекта, экземпляра класса DomDocument
		$dom = new DomDocument("1.0","utf-8");
		
		//для формирования отступов в документе(красоты ради для человека, для машины это необязательна)
		$dom->formatOutput = true; 
		$dom->preserveWhiteSpace = false;
		
		// Создание новых элементов (создание корневого элемента)
		$rss = $dom->createElement("rss");
		// Добавление узлов к узлам:вкладываем корневой элемент rss в сам документ
		$dom->appendChild($rss);

		//добавляем в rss атрибут version = "2.0"
		$version = $dom->createAttribute("version");
		$version->value = '2.0';
		$rss->appendChild($version);

		//создаем элементы
		$chennel = $dom->createElement("chennel");
		$title = $dom->createElement("title", self :: RSS_TITLE);
		$link = $dom->createElement("link", self :: RSS_LINK);
		
		//привязываем элементы
		$chennel->appendChild($title);
		$chennel->appendChild($link);
		$rss->appendChild($chennel);

		$lenta = $this->getNews();
		if(!$lenta) return false;

		foreach($lenta as $news){

		// Создаем элементы	
			$item =  $dom->createElement("item");
			$title =  $dom->createElement("title", $news['title']);
			$category =  $dom->createElement("category", $news['category']);

			$desc =  $dom->createElement("description");
			$cdata =  $dom->createCDATASection($news['description']);
			$desc->appendChild($cdata);

			//link - это ссылка на конкретную новость (делаем фийковую)
			$link =  $dom->createElement("link", "#");

			$dt = date("r", $news["datetime"]);
			$pubDate =  $dom->createElement("pubDate", $dt);
		
		//Вставляем элементы	

			$item->appendChild($title);
			$item->appendChild($link);
			$item->appendChild($desc);
			$item->appendChild($pubDate);
			$item->appendChild($category);

			$chennel->appendChild($item);
		}
		
		//Сохраняем документ
		
		$dom->save(self::RSS_NAME);
		

	}


	
}

//проверка что файл news.db создается в http://mysite.local/news - в продакшене отключаем
#$news = new NewsDB();