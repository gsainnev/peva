<?php

$emplacementTable = App::getInstance()->getTable('Emplacement');
$emplacement = $emplacementTable->find($_GET['id']);
$users = App::getInstance()->getTable('user')->extractExceptAdmin('user_id','user_name');
$types = array("Brochure"=>"Brochure","News"=>"News","Promo"=>"Promo","Webcam"=>"Webcam");
$form = new \Core\HTML\BootstrapForm($emplacement);

if(!empty($_POST)){
	$result = $emplacementTable->update($_GET['id'],[
		'emplacement_name' => $_POST['emplacement_name'],
		'emplacement_slug' => $_POST['emplacement_slug'],
		'emplacement_type' => $_POST['emplacement_type'],
		'emplacement_owner' => $_POST['emplacement_owner']
	]);
	if ($result) { // if result = true
		?>
		<div class="alert alert-success">
			<p style="margin-bottom:0;">L'emplacement a bien été modifiée <br>
				<a href="admin.php?p=emplacement.index">Retour aux emplacements</a>
			</p>
		</div>
		<?php
	}
}
?>

<form method="post">
	<?= $form->input('emplacement_name','Titre de l\'emplacement',true); ?>
	<?= $form->input('emplacement_slug','Slug de l\'emplacement',true); ?>
	<?= $form->select('emplacement_type','Type d\'emplacement',$types); ?>
	<?= $form->select('emplacement_owner','Propriétaire',$users); ?>
	<button class="btn btn-primary">Sauvegarder</button>
</form>