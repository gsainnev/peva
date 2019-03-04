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
$app = App::getInstance();//App::getInstance() représente la connexion
$auth = new DBAuth($app->getDb());
$app->title = 'Peva Appli | Super Admin';
if(!$auth->loggedAsSuperAdmin()){
	$app->forbidden();
}

ob_start();
if($page==='home'){
	require ROOT.'/pages/admin/index.php';
}
elseif ($page==='webcam.index'){
	require ROOT.'/pages/admin/webcams/index.php';
}
elseif ($page==='webcam.edit') {
	require ROOT.'/pages/admin/webcams/edit.php';
}
elseif ($page==='webcam.add') {
	require ROOT.'/pages/admin/webcams/add.php';
}
elseif ($page==='webcam.delete') {
	require ROOT.'/pages/admin/webcams/delete.php';
}

elseif($page==='user.index'){
	require ROOT.'/pages/admin/users/index.php';
}
elseif ($page==='user.edit') {
	require ROOT.'/pages/admin/users/edit.php';
}
elseif ($page==='user.add') {
	require ROOT.'/pages/admin/users/add.php';
}
elseif ($page==='user.delete') {
	require ROOT.'/pages/admin/users/delete.php';
}

elseif($page==='emplacement.index'){
	require ROOT.'/pages/admin/emplacements/index.php';
}
elseif ($page==='emplacement.edit') {
	require ROOT.'/pages/admin/emplacements/edit.php';
}
elseif ($page==='emplacement.add') {
	require ROOT.'/pages/admin/emplacements/add.php';
}
elseif ($page==='emplacement.delete') {
	require ROOT.'/pages/admin/emplacements/delete.php';
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
	require ROOT.'/pages/shared/templates/templates-parts/menu-admin.php';
}
$menu = ob_get_clean();

require ROOT.'/pages/shared/templates/default.php';