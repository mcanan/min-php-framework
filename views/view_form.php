<h3><?= $titulo ?></h3>
<br />
<form class="form-horizontal" id='formData' role="form" action="<?= $formActionAceptar ?>" method="get">
	<?php foreach ($items as $i) { ?>
	<?php if ($i[4]!=1) { ?>
	<div class="form-group">
		<label for="<?= $i[0] ?>" class='control-label col-md-2'><?=$i[1]?></label>
		<div class="col-md-4">
			<div class='input-group'>
				<?=$i[3]?>
				<input class='form-control' type="text" id="<?= $i[0] ?>" name="<?= $i[0] ?>" placeholder="<?= $i[3] ?>" value="<?= $i[2] ?>">
			</div>
		</div>
	</div>
	<?php } else { ?>
	<input type='hidden' name='<?= $i[0] ?>' value='<?= $i[1] ?>'>
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
