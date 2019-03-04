<?php

//var_dump($_POST);

$webcamTable = App::getInstance()->getTable('Webcam');

if(!empty($_POST)){
	$result = $webcamTable->create([
		'webcam_name' => $_POST['webcam_name'],
		'webcam_slug' => $_POST['webcam_slug'],
		'webcam_owner' => $_SESSION['user_id']
	]);
	if ($result) { // if result = true
		header('Location: user.php?p=webcam.edit&id='.App::getInstance()->getDb()->lastInsertId());
	}
}

$form = new \Core\HTML\BootstrapForm($_POST); //données du formulaire

?>

<form method="post">
	<?= $form->input('webcam_name','Titre de la webcam',true); ?>
	<?= $form->input('webcam_slug','Slug de la webcam',true); ?>
	<button class="btn btn-primary">Sauvegarder</button>
</form>