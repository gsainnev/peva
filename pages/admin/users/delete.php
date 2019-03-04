<?php

$webcamTable = App::getInstance()->getTable('User');

if(!empty($_POST)){
	$result = $webcamTable->delete($_POST['id']);
	header('Location: admin.php?p=user.index');
}