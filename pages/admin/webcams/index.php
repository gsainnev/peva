<?php
$webcams = App::getInstance()->getTable('Webcam')->getWebcams();

?>

<h1>Administrer les webcams</h1>

<p>
	<a href="?p=webcam.add" class="btn btn-success">Ajouter une webcam</a>
</p>

<table class="table">
	<thead>
		<tr>
			<td>ID</td>
			<td>Titre</td>
			<td>Propriétaire</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($webcams as $webcam): ?>
			<tr>
				<td><?= $webcam->webcam_id; ?></td>
				<td><?= $webcam->webcam_name; ?></td>
				<td><?= $webcam->user_name; ?></td>
				<td>
					<a href="?p=webcam.edit&id=<?= $webcam->webcam_id;?>" class="btn btn-primary">Editer</a>
					<form action="?p=webcam.delete" method="post" style="display: inline;">
						<input type="hidden" name="id" value="<?= $webcam->webcam_id; ?>">
						<button type="submit" class="btn btn-danger" href="?p=webcam.delete&id=<?= $webcam->webcam_id;?>">Supprimer</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>