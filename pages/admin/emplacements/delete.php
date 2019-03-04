<?php

$emplacementTable = App::getInstance()->getTable('Emplacement');

if(!empty($_POST)){
	$result = $emplacementTable->delete($_POST['id']);
	header('Location: admin.php?p=emplacement.index');
}