<?php
$emplacements = App::getInstance()->getTable('Emplacement');
$emplacementsWebcam = $emplacements->getEmplacements('webcam');
$emplacementsBrochure = $emplacements->getEmplacements('brochure');
$emplacementsNews = $emplacements->getEmplacements('news');
$emplacementsPromo = $emplacements->getEmplacements('promo');

?>

<h1>Administrer les emplacements</h1>

<p>
	<a href="?p=emplacement.add" class="btn btn-success">Ajouter un emplacement</a>
</p>
<h2>Emplacements pour les webcams</h2>
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
		<?php foreach ($emplacementsWebcam as $emplacement): ?>
			<tr>
				<td><?= $emplacement->emplacement_id; ?></td>
				<td><?= $emplacement->emplacement_name; ?></td>
				<td><?= $emplacement->user_name; ?></td>
				<td>
					<a href="?p=emplacement.edit&id=<?= $emplacement->emplacement_id;?>" class="btn btn-primary">Editer</a>
					<form action="?p=emplacement.delete" method="post" style="display: inline;">
						<input type="hidden" name="id" value="<?= $emplacement->emplacement_id; ?>">
						<button type="submit" class="btn btn-danger" href="?p=emplacement.delete&id=<?= $emplacement->emplacement_id;?>">Supprimer</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<h2>Emplacements pour les brochures</h2>
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
		<?php foreach ($emplacementsBrochure as $emplacement): ?>
			<tr>
				<td><?= $emplacement->emplacement_id; ?></td>
				<td><?= $emplacement->emplacement_name; ?></td>
				<td><?= $emplacement->user_name; ?></td>
				<td>
					<a href="?p=emplacement.edit&id=<?= $emplacement->emplacement_id;?>" class="btn btn-primary">Editer</a>
					<form action="?p=emplacement.delete" method="post" style="display: inline;">
						<input type="hidden" name="id" value="<?= $emplacement->emplacement_id; ?>">
						<button type="submit" class="btn btn-danger" href="?p=emplacement.delete&id=<?= $emplacement->emplacement_id;?>">Supprimer</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<h2>Emplacements pour les news</h2>
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
		<?php foreach ($emplacementsNews as $emplacement): ?>
			<tr>
				<td><?= $emplacement->emplacement_id; ?></td>
				<td><?= $emplacement->emplacement_name; ?></td>
				<td><?= $emplacement->user_name; ?></td>
				<td>
					<a href="?p=emplacement.edit&id=<?= $emplacement->emplacement_id;?>" class="btn btn-primary">Editer</a>
					<form action="?p=emplacement.delete" method="post" style="display: inline;">
						<input type="hidden" name="id" value="<?= $emplacement->emplacement_id; ?>">
						<button type="submit" class="btn btn-danger" href="?p=emplacement.delete&id=<?= $emplacement->emplacement_id;?>">Supprimer</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<h2>Emplacements pour les promos</h2>
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
		<?php foreach ($emplacementsPromo as $emplacement): ?>
			<tr>
				<td><?= $emplacement->emplacement_id; ?></td>
				<td><?= $emplacement->emplacement_name; ?></td>
				<td><?= $emplacement->user_name; ?></td>
				<td>
					<a href="?p=emplacement.edit&id=<?= $emplacement->emplacement_id;?>" class="btn btn-primary">Editer</a>
					<form action="?p=emplacement.delete" method="post" style="display: inline;">
						<input type="hidden" name="id" value="<?= $emplacement->emplacement_id; ?>">
						<button type="submit" class="btn btn-danger" href="?p=emplacement.delete&id=<?= $emplacement->emplacement_id;?>">Supprimer</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>