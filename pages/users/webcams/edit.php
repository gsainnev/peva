<?php

//var_dump($_POST);
$app = App::getInstance();
$webcamTable = $app->getTable('Webcam');
$emplacementwecamTable = $app->getTable('Emplacementwebcam');

$webcam = $webcamTable->find($_GET['id']);
$emplacements = $app->getTable('emplacement')->extractByTypeAndUser('emplacement_id','emplacement_slug','Webcam',$_SESSION['user_id']);
$emplacementOfTheWebcam = $app->getTable('Emplacementwebcam')->extractEmplacementWebcam('e_id',$_GET['id']);
$form = new \Core\HTML\BootstrapForm($webcam);


if ($_SESSION['user_id']!=$webcam->user_id) { //if current user isn't the owner
	$app->forbidden();
}
else{

if(!empty($_POST)){
	$updateWebcam = $webcamTable->update($_GET['id'],[
		'webcam_name' => $_POST['webcam_name'],
		'webcam_slug' => $_POST['webcam_slug']
	]);
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

	if (($updateWebcam=true)&&($deleteAssos=true)){
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
	<?= $form->input('webcam_name','Titre de la webcam',true); ?>
	<?= $form->input('webcam_slug','Slug de la webcam',true); ?>
	<?= $form->checkbox('Emplacements',$emplacements, $emplacementOfTheWebcam); ?>
	<button class="btn btn-primary">Sauvegarder</button>
</form>

<?php }//end else ?>