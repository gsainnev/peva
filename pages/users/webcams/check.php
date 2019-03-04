<?php

//var_dump($_POST);

$webcamTable = App::getInstance()->getTable('Webcam');
$emplacementwecamTable = App::getInstance()->getTable('Emplacementwebcam');
$webcam = $webcamTable->find($_GET['id']);
$emplacements = App::getInstance()->getTable('emplacement')->extractByTypeAndUser('emplacement_id','emplacement_slug','Webcam',$_SESSION['user_id']);
$emplacementOfTheWebcam = App::getInstance()->getTable('Emplacementwebcam')->extractEmplacementWebcam('e_id',$_GET['id']);
$form = new \Core\HTML\BootstrapForm($webcam);


if(!empty($_POST)){
	$checkboxes = array();
	foreach ($_POST as $key => $value) {
		if (substr($key, 0, 8)=="checkbox") {
			$checkboxes[] = $value;
		}
	}
	//print_r($checkboxes);
	$deleteAssos = $emplacementwecamTable->deleteAssosByUser($_GET['id'],$_SESSION['user_id']);
	if (!empty($checkboxes)) {
		$createAssos = $emplacementwecamTable->createAssos($_GET['id'],$checkboxes);
	}

	if ($deleteAssos=true){
		?>
		<div class="alert alert-success">
			<p style="margin-bottom:0;">La webcam a bien été modifiée <br>
				<a href="user.php?p=webcam.index">Retour aux webcams</a>
			</p>
		</div>
		<?php
	}
}

?>

<h1>Modifier la webcam</h1>

<form method="post">
	<p>Proprio : <?= $webcam->user_name; ?></p>
	<p>Titre : <?= $webcam->webcam_name; ?></p>
	<p>Slug : <?= $webcam->webcam_slug; ?></p>
	<?= $form->checkbox('Emplacements',$emplacements, $emplacementOfTheWebcam); ?>
	<?= $form->input('avoid_empty_post','',true,['type'=>'hidden']); ?>
	<button class="btn btn-primary">Sauvegarder</button>
</form>