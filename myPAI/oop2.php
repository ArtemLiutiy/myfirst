<?php

// Создание супер-класса
class SimpleHouse{
	public $model = "";
	public $square = 0;
	public $floors = 0;
	public $color = "none";
	
	// Конструктор класса
	function __construct($model, $square = 0, $floors = 1){
		$this->model = $model;
		$this->square = $square;
		$this->floors = $floors;
	}
	
	function startProject(){
		echo "Start. Model: {$this->model}<br>";
	}
	
	function stopProject(){
		echo "Stop. Model: {$this->model}<br>";
	}
	
	function build(){
		echo "Build. House: {$this->square}x{$this->floors}<br>";
	}
	
	function paint(){
		echo "Paint. Color: {$this->color}<br>";
	}
	
}

// Создание простого дома
$simple = new SimpleHouse("A-100-123", 120, 2);
$simple->color = "red";
$simple->startProject();
$simple->build();
$simple->paint();
$simple->stopProject();

//Наследование супер-класс - это базовый класс

// Создание класса-наследника
class SuperHouse extends SimpleHouse{
	
	public $fireplace = true;            //камин
	public $patio = true;
	
	function fire(){                     //сжигаем ками
		if ($this->fireplace)
		echo "Fueled fireplace\n";
	}
}	

//создаю класс наслендик
$super = new SuperHouse("A-100-125", 320, 3);
$super->color = "green";
$super->startProject();
$super->build();
$super->paint();
$super->fire();
$super->stopProject();

// Создание класса-наследника
class FabricHouse extends SimpleHouse{
	// Перегрузка метода
	function build(){
		echo "Build. Fabric: {$this->square}x{$this->floors}\n";
	}
}

$fabric = new FabricHouse("B-200-007", 3250, 5);
$fabric->color = "white";
$fabric->startProject();
$fabric->build();
$fabric->paint();
$fabric->stopProject();

// Создание класса-наследника
	
class SuperFabricHouse extends FabricHouse{
	// Перегрузка метода
	function build(){
		echo "==============================================<br>";
		// Вызов родительского метода
	    parent::build();
		echo '<br>';
		echo "==============================================<br>";
	}
	
}
echo '<hr>';
$super_fabric = new SuperFabricHouse("C-201-034", 5150, 7);
$super_fabric->color = "black";
$super_fabric->startProject();
$super_fabric->build();
$super_fabric->paint();
$super_fabric->stopProject();
$super_fabric->stopProject();

# в PHP не поодерживается множественное наследование - нельзя 1 класс отнаследовать от нескольких классов!!

# Обработка исключений
#2:15
# catch(Exception $e){ -уточнение типа, это значит что в catch должен прийти только обьеткт и только класса Exception 
