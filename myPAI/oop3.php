<?php
// Создание абстрактного класса

abstract class HouseAbstract{
	public $model = "";
	public $square;
	public $floors;

	function __construct($model, $square = 0, $floors = 1){
		if(!$model)
			throw new Exception('Ошибка!Укажите модель!');
		$this->model = $model;
		$this->square = $square;
		$this->floors = $floors;
	}
	
	function startProject(){
		echo "Start. Model: {$this->model}\n";
	}
	
	function stopProject(){
		echo "Stop. Model: {$this->model}\n\n";
	}
	
	// Абстрактный метод
	abstract function build();
}


// Создание супер-класса

class SimpleHouse extends HouseAbstract{

	// Свойства абстрактного класса +
	public $color = "none";
	
	// Обязательная реализация абстрактного метода
	function build(){
		echo "Build. House: {$this->square}x{$this->floors}\n";
	}
	
	// Свой метод
	function paint(){
		echo "Paint. Color: {$this->color}\n";
	}

}

interface Db{
	function connect($x);
	function close();
}

class A implements Db, x , y , z{
	
}



