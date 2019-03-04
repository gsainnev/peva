<?php

$userTable = App::getInstance()->getTable('User');
$user = $userTable->find($_GET['id']);
$form = new \Core\HTML\BootstrapForm($user);


if(!empty($_POST)){
	$result = $userTable->update($_GET['id'],[
		'user_name' => $_POST['user_name']
	]);
	if ($result) { // if result = true
		?>
		<div class="alert alert-success">L'utilisateur a bien été modifié</div>
		<?php
	}
}


?>

<form method="post">
	<?= $form->input('user_name','Titre du user'); ?>
	<button class="btn btn-primary">Sauvegarder</button>
</form>