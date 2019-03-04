<?php

//var_dump($_POST);

$webcamTable = App::getInstance()->getTable('Webcam');
$emplacementwecamTable = App::getInstance()->getTable('Emplacementwebcam');
$webcam = $webcamTable->find($_GET['id']); //récupération de la webcam avec find en se basant sur l'id passé en paramètres
$users = App::getInstance()->getTable('user')->extractExceptAdmin('user_id','user_name');
$emplacements = App::getInstance()->getTable('emplacement')->extractByType('emplacement_id','emplacement_slug','Webcam');
$emplacementOfTheWebcam = App::getInstance()->getTable('Emplacementwebcam')->extractEmplacementWebcam('e_id',$_GET['id']);
$form = new \Core\HTML\BootstrapForm($webcam);


if(!empty($_POST)){
	$result = $webcamTable->update($_GET['id'],[
		'webcam_name' => $_POST['webcam_name'],
		'webcam_slug' => $_POST['webcam_slug'],
		'webcam_owner' => $_POST['webcam_owner']
	]);
	//echo "<br>";
	$checkboxes = array();
	foreach ($_POST as $key => $value) {
		if (substr($key, 0, 8)=="checkbox") {
			$checkboxes[] = $value;
		}
	}
	$emplacementwecamTable->deleteAllAssos($_GET['id']);
	if (!empty($checkboxes)) {
		$result2 = $emplacementwecamTable->createAssos($_GET['id'],$checkboxes);
	}
	if ($result) { // if result = true
		?>
		<div class="alert alert-success">
			<p style="margin-bottom:0;">La webcam a bien été modifiée <br>
				<a href="admin.php?p=webcam.index">Retour aux webcams</a>
			</p>
		</div>
		<?php
	}
}


?>

<form method="post">
	<?= $form->input('webcam_name','Titre de la webcam',true); ?>
	<?= $form->input('webcam_slug','Slug de la webcam',true); ?>
	<?= $form->select('webcam_owner','Propriétaire',$users); ?>
	<?= $form->checkbox('Emplacements',$emplacements, $emplacementOfTheWebcam); ?>
	<button class="btn btn-primary">Sauvegarder</button>
</form>