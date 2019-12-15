<?php

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