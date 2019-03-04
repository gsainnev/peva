<?php

use \Core\Auth\DBAuth;

define('ROOT', dirname(__DIR__));

require ROOT.'/app/App.php';

App::load();

if(isset($_GET['p'])){
	$page = $_GET['p'];
}
else{
	$page = 'home';
}

//Authentification
$app = App::getInstance();
$auth = new DBAuth($app->getDb());
$app->title = 'Peva Appli | Admin';
if(!$auth->loggedAsUser()){
	$app->forbidden();
}

ob_start();
if($page==='home'){
	require ROOT.'/pages/users/index.php';
}
elseif ($page==='webcam.index'){
	require ROOT.'/pages/users/webcams/index.php';
}
elseif ($page==='webcam.edit') {
	require ROOT.'/pages/users/webcams/edit.php';
}
elseif ($page==='webcam.add') {
	require ROOT.'/pages/users/webcams/add.php';
}
elseif ($page==='webcam.delete') {
	require ROOT.'/pages/users/webcams/delete.php';
}
elseif ($page==='webcam.check') {
	require ROOT.'/pages/users/webcams/check.php';
}



elseif ($page==='login') {
	require ROOT.'/pages/shared/login.php';
}
elseif ($page==='logout') {
	require ROOT.'/pages/shared/logout.php';
}

$content = ob_get_clean();

ob_start();
if ($page!='login') {
	require ROOT.'/pages/shared/templates/templates-parts/menu.php';
}
$menu = ob_get_clean();

require ROOT.'/pages/shared/templates/default.php';