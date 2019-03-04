<?php
if(!empty($_POST)){
	$auth = new \Core\Auth\DBAuth(App::getInstance()->getDb());
	if($auth ->login($_POST['username'], $_POST['password'])){
		if ($_SESSION['user_privilege']==='1') {
			header('Location: admin.php');
		}
		else {
			header('Location: user.php');
		}
	}
	else{
		?>

		<div class="alert alert-danger">
			Identifiants incorrect
		</div>

		<?php
	}
}

$form = new \Core\HTML\BootstrapForm($_POST);

?>

<form method="post">
	<?= $form->input('username','Pseudo',true); ?>
	<?= $form->input('password','Mot de passe',true,['type'=>'password']); ?>
	<button class="btn btn-primary">Envoyer</button>
</form>