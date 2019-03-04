<?php
namespace Core\Auth;

use Core\Database\Database;

class DBAuth{
	private $db;
	public function __construct(Database $db){
		$this->db=$db;
	}

	public function getUserId(){
		if ($this->logged()){
			return $_SESSION['auth'];
		}
		return false;
	}
	/**
	* if a user is found, return true if passwords match
	*@param $username
	*@param $password
	*@return boolean
	*/
	public function login($username, $password){
		$user = $this->db->prepare('SELECT * FROM user WHERE user_login = ?',[$username], null, true);
		if($user){
			if($user->user_pass === $password){
				$_SESSION['user_privilege'] = $user->user_privilege;
				$_SESSION['user_nom'] = $user->user_name;
				$_SESSION['user_id'] = $user->user_id;
				return true;
			}
		}
		return false;
	}
	/**
	*Retourne true si l'utilisateur est loggé
	*@return boolean
	*/
	public function logged(){
		return isset($_SESSION['user_id']);
	}

	/**
	*Retourne true si l'utilisateur est loggé comme super admin
	*@return boolean
	*/
	public function loggedAsSuperAdmin(){
		if (isset($_SESSION['user_id'])&&$_SESSION['user_privilege']==1){
			return true;
		}
	}

	/**
	*Retourne true si l'utilisateur est loggé comme simple admin
	*@return boolean
	*/
	public function loggedAsUser(){
		if (isset($_SESSION['user_id'])&&$_SESSION['user_privilege']==2){
			return true;
		}
	}
}