<?php

use Core\Config;
use Core\Database\MysqlDatabase;

class App{

	public $title="Peva Appli";

	private $db_instance;
	
	private static $_instance;

	public static function getInstance(){
		if(is_null(self::$_instance)){ //si l'instance est nulle
			self::$_instance=new App(); // on l'a crée
		}
		return self::$_instance; // puis on la retourne
	}

	public static function load(){
		session_start();
		
		require ROOT.'/app/Autoloader.php';
		App\Autoloader::register();
		
		require ROOT.'/core/Autoloader.php';
		Core\Autoloader::register();
	}

	public function getTable($name){
		$class_name='\\App\\Table\\'.ucfirst($name).'Table';
		return new $class_name($this->getDb());
	}

	public function getDb(){
		$config = Config::getInstance(ROOT.'/config/config.php');

		if (is_null($this->db_instance)) {
			$this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
		}
		return $this->db_instance;
	}

	public function forbidden(){
		header('HTTP/1.0 403 Forbidden');
		die('Accès interdit');
	}

	public function notFound(){
		header('HTTP/1.0 404 Not Found');
		die('Page introuvable');
	}

}