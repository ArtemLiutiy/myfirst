<?php
//Уровень 3 начало 2го урока
class A{
	static function WhoAmI(){
		echo __CLASS__;
	}
	
	static function identity(){
		self::whoAmI();
		static::whoAmI();         //Ключевое слово использоуемое для ПСС
	}
}	
	class B extends A{
		static function WhoAmI(){
			echo __CLASS__;
		}
		
	}
	
	B::WhoAmI();
	echo '<br>';
	B::identity();
	

