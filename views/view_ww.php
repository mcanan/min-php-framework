<h3><?= $titulo ?></h3>
<br />
<?php	if (isset($form_action) || isset($actions)) {  ?>
<div class="row">
  <?php	if (isset($form_action)) {
    if (!isset($busqueda)) { $busqueda='';}
  ?>
  <div class="col-md-6">
    <form class="form-inline" role="form" action="<?= $form_action ?>" method="get">
      <input type="text" class="form-control" id="b" name="b" placeholder="Buscar..." value="<?=$busqueda?>">
      <button type="submit" id="btnBuscar" class="btn btn-primary">Buscar</button>
    </form>
  </div>
  <?php } else { ?>
  <div class="col-md-6"></div>
  <?php } ?>
  <?php if (isset($actions)) {?>
  <div class="col-md-6 text-right">
    <?php foreach ($actions as $a) { ?>
    <a href='<?= $a['href'] ?>' class="<?= (isset($a['class'])?$a['class']:"") ?>"><?= $a['description'] ?></a>&nbsp;
    <?php } ?>
  </div>
  <?php } ?>
</div>
<br/>
<?php } ?>
<table class="table table-striped table-condensed">
  <?php foreach ($items as $i) { ?>
  <tr>
    <?php foreach ($item_attributes as $a) { ?>
    <td class='<?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><?= $i[$a['attribute']] ?></td>
    <?php } ?>
    <?php if (isset($item_actions)) {?>
    <?php foreach ($item_actions as $a) { ?>
    <td class='<?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><a 	href="<?php eval("echo '".str_replace("}",'\'].\'',str_replace("{", '\'.$i[\'', $a['href'])."';")); ?>"
        <?php if (isset($a['onclick'])) { ?>
        onclick="<?php eval("echo '".str_replace("}",'\'].\'\\\'',str_replace("{", '\\\'\'.$i[\'', $a['onclick'])."';")); ?>"
        <?php } ?> 
        <?php if (isset($a['class'])) { ?>
        class="<?= $a['class'] ?>">
        <?php } ?> 
        ><?= $a['description'] ?></a></td>    
  </td>
  <?php } ?>
  <?php } ?>
</tr>
<?php } ?>
<tr>
  <?php if (isset($Pagination)) {?>
  <td colspan="5">
    <div>Total: <strong><?= $Pagination->getCantidadTotalItems() ?></strong></div>
    <?php $Pagination->render("/admin/referentes?".($busqueda!="b=" ? "b=".urlencode($busqueda) : "")); ?>
  </td>
  <?php } ?>
</tr>
</table>

<?php if (isset($mensaje) && $mensaje!="") { ?>
<div class="alert alert-<?= ($error==true ? "danger" : "success") ?>" role="alert"><?= $mensaje ?></div>
<?php } ?>

<script>
  function confirmar(screen_name)
  {
    return confirm("¿Desea borrar el referente "+screen_name+"?");
  }
</script>
