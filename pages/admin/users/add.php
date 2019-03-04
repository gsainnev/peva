<?php

$webcamTable = App::getInstance()->getTable('User');
$form = new \Core\HTML\BootstrapForm($_POST);

if(!empty($_POST)){
	$result = $webcamTable->create([/*
		'user_login' => $_POST['user_login'],
		'user_pass' => $_POST['user_pass'],
		'user_privilege' => $_POST['user_privilege'],
		'user_slug' => $_POST['user_slug'],*/
		'user_name' => $_POST['user_name']
	]);
	if ($result) { // if result = true
		header('Location: admin.php?p=user.edit&id='.App::getInstance()->getDb()->lastInsertId());
	}
}

?>

<form method="post">
	<?= $form->input('user_name','Nom'); ?>
	<button class="btn btn-primary">Sauvegarder</button>
</form>