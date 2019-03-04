<?php

//var_dump($_POST);

$webcamTable = App::getInstance()->getTable('Webcam');
$users = App::getInstance()->getTable('user')->extractExceptAdmin('user_id','user_name');
$form = new \Core\HTML\BootstrapForm($_POST); //données du formulaire passées en paramètre

if(!empty($_POST)){
	$result = $webcamTable->create([
		'webcam_name' => $_POST['webcam_name'],
		'webcam_slug' => $_POST['webcam_slug'],
		'webcam_owner' => $_POST['webcam_owner']
	]);
	if ($result) { // if result = true
		header('Location: admin.php?p=webcam.edit&id='.App::getInstance()->getDb()->lastInsertId());
	}
}

?>

<form method="post">
	<?= $form->input('webcam_name','Titre: ',true); ?>
	<?= $form->input('webcam_slug','Slug: ',true); ?>
	<?= $form->select('webcam_owner','Utilisateurs',$users); ?>
	<button class="btn btn-primary">Sauvegarder</button>
</form>