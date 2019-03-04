<?php
$users = App::getInstance()->getTable('User')->all();

?>

<h1>Administrer les utilisateurs</h1>

<p>
	<a href="?p=user.add" class="btn btn-success">Ajouter un utilisateur</a>
</p>

<table class="table">
	<thead>
		<tr>
			<td>ID</td>
			<td>Titre</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?= $user->user_id; ?></td>
				<td><?= $user->user_name; ?></td>
				<td>
					<a href="?p=user.edit&id=<?= $user->user_id;?>" class="btn btn-primary">Editer</a>
					<form action="?p=user.delete" method="post" style="display: inline;">
						<input type="hidden" name="id" value="<?= $user->user_id; ?>">
						<button type="submit" class="btn btn-danger" href="?p=user.delete&id=<?= $user->user_id;?>">Supprimer</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>