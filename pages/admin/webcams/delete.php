<?php

$webcamTable = App::getInstance()->getTable('Webcam');

if(!empty($_POST)){
	$result = $webcamTable->delete($_POST['id']);
	header('Location: admin.php?p=webcam.index');
}