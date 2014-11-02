<h3><?= $titulo ?></h3>
<br />
<form class="form-horizontal" id='formData' role="form" action="<?= $formActionAceptar ?>" method="get">
	<?php foreach ($items as $i) { ?>
	<?php if (!isset($i['hidden']) || ($i['hidden']!="1" && $i['hidden']!="true")) { ?>
	<div class="form-group">
		<label for="<?= $i['id'] ?>" class='control-label col-md-2'><?=$i['descripcion']?></label>
		<div class="col-md-4">
			<div class='input-group'>
				<?= (isset($i['addon'])?$i['addon']:'') ?>
				<input class='form-control' type="text" id="<?= $i['id'] ?>" name="<?= $i['id'] ?>" placeholder="<?= (isset($i['placeholder'])?$i['placeholder']:'') ?>" value="<?= (isset($i['value'])?$i['value']:'') ?>">
			</div>
		</div>
	</div>
	<?php } else { ?>
	<input type='hidden' name='<?= $i['id'] ?>' value='<?= $i['value'] ?>'>
	<?php } ?>
	<?php } ?>
	<div class="form-group">
		<div class="col-md-4 col-md-offset-2">
			<button type="submit" class="btn btn-success" id='btnAceptar'>Aceptar</button>
			<a href='<?= $formActionCancelar ?>' class="btn">Cancelar</a>
		</div>
	</div>
</form>
<?php if ($mensaje!="") { ?>
<div class="alert alert-<?= ($error==true ? "danger" : "success") ?>" role="alert"><?= $mensaje ?></div>
<?php } ?>
