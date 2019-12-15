<?php
//01.12.2019
 function __autoload($className){
	 include "classes\\".$className.".class.php";
 }



//24.11.2019 вс 13.56
/*
abstract class UserAbstract{
	abstract public function showinfo();
}

interface ISuperUser{
	function getInfo();
}

class User extends UserAbstract{
	public $name;
	public $login;
	public $password;
	public static $countUser = 0;
	
	public function __construct($name, $login, $password){
		$this->name = $name;
		$this->login = $login;
		$this->password = $password;
		++ self :: $countUser;
	} 
	
	public function __destruct(){
	
		echo "Пользователь {$this->login} удален!!! <br>";
	}
	
	public function showInfo(){
		echo "Имя ".$this->name."<br>";
		echo "Логин ".$this->login."<br>";
		echo "Пароль ".$this->password."<br>";
	}
}

class SuperUser extends User implements ISuperUser {
	public $role;
	public static $countSuperUser = 0;
	
	public function __construct($name, $login,$password, $role){
		parent::__construct($name, $login, $password);              //пробрасываем входные прараметры в родительский конструктор
		$this->role = $role;
		 ++ self :: $countSuperUser;
	}
	
	public function showInfo(){
		parent::showInfo();
		echo "роль ".$this->role."<br>";
	}
	
	public function getInfo(){
		return ['name' => $this->name,'login' => $this->login, 'password' => $this->password,'role' => $this->role];
		 
	}
}
*/

$User1 = new User('Вася','vasa','psvasa');
#$User1->name = 'Вася';
#$User1->login = 'vasa';
#$User1->password = 'psvasa';

$User2 = new User('Петя','petya','pspetya');
#$User2->name = 'Петя';
#$User2->login = 'petya';
#$User2->password = 'pspetya';

$User3 = new User('Коля','kolya','pskolya');
#$User3->name = 'Коля';
#$User3->login = 'kolya';
#$User3->password = 'pskolya';

$user = new SuperUser('Вова','vova','psvova','user');

$User1->showInfo();
echo'<br>';
$User2->showInfo();
echo'<br>';
$User3->showInfo();
echo '<br>';
#$user->showInfo();
echo '<br>';
#print_r($user->getInfo());
echo '<br>';
echo "Всего обычных пользователй: ".User :: $countUser;
echo '<br>';
echo "Всего суперпользователей:".SuperUser :: $countSuperUser;
echo '<br>';